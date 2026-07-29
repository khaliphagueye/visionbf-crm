<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout><x-guest-layout>
    <div class="mb-4 text-sm text-slate-400">
        Il s'agit d'une zone sécurisée de l'application. Veuillez confirmer votre mot de passe avant de continuer.
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <label for="password" class="block text-sm font-medium text-slate-300">Mot de passe</label>
            <input id="password" class="block mt-1 w-full rounded-md bg-slate-950 border-amber-500/30 text-slate-100 focus:border-amber-500 focus:ring-amber-500 text-sm shadow-sm" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="w-full justify-center inline-flex items-center px-4 py-2.5 bg-amber-500 border border-transparent rounded-md font-semibold text-xs text-slate-950 uppercase tracking-widest hover:bg-amber-400 focus:bg-amber-400 active:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:ring-offset-slate-900 transition ease-in-out duration-150 shadow-lg shadow-amber-500/20">
                Confirmer
            </button>
        </div>
    </form>
</x-guest-layout>
