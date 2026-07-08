<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Agent;
use App\Models\Property;
use App\Models\SellInquiry;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PropertyController extends Controller
{
    /**
     * Display properties for sale (Buy page)
     */
    public function index(Request $request)
    {
        return $this->renderBuyListings($request);
    }

    /**
     * Display the dedicated buy listings page (alias of home)
     */
    public function buy(Request $request)
    {
        return $this->renderBuyListings($request);
    }

    /**
     * Display a single property for sale
     */
    public function show($id)
    {
        $property = Property::with('agent')->findOrFail($id);

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
    public function agentFinder(Request $request)
    {
        $agents = Agent::query()->latest()->get();
        $activeFilters = $this->activeAgentFilters($request);
        $isSearching = ! empty($activeFilters);

        if ($isSearching) {
            $agents = $this->filterAgents($agents, $activeFilters);
        }

        return view('frontend.agents.agents', compact('agents', 'isSearching', 'activeFilters'));
    }

    private function renderBuyListings(Request $request)
    {
        $activeFilters = $this->activeBuyFilters($request);
        $isSearching = ! empty($activeFilters);

        $properties = $isSearching
            ? $this->filterBuyProperties(Property::with('agent')->latest()->get(), $activeFilters)
            : Property::with('agent')->latest()->get();

        $totalProperties = $properties->count();

        return view('frontend.properties.properties', compact(
            'properties',
            'totalProperties',
            'isSearching',
            'activeFilters'
        ));
    }

    private function activeBuyFilters(Request $request): array
    {
        $filters = [];

        if ($request->filled('q')) {
            $filters['q'] = trim($request->q);
        }

        if ($request->filled('price_range')) {
            $filters['price_range'] = $request->price_range;
        }

        if ($request->filled('bedrooms') && $request->bedrooms !== '') {
            $filters['bedrooms'] = $request->bedrooms;
        }

        if ($request->filled('bathrooms') && $request->bathrooms !== '') {
            $filters['bathrooms'] = $request->bathrooms;
        }

        return $filters;
    }

    private function filterBuyProperties(Collection $properties, array $filters): Collection
    {
        return $properties->filter(function (Property $property) use ($filters) {
            foreach ($filters as $key => $value) {
                if (! $this->buyPropertyMatchesFilter($property, $key, $value)) {
                    return false;
                }
            }

            return true;
        })->values();
    }

    private function buyPropertyMatchesFilter(Property $property, string $key, mixed $value): bool
    {
        return match ($key) {
            'q' => str_contains(strtolower($property->title ?? ''), strtolower((string) $value))
                || str_contains(strtolower($property->address ?? ''), strtolower((string) $value))
                || str_contains(strtolower($property->description ?? ''), strtolower((string) $value)),
            'price_range' => $this->matchesPriceRange((float) $property->price, (string) $value),
            'bedrooms' => $value === '4+'
                ? (int) $property->bedrooms >= 4
                : (int) $property->bedrooms === (int) $value,
            'bathrooms' => $value === '3+'
                ? (float) $property->bathrooms >= 3
                : (float) $property->bathrooms === (float) $value,
            default => false,
        };
    }

    private function matchesPriceRange(float $price, string $range): bool
    {
        return match ($range) {
            '0-5000000' => $price < 5000000,
            '5000000-10000000' => $price >= 5000000 && $price < 10000000,
            '10000000-25000000' => $price >= 10000000 && $price < 25000000,
            '25000000-50000000' => $price >= 25000000 && $price < 50000000,
            '50000000+' => $price >= 50000000,
            default => true,
        };
    }

    private function activeAgentFilters(Request $request): array
    {
        $filters = [];

        if ($request->filled('q')) {
            $filters['q'] = trim($request->q);
        }

        if ($request->filled('experience') && $request->experience !== '') {
            $filters['experience'] = $request->experience;
        }

        return $filters;
    }

    private function filterAgents(Collection $agents, array $filters): Collection
    {
        return $agents->filter(function (Agent $agent) use ($filters) {
            foreach ($filters as $key => $value) {
                if (! $this->agentMatchesFilter($agent, $key, $value)) {
                    return false;
                }
            }

            return true;
        })->values();
    }

    private function agentMatchesFilter(Agent $agent, string $key, mixed $value): bool
    {
        return match ($key) {
            'q' => str_contains(strtolower($agent->name ?? ''), strtolower((string) $value))
                || str_contains(strtolower($agent->email ?? ''), strtolower((string) $value))
                || str_contains(strtolower($agent->bio ?? ''), strtolower((string) $value)),
            'experience' => (int) $agent->experience_years >= (int) $value,
            default => false,
        };
    }
}
