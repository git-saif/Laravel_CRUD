<?php

namespace App\Http\Controllers\Api;

use App\Models\Crud1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Crud1Controller extends Controller
{
    public function index()
    {
        $crud1 = Crud1::orderBy('id', 'asc')->paginate(5);
        return response()->json($crud1);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'topic_name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $crud = Crud1::create($validated);

        return response()->json([
            'message' => 'Data successfully stored.',
            'data' => $crud
        ], 201);
    }

    public function show($id)
    {
        $crud = Crud1::findOrFail($id);
        return response()->json($crud);
    }

    public function update(Request $request, $id)
    {
        $crud = Crud1::findOrFail($id);

        $validated = $request->validate([
            'topic_name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $crud->update($validated);

        return response()->json([
            'message' => 'Data successfully updated.',
            'data' => $crud
        ]);
    }

    public function destroy($id)
    {
        $crud = Crud1::findOrFail($id);
        $crud->delete();

        return response()->json(['message' => 'Data successfully deleted.']);
    }
}
