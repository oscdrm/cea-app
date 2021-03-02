@extends('layouts.app2')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>CEA APP</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('/adeudos')}}">Adeudos</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Editar adeudo</strong>
                </li>
            </ol>
        </div>
    </div>

<div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

        <div class="ibox-content shad">
            <h4>Editar adeudo</h4>
            <div class="hr-line-dashed"></div>
            @if($errors->any())
                <div class="form-group">
                        @foreach($errors->all() as $error)
                            <p class="alert label-danger">{{$error}}</p>
                        @endforeach
                </div>
            @endif
            <form method="post" action="{{url('adeudos/edit', $adeudo) }}" class="form-horizontal form-disabled" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="col-sm-2 control-label">Alumno</label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona una carrera" name="alumno" class="chosen-select"  tabindex="2">
                            <option value="">Selecciona un alumno</option>
                            @foreach ($alumnos as $alumno)
                                @php
                                    $selected = "";
                                    if($adeudo->alumno){
                                        if($alumno->id == $adeudo->alumno->id){
                                            $selected = "selected";
                                        }
                                    }
                                    
                                @endphp
                                <option {{$selected}} value="{{$alumno->id}}">{{$alumno->name}} {{$alumno->lastName}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Concepto: </label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona una concepto" name="concepto" class="chosen-select"  tabindex="2">
                            <option value="">Selecciona un concepto</option>
                            @foreach ($conceptos as $concepto)
                                @php
                                    $selected = "";
                                    if($adeudo->concepto){
                                        if($concepto->id == $adeudo->concepto->id){
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
                    <label class="col-sm-2 control-label">Monto: </label>
                    <div class="col-sm-10"><input name="monto_pago" type="number" min="0" class="form-control" value="{{old('monto_pago', $adeudo->monto_pago)}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Status: </label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona un status" name="status" class="chosen-select"  tabindex="2">
                            <option value="">Selecciona un status</option>
                            @foreach ($statuses as $status)
                                @php
                                    $selected = "";
                                    if($adeudo->status){
                                        if($status->id == $adeudo->status->id){
                                            $selected = "selected";
                                        }
                                    }
                                    
                                @endphp
                                <option {{$selected}}  value="{{$status->id}}">{{$status->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Nota:</label>
                    <div class="col-sm-10"><input name="nota" type="text" class="form-control" value="{{old('nota', $adeudo->nota)}}"></div>
                </div>

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-9">
                        <a class="btn btn-white" href="{{url('/adeudos')}}">Cancelar</a>
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                </div>

            
            </form>

        </div>


        </div><!--END CONTAINER ROW-->
</div><!--END WRAPER-->

@endsection
