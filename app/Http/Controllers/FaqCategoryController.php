<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use App\Models\User;
use App\Models\Statement;
use App\Models\Content;
use Illuminate\Http\Request;

class FaqCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqCategories = FaqCategory::with(['statements' => function ($query) {
            $query->orderBy('rank', 'asc'); 
        }, 'contents'])->get();
        $popfaqCategories = FaqCategory::whereIn('rank', [1,2])->orderBy('rank', 'asc')->get();

        // Pass the data to the view
        return view('client.faq.index', compact('faqCategories', 'popfaqCategories'));
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
    public function show(FaqCategory $faqCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FaqCategory $faqCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FaqCategory $faqCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FaqCategory $faqCategory)
    {
        //
    }
}
