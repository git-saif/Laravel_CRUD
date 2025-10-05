<?php

namespace App\Http\Controllers;

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
