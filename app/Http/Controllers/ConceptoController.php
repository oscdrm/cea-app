<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Concepto;

class ConceptoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

        $conceptos = Concepto::all();
        return view('concepto/index')->with(compact('conceptos'));
    }

    public function create()
    {   
        return view('concepto.create');
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
        $concepto = new Concepto();
        $concepto->name = $request->input('name');
        $concepto->description = $request->input('description');

        $concepto->save();

        return redirect('/concepto');
    }

    public function edit($id)
    {   
        $concepto = Concepto::find($id);
        return view('concepto.edit')->with(compact('concepto'));
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
        $concepto = Concepto::find($id);
        $concepto->name = $request->input('name');
        $concepto->description = $request->input('description');
    
        $concepto->save();

        return redirect('/concepto');
    }

    public function delete($id)
    {
        $concepto = Concepto::find($id);
        $concepto->delete();

        return back();
    }
}
