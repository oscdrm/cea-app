<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Alumno;
use App\Modalidad;
use App\Concepto;
use App\Carrera;
use App\Adeudo;
use App\CostoCarrera;
use App\Descuento;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Mail;
use App\Mail\SendPayRemminder;

class AdeudoMensual implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {   
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha = Carbon::now();
        $mes = $meses[($fecha->format('n')) - 1];

        $message = 'Adeudo mensual de alumnos activos';
        $alumnosActivos = Alumno::where('status_alumno_id', '=', 1)->get();
        $carrera = "";
        $concepto = "";
        $modalidad = "";
        $costo = "";
        $montoDescuento = 0;
        $costoTotal = 0;
        $costoDescuento = 0;
        foreach($alumnosActivos as $alumno){
            $carrera = $alumno->carrera_id;
            $concepto = Concepto::find(2);
            $modalidad = $alumno->modalidad_id;
            $costo = CostoCarrera::where('carrera_id', '=', $carrera)->where('concepto_id', '=', $concepto->id)->where('modalidad_id', '=', $modalidad)->first();
            
            if($costo){
               $costo = $costo->costo;
            } 

            if(!empty($alumno->descuentos)){
                $descuentosAlumno = $alumno->descuentos;

                foreach($descuentosAlumno as $descuento){
                    if($descuento->concepto->id == $concepto->id){
                        $montoDescuento = $descuento->discount;
                        $montoDescuento = $montoDescuento / 100;
                    }  
                }

            }

            $costoDescuento = $costo * $montoDescuento;
            $costoTotal = floor($costo - $costoDescuento);

            try{
                $adeudo = new Adeudo();
                $adeudo->name = "Colegiatura del mes de ".$mes;
                $adeudo->alumno_id = $alumno->id;
                $adeudo->concepto_id = $concepto->id;
                $adeudo->monto_pago = $costoTotal;
                $adeudo->monto_restante = $costoTotal;
                $adeudo->status_adeudo_id = 1;

                $adeudo->save();
                if($alumno->email){
                    Mail::to($alumno->email)->send(new SendPayRemminder());
                }
                
    
            }catch (Exception $e) {
                echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            }

        }

        $message = 'Adeudo mensual de alumnos activos';
        Log::info($message);
    }
}
