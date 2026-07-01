@extends('admin.layout')

@section('title', 'Edit Rent Property')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-semibold mb-6">Edit Rent Property</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.rent-properties.update', $rentProperty->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title', $rentProperty->title) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Location</label>
                <input type="text" name="location" value="{{ old('location', $rentProperty->location) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Monthly Rent ($)</label>
                <input type="number" name="monthly_rent" value="{{ old('monthly_rent', $rentProperty->monthly_rent) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Security Deposit ($)</label>
                <input type="number" name="security_deposit" value="{{ old('security_deposit', $rentProperty->security_deposit) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Bedrooms</label>
                <input type="number" name="bedrooms" value="{{ old('bedrooms', $rentProperty->bedrooms) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Bathrooms</label>
                <input type="number" step="0.5" name="bathrooms" value="{{ old('bathrooms', $rentProperty->bathrooms) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Area (sqft)</label>
                <input type="number" name="area_sqft" value="{{ old('area_sqft', $rentProperty->area_sqft) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Lease Term</label>
                <input type="text" name="lease_term" value="{{ old('lease_term', $rentProperty->lease_term) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Available From</label>
                <input type="date" name="available_from" value="{{ old('available_from', optional($rentProperty->available_from)->format('Y-m-d')) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Image URL</label>
                <input type="url" name="image_url" value="{{ old('image_url', $rentProperty->image_url) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">{{ old('description', $rentProperty->description) }}</textarea>
            </div>
            
            <div class="flex items-center">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $rentProperty->is_featured) ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="is_featured" class="ml-2 block text-sm text-gray-900">Featured Property</label>
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="is_pet_friendly" id="is_pet_friendly" value="1" {{ old('is_pet_friendly', $rentProperty->is_pet_friendly) ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="is_pet_friendly" class="ml-2 block text-sm text-gray-900">Pet Friendly</label>
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="is_furnished" id="is_furnished" value="1" {{ old('is_furnished', $rentProperty->is_furnished) ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="is_furnished" class="ml-2 block text-sm text-gray-900">Furnished</label>
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('admin.rent-properties.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded shadow hover:bg-gray-300 transition">Cancel</a>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700 transition">Update Property</button>
        </div>
    </form>
</div>
@endsection
