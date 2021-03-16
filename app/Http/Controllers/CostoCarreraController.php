<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CostoCarrera;
use App\Concepto;
use App\Carrera;
use App\Modalidad;

class CostoCarreraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $costosCarrera = CostoCarrera::All();

        return view('costos/index')->with(compact('costosCarrera'));
    }

    public function create()
    {   
        $conceptos = Concepto::all();
        $carreras = Carrera::all();
        $modalidades = Modalidad::all();
        return view('costos.create')->with(compact('conceptos', 'carreras', 'modalidades'));
    }

    public function store(Request $request)
    {

        //Messages
        $messages = [
            'required' => 'Es necesario ingresar un valor para el campo :attribute',
            'min' => 'Debes ingresar al menos :min caracteres en el campo :attribute',
            'numeric' => 'Solo puedes ingresar numeros en el campo :attribute',
            'max' => 'No debes ingresar mas :max caracteres en el campo :attribute',
            'email' => 'Debes ingresar un email valido example@example.com',
            'unique' => 'Este folio ya se ha registrado anteriormente'
        ];

        //Validaciones
        $rules = [
            'precio' => 'required | numeric',
            'concepto' => 'required',
            'carrera' => 'required'

        ];

        // Validator::make($request, $rules);
        $this->validate($request, $rules, $messages);
        try{
            $precio = new CostoCarrera();
            $precio->concepto_id = $request->input('concepto');
            $precio->carrera_id = $request->input('carrera');
            $precio->modalidad_id = $request->input('modalidad');
            $precio->costo = $request->input('precio');
            
            $precio->save();

        }catch (Exception $e) {
            $errors = [];
            $errors['error'] = $e->getMessage()."\n";;
            return  back()->withErrors($errors);
        }
    
        return redirect('/precios');

    }

    public function edit($id)
    {   
        $costoCarrera = CostoCarrera::find($id);
        $conceptos = Concepto::all();
        $carreras = Carrera::all();
        $modalidades = Modalidad::all();
        return view('costos.edit')->with(compact('conceptos', 'carreras', 'modalidades', 'costoCarrera'));
    }

    public function update(Request $request, $id)
    {
        $costoCarrera = CostoCarrera::find($id);

        $rules = [
            'precio' => 'required | numeric',
            'concepto' => 'required',
            'carrera' => 'required'

        ];

        //Messages
        $messages = [
            'required' => 'Es necesario ingresar un valor para el campo :attribute',
            'surgery_id.required' => 'Debes de selecionar una tienda',
            'min' => 'Debes ingresar al menos :min caracteres en el campo :attribute',
            'digits' => 'Solo puedes ingresar numeros en el campo :attribute',
            'max' => 'No debes ingresar mas :max caracteres en el campo :attribute',
            'email' => 'Debes ingresar un email valido example@example.com',
            'unique' => 'Este folio ya se ha registrado anteriormente'
        ];


        // Validator::make($request, $rules);
        $this->validate($request, $rules, $messages);
        try{
            $precio = CostoCarrera::find($id);
            $precio->concepto_id = $request->input('concepto');
            $precio->carrera_id = $request->input('carrera');
            $precio->modalidad_id = $request->input('modalidad');
            $precio->costo = $request->input('precio');
            
            $precio->save();


        }catch (Exception $e) {
            $errors = [];
            $errors['error'] = $e->getMessage()."\n";
            return  back()->withErrors($errors);
            //echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    
        return redirect('/precios');

    }

    public function delete($id)
    {
        $precio = CostoCarrera::find($id);
        $precio->delete();

        return back();
    }


}
