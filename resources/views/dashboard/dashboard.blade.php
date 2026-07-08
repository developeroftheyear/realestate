@extends('dashboard.layout')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-indigo-500">
        <h3 class="text-gray-500 text-sm uppercase tracking-wider">Properties</h3>
        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['properties_count'] }}</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-blue-500">
        <h3 class="text-gray-500 text-sm uppercase tracking-wider">Rentals</h3>
        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['rent_properties_count'] }}</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-green-500">
        <h3 class="text-gray-500 text-sm uppercase tracking-wider">Agents</h3>
        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['agents_count'] }}</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6 border-t-4 border-yellow-500">
        <h3 class="text-gray-500 text-sm uppercase tracking-wider">Sell Inquiries</h3>
        <p class="text-3xl font-bold text-gray-800 mt-2">{{ $stats['sell_inquiries_count'] }}</p>
        <a href="{{ route('panel.sell-inquiries.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 mt-2 inline-block">View all &rarr;</a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-600">
        <h3 class="text-gray-500 text-sm uppercase tracking-wider">Apply to Rent</h3>
        <p class="text-2xl font-bold text-gray-800 mt-2">{{ $stats['apply_to_rent_count'] }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-indigo-600">
        <h3 class="text-gray-500 text-sm uppercase tracking-wider">Schedule Viewing</h3>
        <p class="text-2xl font-bold text-gray-800 mt-2">{{ $stats['schedule_viewing_count'] }}</p>
    </div>
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-red-500">
        <h3 class="text-gray-500 text-sm uppercase tracking-wider">Unread Messages</h3>
        <p class="text-2xl font-bold text-gray-800 mt-2">{{ $stats['unread_messages_count'] }}</p>
    </div>
</div>

<div class="mt-8 bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h2 class="text-lg font-semibold text-gray-800">Recent Contact Messages</h2>
        <a href="{{ route('panel.contact-messages.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">View all</a>
    </div>

    @if($recentMessages->isEmpty())
        <p class="p-6 text-gray-500">No contact messages yet.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">From</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subject</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Property</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($recentMessages as $message)
                        <tr class="{{ $message->is_read ? '' : 'bg-indigo-50/50' }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $message->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $message->name }}</div>
                                <div class="text-sm text-gray-500">{{ $message->email }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $message->subject }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($message->rentProperty)
                                    Rental: {{ $message->rentProperty->title }}
                                @elseif($message->property)
                                    Buy: {{ $message->property->title ?? $message->property->address }}
                                @else
                                    —
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($message->is_read)
                                    <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-600">Read</span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded-full bg-indigo-100 text-indigo-700">New</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                                <a href="{{ route('panel.contact-messages.show', $message) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
