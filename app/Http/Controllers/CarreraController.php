<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Carrera;
use App\NivelAcademico;

class CarreraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

        $carreras = Carrera::all();
        $nivelesAcademicos = NivelAcademico::all();
        return view('carrera/index')->with(compact('carreras', 'nivelesAcademicos'));
    }

    public function create()
    {   
        $nivelesAcademicos = NivelAcademico::all();
        return view('carrera.create')->with(compact('nivelesAcademicos'));
    }

    public function store(Request $request)
    {

        //Messages
        $messages = [
            'required' => 'Es necesario ingresar un valor para el campo :attribute',
            'min' => 'Debes ingresar al menos :min caracteres en el campo :attribute',
            'digits' => 'Solo puedes ingresar numeros en el campo :attribute',
            'max' => 'No debes ingresar mas :max caracteres en el campo :attribute',
        ];

        //Validaciones
        $rules = [
            'name' => 'required | min:3',
            'description' => 'required'
        ];

        // Validator::make($request, $rules);
        $this->validate($request, $rules, $messages);

        // dd($request->all());
        $carrera = new Carrera();
        $carrera->name = $request->input('name');
        $carrera->description = $request->input('description');
        $carrera->nivel_academico_id = $request->input('nivelAcademico');

        $carrera->save();

        return redirect('/carrera');
    }

    public function edit($id)
    {   
        $carrera = Carrera::find($id);
        $nivelesAcademicos = NivelAcademico::all();
        return view('carrera.edit')->with(compact('carrera', 'nivelesAcademicos'));
    }

    public function update(Request $request, $id)
    {

         //Messages
         $messages = [
            'required' => 'Es necesario ingresar un valor para el campo :attribute',
            'min' => 'Debes ingresar al menos :min caracteres en el campo :attribute',
            'digits' => 'Solo puedes ingresar numeros en el campo :attribute',
            'max' => 'No debes ingresar mas :max caracteres en el campo :attribute'
        ];

        //Validaciones
        $rules = [
            'name' => 'required | min:3'
        ];

        // Validator::make($request, $rules);
        $this->validate($request, $rules, $messages);
        
        // dd($request->all());
        $carrera = Carrera::find($id);
        $carrera->name = $request->input('name');
        $carrera->description = $request->input('description');
        $carrera->nivel_academico_id = $request->input('nivelAcademico');
    
        $carrera->save();

        return redirect('/carrera');
    }

    public function delete($id)
    {
        $carrera = Carrera::find($id);
        $carrera->delete();

        return back();
    }

    public function getByNivelAcademico($id){
        
        $carreras = Carrera::where('nivel_academico_id', '=', $id)->get();
        $retArray = [];
        if(!$carreras){
            $retArray = ['data' => ''];
            return response()->json($retArray);
        }

        $retArray = ['data' => $carreras];
        return response()->json($retArray);

    }

}   
