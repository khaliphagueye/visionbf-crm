<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    {{ __('Tableau de bord') }}
                </h2>
                <p class="text-xs text-gray-500 mt-1">
                    Performance globale & suivi des fiches - <span class="font-semibold text-indigo-600">VISIONBF</span>
                </p>
            </div>
            
            <div class="flex items-center space-x-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-200">
                    <span class="w-2 h-2 mr-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                    {{ ucfirst(auth()->user()->role) }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-6 bg-gray-50/50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 transition-all hover:shadow-md">
                <div class="flex items-center space-x-2 mb-4 pb-2 border-b border-gray-100">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider">Filtres de recherche</h3>
                </div>

                <form method="GET" action="{{ route('dashboard') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4 items-end">
                    
                    @if(in_array(auth()->user()->role, ['admin', 'secretaire']))
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1.5">Équipe</label>
                            <select name="team_id" class="w-full text-sm border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50/50">
                                <option value="">Toutes les équipes</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}" {{ request('team_id') == $team->id ? 'selected' : '' }}>
                                        {{ $team->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @if(in_array(auth()->user()->role, ['admin', 'secretaire', 'superviseur']))
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1.5">Agent</label>
                            <select name="agent_id" class="w-full text-sm border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50/50">
                                <option value="">Tous les agents</option>
                                @foreach($agents as $agent)
                                    <option value="{{ $agent->id }}" {{ request('agent_id') == $agent->id ? 'selected' : '' }}>
                                        {{ $agent->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase mb-1.5">Statut</label>
                        <select name="statut" class="w-full text-sm border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50/50">
                            <option value="">Tous les statuts</option>
                            @foreach($statuts as $statut)
                                <option value="{{ $statut }}" {{ request('statut') == $statut ? 'selected' : '' }}>
                                    {{ $statut }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase mb-1.5">Période</label>
                        <select name="period" id="period-select" onchange="toggleCustomDates(this.value)" class="w-full text-sm border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50/50">
                            <option value="">Toute la période</option>
                            <option value="today" {{ request('period') == 'today' ? 'selected' : '' }}>Aujourd'hui</option>
                            <option value="week" {{ request('period') == 'week' ? 'selected' : '' }}>Cette semaine</option>
                            <option value="month" {{ request('period') == 'month' ? 'selected' : '' }}>Ce mois</option>
                            <option value="custom" {{ request('period') == 'custom' ? 'selected' : '' }}>Personnalisée</option>
                        </select>
                    </div>

                    <div id="custom-dates" class="col-span-1 md:col-span-2 grid grid-cols-2 gap-2 {{ request('period') == 'custom' ? '' : 'hidden' }}">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1.5">Du</label>
                            <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full text-sm border-gray-200 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50/50">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 uppercase mb-1.5">Au</label>
                            <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full text-sm border-gray-200 rounded-xl shadow-sm focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50/50">
                        </div>
                    </div>

                    <div class="flex space-x-2 pt-2 md:pt-0">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-xl text-sm w-full transition shadow-sm hover:shadow">
                            Filtrer
                        </button>
                        <a href="{{ route('dashboard') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 font-semibold py-2 px-3 rounded-xl text-sm flex items-center justify-center transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </a>
                    </div>
                </form>
            </div>

            <div class="space-y-4">
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
                    
                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:border-gray-300 transition">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Fiches</span>
                        <div class="text-2xl font-black text-gray-900 mt-2">{{ $stats['total'] }}</div>
                        <div class="w-full h-1 bg-gray-800 rounded-full mt-3"></div>
                    </div>

                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:border-amber-300 transition">
                        <span class="text-xs font-bold text-amber-600 uppercase tracking-wider">À Rappeler</span>
                        <div class="text-2xl font-black text-amber-600 mt-2">{{ $stats['a_rappeler'] }}</div>
                        <div class="w-full h-1 bg-amber-400 rounded-full mt-3"></div>
                    </div>

                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:border-gray-300 transition">
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">NRP</span>
                        <div class="text-2xl font-black text-gray-600 mt-2">{{ $stats['nrp'] }}</div>
                        <div class="w-full h-1 bg-gray-400 rounded-full mt-3"></div>
                    </div>

                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:border-orange-300 transition">
                        <span class="text-xs font-bold text-orange-600 uppercase tracking-wider">À Retraiter</span>
                        <div class="text-2xl font-black text-orange-600 mt-2">{{ $stats['a_retraiter'] }}</div>
                        <div class="w-full h-1 bg-orange-400 rounded-full mt-3"></div>
                    </div>

                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:border-indigo-300 transition">
                        <span class="text-xs font-bold text-indigo-500 uppercase tracking-wider">Conf. Régie</span>
                        <div class="text-2xl font-black text-indigo-600 mt-2">{{ $stats['confirmer_regie'] }}</div>
                        <div class="w-full h-1 bg-indigo-400 rounded-full mt-3"></div>
                    </div>

                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:border-indigo-500 transition">
                        <span class="text-xs font-bold text-indigo-700 uppercase tracking-wider">Confirmé</span>
                        <div class="text-2xl font-black text-indigo-800 mt-2">{{ $stats['confirmer'] }}</div>
                        <div class="w-full h-1 bg-indigo-600 rounded-full mt-3"></div>
                    </div>

                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:border-blue-300 transition">
                        <span class="text-xs font-bold text-blue-500 uppercase tracking-wider">VT Prog.</span>
                        <div class="text-2xl font-black text-blue-600 mt-2">{{ $stats['vt_progammee'] }}</div>
                        <div class="w-full h-1 bg-blue-400 rounded-full mt-3"></div>
                    </div>

                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:border-blue-500 transition">
                        <span class="text-xs font-bold text-blue-700 uppercase tracking-wider">VT Réalisée</span>
                        <div class="text-2xl font-black text-blue-800 mt-2">{{ $stats['vt_realisee'] }}</div>
                        <div class="w-full h-1 bg-blue-600 rounded-full mt-3"></div>
                    </div>

                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:border-teal-300 transition">
                        <span class="text-xs font-bold text-teal-600 uppercase tracking-wider">Chantier Prog.</span>
                        <div class="text-2xl font-black text-teal-600 mt-2">{{ $stats['chantier_programme'] }}</div>
                        <div class="w-full h-1 bg-teal-400 rounded-full mt-3"></div>
                    </div>

                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:border-emerald-300 transition">
                        <span class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Nettoyage</span>
                        <div class="text-2xl font-black text-emerald-600 mt-2">{{ $stats['chantier_termine_nettoyage'] }}</div>
                        <div class="w-full h-1 bg-emerald-400 rounded-full mt-3"></div>
                    </div>

                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:border-green-400 transition">
                        <span class="text-xs font-bold text-green-600 uppercase tracking-wider">Installer 100%</span>
                        <div class="text-2xl font-black text-green-600 mt-2">{{ $stats['installer_100'] }}</div>
                        <div class="w-full h-1 bg-green-500 rounded-full mt-3"></div>
                    </div>

                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:border-emerald-500 transition">
                        <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider">Remplacement</span>
                        <div class="text-2xl font-black text-emerald-800 mt-2">{{ $stats['chantier_termine_remplacement'] }}</div>
                        <div class="w-full h-1 bg-emerald-600 rounded-full mt-3"></div>
                    </div>

                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:border-rose-300 transition">
                        <span class="text-xs font-bold text-rose-500 uppercase tracking-wider">Chantier Annulé</span>
                        <div class="text-2xl font-black text-rose-600 mt-2">{{ $stats['chantier_annule'] }}</div>
                        <div class="w-full h-1 bg-rose-400 rounded-full mt-3"></div>
                    </div>

                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:border-red-400 transition">
                        <span class="text-xs font-bold text-red-600 uppercase tracking-wider">Annulé Tôle</span>
                        <div class="text-2xl font-black text-red-600 mt-2">{{ $stats['annule_tole'] }}</div>
                        <div class="w-full h-1 bg-red-500 rounded-full mt-3"></div>
                    </div>

                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:border-purple-300 transition">
                        <span class="text-xs font-bold text-purple-600 uppercase tracking-wider">SAV</span>
                        <div class="text-2xl font-black text-purple-600 mt-2">{{ $stats['sav'] }}</div>
                        <div class="w-full h-1 bg-purple-400 rounded-full mt-3"></div>
                    </div>

                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:border-purple-500 transition">
                        <span class="text-xs font-bold text-purple-800 uppercase tracking-wider">SAV Réalisé</span>
                        <div class="text-2xl font-black text-purple-800 mt-2">{{ $stats['sav_realise'] }}</div>
                        <div class="w-full h-1 bg-purple-600 rounded-full mt-3"></div>
                    </div>

                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-5 border-b border-gray-100 flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 class="text-base font-bold text-gray-800">Prochains Rappels</h3>
                    </div>
                    <span class="text-xs font-semibold px-2.5 py-1 bg-amber-50 text-amber-700 rounded-full border border-amber-200">
                        {{ $upcomingRappels->count() }} rappel(s)
                    </span>
                </div>

                @if($upcomingRappels->isEmpty())
                    <div class="p-8 text-center">
                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-gray-500 text-sm font-medium">Aucun rappel planifié pour le moment.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-600">
                            <thead class="bg-gray-50/50 text-xs font-semibold uppercase tracking-wider text-gray-500 border-b border-gray-100">
                                <tr>
                                    <th class="py-3 px-4">Société / Contact</th>
                                    <th class="py-3 px-4">Téléphone</th>
                                    <th class="py-3 px-4">Statut</th>
                                    <th class="py-3 px-4">Date & Heure</th>
                                    <th class="py-3 px-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($upcomingRappels as $rappel)
                                    <tr class="hover:bg-gray-50/80 transition">
                                        <td class="py-3.5 px-4 font-semibold text-gray-900">
                                            {{ $rappel->raison_sociale }}
                                        </td>
                                        <td class="py-3.5 px-4 font-mono text-gray-700">
                                            {{ $rappel->telephone }}
                                        </td>
                                        <td class="py-3.5 px-4">
                                            <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-lg bg-amber-50 text-amber-700 border border-amber-200">
                                                {{ $rappel->statut }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-4">
                                            <span class="inline-flex items-center text-xs font-semibold text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-md border border-indigo-100">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                {{ \Carbon\Carbon::parse($rappel->rappel_at)->format('d/m/Y à H:i') }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-4 text-right space-x-2">
                                            <a href="{{ route('leads.show', $rappel->id) }}" class="inline-flex items-center text-xs font-semibold text-gray-600 hover:text-indigo-600 bg-gray-100 hover:bg-indigo-50 px-2.5 py-1.5 rounded-lg transition">
                                                Voir
                                            </a>

                                            @can('update', $rappel)
                                                <a href="{{ route('leads.edit', $rappel->id) }}" class="inline-flex items-center text-xs font-semibold text-amber-700 hover:text-amber-800 bg-amber-50 hover:bg-amber-100 px-2.5 py-1.5 rounded-lg transition">
                                                    Modifier
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <script>
        function toggleCustomDates(value) {
            const customDatesDiv = document.getElementById('custom-dates');
            if (value === 'custom') {
                customDatesDiv.classList.remove('hidden');
            } else {
                customDatesDiv.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>