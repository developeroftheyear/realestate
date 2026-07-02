<?php

namespace App\Http\Controllers\Frontend;

use App\Models\RentProperty;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RentController extends Controller
{
    /**
     * Display a listing of rental properties.
     */
    public function index()
    {
        // Get all rental properties
        $rentProperties = RentProperty::latest()->get();
        $totalProperties = $rentProperties->count();
        
        // Return the view
        return view('frontend.properties.rent', compact('rentProperties', 'totalProperties'));
    }
    
    /**
     * Display the specified rental property.
     */
    public function show($id)
    {
        // Find the property or throw 404
        $property = RentProperty::findOrFail($id);
        
        // Return the view with property details
        return view('frontend.properties.rent-detail', compact('property'));
    }
    
    /**
     * Search/filter rental properties.
     */
    public function search(Request $request)
    {
        $query = RentProperty::query();
        
        // Filter by minimum monthly rent
        if ($request->has('min_rent') && $request->min_rent) {
            $query->where('monthly_rent', '>=', $request->min_rent);
        }
        
        // Filter by maximum monthly rent
        if ($request->has('max_rent') && $request->max_rent) {
            $query->where('monthly_rent', '<=', $request->max_rent);
        }
        
        // Filter by bedrooms
        if ($request->has('bedrooms') && $request->bedrooms !== '' && $request->bedrooms !== 'Any') {
            if ($request->bedrooms === '4+') {
                $query->where('bedrooms', '>=', 4);
            } else {
                $query->where('bedrooms', $request->bedrooms);
            }
        }
        
        // Filter by bathrooms
        if ($request->has('bathrooms') && $request->bathrooms) {
            $query->where('bathrooms', $request->bathrooms);
        }
        
        // Filter by pet friendly
        if ($request->has('pet_friendly') && $request->pet_friendly !== '') {
            $query->where('is_pet_friendly', $request->pet_friendly);
        }
        
        // Filter by furnished
        if ($request->has('furnished') && $request->furnished !== '') {
            $query->where('is_furnished', $request->furnished);
        }
        
        // Filter by featured
        if ($request->has('featured') && $request->featured) {
            $query->where('is_featured', true);
        }
        
        // Get filtered results
        $rentProperties = $query->latest()->get();
        $totalProperties = $rentProperties->count();
        
        // Return to the rent index with filtered results
        return view('frontend.properties.rent', compact('rentProperties', 'totalProperties'));
    }
    
    /**
     * Show properties by location (optional)
     */
    public function byLocation($location)
    {
        $rentProperties = RentProperty::where('location', 'like', '%' . $location . '%')
                                      ->latest()
                                      ->get();
        $totalProperties = $rentProperties->count();
        
        return view('frontend.properties.rent', compact('rentProperties', 'totalProperties'));
    }
}