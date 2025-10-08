<?php

namespace App\Http\Controllers;

use App\Models\Crud5;
use Illuminate\Http\Request;
use App\Http\Requests\Crud5Request;

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
    public function store(Crud5Request $request)
    {
        try {
            $validated = $request->validated();

            $img_path = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/images/crud5'), $filename);
                $img_path = 'uploads/images/crud5/' . $filename;
            }

            Crud5::create([
                'name'  => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'image' => $img_path,
            ]);

            return redirect()->route('dashboard.crud-5.index')->with('success', 'Data created successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
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
