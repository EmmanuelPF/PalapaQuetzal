<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function Usuarios(){
        return User::all();
    }

    public function EliminarUsuario(Request $request){
        $usuario = User::find($request['id']);
        if($usuario->id == 1 || $usuario->id == 2){
            return response("Eliminacion no permitida",500);
        }else{
            $usuario->delete();
            return response("Hecho", 200);
        }
    }

    public function ActualizarContraseña(Request $request){
        $usuario = User::find($request['id']);
        if (Hash::check($request['ContraActual'],$usuario->password)) {
            $usuario->password = bcrypt($request['ContraNueva']);
            $usuario->save();
        }else{
            return response(["state" => "contraseña no cambiada",[$usuario->password,$request['ContraNueva']]], 200);
        }
        return response(["state" => [$request['ContraNueva']]], 200);
    } // este no

    public function actualizarUsuario(Request $request){
        $userdata = [
            'id' => $request->id,
            'name' => $request->name ? $request->name : null,
            'email' => $request->email ? $request->email : null,
            'password' => $request->password ? bcrypt($request->password): null,
        ];

        $user = User::find($request['id']);

        foreach ($userdata as $key => $value) {
            if ($value) {
                $user[$key] = $value;
            }
        }
        
        $user->save();
        return response(["state" => $user], 200); 
    }
}

