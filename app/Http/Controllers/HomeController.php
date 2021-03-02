<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;
use App\Adeudo;
use App\MovimientosCaja;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
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
        $alumnosInscritos = Alumno::where('status_alumno_id', '=', 1)->orWhere('status_alumno_id', '=', 3)->get();
        $alumnosInscritosCount = $alumnosInscritos->count();
        $alumnosActivos = Alumno::where('status_alumno_id', '=', 1)->get();
        $alumnosActivosCount = $alumnosActivos->count();

        $adeudos = Adeudo::where('status_adeudo_id', '=', 1)->paginate(15);
        if(Auth::user()->role_id == 1){
            $movimientos = $this->consultasAdmin();
            $amountWeek = $movimientos['amountWeek'];
            $amountToday = $movimientos['amountToday'];
        }

        if(Auth::user()->role_id == 2){
            $user = Auth::user()->id;
            $movimientos = $this->consultasCajera($user);
            $amountWeek = $movimientos['amountWeek'];
            $amountToday = $movimientos['amountToday'];
        }

        return view('home')->with(compact('alumnosInscritosCount', 'alumnosActivosCount', 'adeudos', 'amountWeek', 'amountToday'));
    }

    private function consultasCajera($user){
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);

        $allmoves = MovimientosCaja::where('cashier_id', '=', $user)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $amountWeek = 0;
        $dt = Carbon::now();
        $dt = explode(" ", $dt);
        $dc = "";
        $amountToday = 0;
        foreach($allmoves as $moves){
            $amountWeek = $amountWeek + $moves->monto_pago;
            $dc = $moves->created_at;
            $dc = explode(" ", $dc);
            if($dt[0] == $dc[0]){
                $amountToday = $amountToday + $moves->monto_pago;
            } 
        }

        $consultsArray = ['amountWeek' => $amountWeek, 'amountToday' => $amountToday];
        
        return $consultsArray;
    }

    private function consultasAdmin(){
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::SATURDAY);
        //$nconsultsweek = MovimientosCaja::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('outflow', '!=', true)->count();
        //$nct = Consult::whereDate('created_at', Carbon::today())->where('outflow', '!=', true)->count();
        //$ncm = Consult::whereMonth('created_at', Carbon::now()->month)->where('outflow', '!=', true)->count();

        //$consults10 = Consult::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('outflow', '!=', true)->paginate(10);
        //$consults10 = Consult::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $allmoves = MovimientosCaja::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $amountWeek = 0;
        $dt = Carbon::now();
        $dt = explode(" ", $dt);
        $dc = "";
        $amountToday = 0;
        foreach($allmoves as $moves){
            $amountWeek = $amountWeek + $moves->monto_pago;
            $dc = $moves->created_at;
            $dc = explode(" ", $dc);
            if($dt[0] == $dc[0]){
                $amountToday = $amountToday + $moves->monto_pago;
            }
        }
         
     

        $consultsArray = ['amountWeek' => $amountWeek, 'amountToday' => $amountToday];
        
        return $consultsArray;
    }

}
