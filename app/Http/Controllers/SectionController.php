<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::with('factory')->get();
        return view('admin.sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $factories = Factory::all();
        return view('admin.sections.create', compact('factories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'factory_id' => 'required|exists:factories,id',
        ]);

        Section::create($request->all());

        return redirect()->route('sections.index')->with('success', 'Section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        return view('admin.sections.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Section $section)
    {
        $factories = Factory::all();
        return view('admin.sections.edit', compact('section', 'factories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'factory_id' => 'required|exists:factories,id',
        ]);

        $section->update($request->all());

        return redirect()->route('sections.index')->with('success', 'Section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('sections.index')->with('success', 'Section deleted successfully.');
    }

    public function fetch(Request $request)
    {
        if ($request->input('id')) {
            $data = Section::where('id', $request->input('id'))
                ->with(['components'])
                ->first();

            if ($data) return response()->json($data, 200);
            else return response()->json(['message' => 'Section is not registered in the system.'], 404);
        } else {
            $data = Section::with(['components'])
                ->get();

            if ($data) return response()->json($data, 200);
            else return response()->json(['message' => 'No sections registered in the system.'], 404);
        }
    }
}
