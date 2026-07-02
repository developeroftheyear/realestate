<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Property;
use App\Models\RentProperty;
use App\Models\Agent;
use App\Models\ContactMessage;
use App\Models\SellInquiry;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'properties_count' => Property::count(),
            'rent_properties_count' => RentProperty::count(),
            'agents_count' => Agent::count(),
            'contact_messages_count' => ContactMessage::count(),
            'sell_inquiries_count' => SellInquiry::count(),
        ];
        
        return view('dashboard.dashboard', compact('stats'));
    }
}
