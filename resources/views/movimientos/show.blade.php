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

                <div class="form-group required">
                    <label class="col-sm-2 control-label">Alumno</label>
                    <div class="col-sm-10">
                        <input type="text"
                                class="form-control"
                                disabled=""
                                placeholder=""
                                name="nombre"
                                value="{{$movimiento->alumno->name}} {{$movimiento->alumno->lastName}}">
                        <span class="help-block m-b-none">Nombre del alumno</span>
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-sm-2 control-label">Concepto</label>
                    <div class="col-sm-10">
                        <input type="text"
                                class="form-control"
                                disabled=""
                                placeholder=""
                                name="nombre"
                                value="{{$movimiento->concepto ? $movimiento->concepto->name : $movimiento->otro_concepto }}">
                        <span class="help-block m-b-none">Concepto</span>
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-sm-2 control-label">Folio</label>
                    <div class="col-sm-10">
                        <input type="text"
                                class="form-control"
                                disabled=""
                                placeholder=""
                                name="nombre"
                                value="{{$movimiento->folio}}">
                        <span class="help-block m-b-none">Numero de folio</span>
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-sm-2 control-label">Monto:</label>
                    <div class="col-sm-10">
                        <input type="text"
                                class="form-control"
                                disabled=""
                                placeholder=""
                                name="nombre"
                                value="{{$movimiento->monto_pago}}">
                        <span class="help-block m-b-none">Monto del pago</span>
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-sm-2 control-label">Metodo de pago:</label>
                    <div class="col-sm-10">
                        <input type="text"
                                class="form-control"
                                disabled=""
                                placeholder=""
                                name="nombre"
                                value="{{$movimiento->metodoPago->name}}">
                        <span class="help-block m-b-none">Metodo del pago</span>
                    </div>
                </div>

                <div class="form-group required">
                    <label class="col-sm-2 control-label">Adeudo:</label>
                    <div class="col-sm-10">
                        <input type="text"
                                class="form-control"
                                disabled=""
                                placeholder=""
                                name="nombre"
                                value="{{$movimiento->adeudo ? $movimiento->adeudo->concepto->name : ''}}">
                        <span class="help-block m-b-none">Pago de algun adeudo</span>
                    </div>
                </div>
        
               
                <div class="form-group required">
                    <label class="col-sm-2 control-label">Nota:</label>
                    <div class="col-sm-10">
                        <input type="text"
                                class="form-control"
                                disabled=""
                                placeholder=""
                                name="nombre"
                                value="{{$movimiento->nota}}">
                        <span class="help-block m-b-none">Comentarios del pago</span>
                    </div>
                </div>

                @if($movimiento->comprobante_pago != null)
                    <div class="form-group">
                        <div class="lightBoxGallery">
                            <figure>
                            <a href="{{asset($movimiento->comprobante_pago)}}" title="{{asset($movimiento->folio)}}" data-gallery=""><img src="{{asset($movimiento->comprobante_pago)}}"></a>
                            </figure>
                        </div>
                    </div>
                @endif

                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-9">
                        <a class="btn btn-primary" href="{{url('/movimientos/edit/'.$movimiento->id)}}">Editar</a>
                        <a class="btn btn-white" href="{{url('/movimientos')}}">Atras</a>
                    </div>
                </div>

            
            </form>

        </div>


        </div><!--END CONTAINER ROW-->
</div><!--END WRAPER-->

@endsection
