@extends('frontend.layouts.app')

@section('title', 'TashleyHomes - Contact Us')

@section('content')
    <!-- Hero Banner Section -->
    <header class="relative bg-slate-900 py-24 sm:py-32 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <!-- Using a solid dark background with subtle patterns if image is missing -->
            <div class="absolute inset-0 bg-slate-900"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/80 to-transparent"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 mb-6 backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                We're Here to Help
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-tight">
                Get in Touch
            </h1>
            <p class="mt-6 max-w-2xl mx-auto text-lg text-slate-300">
                Whether you're looking to buy, sell, or rent luxury real estate, our dedicated team is ready to provide you with exceptional service.
            </p>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 -mt-16 relative z-20">
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-100 flex flex-col lg:flex-row">
            
            <!-- Contact Info Sidebar -->
            <div class="lg:w-1/3 bg-indigo-900 p-10 text-white flex flex-col justify-between">
                <div>
                    <h3 class="text-2xl font-bold mb-6">Contact Information</h3>
                    <p class="text-indigo-200 mb-10 leading-relaxed">
                        Fill out the form and our team will get back to you within 24 hours. For immediate assistance, please call us directly.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-indigo-800 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Office Location</h4>
                                <p class="text-indigo-200 text-sm">123 Luxury Avenue, Suite 500<br>Beverly Hills, CA 90210</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-indigo-800 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.48-3.909-7.075-6.805l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Phone Number</h4>
                                <p class="text-indigo-200 text-sm">+1 (800) 555-0199</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-indigo-800 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-indigo-300" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-1">Email Address</h4>
                                <p class="text-indigo-200 text-sm">support@tashleyhomes.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Container -->
            <div class="lg:w-2/3 p-10 sm:p-14">
                @if(session('success'))
                    <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl flex items-center gap-3">
                        <svg class="w-6 h-6 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <div>
                            <h4 class="font-bold">Message Sent!</h4>
                            <p class="text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <h2 class="text-3xl font-extrabold text-slate-900 mb-8">Send us a Message</h2>
                
                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-slate-700 mb-1">Full Name</label>
                            <input type="text" name="name" id="name" required class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors shadow-sm" placeholder="John Doe" value="{{ old('name') }}">
                            @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-semibold text-slate-700 mb-1">Email Address</label>
                            <input type="email" name="email" id="email" required class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors shadow-sm" placeholder="john@example.com" value="{{ old('email') }}">
                            @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-slate-700 mb-1">Phone Number <span class="text-slate-400 font-normal">(Optional)</span></label>
                            <input type="text" name="phone" id="phone" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors shadow-sm" placeholder="(555) 123-4567" value="{{ old('phone') }}">
                            @error('phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-semibold text-slate-700 mb-1">Subject</label>
                            <select name="subject" id="subject" required class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors shadow-sm">
                                <option value="">Select a subject...</option>
                                <option value="General Inquiry" {{ old('subject', request('subject')) == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
                                <option value="Schedule a Viewing" {{ old('subject', request('subject')) == 'Schedule a Viewing' ? 'selected' : '' }}>Schedule a Viewing</option>
                                <option value="Property Valuation" {{ old('subject', request('subject')) == 'Property Valuation' ? 'selected' : '' }}>Property Valuation</option>
                                <option value="Partnership" {{ old('subject', request('subject')) == 'Partnership' ? 'selected' : '' }}>Partnership</option>
                                <option value="Other" {{ old('subject', request('subject')) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('subject') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-semibold text-slate-700 mb-1">Message</label>
                        <textarea name="message" id="message" rows="5" required class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors shadow-sm" placeholder="How can we help you?">{{ old('message', request('message')) }}</textarea>
                        @error('message') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl transition-all shadow-lg shadow-indigo-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 inline-flex justify-center items-center gap-2 group">
                            Send Message
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
