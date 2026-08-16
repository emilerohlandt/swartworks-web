<?php

namespace App\Http\Controllers;

use App\Models\ModelHub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModelHubController extends Controller
{
    public function index()
    {
        $hubs = ModelHub::orderBy('sort_order', 'asc')->orderBy('name', 'asc')->get();
        return view('admin.model-hubs.index', compact('hubs'));
    }

    public function create()
    {
        return view('admin.model-hubs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:Free,Premium',
            'url' => 'required|url|max:255',
            'logo' => 'nullable|file|mimes:svg,png,jpg,webp|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('model-hubs', 'public');
            $validated['logo_path'] = $path;
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        ModelHub::create($validated);

        return redirect()->route('admin.model-hubs.index')->with('success', 'Model Hub resource created successfully.');
    }

    public function edit(ModelHub $modelHub)
    {
        return view('admin.model-hubs.edit', compact('modelHub'));
    }

    public function update(Request $request, ModelHub $modelHub)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:Free,Premium',
            'url' => 'required|url|max:255',
            'logo' => 'nullable|file|mimes:svg,png,jpg,webp|max:2048',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            if ($modelHub->logo_path && Storage::disk('public')->exists($modelHub->logo_path)) {
                Storage::disk('public')->delete($modelHub->logo_path);
            }
            $path = $request->file('logo')->store('model-hubs', 'public');
            $validated['logo_path'] = $path;
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $modelHub->update($validated);

        return redirect()->route('admin.model-hubs.index')->with('success', 'Model Hub resource updated successfully.');
    }

    public function destroy(ModelHub $modelHub)
    {
        if ($modelHub->logo_path && Storage::disk('public')->exists($modelHub->logo_path)) {
            Storage::disk('public')->delete($modelHub->logo_path);
        }

        $modelHub->delete();

        return redirect()->route('admin.model-hubs.index')->with('success', 'Model Hub resource deleted successfully.');
    }
}
