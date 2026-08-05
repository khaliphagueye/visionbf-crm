<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-8">

                <div>

                    <h1 class="text-3xl font-bold text-amber-400 flex items-center gap-3">

                        <i class="fa-solid fa-trophy"></i>

                        Tableau des performances

                    </h1>

                    <p class="text-slate-400 mt-2">

                        Analyse en temps réel des performances de vos agents.

                    </p>

                </div>

                <div class="flex items-center gap-3">

                    <div class="px-4 py-2 rounded-xl bg-slate-900 border border-amber-500/20">

                        <div class="text-xs text-slate-400">

                            Dernière mise à jour

                        </div>

                        <div class="text-amber-400 font-semibold">

                            {{ now()->format('d/m/Y H:i') }}

                        </div>

                    </div>

                </div>

            </div>

            <div class="flex items-center space-x-2">
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gold-500/10 text-gold-400 border border-gold-500/30 shadow-[0_0_10px_rgba(251,186,16,0.1)]">
                    <span
                        class="w-2 h-2 mr-1.5 bg-green-500 rounded-full animate-pulse shadow-[0_0_5px_#22c55e]"></span>
                    {{ ucfirst(auth()->user()->role) }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="py-6 bg-nero-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- 🔍 Section Filtres Premium --}}
            <div
                class="bg-nero-900 p-5 rounded-2xl shadow-lg border border-nero-800 transition-all hover:border-gold-500/30">
                <div class="flex items-center space-x-2 mb-4 pb-3 border-b border-nero-800">
                    <svg class="w-5 h-5 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    <h3 class="text-sm font-bold text-nero-200 uppercase tracking-wider">Filtres de recherche</h3>
                </div>

                <form method="GET" action="{{ route('dashboard') }}"
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4 items-end">

                    @if(in_array(auth()->user()->role, ['admin', 'secretaire']))
                        <div>
                            <label class="block text-xs font-semibold text-nero-400 uppercase mb-1.5">Équipe</label>
                            <select name="team_id"
                                class="w-full text-sm border-nero-800 rounded-xl shadow-sm focus:ring-2 focus:ring-gold-500 focus:border-gold-500 bg-nero-950 text-gold-500">
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
                            <label class="block text-xs font-semibold text-nero-400 uppercase mb-1.5">Agent</label>
                            <select name="agent_id"
                                class="w-full text-sm border-nero-800 rounded-xl shadow-sm focus:ring-2 focus:ring-gold-500 focus:border-gold-500 bg-nero-950 text-nero-200">
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
                        <label class="block text-xs font-semibold text-nero-400 uppercase mb-1.5">Statut</label>
                        <select name="statut"
                            class="w-full text-sm border-nero-800 rounded-xl shadow-sm focus:ring-2 focus:ring-gold-500 focus:border-gold-500 bg-nero-950 text-nero-200">
                            <option value="">Tous les statuts</option>
                            @foreach($statuts as $statut)
                                <option value="{{ $statut }}" {{ request('statut') == $statut ? 'selected' : '' }}>
                                    {{ $statut }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-nero-400 uppercase mb-1.5">Période</label>
                        <select name="period" id="period-select" onchange="toggleCustomDates(this.value)"
                            class="w-full text-sm border-nero-800 rounded-xl shadow-sm focus:ring-2 focus:ring-gold-500 focus:border-gold-500 bg-nero-950 text-nero-200">
                            <option value="">Toute la période</option>
                            <option value="today" {{ request('period') == 'today' ? 'selected' : '' }}>Aujourd'hui
                            </option>
                            <option value="week" {{ request('period') == 'week' ? 'selected' : '' }}>Cette semaine
                            </option>
                            <option value="month" {{ request('period') == 'month' ? 'selected' : '' }}>Ce mois</option>
                            <option value="custom" {{ request('period') == 'custom' ? 'selected' : '' }}>Personnalisée
                            </option>
                        </select>
                    </div>

                    <div id="custom-dates"
                        class="col-span-1 md:col-span-2 grid grid-cols-2 gap-2 {{ request('period') == 'custom' ? '' : 'hidden' }}">
                        <div>
                            <label class="block text-xs font-semibold text-nero-400 uppercase mb-1.5">Du</label>
                            <input type="date" name="date_from" value="{{ request('date_from') }}"
                                class="w-full text-sm border-nero-800 rounded-xl shadow-sm focus:ring-gold-500 focus:border-gold-500 bg-nero-950 text-nero-200 color-scheme-dark">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-nero-400 uppercase mb-1.5">Au</label>
                            <input type="date" name="date_to" value="{{ request('date_to') }}"
                                class="w-full text-sm border-nero-800 rounded-xl shadow-sm focus:ring-gold-500 focus:border-gold-500 bg-nero-950 text-nero-200 color-scheme-dark">
                        </div>
                    </div>

                    <div class="flex space-x-2 pt-2 md:pt-0">
                        <button type="submit"
                            class="bg-gold-gradient text-nero-950 font-bold py-2 px-4 rounded-xl text-sm w-full transition shadow-[0_0_15px_rgba(251,186,16,0.3)] hover:shadow-[0_0_20px_rgba(251,186,16,0.5)]">
                            Filtrer
                        </button>
                        <a href="{{ route('dashboard') }}"
                            class="bg-nero-800 hover:bg-nero-700 text-nero-300 font-semibold py-2 px-3 rounded-xl text-sm flex items-center justify-center transition border border-nero-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </a>
                    </div>
                </form>
            </div>
{{-- ===================== --}}
{{-- PODIUM DES AGENTS --}}
{{-- ===================== --}}

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">

    {{-- 2ème --}}
{{-- 2ème --}}
<div
    class="bg-slate-900 rounded-2xl border border-slate-700 p-6 text-center hover:border-slate-500 transition">

    <div
        class="w-16 h-16 mx-auto rounded-full bg-slate-700 flex items-center justify-center text-3xl mb-4">

        🥈

    </div>

    <h3 class="text-xl font-bold text-white">

        {{ $podium->get(1)?->name ?? 'Aucun agent' }}

    </h3>

    <p class="text-slate-400">

        {{ $podium->get(1)?->team?->name ?? 'Aucune équipe' }}

    </p>

    <div class="mt-6">

        <div class="text-4xl font-bold text-slate-200">

            {{ $podium->get(1)?->confirmed_leads ?? 0 }}

        </div>

        <div class="text-sm text-slate-500">

            Leads confirmés

        </div>

    </div>

    <div class="mt-4">

        <span class="text-amber-400 font-bold">

            {{ $podium->get(1)?->conversion ?? 0 }} %

        </span>

    </div>

</div>
    {{-- 1er --}}
{{-- 1er --}}
<div
    class="bg-gradient-to-b from-amber-500 to-yellow-300 rounded-2xl shadow-2xl p-8 text-center scale-105">

    <div class="text-6xl mb-3">
        👑
    </div>

    <div
        class="w-20 h-20 mx-auto rounded-full bg-black/20 flex items-center justify-center text-4xl mb-4">

        🥇

    </div>

    <h2 class="text-2xl font-bold text-slate-950">

        {{ $podium->get(0)?->name ?? 'Aucun agent' }}

    </h2>

    <p class="text-slate-900">

        {{ $podium->get(0)?->team?->name ?? 'Aucune équipe' }}

    </p>

    <div class="mt-6">

        <div class="text-5xl font-extrabold text-slate-950">

            {{ $podium->get(0)?->confirmed_leads ?? 0 }}

        </div>

        <div class="font-semibold text-slate-800">

            Leads confirmés

        </div>

    </div>

    <div class="mt-4">

        <span class="px-4 py-2 rounded-full bg-black/20 text-slate-900 font-bold">

            {{ $podium->get(0)?->conversion ?? 0 }} %

        </span>

    </div>

</div>

    {{-- 3ème --}}
{{-- 3ème --}}
<div
    class="bg-slate-900 rounded-2xl border border-amber-500/20 p-6 text-center hover:border-amber-500 transition">

    <div
        class="w-16 h-16 mx-auto rounded-full bg-amber-900/30 flex items-center justify-center text-3xl mb-4">

        🥉

    </div>

    <h3 class="text-xl font-bold text-white">

        {{ $podium->get(2)?->name ?? 'Aucun agent' }}

    </h3>

    <p class="text-slate-400">

        {{ $podium->get(2)?->team?->name ?? 'Aucune équipe' }}

    </p>

    <div class="mt-6">

        <div class="text-4xl font-bold text-amber-400">

            {{ $podium->get(2)?->confirmed_leads ?? 0 }}

        </div>

        <div class="text-sm text-slate-500">

            Leads confirmés

        </div>

    </div>

    <div class="mt-4">

        <span class="text-amber-400 font-bold">

            {{ $podium->get(2)?->conversion ?? 0 }} %

        </span>

    </div>

</div>

</div>
            {{-- 📊 Section Statistiques Premium --}}
            <div class="space-y-4">
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">

                    {{-- Cartes optimisées pour Dark Mode --}}
                    <div
                        class="bg-nero-900 p-4 rounded-2xl shadow-lg border border-nero-800 flex flex-col justify-between hover:border-gold-500/50 transition group">
                        <span class="text-xs font-bold text-gold-400 uppercase tracking-wider">Total Fiches</span>
                        <div class="text-3xl font-black text-gold-400 mt-2 group-hover:text-gold-300 transition">
                            {{ $stats['total'] }}
                        </div>
                        <div class="w-full h-1.5 bg-nero-950 rounded-full mt-3 overflow-hidden">
                            <div class="h-full bg-gold-500 w-full shadow-[0_0_5px_#fbba10]"></div>
                        </div>
                    </div>

                    <div
                        class="bg-nero-900 p-4 rounded-2xl shadow-lg border border-nero-800 flex flex-col justify-between hover:border-amber-400/50 transition group">
                        <span class="text-xs font-bold text-amber-500 uppercase tracking-wider">À Rappeler</span>
                        <div class="text-2xl font-black text-amber-400 mt-2">{{ $stats['a_rappeler'] }}</div>
                        <div class="w-full h-1.5 bg-nero-950 rounded-full mt-3 overflow-hidden">
                            <div class="h-full bg-amber-500 w-full shadow-[0_0_5px_#f59e0b]"></div>
                        </div>
                    </div>

                    <div
                        class="bg-nero-900 p-4 rounded-2xl shadow-lg border border-nero-800 flex flex-col justify-between hover:border-gray-500/50 transition group">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">NRP</span>
                        <div class="text-2xl font-black text-gray-300 mt-2">{{ $stats['nrp'] }}</div>
                        <div class="w-full h-1.5 bg-nero-950 rounded-full mt-3 overflow-hidden">
                            <div class="h-full bg-gray-500 w-full"></div>
                        </div>
                    </div>

                    <div
                        class="bg-nero-900 p-4 rounded-2xl shadow-lg border border-nero-800 flex flex-col justify-between hover:border-orange-500/50 transition group">
                        <span class="text-xs font-bold text-orange-500 uppercase tracking-wider">À Retraiter</span>
                        <div class="text-2xl font-black text-orange-400 mt-2">{{ $stats['a_retraiter'] }}</div>
                        <div class="w-full h-1.5 bg-nero-950 rounded-full mt-3 overflow-hidden">
                            <div class="h-full bg-orange-500 w-full shadow-[0_0_5px_#f97316]"></div>
                        </div>
                    </div>

                    <div
                        class="bg-nero-900 p-4 rounded-2xl shadow-lg border border-nero-800 flex flex-col justify-between hover:border-blue-400/50 transition group">
                        <span class="text-xs font-bold text-blue-400 uppercase tracking-wider">Conf. Régie</span>
                        <div class="text-2xl font-black text-blue-300 mt-2">{{ $stats['confirmer_regie'] }}</div>
                        <div class="w-full h-1.5 bg-nero-950 rounded-full mt-3 overflow-hidden">
                            <div class="h-full bg-blue-500 w-full shadow-[0_0_5px_#3b82f6]"></div>
                        </div>
                    </div>

                    <div
                        class="bg-nero-900 p-4 rounded-2xl shadow-lg border border-nero-800 flex flex-col justify-between hover:border-indigo-400/50 transition group">
                        <span class="text-xs font-bold text-indigo-400 uppercase tracking-wider">Confirmé</span>
                        <div class="text-2xl font-black text-indigo-300 mt-2">{{ $stats['confirmer'] }}</div>
                        <div class="w-full h-1.5 bg-nero-950 rounded-full mt-3 overflow-hidden">
                            <div class="h-full bg-indigo-500 w-full shadow-[0_0_5px_#6366f1]"></div>
                        </div>
                    </div>

                    <div
                        class="bg-nero-900 p-4 rounded-2xl shadow-lg border border-nero-800 flex flex-col justify-between hover:border-cyan-400/50 transition group">
                        <span class="text-xs font-bold text-cyan-400 uppercase tracking-wider">VT Prog.</span>
                        <div class="text-2xl font-black text-cyan-300 mt-2">{{ $stats['vt_progammee'] }}</div>
                        <div class="w-full h-1.5 bg-nero-950 rounded-full mt-3 overflow-hidden">
                            <div class="h-full bg-cyan-500 w-full shadow-[0_0_5px_#06b6d4]"></div>
                        </div>
                    </div>

                    <div
                        class="bg-nero-900 p-4 rounded-2xl shadow-lg border border-nero-800 flex flex-col justify-between hover:border-teal-400/50 transition group">
                        <span class="text-xs font-bold text-teal-400 uppercase tracking-wider">VT Réalisée</span>
                        <div class="text-2xl font-black text-teal-300 mt-2">{{ $stats['vt_realisee'] }}</div>
                        <div class="w-full h-1.5 bg-nero-950 rounded-full mt-3 overflow-hidden">
                            <div class="h-full bg-teal-500 w-full shadow-[0_0_5px_#14b8a6]"></div>
                        </div>
                    </div>

                    <div
                        class="bg-nero-900 p-4 rounded-2xl shadow-lg border border-nero-800 flex flex-col justify-between hover:border-emerald-400/50 transition group">
                        <span class="text-xs font-bold text-emerald-400 uppercase tracking-wider">Chantier Prog.</span>
                        <div class="text-2xl font-black text-emerald-300 mt-2">{{ $stats['chantier_programme'] }}</div>
                        <div class="w-full h-1.5 bg-nero-950 rounded-full mt-3 overflow-hidden">
                            <div class="h-full bg-emerald-500 w-full shadow-[0_0_5px_#10b981]"></div>
                        </div>
                    </div>

                    <div
                        class="bg-nero-900 p-4 rounded-2xl shadow-lg border border-nero-800 flex flex-col justify-between hover:border-green-400/50 transition group">
                        <span class="text-xs font-bold text-green-400 uppercase tracking-wider">Nettoyage</span>
                        <div class="text-2xl font-black text-green-300 mt-2">{{ $stats['chantier_termine_nettoyage'] }}
                        </div>
                        <div class="w-full h-1.5 bg-nero-950 rounded-full mt-3 overflow-hidden">
                            <div class="h-full bg-green-500 w-full shadow-[0_0_5px_#22c55e]"></div>
                        </div>
                    </div>

                    <div
                        class="bg-nero-900 p-4 rounded-2xl shadow-lg border border-nero-800 flex flex-col justify-between hover:border-lime-400/50 transition group">
                        <span class="text-xs font-bold text-lime-400 uppercase tracking-wider">Installer 100%</span>
                        <div class="text-2xl font-black text-lime-300 mt-2">{{ $stats['installer_100'] }}</div>
                        <div class="w-full h-1.5 bg-nero-950 rounded-full mt-3 overflow-hidden">
                            <div class="h-full bg-lime-500 w-full shadow-[0_0_5px_#84cc16]"></div>
                        </div>
                    </div>

                    <div
                        class="bg-nero-900 p-4 rounded-2xl shadow-lg border border-nero-800 flex flex-col justify-between hover:border-purple-400/50 transition group">
                        <span class="text-xs font-bold text-purple-400 uppercase tracking-wider">Remplacement</span>
                        <div class="text-2xl font-black text-purple-300 mt-2">
                            {{ $stats['chantier_termine_remplacement'] }}
                        </div>
                        <div class="w-full h-1.5 bg-nero-950 rounded-full mt-3 overflow-hidden">
                            <div class="h-full bg-purple-500 w-full shadow-[0_0_5px_#a855f7]"></div>
                        </div>
                    </div>

                    <div
                        class="bg-nero-900 p-4 rounded-2xl shadow-lg border border-nero-800 flex flex-col justify-between hover:border-rose-400/50 transition group">
                        <span class="text-xs font-bold text-rose-500 uppercase tracking-wider">Chantier Annulé</span>
                        <div class="text-2xl font-black text-rose-400 mt-2">{{ $stats['chantier_annule'] }}</div>
                        <div class="w-full h-1.5 bg-nero-950 rounded-full mt-3 overflow-hidden">
                            <div class="h-full bg-rose-500 w-full shadow-[0_0_5px_#f43f5e]"></div>
                        </div>
                    </div>

                    <div
                        class="bg-nero-900 p-4 rounded-2xl shadow-lg border border-nero-800 flex flex-col justify-between hover:border-red-500/50 transition group">
                        <span class="text-xs font-bold text-red-500 uppercase tracking-wider">Annulé Tôle</span>
                        <div class="text-2xl font-black text-red-400 mt-2">{{ $stats['annule_tole'] }}</div>
                        <div class="w-full h-1.5 bg-nero-950 rounded-full mt-3 overflow-hidden">
                            <div class="h-full bg-red-600 w-full shadow-[0_0_5px_#ef4444]"></div>
                        </div>
                    </div>

                    <div
                        class="bg-nero-900 p-4 rounded-2xl shadow-lg border border-nero-800 flex flex-col justify-between hover:border-fuchsia-400/50 transition group">
                        <span class="text-xs font-bold text-fuchsia-400 uppercase tracking-wider">SAV</span>
                        <div class="text-2xl font-black text-fuchsia-300 mt-2">{{ $stats['sav'] }}</div>
                        <div class="w-full h-1.5 bg-nero-950 rounded-full mt-3 overflow-hidden">
                            <div class="h-full bg-fuchsia-500 w-full shadow-[0_0_5px_#d946ef]"></div>
                        </div>
                    </div>

                    <div
                        class="bg-nero-900 p-4 rounded-2xl shadow-lg border border-nero-800 flex flex-col justify-between hover:border-pink-400/50 transition group">
                        <span class="text-xs font-bold text-pink-400 uppercase tracking-wider">SAV Réalisé</span>
                        <div class="text-2xl font-black text-pink-300 mt-2">{{ $stats['sav_realise'] }}</div>
                        <div class="w-full h-1.5 bg-nero-950 rounded-full mt-3 overflow-hidden">
                            <div class="h-full bg-pink-500 w-full shadow-[0_0_5px_#ec4899]"></div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- 📅 Section Rappels Premium --}}
            <div class="bg-nero-900 rounded-2xl shadow-lg border border-nero-800 overflow-hidden mt-6">
                <div class="p-5 border-b border-nero-800 flex items-center justify-between bg-nero-950/50">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <h3 class="text-base font-bold text-white">Prochains Rappels</h3>
                    </div>
                    <span
                        class="text-xs font-bold px-3 py-1 bg-gold-500/10 text-gold-400 rounded-full border border-gold-500/30">
                        {{ $upcomingRappels->count() }} rappel(s)
                    </span>
                </div>

                @if($upcomingRappels->isEmpty())
                    <div class="p-10 text-center">
                        <svg class="w-12 h-12 mx-auto text-nero-700 mb-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-nero-400 text-sm font-medium">Aucun rappel planifié pour le moment.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-nero-300">
                            <thead
                                class="bg-nero-950 text-xs font-bold uppercase tracking-wider text-nero-400 border-b border-nero-800">
                                <tr>
                                    <th class="py-4 px-5">Société / Contact</th>
                                    <th class="py-4 px-5">Téléphone</th>
                                    <th class="py-4 px-5">Statut</th>
                                    <th class="py-4 px-5">Date & Heure</th>
                                    <th class="py-4 px-5 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-nero-800">
                                @foreach($upcomingRappels as $rappel)
                                    <tr class="hover:bg-nero-800/40 transition duration-150">
                                        <td class="py-4 px-5 font-semibold text-white">
                                            {{ $rappel->raison_sociale }}
                                        </td>
                                        <td class="py-4 px-5 font-mono text-gold-400">
                                            {{ $rappel->telephone }}
                                        </td>
                                        <td class="py-4 px-5">
                                            <span
                                                class="inline-flex items-center px-2.5 py-1 text-xs font-bold rounded-md bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                                {{ $rappel->statut }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-5">
                                            <span class="inline-flex items-center text-xs font-semibold text-nero-300">
                                                <svg class="w-4 h-4 mr-1.5 text-gold-500" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ \Carbon\Carbon::parse($rappel->rappel_at)->format('d/m/Y à H:i') }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-5 text-right space-x-2">
                                            <a href="{{ route('leads.show', $rappel->id) }}"
                                                class="inline-flex items-center text-xs font-bold text-nero-300 hover:text-white bg-nero-800 hover:bg-nero-700 border border-nero-700 px-3 py-1.5 rounded-lg transition">
                                                Voir
                                            </a>

                                            @can('update', $rappel)
                                                <a href="{{ route('leads.edit', $rappel->id) }}"
                                                    class="inline-flex items-center text-xs font-bold text-gold-950 bg-gold-500 hover:bg-gold-400 px-3 py-1.5 rounded-lg shadow-[0_0_10px_rgba(251,186,16,0.2)] hover:shadow-[0_0_15px_rgba(251,186,16,0.4)] transition">
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
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-lg p-6 mt-8">

                <h3 class="text-lg font-semibold mb-6">
                    Évolution des Leads
                </h3>

                <canvas id="leadsChart" height="100"></canvas>

            </div>
        </div>

    </div>

    <style>
        /* Ajout du support pour l'icône de calendrier en dark mode sur l'input date */
        .color-scheme-dark::-webkit-calendar-picker-indicator {
            filter: invert(1);
            opacity: 0.6;
            cursor: pointer;
        }

        .color-scheme-dark::-webkit-calendar-picker-indicator:hover {
            opacity: 1;
        }
    </style>

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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>

        const ctx = document.getElementById('leadsChart');

        new Chart(ctx, {

            type: 'line',

            data: {

                labels: @json($chartLabels),

                datasets: [{

                    label: 'Leads',

                    data: @json($chartData),

                    borderColor: '#f59e0b',

                    backgroundColor: 'rgba(245,158,11,.15)',

                    borderWidth: 3,

                    fill: true,

                    tension: .35,

                    pointRadius: 4

                }]
            },

            options: {

                responsive: true,

                plugins: {

                    legend: {

                        display: false

                    }

                }

            }

        });

    </script>
</x-app-layout>