@extends('user.layouts.master-layouts.auth')

@section('content')
<style>
    /* Professional Theme Bridge */
    .bg-theme-background { background-color: var(--background-color); }
    .bg-theme-primary { background-color: var(--primary-color); }
    .bg-theme-primary:hover { background-color: var(--primary-hover); }
    .text-theme-primary { color: var(--primary-color); }
    .text-theme-accent { color: var(--accent-color); }
    .border-theme { border-color: var(--border-color); }
    .focus-ring-theme:focus { 
        border-color: var(--accent-color); 
        box-shadow: 0 0 0 3px rgba(140, 94, 60, 0.15); 
    }
</style>

<div class="min-h-screen flex items-center justify-center bg-theme-background px-4">
    <div class="w-full max-w-md bg-white p-10 shadow-2xl rounded-2xl border border-theme">
        
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-orange-50 rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-theme-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
            </div>
            <h2 class="text-3xl font-extrabold text-theme-primary tracking-tight">Forgot Password?</h2>
            <p class="text-gray-500 mt-2 text-sm leading-relaxed">
                No worries! Enter your email and we'll send you a link to reset your password.
            </p>
        </div>

        @if (session('status'))
            <div class="mb-6 p-4 rounded-xl bg-green-50 text-green-700 border border-green-100 text-sm font-medium">
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 text-red-700 border border-red-100 text-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required 
                       class="w-full border-theme rounded-xl p-3 outline-none transition-all focus-ring-theme border"
                       placeholder="Enter your registered email">
            </div>

            <button type="submit" 
                    class="w-full bg-theme-primary text-white font-bold py-3.5 rounded-xl shadow-lg hover:shadow-xl transform transition-all active:scale-[0.98]">
                Send Reset Link
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-theme text-center">
            <a href="{{ route('user.login') }}" class="inline-flex items-center text-sm font-semibold text-theme-accent hover:text-theme-primary transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Login
            </a>
        </div>
    </div>
</div>
@endsection