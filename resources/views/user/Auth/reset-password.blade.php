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
            <div class="inline-flex items-center justify-center w-16 h-16 bg-theme-background rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-theme-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h2 class="text-3xl font-extrabold text-theme-primary tracking-tight">Reset Password</h2>
            <p class="text-gray-500 mt-2 text-sm">Set your new secure password below</p>
        </div>

        @if(session('status') || session('error') || $errors->any())
            <div class="mb-6 text-sm">
                @if(session('status'))
                    <div class="p-4 rounded-xl bg-green-50 text-green-700 border border-green-100 font-medium">
                        {{ session('status') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="p-4 rounded-xl bg-red-50 text-red-700 border border-red-100">
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="p-4 rounded-xl bg-red-50 text-red-700 border border-red-100">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required 
                       class="w-full border-theme rounded-xl p-3 outline-none transition-all focus-ring-theme border"
                       placeholder="name@company.com">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">New Password</label>
                <input type="password" name="password" required 
                       class="w-full border-theme rounded-xl p-3 outline-none transition-all focus-ring-theme border"
                       placeholder="••••••••">
                <p class="mt-1 text-[11px] text-gray-400">Must be at least 8 characters long.</p>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Confirm New Password</label>
                <input type="password" name="password_confirmation" required 
                       class="w-full border-theme rounded-xl p-3 outline-none transition-all focus-ring-theme border"
                       placeholder="••••••••">
            </div>

            <button type="submit" 
                    class="w-full bg-theme-primary text-white font-bold py-3.5 rounded-xl shadow-lg hover:shadow-xl transform transition-all active:scale-[0.98] mt-2">
                Update Password
            </button>
        </form>

        <div class="mt-8 text-center">
            <a href="{{ route('user.login') }}" class="inline-flex items-center text-sm font-semibold text-theme-accent hover:text-theme-primary transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Login
            </a>
        </div>
    </div>
</div>
@endsection