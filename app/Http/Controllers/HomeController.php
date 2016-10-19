<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class HomeController extends Controller
{

class HomeController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }

    public function logout(){
        auth()->logout();
        return view('auth.login');
    }

}
