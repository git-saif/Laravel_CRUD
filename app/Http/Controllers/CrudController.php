<?php

namespace App\Http\Controllers;

use App\Models\Crud;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $crudData = Crud::orderBy('id', 'asc')->paginate(3);
        return view('components.CRUD.index', compact('crudData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.CRUD.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'phone' => 'required|string|max:255',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif',
                'status' => 'required|in:active,inactive',
            ]);

            $img_path = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/images/crud'), $filename);
                $img_path = 'uploads/images/crud/' . $filename; // ✅ Full relative path save
            }


            Crud::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'image' => $img_path,
                'status' => $validated['status'],
            ]);


            return redirect()->route('dashboard.crud.index')->with('success', 'Data created successfully!');
        } catch (\Exception $e) {
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
        $crud = Crud::findOrFail($id);
        return view('components.CRUD.edit', compact('crud'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $crud = Crud::findOrFail($id);

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'phone' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'status' => 'required|in:active,inactive',
            ]);

            $img_path = $crud->image;
            if ($request->hasFile('image')) {
                if ($crud->image && file_exists(public_path($crud->image))) {
                    unlink(public_path($crud->image));
                }
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/images/crud'), $filename);
                $img_path = 'uploads/images/crud/' . $filename; 
            }

            $crud->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'image' => $img_path,
                'status' => $validated['status'],
            ]);

            return redirect()->route('dashboard.crud.index')->with('success', 'Data updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $crud = Crud::findOrFail($id);

            if ($crud->image && file_exists(public_path($crud->image))) {
                unlink(public_path($crud->image));
            }

            $crud->delete();
            return redirect()->route('dashboard.crud.index')->with('success', 'Data deleted successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }
}
