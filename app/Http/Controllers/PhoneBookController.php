<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use App\Models\PhonBookDetail;

class PhoneBookController extends Controller
{
   function store(Request $request)
   {
        $token = $request->input('access_token');
        $key = env('TOKEN_KEY');
        $decoded = JWT::decode($token, $key,array('HS256'));
        $decoded_array = (array)$decoded;

        $userName = $decoded_array['user'];
        $phoneOne = $request->input('phoneOne');
        $phoneTwo = $request->input('phoneTwo');
        $name = $request->input('name');
        $email = $request->input('email');
        $phoneBook = new PhonBookDetail();
        $phoneBook->user_name =  $userName ;
        $phoneBook->phone_number_one =  $phoneOne ;
        $phoneBook->phone_number_two =  $phoneTwo ;
        $phoneBook->name =  $name ;
        $phoneBook->email =  $email ;
        $result = $phoneBook->save();
        if ($result) {
            return response()->json(['status'=>"PhoneBook has been stored successfully!"]) ;
        } else{
            return response()->json(['error'=>"PhoneBook has not been stored!"]) ;
        }
   }

   function onSelect(Request $request)
   {
        $token = $request->input('access_token');
        $key = env('TOKEN_KEY');
        $decoded = JWT::decode($token, $key,array('HS256'));
        $decoded_array = (array)$decoded;
        $userName = $decoded_array['user'];

        $phoneBook =  PhonBookDetail::where('user_name',  $userName )->get();
            return response()->json(['phoneBook'=>$phoneBook]) ;
        
   }

   function update(Request $request, $id)
   {
        $token = $request->input('access_token');
        $key = env('TOKEN_KEY');
        $decoded = JWT::decode($token, $key,array('HS256'));
        $decoded_array = (array)$decoded;

        $userName = $decoded_array['user'];
        $phoneOne = $request->input('phoneOne');
        $phoneTwo = $request->input('phoneTwo');
        $name = $request->input('name');
        $email = $request->input('email');
        $phoneBook =  PhonBookDetail::find($id);
        $phoneBook->user_name =  $userName ;
        $phoneBook->phone_number_one =  $phoneOne ;
        $phoneBook->phone_number_two =  $phoneTwo ;
        $phoneBook->name =  $name ;
        $phoneBook->email =  $email ;
        $result = $phoneBook->save();
        if ($result) {
            return response()->json(['status'=>"PhoneBook has been updated successfully!"]) ;
        } else{
            return response()->json(['error'=>"PhoneBook has not been updated!"]) ;
        }
   }

   function onDelete(Request $request)
   {
    $token = $request->input('access_token');
    $key = env('TOKEN_KEY');
    $decoded = JWT::decode($token, $key,array('HS256'));
    $decoded_array = (array)$decoded;
    $userName = $decoded_array['user'];
    $email = $request->input('email');
    $result =  PhonBookDetail::where(['user_name'=> $userName, 'email'=>$email])->delete();
        if ($result) {
            return response()->json(['status'=>"PhoneBook has been deleted !"]) ;
        } else{
            return response()->json(['error'=>"PhoneBook has not been deleted!"]) ;
        }
   }
}
