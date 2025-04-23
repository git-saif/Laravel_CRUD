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
        $crud2 = Crud2::orderby('id', 'asc')->paginate(3);
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
                'image' => 'required|array|min:1', // min 1 image required
                'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required|in:active,inactive',
            ]);

            $image_paths = [];

            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    if ($image->isValid()) {
                        $imgName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('uploads/images/crud2'), $imgName);
                        $image_paths[] = 'uploads/images/crud2/' . $imgName;
                    }
                }
            }

            // কমপক্ষে ১টি ইমেজ আপলোড হয়েছে কিনা চেক করুন
            if (empty($image_paths)) {
                return redirect()->back()->with('error', 'At least one valid image is required.');
            }

            Crud2::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'image' => json_encode($image_paths),
                'status' => $validated['status'],
            ]);

            return redirect()->route('dashboard.crud-2.index')->with('success', 'Data saved successfully!');
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
                'existing_images' => 'sometimes|array',
                'existing_images.*' => 'sometimes|string',
                'delete_images' => 'sometimes|array',
                'delete_images.*' => 'sometimes|string',
                'replace_images' => 'sometimes|array',
                'replace_images.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
                'new_images' => 'sometimes|array',
                'new_images.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required|in:active,inactive',
            ]);

            // Handle existing images
            $existingImages = is_array($crud2->image) ? $crud2->image : (json_decode($crud2->image, true) ?? []);

            $updatedImages = [];

            // Process existing images
            foreach ($request->existing_images ?? [] as $index => $existingImage) {
                // Check if image is marked for deletion
                if (in_array($existingImage, $request->delete_images ?? [])) {
                    if (file_exists(public_path($existingImage))) {
                        unlink(public_path($existingImage));
                    }
                    continue;
                }

                // Check if image is being replaced
                if ($request->hasFile("replace_images.{$index}")) {
                    $newImage = $request->file("replace_images.{$index}");
                    $imgName = time() . '_' . $index . '_' . uniqid() . '.' . $newImage->getClientOriginalExtension();
                    $newImage->move(public_path('uploads/images/crud2'), $imgName);

                    // Delete old image
                    if (file_exists(public_path($existingImage))) {
                        unlink(public_path($existingImage));
                    }

                    $updatedImages[] = 'uploads/images/crud2/' . $imgName;
                } else {
                    $updatedImages[] = $existingImage;
                }
            }

            // Process new images
            if ($request->hasFile('new_images')) {
                foreach ($request->file('new_images') as $newImage) {
                    if ($newImage->isValid()) {
                        $imgName = time() . '_n_' . uniqid() . '.' . $newImage->getClientOriginalExtension();
                        $newImage->move(public_path('uploads/images/crud2'), $imgName);
                        $updatedImages[] = 'uploads/images/crud2/' . $imgName;
                    }
                }
            }

            // Update the record
            $crud2->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'image' => !empty($updatedImages) ? json_encode($updatedImages) : null,
                'status' => $validated['status'],
            ]);

            return redirect()->route('dashboard.crud-2.index')->with('success', 'Data updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $crud2 = Crud2::findOrFail($id);

            // যদি একাধিক ছবি থাকে
            if ($crud2->image && is_array($crud2->image)) {
                foreach ($crud2->image as $imagePath) {
                    if (file_exists(public_path($imagePath))) {
                        unlink(public_path($imagePath));
                    }
                }
            }

            $crud2->delete();
            return redirect()->route('dashboard.crud-2.index')->with('success', 'Data deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
