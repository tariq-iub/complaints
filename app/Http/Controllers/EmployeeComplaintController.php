<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;

class EmployeeComplaintController extends Controller
{
    public function index()
    {
        // Get the current logged-in employee
        $employee = auth()->user();

        // Fetch complaints assigned to this employee
        $complaints = Complaint::where('handler_id', $employee->id)->with('category', 'section')->get();

        // Pass complaints to the view
        return view('employee.complaints.index', compact('complaints'));
    }
}

