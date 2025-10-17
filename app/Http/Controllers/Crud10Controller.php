<?php

namespace App\Http\Controllers;

use App\Models\Crud7;
use App\Models\Crud8;
use App\Models\Crud9;
use App\Models\Crud10;
use Illuminate\Http\Request;
use App\Http\Requests\Crud10Request;
use Illuminate\Support\Facades\Storage;

class Crud10Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        $crud10 = Crud10::with(['category', 'subcategory', 'subsubcategory'])
            ->orderBy('post_serial', 'asc')
            ->paginate(10);

        return view('components.CRUD-10.index', compact('crud10'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            // All category
            $categories = Crud7::where('status', 'active')->orderBy('name')->get();

            // sub-categories & sub-sub-categories will be loaded by AJAX
            $subcategories = collect();
            $subsubcategories = collect();

            return view('components.CRUD-10.create', compact(
                'categories',
                'subcategories',
                'subsubcategories'
            ));
        } catch (\Exception $e) {
            return redirect()->route('dashboard.crud-10.index')
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Functions for AJAX to get subcategories  &&  sub-sub-categories
    |--------------------------------------------------------------------------
    */
    public function getSubcategories($categoryId)
    {
        $subcategories = Crud8::where('crud7_id', $categoryId)
            ->where('status', 'active')
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        return response()->json($subcategories);
    }

    public function getSubSubcategories($subcategoryId)
    {
        $subsubcategories = Crud9::where('crud8_id', $subcategoryId)
            ->where('status', 'active')
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        return response()->json($subsubcategories);
    }
    // End=======================<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<


    public function store(Crud10Request $request)
    {
        try {
            Crud10::create($request->validated());
            return redirect()->route('dashboard.crud-10.index')
                ->with('success', 'Post created successfully.');

            // return redirect()->route('dashboard.crud-10.index')->with('success', 'Post created successfully.');
        } catch (\Throwable $th) {
            return back()->withInput()->with('error', 'Error: ' . $th->getMessage());
        }
    }

    public function show(string $id)
    {
        try {
            $crud10 = Crud10::with(['category', 'subcategory', 'subsubcategory'])->findOrFail($id);

            return view('components.CRUD-10.show', compact('crud10'));
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.crud-10.index')
                ->with('error', 'Error: ' . $th->getMessage());
        }
    }

    public function edit(string $id)
    {
        try {
            $crud10 = Crud10::findOrFail($id);
            $categories = Crud7::where('status', 'active')->orderBy('serial_no')->get();

            // only Category will be loaded — subcategory/sub-subcategory ajax will load by AJAX
            return view('components.CRUD-10.edit', compact('crud10', 'categories'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Error: ' . $th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Crud10Request $request, string $id)
    {
        try {
            $crud10 = Crud10::findOrFail($id);
            $crud10->update($request->validated());

            // যদি request-এর মধ্যে "redirect_to_show" নামে hidden field থাকে তাহলে show এ redirect করবে
            if ($request->has('redirect_to_show')) {
                return redirect()
                    ->route('dashboard.crud-10.show', $crud10->id)
                    ->with('success', 'Post updated successfully.');
            }
            // default — index এ যাবে
            return redirect()
                ->route('dashboard.crud-10.index')
                ->with('success', 'Post updated successfully.');
                
        } catch (\Throwable $th) {
            return back()->with('error', 'Error: ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Crud10::findOrFail($id)->delete();
            return redirect()->route('dashboard.crud-10.index')->with('success', 'Post deleted successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Error: ' . $th->getMessage());
        }
    }


    /*
    |--------------------------------------------------------------------------
    |               Image upload handler for CKEditor
    |--------------------------------------------------------------------------
    */
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Ensure the folder exists
            $folder = public_path('uploads/ckeditor');
            if (!file_exists($folder)) {
                mkdir($folder, 0775, true);
            }

            $file->move($folder, $filename);
            $url = asset('uploads/ckeditor/' . $filename);

            // CKEditor expects this JSON
            return response()->json([
                'url' => $url
            ]);
        }

        return response()->json(['error' => 'No file uploaded.'], 400);
    }
}
