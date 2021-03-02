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
                            <a href="{{url('home')}}">Home</a>
                        </li>
                        <li class="active">
                            <strong>{{$type_user}}</strong>
                        </li>
                    </ol>
                </div>
</div><!-- END SECCION TITULO-->

<div class="wrapper wrapper-content animated fadeInRight">

        <div class="ibox shad">
            <div class="ibox-title">
                <div class="ibox-tools">
                    <a href="{{url('/users/'.$role_name.'/create')}}" class="btn btn-primary btn-xs">Crear nuevo {{$type_user}}</a>
                </div>
            </div>

            <div class="ibox-content">
                <div class="row m-b-sm m-t-sm">
                    
                    <div class="col-md-11">
                        <!--<div class="input-group"><input type="text" placeholder="Introduce el nombre del usuario a buscar" class="input-sm form-control"> <span class="input-group-btn">
                            <button type="button" class="btn btn-sm btn-primary"> Buscar</button> </span></div>-->
                    </div>
                </div>
            </div>

        </div> 

        <div class="row">
            @foreach($users as $user)
                <div class="col-lg-3">
                    <div class="contact-box center-version shad">

                        <a href="profile.html">
                            <img alt="image" class="img-circle" src="{{$user->user_photo ? asset($user->user_photo) : asset('img/profile.jpg')}}">
                            <h3 class="m-b-xs"><strong>{{$user->name}} {{$user->lastName}}</strong></h3>
                            <div class="font-bold">Edad: {{$user->age}}</div>
                            <div class="font-bold">{{$user->email}}</div>
                        </a>
                        <div class="contact-box-footer">
                            <div class="m-t-xs btn-group">
                                <!--<a class="btn btn-xs btn-white">Perfil</a>-->
                                <a href="{{url('/users/'.$role_name.'/'.$user->id.'/edit')}}" class="btn btn-xs btn-white">Editar</a>
                                <form style="display:inline" method="post" action="{{url('/users/'.$user->id)}}">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button type="submit" title="Eliminar" class="btn btn-xs btn-white">Eliminar</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div><!--END COMPONENT-->
            @endforeach

            {{$users->links()}}
        </div><!--END CONTAINER ROW-->
</div><!--END WRAPER-->

@endsection