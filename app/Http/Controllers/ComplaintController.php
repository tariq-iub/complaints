<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Section;
use App\Models\SectionHandler;
use App\Models\Employee;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;
class ComplaintController extends Controller
{
    // Admin Methods
    public function index()
    {
        $complaints = Complaint::with('category')->paginate(10);
        $sections = Section::all();  // Fetch all sections
        $handlers = Employee::all(); // Assuming handlers are employees
        return view('admin.complaints.index', compact('complaints', 'sections', 'handlers'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.complaints.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'priority' => 'required|in:normal,urgent,express',
            'photo_path' => 'required|image|mimes:jpeg,png,jpg|max:10240',
        ]);

        $photoPath = $request->file('photo_path')?->store('photos', 'public');

        Complaint::create(array_merge($request->all(), ['photo_path' => $photoPath]));

        return redirect()->route('admin.complaints.create')->with('success', 'Complaint submitted successfully.');
    }

    public function show(Complaint $complaint)
    {
        return view('admin.complaints.timeline', compact('complaint'));
    }

    public function edit($id)
    {
        $complaint = Complaint::findOrFail($id);
        $sections = Section::all(); // Fetch all sections
        $handlers = SectionHandler::all(); // Fetch all handlers

        return response()->json([
            'complaint' => $complaint,
            'sections' => $sections,
            'handlers' => $handlers,
        ]);
    }



    public function update(Request $request, Complaint $complaint)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'priority' => 'required|in:normal,urgent,express',
            'section_id' => 'required|exists:sections,id',
            'handler_id' => 'required|exists:handlers,id',
            'photo_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('photo_path')) {
            $data['photo_path'] = $request->file('photo_path')->store('photos', 'public');
        }

        $complaint->update($data);

        return redirect()->route('complaints.index')->with('success', 'Complaint updated successfully.');

    }

    public function destroy(Complaint $complaint)
    {
        $complaint->delete();
        return redirect()->route('complaints.index')->with('success', 'Complaint deleted successfully.');
    }

    // Client Methods
    public function createClient()
    {
        $categories = Category::all();
        return view('client.addcomplaint.create', compact('categories'));
    }

    public function storeClient(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'priority' => 'required|in:normal,urgent,express',
            'photo_path' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $photoPath = $request->file('photo_path')?->store('photos', 'public');

        Complaint::create(array_merge($request->all(), ['photo_path' => $photoPath]));

        return redirect()->route('client.complaints.index')->with('success', 'Complaint submitted successfully.');
    }

    public function indexClient()
    {
        // Fetch all complaints without user_id filtering
        $complaints = Complaint::paginate(10);
        return view('client.addcomplaint.index', compact('complaints'));
    }

    public function showClient(Complaint $complaint)
    {
        // Ensure that the complaint belongs to the currently authenticated user
        if ($complaint->user_id !== auth()->id()) {
            abort(403);
        }

        return view('client.addcomplaint.show', compact('complaint'));
    }
    //     public function destroyClient($id)
    // {
    //     $complaint = Complaint::findOrFail($id);
    //     $complaint->delete();

    //     return redirect()->route('client.complaints.index')
    //     ->with('success', 'Complaint deleted successfully.');
    // }
}
