<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\SectionHandler;
use Illuminate\Http\Request;

class SectionHandlerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $handlers = SectionHandler::with(['section', 'user'])->get();
        return view('admin.sections.index', compact('handlers'));
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
    public function store(Request $request, Section $section)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'is_heard' => 'required|string',
        ]);

        // Create the new section handler
        $section->sectionHandlers()->create([
            'user_id' => $request->user_id,
            'is_heard' => $request->is_heard,
        ]);

        return redirect()->route('section-handlers.show', $section->id)
            ->with('success', 'Section Handler created successfully.');
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
    public function edit(SectionHandler $sectionHandler)
    {
        return view('admin.sections.sectionHandlers.edit', compact('sectionHandler'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SectionHandler $sectionHandler)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'user_id' => 'required|exists:users,id',
            'is_heard' => 'required|string',
        ]);

        $sectionHandler->update($request->all());
        return redirect()->route('sectionHandlers.index')->with('success', 'Section Handler updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SectionHandler $sectionHandler)
    {
        $sectionHandler->delete();
        return redirect()->route('sectionHandlers.index')->with('success', 'Section Handler deleted successfully.');
    }
}
