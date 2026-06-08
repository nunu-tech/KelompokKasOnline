<x-guest-layout>
    <h2 class="text-2xl font-semibold text-slate-800 mb-1">
        Masuk
    </h2>
    <p class="text-sm text-slate-500 mb-6">
        Silakan login untuk melanjutkan.
    </p>

    <x-auth-session-status class="mb-4" :status="session('status')" />
    <x-input-error :messages="$errors->all()" class="mt-2" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        {{-- Email --}}
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1" for="email">
                Email
            </label>
            <input id="email" type="email" name="email"
                class="input-soft block w-full rounded-lg px-3 py-2 text-sm text-slate-800" value="{{ old('email') }}"
                required autofocus>
        </div>

        {{-- Password --}}
        <div>
            <label class="block text-sm font-medium text-slate-600 mb-1" for="password">
                Password
            </label>
            <input id="password" type="password" name="password"
                class="input-soft block w-full rounded-lg px-3 py-2 text-sm text-slate-800" required
                autocomplete="current-password">
        </div>

        {{-- Remember me + lupa password --}}
        <div class="flex items-center justify-between text-xs text-slate-500">
            <label class="inline-flex items-center gap-1">
                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded border-slate-300 text-indigo-500 shadow-sm focus:ring-indigo-300">
                <span>Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-indigo-500 hover:text-indigo-600 underline" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <div class="flex items-center justify-between pt-2">
            <a class="text-xs text-indigo-500 hover:text-indigo-600 underline" href="{{ route('register') }}">
                Belum punya akun? Daftar
            </a>

            <button type="submit" class="btn-primary-soft px-4 py-2 rounded-lg text-sm font-medium shadow-sm">
                Masuk
            </button>
        </div>
    </form>
</x-guest-layout>
