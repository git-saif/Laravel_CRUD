<?php

namespace App\Http\Controllers;

use App\Http\Requests\Crud9Request;
use App\Models\Crud7;
use App\Models\Crud8;
use App\Models\Crud9;
use Illuminate\Http\Request;

class Crud9Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // eager load subcategory and its category for display
        $crud9 = Crud9::with('subcategory.category')->orderBy('serial_no', 'asc')->paginate(10);
        return view('components.CRUD-9.index', compact('crud9'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Crud7::orderBy('name')->get();  // Load categories

        $subcategories = collect();   // Load subcategories by AJAX

        // pass both variables to view
        return view('components.CRUD-9.create', compact('categories', 'subcategories'));
    }

    
    // NEW FUNCTION FOR AJAX
    public function getSubcategories($categoryId)
    {
        $subcategories = Crud8::where('crud7_id', $categoryId)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($subcategories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Crud9Request $request)
    {
        try {
            Crud9::create($request->validated());

            return redirect()
                ->route('dashboard.crud-9.index')
                ->with('success', 'Data saved successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while saving data.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $crud9 = Crud9::findOrFail($id);
            $categories = Crud7::orderBy('name')->get();
            $subcategories = Crud8::where('crud7_id', $crud9->category_id ?? $crud9->subcategory->crud7_id ?? 0)
                ->orderBy('name')->get();

            return view('components.CRUD-9.edit', compact('crud9', 'categories', 'subcategories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Crud9Request $request, string $id)
    {
        try {
            $crud9 = Crud9::findOrFail($id);
            $crud9->update($request->validated());

            return redirect()
                ->route('dashboard.crud-9.index')
                ->with('success', 'Updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while updating data.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $crud9 = Crud9::findOrFail($id);
            $crud9->delete();

            return redirect()
                ->route('dashboard.crud-9.index')
                ->with('success', 'Deleted.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting data.');
        }
    }

    
}
