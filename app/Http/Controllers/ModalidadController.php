<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modalidad;

class ModalidadController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

        $modalidades = Modalidad::all();
        return view('modalidad/index')->with(compact('modalidades'));
    }

    public function create()
    {   
        return view('modalidad.create');
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
        $modalidad = new Modalidad();
        $modalidad->name = $request->input('name');
        $modalidad->description = $request->input('description');

        $modalidad->save();

        return redirect('/modalidad');
    }

    public function edit($id)
    {   
        $modalidad = Modalidad::find($id);
        return view('modalidad.edit')->with(compact('modalidad'));
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
        $modalidad = Modalidad::find($id);
        $modalidad->name = $request->input('name');
        $modalidad->description = $request->input('description');
    
        $modalidad->save();

        return redirect('/modalidad');
    }

    public function delete($id)
    {
        $modalidad = Modalidad::find($id);
        $modalidad->delete();

        return back();
    }
}
