<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('Gestion des Fiches - VISIONBF') }}
            </h2>
            <div class="flex gap-2">

                @if(in_array(strtolower(auth()->user()->role ?? ''), ['admin', 'secretaire']))
                    <a href="{{ route('leads.export', request()->query()) }}"
                        class="px-4 py-2 bg-green-600 text-white font-semibold rounded-md hover:bg-green-500 text-sm shadow flex items-center gap-1">
                        📊 Exporter Excel
                    </a>

                    <form action="{{ route('leads.import') }}" method="POST" enctype="multipart/form-data"
                        class="inline-flex items-center">
                        @csrf
                        <label
                            class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-500 text-sm shadow cursor-pointer flex items-center gap-1">
                            📥 Importer Excel
                            <input type="file" name="file" onchange="this.form.submit()" class="hidden"
                                accept=".xlsx, .xls, .csv">
                        </label>
                    </form>
                @endif

                @can('create', App\Models\Lead::class)
                    <a href="{{ route('leads.create') }}"
                        class="px-4 py-2 bg-yellow-500 text-gray-900 font-semibold rounded-md hover:bg-yellow-400 text-sm shadow">
                        + Nouvelle Fiche Lanterneau
                    </a>
                @endcan

            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
                    {{ session('error') }}
                </div>
            @endif

            @if(in_array(Auth::user()->role, ['admin', 'secretary', 'supervisor']))
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 mb-6 border-l-4 border-yellow-500">
                    <form action="{{ route('leads.import') }}" method="POST" enctype="multipart/form-data"
                        class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        @csrf
                        <div>
                            <h4 class="font-semibold text-gray-800 text-sm">Importer des fiches depuis un fichier Excel /
                                CSV</h4>
                            <p class="text-xs text-gray-500">
                                Colonnes obligatoires : <code class="bg-gray-100 px-1 rounded">raison_sociale</code>, <code
                                    class="bg-gray-100 px-1 rounded">telephone</code> |
                                Optionnelles : <code class="bg-gray-100 px-1 rounded">siret</code>, <code
                                    class="bg-gray-100 px-1 rounded">gerant</code>, <code
                                    class="bg-gray-100 px-1 rounded">email</code>, <code
                                    class="bg-gray-100 px-1 rounded">adresse</code>, <code
                                    class="bg-gray-100 px-1 rounded">code_postal</code>, <code
                                    class="bg-gray-100 px-1 rounded">ville</code>, <code
                                    class="bg-gray-100 px-1 rounded">superficie_lanterneau</code>, <code
                                    class="bg-gray-100 px-1 rounded">statut</code>, <code
                                    class="bg-gray-100 px-1 rounded">commentaire_agent</code>
                            </p>
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="file" name="file" required
                                class="text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-yellow-50 file:text-yellow-700 hover:file:bg-yellow-100">
                            <button type="submit"
                                class="px-4 py-2 bg-gray-900 text-white rounded-md hover:bg-gray-800 text-sm font-semibold whitespace-nowrap">
                                Importer
                            </button>
                        </div>
                    </form>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <form method="GET" action="{{ route('leads.index') }}"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">

                    <div>
                        <label class="block text-xs font-medium text-gray-700 uppercase mb-1">Recherche</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Raison sociale, tél..."
                            class="w-full text-sm rounded-md border-gray-300 focus:border-yellow-500 focus:ring-yellow-500">
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-700 uppercase mb-1">Statut</label>
                        <select name="statut"
                            class="w-full text-sm rounded-md border-gray-300 focus:border-yellow-500 focus:ring-yellow-500">
                            <option value="">Tous les statuts</option>
                            @foreach(config('crm.statuts') as $st)
                                <option value="{{ $st }}" {{ request('statut') === $st ? 'selected' : '' }}>
                                    {{ $st }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    @if(Auth::user()->role !== 'agent')
                        <div>
                            <label class="block text-xs font-medium text-gray-700 uppercase mb-1">Agent</label>
                            <select name="user_id"
                                class="w-full text-sm rounded-md border-gray-300 focus:border-yellow-500 focus:ring-yellow-500">
                                <option value="">Tous les agents</option>
                                @foreach($agents as $agent)
                                    <option value="{{ $agent->id }}" {{ request('user_id') == $agent->id ? 'selected' : '' }}>
                                        {{ $agent->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div>
                        <label class="block text-xs font-medium text-gray-700 uppercase mb-1">Du</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}"
                            class="w-full text-sm rounded-md border-gray-300 focus:border-yellow-500 focus:ring-yellow-500">
                    </div>

                    <div class="flex items-end gap-2">
                        <button type="submit"
                            class="w-full py-2 px-3 bg-gray-900 text-yellow-400 font-semibold rounded-md hover:bg-gray-800 text-sm">
                            Filtrer
                        </button>
                        <a href="{{ route('leads.index') }}"
                            class="py-2 px-3 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 text-sm">
                            RAZ
                        </a>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Raison
                                    Sociale</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Téléphone
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Superficie
                                </th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Agent</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Équipe</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-sm">
                            @forelse($leads as $lead)
                                <tr>
                                    <td class="px-4 py-3 whitespace-nowrap">{{ $lead->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-4 py-3 font-semibold text-gray-900">{{ $lead->raison_sociale }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap">{{ $lead->telephone }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        {{ $lead->lanterneau->superficie_lanterneau ?? 'N/A' }} m²
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">{{ $lead->user->name ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap">{{ $lead->team->name ?? 'Sans Équipe' }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span class="px-2 py-1 text-xs rounded-full font-semibold
                                                    @if($lead->statut === 'RDV Pris' || $lead->statut === 'Interessé') bg-green-100 text-green-800
                                                    @elseif($lead->statut === 'A rappeler') bg-yellow-100 text-yellow-800
                                                    @elseif($lead->statut === 'Refus') bg-red-100 text-red-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                            {{ $lead->statut }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-2">
                                            @can('view', $lead)
                                                <a href="{{ route('leads.show', $lead) }}"
                                                    class="p-2 text-blue-600 hover:text-blue-900 hover:bg-blue-50 rounded-lg transition-colors"
                                                    title="Voir les détails">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            @endcan

                                            @can('update', $lead)
                                                <a href="{{ route('leads.edit', $lead) }}"
                                                    class="p-2 text-amber-600 hover:text-amber-900 hover:bg-amber-50 rounded-lg transition-colors"
                                                    title="Modifier la fiche">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            @endcan

                                            @can('delete', $lead)
                                                <form action="{{ route('leads.destroy', $lead) }}" method="POST" class="inline"
                                                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette fiche ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="p-2 text-red-600 hover:text-red-900 hover:bg-red-50 rounded-lg transition-colors"
                                                        title="Supprimer la fiche">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-6 text-center text-gray-500">
                                        Aucune fiche ne correspond à vos critères de recherche.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $leads->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>