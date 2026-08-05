<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-amber-400 leading-tight">
                {{ __('Ajouter un Utilisateur') }}
            </h2>
            <a href="{{ route('users.index') }}" class="text-xs text-slate-400 hover:text-amber-400 transition">
                &larr; Retour à la liste
            </a>
        </div>
    </x-slot>

    <div class="py-6" x-data="{ selectedRole: '{{ old('role', 'agent') }}' }">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 border border-amber-500/20 p-6 rounded-xl shadow-2xl">

                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-slate-300">Nom complet</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="mt-1 block w-full rounded-lg bg-slate-950 border-amber-500/30 text-slate-100 focus:border-amber-500 focus:ring-amber-500 text-sm">
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-400 text-xs" />
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-slate-300">Adresse Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            class="mt-1 block w-full rounded-lg bg-slate-950 border-amber-500/30 text-slate-100 focus:border-amber-500 focus:ring-amber-500 text-sm">
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-400 text-xs" />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="role" class="block text-sm font-medium text-slate-300">Rôle</label>
                            <select id="role" name="role" x-model="selectedRole" required
                                class="mt-1 block w-full rounded-lg bg-slate-950 border-amber-500/30 text-slate-100 focus:border-amber-500 focus:ring-amber-500 text-sm">
                                <option value="agent">Agent</option>
                                <option value="supervisor">Superviseur</option>
                                <option value="secretary">Secrétaire</option>
                                <option value="admin">Administrateur</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-1 text-red-400 text-xs" />
                        </div>

                        <div>
                            <label for="team_id" class="block text-sm font-medium text-slate-300">
                                Équipe
                                <span x-show="selectedRole === 'agent' || selectedRole === 'supervisor'"
                                    class="text-amber-400">*</span>
                                <span x-show="selectedRole !== 'agent' && selectedRole !== 'supervisor'"
                                    class="text-xs text-slate-500">(Optionnel)</span>
                            </label>

                            <select id="team_id" name="team_id"
                                :required="selectedRole === 'agent' || selectedRole === 'supervisor'"
                                class="mt-1 block w-full rounded-lg bg-slate-950 border-amber-500/30 text-slate-100 focus:border-amber-500 focus:ring-amber-500 text-sm">
                                <option value="">Choisir une équipe...</option>
                                @foreach($teams ?? [] as $team)
                                    <option value="{{ $team->id }}" {{ old('team_id') == $team->id ? 'selected' : '' }}>
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('team_id')" class="mt-1 text-red-400 text-xs" />
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                class="rounded bg-slate-950 border-amber-500/30 text-amber-500 focus:ring-amber-500 focus:ring-offset-slate-900">
                            <span class="ms-2 text-sm text-slate-300">Activer le compte immédiatement</span>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-300">Mot de passe</label>
                            <input id="password" type="password" name="password" required
                                class="mt-1 block w-full rounded-lg bg-slate-950 border-amber-500/30 text-slate-100 focus:border-amber-500 focus:ring-amber-500 text-sm">
                            <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-400 text-xs" />
                        </div>

                        <div>
                            <label for="password_confirmation"
                                class="block text-sm font-medium text-slate-300">Confirmer mot de passe</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                class="mt-1 block w-full rounded-lg bg-slate-950 border-amber-500/30 text-slate-100 focus:border-amber-500 focus:ring-amber-500 text-sm">
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-800">
                        <a href="{{ route('users.index') }}"
                            class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-semibold uppercase tracking-wider rounded-lg transition">
                            Annuler
                        </a>
                        <button type="submit"
                            class="px-5 py-2 bg-amber-500 hover:bg-amber-400 text-slate-950 text-xs font-semibold uppercase tracking-wider rounded-lg transition shadow-lg shadow-amber-500/10">
                            Créer l'utilisateur
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>