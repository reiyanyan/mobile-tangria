<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function login(){
        return view('auth.login');
    }

    public function register(){
        return view('auth.register');
    }

    public function index()
    {
        return view('home');
    }

    public function info(){
        return view('info');
    }

    public function profile(){
        return view('profile');
    }

    public function package(){
        return view('package');
    }

    public function ala_carte(){
        return view('ala_carte');
    }

    public function booking(Request $request){
        return view('booking', ['id' => $request->id]);
    }
}
