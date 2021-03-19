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
                    <strong>Editar alumno</strong>
                </li>
            </ol>
        </div>
    </div>

<div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">

        <div class="ibox-content shad">
            <h4>Editar alumno</h4>
            <div class="hr-line-dashed"></div>
            @if($errors->any())
                <div class="form-group">
                        @foreach($errors->all() as $error)
                            <p class="alert label-danger">{{$error}}</p>
                        @endforeach
                </div>
            @endif
            <form method="post" action="{{url('alumno/edit', $alumno) }}" class="form-horizontal form-disabled" enctype="multipart/form-data">
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
                @if($alumno->photo != null)
                    <div class="form-group">
                        <div style="position:relative;left:300px;width:200px; height:200px;">
                            <figure>
                            <img style="width:100%;" src="{{$alumno->photo ? asset($alumno->photo) : asset('img/profile.jpg')}}">
                            </figure>
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label class="col-sm-2 control-label">Nombre(s)</label>
                    <div class="col-sm-10"><input name="name" type="text" class="form-control" value="{{old('name', $alumno->name)}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Apellidos</label>
                    <div class="col-sm-10"><input name="lastName" type="text" class="form-control" value="{{old('lastName', $alumno->lastName)}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Teléfono</label>
                    <div class="col-sm-10"><input name="phone" type="number" min="0" class="form-control" value="{{old('phone', $alumno->phone)}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10"><input name="email" type="text" class="form-control" value="{{old('email', $alumno->email)}}"></div>
                </div>

                <div class="form-group" id="dc">
                    <label class="font-normal"><strong> Selecciona la fecha de inscripción:</strong></label>
                    <div class="input-group date dc-date ins-date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input id="inscription_date" name="inscription_date" type="text" data-date-format="dd/mm/yyyy" value="{{old('inscription_date', $alumno->inscription_date)}}" class="form-control insd">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Nivel Academico</label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona un nivel academico" id="NA" name="nivelAcademico" class="chosen-select"  tabindex="2">
                            <option value="">Selecciona un nivel academico</option>
                            @foreach ($nivelesAcademicos as $nivelAcademico)
                                @php
                                    $selected = "";
                                    if($alumno->nivelAcademico){
                                        if($nivelAcademico->id == $alumno->nivelAcademico->id){
                                            $selected = "selected";
                                        }
                                    }
                                    
                                @endphp
                                <option {{$selected}} value="{{$nivelAcademico->id}}">{{$nivelAcademico->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Oferta Educativa</label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona una oferta educativa" id="carrera" name="carrera" class="chosen-select"  tabindex="2">
                            <option value="">Selecciona una oferta educativa</option>
                            @foreach ($carreras as $carrera)
                                @php
                                    $selected = "";
                                    if($alumno->carrera){
                                        if($carrera->id == $alumno->carrera->id){
                                            $selected = "selected";
                                        }
                                    }
                                    
                                @endphp
                                <option {{$selected}} value="{{$carrera->id}}">{{$carrera->name}}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Modalidad</label>
                    <div class="col-sm-10">
                        <select data-placeholder="Selecciona una modalidad" name="modalidad" class="chosen-select"  tabindex="2">
                            <option value="">Selecciona una modalidad</option>
                                @foreach ($modalidades as $modalidad)
                                    @php
                                        $selected = "";
                                        if($alumno->modalidad){
                                            if($modalidad->id == $alumno->modalidad->id){
                                                $selected = "selected";
                                            }
                                        }
                                        
                                    @endphp
                                    <option {{$selected}} value="{{$modalidad->id}}">{{$modalidad->name}}</option>
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
                                    @php
                                        $selected = "";
                                        if($alumno->tipoInscripcion){
                                            if($tI->id == $alumno->tipoInscripcion->id){
                                                $selected = "selected";
                                            }
                                        }
                                        
                                    @endphp
                                    <option {{$selected}} value="{{$tI->id}}">{{$tI->name}}</option>
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
                                        
                                            @if(count($descuentosAlumno) > 0)
                                                @foreach ($descuentosAlumno as $descuentoAlumno)
                                                    @php
                                                        if($descuento->id == $descuentoAlumno->id){
                                                            $selected = "selected";
                                                            echo '<option '.$selected.' value="'.$descuento->id.'">'.$descuento->name.'</option>';
                                                        }
                                                    @endphp
                                                @endforeach
                                            @endif
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
                                        @php
                                        $selected = "";
                                        if($alumno->status){
                                            if($status->id == $alumno->status->id){
                                                $selected = "selected";
                                            }
                                        }
                                        
                                    @endphp
                                    <option {{$selected}} value="{{$status->id}}">{{$status->name}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>

    <!-- =============================== BEGIN Address =============================================-->


                <div class="hr-line-dashed"></div>
                <h5>Dirección</h5>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Calle</label>
                    <div class="col-sm-10"><input name="street" type="text" class="form-control" value="{{old('street', $direccion ? $direccion->calle : '')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Numero</label>
                    <div class="col-sm-10"><input name="number" type="text" class="form-control" value="{{old('street', $direccion ? $direccion->numero : '')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Colonia</label>
                    <div class="col-sm-10"><input name="colonia" type="text" class="form-control" value="{{old('street', $direccion ? $direccion->colonia : '')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Codigo Postal</label>
                    <div class="col-sm-10"><input name="cp" type="text" class="form-control" value="{{old('street', $direccion ? $direccion->cp : '')}}"></div>
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
                @if($tutor)
                @if($tutor->photo != null)
                    <div class="form-group">
                        <div style="position:relative;left:300px;width:200px; height:200px;">
                            <figure>
                            <img style="width:100%;" src="{{asset($tutor->photo)}}">
                            </figure>
                        </div>
                    </div>
                @endif
                @endif

                <div class="form-group">
                    <label class="col-sm-2 control-label">Nombre(s)</label>
                    <div class="col-sm-10"><input name="nameTutor" type="text" class="form-control" value="{{old('nameTutor', $tutor ? $tutor->name : '')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Apellidos</label>
                    <div class="col-sm-10"><input name="lastNameTutor" type="text" class="form-control" value="{{old('lastNameTutor', $tutor ? $tutor->lastName : '')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Teléfono</label>
                    <div class="col-sm-10"><input name="phoneTutor" type="number" min="0" class="form-control" value="{{old('phoneTutor', $tutor ? $tutor->phone : '')}}"></div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10"><input name="emailTutor" type="text" class="form-control" value="{{old('emailTutor', $tutor ? $tutor->email : '')}}"></div>
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

<script>
        $(document).ready(function(){

            
            

        });
</script>

@endsection

@section('additional_scripts')
    <script src="{{asset('js/ajax/OE.js')}}"></script>
@endsection