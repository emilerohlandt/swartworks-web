<?php

namespace App\Http\Controllers;

use App\Models\MaterialCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MaterialCategoryController extends Controller
{
    public function index()
    {
        $categories = MaterialCategory::withCount('materials')->orderBy('name')->paginate(10);
        return view('admin.material-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.material-categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:material_categories,name'],
        ]);

        MaterialCategory::create($validated);

        return redirect()->route('admin.material-categories.index')->with('success', 'Material Category created successfully.');
    }

    public function edit(MaterialCategory $materialCategory)
    {
        return view('admin.material-categories.edit', ['category' => $materialCategory]);
    }

    public function update(Request $request, MaterialCategory $materialCategory)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('material_categories', 'name')->ignore($materialCategory->id)],
        ]);

        $materialCategory->update($validated);

        return redirect()->route('admin.material-categories.index')->with('success', 'Material Category updated successfully.');
    }

    public function destroy(MaterialCategory $materialCategory)
    {
        $materialCategory->delete();
        return redirect()->route('admin.material-categories.index')->with('success', 'Material Category deleted successfully.');
    }
}
