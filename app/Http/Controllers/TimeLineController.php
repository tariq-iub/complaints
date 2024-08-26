<?php

namespace App\Http\Controllers;
use App\Models\Complaint;

use App\Models\TimeLine;
use Illuminate\Http\Request;

class TimeLineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $complaint = Complaint::findOrFail($id);

        // Assuming you have a method to get timeline events for a complaint
        $timelineEvents = $this->getTimelineEvents($complaint);

        return view('client.addcomplaint.timeline', compact('complaint', 'timelineEvents'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TimeLine $timeLine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TimeLine $timeLine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TimeLine $timeLine)
    {
        //
    }
        private function getTimelineEvents($complaint)
    {
        // Replace with actual logic to retrieve timeline events
        return [
            ['type' => 'Complaint Added', 'timestamp' => $complaint->created_at],
            // Add more events as needed
        ];
    }
}
