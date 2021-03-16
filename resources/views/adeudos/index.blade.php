@extends('layouts.app2')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading shad">
                <div class="col-lg-9">
                    <h2>Adeudos</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{url('home')}}">Home</a>
                        </li>
                        <li class="active">
                            <strong>Adeudos</strong>
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

                @if($errors->any())
                    <div class="form-group">
                            @foreach($errors->all() as $error)
                                <p class="alert label-danger">{{$error}}</p>
                            @endforeach
                    </div>
                @endif


                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Listado de Adeudos</h5>
                        <div class="ibox-tools">
                            <a class="btn btn-white btn-sm" href="{{ url('adeudos/create') }}">Agregar nuevo adeudo</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>ID adeudo</th>
                                    <th>Alumno</th>
                                    <th>Concepto</th>
                                    <th>Status</th>
                                    <th>Monto de adeudo</th>
                                    <th>Monto restante</th>
                                    <th>Fecha</th>
                                    <th>Acción</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($adeudos as $adeudo)
                                    <tr class="${(i % 2) == 0 ? 'even' : 'odd'}">
                                        <td>
                                            <a href="{{ url('adeudos/edit', $adeudo) }}"> {{ $adeudo->id  }}</a>
                                        </td>
                                        <td>
                                            {{ $adeudo->alumno ? $adeudo->alumno->name." ".$adeudo->alumno->lastName : "" }}
                                        </td>
                                        <td>
                                            {{ $adeudo->concepto ? $adeudo->concepto->name : "" }}
                                        </td>
                                        <td>
                                            {{ $adeudo->status ? $adeudo->status->name : "" }}
                                        </td>
                                        <td>
                                            {{ $adeudo->monto_pago }}
                                        </td>
                                        <td>
                                            {{ $adeudo->monto_restante }}
                                        </td>
                                         <td>
                                            {{ $adeudo->created_at }}
                                        </td>
                                    
                                        <td>
                                            <span class="actions-custom"><a class="yellow" href="{{ url('adeudos/pago', $adeudo) }}"> <i class="fa fa-edit yellow"></i>Pagar </a></span>    
                                            <form style="display:inline" method="post" action="{{ url('adeudos', $adeudo)  }}">
                                                @csrf
                                                {{method_field('DELETE')}}
                                                <button type="submit" title="Eliminar" class="red btn-custom"><i class="fa fa-times red"></i>Eliminar</button>
                                            </form>
                                        </td>
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

    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [],
                language: {
                    search: "Buscar en la tabla:",
                    info:   "Mostrando del _START_ al _END_ de _TOTAL_ alumno",
                    infoEmpty:      "No existen registros, 0 elementos",
                    lengthMenu:    "Mostrar _MENU_ registros",
                    paginate: {
                        first:      "Primero",
                        previous:   "Anterior",
                        next:       "Siguiente",
                        last:       "Ultimo"
                    },
                    emptyTable:     "Aun no existe ningun registro",
                }

            });

        });

    </script>

@endsection