<?php

use Illuminate\Http\Request;
use App\Http\Controllers\api\authcontrolle; 
use Illuminate\Support\Facades\Route;


route::post('/register',[authcontrolle::class,'register']);
route::post('/login',[authcontrolle::class,'login']);   
route::post('/logout',[authcontrolle::class,'logout']);