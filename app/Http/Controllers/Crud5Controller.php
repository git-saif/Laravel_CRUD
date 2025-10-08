<?php

namespace App\Http\Controllers;

use App\Models\Crud5;
use Illuminate\Http\Request;
use App\Http\Requests\Crud5Request;
use App\Models\Crud;

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
        $crud5 = Crud5::findOrFail($id);
        return view('components.CRUD-5.edit', compact('crud5'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Crud5Request $request, string $id)
    {
        $crud5 = Crud5::findOrFail($id);

        try{
            $validated = $request->validated();

            $img_path = $crud5->image;
            if ($request->hasFile('image')) {
                if ($crud5->image && file_exists(public_path($crud5->image))) {
                    unlink(public_path($crud5->image));
                }
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/images/crud5'), $filename);
                $img_path = 'uploads/images/crud5/' . $filename;
        }

            $crud5->update([
                'name'  => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'image' => $img_path,
            ]);

            return redirect()->route('dashboard.crud-5.index')->with('success', 'Data updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $crud5 = Crud5::findOrFail($id);

            if ($crud5->image && file_exists(public_path($crud5->image))) {
                unlink(public_path($crud5->image));
            }

            $crud5->delete();
            return redirect()->route('dashboard.crud-5.index')->with('success', 'Data deleted successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }
}
