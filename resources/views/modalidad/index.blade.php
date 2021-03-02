@extends('layouts.app2')
@section('content')

<div class="row wrapper border-bottom white-bg page-heading shad">
                <div class="col-lg-9">
                    <h2>Modalidad</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{url('home')}}">Home</a>
                        </li>
                        <li class="active">
                            <strong>Modalidad</strong>
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
                        <h5>Listado de Modalidades</h5>
                        <div class="ibox-tools">
                            <a class="btn btn-white btn-sm" href="{{ url('modalidad/create') }}">Agregar nueva Modalidad</a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Fecha de Creación</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($modalidades as $modalidad)
                                    <tr class="${(i % 2) == 0 ? 'even' : 'odd'}">
                                        <td>
                                            <a href="{{ url('modalidad/edit', $modalidad) }}"> {{ $modalidad->name  }} </a>
                                        </td>
                                        <td>
                                            {{ $modalidad->description }}
                                        </td>
                                        <td>
                                            {{ $modalidad->created_at }}
                                        </td>

                                        <td>    
                                            <span class="actions-custom"><a class="yellow" href="{{ url('modalidad/edit', $modalidad) }}"> <i class="fa fa-edit yellow"></i>Editar </a></span>
                                            <form style="display:inline" method="post" action="{{ url('modalidad', $modalidad)  }}">
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

@endsection