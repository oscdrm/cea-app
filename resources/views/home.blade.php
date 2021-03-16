@extends('layouts.app2')

@section('content')
<section>
 <div class="row">
    <div class="col-lg-3">
        <div class="ibox float-e-margins shad">
            <div class="ibox-title">
                <span class="label label-success pull-right">Inscritos</span>
                <h5>Total de alumnos inscritos</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">{{$alumnosInscritosCount}}</h1>
                <!--<div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>-->
                <medium></medium>
            </div>
        </div>
    </div>

     <div class="col-lg-3">
        <div class="ibox float-e-margins shad">
            <div class="ibox-title">
                <span class="label label-info pull-right">Activos</span>
                <h5>Total de alumnos activos</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">{{$alumnosActivosCount}}</h1>
                <!--<div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>-->
                <medium></medium>
            </div>
        </div>
    </div>

</div>
</section>

<div class="wrapper wrapper-content animated fadeInRight">
 <div class="row">
    <div class="col-lg-12">
        <div class="col-lg-2">
           <a href="alumno/create">
                <div class="widget lazur-bg p-lg text-center shad">
                    <div class="m-b-md">
                        <i style="margin-bottom:5px;" class="fa fa-user-o fa-4x"></i>
                        <h3 class="font-bold no-margins">
                            Nuevo Alumno
                        </h3>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-2">
            <a href="movimientos/create">
                <div class="widget yellow-bg p-lg text-center shad">
                    <div class="m-b-md">
                        <i style="margin-bottom:5px;" class="fa fa-money fa-4x"></i>
                        <h3 class="font-bold no-margins">
                            Nuevo Pago
                        </h3>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-lg-4">
            <div class="widget navy-bg p-lg text-center shad">
                    <div class="m-b-md">
                        <i class="fa fa-dollar fa-4x"></i> <span style="font-size:55px;">{{$amountToday}}</span>
                        <h3 class="font-bold no-margins">
                            Corte del dia
                        </h3>
                    </div>
                </div>
        </div>

        <div class="col-lg-4">
            <div class="widget blue-bg p-lg text-center shad">
                    <div class="m-b-md">
                        <i class="fa fa-dollar fa-4x"></i> <span style="font-size:55px;">{{$amountWeek}}</span>
                        <h3 class="font-bold no-margins">
                            Corte de la semana
                        </h3>
                    </div>
                </div>
        </div>

            
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
    <div class="col-lg-12">
        <div class="ibox shad">
            <div class="ibox-content">
             <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Ultimos Adeudos</h2>
                </div>
            </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" data-page-size="15">
                        <thead>
                        <tr>
                            <th>ID Adeudo</th>
                            <th>Nombre</th>
                            <th data-hide="phone">Alumno</th>
                            <th data-hide="phone">Concepto</th>
                            <th data-hide="phone">Monto</th>
                            <th data-hide="phone,tablet" >fecha</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($adeudos as $adeudo)
                                    <tr class="${(i % 2) == 0 ? 'even' : 'odd'}">
                                        <td>
                                            <a href="{{ url('adeudos/edit', $adeudo) }}"> {{ $adeudo->id  }}</a>
                                        </td>
                                        <td>
                                            {{ $adeudo->name ? $adeudo->name : "" }}
                                        </td>
                                        <td>
                                            {{ $adeudo->alumno ? $adeudo->alumno->name." ".$adeudo->alumno->lastName : "" }}
                                        </td>
                                        <td>
                                            {{ $adeudo->concepto ? $adeudo->concepto->name : "" }}
                                        </td>
                                        <td>
                                            {{ $adeudo->monto_pago }}
                                        </td>
                                        
                                         <td>
                                            {{ $adeudo->created_at }}
                                        </td>
                                    
                                        <td>    
                                            <span class="actions-custom"><a class="yellow" href="{{ url('adeudos/edit', $adeudo) }}"> <i class="fa fa-edit yellow"></i>Editar </a></span>
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

@extends('saludo')
