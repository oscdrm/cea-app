<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Image;
use Auth;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($role)
    {   
        $role_id = 0;
        if($role == 'admin' || $role == 'Admin'){
            $role_id = 1;
        }

        if($role == 'cashier' || $role == 'Cashier'){
            $role_id = 2;
        }

        $users = User::where('role_id', '=', $role_id)->paginate(10);
        return view('users/users')->with(compact('users', 'role_id'));
    }

    public function create($role)
    {   
        $role_id = 0;
        if($role == 'admin' || $role == 'Admin'){
            $role_id = 1;
        }

        if($role == 'cashier' || $role == 'Cashier'){
            $role_id = 2;
        }

        return view('users.create')->with(compact('role_id'));
    }

    public function store(Request $request, $role)
    {   

        if($role == 'admin' || $role == 'Admin'){
            $role_id = 1;
        }

        if($role == 'cashier' || $role == 'Cashier'){
            $role_id = 2;
        }

         //Messages
         $messages = [
            'required' => 'Es necesario ingresar un valor para el campo :attribute',
            'alpha' => 'Solo puedes introducir letras para el campo :attribute',
            'min' => 'Debes ingresar al menos :min caracteres en el campo :attribute',
            'digits' => 'Solo puedes ingresar numeros en el campo :attribute',
            'max' => 'No debes ingresar mas :max caracteres en el campo :attribute',
            'email' => 'Debes ingresar un email valido example@example.com',
            'email.unique' => 'El email ingresado ya ha sido registrado'
        ];

        //Validaciones
        $rules = [
            'name' => 'required | min:3',
            'lastName' => 'required | min:3',
            'telephone' => ' max:10',
            'email' => 'email | nullable',
            'username' => 'unique:users'
        ];

        // Validator::make($request, $rules);
        $this->validate($request, $rules, $messages);

        // dd($request->all());
        $user = new User();
        $user->name = $request->input('name');
        $user->lastName = $request->input('lastName');
        $user->telephone = $request->input('telephone');
        $email = $request->input('email');
        $user->email = $email;
        $img_user = $request->file('user_photo');
        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));
        $user->role_id = $role_id;

        if($img_user){

            $user_photo = Image::make($img_user);
            $target = $email.".".$img_user->getClientOriginalExtension();
            $user_photo->resize(200,200);
            $ruta = public_path().'/img/';
            $user_photo->save($ruta.$target);
            $target = 'img/'.$email.".".$img_user->getClientOriginalExtension();
            $user->user_photo = $target;

        }
        $user->save();

        return redirect('/users/'.$role.'/index');
    }
    
    public function edit($role, $id)
    {   
        if($role == 'admin' || $role == 'Admin'){
            $role_id = 1;
        }

        if($role == 'cashier' || $role == 'Cashier'){
            $role_id = 2;
        }

        $user = User::find($id);
        
        return view('users.edit')->with(compact('user', 'role_id'));
    }

    public function update(Request $request, $id)
    {

         //Messages
         $messages = [
            'required' => 'Es necesario ingresar un valor para el campo :attribute',
            'alpha' => 'Solo puedes introducir letras para el campo :attribute',
            'min' => 'Debes ingresar al menos :min caracteres en el campo :attribute',
            'digits' => 'Solo puedes ingresar numeros en el campo :attribute',
            'max' => 'No debes ingresar mas :max caracteres en el campo :attribute',
            'email' => 'Debes ingresar un email valido example@example.com'
        ];

        //Validaciones
        $rules = [
            'name' => 'required | min:3',
            'lastName' => 'min:3',
        ];

        // Validator::make($request, $rules);
        $this->validate($request, $rules, $messages);

        // dd($request->all());
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->lastName = $request->input('lastName');
        $user->telephone = $request->input('telephone');
        $email = $request->input('email');
        $user->email = $email;
        $img_user = $request->file('user_photo');
        $user->userName = $request->input('userName');
        if($request->input('password')){
            $user->password = bcrypt($request->input('password'));
        }

        if($img_user){
            $user_photo = Image::make($img_user);
            $target = $email.".".$img_user->getClientOriginalExtension();
            $user_photo->resize(200,200);
            $ruta = public_path().'/img/';
            $user_photo->save($ruta.$target);
            $target = 'img/'.$email.".".$img_user->getClientOriginalExtension();
            $user->user_photo = $target;

        }
        $user->save();

        return redirect('/users/'.$user->role->name.'/index');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        return back();
    }

}
