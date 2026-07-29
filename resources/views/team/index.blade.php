<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-amber-400 leading-tight">
                {{ __('Gestion des Équipes') }}
            </h2>
            <a href="{{ route('teams.create') }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-400 text-slate-950 font-semibold rounded-lg text-xs uppercase transition shadow-lg shadow-amber-500/10">
                + Nouvelle Équipe
            </a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-500/10 border border-red-500/30 text-red-400 text-sm rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-slate-900 border border-amber-500/20 rounded-xl overflow-hidden shadow-2xl">
                <table class="w-full text-left text-slate-300 text-sm">
                    <thead class="bg-slate-950 text-amber-400 text-xs uppercase tracking-wider border-b border-slate-800">
                        <tr>
                            <th class="p-4">Nom de l'Équipe</th>
                            <th class="p-4">Description</th>
                            <th class="p-4 text-center">Membres</th>
                            <th class="p-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800">
                        @forelse($teams as $team)
                            <tr class="hover:bg-slate-800/50 transition">
                                <td class="p-4 font-semibold text-slate-100">{{ $team->name }}</td>
                                <td class="p-4 text-slate-400">{{ $team->description ?? '—' }}</td>
                                <td class="p-4 text-center">
                                    <span class="px-2.5 py-1 bg-slate-800 text-amber-400 text-xs rounded-full border border-amber-500/20 font-bold">
                                        {{ $team->users_count }}
                                    </span>
                                </td>
                                <td class="p-4 text-right flex justify-end gap-2">
                                    <a href="{{ route('teams.edit', $team) }}" class="px-3 py-1 bg-slate-800 hover:bg-slate-700 text-slate-300 rounded text-xs transition">
                                        Éditer
                                    </a>
                                    <form method="POST" action="{{ route('teams.destroy', $team) }}" onsubmit="return confirm('Supprimer cette équipe ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-500/10 border border-red-500/20 hover:bg-red-500/20 text-red-400 rounded text-xs transition">
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-6 text-center text-slate-500">
                                    Aucune équipe enregistrée pour le moment.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $teams->links() }}
            </div>
        </div>
    </div>
</x-app-layout>