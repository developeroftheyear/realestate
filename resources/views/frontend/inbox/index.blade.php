@extends('frontend.layouts.app')

@section('title', 'My Inbox - RealEstate')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900">My Inbox</h1>
        <p class="text-slate-500 mt-2">View your inquiries and responses from our team.</p>
    </div>

    @if($messages->isEmpty())
        <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-12 text-center">
            <svg class="w-16 h-16 text-slate-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
            </svg>
            <p class="text-slate-600">No messages yet.</p>
            <a href="{{ route('contact.index') }}" class="inline-block mt-4 text-indigo-600 hover:text-indigo-800 font-medium">Contact us &rarr;</a>
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden divide-y divide-slate-100">
            @foreach($messages as $message)
                @php $hasUnread = in_array($message->id, $unreadMessageIds, true); @endphp
                <a href="{{ route('inbox.show', $message) }}" class="block px-6 py-5 hover:bg-slate-50 transition-colors {{ $hasUnread ? 'bg-indigo-50/40 border-l-4 border-indigo-500' : '' }}">
                    <div class="flex justify-between items-start gap-4">
                        <div class="flex-1 min-w-0 flex items-start gap-3">
                            @if($hasUnread)
                                <span class="mt-2 h-2.5 w-2.5 shrink-0 rounded-full bg-red-500" aria-hidden="true"></span>
                            @endif
                            <div class="min-w-0">
                            <p class="font-semibold text-slate-900 truncate">{{ $message->subject }}</p>
                            <p class="text-sm text-slate-500 mt-1 line-clamp-2">{{ $message->message }}</p>
                            <p class="text-xs text-slate-400 mt-2">{{ $message->created_at->format('M d, Y g:i A') }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col items-end gap-2 shrink-0">
                            @if($message->status === 'replied')
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700 font-medium">{{ $message->replies_count }} {{ Str::plural('reply', $message->replies_count) }}</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700 font-medium">Awaiting reply</span>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $messages->links() }}
        </div>
    @endif
</div>
@endsection
