<?php

namespace App\Http\Controllers;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller
{
    use AuthorizesRequests;
    public function home(){
        return view('home');
    }
}
