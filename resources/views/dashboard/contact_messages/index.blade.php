@extends('dashboard.layout')

@section('title', 'Contact Messages')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-semibold text-gray-800">Contact Messages</h2>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">From</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subject</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Property</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($messages as $message)
                <tr class="{{ $message->is_read ? '' : 'bg-indigo-50/50' }}">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $message->created_at->format('M d, Y H:i') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $message->name }}</div>
                        <div class="text-sm text-gray-500">{{ $message->email }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">{{ $message->subject }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ str_replace('_', ' ', ucfirst($message->inquiry_type ?? 'general')) }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        @if($message->rentProperty)
                            {{ $message->rentProperty->title }}
                        @elseif($message->property)
                            {{ $message->property->title ?? $message->property->address }}
                        @else
                            —
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($message->status === 'replied')
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Replied ({{ $message->replies_count }})</span>
                        @elseif($message->is_read)
                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-600">Read</span>
                        @else
                            <span class="px-2 py-1 text-xs rounded-full bg-indigo-100 text-indigo-700">New</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm space-x-3">
                        <a href="{{ route('panel.contact-messages.show', $message) }}" class="text-indigo-600 hover:text-indigo-900">{{ $message->status === 'replied' ? 'Reply' : 'View' }}</a>
                        <form action="{{ route('panel.contact-messages.destroy', $message) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this message?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">No contact messages yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $messages->links() }}
</div>
@endsection
