@extends('layouts')

@section('title', $property->title . ' - Rent | TashleyHomes')

@section('content')
    <!-- Property Detail Section -->
    <div class="container mx-auto px-6 py-12">
        <a href="{{ route('rent.index') }}" class="text-blue-600 mb-6 inline-block hover:text-blue-800 transition">
            <i class="fas fa-arrow-left mr-2"></i>Back to Rentals
        </a>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Image & Details -->
            <div class="lg:col-span-2">
                <img src="{{ $property->image_url ?? 'https://via.placeholder.com/800x400' }}" alt="{{ $property->title ?? 'Property' }}" class="w-full h-96 object-cover rounded-xl shadow-lg">
                
                <div class="mt-6">
                    <h1 class="text-3xl font-bold text-gray-800">{{ $property->title ?? 'Property Title' }}</h1>
                    <p class="text-gray-500 mt-1">
                        <i class="fas fa-map-marker-alt text-blue-500 mr-1"></i> 
                        {{ $property->location ?? 'Location not specified' }}
                    </p>
                    
                    <div class="grid grid-cols-3 gap-4 mt-6 py-4 border-y">
                        <div>
                            <span class="text-gray-500">Bedrooms:</span> 
                            <span class="font-semibold">{{ $property->bedrooms ?? 0 }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Bathrooms:</span> 
                            <span class="font-semibold">{{ $property->bathrooms ?? 0 }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Area:</span> 
                            <span class="font-semibold">{{ number_format($property->area_sqft ?? 0) }} sqft</span>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <h3 class="text-xl font-semibold mb-3">Description</h3>
                        <p class="text-gray-600 leading-relaxed">{{ $property->description ?? 'No description available for this property.' }}</p>
                    </div>

                    <!-- Rent-specific amenities -->
                    @if(isset($property->is_pet_friendly) || isset($property->is_furnished))
                    <div class="mt-6 pt-4 border-t">
                        <h3 class="text-xl font-semibold mb-3">Amenities</h3>
                        <div class="flex flex-wrap gap-3">
                            @if($property->is_pet_friendly ?? false)
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-paw mr-1"></i> Pet Friendly
                            </span>
                            @endif
                            @if($property->is_furnished ?? false)
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-couch mr-1"></i> Furnished
                            </span>
                            @endif
                            @if($property->has_parking ?? false)
                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-parking mr-1"></i> Parking Available
                            </span>
                            @endif
                            @if($property->has_pool ?? false)
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-swimmer mr-1"></i> Pool
                            </span>
                            @endif
                            @if($property->has_gym ?? false)
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-dumbbell mr-1"></i> Gym
                            </span>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <!-- Rent Specific Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg p-6 sticky top-6">
                    <div class="border-b pb-4 mb-4">
                        <p class="text-gray-500">Monthly Rent</p>
                        <p class="text-4xl font-bold text-blue-600">
                            KSh {{ number_format($property->monthly_rent ?? 0) }} 
                            <span class="text-lg text-gray-500">/month</span>
                        </p>
                    </div>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Security Deposit:</span>
                            <span class="font-semibold">KSh {{ number_format($property->security_deposit ?? 0) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Lease Term:</span>
                            <span class="font-semibold">{{ $property->lease_term ?? '12 months' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Available From:</span>
                            <span class="font-semibold text-green-600">
                                {{ isset($property->available_from) ? $property->available_from->format('F d, Y') : 'Immediately' }}
                            </span>
                        </div>
                    </div>

                    <!-- Rent Features -->
                    <div class="border-t pt-4 mb-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Application Fee:</span>
                            <span class="font-semibold">KSh {{ number_format($property->application_fee ?? 50) }}</span>
                        </div>
                        <div class="flex justify-between text-sm mt-2">
                            <span class="text-gray-500">Property ID:</span>
                            <span class="font-semibold">#{{ $property->id ?? 'N/A' }}</span>
                        </div>
                    </div>
                    
                    <!-- Application Form - Rent specific -->
                    <button class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition mb-3 shadow-lg hover:shadow-blue-100">
                        <i class="fas fa-file-alt mr-2"></i>Apply to Rent
                    </button>
                    
                    <button class="w-full border border-blue-600 text-blue-600 py-3 rounded-lg hover:bg-blue-50 transition">
                        <i class="fas fa-calendar-alt mr-2"></i>Schedule Viewing
                    </button>

                    <!-- Contact Agent -->
                    <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-600 mb-2">
                            <i class="fas fa-user-circle mr-2 text-blue-600"></i>Listed by:
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="font-semibold text-gray-800">{{ $property->agent_name ?? 'TashleyHomes Team' }}</span>
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-phone mr-1"></i> {{ $property->agent_phone ?? '(+254) 7
                                    12345678' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection