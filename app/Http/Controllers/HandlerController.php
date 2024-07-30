<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\SectionHandler;
use App\Models\User;
use Illuminate\Http\Request;

class HandlerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::all();
        $handlers = SectionHandler::with(['section', 'user'])->get();
        $users = User::all();
        return view('admin.handlers.index', compact('handlers', 'sections', 'users'));
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
            'user_id' => 'required|integer',
            'is_head' => 'required|boolean',
        ]);

        // Create or update the handler
        $handler = SectionHandler::updateOrCreate(
            ['section_id' => $validated['section_id'], 'user_id' => $validated['user_id']],
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
        $users = User::all();
        $sections = Section::all();

        return response()->json([
            'handler' => $handler,
            'users' => $users,
            'sections' => $sections,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            
            'user_id' => 'required|exists:users,id',
            'is_head' => 'required|boolean',
            'section_id' => 'required|exists:sections,id', // Validate section_id
        ]);

        $handler = SectionHandler::findOrFail($id);
        $handler->user_id = $request->input('user_id');
        $handler->is_head = $request->input('is_head');
        $handler->section_id = $request->input('section_id'); // Update section_id
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
