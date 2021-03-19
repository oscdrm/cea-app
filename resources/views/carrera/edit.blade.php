@extends('layouts.app2')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>CEA APP</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('/carrera')}}">Carrera</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Editar carrera</strong>
                </li>
            </ol>
        </div>
    </div>

<div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

            <div class="ibox-content shad col-12">
                <h4>Editar carrera</h4>
                <div class="hr-line-dashed"></div>
                @if($errors->any())
                    <div class="form-group">
                            @foreach($errors->all() as $error)
                                <p class="alert label-danger">{{$error}}</p>
                            @endforeach
                    </div>
                @endif
                <div class="ibox-content">
                    <form method="post" action="{{url('carrera/edit', $carrera) }}" id="form" class="form-horizontal">
                        @csrf
                
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nombre</label>
                            <div class="col-sm-10">
                                <div class="col-sm-12"><input name="name" type="text" class="form-control" value="{{old('name', $carrera->name)}}"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Descripción</label>
                            <div class="col-sm-10">
                                <div class="col-sm-12"><input name="description" type="text" class="form-control" value="{{old('description', $carrera->description)}}"></div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nivel Academico</label>
                            <div class="col-sm-10">
                                <select data-placeholder="Selecciona un nivel academico" id="NA" name="nivelAcademico" class="chosen-select"  tabindex="2">
                                    <option value="">Selecciona un nivel academico</option>
                                    @foreach ($nivelesAcademicos as $nivelAcademico)
                                        @php
                                            $selected = "";
                                            if($carrera->nivelAcademico){
                                                if($nivelAcademico->id == $carrera->nivelAcademico->id){
                                                    $selected = "selected";
                                                }
                                            }
                                            
                                        @endphp
                                        <option {{$selected}} value="{{$nivelAcademico->id}}">{{$nivelAcademico->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-9">
                                <a class="btn btn-white" href="{{url('/carrera')}}">Cancelar</a>
                                <button class="btn btn-primary" id="save" type="submit">Guardar</button>
                            </div>
                        </div>
                        

                    </form>
                </div>

            </div>


        </div><!--END CONTAINER ROW-->

        
</div><!--END WRAPER-->
@endsection
