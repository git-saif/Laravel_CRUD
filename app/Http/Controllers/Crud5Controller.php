<?php

namespace App\Http\Controllers;

use App\Models\Crud5;
use Illuminate\Http\Request;

class Crud5Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $crud5 = Crud5::orderby('id', 'asc')->paginate(3);
        return view('components.CRUD-5.index', compact('crud5'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.CRUD-5.create');
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
