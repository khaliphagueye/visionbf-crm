<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-amber-400">Créer un compte</h2>
        <p class="text-xs text-slate-400 mt-1">Rejoindre la plateforme VISIONBF</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-slate-300">Nom complet</label>
            <input id="name" class="block mt-1 w-full rounded-md bg-slate-950 border-amber-500/30 text-slate-100 focus:border-amber-500 focus:ring-amber-500 text-sm shadow-sm" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-400" />
        </div>

        <div class="mt-4">
            <label for="email" class="block text-sm font-medium text-slate-300">Adresse Email</label>
            <input id="email" class="block mt-1 w-full rounded-md bg-slate-950 border-amber-500/30 text-slate-100 focus:border-amber-500 focus:ring-amber-500 text-sm shadow-sm" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <div class="mt-4">
            <label for="password" class="block text-sm font-medium text-slate-300">Mot de passe</label>
            <input id="password" class="block mt-1 w-full rounded-md bg-slate-950 border-amber-500/30 text-slate-100 focus:border-amber-500 focus:ring-amber-500 text-sm shadow-sm" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <div class="mt-4">
            <label for="password_confirmation" class="block text-sm font-medium text-slate-300">Confirmer le mot de passe</label>
            <input id="password_confirmation" class="block mt-1 w-full rounded-md bg-slate-950 border-amber-500/30 text-slate-100 focus:border-amber-500 focus:ring-amber-500 text-sm shadow-sm" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-slate-400 hover:text-amber-400 transition" href="{{ route('login') }}">
                Déjà inscrit ?
            </a>

            <button type="submit" class="inline-flex items-center px-4 py-2.5 bg-amber-500 border border-transparent rounded-md font-semibold text-xs text-slate-950 uppercase tracking-widest hover:bg-amber-400 focus:bg-amber-400 active:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:ring-offset-slate-900 transition ease-in-out duration-150 shadow-lg shadow-amber-500/20">
                S'inscrire
            </button>
        </div>
    </form>
</x-guest-layout>