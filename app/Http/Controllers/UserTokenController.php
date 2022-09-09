<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserTokenController extends Controller
{
    //se usa ya que es un controlador de una unica opcion o una sola funcion
    public function __invoke(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:5',
            'device_name'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->all(), 400);
        }

        $search_user = User::where('email',$request->email)->first();

        if(!$search_user){
            return response()->json(['error' => 'email no existe o no coincide con nuestros datos'], 400);
        }

        if(!Hash::check($request->password, $search_user->password)){
            return response()->json(['error' => 'Contraseña Incorrecta'], 400);
        }
        return response()->json([
            'token'=>$search_user->createToken($request->device_name)->plainTextToken
        ]);
        
    }
    
}
