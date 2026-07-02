@extends('dashboard.layout')

@section('title', 'Add New Property')

@section('content')
<div class="max-w-4xl mx-auto bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-semibold mb-6">Create Property</h2>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('panel.properties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Price (KES)</label>
                <input type="number" name="price" value="{{ old('price') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" name="address" value="{{ old('address') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Bedrooms</label>
                <input type="number" name="bedrooms" value="{{ old('bedrooms') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Bathrooms</label>
                <input type="number" step="0.5" name="bathrooms" value="{{ old('bathrooms') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Area (sqft)</label>
                <input type="number" name="area_sqft" value="{{ old('area_sqft') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" name="image" accept="image/*" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                <p class="text-xs text-gray-500 mt-1">Upload a photo for this listing (JPEG, PNG, GIF, or WebP, max 2MB).</p>
            </div>
            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-2">{{ old('description') }}</textarea>
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                <label for="is_featured" class="ml-2 block text-sm text-gray-900">Featured Property</label>
            </div>
        </div>

        <div class="flex justify-end gap-4">
            <a href="{{ route('panel.properties.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded shadow hover:bg-gray-300 transition">Cancel</a>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700 transition">Save Property</button>
        </div>
    </form>
</div>
@endsection
