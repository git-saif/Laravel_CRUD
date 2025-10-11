<?php

namespace App\Http\Controllers;

use App\Models\Crud7;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\Crud7Request;

class Crud7Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $crud7 = Crud7::orderBy('serial_no', 'asc')->paginate(10);
        return view('components.CRUD-7.index', compact('crud7'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.CRUD-7.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Crud7Request $request)
    {
        try {
            Crud7::create([
                'name'       => $request->name,
                'slug'       => Str::slug($request->name),
                'serial_no'  => $request->serial_no,
                'status'     => $request->status,
            ]);


            return redirect()
                ->route('dashboard.crud-7.index')
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
        $crud7 = Crud7::findOrFail($id);
        return view('components.CRUD-7.edit', compact('crud7'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Crud7Request $request, string $id)
    {
        try {
            $crud7 = Crud7::findOrFail($id);
            $crud7->update($request->validated());
            return redirect()->route('dashboard.crud-7.index')->with('success', 'Category updated successfully.');
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
            $crud7 = Crud7::findOrFail($id);
            $crud7->delete();
            return redirect()->route('dashboard.crud-7.index')->with('success', 'Category deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }
}
