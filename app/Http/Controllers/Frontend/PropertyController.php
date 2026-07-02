<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Agent;
use App\Models\Property;
use App\Models\SellInquiry;
use App\Http\Controllers\Controller;
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
        return view('frontend.properties.properties', compact('properties'));
    }

    /**
     * Display a single property for sale
     */
    public function show($id)
    {
        $property = Property::findOrFail($id);
        return view('frontend.properties.buy-detail', compact('property'));
    }

    /**
     * Display the sell page
     */
    public function sell()
    {
        return view('frontend.properties.sell');
    }

    /**
     * Handle the sell form submission
     */
    public function submitSell(Request $request)
    {
        if ($request->user()) {
            $request->merge([
                'name' => $request->user()->name,
                'email' => $request->user()->email,
            ]);
        }

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
        return view('frontend.agents.agents', compact('agents'));
    }

}