@extends('layouts.app2')

@section('content')
<div class="wrapper wrapper-content animated fadeInRight">
 <div class="row">
    <div class="col-lg-12">
        <div class="col-lg-6">
            <form action="{{url('/corteCaja/calcular')}}" method="post">
                @csrf
                <div class="filter">
                    <div class="form-group" id="data_5">
                        <label class="font-normal">Selecciona las fechas de corte</label>
                        <div class="input-daterange input-group shad" id="datepicker" val-valid="{{isset($vali) ? $vali : 0}}">
                            <span class="input-group-addon">Del </span>
                            <input type="text" class="input-sm form-control datepicker shad" value="{{isset($start) ? $start : ''}}" data-date-format="dd/mm/yyyy" name="start"/>
                            <span class="input-group-addon">al </span>
                            <input type="text" class="input-sm form-control datepicker" value="{{isset($end) ? $end : ''}}" data-date-format="dd/mm/yyyy" name="end"/>
                        </div>
                    </div>
                </div>               
               
                <div class="form-group">

                        <button id="filter" type="button" class="btn btn-w-m btn-info">Filtrar por fechas</button>
                        <button type="submit" class="btn btn-w-m btn-success">Realizar corte</button>
                        <button type="button" onclick="window.location='/corteCaja/';"  class="btn btn-w-m btn-warning">Corte general</button>

                </div>

            </form>
        </div>

    </div>

    <div class="col-lg-12">

        <div class="col-lg-3">
            <div class="widget navy-bg p-lg text-center shad">
                    <div class="m-b-md">
                        <span style="font-size:55px;">{{$pagosRegistrados}}</span>
                        <h3 class="font-bold no-margins">
                            Pagos Registrados
                        </h3>
                    </div>
                </div>
        </div>

        <div class="col-lg-4">
            <div class="widget blue-bg p-lg text-center shad">
                    <div class="m-b-md">
                        <i class="fa fa-dollar fa-4x"></i> <span style="font-size:55px;">{{$amountWeek}}</span>
                        <h3 class="font-bold no-margins">
                            Corte General
                        </h3>
                    </div>
                </div>
        </div>

        <div class="col-lg-4">
            <div class="widget yellow-bg p-lg text-center shad">
                    <div class="m-b-md">
                        <i class="fa fa-dollar fa-4x"></i> <span style="font-size:55px;">{{$dineroCaja}}</span>
                        <h3 class="font-bold no-margins">
                            Dinero en caja
                        </h3>
                    </div>
                </div>
        </div>

            
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content shad">
             <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Movimientos consultados</h2>
                </div>
            </div>
                <div class="table-responsive">
                    <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                        <thead>
                        <tr>
                            <th>N Movimiento</th>
                            <th>ID movimiento</th>
                            <th data-hide="phone">Alumno</th>
                            <th data-hide="phone">Folio</th>
                            <th data-hide="phone">Pago</th>
                            <th data-hide="phone">Dia y Hora de consulta</th>
                            <th data-hide="phone">Concepto</th>
                            <th data-hide="phone">Metodo de pago</th>
                            <th data-hide="phone">Registrado por:</th>
                            <!--<th class="text-right">Action</th>-->
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $c = 0;
                        @endphp
                        @foreach ($movimientosCaja as $movimientoCaja)
                        @php
                            $c++;
                        @endphp
                            <tr>
                                <td>
                                {{$c}} 
                                </td>
                                <td>
                                {{$movimientoCaja->id}} 
                                </td>
                                <td>
                                    {{$movimientoCaja->alumno ? $movimientoCaja->alumno->name : $movimientoCaja->otro_alumno}} {{$movimientoCaja->alumno ? $movimientoCaja->alumno->lastName : ''}}
                                </td>
                                <td>
                                    {{$movimientoCaja->folio}}
                                </td>
                                 <td>
                                    {{$movimientoCaja->monto_pago}}
                                </td>
                                <td>
                                    {{$movimientoCaja->created_at}}
                                </td>
                                <td>
                                    {{$movimientoCaja->concepto ? $movimientoCaja->concepto->name : $movimientoCaja->otro_concepto}}
                                </td>

                                 <td>
                                    {{ $movimientoCaja->metodoPago->name }}
                                </td>

                                <td>
                                    {{ $movimientoCaja->cajero->userName }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

@endsection

@extends('saludo')
