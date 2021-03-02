@extends('layouts.app2')
@section('content')
@php
    $type_user = "";
    $role_name = "";
    if($role_id == 1){
        $type_user = "Administrador";
        $role_name ="admin";
    }
    if($role_id == 2){
        $type_user = "Cajero";
        $role_name ="cashier";
    }   
@endphp
<div class="row wrapper border-bottom white-bg page-heading shad">
                <div class="col-lg-9">
                    <h2>{{$type_user}}</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{url('/home')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{url('/users/'.$role_name.'/index')}}">{{$type_user}}</a>
                        </li>
                        <li class="active">
                            <strong>Nuevo {{$type_user}}</strong>
                        </li>
                    </ol>
                </div>
</div><!-- END SECCION TITULO-->

<div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

        <div class="ibox-content shad">
            <h4>Registrar nuevo {{$type_user}}</h4>
            <div class="hr-line-dashed"></div>
            @if($errors->any())
                <div class="form-group">
                        @foreach($errors->all() as $error)
                            <p class="alert label-danger">{{$error}}</p>
                        @endforeach
                </div>
            @endif
            <form method="post" action="{{url('/users/'.$role_name.'/')}}" class="form-horizontal form-disabled" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="col-sm-2 control-label">Sube una imagen</label>
                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="form-control" data-trigger="fileinput">
                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                        <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-default btn-file">
                            <span class="fileinput-new">Select file</span>
                            <span class="fileinput-exists">Cambiar</span>
                            <input type="file" name="user_photo"/>
                        </span>
                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Quitar</a>
                    </div> 
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Nombre(s)</label>
                    <div class="col-sm-10"><input name="name" type="text" class="form-control" value="{{old('name')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Apellidos</label>
                    <div class="col-sm-10"><input name="lastName" type="text" class="form-control" value="{{old('lastName')}}"></div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label">Teléfono</label>
                    <div class="col-sm-10"><input name="telephone" type="number" min="0" class="form-control" value="{{old('telephone')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10"><input name="email" type="text" class="form-control" value="{{old('email')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Nombre de Usuario</label>
                    <div class="col-sm-10"><input name="username" type="text" class="form-control" value="{{old('username')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10"><input name="password" type="password" class="form-control" value=""></div>
                </div>

                <div class="hr-line-dashed"></div>
        
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-9">
                        <a class="btn btn-white" href="{{url('/users/'.$role_name.'/index')}}">Cancelar</a>
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                </div>

            
            </form>

        </div>


        </div><!--END CONTAINER ROW-->
</div><!--END WRAPER-->

@endsection