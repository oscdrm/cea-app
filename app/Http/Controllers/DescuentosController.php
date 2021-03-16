<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Descuento;
use App\Concepto;

class DescuentosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

        $descuentos = Descuento::all();
        return view('descuento/index')->with(compact('descuentos'));
    }

    public function create()
    {   
        $conceptos = Concepto::all();
        return view('descuento.create')->with(compact('conceptos'));
    }

    public function store(Request $request)
    {

        //Messages
        $messages = [
            'required' => 'Es necesario ingresar un valor para el campo :attribute',
            'min' => 'Solo puedes elegir entre 0 y 100 para el campo % de descuento',
            'numeric' => 'Solo puedes ingresar numeros en el campo :attribute',
            'max' => 'Solo puedes elegir entre 0 y 100 para el campo % de descuento',
        ];

        //Validaciones
        $rules = [
            'name' => 'required | min:3',
            'description' => 'required',
            'discount' => 'required | numeric|min:0|max:100'
        ];

        // Validator::make($request, $rules);
        $this->validate($request, $rules, $messages);

        // dd($request->all());
        $descuento = new Descuento();
        $descuento->name = $request->input('name');
        $descuento->description = $request->input('description');
        $descuento->discount = $request->input('discount');
        $descuento->concepto_id = $request->input('concepto');
        $activo = $request->input('activo');

        if($activo == "on"){
            $activo = true;
        }else{
            $activo = false;
        }
        $descuento->activo = $activo;
        $descuento->save();

        return redirect('/descuento');
    }

    public function edit($id)
    {   
        $descuento = Descuento::find($id);
        $conceptos = Concepto::all();
        return view('descuento.edit')->with(compact('descuento', 'conceptos'));
    }

    public function update(Request $request, $id)
    {

         //Messages
        $messages = [
            'required' => 'Es necesario ingresar un valor para el campo :attribute',
            'min' => 'Solo puedes elegir entre 0 y 100 para el campo % de descuento',
            'numeric' => 'Solo puedes ingresar numeros en el campo :attribute',
            'max' => 'Solo puedes elegir entre 0 y 100 para el campo % de descuento',
        ];

        //Validaciones
        $rules = [
            'name' => 'required | min:3',
            'description' => 'required',
            'discount' => 'required | numeric|min:0|max:100'
        ];

        // Validator::make($request, $rules);
        $this->validate($request, $rules, $messages);
        
        // dd($request->all());
        $descuento = Descuento::find($id);
        $descuento->name = $request->input('name');
        $descuento->description = $request->input('description');
        $descuento->discount = $request->input('discount');
        $descuento->concepto_id = $request->input('concepto');
        $activo = $request->input('activo');

        if($activo == "on"){
            $activo = true;
        }else{
            $activo = false;
        }
        $descuento->activo = $activo;
        $descuento->save();

        return redirect('/descuento');
    }

    public function delete($id)
    {
        $descuento = Descuento::find($id);
        $descuento->delete();

        return back();
    }
}
