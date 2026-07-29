<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-amber-400 leading-tight flex items-center gap-2">
            <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            {{ __('Mon Profil & Affectations') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-neutral-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- BLOC CRM : Informations sur le rôle, l'équipe et les produits --}}
            <div class="p-4 sm:p-8 bg-neutral-900 border border-amber-500/30 shadow-2xl sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header class="border-b border-amber-500/20 pb-4">
                            <h2 class="text-lg font-medium text-amber-400 flex items-center gap-2">
                                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h5m0 0v-5a2 2 0 012-2h2a2 2 0 012 2v5" />
                                </svg>
                                {{ __('Informations CRM & Équipe') }}
                            </h2>
                            <p class="mt-1 text-sm text-neutral-400">
                                {{ __('Vos droits d\'accès, votre équipe ainsi que les produits/campagnes attribués.') }}
                            </p>
                        </header>

                        <div class="mt-6 space-y-4">
                            {{-- Rôle --}}
                            <div>
                                <label for="role" class="block font-medium text-sm text-amber-200/80">{{ __('Rôle') }}</label>
                                <input id="role" type="text" class="mt-1 block w-full bg-neutral-800 border-neutral-700 text-amber-300 rounded-md shadow-sm cursor-not-allowed font-semibold focus:ring-0 focus:border-neutral-700" value="{{ strtoupper(Auth::user()->role) }}" disabled readonly />
                            </div>

                            {{-- Équipe --}}
                            <div>
                                <label for="team" class="block font-medium text-sm text-amber-200/80">{{ __('Équipe') }}</label>
                                <input id="team" type="text" class="mt-1 block w-full bg-neutral-800 border-neutral-700 text-neutral-300 rounded-md shadow-sm cursor-not-allowed focus:ring-0 focus:border-neutral-700" value="{{ Auth::user()->team->name ?? __('Aucune équipe assignée') }}" disabled readonly />
                            </div>

                            {{-- Produits / Campagnes --}}
                            @if(isset(Auth::user()->products) && Auth::user()->products->count() > 0)
                                <div>
                                    <label class="block font-medium text-sm text-amber-200/80 mb-2">{{ __('Produits / Campagnes attribués') }}</label>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(Auth::user()->products as $product)
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-500/10 text-amber-400 border border-amber-500/40">
                                                ★ {{ $product->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </section>
                </div>
            </div>

            {{-- Modifier les informations personnelles --}}
            <div class="p-4 sm:p-8 bg-neutral-900 border border-neutral-800 shadow-xl sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Modifier le mot de passe --}}
            <div class="p-4 sm:p-8 bg-neutral-900 border border-neutral-800 shadow-xl sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Supprimer le compte --}}
            <div class="p-4 sm:p-8 bg-neutral-900 border border-amber-900/40 shadow-xl sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>