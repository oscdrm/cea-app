@extends('layouts.app2')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading shad">
                <div class="col-lg-9">
                    <h2>Movimientos</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{url('home')}}">Home</a>
                        </li>
                        <li class="active">
                            <strong>Movimientos</strong>
                        </li>
                    </ol>
                </div>
</div><!-- END SECCION TITULO-->

  <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content">

                @if(Session::has('mensaje'))
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        {{ Session::get('mensaje') }}
                    </div>
                @endif


                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Listado de Movimientos</h5>
                        <div class="ibox-tools">
                            <a class="btn btn-white btn-sm" href="{{ url('movimientos/create') }}">Agregar nuevo movimiento</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID movimiento</th>
                                    <th>Alumno</th>
                                    <th>Folio</th>
                                    <th>Pago</th>
                                    <th>Fecha y Hora</th>
                                    <th>Concepto</th>
                                    <th>Metodo de pago</th>
                                    <th>Registrado por:</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($movimientos as $movimiento)
                                    <tr class="${(i % 2) == 0 ? 'even' : 'odd'}">
                                        <td>
                                            <a href="{{ url('movimientos/edit', $movimiento) }}"> {{ $movimiento->id  }}</a>
                                        </td>
                                        <td>
                                            {{ $movimiento->alumno ? $movimiento->alumno->name." ".$movimiento->alumno->lastName : $movimiento->otro_alumno }}
                                        </td>
                                        <td>
                                            {{ $movimiento->folio }}
                                        </td>
                                        <td>
                                            {{ $movimiento->monto_pago }}
                                        </td>
                                         <td>
                                            {{ $movimiento->created_at }}
                                        </td>
                                         <td>
                                            {{ $movimiento->concepto ? $movimiento->concepto->name : $movimiento->otro_concepto }}
                                        </td>
                                         <td>
                                            {{ $movimiento->metodoPago->name }}
                                        </td>
                                         <td>
                                            {{ $movimiento->cajero->userName }}
                                        </td>
                                        
                                      @if(auth()->user()->role->id == 1)
                                        <td>    
                                            <span class="actions-custom"><a class="yellow" href="{{ url('movimientos/edit', $movimiento) }}"> <i class="fa fa-edit yellow"></i>Editar </a></span>
                                            <form style="display:inline" method="post" action="{{ url('movimientos', $movimiento)  }}">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit" title="Eliminar" class="red btn-custom"><i class="fa fa-times red"></i>Eliminar</button>
                                            </form>
                                        </td>
                                       @endif
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="ibox-tools">
                                <div class="pagination">
                                    {{--
                                        <g:paginate total="${categoriaCount ?: 0}" />
                                    --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection