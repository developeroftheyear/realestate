<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\RentProperty;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RentPropertyController extends Controller
{
    public function index()
    {
        $properties = RentProperty::latest()->paginate(10);
        return view('dashboard.rent_properties.rent_properties', compact('properties'));
    }

    public function create()
    {
        return view('dashboard.rent_properties.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'monthly_rent' => 'required|numeric',
            'security_deposit' => 'required|numeric',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|numeric',
            'area_sqft' => 'required|numeric',
            'lease_term' => 'required|string|max:255',
            'available_from' => 'required|date',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_featured' => 'boolean',
            'is_pet_friendly' => 'boolean',
            'is_furnished' => 'boolean',
        ]);

        $validated['image_url'] = $request->file('image')->store('rent_properties', 'public');
        unset($validated['image']);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_pet_friendly'] = $request->has('is_pet_friendly');
        $validated['is_furnished'] = $request->has('is_furnished');

        RentProperty::create($validated);

        return redirect()->route('panel.rent-properties.index')->with('success', 'Rent Property created successfully.');
    }

    public function show(RentProperty $rentProperty)
    {
        return redirect()->route('panel.rent-properties.edit', $rentProperty);
    }

    public function edit(RentProperty $rentProperty)
    {
        return view('dashboard.rent_properties.edit', compact('rentProperty'));
    }

    public function update(Request $request, RentProperty $rentProperty)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'monthly_rent' => 'required|numeric',
            'security_deposit' => 'required|numeric',
            'bedrooms' => 'required|integer',
            'bathrooms' => 'required|numeric',
            'area_sqft' => 'required|numeric',
            'lease_term' => 'required|string|max:255',
            'available_from' => 'required|date',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'is_featured' => 'boolean',
            'is_pet_friendly' => 'boolean',
            'is_furnished' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($rentProperty->image_url && ! str_starts_with($rentProperty->image_url, 'http')) {
                Storage::disk('public')->delete($rentProperty->image_url);
            }

            $validated['image_url'] = $request->file('image')->store('rent_properties', 'public');
        }

        unset($validated['image']);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_pet_friendly'] = $request->has('is_pet_friendly');
        $validated['is_furnished'] = $request->has('is_furnished');

        $rentProperty->update($validated);

        return redirect()->route('panel.rent-properties.index')->with('success', 'Rent Property updated successfully.');
    }

    public function destroy(RentProperty $rentProperty)
    {
        if ($rentProperty->image_url && ! str_starts_with($rentProperty->image_url, 'http')) {
            Storage::disk('public')->delete($rentProperty->image_url);
        }

        $rentProperty->delete();

        return redirect()->route('panel.rent-properties.index')->with('success', 'Rent Property deleted successfully.');
    }
}
