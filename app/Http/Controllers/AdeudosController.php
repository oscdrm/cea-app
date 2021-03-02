<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Concepto;
use App\Alumno;
use App\StatusAdeudo;
use App\Adeudo;

class AdeudosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $adeudos = Adeudo::orderBy('created_at', 'DESC')->orderBy('status_adeudo_id', 'ASC')->get();
        return view('adeudos/index')->with(compact('adeudos'));
    }

    public function create()
    {   
        $conceptos = Concepto::all();
        $alumnos = Alumno::where('status_alumno_id', '=', 1)->get();
        $statuses = StatusAdeudo::all();

        return view('adeudos.create')->with(compact('conceptos', 'alumnos', 'statuses'));
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
            'alumno' => 'required',
            'concepto' => 'required',
            'monto_pago' => 'required',
            'status' => 'required'
        ];

        // Validator::make($request, $rules);
        $this->validate($request, $rules, $messages);
        try{
            $adeudo = new Adeudo();
            $adeudo->alumno_id = $request->input('alumno');
            $adeudo->concepto_id = $request->input('concepto');
            $adeudo->monto_pago = $request->input('monto_pago');
            $adeudo->monto_restante = $request->input('monto_pago');
            $adeudo->status_adeudo_id = $request->input('status');
            $adeudo->nota = $request->input('nota');
            

            $adeudo->save();

        }catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    
        return redirect('/adeudos');

    }

    public function edit($id)
    {   
        $adeudo = Adeudo::find($id);
        $conceptos = Concepto::all();
        $alumnos = Alumno::where('status_alumno_id', '=', 1)->get();
        $statuses = StatusAdeudo::all();

        return view('adeudos.edit')->with(compact('adeudo','conceptos', 'alumnos', 'statuses'));
    }

    public function update(Request $request, $id)
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
            'alumno' => 'required',
            'concepto' => 'required',
            'monto_pago' => 'required',
            'status' => 'required'
        ];

        // Validator::make($request, $rules);
        $this->validate($request, $rules, $messages);
        try{
            $adeudo = Adeudo::find($id);
            $adeudo->alumno_id = $request->input('alumno');
            $adeudo->concepto_id = $request->input('concepto');
            $adeudo->monto_pago = $request->input('monto_pago');
            $adeudo->monto_restante = $request->input('monto_pago');
            $adeudo->status_adeudo_id = $request->input('status');
            $adeudo->nota = $request->input('nota');
            

            $adeudo->save();

        }catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    
        return redirect('/adeudos');

    }

    public function delete($id)
    {
        $adeudo = Adeudo::find($id);
        
        $adeudo->delete();

        return back();
    }


}
