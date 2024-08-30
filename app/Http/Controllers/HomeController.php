<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Factory;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()) {
            if (in_array(Auth::user()->role->id, [1])) {
                // Fetch the total number of users
                $totalUsers = User::count();
                $factories = Factory::count();
                $clients = User::where('role_id', 2)->get();
                return view('dashboard.admin', compact('totalUsers', 'factories', 'clients'));
            } else {
                return view('dashboard.client');
            }
        } else {
            return redirect()->route('login');
        }
    }
}

