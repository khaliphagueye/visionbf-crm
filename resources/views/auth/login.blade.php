<x-guest-layout>
    <x-auth-session-status class="mb-4 text-amber-400" :status="session('status')" />

    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-amber-400">Connexion CRM</h2>
        <p class="text-xs text-slate-400 mt-1">Espace réservé aux collaborateurs VISIONBF</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-slate-300">Adresse Email</label>
            <input id="email" class="block mt-1 w-full rounded-md bg-slate-950 border-amber-500/30 text-slate-100 focus:border-amber-500 focus:ring-amber-500 text-sm shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <div class="mt-4">
            <label for="password" class="block text-sm font-medium text-slate-300">Mot de passe</label>
            <input id="password" class="block mt-1 w-full rounded-md bg-slate-950 border-amber-500/30 text-slate-100 focus:border-amber-500 focus:ring-amber-500 text-sm shadow-sm" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded bg-slate-950 border-amber-500/30 text-amber-500 shadow-sm focus:ring-amber-500 focus:ring-offset-slate-900" name="remember">
                <span class="ms-2 text-sm text-slate-400">Se souvenir de moi</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-amber-500/80 hover:text-amber-400 transition" href="{{ route('password.request') }}">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full justify-center inline-flex items-center px-4 py-2.5 bg-amber-500 border border-transparent rounded-md font-semibold text-xs text-slate-950 uppercase tracking-widest hover:bg-amber-400 focus:bg-amber-400 active:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:ring-offset-slate-900 transition ease-in-out duration-150 shadow-lg shadow-amber-500/20">
                Se connecter
            </button>
        </div>
    </form>
</x-guest-layout>