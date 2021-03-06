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
                    <strong>Registrar nuevo movimiento</strong>
                </li>
            </ol>
        </div>
    </div>

<div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

        <div class="ibox-content shad">
            <h4>Registrar nuevo movimiento</h4>
            <div class="hr-line-dashed"></div>
            @if($errors->any())
                <div class="form-group">
                        @foreach($errors->all() as $error)
                            <p class="alert label-danger">{{$error}}</p>
                        @endforeach
                </div>
            @endif
            <form method="post" action="{{url('/movimientos')}}" class="form-horizontal form-disabled" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="col-sm-2 control-label">Alumno</label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona una carrera" name="alumno" class="chosen-select"  tabindex="2">
                            <option value="">Selecciona un alumno</option>
                            @foreach ($alumnos as $alumno)
                                <option value="{{$alumno->id}}">{{$alumno->name}} {{$alumno->lastName}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Otro: </label>
                    <div class="col-sm-10"><input name="otro_alumno" type="text" class="form-control" value="{{old('otro_alumno')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Concepto: </label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona una carrera" name="concepto" class="chosen-select"  tabindex="2">
                            <option value="">Selecciona un concepto</option>
                            @foreach ($conceptos as $concepto)
                                <option value="{{$concepto->id}}">{{$concepto->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Otro concepto: </label>
                    <div class="col-sm-10"><input name="otro_concepto" type="text" class="form-control" value="{{old('otro_concepto')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Folio:</label>
                    <div class="col-sm-10"><input name="folio" type="text" class="form-control" value="{{old('folio')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Monto: </label>
                    <div class="col-sm-10"><input name="monto_pago" type="number" min="0" class="form-control" value="{{old('monto_pago')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Metodo de pago: </label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona una metodo de pago" name="metodo_pago" class="chosen-select"  tabindex="2">
                            <option value="">Selecciona un metodo de pago</option>
                            @foreach ($metodosPago as $metodoPago)
                                <option value="{{$metodoPago->id}}">{{$metodoPago->name}}</option>
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
                                <option value="{{$adeudo->id}}">{{$adeudo->concepto->name}} del alumno {{$adeudo->alumno->name}} {{$adeudo->alumno->lastName}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Nota:</label>
                    <div class="col-sm-10"><input name="nota" type="text" class="form-control" value="{{old('nota')}}"></div>
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
