<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\ContactMessageReply;
use App\Notifications\InquiryReplyNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function index(): View
    {
        $messages = ContactMessage::with(['property', 'rentProperty', 'replies'])
            ->withCount('replies')
            ->latest()
            ->paginate(15);

        return view('dashboard.contact_messages.index', compact('messages'));
    }

    public function show(ContactMessage $contactMessage): View
    {
        if (! $contactMessage->is_read) {
            $contactMessage->update(['is_read' => true]);
        }

        $contactMessage->load(['property', 'rentProperty', 'replies.admin']);

        return view('dashboard.contact_messages.show', compact('contactMessage'));
    }

    public function reply(Request $request, ContactMessage $contactMessage): RedirectResponse
    {
        $validated = $request->validate([
            'body' => 'required|string|max:5000',
        ]);

        $reply = ContactMessageReply::create([
            'contact_message_id' => $contactMessage->id,
            'admin_id' => $request->user()->id,
            'body' => $validated['body'],
        ]);

        $reply->load('admin');

        $contactMessage->update(['status' => 'replied']);

        $user = $contactMessage->resolveUser();
        if ($user && ! $user->isAdmin()) {
            if (! $contactMessage->user_id) {
                $contactMessage->update(['user_id' => $user->id]);
            }

            $user->notify(new InquiryReplyNotification($contactMessage, $reply));
        }

        return redirect()
            ->route('panel.contact-messages.show', $contactMessage)
            ->with('success', 'Reply sent successfully. The user has been notified.');
    }

    public function destroy(ContactMessage $contactMessage): RedirectResponse
    {
        $contactMessage->delete();

        return redirect()
            ->route('panel.contact-messages.index')
            ->with('success', 'Contact message deleted successfully.');
    }
}
