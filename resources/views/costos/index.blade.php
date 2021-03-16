@extends('layouts.app2')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading shad">
                <div class="col-lg-9">
                    <h2>Precios oferta educativa</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{url('home')}}">Home</a>
                        </li>
                        <li class="active">
                            <strong>Precios oferta educativa</strong>
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
                        <h5>Listado de Precios</h5>
                        <div class="ibox-tools">
                            <a class="btn btn-white btn-sm" href="{{ url('precios/create') }}">Agregar nuevo precio</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>ID movimiento</th>
                                    <th>Oferta educativa</th>
                                    <th>Concepto</th>
                                    <th>Modalidad</th>
                                    <th>Costo</th>
                                    <th>Acción</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($costosCarrera as $costo)
                                    <tr class="${(i % 2) == 0 ? 'even' : 'odd'}">
                                        <td>
                                            <a href="{{ url('precios/edit', $costo) }}"> {{ $costo->id  }}</a>
                                        </td>
                                        <td>
                                            {{ $costo->carrera ? $costo->carrera->name : '' }}
                                        </td>
                                       <td>
                                            {{ $costo->concepto ? $costo->concepto->name : '' }}
                                        </td>
                                        <td>
                                            {{ $costo->modalidad ? $costo->modalidad->name : '' }}
                                        </td>
                                        <td>
                                            {{ $costo->costo}}
                                        </td>
                                        <td>    
                                            <span class="actions-custom"><a class="yellow" href="{{ url('precios/edit', $costo) }}"> <i class="fa fa-edit yellow"></i>Editar </a></span>
                                            <form style="display:inline" method="post" action="{{ url('precios', $costo)  }}">
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
                    emptyTable:     "Aun no existe ningun registro",
                    lengthMenu:    "Mostrar _MENU_ registros",
                    paginate: {
                        first:      "Primero",
                        previous:   "Anterior",
                        next:       "Siguiente",
                        last:       "Ultimo"
                    }
                }

            });

        });

    </script>

@endsection