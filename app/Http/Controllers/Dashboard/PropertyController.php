<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Property;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::latest()->paginate(10);
        return view('dashboard.properties.properties', compact('properties'));
    }

    public function create()
    {
        return view('dashboard.properties.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image_url' => 'required|url',
            'area_sqft' => 'required|numeric',
            'is_featured' => 'boolean'
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        Property::create($validated);

        return redirect()->route('panel.properties.index')->with('success', 'Property created successfully.');
    }

    public function show(Property $property)
    {
        return view('dashboard.properties.show', compact('property'));
    }

    public function edit(Property $property)
    {
        return view('dashboard.properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image_url' => 'required|url',
            'area_sqft' => 'required|numeric',
            'is_featured' => 'boolean'
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $property->update($validated);

        return redirect()->route('panel.properties.index')->with('success', 'Property updated successfully.');
    }

    public function destroy(Property $property)
    {
        $property->delete();
        return redirect()->route('panel.properties.index')->with('success', 'Property deleted successfully.');
    }
}
