<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('materials')->latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $materials = Material::all();
        return view('admin.services.create', compact('materials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'callout_text' => 'nullable|string|max:255', // <--- Added validation rule
            'badge_text'   => 'nullable|string|max:255', // <--- Added validation rule
            'description'  => 'nullable|string',
            'materials'    => 'nullable|array',
            'materials.*'  => 'exists:materials,id',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('services', 'public');
        }

        $service = Service::create($validated);

        if ($request->has('materials')) {
            $service->materials()->sync($request->materials);
        }

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        $materials = Material::all();
        $service->load('materials');
        return view('admin.services.edit', compact('service', 'materials'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'callout_text' => 'nullable|string|max:255', // <--- Added validation rule
            'badge_text'   => 'nullable|string|max:255', // <--- Added validation rule
            'description'  => 'nullable|string',
            'materials'    => 'nullable|array',
            'materials.*'  => 'exists:materials,id',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($service->image_path) {
                Storage::disk('public')->delete($service->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('services', 'public');
        }

        $service->update($validated);
        $service->materials()->sync($request->input('materials', []));

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        if ($service->image_path) {
            Storage::disk('public')->delete($service->image_path);
        }

        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
