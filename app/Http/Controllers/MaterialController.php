<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\MaterialCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        $categories = MaterialCategory::orderBy('name')->get();

        $materials = Material::with('category')
            ->when($request->filled('category'), function ($query) use ($request) {
                if ($request->category === 'uncategorized') {
                    return $query->whereNull('material_category_id');
                }
                return $query->where('material_category_id', $request->category);
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('admin.materials.index', compact('materials', 'categories'));
    }

    public function create()
    {
        $categories = MaterialCategory::orderBy('name')->get();
        $availableColors = Material::$availableColors;
        return view('admin.materials.create', compact('categories', 'availableColors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'material_category_id' => ['required', 'exists:material_categories,id'],
            'name'                 => ['required', 'string', 'max:255', 'unique:materials,name'],
            'colors'               => ['required', 'array', 'min:1'],
            'colors.*'             => [Rule::in(Material::$availableColors)],
        ]);

        Material::create($validated);

        return redirect()->route('admin.materials.index')->with('success', 'Material added successfully.');
    }

    public function edit(Material $material)
    {
        $categories = MaterialCategory::orderBy('name')->get();
        $availableColors = Material::$availableColors;
        return view('admin.materials.edit', compact('material', 'categories', 'availableColors'));
    }

    public function update(Request $request, Material $material)
    {
        $validated = $request->validate([
            'material_category_id' => ['required', 'exists:material_categories,id'],
            'name'                 => ['required', 'string', 'max:255', Rule::unique('materials', 'name')->ignore($material->id)],
            'colors'               => ['required', 'array', 'min:1'],
            'colors.*'             => [Rule::in(Material::$availableColors)],
        ]);

        $material->update($validated);

        return redirect()->route('admin.materials.index')->with('success', 'Material updated successfully.');
    }

    public function destroy(Material $material)
    {
        $material->delete();
        return redirect()->route('admin.materials.index')->with('success', 'Material deleted successfully.');
    }
}
