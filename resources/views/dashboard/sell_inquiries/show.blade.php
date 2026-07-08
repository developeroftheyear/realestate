@extends('dashboard.layout')

@section('title', 'Sell Inquiry Details')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('panel.sell-inquiries.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">&larr; Back to Sell Inquiries</a>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">{{ $sellInquiry->name }}</h2>
                <p class="text-sm text-gray-500 mt-1">Submitted {{ $sellInquiry->created_at->format('F d, Y \a\t H:i') }}</p>
            </div>
            <a href="mailto:{{ $sellInquiry->email }}?subject={{ rawurlencode('Re: Your property listing inquiry') }}&body={{ rawurlencode('Hi ' . $sellInquiry->name . ', thank you for your interest in listing your property with TashleyHomes.') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition">
                Reply via Email
            </a>
        </div>

        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <dt class="text-sm font-medium text-gray-500">Email</dt>
                <dd class="mt-1 text-sm text-gray-900">
                    <a href="mailto:{{ $sellInquiry->email }}" class="text-indigo-600 hover:text-indigo-800">{{ $sellInquiry->email }}</a>
                </dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Phone</dt>
                <dd class="mt-1 text-sm text-gray-900">
                    <a href="tel:{{ preg_replace('/\s+/', '', $sellInquiry->phone) }}" class="text-indigo-600 hover:text-indigo-800">{{ $sellInquiry->phone }}</a>
                </dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Property Address</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $sellInquiry->property_address }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Property Type</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $sellInquiry->property_type }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-gray-500">Estimated Value</dt>
                <dd class="mt-1 text-sm text-gray-900">
                    @if($sellInquiry->estimated_value)
                        KSh {{ number_format($sellInquiry->estimated_value) }}
                    @else
                        Not provided
                    @endif
                </dd>
            </div>
        </dl>

        @if($sellInquiry->additional_info)
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Additional Information</h3>
                <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $sellInquiry->additional_info }}</p>
            </div>
        @endif

        <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
            <form action="{{ route('panel.sell-inquiries.destroy', $sellInquiry) }}" method="POST" onsubmit="return confirm('Delete this inquiry?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Delete Inquiry</button>
            </form>
        </div>
    </div>
</div>
@endsection
