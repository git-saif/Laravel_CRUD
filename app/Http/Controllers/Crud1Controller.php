<?php

namespace App\Http\Controllers;

use App\Models\Crud1;
use Illuminate\Http\Request;

class Crud1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $crud1 = Crud1::orderby('id', 'asc')->paginate(3);
        return view('components.crud-1.index', compact('crud1'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.crud-1.create');
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
            
            Crud1::create($validated);
            
            return redirect()->route('dashboard.crud-1.index')->with('success', 'Data successfully stored.');


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
        $crud1 = Crud1::findOrFail($id);
        return view('components.crud-1.edit', compact('crud1'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $crud1 = Crud1::findOrFail($id);
        
        try {
            $validated = $request->validate([
                'topic_name' => 'required',
                'title' => 'required',
                'description' => 'required',
                'status' => 'required',
            ]);

            $crud1->update($validated);
            return redirect()->route('dashboard.crud-1.index')->with('success', 'Data successfully updated.');

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
            $crud1 = Crud1::findOrFail($id);
            $crud1->delete();
            
            return redirect()
            ->route('dashboard.crud-1.index')
            ->with('success', 'Data successfully deleted.');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }
}
