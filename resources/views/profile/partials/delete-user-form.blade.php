<section class="space-y-6">
    <header class="border-b border-amber-500/20 pb-4">
        <h2 class="text-lg font-medium text-amber-400 flex items-center gap-2">
            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
            {{ __('Supprimer le compte') }}
        </h2>

        <p class="mt-1 text-sm text-neutral-400">
            {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Avant de supprimer votre compte, veuillez télécharger les données ou informations que vous souhaitez conserver.') }}
        </p>
    </header>

    {{-- Bouton principal de suppression --}}
    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        type="button"
        class="inline-flex items-center px-4 py-2 bg-red-950/80 border border-red-500/50 rounded-md font-semibold text-xs text-red-300 uppercase tracking-widest hover:bg-red-900 hover:text-red-100 active:bg-red-950 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-neutral-900 transition ease-in-out duration-150"
    >
        {{ __('Supprimer le compte') }}
    </button>

    {{-- Modale de confirmation --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-neutral-900 border border-amber-500/30 text-neutral-200 rounded-lg">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-amber-400">
                {{ __('Êtes-vous sûr de vouloir supprimer votre compte ?') }}
            </h2>

            <p class="mt-1 text-sm text-neutral-400">
                {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Veuillez saisir votre mot de passe pour confirmer la suppression définitive de votre compte.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Mot de passe') }}" class="sr-only" />

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 bg-neutral-800 border border-neutral-700 text-amber-300 rounded-md shadow-sm focus:border-amber-500 focus:ring-amber-500 text-sm placeholder-neutral-500"
                    placeholder="{{ __('Votre mot de passe') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-red-400" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                {{-- Bouton Annuler (Style Doré/Noir) --}}
                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="inline-flex items-center px-4 py-2 bg-neutral-800 border border-amber-500/40 rounded-md font-semibold text-xs text-amber-400 uppercase tracking-widest hover:bg-neutral-700 hover:text-amber-300 active:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:ring-offset-neutral-900 transition ease-in-out duration-150"
                >
                    {{ __('Annuler') }}
                </button>

                {{-- Bouton Confirmer la suppression --}}
                <button
                    type="submit"
                    class="inline-flex items-center px-4 py-2 bg-red-600 border border-red-500 rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-neutral-900 transition ease-in-out duration-150"
                >
                    {{ __('Supprimer le compte') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>