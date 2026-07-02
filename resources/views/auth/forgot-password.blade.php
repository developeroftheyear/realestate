@extends('frontend.layouts.app')

@section('title', 'Forgot Password - RealEstate')

@section('content')
<div class="min-h-[calc(100vh-5rem)] flex items-center justify-center bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-6 bg-white p-8 rounded-2xl shadow-lg border border-slate-100">
        <div>
            <h2 class="text-center text-2xl font-extrabold text-slate-900">Forgot Password</h2>
            <p class="mt-2 text-center text-sm text-slate-600">
                Enter your email and we'll send you a reset link.
            </p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-full text-white bg-indigo-600 hover:bg-indigo-700 transition-colors">
                {{ __('Email Password Reset Link') }}
            </button>

            <p class="text-center text-sm text-slate-600">
                <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">Back to sign in</a>
            </p>
        </form>
    </div>
</div>
@endsection
