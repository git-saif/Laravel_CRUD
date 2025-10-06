<?php

namespace App\Http\Controllers;

use App\Models\Crud0;
use Illuminate\Http\Request;

class Crud0Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $crud0 = Crud0::orderby('id', 'asc')->paginate(3);
        return view('components.crud0.index', compact('crud0'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.crud0.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'topic_name' => 'required',
                'title' => 'required',
                'description' => 'required',
                'status' => 'required',
            ]);
            
            Crud0::create($validated);
            
            return redirect()->route('dashboard.crud-0.index')->with('success', 'Data successfully stored.');


        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
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
        $crud0 = Crud0::findOrFail($id);
        return view('components.crud0.edit', compact('crud0'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $crud0 = Crud0::findOrFail($id);
        
        try {
            $validated = $request->validate([
                'topic_name' => 'required',
                'title' => 'required',
                'description' => 'required',
                'status' => 'required',
            ]);

            $crud0->update($validated);
            return redirect()->route('dashboard.crud-0.index')->with('success', 'Data successfully updated.');

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $crud0 = Crud0::findOrFail($id);
            $crud0->delete();
            
            return redirect()
            ->route('dashboard.crud-0.index')
            ->with('success', 'Data successfully deleted.');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }
}
