<?php

namespace App\Http\Controllers\Frontend;

use App\Models\RentProperty;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class RentController extends Controller
{
    /**
     * Display a listing of rental properties.
     */
    public function index(Request $request)
    {
        return $this->renderRentListings($request);
    }

    /**
     * Display the specified rental property.
     */
    public function show($id)
    {
        $property = RentProperty::with('agent')->findOrFail($id);

        return view('frontend.properties.rent-detail', compact('property'));
    }

    /**
     * Search/filter rental properties.
     */
    public function search(Request $request)
    {
        return $this->renderRentListings($request);
    }

    /**
     * Show properties by location (optional)
     */
    public function byLocation($location)
    {
        $request = Request::create('', 'GET', ['location' => $location]);

        return $this->renderRentListings($request);
    }

    private function renderRentListings(Request $request)
    {
        $activeFilters = $this->activeFilters($request);
        $isSearching = ! empty($activeFilters);

        $rentProperties = $isSearching
            ? $this->filterProperties(RentProperty::latest()->get(), $activeFilters)
            : RentProperty::latest()->get();

        $totalProperties = $rentProperties->count();
        $requiredMatches = $this->requiredMatchCount(count($activeFilters));

        return view('frontend.properties.rent', compact(
            'rentProperties',
            'totalProperties',
            'isSearching',
            'activeFilters',
            'requiredMatches'
        ));
    }

    private function activeFilters(Request $request): array
    {
        $filters = [];

        if ($request->filled('min_rent')) {
            $filters['min_rent'] = (float) $request->min_rent;
        }

        if ($request->filled('max_rent')) {
            $filters['max_rent'] = (float) $request->max_rent;
        }

        if ($request->filled('bedrooms') && $request->bedrooms !== 'Any') {
            $filters['bedrooms'] = $request->bedrooms;
        }

        if ($request->filled('bathrooms') && $request->bathrooms !== 'Any') {
            $filters['bathrooms'] = $request->bathrooms;
        }

        if ($request->filled('location')) {
            $filters['location'] = trim($request->location);
        }

        if ($request->filled('pet_friendly') && $request->pet_friendly !== '') {
            $filters['pet_friendly'] = (bool) (int) $request->pet_friendly;
        }

        if ($request->filled('furnished') && $request->furnished !== '') {
            $filters['furnished'] = (bool) (int) $request->furnished;
        }

        if ($request->boolean('featured')) {
            $filters['featured'] = true;
        }

        return $filters;
    }

    private function requiredMatchCount(int $activeFilterCount): int
    {
        if ($activeFilterCount === 0) {
            return 0;
        }

        if ($activeFilterCount === 1) {
            return 1;
        }

        return 2;
    }

    private function filterProperties(Collection $properties, array $filters): Collection
    {
        $requiredMatches = $this->requiredMatchCount(count($filters));

        return $properties->filter(function (RentProperty $property) use ($filters, $requiredMatches) {
            $score = 0;

            foreach ($filters as $key => $value) {
                if ($this->propertyMatchesFilter($property, $key, $value)) {
                    $score++;
                }
            }

            return $score >= $requiredMatches;
        })->values();
    }

    private function propertyMatchesFilter(RentProperty $property, string $key, mixed $value): bool
    {
        return match ($key) {
            'min_rent' => (float) $property->monthly_rent >= (float) $value,
            'max_rent' => (float) $property->monthly_rent <= (float) $value,
            'bedrooms' => $value === '4+'
                ? (int) $property->bedrooms >= 4
                : (int) $property->bedrooms === (int) $value,
            'bathrooms' => $value === '3+'
                ? (int) $property->bathrooms >= 3
                : (int) $property->bathrooms === (int) $value,
            'location' => str_contains(
                strtolower($property->location ?? ''),
                strtolower((string) $value)
            ),
            'pet_friendly' => (bool) $property->is_pet_friendly === (bool) $value,
            'furnished' => (bool) $property->is_furnished === (bool) $value,
            'featured' => (bool) $property->is_featured === true,
            default => false,
        };
    }
}
