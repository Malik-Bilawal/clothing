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

<div class="min-h-screen flex items-center justify-center bg-theme-background px-4 py-12">
    <div class="w-full max-w-md bg-white p-10 shadow-2xl rounded-2xl border border-theme">
        <div class="text-center mb-8">
            <h2 class="text-4xl font-extrabold text-theme-primary tracking-tight">Create Account</h2>
            <p class="text-gray-500 mt-2">Join us and start your journey</p>
        </div>

        @if(session('success') || session('info') || $errors->any())
            <div class="mb-6 text-sm">
                @if(session('success'))
                    <div class="p-3 rounded-xl bg-green-50 text-green-700 border border-green-100 italic">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="p-3 rounded-xl bg-red-50 text-red-700 border border-red-100">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endif

        <form method="POST" action="{{ route('user.register') }}" class="space-y-5">
            @csrf
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required 
                       placeholder="John Doe"
                       class="w-full border-theme rounded-xl p-3 outline-none transition-all focus-ring-theme border">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required 
                       placeholder="john@example.com"
                       class="w-full border-theme rounded-xl p-3 outline-none transition-all focus-ring-theme border">
            </div>

            <div class="grid grid-cols-1 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required 
                           placeholder="••••••••"
                           class="w-full border-theme rounded-xl p-3 outline-none transition-all focus-ring-theme border">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" required 
                           placeholder="••••••••"
                           class="w-full border-theme rounded-xl p-3 outline-none transition-all focus-ring-theme border">
                </div>
            </div>

            <div class="flex items-start mt-2">
                <div class="flex items-center h-5">
                    <input id="terms" type="checkbox" required class="h-4 w-4 rounded border-gray-300 text-theme-primary focus:ring-theme-accent">
                </div>
                <label for="terms" class="ml-2 text-xs text-gray-500">
                    By registering, you agree to our <a href="#" class="text-theme-accent font-semibold hover:underline">Terms of Service</a> and <a href="#" class="text-theme-accent font-semibold hover:underline">Privacy Policy</a>.
                </label>
            </div>

            <button type="submit" 
                    class="w-full bg-theme-primary text-white font-bold py-3.5 rounded-xl shadow-lg hover:shadow-xl transform transition-all active:scale-[0.98] mt-2">
                Create Account
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-theme text-center">
            <p class="text-sm text-gray-600">
                Already have an account? 
                <a href="{{ route('user.login') }}" class="text-theme-primary font-bold hover:underline ml-1">Log in here</a>
            </p>
        </div>
    </div>
</div>
@endsection