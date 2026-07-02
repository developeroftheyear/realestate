@extends('dashboard.layout')

@section('title', 'Message Details')

@section('content')
<div class="mb-6">
    <a href="{{ route('panel.contact-messages.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">&larr; Back to messages</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-start">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">{{ $contactMessage->subject }}</h2>
            <p class="text-sm text-gray-500 mt-1">{{ $contactMessage->created_at->format('F d, Y \a\t g:i A') }}</p>
        </div>
        <div class="flex gap-2">
            <span class="px-3 py-1 text-sm rounded-full {{ $contactMessage->status === 'replied' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                {{ ucfirst($contactMessage->status ?? 'open') }}
            </span>
            <span class="px-3 py-1 text-sm rounded-full {{ $contactMessage->is_read ? 'bg-gray-100 text-gray-600' : 'bg-indigo-100 text-indigo-700' }}">
                {{ $contactMessage->is_read ? 'Read' : 'New' }}
            </span>
        </div>
    </div>

    <div class="p-6 space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Contact</h3>
                <p class="text-gray-900 font-medium">{{ $contactMessage->name }}</p>
                <p class="text-gray-600">{{ $contactMessage->email }}</p>
                @if($contactMessage->phone)
                    <p class="text-gray-600">{{ $contactMessage->phone }}</p>
                @endif
                @if($contactMessage->user)
                    <p class="text-sm text-indigo-600 mt-1">Registered user — notifications enabled</p>
                @else
                    <p class="text-sm text-gray-500 mt-1">Guest inquiry{{ $contactMessage->resolveUser() ? ' (matched by email)' : '' }}</p>
                @endif
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Inquiry Details</h3>
                <p class="text-gray-900"><span class="text-gray-500">Type:</span> {{ str_replace('_', ' ', ucfirst($contactMessage->inquiry_type ?? 'general')) }}</p>
                <p class="text-gray-900 mt-1"><span class="text-gray-500">Subject:</span> {{ $contactMessage->subject }}</p>
                @if($contactMessage->rentProperty)
                    <p class="text-gray-900 mt-1"><span class="text-gray-500">Rental:</span> {{ $contactMessage->rentProperty->title }} (#{{ $contactMessage->rentProperty->id }})</p>
                @elseif($contactMessage->property)
                    <p class="text-gray-900 mt-1"><span class="text-gray-500">Property:</span> {{ $contactMessage->property->title ?? $contactMessage->property->address }} (#{{ $contactMessage->property->id }})</p>
                @endif
            </div>
        </div>

        <div>
            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-2">Original Message</h3>
            <div class="bg-gray-50 rounded-lg p-4 text-gray-800 whitespace-pre-wrap border-l-4 border-indigo-500">{{ $contactMessage->message }}</div>
        </div>

        @if($contactMessage->replies->isNotEmpty())
            <div>
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider mb-3">Conversation</h3>
                <div class="space-y-3">
                    @foreach($contactMessage->replies->sortBy('created_at') as $reply)
                        <div class="bg-indigo-50 rounded-lg p-4 border border-indigo-100">
                            <div class="flex justify-between items-start mb-2">
                                <p class="text-sm font-semibold text-indigo-900">{{ $reply->admin->name }} <span class="font-normal text-indigo-600">(Admin)</span></p>
                                <p class="text-xs text-gray-500">{{ $reply->created_at->format('M d, Y g:i A') }}</p>
                            </div>
                            <p class="text-gray-800 whitespace-pre-wrap">{{ $reply->body }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="pt-4 border-t border-gray-200">
            <h3 class="text-sm font-medium text-gray-700 mb-3">Send Reply</h3>
            <form action="{{ route('panel.contact-messages.reply', $contactMessage) }}" method="POST" class="space-y-4">
                @csrf
                <textarea name="body" rows="5" required placeholder="Type your response to the customer..." class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 border p-3">{{ old('body') }}</textarea>
                @error('body') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700 transition">Send Reply & Notify User</button>
            </form>

            <form action="{{ route('panel.contact-messages.destroy', $contactMessage) }}" method="POST" class="mt-4" onsubmit="return confirm('Delete this message?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded shadow hover:bg-red-700 transition">Delete Message</button>
            </form>
        </div>
    </div>
</div>
@endsection
