<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-amber-400 leading-tight">
                {{ __('Modifier l\'Équipe') }}
            </h2>
            <a href="{{ route('teams.index') }}" class="text-xs text-slate-400 hover:text-amber-400 transition">
                &larr; Retour à la liste
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-900 border border-amber-500/20 p-6 rounded-xl shadow-2xl">
                <form method="POST" action="{{ route('teams.update', $team) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-slate-300">Nom de l'Équipe *</label>
                        <input id="name" type="text" name="name" value="{{ old('name', $team->name) }}" required
                            class="mt-1 block w-full rounded-lg bg-slate-950 border-amber-500/30 text-slate-100 focus:border-amber-500 focus:ring-amber-500 text-sm">
                        <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-400 text-xs" />
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-slate-300">Description</label>
                        <textarea id="description" name="description" rows="3"
                            class="mt-1 block w-full rounded-lg bg-slate-950 border-amber-500/30 text-slate-100 focus:border-amber-500 focus:ring-amber-500 text-sm">{{ old('description', $team->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-1 text-red-400 text-xs" />
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-800">
                        <a href="{{ route('teams.index') }}" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs font-semibold uppercase rounded-lg transition">
                            Annuler
                        </a>
                        <button type="submit" class="px-5 py-2 bg-amber-500 hover:bg-amber-400 text-slate-950 text-xs font-semibold uppercase rounded-lg transition shadow-lg shadow-amber-500/10">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>