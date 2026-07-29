<x-guest-layout>
    <div class="mb-4 text-sm text-slate-400">
        Vous avez oublié votre mot de passe ? Saisissez votre adresse email et nous vous enverrons un lien de réinitialisation.
    </div>

    <x-auth-session-status class="mb-4 text-amber-400" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-slate-300">Adresse Email</label>
            <input id="email" class="block mt-1 w-full rounded-md bg-slate-950 border-amber-500/30 text-slate-100 focus:border-amber-500 focus:ring-amber-500 text-sm shadow-sm" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <button type="submit" class="w-full justify-center inline-flex items-center px-4 py-2.5 bg-amber-500 border border-transparent rounded-md font-semibold text-xs text-slate-950 uppercase tracking-widest hover:bg-amber-400 focus:bg-amber-400 active:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:ring-offset-slate-900 transition ease-in-out duration-150 shadow-lg shadow-amber-500/20">
                Envoyer le lien de réinitialisation
            </button>
        </div>
    </form>
</x-guest-layout>