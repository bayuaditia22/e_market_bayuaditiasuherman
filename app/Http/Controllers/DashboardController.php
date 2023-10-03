<?php

namespace App\Http\Controllers; //pakaje

use Illuminate\Http\Request; //request (untuk menginport class request)

//class DashboardController extends Controller //kelas controller (turunan)
class DashboardController extends Controller 
{
    public function index(){ //method
       return view('dashboard'); //
    }

    public function blog(){
        return view('templates.latihan');
    }
}
