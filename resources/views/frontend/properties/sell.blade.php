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

    <!-- Form Section -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 -mt-16 relative z-20">
        <div class="bg-white rounded-2xl shadow-2xl p-8 sm:p-12 border border-slate-100">
            @if(session('success'))
                <!-- Fixed Top-Right Toast Notification -->
                <div id="toast-notification" class="fixed top-24 right-6 z-50 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl shadow-2xl flex items-center gap-4 transition-all transform duration-500 translate-y-0 opacity-100 max-w-sm">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm">Success!</h4>
                        <p class="text-xs mt-0.5">{{ session('success') }}</p>
                    </div>
                    <button onclick="document.getElementById('toast-notification').style.display='none'" class="ml-auto flex-shrink-0 text-emerald-600 hover:text-emerald-800 focus:outline-none">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <!-- Auto-dismiss script for the toast -->
                <script>
                    setTimeout(function() {
                        const toast = document.getElementById('toast-notification');
                        if (toast) {
                            toast.style.opacity = '0';
                            toast.style.transform = 'translateY(-1rem)';
                            setTimeout(() => toast.style.display = 'none', 500);
                        }
                    }, 5000);
                </script>
            @endif

            <div class="mb-10 text-center">
                <h2 class="text-3xl font-extrabold text-slate-900">Request an Appraisal</h2>
                <p class="text-slate-500 mt-2">Fill out the form below and we'll get back to you within 24 hours.</p>
                @auth
                    <p class="text-sm text-slate-500 mt-3 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 inline-block">
                        Your name and email are filled from your account. Just add your phone number and property details.
                    </p>
                @endauth
            </div>

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
                            <option value="Single Family Home">Single Family Home</option>
                            <option value="Condo/Apartment">Condo/Apartment</option>
                            <option value="Townhouse">Townhouse</option>
                            <option value="Multi-Family">Multi-Family</option>
                            <option value="Land">Land</option>
                        </select>
                        @error('property_type') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label for="property_address" class="block text-sm font-semibold text-slate-700 mb-1">Property Address</label>
                    <input type="text" name="property_address" id="property_address" required class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors shadow-sm" placeholder="123 Luxury Ave, Beverly Hills, CA 90210" value="{{ old('property_address') }}">
                    @error('property_address') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="estimated_value" class="block text-sm font-semibold text-slate-700 mb-1">Estimated Value (KSh) <span class="text-slate-400 font-normal">(Optional)</span></label>
                    <input type="number" name="estimated_value" id="estimated_value" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors shadow-sm" placeholder="1500000" value="{{ old('estimated_value') }}">
                    @error('estimated_value') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="additional_info" class="block text-sm font-semibold text-slate-700 mb-1">Additional Details <span class="text-slate-400 font-normal">(Optional)</span></label>
                    <textarea name="additional_info" id="additional_info" rows="4" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors shadow-sm" placeholder="Tell us about recent renovations, unique features, or anything else we should know.">{{ old('additional_info') }}</textarea>
                    @error('additional_info') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 px-6 rounded-xl transition-all shadow-lg shadow-indigo-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 flex justify-center items-center gap-2 group">
                        Submit Inquiry
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
