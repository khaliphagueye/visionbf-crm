<section class="space-y-6">
    
    

    {{-- Modale de confirmation --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-neutral-900 border border-amber-500/30 text-neutral-200 rounded-lg shadow-2xl">
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

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-amber-400" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                {{-- Bouton Annuler (Noir à bordure Dorée) --}}
                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="inline-flex items-center px-4 py-2 bg-neutral-800 border border-amber-500/50 rounded-md font-semibold text-xs text-amber-400 uppercase tracking-widest hover:bg-neutral-700 hover:text-amber-300 active:bg-neutral-900 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:ring-offset-neutral-900 transition ease-in-out duration-150"
                >
                    {{ __('Annuler') }}
                </button>

                {{-- Bouton Confirmer la suppression (Doré / Texte Noir) --}}
                <button
                    type="submit"
                    class="inline-flex items-center px-4 py-2 bg-amber-500 border border-amber-400 rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-amber-400 active:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:ring-offset-neutral-900 transition ease-in-out duration-150"
                >
                    {{ __('Supprimer le compte') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>