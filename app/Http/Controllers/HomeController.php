<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Factory;
use App\Models\Complaint;
use App\Models\Subscription;
use Carbon\Carbon;
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
            $totalClients = User::where('role_id', 2)->count();
            $factories = Factory::count();
            $clients = User::where('role_id', 2)->get();
            $lastMonth = User::whereMonth('created_at', Carbon::now()->month)->where('role_id', 2)->count();
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();
            $startOfWeek = Carbon::now()->startOfWeek();
            $endOfWeek = Carbon::now()->endOfWeek();
            $activeSubscriptionsCount = Subscription::where('stripe_status', 'active')->count();
            $endOfMonth = Carbon::now()->endOfMonth();
            $startOfMonth = Carbon::now()->startOfMonth();
            $subscriptionsEndingThisMonthCount = Subscription::whereBetween('ends_at', [$startOfMonth, $endOfMonth])->count();
            // Initialize arrays
            $weeksData = [];
            $resolvedWeeksData = [];
            $assignedWeeksData = [];
            $dailyComplaintsData = [];
            $dailyResolvedData = [];
            $dailyAssignedData = [];

            // Collect daily data
            for ($date = $startOfWeek; $date->lessThanOrEqualTo($endOfWeek); $date->addDay()) {
                $endOfDay = $date->copy()->endOfDay();

                $dailyComplaintsData[] = Complaint::whereBetween('created_at', [$date, $endOfDay])->count();
                $dailyResolvedData[] = Complaint::whereBetween('resolved_at', [$date, $endOfDay])->count();
                $dailyAssignedData[] = Complaint::whereBetween('handler_assigned_at', [$date, $endOfDay])->count();
            }

            // Ensure 7 elements (one for each day of the week)
            $dailyComplaintsData = array_pad($dailyComplaintsData, 7, 0);
            $dailyResolvedData = array_pad($dailyResolvedData, 7, 0);
            $dailyAssignedData = array_pad($dailyAssignedData, 7, 0);

            // Collect weekly data
            $startOfWeek = $startOfMonth->copy()->startOfWeek();
            while ($startOfWeek->lessThanOrEqualTo($endOfMonth)) {
                $endOfWeek = $startOfWeek->copy()->endOfWeek();
                if ($endOfWeek->greaterThan($endOfMonth)) {
                    $endOfWeek = $endOfMonth;
                }

                $weeksData[] = Complaint::whereBetween('created_at', [$startOfWeek, $endOfWeek])->count();
                $resolvedWeeksData[] = Complaint::whereBetween('resolved_at', [$startOfWeek, $endOfWeek])->count();
                $assignedWeeksData[] = Complaint::whereBetween('handler_assigned_at', [$startOfWeek, $endOfWeek])->count();

                $startOfWeek->addWeek();
            }

            // Ensure exactly 5 elements (one for each week)
            $weeksData = array_pad($weeksData, 5, 0);
            $resolvedWeeksData = array_pad($resolvedWeeksData, 5, 0);
            $assignedWeeksData = array_pad($assignedWeeksData, 5, 0);

            return view('admin.dashboard', compact(
                'totalClients', 'factories', 'clients', 'lastMonth',
                'weeksData', 'resolvedWeeksData', 'assignedWeeksData',
                'dailyComplaintsData', 'dailyResolvedData', 'dailyAssignedData','activeSubscriptionsCount', 'subscriptionsEndingThisMonthCount'
            ));

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

