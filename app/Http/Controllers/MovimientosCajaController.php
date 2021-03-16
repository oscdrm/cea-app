<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\MovimientosCaja;
use App\Concepto;
use App\Alumno;
use App\MetodoPago;
use App\Adeudo;
use Carbon\Carbon;

class MovimientosCajaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        if(Auth::user()->role_id == 1){
            $movimientos = MovimientosCaja::orderBy('created_at', 'ASC')->get();
        }
        
        if(Auth::user()->role_id == 2){
            $user = Auth::user()->id;
            $movimientos = MovimientosCaja::where('cashier_id', '=', $user)
                      ->whereBetween('created_at', [Carbon::now()
                      ->startOfWeek(), Carbon::now()->endOfWeek()])
                      ->orderBy('created_at', 'asc')
                      ->paginate();
        }
        
        return view('movimientos/index')->with(compact('movimientos'));
    }

    public function create()
    {   
        $conceptos = Concepto::all();
        $alumnos = Alumno::where('status_alumno_id', '=', 1)->get();
        $metodosPago = MetodoPago::all();
        $adeudos = Adeudo::where('status_adeudo_id', '=', 1)->get();
        return view('movimientos.create')->with(compact('conceptos', 'alumnos', 'metodosPago', 'adeudos'));
    }

    public function store(Request $request)
    {

        //Messages
        $messages = [
            'required' => 'Es necesario ingresar un valor para el campo :attribute',
            'surgery_id.required' => 'Debes de selecionar una tienda',
            'min' => 'Debes ingresar al menos :min caracteres en el campo :attribute',
            'digits' => 'Solo puedes ingresar numeros en el campo :attribute',
            'max' => 'No debes ingresar mas :max caracteres en el campo :attribute',
            'email' => 'Debes ingresar un email valido example@example.com',
            'unique' => 'Este folio ya se ha registrado anteriormente'
        ];

        //Validaciones
        $rules = [
            'monto_pago' => 'required'
        ];

        // Validator::make($request, $rules);
        $this->validate($request, $rules, $messages);
        try{
            $folio = "";
            if(!empty($request->input('folio'))){
                $folio = $request->input('folio');
                $folioObj = MovimientosCaja::where('folio', '=', $folio)->count();

                if($folioObj > 0){
                    $errors = [];
                    $errors['folio_duplicado'] = "Este folio ya se ha registrado anteriormente";
        
                    return  back()->withErrors($errors);
                }

            }

            $montoPago = 0;
            if($request->input('monto_pago_otro') != null){
                $montoPago = $request->input('monto_pago_otro');
            }else{
                $montoPago = $request->input('monto_pago');
            }

            $payment = new MovimientosCaja();
            $payment->alumno_id = $request->input('alumno');
            $payment->otro_alumno = $request->input('otro_alumno');
            $payment->concepto_id = $request->input('concepto');
            $payment->otro_concepto = $request->input('otro_concepto');
            $payment->folio = $folio;
            //$payment->folio = $request->input('folio');
            $payment->monto_pago = $montoPago;
            $payment->nota = $request->input('nota');
            $cashier = Auth::user()->id;
            $payment->cashier_id = $cashier;

            $metodo_pago = $request->input('metodo_pago') ? $request->input('metodo_pago') : 1;
            $payment->metodo_pagos_id = $metodo_pago;
            
            $adeudo = $request->input('adeudo');
            if(!empty($adeudo)){
                $adeudoObj = Adeudo::find($adeudo);
                $payment->adeudo_id = $adeudo;
                if($adeudoObj->monto_restante == $montoPago){
                    $adeudoObj->status_adeudo_id = 2;
                    $adeudoObj->monto_restante = 0;
                    $adeudoObj->nota = "El alumno ha pagado el total del adeudo";
                }else{
                    $resto = $adeudoObj->monto_pago - $montoPago;
                    $adeudoObj->nota = "El alumno aun adeuda un monto de: $".$resto;
                    $adeudoObj->monto_restante = $resto;
                    $adeudoObj->status_adeudo_id = 1;
                }
                
                $adeudoObj->save();
            }

            $payment->save();

        }catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    
        return redirect('/movimientos');

    }

    public function edit($id)
    {   
        $movimiento = MovimientosCaja::find($id);
        $conceptos = Concepto::all();
        $alumnos = Alumno::where('status_alumno_id', '=', 1)->get();
        $metodosPago = MetodoPago::all();
        $adeudos = Adeudo::where('status_adeudo_id', '=', 1)->get();
        return view('movimientos.edit')->with(compact('movimiento','conceptos', 'alumnos', 'metodosPago', 'adeudos'));
    }

    public function update(Request $request, $id)
    {
        $payment = MovimientosCaja::find($id);

        $pagoAnterior = $payment->monto_pago;
        $pagoActual = $request->input('monto_pago');
        $diferencia = 0;

        $rules = [
            'monto_pago' => 'required'
        ];

        if($payment->folio != $request->input('folio')){
            $rules = [
                'monto_pago' => 'required',
                'folio' => 'unique:movimientos_cajas'
            ];
        }

        //Messages
        $messages = [
            'required' => 'Es necesario ingresar un valor para el campo :attribute',
            'surgery_id.required' => 'Debes de selecionar una tienda',
            'min' => 'Debes ingresar al menos :min caracteres en el campo :attribute',
            'digits' => 'Solo puedes ingresar numeros en el campo :attribute',
            'max' => 'No debes ingresar mas :max caracteres en el campo :attribute',
            'email' => 'Debes ingresar un email valido example@example.com',
            'unique' => 'Este folio ya se ha registrado anteriormente'
        ];


        // Validator::make($request, $rules);
        $this->validate($request, $rules, $messages);
        try{
            
            $payment->alumno_id = $request->input('alumno');
            $payment->otro_alumno = $request->input('otro_alumno');
            $payment->concepto_id = $request->input('concepto');
            $payment->otro_concepto = $request->input('otro_concepto');
            $payment->folio = $request->input('folio');
            //$payment->folio = $request->input('folio');
            $payment->monto_pago = $request->input('monto_pago');
            $payment->nota = $request->input('nota');
            $cashier = Auth::user()->id;
            $payment->cashier_id = $cashier;

            $metodo_pago = $request->input('metodo_pago') ? $request->input('metodo_pago') : 1;
            $payment->metodo_pagos_id = $metodo_pago;
            
            $adeudo = $request->input('adeudo');
           //TERMINAR ESTA PARTE 
            if(!empty($adeudo)){
                $adeudoObj = Adeudo::find($adeudo);
                $payment->adeudo_id = $adeudo;

                if($pagoAnterior != $pagoActual){
                    if($pagoActual < $pagoAnterior){
                        $diferencia = $pagoAnterior - $pagoActual;
                        $adeudoObj->monto_restante = $adeudoObj->monto_restante + $diferencia;
                    }else{
                        $diferencia = $pagoAnterior - $pagoActual;
                        $adeudoObj->monto_restante = $adeudoObj->monto_restante - $diferencia;
                    }
                    $adeudoObj->save;

                    if($adeudoObj->monto_restante == $request->input('monto_pago')){
                        $adeudoObj->status_adeudo_id = 2;
                    }else{
                        $resto = $adeudoObj->monto_pago - $request->input('monto_pago');
                        $adeudoObj->nota = "El alumno aun adeuda un monto de: $".$resto;
                        $adeudoObj->monto_restante = $resto;
                        $adeudoObj->status_adeudo_id = 1;
                    }
                }

                $adeudoObj->save();
            }

            $payment->save();

        }catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    
        return redirect('/movimientos');

    }

    public function delete($id)
    {
        $movimiento = MovimientosCaja::find($id);
        if($movimiento->adeudo){
            $adeudoObj = Adeudo::find($movimiento->adeudo->id);
            $adeudoObj->monto_restante = $adeudoObj->monto_pago;
            $adeudoObj->save();
        }
        $movimiento->delete();

        return back();
    }

    


}
