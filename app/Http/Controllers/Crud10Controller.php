<?php

namespace App\Http\Controllers;

use App\Models\Crud7;
use App\Models\Crud8;
use App\Models\Crud9;
use App\Models\Crud10;
use Illuminate\Http\Request;
use App\Http\Requests\Crud10Request;

class Crud10Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $crud10 = Crud10::with(['category', 'subcategory', 'subsubcategory'])
            ->orderBy('post_serial', 'asc')
            ->paginate(10);

        return view('components.CRUD-10.index', compact('crud10'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // সব category
        $categories = Crud7::orderBy('name')->get();

        // যদি কোনো category select করা থাকে (query string থেকে)
        $selectedCategory = request()->query('category');

        // যদি category select করা থাকে → তার subcategories আনবে
        $subcategories = $selectedCategory
            ? Crud8::where('crud7_id', $selectedCategory)->orderBy('name')->get()
            : collect();

        // যদি subcategory select করা থাকে → তার sub-subcategories আনবে
        $selectedSubcategory = request()->query('subcategory');
        $subsubcategories = $selectedSubcategory
            ? Crud9::where('crud8_id', $selectedSubcategory)->orderBy('name')->get()
            : collect();

        return view('components.CRUD-10.create', compact(
            'categories',
            'subcategories',
            'subsubcategories',
            'selectedCategory',
            'selectedSubcategory'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Crud10Request $request)
    {
        try {
            Crud10::create($request->validated());
            return redirect()->route('dashboard.crud-10.index')
                ->with('success', 'Post created successfully.');

            // return redirect()->route('dashboard.crud-10.index')->with('success', 'Post created successfully.');
        } catch (\Throwable $th) {
            return back()->withInput()->with('error', 'Error: ' . $th->getMessage());
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
            $crud10 = Crud10::findOrFail($id);
            $categories = Crud7::orderBy('name')->get();
            $subcategories = Crud8::orderBy('name')->get();
            $subsubcategories = Crud9::orderBy('name')->get();

            return view('components.CRUD-10.edit', compact(
                'crud10',
                'categories',
                'subcategories',
                'subsubcategories'
            ));
        } catch (\Throwable $th) {
            return back()->with('error', 'Error: ' . $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Crud10Request $request, string $id)
    {
        try {
            $crud10 = Crud10::findOrFail($id);
            $crud10->update($request->validated());
            return redirect()->route('dashboard.crud-10.index')->with('success', 'Post updated successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Error: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Crud10::findOrFail($id)->delete();
            return redirect()->route('dashboard.crud-10.index')->with('success', 'Post deleted successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Error: ' . $th->getMessage());
        }
    }
}
