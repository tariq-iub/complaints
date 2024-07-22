<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user())
        {
            if(in_array(Auth::user()->role->id, [1, 2])) return view('dashboard.admin');
            else return view('dashboard.client');
        }
        else {
            redirect()->route('login');
        }
    }
}
