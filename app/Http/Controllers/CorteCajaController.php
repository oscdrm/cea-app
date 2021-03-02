<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use App\User;
use App\Concepto;
use App\MovimientosCaja;
use App\MetodoPago;

class CorteCajaController extends Controller
{
            /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $sendConsults = "";
        $movimientosCaja = [];
        $amountWeek = 0;
        $conceptos = Concepto::all();
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $movimientosCaja = MovimientosCaja::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        //$todosMovimientosCaja = MovimientosCaja::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $amountWeek = 0;
        $dt = Carbon::now();
        $dt = explode(" ", $dt);
        $dc = "";
        $amountToday = 0;
        $pagosRegistrados = 0;
        $dineroCaja = 0;
        
        
        foreach($movimientosCaja as $movimientoCaja){
            $dc = $movimientoCaja->created_at;
            $dc = explode(" ", $dc);
            $paymentMethod = $movimientoCaja->metodoPago ? $movimientoCaja->metodoPago->id : 0;

                $pagosRegistrados++;
                $amountWeek = $amountWeek + $movimientoCaja->monto_pago;

                if($paymentMethod == 2){
                    $dineroCaja = $dineroCaja + $movimientoCaja->monto_pago;
                }

                if($dt[0] == $dc[0]){
                    $amountToday = $amountToday + $movimientoCaja->monto_pago;
                }
        }
    
        return view('corteCaja/earns')->with(compact('sendConsults', 'movimientosCaja', 'amountWeek', 'pagosRegistrados', 'conceptos', 'dineroCaja'));
    }

    public function calcular(Request $request){

        $sendConsults = "";
        $movimientosCaja = [];
        $amountWeek = 0;
        
        $conceptos = Concepto::all();
        $start = $request->input('start');
        $end = $request->input('end');
        $vali = 0;
        Carbon::setLocale('es');
        //$arrayClausules = [];
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        $movimientosCaja = MovimientosCaja::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        
        if($start && $end){
            $ds = Carbon::createFromFormat('d/m/Y', $start)->startOfDay();
            $de = Carbon::createFromFormat('d/m/Y', $end)->endOfDay();
            //$ds = $ds->toDateString();
            //$de = $de->toDateString();
            $movimientosCaja = MovimientosCaja::whereBetween('created_at', [$ds, $de])->get();
            $vali = 1;
        }
    
        $amountWeek = 0;
        $dineroCaja = 0;
        $dt = Carbon::now();
        $dt = explode(" ", $dt);
        $dc = "";
        $amountToday = 0;
        $pagosRegistrados = 0;
        foreach($movimientosCaja as $movimientoCaja){
            $dc = $movimientoCaja->created_at;
            $dc = explode(" ", $dc);
            $paymentMethod = $movimientoCaja->metodoPago ? $movimientoCaja->metodoPago->id : 0;

                $pagosRegistrados++;
                $amountWeek = $amountWeek + $movimientoCaja->monto_pago;

                if($paymentMethod == 2){
                    $dineroCaja = $dineroCaja + $movimientoCaja->monto_pago;
                }

                if($dt[0] == $dc[0]){
                    $amountToday = $amountToday + $movimientoCaja->monto_pago;
                }
        }
        
        return view('corteCaja/earns')->with(compact('sendConsults', 'movimientosCaja', 'amountWeek', 'pagosRegistrados', 'conceptos', 'dineroCaja', 'start', 'end', 'vali'));

    }
}
