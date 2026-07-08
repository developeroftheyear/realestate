@extends('frontend.layouts.app')

@section('title', 'TashleyHomes - Sell Your Property')

@section('content')
    <!-- Hero Banner Section -->
    <header class="relative bg-slate-900 py-24 sm:py-32 overflow-hidden">
        <div class="absolute inset-0 z-0 pointer-events-none" aria-hidden="true">
            <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=1920&q=80" alt="" class="w-full h-full object-cover opacity-30 filter brightness-75">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/80 to-transparent"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 mb-6 backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                List With The Best
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-tight">
                Sell Your Home<br><span class="text-indigo-400">Faster & For More</span>
            </h1>
            <p class="mt-6 max-w-2xl mx-auto text-lg text-slate-300">
                Connect with our top-tier agents who have the expertise and exclusive network to market your property to the right buyers.
            </p>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 mt-8 relative z-20">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-100 flex flex-col lg:flex-row">

            <!-- Sell Info Sidebar -->
            <div class="lg:w-1/3 bg-indigo-900 p-10 text-white flex flex-col justify-between">
                <div>
                    <h3 class="text-2xl font-bold mb-6">Why Sell With Us</h3>
                    <p class="text-indigo-200 mb-10 leading-relaxed">
                        Request a free appraisal and our team will get back to you within 24 hours with a tailored selling plan.
                    </p>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-indigo-800 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Free Appraisal</h4>
                                <p class="text-indigo-200 text-sm">Get an accurate market valuation with no upfront cost.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-indigo-800 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Expert Agents</h4>
                                <p class="text-indigo-200 text-sm">Work with specialists who know your neighborhood.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-indigo-800 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Maximize Value</h4>
                                <p class="text-indigo-200 text-sm">Strategic pricing and marketing to reach serious buyers.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-indigo-800 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.48-3.909-7.075-6.805l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Talk To Us</h4>
                                <a href="tel:+254792051974" class="text-indigo-200 text-sm hover:text-white transition-colors">+254 792 051 974</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Container -->
            <div class="lg:w-2/3 p-10 sm:p-14">
                @if(session('success'))
                    <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl flex items-center gap-3">
                        <svg class="w-6 h-6 text-emerald-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <div>
                            <h4 class="font-bold">Inquiry Submitted!</h4>
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <h2 class="text-3xl font-extrabold text-slate-900 mb-2">Request an Appraisal</h2>
                <p class="text-slate-500 mb-8">Tell us about your property and we'll prepare a selling strategy for you.</p>

                @auth
                    <p class="mb-6 text-sm text-slate-500 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3">
                        Your name and email are filled from your account. Just add your phone number and property details.
                    </p>
                @endauth

                <form action="{{ route('sell.submit') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-slate-700 mb-1">Full Name</label>
                            <input type="text" name="name" id="name" required @auth readonly @endauth class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors shadow-sm @auth bg-slate-50 text-slate-700 @endauth" placeholder="John Doe" value="{{ old('name', auth()->user()?->name) }}">
                            @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-semibold text-slate-700 mb-1">Email Address</label>
                            <input type="email" name="email" id="email" required @auth readonly @endauth class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors shadow-sm @auth bg-slate-50 text-slate-700 @endauth" placeholder="john@example.com" value="{{ old('email', auth()->user()?->email) }}">
                            @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-slate-700 mb-1">Phone Number</label>
                            <input type="text" name="phone" id="phone" required @auth autofocus @endauth class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors shadow-sm" placeholder="(555) 123-4567" value="{{ old('phone') }}">
                            @error('phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="property_type" class="block text-sm font-semibold text-slate-700 mb-1">Property Type</label>
                            <select name="property_type" id="property_type" required class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors shadow-sm">
                                <option value="">Select type...</option>
                                <option value="Single Family Home" @selected(old('property_type') === 'Single Family Home')>Single Family Home</option>
                                <option value="Condo/Apartment" @selected(old('property_type') === 'Condo/Apartment')>Condo/Apartment</option>
                                <option value="Townhouse" @selected(old('property_type') === 'Townhouse')>Townhouse</option>
                                <option value="Multi-Family" @selected(old('property_type') === 'Multi-Family')>Multi-Family</option>
                                <option value="Land" @selected(old('property_type') === 'Land')>Land</option>
                            </select>
                            @error('property_type') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="property_address" class="block text-sm font-semibold text-slate-700 mb-1">Property Address</label>
                        <div class="relative">
                            <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                            <input type="text" name="property_address" id="property_address" required class="w-full rounded-xl border-slate-200 pl-10 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors shadow-sm" placeholder="Search or enter address, e.g. Westlands, Nairobi" value="{{ old('property_address') }}">
                        </div>
                        @error('property_address') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="estimated_value" class="block text-sm font-semibold text-slate-700 mb-1">Estimated Value <span class="text-slate-400 font-normal">(Optional)</span></label>
                        <select name="estimated_value" id="estimated_value" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors shadow-sm">
                            <option value="">Select estimated value...</option>
                            <option value="2500000" @selected(old('estimated_value') == '2500000')>Under KSh 5M</option>
                            <option value="7500000" @selected(old('estimated_value') == '7500000')>KSh 5M – 10M</option>
                            <option value="17500000" @selected(old('estimated_value') == '17500000')>KSh 10M – 25M</option>
                            <option value="37500000" @selected(old('estimated_value') == '37500000')>KSh 25M – 50M</option>
                            <option value="75000000" @selected(old('estimated_value') == '75000000')>KSh 50M+</option>
                        </select>
                        @error('estimated_value') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="additional_info" class="block text-sm font-semibold text-slate-700 mb-1">Additional Details <span class="text-slate-400 font-normal">(Optional)</span></label>
                        <textarea name="additional_info" id="additional_info" rows="4" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors shadow-sm" placeholder="Tell us about recent renovations, unique features, or anything else we should know.">{{ old('additional_info') }}</textarea>
                        @error('additional_info') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl transition-all shadow-lg shadow-indigo-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 inline-flex justify-center items-center gap-2 group">
                            Submit Inquiry
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
