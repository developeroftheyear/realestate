<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\ContactMessage;
use App\Models\Property;
use App\Models\RentProperty;
use App\Models\SellInquiry;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'properties_count' => Property::count(),
            'rent_properties_count' => RentProperty::count(),
            'agents_count' => Agent::count(),
            'contact_messages_count' => ContactMessage::count(),
            'sell_inquiries_count' => SellInquiry::count(),
            'apply_to_rent_count' => ContactMessage::where('inquiry_type', 'apply_to_rent')->count(),
            'schedule_viewing_count' => ContactMessage::where('inquiry_type', 'schedule_viewing')->count(),
            'unread_messages_count' => ContactMessage::where('is_read', false)->count(),
        ];

        $recentMessages = ContactMessage::with(['property', 'rentProperty'])
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard.dashboard', compact('stats', 'recentMessages'));
    }
}
