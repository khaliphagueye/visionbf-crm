<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email" class="block text-sm font-medium text-slate-300">Adresse Email</label>
            <input id="email" class="block mt-1 w-full rounded-md bg-slate-950 border-amber-500/30 text-slate-100 focus:border-amber-500 focus:ring-amber-500 text-sm shadow-sm" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <div class="mt-4">
            <label for="password" class="block text-sm font-medium text-slate-300">Nouveau mot de passe</label>
            <input id="password" class="block mt-1 w-full rounded-md bg-slate-950 border-amber-500/30 text-slate-100 focus:border-amber-500 focus:ring-amber-500 text-sm shadow-sm" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <div class="mt-4">
            <label for="password_confirmation" class="block text-sm font-medium text-slate-300">Confirmer le nouveau mot de passe</label>
            <input id="password_confirmation" class="block mt-1 w-full rounded-md bg-slate-950 border-amber-500/30 text-slate-100 focus:border-amber-500 focus:ring-amber-500 text-sm shadow-sm" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <button type="submit" class="w-full justify-center inline-flex items-center px-4 py-2.5 bg-amber-500 border border-transparent rounded-md font-semibold text-xs text-slate-950 uppercase tracking-widest hover:bg-amber-400 focus:bg-amber-400 active:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:ring-offset-slate-900 transition ease-in-out duration-150 shadow-lg shadow-amber-500/20">
                Réinitialiser le mot de passe
            </button>
        </div>
    </form>
</x-guest-layout>