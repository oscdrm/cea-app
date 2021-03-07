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
                            <strong>Perfil</strong>
                        </li>
                    </ol>
                </div>
</div><!-- END SECCION TITULO-->


<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-4">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>Detalles del alumno: </h5>
                </div>

                <div>
                    <div class="ibox-content no-padding border-left-right">
                        <img alt="image" class="img-responsive" src="{{asset($alumno->photo)}}">
                    </div>

                    <div class="ibox-content profile-content">
                        <h4><strong>{{$alumno->name}} {{$alumno->lastName}}</strong></h4>
                        @if(!empty($direccion))
                            <p><i class="fa fa-map-marker"></i> {{$direccion->calle}} {{$direccion->numero}}  {{$direccion->colonia}} {{$direccion->cp}}</p>
                        @endif
                        <h5>
                            Informacion escolar:
                        </h5>
                        <p>Inscrito/a en: {{$alumno->carrera->name}}</p>
                        <p>
                            Fecha de inscripcion: {{$alumno->inscription_date}}
                        </p>

                        <p>Modalidad: {{$alumno->modalidad->name}}</p>  

                        <p>Tipo de inscripción: {{$alumno->tipoInscripcion->name}}</p>        
                        <p>Status: {{$alumno->status->name}}</p>   

                        <br>

                        <p><b>Tutor:</b></p>
                        <p>Nombre: {{$tutor->name}} {{$tutor->lastName}}</p>
                        <p>email: {{$tutor->email}}</p>
                        <p>Teléfono: {{$tutor->phone}}</p>

                        <div class="user-button">
                            <!--<div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-envelope"></i> Enviar email</button>
                                </div>
                                
                            </div>-->
                        </div>
                    </div>     
                </div>

            </div>
        </div>

        <div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Historial de pagos del alumno</h5>
                </div>
                <div class="ibox-content">
                    <!--principio tabla-->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Concepto</th>
                                <th>Monto</th>
                                <th>Folio</th>
                                <th>Fecha</th>
                                <th>Metodo de pago</th>
                            </tr>
                            </thead>
                        <tbody>
                            @foreach($movimientos as $movimiento)
                                <tr class="${(i % 2) == 0 ? 'gradeX' : 'gradeC'}">
                                    <td>
                                         {{ $movimiento->id  }}
                                    </td>
                                    <td>
                                         {{ $movimiento->concepto ? $movimiento->concepto->name : $movimiento->otro_concepto  }}
                                    </td>
                                    <td>
                                         {{ $movimiento->monto_pago  }}
                                    </td>
                                    <td>
                                         {{ $movimiento->folio ? $movimiento->folio : ''  }}
                                    </td>
                                    <td>
                                         {{ $movimiento->created_at  }}
                                    </td>
                                    <td>
                                         {{ $movimiento->metodoPago ? $movimiento->metodoPago->name : ''  }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                       
                        </table>
                    </div>
                    <!--fin tabla-->
                </div><!--End ibox content-->
            </div><!--End ibox float-e-maring-->
        </div><!--end col md -8-->

    </div><!--end row animated-->
</div><!--wrapper wrapper-content-->

<script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'excel', title: 'Historial de pagos'},
                    {extend: 'pdf', title: 'Historial de pagos'},

                    {extend: 'print',
                    'title': 'Historial de pagos',
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
                    info:   "Mostrando del _START_ al _END_ de _TOTAL_ pagos",
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