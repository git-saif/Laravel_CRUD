<?php

namespace App\Http\Controllers;

use App\Models\Crud6;
use Illuminate\Http\Request;
use App\Http\Requests\Crud6Request;

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
    public function store(Crud6Request $request)
    {
        $imagePaths = [];

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imgName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/images/crud6'), $imgName);
                $imagePaths[] = 'uploads/images/crud6/' . $imgName;
            }
        }

        Crud6::create([
            'name'   => $request->name,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'image'  => json_encode($imagePaths),
            'status' => $request->status,
        ]);

        return redirect()->route('dashboard.crud-6.index')->with('success', 'Data saved successfully!');
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
    public function update(Crud6Request $request, string $id)
    {
        $crud6 = Crud6::findOrFail($id);

        try {
            $existingImages = is_array($crud6->image) ? $crud6->image : (json_decode($crud6->image, true) ?? []);
            $updatedImages = [];

            // Existing images process
            foreach ($request->existing_images ?? [] as $index => $existingImage) {
                if (in_array($existingImage, $request->delete_images ?? [])) {
                    if (file_exists(public_path($existingImage))) unlink(public_path($existingImage));
                    continue;
                }

                if ($request->hasFile("replace_images.$index")) {
                    $newImage = $request->file("replace_images.$index");
                    $imgName = time() . "_r_" . uniqid() . '.' . $newImage->getClientOriginalExtension();
                    $newImage->move(public_path('uploads/images/crud6'), $imgName);

                    if (file_exists(public_path($existingImage))) unlink(public_path($existingImage));
                    $updatedImages[] = 'uploads/images/crud6/' . $imgName;
                } else {
                    $updatedImages[] = $existingImage;
                }
            }

            // New images process
            if ($request->hasFile('new_images')) {
                foreach ($request->file('new_images') as $newImage) {
                    if ($newImage->isValid()) {
                        $imgName = time() . "_n_" . uniqid() . '.' . $newImage->getClientOriginalExtension();
                        $newImage->move(public_path('uploads/images/crud6'), $imgName);
                        $updatedImages[] = 'uploads/images/crud6/' . $imgName;
                    }
                }
            }

            $crud6->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'image' => json_encode($updatedImages),
                'status' => $request->status
            ]);

            return redirect()->route('dashboard.crud-6.index')->with('success', 'Data updated successfully!');
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
            $crud6 = Crud6::findOrFail($id);

            if ($crud6->image) {
                $images = json_decode($crud6->image, true) ?? [];
                foreach ($images as $imagePath) {
                    if (file_exists(public_path($imagePath))) unlink(public_path($imagePath));
                }
            }

            $crud6->delete();
            return redirect()->route('dashboard.crud-6.index')->with('success', 'Data deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
