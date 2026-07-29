<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center gap-2">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                Fiche Lead #{{ $lead->id }} - {{ $lead->raison_sociale }}
            </h2>

            <div class="flex items-center space-x-2">
                <a href="{{ route('leads.index') }}"
                    class="inline-flex items-center px-3 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors"
                    title="Retour à la liste">
                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Retour
                </a>

                @can('update', $lead)
                    <a href="{{ route('leads.edit', $lead) }}"
                        class="inline-flex items-center p-2 bg-amber-500 hover:bg-amber-600 text-white rounded-lg transition-colors"
                        title="Modifier la fiche">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            class="inline-flex items-center p-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors"
                            title="Supprimer la fiche">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                        </button>
                    </form>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <div
            class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Produit</span>
                <p class="text-lg font-bold text-indigo-600 uppercase">{{ $lead->product_type ?? 'Lanterneau' }}</p>
            </div>

            <div>
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-1">Statut
                    actuel</span>
                @php
                    $statutColors = [
                        'nouveau' => 'bg-blue-100 text-blue-800 border-blue-200',
                        'argumente' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                        'valide' => 'bg-green-100 text-green-800 border-green-200',
                        'hors_cible' => 'bg-gray-100 text-gray-800 border-gray-200',
                        'refus' => 'bg-red-100 text-red-800 border-red-200',
                        'rappel' => 'bg-purple-100 text-purple-800 border-purple-200',
                    ];
                    $colorClass = $statutColors[$lead->statut] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                @endphp
                <span class="px-3 py-1.5 inline-flex text-sm font-semibold rounded-full border {{ $colorClass }}">
                    {{ ucfirst(str_replace('_', ' ', $lead->statut)) }}
                </span>
            </div>

            <div>
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Date de création</span>
                <p class="text-sm font-medium text-gray-700">{{ $lead->created_at->format('d/m/Y à H:i') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <h3 class="text-base font-bold text-gray-900 border-b pb-3 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m3 0h1m-4-8l2-2m0 0l2 2m-2-2v6">
                        </path>
                    </svg>
                    Informations Entreprise
                </h3>

                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-3 text-sm">
                    <div>
                        <dt class="text-xs text-gray-500 font-medium">Raison Sociale</dt>
                        <dd class="font-semibold text-gray-800">{{ $lead->raison_sociale ?? 'N/A' }}</dd>
                    </div>

                    <div>
                        <dt class="text-xs text-gray-500 font-medium">SIRET</dt>
                        <dd class="font-medium text-gray-800">{{ $lead->siret ?? 'N/A' }}</dd>
                    </div>

                    <div>
                        <dt class="text-xs text-gray-500 font-medium">Gérant / Contact</dt>
                        <dd class="font-medium text-gray-800">{{ $lead->gerant ?? 'N/A' }}</dd>
                    </div>

                    <div>
                        <dt class="text-xs text-gray-500 font-medium">Téléphone</dt>
                        <dd class="font-medium text-gray-800">
                            @if($lead->telephone)
                                <a href="tel:{{ $lead->telephone }}"
                                    class="text-indigo-600 hover:underline flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                    {{ $lead->telephone }}
                                </a>
                            @else
                                N/A
                            @endif
                        </dd>
                    </div>

                    <div class="sm:col-span-2">
                        <dt class="text-xs text-gray-500 font-medium">Email</dt>
                        <dd class="font-medium text-gray-800">
                            @if($lead->email)
                                <a href="mailto:{{ $lead->email }}" class="text-indigo-600 hover:underline">
                                    {{ $lead->email }}
                                </a>
                            @else
                                N/A
                            @endif
                        </dd>
                    </div>

                    <div class="sm:col-span-2">
                        <dt class="text-xs text-gray-500 font-medium">Adresse complète</dt>
                        <dd class="font-medium text-gray-800">
                            {{ $lead->adresse ?? '' }}
                            @if($lead->code_postal || $lead->ville)
                                <br>{{ $lead->code_postal }} {{ $lead->ville }}
                            @endif
                            @if(!$lead->adresse && !$lead->code_postal && !$lead->ville)
                                N/A
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="space-y-6">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="text-base font-bold text-gray-900 border-b pb-3 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Caractéristiques du Produit
                    </h3>

                    @if($lead->lanterneau)
                        <dl class="grid grid-cols-1 gap-3 text-sm">
                            <div>
                                <dt class="text-xs text-gray-500 font-medium">Superficie Lanterneau</dt>
                                <dd class="font-semibold text-gray-800">
                                    {{ $lead->lanterneau->superficie_lanterneau ?? 'N/A' }} m²</dd>
                            </div>
                        </dl>
                    @else
                        <p class="text-sm text-gray-500 italic">Aucune donnée spécifique au produit enregistrée.</p>
                    @endif
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
    <h3 class="text-base font-bold text-gray-900 border-b pb-3 mb-4 flex items-center gap-2">
        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
        </svg>
        Attribution & Suivi
    </h3>

    <dl class="grid grid-cols-2 gap-4 text-sm">
        <div>
            <dt class="text-xs text-gray-500 font-medium">Agent créateur</dt>
            <dd class="font-semibold text-gray-800">{{ $lead->user->name ?? 'Non assigné' }}</dd>
        </div>

        <div>
            <dt class="text-xs text-gray-500 font-medium">Équipe</dt>
            <dd class="font-semibold text-gray-800">
                {{ $lead->team->nom ?? $lead->team->name ?? $lead->user->team->nom ?? $lead->user->team->name ?? 'Aucune' }}
            </dd>
        </div>
    </dl>
</div>
            </div>

        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 space-y-6">
            <h3 class="text-base font-bold text-gray-900 border-b pb-3 flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                    </path>
                </svg>
                Commentaires & Remarques
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Commentaire Agent</h4>
                    <p class="text-sm text-gray-700 whitespace-pre-line">
                        {{ $lead->agent_comment ?: 'Aucun commentaire agent enregistré.' }}</p>
                </div>

                <div class="bg-indigo-50/50 p-4 rounded-lg border border-indigo-100">
                    <h4 class="text-xs font-bold text-indigo-500 uppercase tracking-wider mb-2">Commentaire Confirmation
                        / Superviseur</h4>
                    <p class="text-sm text-gray-700 whitespace-pre-line">
                        {{ $lead->confirmation_comment ?: 'Aucun commentaire de confirmation enregistré.' }}</p>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>