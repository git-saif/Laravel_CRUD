<?php

namespace App\Http\Controllers;

use App\Http\Requests\Crud4Request;
use App\Models\Crud4;
use Illuminate\Http\Request;

class Crud4Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $crud4 = Crud4::orderby('id', 'asc')->paginate(3);
        return view('components.CRUD-4.index', compact('crud4'));
        // resources\views\components\CRUD-4\index.blade.php
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.CRUD-4.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Crud4Request $request)
    {
        Crud4::create($request->validated());

        return redirect()
        ->route('dashboard.crud-4.index')
        ->with('success', 'Data created successfully!');
        
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
        $crud4 = Crud4::findOrFail($id);
        return view('components.CRUD-4.edit', compact('crud4'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Crud4Request $request, Crud4 $crud_4)
    {
        $crud_4->update($request->validated());

        return redirect()
            ->route('dashboard.crud-4.index')
            ->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $crud_4 = Crud4::findOrFail($id);
            $crud_4->delete();
            return redirect()
            ->route('dashboard.crud-4.index')
            ->with('success', 'Data deleted successfully!');

        } catch (\Throwable $th) {
            return redirect()
            ->back()
            ->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }



    
}
