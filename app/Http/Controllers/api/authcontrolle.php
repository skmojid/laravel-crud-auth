<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class authcontrolle extends Controller
{
    public function register(Request $request){
        echo "hello";
       $validate = $request->validate([
           'name'=>'required|string|max:255',
           'email'=>'required|email|unique:users',
           'password'=>'required|min:6'
       ]);
         
       $user = User::create([
           'name'=>$request->name,
           'email'=>$request->email,
           'password'=>bcrypt($request->password)
       ]);

       return response()->json([
           'message'=>'User registered successfully',
           'user'=>$user
       ],201);


    }


    public function login(Request $request){


    }



  public function logout(Request $request){





    }
}














