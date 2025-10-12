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
        // pass categories with nested subcategories to populate dropdowns & client-side filter
        $categories = Crud7::with('subcategories')->orderBy('name')->get();
        // also pass all subcategories as fallback
        $subcategories = Crud8::orderBy('name')->get();
        return view('components.CRUD-9.create', compact('categories', 'subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Crud9Request $request)
    {
        try {
            Crud9::create($request->validated());

            return redirect()
                ->route('crud9.index')
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
            $categories = Crud7::with('subcategories')->orderBy('name')->get();
            return view('components.CRUD-9.edit', compact('crud9', 'categories'));
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
