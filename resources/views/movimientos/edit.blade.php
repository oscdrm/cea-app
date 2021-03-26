@extends('layouts.app2')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>CEA APP</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('/movimientos')}}">Movimientos</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Editar movimiento</strong>
                </li>
            </ol>
        </div>
    </div>

<div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

        <div class="ibox-content shad">
            <h4>Editar movimiento</h4>
            <div class="hr-line-dashed"></div>
            @if($errors->any())
                <div class="form-group">
                        @foreach($errors->all() as $error)
                            <p class="alert label-danger">{{$error}}</p>
                        @endforeach
                </div>
            @endif
            <form method="post" action="{{url('movimientos/edit', $movimiento) }}" class="form-horizontal form-disabled" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="col-sm-2 control-label">Alumno</label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona una carrera" name="alumno" class="chosen-select"  tabindex="2">
                            <option value="">Selecciona un alumno</option>
                            @foreach ($alumnos as $alumno)
                                @php
                                    $selected = "";
                                    if($movimiento->alumno){
                                        if($alumno->id == $movimiento->alumno->id){
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
                    <label class="col-sm-2 control-label">Otro: </label>
                    <div class="col-sm-10"><input name="otro_alumno" type="text" class="form-control" value="{{old('otro_alumno', $movimiento->otro_alumno)}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Concepto: </label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona una concepto" name="concepto" class="chosen-select"  tabindex="2">
                            <option value="">Selecciona un concepto</option>
                            @foreach ($conceptos as $concepto)
                                @php
                                    $selected = "";
                                    if($movimiento->concepto){
                                        if($concepto->id == $movimiento->concepto->id){
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
                    <label class="col-sm-2 control-label">Otro concepto: </label>
                    <div class="col-sm-10"><input name="otro_concepto" type="text" class="form-control" value="{{old('otro_concepto', $movimiento->otro_concepto)}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Folio:</label>
                    <div class="col-sm-10"><input name="folio" type="text" class="form-control" value="{{old('folio', $movimiento->folio)}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Monto: </label>
                    <div class="col-sm-10"><input name="monto_pago" type="number" min="0" class="form-control" value="{{old('monto_pago', $movimiento->monto_pago)}}"></div>
                </div>
        
                <div class="form-group">
                    <label class="col-sm-2 control-label">Metodo de pago: </label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona una metodo de pago" name="metodo_pago" class="chosen-select"  tabindex="2">
                            <option value="">Selecciona un metodo de pago</option>
                            @foreach ($metodosPago as $metodoPago)
                                @php
                                    $selected = "";
                                    if($movimiento->metodoPago){
                                        if($metodoPago->id == $movimiento->metodoPago->id){
                                            $selected = "selected";
                                        }
                                    }
                                    
                                @endphp
                                <option {{$selected}}  value="{{$metodoPago->id}}">{{$metodoPago->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Adeudo: </label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona un adeudo de alumno" name="adeudo" class="chosen-select"  tabindex="2">
                            <option value="">Selecciona un adeudo de alumno</option>
                            @foreach ($adeudos as $adeudo)
                                @php
                                    $selected = "";
                                    if($movimiento->adeudo){
                                        if($adeudo->id == $movimiento->adeudo->id){
                                            $selected = "selected";
                                        }
                                    }
                                    
                                @endphp
                                <option {{$selected}} value="{{$adeudo->id}}">{{$adeudo->concepto->name}} del alumno {{$adeudo->alumno->name}} {{$adeudo->alumno->lastName}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Nota:</label>
                    <div class="col-sm-10"><input name="nota" type="text" class="form-control" value="{{old('nota', $movimiento->nota)}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Comprobante de pago:</label>
                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="form-control" data-trigger="fileinput">
                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                        <span class="fileinput-filename"></span>
                        </div>
                        <span class="input-group-addon btn btn-default btn-file">
                            <span class="fileinput-new">Select file</span>
                            <span class="fileinput-exists">Cambiar</span>
                            <input type="file" name="comprobante_pago"/>
                        </span>
                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Quitar</a>
                    </div> 
                </div>
                @if($movimiento->comprobante_pago != null)
                    <div class="form-group">
                        <div style="position:relative;left:300px;width:200px;">
                            <figure>
                            <img style="width:100%;" src="{{asset($movimiento->comprobante_pago)}}">
                            </figure>
                        </div>
                    </div>
                @endif

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-9">
                        <a class="btn btn-white" href="{{url('/movimientos')}}">Cancelar</a>
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                </div>

            
            </form>

        </div>


        </div><!--END CONTAINER ROW-->
</div><!--END WRAPER-->

@endsection
