<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoInscripcion;

class TipoInscripcionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

        $tiposInscripcion = TipoInscripcion::all();
        return view('tipoInscripcion/index')->with(compact('tiposInscripcion'));
    }

    public function create()
    {   
        return view('tipoInscripcion.create');
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
        $tipoInscripcion = new TipoInscripcion();
        $tipoInscripcion->name = $request->input('name');
        $tipoInscripcion->description = $request->input('description');

        $tipoInscripcion->save();

        return redirect('/tipoInscripcion');
    }

    public function edit($id)
    {   
        $tipoInscripcion = TipoInscripcion::find($id);
        return view('tipoInscripcion.edit')->with(compact('tipoInscripcion'));
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
        $tipoInscripcion = TipoInscripcion::find($id);
        $tipoInscripcion->name = $request->input('name');
        $tipoInscripcion->description = $request->input('description');
    
        $tipoInscripcion->save();

        return redirect('/tipoInscripcion');
    }

    public function delete($id)
    {
        $tipoInscripcion = TipoInscripcion::find($id);
        $tipoInscripcion->delete();

        return back();
    }
}
