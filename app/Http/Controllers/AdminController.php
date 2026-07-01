<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\RentProperty;
use App\Models\Agent;
use App\Models\ContactMessage;
use App\Models\SellInquiry;
use Illuminate\Http\Request;

class AdminController extends Controller
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
        
        return view('admin.dashboard', compact('stats'));
    }
}
