<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Notifications\InquiryReplyNotification;
use Illuminate\Http\Request;
use Illuminate\View\View;

class InboxController extends Controller
{
    public function index(Request $request): View
    {
        $messages = ContactMessage::forUser($request->user())
            ->with(['replies.admin', 'property', 'rentProperty'])
            ->withCount('replies')
            ->latest()
            ->paginate(10);

        $unreadMessageIds = $request->user()->unreadNotifications()
            ->where('type', InquiryReplyNotification::class)
            ->get()
            ->pluck('data.contact_message_id')
            ->map(fn ($id) => (int) $id)
            ->all();

        return view('frontend.inbox.index', compact('messages', 'unreadMessageIds'));
    }

    public function show(Request $request, ContactMessage $contactMessage): View
    {
        abort_unless(
            $contactMessage->user_id === $request->user()->id
            || $contactMessage->email === $request->user()->email,
            403
        );

        $contactMessage->load(['replies.admin', 'property', 'rentProperty']);

        $request->user()->unreadNotifications()
            ->where('type', InquiryReplyNotification::class)
            ->get()
            ->filter(fn ($notification) => (int) ($notification->data['contact_message_id'] ?? 0) === $contactMessage->id)
            ->each->markAsRead();

        return view('frontend.inbox.show', compact('contactMessage'));
    }
}
