@extends('frontend.layouts.app')

@section('title', $contactMessage->subject . ' - Inbox')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <a href="{{ route('inbox.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium mb-6 inline-block">&larr; Back to inbox</a>

    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h1 class="text-xl font-bold text-slate-900">{{ $contactMessage->subject }}</h1>
            <p class="text-sm text-slate-500 mt-1">Sent {{ $contactMessage->created_at->format('F d, Y \a\t g:i A') }}</p>
            @if($contactMessage->rentProperty)
                <p class="text-sm text-indigo-600 mt-2">Re: {{ $contactMessage->rentProperty->title }}</p>
            @elseif($contactMessage->property)
                <p class="text-sm text-indigo-600 mt-2">Re: {{ $contactMessage->property->title ?? $contactMessage->property->address }}</p>
            @endif
        </div>

        <div class="p-6 space-y-6">
            <div>
                <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Your message</p>
                <div class="bg-slate-50 rounded-xl p-4 text-slate-800 whitespace-pre-wrap border-l-4 border-slate-300">{{ $contactMessage->message }}</div>
            </div>

            @if($contactMessage->replies->isNotEmpty())
                <div>
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Responses from our team</p>
                    <div class="space-y-4">
                        @foreach($contactMessage->replies->sortBy('created_at') as $reply)
                            <div class="bg-indigo-50 rounded-xl p-4 border border-indigo-100">
                                <div class="flex justify-between items-start mb-2">
                                    <p class="text-sm font-semibold text-indigo-900">{{ $reply->admin->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $reply->created_at->format('M d, Y g:i A') }}</p>
                                </div>
                                <p class="text-slate-800 whitespace-pre-wrap">{{ $reply->body }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 text-sm text-yellow-800">
                    Our team is reviewing your message. You'll receive a notification here when we reply.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
