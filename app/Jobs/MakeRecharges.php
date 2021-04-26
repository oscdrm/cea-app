<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Alumno;
use App\Adeudo;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Mail;
use App\Mail\SendPayRemminder;

class MakeRecharges implements ShouldQueue
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

        $message = 'Recargo del mes: ';
        $adeudosActivos = Adeudo::where('status_adeudo_id', '=', 1)->get();
        $concepto = "";
        $costo = "";
        $montoDescuento = 0;
        $costoTotal = 200;
        $costoDescuento = 0;
        foreach($adeudosActivos as $adeudoaActivo){
            $concepto = Concepto::find(3);

            try{
                $adeudo = new Adeudo();
                $adeudo->name = "Recargo del mes de ".$mes;
                $adeudo->alumno_id = $adeudoaActivo->$alumno->id;
                $adeudo->concepto_id = $adeudoaActivo->$concepto->id;
                $adeudo->monto_pago = $costoTotal;
                $adeudo->monto_restante = $costoTotal;
                $adeudo->status_adeudo_id = 1;

                $adeudo->save();
            }catch (Exception $e) {
                echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            }

        }

        $message = 'Recargo en colegiaturas no pagadas';
        Log::info($message);
    }
}
