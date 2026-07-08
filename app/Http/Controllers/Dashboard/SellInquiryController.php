<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\SellInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SellInquiryController extends Controller
{
    public function index(): View
    {
        $inquiries = SellInquiry::latest()->paginate(15);

        return view('dashboard.sell_inquiries.index', compact('inquiries'));
    }

    public function show(SellInquiry $sellInquiry): View
    {
        return view('dashboard.sell_inquiries.show', compact('sellInquiry'));
    }

    public function destroy(SellInquiry $sellInquiry): RedirectResponse
    {
        $sellInquiry->delete();

        return redirect()
            ->route('panel.sell-inquiries.index')
            ->with('success', 'Sell inquiry deleted successfully.');
    }
}
