<?php

namespace App\Http\Controllers;

use App\Http\Requests\Crud8Request;
use App\Models\Crud7;
use App\Models\Crud8;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class Crud8Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $crud8 = Crud8::with('category')->orderBy('id', 'asc')->paginate(3);
        return view('components.CRUD-8.index', compact('crud8'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Crud7::orderBy('serial_no')->get();
        return view('components.CRUD-8.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Crud8Request $request)
    {
        try {
            Crud8::create($request->validated());

            return redirect()
                ->route('dashboard.crud-8.index')
                ->with('success', 'Category created successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $th->getMessage());
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
            $crud8 = Crud8::findOrFail($id);
            $categories = Crud7::orderBy('name')->get();
            return view('components.CRUD-8.edit', compact('crud8', 'categories'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Crud8Request $request, string $id)
    {
        try {
            $crud8 = Crud8::findOrFail($id);
            $crud8->update($request->validated());
            return redirect()->route('dashboard.crud-8.index')->with('success', 'SubCategory updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $crud8 = Crud8::findOrFail($id);
            $crud8->delete();
            return redirect()->route('dashboard.crud-8.index')->with('success', 'SubCategory deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }
}
