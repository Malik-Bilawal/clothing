@extends('user.layouts.master-layouts.auth')

@section('content')
<style>
    /* Professional Theme Bridge */
    .bg-theme-background { background-color: var(--background-color); }
    .bg-theme-primary { background-color: var(--primary-color); }
    .bg-theme-primary:hover:not(:disabled) { background-color: var(--primary-hover); }
    .bg-theme-primary:disabled { opacity: 0.6; cursor: not-allowed; }
    .text-theme-primary { color: var(--primary-color); }
    .text-theme-accent { color: var(--accent-color); }
    .border-theme { border-color: var(--border-color); }
</style>

<div class="min-h-screen flex items-center justify-center bg-theme-background px-4">
    <div class="w-full max-w-md bg-white p-10 shadow-2xl rounded-2xl border border-theme text-center">
        
        <div class="inline-flex items-center justify-center w-20 h-20 bg-orange-50 rounded-full mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-theme-accent animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>

        <h2 class="text-3xl font-extrabold text-theme-primary tracking-tight mb-4">Verify Your Email</h2>
        
        <p class="text-gray-600 mb-8 leading-relaxed">
            We’ve sent a verification link to your email. Please check your inbox and click the link to verify your account.
        </p>

        @if(session('info') || session('success') || session('error'))
            <div class="mb-6 text-sm text-left">
                @if(session('info'))
                    <div class="p-4 rounded-xl bg-blue-50 text-blue-700 border border-blue-100">
                        {{ session('info') }}
                    </div>
                @endif
                @if(session('success'))
                    <div class="p-4 rounded-xl bg-green-50 text-green-700 border border-green-100">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="p-4 rounded-xl bg-red-50 text-red-700 border border-red-100">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        @endif

        <form method="POST" action="{{ route('verification.resend') }}" id="resendForm" class="space-y-4">
            @csrf
            <button type="submit" id="resendBtn" 
                    class="w-full bg-theme-primary text-white font-bold py-3.5 rounded-xl shadow-lg transform transition-all active:scale-[0.98]">
                Resend Verification Email
            </button>
            
            <div class="h-6"> <p id="timerText" class="text-sm font-medium text-theme-accent"></p>
            </div>
        </form>

        <div class="mt-8 pt-6 border-t border-theme">
            <a href="{{ route('user.login') }}" class="text-sm font-semibold text-gray-500 hover:text-theme-primary transition">
                Wait, I used the wrong email
            </a>
        </div>
    </div>
</div>

<script>
    // Logic remains untouched as requested
    const resendBtn = document.getElementById('resendBtn');
    const timerText = document.getElementById('timerText');
    let cooldown = 60; 
    let canResend = true;

    resendBtn.addEventListener('click', function(e) {
        if (!canResend) {
            e.preventDefault();
        } else {
            startCooldown();
        }
    });

    function startCooldown() {
        canResend = false;
        resendBtn.disabled = true;
        timerText.textContent = `You can resend email in ${cooldown} seconds`;

        const interval = setInterval(() => {
            cooldown--;
            timerText.textContent = `You can resend email in ${cooldown} seconds`;

            if (cooldown <= 0) {
                clearInterval(interval);
                resendBtn.disabled = false;
                timerText.textContent = '';
                cooldown = 60; 
                canResend = true;
            }
        }, 1000);
    }
</script>
@endsection