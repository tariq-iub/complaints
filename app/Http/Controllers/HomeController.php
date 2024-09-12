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
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if($user->role->isAdmin())
        {
            $totalUsers = User::count();
            $factories = Factory::count();
            $clients = User::where('role_id', 2)->get();

            return view(
                'admin.dashboard',
                compact('totalUsers', 'factories', 'clients')
            );
        }
        elseif($user->role->isClient())
        {
            $totalUsers = User::count();
            $factories = Factory::count();
            $clients = User::where('role_id', 2)->get();

            return view(
                'client.dashboard',
                compact('totalUsers', 'factories', 'clients')
            );
        }
        else {
            $totalComplaints = 0;
            return view(
                'employee.dashboard',
                compact('totalComplaints')
            );
        }



    }
}

