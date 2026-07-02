<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('frontend.contact.contact');
    }

    public function submit(Request $request): RedirectResponse
    {
        if ($request->user()) {
            $request->merge([
                'name' => $request->user()->name,
                'email' => $request->user()->email,
            ]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'property_id' => 'nullable|exists:properties,id',
            'rent_property_id' => 'nullable|exists:rent_properties,id',
        ]);

        $validated['inquiry_type'] = ContactMessage::inquiryTypeFromSubject($validated['subject']);

        if ($request->user()) {
            $validated['user_id'] = $request->user()->id;
        }

        ContactMessage::create($validated);

        if ($request->user()) {
            return redirect()->route('inbox.index')->with('success', 'Your message was sent! You can track replies in your inbox.');
        }

        return redirect()->route('contact.index')->with('success', 'Thank you for your message! Our team will get back to you shortly.');
    }
}
