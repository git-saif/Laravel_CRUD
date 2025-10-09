<?php

namespace App\Http\Controllers;

use App\Models\Crud2;
use Illuminate\Http\Request;

class Crud2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $crud2 = Crud2::orderBy('id', 'asc')->paginate(3);
        return view('components.CRUD-2.index', compact('crud2'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.CRUD-2.create');
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
                $image->move(public_path('uploads/images/crud2'), $filename);
                $img_path = 'uploads/images/crud2/' . $filename;
            }

            Crud2::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'image' => $img_path,
                'status' => $validated['status'],
            ]);


            return redirect()->route('dashboard.crud-2.index')->with('success', 'Data created successfully!');
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
        $crud2 = Crud2::findOrFail($id);
        return view('components.CRUD-2.edit', compact('crud2'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $crud2 = Crud2::findOrFail($id);

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'phone' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                'status' => 'required|in:active,inactive',
            ]);

            $img_path = $crud2->image;
            if ($request->hasFile('image')) {
                if ($crud2->image && file_exists(public_path($crud2->image))) {
                    unlink(public_path($crud2->image));
                }
                $image = $request->file('image');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/images/crud2'), $filename);
                $img_path = 'uploads/images/crud2/' . $filename; 
            }

            $crud2->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'image' => $img_path,
                'status' => $validated['status'],
            ]);

            return redirect()->route('dashboard.crud-2.index')->with('success', 'Data updated successfully!');
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
            $crud2 = Crud2::findOrFail($id);

            if ($crud2->image && file_exists(public_path($crud2->image))) {
                unlink(public_path($crud2->image));
            }

            // dd(public_path($crud2->image));


            $crud2->delete();

            return redirect()
            ->route('dashboard.crud-2.index')
            ->with('success', 'Data deleted successfully!');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }
}
