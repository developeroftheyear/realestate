@extends('frontend.layouts.app')

@section('title', 'My Profile - TashleyHomes')

@section('content')
    <header class="relative bg-slate-900 py-16 sm:py-20 overflow-hidden">
        <div class="absolute inset-0 z-0 pointer-events-none" aria-hidden="true">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-950 via-slate-900 to-slate-950"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 mb-4 backdrop-blur-md">
                Account Settings
            </span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">Your Profile</h1>
            <p class="mt-3 max-w-xl text-slate-300">Manage your personal information, password, and account preferences.</p>
        </div>
    </header>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12 -mt-8 relative z-20 space-y-6">
        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 sm:p-8">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 sm:p-8">
            @include('profile.partials.update-password-form')
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-6 sm:p-8">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
@endsection
