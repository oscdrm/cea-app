@extends('layouts.app2')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>CEA APP</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('/concepto')}}">Concepto</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Crear nuevo concepto</strong>
                </li>
            </ol>
        </div>
    </div>

<div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

            <div class="ibox-content shad col-12">
                <h4>Crear nueva concepto</h4>
                <div class="hr-line-dashed"></div>
                @if($errors->any())
                    <div class="form-group">
                            @foreach($errors->all() as $error)
                                <p class="alert label-danger">{{$error}}</p>
                            @endforeach
                    </div>
                @endif
                <div class="ibox-content">
                    <form method="post" action="{{url('/concepto')}}" id="form" class="form-horizontal">
                        @csrf
                
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nombre</label>
                            <div class="col-sm-10">
                                <div class="col-sm-12"><input name="name" type="text" class="form-control" value="{{old('name')}}"></div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Descripción</label>
                            <div class="col-sm-10">
                                <div class="col-sm-12"><input name="description" type="text" class="form-control" value="{{old('description')}}"></div>
                            </div>
                        </div>

                        <br>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-9">
                                <a class="btn btn-white" href="{{url('/concepto')}}">Cancelar</a>
                                <button class="btn btn-primary" id="save" type="submit">Guardar</button>
                            </div>
                        </div>
                        

                    </form>
                </div>

            </div>


        </div><!--END CONTAINER ROW-->

        
</div><!--END WRAPER-->
@endsection
