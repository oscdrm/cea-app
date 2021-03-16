@extends('layouts.app2')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>CEA APP</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('/movimientos')}}">Adeudos</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Registrar pago de alumno</strong>
                </li>
            </ol>
        </div>
    </div>

<div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

        <div class="ibox-content shad">
            <h4>Registrar pago de aduedo</h4>
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
                    <label class="col-sm-2 control-label">Alumno: </label>
                    <div class="col-sm-10">
                        <input name="" type="text" class="form-control" readonly value="{{$adeudo->alumno->name}} {{$adeudo->alumno->lastName}}">
                        <input name="alumno" type="hidden" class="form-control" readonly value="{{$adeudo->alumno->id}}">
                    </div>
                </div>


               <div class="form-group">
                    <label class="col-sm-2 control-label">Concepto de pago:</label>
                    <div class="col-sm-10">
                        <input name="" type="text" class="form-control" readonly value="{{$adeudo->concepto->name}}">
                        <input name="concepto" type="hidden" class="form-control"  value="{{$adeudo->concepto->id}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Folio:</label>
                    <div class="col-sm-10"><input name="folio" type="text" class="form-control" value="{{old('folio')}}"></div>
                </div>

                 <div class="form-group">
                    <label class="col-sm-2 control-label">Monto a pagar:</label>
                    <div class="col-sm-10">
                        <input name="monto_pago" type="text" class="form-control" readonly value="{{$adeudo->monto_restante}}">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Otra cantidad:</label>
                    <div class="col-sm-10">
                        <input name="monto_pago_otro" type="number" class="form-control"  value="{{old('monto_pago_otro',$adeudo->monto_restante)}}">
                    </div>
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
                    <label class="col-sm-2 control-label">Adeudo de:</label>
                    <div class="col-sm-10">
                        <input name="" type="text" class="form-control" readonly value="{{$adeudo->name}}">
                        <input name="adeudo" type="hidden" class="form-control" readonly value="{{$adeudo->id}}">
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">Nota:</label>
                    <div class="col-sm-10"><input name="nota" type="text" class="form-control" value="{{old('nota')}}"></div>
                </div>

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-9">
                        <a class="btn btn-white" href="{{url('/movimientos')}}">Cancelar</a>
                        <button class="btn btn-primary" type="submit">Pagar</button>
                    </div>
                </div>

            
            </form>

        </div>


        </div><!--END CONTAINER ROW-->
</div><!--END WRAPER-->

@endsection
