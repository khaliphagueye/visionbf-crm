<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-amber-400 leading-tight">
                {{ __('Modifier l\'Utilisateur : ') }} {{ $user->name }}
            </h2>
            <a href="{{ route('users.index') }}" class="text-xs text-slate-400 hover:text-amber-400 transition">
                &larr; Retour à la liste
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-slate-900 border border-amber-500/20 p-6 rounded-xl shadow-2xl">
                <form method="POST" action="{{ route('users.update', $user) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-slate-300">Nom complet</label>
                        <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required
                            class="mt-1 block w-full rounded-lg bg-slate-950 border-amber-500/30 text-slate-100 focus:border-amber-500 focus:ring-amber-500 text-sm">
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-400 text-xs" />
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-slate-300">Adresse Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required
                            class="mt-1 block w-full rounded-lg bg-slate-950 border-amber-500/30 text-slate-100 focus:border-amber-500 focus:ring-amber-500 text-sm">
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-400 text-xs" />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="role" class="block text-sm font-medium text-slate-300">Rôle</label>
                            
                            <select id="role" name="role" required
                                class="mt-1 block w-full rounded-lg bg-slate-950 border-amber-500/30 text-slate-100 focus:border-amber-500 focus:ring-amber-500 text-sm">

                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                    Administrateur
                                </option>

                                <option value="secretary" {{ old('role', $user->role) == 'secretary' ? 'selected' : '' }}>
                                    Secrétaire
                                </option>

                                <option value="supervisor" {{ old('role', $user->role) == 'supervisor' ? 'selected' : '' }}>
                                    Superviseur
                                </option>

                                <option value="agent" {{ old('role', $user->role) == 'agent' ? 'selected' : '' }}>
                                    Agent
                                </option>

                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-1 text-red-400 text-xs" />
                        </div>

                        <div id="team-container">
            
                            <label for="team_id" class="block text-sm font-medium text-slate-300">
                                Équipe
                            </label>

                            <select id="team_id" name="team_id"
                                class="mt-1 block w-full rounded-lg bg-slate-950 border-amber-500/30 text-slate-100 focus:border-amber-500 focus:ring-amber-500 text-sm">
  
                                <option value="">Aucune équipe</option>
                             
                                @foreach($teams ?? [] as $team)
                                    <option value="{{ $team->id }}" {{ old('team_id', $user->team_id) == $team->id ? 'selected' : '' }}>
                                        {{ $team->name }}
                                    </option>
                                @endforeach

                            </select>

                            <x-input-error :messages="$errors->get('team_id')" class="mt-1 text-red-400 text-xs" />
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }}
                                class="rounded bg-slate-950 border-amber-500/30 text-amber-500 focus:ring-amber-500 focus:ring-offset-slate-900">
                            <span class="ms-2 text-sm text-slate-300">Compte actif</span>
                        </label>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-800">
                        <a href="{{ route('users.index') }}"
                            class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-semibold uppercase tracking-wider rounded-lg transition">
                            Annuler
                        </a>
                        <button type="submit"
                            class="px-5 py-2 bg-amber-500 hover:bg-amber-400 text-slate-950 text-xs font-semibold uppercase tracking-wider rounded-lg transition shadow-lg shadow-amber-500/10">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-slate-900 border border-amber-500/20 p-6 rounded-xl shadow-2xl">
                <h3 class="text-sm font-semibold text-amber-400 uppercase tracking-wider mb-3">Changer le mot de passe
                    de l'utilisateur</h3>
                <form method="POST" action="{{ route('users.update', $user) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="update_password_only" value="1">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-slate-300">Nouveau mot de
                                passe</label>
                            <input id="password" type="password" name="password" required
                                class="mt-1 block w-full rounded-lg bg-slate-950 border-amber-500/30 text-slate-100 text-sm">
                        </div>
                        <div>
                            <label for="password_confirmation"
                                class="block text-sm font-medium text-slate-300">Confirmer mot de passe</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required
                                class="mt-1 block w-full rounded-lg bg-slate-950 border-amber-500/30 text-slate-100 text-sm">
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-amber-400 border border-amber-500/30 text-xs font-semibold uppercase tracking-wider rounded-lg transition">
                            Mettre à jour le mot de passe
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const roleSelect = document.getElementById('role');
            const teamContainer = document.getElementById('team-container');
            const teamSelect = document.getElementById('team_id');
            console.log(roleSelect.value);
            console.log(teamContainer);
            console.log(teamSelect.options.length);
            function toggleTeam() {

                const role = roleSelect.value;

                if (role === 'admin' || role === 'secretary') {

                    teamContainer.style.display = 'none';
                    teamSelect.value = '';

                } else {

                    teamContainer.style.display = 'block';

                }
            }

            toggleTeam();

            roleSelect.addEventListener('change', toggleTeam);

        });
    </script>
</x-app-layout>