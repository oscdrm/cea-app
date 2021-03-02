<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Alumno;
use App\Carrera;
use App\Modalidad;
use App\TipoInscripcion;
use App\StatusAlumno;
use Carbon\Carbon;
use App\Direccion;
use App\Tutor;
use Image;

class AlumnosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $alumnos = Alumno::orderBy('created_at', 'DESC')->get();
        return view('alumno/index')->with(compact('alumnos'));
    }

    public function create()
    {   
        $carreras = Carrera::all();
        $modalidades = Modalidad::all();
        $tipoInscripciones = TipoInscripcion::all();
        $statuses = StatusAlumno::all();
        return view('alumno.create')->with(compact('carreras', 'modalidades', 'tipoInscripciones', 'statuses'));
    }

    public function store(Request $request)
    {

        //Messages
        $messages = [
            'required' => 'Es necesario ingresar un valor para el campo :attribute',
            'carrera.required' => 'Debes de selecionar una carrera',
            'modalidad.required' => 'Debes de selecionar una modalidad',
            'tipoInscripcion.required' => 'Debes de selecionar una tipo de inscripción',
            'status.required' => 'Debes de selecionar un status',
            'min' => 'Debes ingresar al menos :min caracteres en el campo :attribute',
            'digits' => 'Solo puedes ingresar numeros en el campo :attribute',
            'max' => 'No debes ingresar mas :max caracteres en el campo :attribute',
            'email' => 'Debes ingresar un email valido example@example.com'
        ];

        //Validaciones
        $rules = [
            'name' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'inscription_date' => 'required',
            'carrera' => 'required',
            'modalidad' => 'required',
            'tipoInscripcion' => 'required',
            'status' => 'required'
        ];

        // Validator::make($request, $rules);
        $this->validate($request, $rules, $messages);

        
        // dd($request->all());
        $dt = Carbon::now();

        

        $alumno = new Alumno();
        $alumno->name = $request->input('name');
        $alumno->lastName = $request->input('lastName');
        $email = $request->input('email');
        $alumno->email = $email;
        $alumno->phone = $request->input('phone');
        $alumno->inscription_date = Carbon::createFromFormat('d/m/Y', $request->input('inscription_date'));
        $alumno->carrera_id = $request->input('carrera');
        $alumno->modalidad_id = $request->input('modalidad');
        $alumno->tipo_inscripcion_id = $request->input('tipoInscripcion');
        $alumno->status_alumno_id = $request->input('status');
        $img_alumno = $request->file('photo');
        if($img_alumno){
            $user_photo = Image::make($img_alumno);
            $target = $email.".".$img_alumno->getClientOriginalExtension();
            $user_photo->resize(200,200);
            $ruta = public_path().'/img/alumnos/';
            $user_photo->save($ruta.$target);
            $target = 'img/alumnos/'.$email.".".$img_alumno->getClientOriginalExtension();
            $alumno->photo = $target;
        }
        
        $alumno->save();

        if($request->input('street') && $request->input('colonia')){
            $address = new Direccion();
            $address->calle = $request->input('street');
            $address->numero = $request->input('number');
            $address->colonia = $request->input('colonia');
            $address->cp = $request->input('cp');
            $address->alumno_id = $alumno->id;
            $address->save();
        }  
        
        if($request->input('nameTutor') && $request->input('lastNameTutor')){
            $tutor = new Tutor();
            $tutor->name = $request->input('nameTutor');
            $tutor->lastName = $request->input('lastNameTutor');
            $tutor->email = $request->input('emailTutor');
            $tutor->phone = $request->input('phoneTutor');
            $tutor->alumno_id = $alumno->id;

            $tutor->save();
        }

        return redirect('/alumno');
    }

    public function edit($id)
    {   
        $alumno = Alumno::find($id);
        $carreras = Carrera::all();
        $modalidades = Modalidad::all();
        $tipoInscripciones = TipoInscripcion::all();
        $statuses = StatusAlumno::all();

        $direccion = null;
        if($alumno->direcciones->count() >= 1){
            $direccion = $alumno->direcciones->last();
        }

        $tutor = null;
        if($alumno->tutor){
            $tutor = $alumno->tutor;
        }

        return view('alumno.edit')->with(compact('alumno', 'direccion', 'tutor', 'carreras', 'modalidades', 'tipoInscripciones', 'statuses'));
    }

    public function update(Request $request, $id)
    {

        //Messages
        $messages = [
            'required' => 'Es necesario ingresar un valor para el campo :attribute',
            'carrera.required' => 'Debes de selecionar una carrera',
            'modalidad.required' => 'Debes de selecionar una modalidad',
            'tipoInscripcion.required' => 'Debes de selecionar una tipo de inscripción',
            'status.required' => 'Debes de selecionar un status',
            'min' => 'Debes ingresar al menos :min caracteres en el campo :attribute',
            'digits' => 'Solo puedes ingresar numeros en el campo :attribute',
            'max' => 'No debes ingresar mas :max caracteres en el campo :attribute',
            'email' => 'Debes ingresar un email valido example@example.com'
        ];

        //Validaciones
        $rules = [
            'name' => 'required',
            'lastName' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'inscription_date' => 'required',
            'carrera' => 'required',
            'modalidad' => 'required',
            'tipoInscripcion' => 'required',
            'status' => 'required'
        ];

        // Validator::make($request, $rules);
        $this->validate($request, $rules, $messages);

        
        // dd($request->all());
        $dt = Carbon::now();

        

        $alumno = Alumno::find($id);
        $alumno->name = $request->input('name');
        $alumno->lastName = $request->input('lastName');
        $email = $request->input('email');
        $alumno->email = $email;
        $alumno->phone = $request->input('phone');
        $alumno->inscription_date = Carbon::createFromFormat('Y-m-d', $request->input('inscription_date'));
        $alumno->carrera_id = $request->input('carrera');
        $alumno->modalidad_id = $request->input('modalidad');
        $alumno->tipo_inscripcion_id = $request->input('tipoInscripcion');
        $alumno->status_alumno_id = $request->input('status');

        $img_alumno = $request->file('photo');
        if(!empty($img_alumno)){
            $user_photo = Image::make($img_alumno);
            $target = $email.".".$img_alumno->getClientOriginalExtension();
            $user_photo->resize(200,200);
            $ruta = public_path().'/img/alumnos/';
            $user_photo->save($ruta.$target);
            $target = 'img/alumnos/'.$email.".".$img_alumno->getClientOriginalExtension();
            $alumno->photo = $target;
        }

        $alumno->save();

        if($alumno->direcciones->count() >= 1){
            $dir_id = $alumno->direcciones->last()->id;
            $address = Direccion::find($dir_id);
            $address->calle = $request->input('street');
            $address->numero = $request->input('number');
            $address->colonia = $request->input('colonia');
            $address->cp = $request->input('cp');
            $address->save();
        }else{
            if($request->input('street') && $request->input('colonia')){
                $address = new Direccion();
                $address->calle = $request->input('street');
                $address->numero = $request->input('number');
                $address->colonia = $request->input('colonia');
                $address->cp = $request->input('cp');
                $address->alumno_id = $alumno->id;
                $address->save();
            }  
        }
        
        if(!empty($alumno->tutor)){
            $tutor_id = $alumno->tutor->id;
            $tutor = Tutor::find($tutor_id);  
            $tutor->name = $request->input('nameTutor');
            $tutor->lastName = $request->input('lastNameTutor');
            $tutor->email = $request->input('emailTutor');
            $tutor->phone = $request->input('phoneTutor');
            $tutor->save();          
        }else{
            if($request->input('nameTutor') && $request->input('lastNameTutor')){
                $tutor = new Tutor();
                $tutor->name = $request->input('nameTutor');
                $tutor->lastName = $request->input('lastNameTutor');
                $tutor->email = $request->input('emailTutor');
                $tutor->phone = $request->input('phoneTutor');
                $tutor->alumno_id = $alumno->id;
    
                $tutor->save();
            }
        }
        

        return redirect('/alumno');
    }

    public function delete($id)
    {
        $alumno = Alumno::find($id);
        $alumno->delete();

        return back();
    }

}
