@extends('frontend.layouts.app')

@section('title', 'TashleyHomes - Find an Agent')

@section('content')
    <!-- Hero Banner Section -->
    <header class="relative bg-slate-900 py-24 sm:py-32 overflow-hidden">
        <div class="absolute inset-0 z-0 pointer-events-none" aria-hidden="true">
            <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=1920&q=80" alt="" class="w-full h-full object-cover opacity-20 filter brightness-50">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-900/90 to-transparent"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 mb-6 backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                Expertise You Can Trust
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-none">
                Our Real Estate Agents
            </h1>
            <p class="mt-6 max-w-2xl mx-auto text-lg text-slate-300">
                Meet the dedicated professionals ready to guide you through your luxury real estate journey with unparalleled market knowledge.
            </p>
        </div>
    </header>

    <!-- Search Bar -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-20">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 sm:p-8">
            @if(!empty($isSearching))
                <div class="mb-5 flex flex-wrap items-center justify-between gap-3 rounded-xl bg-indigo-50 border border-indigo-100 px-4 py-3 text-sm text-indigo-800">
                    <span>
                        Showing <strong>{{ $agents->count() }}</strong> {{ Str::plural('agent', $agents->count()) }} matching your search.
                    </span>
                    <a href="{{ route('agent.finder') }}" class="font-semibold text-indigo-600 hover:text-indigo-800">Clear search</a>
                </div>
            @endif

            <form action="{{ route('agent.finder') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="lg:col-span-2">
                    <label for="q" class="block text-sm font-semibold text-slate-700 mb-1.5">Search Agents</label>
                    <div class="relative">
                        <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        <input type="text" name="q" id="q" value="{{ request('q') }}" placeholder="Name, email, or specialty..." class="w-full rounded-xl border-slate-200 pl-10 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors shadow-sm">
                    </div>
                </div>
                <div>
                    <label for="experience" class="block text-sm font-semibold text-slate-700 mb-1.5">Min. Experience</label>
                    <select name="experience" id="experience" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors shadow-sm">
                        <option value="">Any</option>
                        <option value="1" @selected(request('experience') == '1')>1+ years</option>
                        <option value="3" @selected(request('experience') == '3')>3+ years</option>
                        <option value="5" @selected(request('experience') == '5')>5+ years</option>
                        <option value="10" @selected(request('experience') == '10')>10+ years</option>
                        <option value="15" @selected(request('experience') == '15')>15+ years</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-4 rounded-xl transition-all shadow-lg shadow-indigo-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 inline-flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Agents Grid Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 border-b border-slate-100 pb-8 mb-12">
            <div>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                    {{ !empty($isSearching) ? 'Search Results' : 'Meet Our Team' }}
                </h2>
                <p class="text-slate-500 mt-2">Experienced professionals ready to help you.</p>
            </div>
            <span class="text-sm font-semibold text-slate-700 bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200">
                {{ $agents->count() }} {{ Str::plural('agent', $agents->count()) }}
            </span>
        </div>

        @if($agents->isEmpty())
            <div class="text-center py-20 bg-white border border-slate-100 rounded-2xl shadow-sm max-w-xl mx-auto px-6">
                <div class="w-16 h-16 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-slate-950">{{ !empty($isSearching) ? 'No agents match your search' : 'No agents found' }}</h3>
                <p class="text-slate-500 mt-2">
                    @if(!empty($isSearching))
                        Try adjusting your filters or <a href="{{ route('agent.finder') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">view all agents</a>.
                    @else
                        Our agent directory is currently being updated. Please check back soon.
                    @endif
                </p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($agents as $agent)
                    <div class="group bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">
                        <div class="relative h-72 w-full overflow-hidden bg-slate-100">
                            @if($agent->photo)
                                <img src="{{ $agent->resolved_photo_url }}" alt="{{ $agent->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="absolute inset-0 flex items-center justify-center text-slate-300">
                                    <svg class="w-24 h-24" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        <div class="p-6 flex-1 flex flex-col">
                            <div class="mb-4">
                                <h3 class="text-xl font-bold text-slate-900">{{ $agent->name }}</h3>
                                <p class="text-sm font-semibold text-indigo-600 mt-1">{{ $agent->experience_years }} Years Experience</p>
                            </div>
                            
                            <p class="text-sm text-slate-500 mb-6 line-clamp-3 leading-relaxed flex-1">
                                {{ $agent->bio }}
                            </p>

                            <div class="space-y-3 pt-4 border-t border-slate-100">
                                <a href="mailto:{{ $agent->email }}" class="flex items-center gap-3 text-sm text-slate-600 hover:text-indigo-600 transition-colors">
                                    <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 shrink-0">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                        </svg>
                                    </div>
                                    <span class="font-medium truncate">{{ $agent->email }}</span>
                                </a>
                                <a href="tel:{{ $agent->phone }}" class="flex items-center gap-3 text-sm text-slate-600 hover:text-indigo-600 transition-colors">
                                    <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-slate-400 shrink-0">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.48-3.909-7.075-6.805l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                        </svg>
                                    </div>
                                    <span class="font-medium">{{ $agent->phone }}</span>
                                </a>
                            </div>
                            
                            <a href="mailto:{{ $agent->email }}?subject={{ rawurlencode('Real Estate Inquiry') }}&body={{ rawurlencode('Hi ' . $agent->name . ', I would like to discuss a property with you.') }}" class="mt-6 w-full py-2.5 px-4 bg-slate-900 hover:bg-indigo-600 text-white text-sm font-bold rounded-xl transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 inline-flex items-center justify-center">
                                Contact Agent
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
