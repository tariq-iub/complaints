<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Designation;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        // Eager load the designation relationship
        $employees = Employee::with('designation')->get();
        return view('admin.employees.index', compact('employees'));
    }
    public function create()
    {
        $designations = Designation::all();
        return view('admin.employees.create', compact('designations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'father_name' => 'required',
            'cnic' => 'required|unique:employees|regex:/^\d{5}-\d{7}-\d{1}$/',
            'birth_date' => 'required|date',
            'gender' => 'required',
            'designation_id' => 'required|exists:designations,id', // Ensure designation_id exists
            'email' => 'required|email|unique:employees',
            'mobile_no' => 'required|unique:employees',
            'address_line1' => 'required',
            'address_line2' => 'nullable',
            'joining_date' => 'required|date',
        ]);

        Employee::create($request->except('_token'));

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }
    public function edit(Employee $employee)
    {
        $designations = Designation::all();
        return view('admin.employees.edit', compact('employee', 'designations'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'father_name' => 'required',
            'cnic' => 'required|regex:/^\d{5}-\d{7}-\d{1}$/',
            'birth_date' => 'required|date',
            'gender' => 'required',
            'designation_id' => 'required',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'mobile_no' => 'required|unique:employees,mobile_no,' . $employee->id,
            'address_line1' => 'required',
            'address_line2' => 'nullable',
            'joining_date' => 'required|date',
        ]);

        // Exclude `_token` from mass assignment
        $employee->update($request->except('_token'));

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee removed successfully.');
    }
}


