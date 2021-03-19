@extends('layouts.app2')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>CEA APP</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url('/alumno')}}">Alumnos</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Registrar nuevo alumno</strong>
                </li>
            </ol>
        </div>
    </div>

<div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

        <div class="ibox-content shad">
            <h4>Registrar nuevo alumno</h4>
            <div class="hr-line-dashed"></div>
            @if($errors->any())
                <div class="form-group">
                        @foreach($errors->all() as $error)
                            <p class="alert label-danger">{{$error}}</p>
                        @endforeach
                </div>
            @endif
            <form method="post" action="{{url('/alumno')}}" class="form-horizontal form-disabled" enctype="multipart/form-data">
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
                            <input type="file" name="photo"/>
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
                    <div class="col-sm-10"><input name="phone" type="number" min="0" class="form-control" value="{{old('phone')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10"><input name="email" type="text" class="form-control" value="{{old('email')}}"></div>
                </div>

                <div class="form-group" id="dc">
                    <label class="font-normal"><strong> Selecciona la fecha de inscripción:</strong></label>
                    <div class="input-group date dc-date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="inscription_date" name="inscription_date" type="text" data-date-format="dd/mm/yyyy" class="form-control dci">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Nivel Academico</label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona un nivel academico" id="NA" name="nivelAcademico" class="chosen-select"  tabindex="2">
                            <option value="">Selecciona un nivel academico</option>
                            @foreach ($nivelesAcademicos as $nivelAcademico)
                                <option value="{{$nivelAcademico->id}}">{{$nivelAcademico->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Oferta Educativa</label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona una oferta educativa" id="carrera" name="carrera" class="chosen-select carrera"  tabindex="2">
                            <option value="">Selecciona una oferta educativa</option>
                            
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Modalidad</label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona una modalidad" name="modalidad" class="chosen-select"  tabindex="2">
                            <option value="">Selecciona una modalidad</option>
                            @foreach ($modalidades as $modalidad)
                                <option value="{{$modalidad->id}}">{{$modalidad->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Tipo de Inscripción</label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona una tipo de inscripción" name="tipoInscripcion" class="chosen-select"  tabindex="2">
                            <option value="">Selecciona un tipo de inscripcion</option>
                            @foreach ($tipoInscripciones as $tI)
                                <option value="{{$tI->id}}">{{$tI->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                                <label class="col-sm-2 control-label">Descuentos</label>
                                <div class="col-sm-10">
                                    <select data-placeholder="Selecciona un descuento" name="descuentos[]" id="descuentos" class="chosen-select" multiple  tabindex="2">
                                        <option value="">Selecciona un descuento</option>
                                        @foreach ($descuentos as $descuento)
                                            <option value="{{$descuento->id}}">{{$descuento->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Status</label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona un status" name="status" class="chosen-select"  tabindex="2">
                            <option value="">Selecciona un status</option>
                            @foreach ($statuses as $status)
                                <option value="{{$status->id}}">{{$status->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

    <!-- =============================== BEGIN Address =============================================-->


                <div class="hr-line-dashed"></div>
                <h5>Dirección</h5>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Calle</label>
                    <div class="col-sm-10"><input name="street" type="text" class="form-control"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Numero</label>
                    <div class="col-sm-10"><input name="number" type="text" class="form-control"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Colonia</label>
                    <div class="col-sm-10"><input name="colonia" type="text" class="form-control"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Codigo Postal</label>
                    <div class="col-sm-10"><input name="cp" type="text" class="form-control"></div>
                </div>

                <!-- =============================== BEGIN TUTOR =============================================-->
                
                <div class="hr-line-dashed"></div>
                <h5>Tutor</h5>

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
                            <input type="file" name="photo_tutor"/>
                        </span>
                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Quitar</a>
                    </div> 
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Nombre(s)</label>
                    <div class="col-sm-10"><input name="nameTutor" type="text" class="form-control" value="{{old('name')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Apellidos</label>
                    <div class="col-sm-10"><input name="lastNameTutor" type="text" class="form-control" value="{{old('lastName')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Teléfono</label>
                    <div class="col-sm-10"><input name="phoneTutor" type="number" min="0" class="form-control" value="{{old('telephone')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10"><input name="emailTutor" type="text" class="form-control" value="{{old('email')}}"></div>
                </div>


                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-9">
                        <a class="btn btn-white" href="{{url('/alumno')}}">Cancelar</a>
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                </div>

            
            </form>

        </div>


        </div><!--END CONTAINER ROW-->
</div><!--END WRAPER-->

@endsection

@section('additional_scripts')
    <script src="{{asset('js/ajax/OE.js')}}"></script>
@endsection
