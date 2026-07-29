<section>
    <header class="border-b border-amber-500/20 pb-4">
        <h2 class="text-lg font-medium text-amber-400 flex items-center gap-2">
            <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            {{ __('Informations du Profil') }}
        </h2>

        <p class="mt-1 text-sm text-neutral-400">
            {{ __("Mettez à jour les informations de votre compte et votre adresse e-mail.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Nom --}}
        <div>
            <label for="name" class="block font-medium text-sm text-amber-200/80">{{ __('Nom') }}</label>
            <input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full bg-neutral-800 border border-neutral-700 text-amber-300 rounded-md shadow-sm focus:border-amber-500 focus:ring-amber-500 text-sm placeholder-neutral-500"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error class="mt-2 text-amber-400" :messages="$errors->get('name')" />
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block font-medium text-sm text-amber-200/80">{{ __('Adresse E-mail') }}</label>
            <input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full bg-neutral-800 border border-neutral-700 text-amber-300 rounded-md shadow-sm focus:border-amber-500 focus:ring-amber-500 text-sm placeholder-neutral-500"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
            />
            <x-input-error class="mt-2 text-amber-400" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-neutral-300">
                        {{ __('Votre adresse e-mail n\'est pas vérifiée.') }}

                        <button form="send-verification" class="underline text-sm text-amber-400 hover:text-amber-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 focus:ring-offset-neutral-900">
                            {{ __('Cliquez ici pour renvoyer l\'e-mail de vérification.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-amber-400">
                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse e-mail.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-4">
            {{-- Bouton Enregistrer (Fond Doré, Texte Noir) --}}
            <button
                type="submit"
                class="inline-flex items-center px-4 py-2 bg-amber-500 border border-amber-400 rounded-md font-semibold text-xs text-black uppercase tracking-widest hover:bg-amber-400 active:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:ring-offset-neutral-900 transition ease-in-out duration-150 shadow-lg shadow-amber-500/10"
            >
                {{ __('Enregistrer') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-amber-400 font-medium"
                >{{ __('Enregistré.') }}</p>
            @endif
        </div>
    </form>
</section>