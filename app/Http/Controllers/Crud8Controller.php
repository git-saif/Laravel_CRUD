<?php

namespace App\Http\Controllers;

use App\Models\Crud8;
use Illuminate\Http\Request;

class Crud8Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $crud8 = Crud8::orderby('id', 'asc')->paginate(3);
        return view('components.CRUD-8.index', compact('crud8'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.CRUD-8.create');
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
        //
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
