<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class LoginController extends Controller
{

    

    function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $result = Registration::where(['user_name'=> $username, 'password'=> $password])->count();
        if ($result==1) {
            $key = env('TOKEN_KEY');
            $payload = array(
                "site" => "http://demo.com",
                "user" =>  $username,
                "iat" => time(),
                "exp" => time()+300
            );
            $jwt = JWT::encode($payload, $key, 'HS256');
            return response()->json(['status'=>"Login Success", 'access_token'=>$jwt]) ;

        } else{
            return "wrong username or password";
        }
    }
}
