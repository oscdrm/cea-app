@extends('layouts.app2')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>CEA APP</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('/precios')}}">Precios Oferta educativa</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Editar precio</strong>
                </li>
            </ol>
        </div>
    </div>

<div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

        <div class="ibox-content shad">
            <h4>Editar precio</h4>
            <div class="hr-line-dashed"></div>
            @if($errors->any())
                <div class="form-group">
                        @foreach($errors->all() as $error)
                            <p class="alert label-danger">{{$error}}</p>
                        @endforeach
                </div>
            @endif
            <form method="post" action="{{url('precios/edit', $costoCarrera) }}" class="form-horizontal form-disabled" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="col-sm-2 control-label">Oferta educativa</label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona una opción" name="carrera" class="chosen-select"  tabindex="2">
                            <option value="">Selecciona una opción</option>
                            @foreach ($carreras as $carrera)
                                @php
                                    $selected = "";
                                    if($costoCarrera->carrera){
                                        if($carrera->id == $costoCarrera->carrera->id){
                                            $selected = "selected";
                                        }
                                    }
                                    
                                @endphp
                                <option {{$selected}} value="{{$carrera->id}}">{{$carrera->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

               <div class="form-group">
                    <label class="col-sm-2 control-label">Concepto: </label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona un concepto" name="concepto" class="chosen-select"  tabindex="2">
                            <option value="">Selecciona un concepto</option>
                            @foreach ($conceptos as $concepto)
                                @php
                                    $selected = "";
                                    if($costoCarrera->concepto){
                                        if($concepto->id == $costoCarrera->concepto->id){
                                            $selected = "selected";
                                        }
                                    }
                                    
                                @endphp
                                <option {{$selected}} value="{{$concepto->id}}">{{$concepto->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                 <div class="form-group">
                    <label class="col-sm-2 control-label">Modalidad: </label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona una modalidad" name="modalidad" class="chosen-select"  tabindex="2">
                            <option value="">Selecciona un concepto</option>
                            @foreach ($modalidades as $modalidad)
                                @php
                                    $selected = "";
                                    if($costoCarrera->modalidad){
                                        if($modalidad->id == $costoCarrera->modalidad->id){
                                            $selected = "selected";
                                        }
                                    }
                                    
                                @endphp
                                <option {{$selected}} value="{{$modalidad->id}}">{{$modalidad->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Precio: </label>
                    <div class="col-sm-10"><input name="precio" type="number" min="0" class="form-control" value="{{old('precio', $costoCarrera->costo)}}"></div>
                </div>

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-9">
                        <a class="btn btn-white" href="{{url('/precios')}}">Cancelar</a>
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                </div>

            
            </form>

        </div>


        </div><!--END CONTAINER ROW-->
</div><!--END WRAPER-->

@endsection
