@extends('layouts.app2')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading shad">
                <div class="col-lg-9">
                    <h2>Alumnos</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{url('home')}}">Home</a>
                        </li>
                        <li class="active">
                            <strong>Alumnos</strong>
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
                        <h5>Listado de Alumnos</h5>
                        <div class="ibox-tools">
                            <a class="btn btn-white btn-sm" href="{{ url('alumno/create') }}">Agregar nuevo alumno</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Teléfono</th>
                                    <th>Fecha inscripción</th>
                                    <th>Nivel Academico</th>
                                    <th>Carrera</th>
                                    <th>Modalidad</th>
                                    <th>Tipo Inscripción</th>
                                    <th>Status</th>
                                    <th>Acción</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $n = 0;
                                @endphp
                                @foreach($alumnos as $alumno)
                                    @php
                                        $n++;
                                    @endphp
                                    <tr class="${(i % 2) == 0 ? 'even' : 'odd'}">
                                        <td>
                                            {{$n}}
                                        </td>
                                        <td>
                                            <a href="{{ url('alumno/profile', $alumno) }}"> {{ $alumno->name  }} {{ $alumno->lastName }}</a>
                                        </td>
                                        <td>
                                            {{ $alumno->email }}
                                        </td>
                                        <td>
                                            {{ $alumno->phone }}
                                        </td>
                                         <td>
                                            {{ $alumno->inscription_date }}
                                        </td>
                                        <td>
                                            {{ $alumno->nivelAcademico ? $alumno->nivelAcademico->name : '' }}
                                        </td>
                                         <td>
                                            {{ $alumno->carrera->name }}
                                        </td>
                                         <td>
                                            {{ $alumno->modalidad->name }}
                                        </td>
                                         <td>
                                            {{ $alumno->tipoInscripcion->name }}
                                        </td>
                                         <td>
                                            {{ $alumno->status->name }}
                                        </td>
                                      
                                        <td>    
                                            <span class="actions-custom"><a class="yellow" href="{{ url('alumno/edit', $alumno) }}"> <i class="fa fa-edit yellow"></i>Editar </a></span>
                                            <form style="display:inline" method="post" action="{{ url('alumno', $alumno)  }}">
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
                buttons: [
                    {extend: 'excel', title: 'Listado de Alumnos'},
                    {extend: 'pdf', title: 'Listado de Alumnos'},
                    {extend: 'print',
                    'title': 'Listado de Alumnos',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ],
                language: {
                    search: "Buscar en la tabla:",
                    info:   "Mostrando del _START_ al _END_ de _TOTAL_ alumno",
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