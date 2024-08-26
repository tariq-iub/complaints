<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\SectionHandler;
use App\Models\Employee; // Update to use Employee model
use Illuminate\Http\Request;

class HandlerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        $handlers = SectionHandler::with(['section', 'employee'])->get(); // Update to use employee
        $employees = Employee::all(); // Update to fetch employees
        return view('admin.handlers.index', compact('handlers', 'sections', 'employees')); // Pass employees to view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Section $section)
    {
        return view('admin.sections.handlers', compact('section'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate and process the request
        $validated = $request->validate([
            'section_id' => 'required|integer',
            'employee_id' => 'required|integer', // Update to use employee_id
            'is_head' => 'required|boolean',
        ]);

        // Create or update the handler
        $handler = SectionHandler::updateOrCreate(
            ['section_id' => $validated['section_id'], 'employee_id' => $validated['employee_id']], // Update to use employee_id
            ['is_head' => $validated['is_head']]
        );

        // Return a response
        return response()->json(['success' => true, 'handler' => $handler]);
    }
    
    /**
     * Display the specified resource.
     */
    public function showHandlers(Section $section)
    {
        // Fetch the handlers related to the section
        $handlers = SectionHandler::where('section_id', $section->id)->get();

        // Pass the handlers and section to the view
        return view('admin.sections.handlers', [
            'section' => $section,
            'handlers' => $handlers,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $handler = SectionHandler::findOrFail($id);
        $employees = Employee::all(); // Fetch employees
        $sections = Section::all();

        return response()->json([
            'handler' => $handler,
            'employees' => $employees, // Update to use employees
            'sections' => $sections,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id', // Update to validate employee_id
            'is_head' => 'required|boolean',
            'section_id' => 'required|exists:sections,id',
        ]);

        $handler = SectionHandler::findOrFail($id);
        $handler->employee_id = $request->input('employee_id'); // Update to use employee_id
        $handler->is_head = $request->input('is_head');
        $handler->section_id = $request->input('section_id');
        $handler->save();

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $handler = SectionHandler::findOrFail($id);
        $handler->delete();

        return response()->json(['success' => true]);
    }
    
}
