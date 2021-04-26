<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class SendPayRemminder extends Mailable
{
    use Queueable, SerializesModels;

    protected $inputs;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inputs)
    {
        //
        $this->inputs = $inputs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $date = Carbon::now();
        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha = Carbon::parse($date);
        $mes = $meses[($fecha->format('n')) - 1];
        $date = $fecha->format('d') . ' de ' . $mes . ' de ' . $fecha->format('Y');
        $alumno = $this->inputs['alumno'];
        $monto = $this->inputs['monto'];
        return $this->view('mails.recordatorio')->with(compact('alumno', 'monto', 'date'));
    }
}
