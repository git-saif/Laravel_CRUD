<?php

namespace App\Http\Controllers;

use App\Models\Crud6;
use Illuminate\Http\Request;

class Crud6Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $crud6 = Crud6::orderby('id', 'asc')->paginate(3);
        return view('components.CRUD-6.index', compact('crud6'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.CRUD-6.create');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $crud6 = Crud6::findOrFail($id);
        return view('components.CRUD-6.edit', compact('crud6'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
