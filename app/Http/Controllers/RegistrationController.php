<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registration;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    function registration(Request $request)
    {
        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $city = $request->input('city');
        $email = $request->input('email');
        $username = $request->input('username');
        $gender = $request->input('gender');
        $password = $request->input('password');

        $count = Registration::where('user_name', $username)->count();
        if ($count != 0) {
          return "User Already exists!";
        } else{
            $result = DB::table('registration')->insert([
                'first_name' =>  $firstName ,
                'last_name' =>  $lastName,
                'email' => $email,
                'city' =>  $city,
                'user_name' => $username,
                'gender' =>  $gender,
                'password' => $password 
            ]);
            
            if ($result) {
                return "User registered successfully!";
            } else{
                return "User registered due to error!";
            }
        }
    }
}
