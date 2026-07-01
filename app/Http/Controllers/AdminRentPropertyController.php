<?php

namespace App\Http\Controllers;

use App\Models\RentProperty;
use Illuminate\Http\Request;

class AdminRentPropertyController extends Controller
{
    public function index()
    {
        $properties = RentProperty::latest()->paginate(10);
        return view('admin.rent_properties.index', compact('properties'));
    }

    public function create()
    {
        return view('admin.rent_properties.create');
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
            'image_url' => 'required|url',
            'is_featured' => 'boolean',
            'is_pet_friendly' => 'boolean',
            'is_furnished' => 'boolean'
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_pet_friendly'] = $request->has('is_pet_friendly');
        $validated['is_furnished'] = $request->has('is_furnished');
        
        RentProperty::create($validated);

        return redirect()->route('admin.rent-properties.index')->with('success', 'Rent Property created successfully.');
    }

    public function show(RentProperty $rentProperty)
    {
        return view('admin.rent_properties.show', compact('rentProperty'));
    }

    public function edit(RentProperty $rentProperty)
    {
        return view('admin.rent_properties.edit', compact('rentProperty'));
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
            'image_url' => 'required|url',
            'is_featured' => 'boolean',
            'is_pet_friendly' => 'boolean',
            'is_furnished' => 'boolean'
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_pet_friendly'] = $request->has('is_pet_friendly');
        $validated['is_furnished'] = $request->has('is_furnished');
        
        $rentProperty->update($validated);

        return redirect()->route('admin.rent-properties.index')->with('success', 'Rent Property updated successfully.');
    }

    public function destroy(RentProperty $rentProperty)
    {
        $rentProperty->delete();
        return redirect()->route('admin.rent-properties.index')->with('success', 'Rent Property deleted successfully.');
    }
}
