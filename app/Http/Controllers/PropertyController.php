<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Property;
use App\Models\SellInquiry;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display properties for sale (Buy page)
     */
    public function index()
    {
        // Get all properties (for Buy page)
        $properties = Property::latest()->get();
        
        // Return the correct view (index.blade.php)
        return view('properties.index', compact('properties'));
    }

    /**
     * Display a single property for sale
     */
    public function show($id)
    {
        $property = Property::findOrFail($id);
        return view('properties.buy-detail', compact('property'));
    }

    /**
     * Display the sell page
     */
    public function sell()
    {
        return view('properties.sell');
    }

    /**
     * Handle the sell form submission
     */
    public function submitSell(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'property_address' => 'required|string|max:255',
            'property_type' => 'required|string|max:100',
            'estimated_value' => 'nullable|numeric',
            'additional_info' => 'nullable|string'
        ]);

        SellInquiry::create($validated);

        return redirect()->route('sell.index')->with('success', 'Your inquiry has been submitted successfully. An agent will contact you soon!');
    }

    /**
     * Display agent finder page
     */
    public function agentFinder()
    {
        $agents = Agent::all();
        return view('agents.index', compact('agents'));
    }

}