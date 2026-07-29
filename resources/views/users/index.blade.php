<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-amber-400 tracking-tight flex items-center gap-2.5">
                    <div class="p-2 bg-amber-500/10 rounded-xl border border-amber-500/20">
                        <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    Gestion des Utilisateurs
                </h2>
                <p class="text-xs text-slate-400 mt-1">Gérez les accès, rôles et statuts d'activation des membres de VISIONBF</p>
            </div>

            <a href="{{ route('users.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-950 font-bold text-xs uppercase tracking-wider rounded-xl shadow-lg shadow-amber-500/20 transition-all transform hover:-translate-y-0.5 active:translate-y-0">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                Créer un utilisateur
            </a>
        </div>
    </x-slot>

    <div class="py-6 space-y-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            {{-- Messages d'alerte --}}
            @if(session('success'))
                <div class="p-4 bg-emerald-500/10 border border-emerald-500/30 rounded-2xl text-emerald-400 text-sm flex items-center justify-between shadow-lg backdrop-blur-sm">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-200 transition p-1">&times;</button>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 bg-red-500/10 border border-red-500/30 rounded-2xl text-red-400 text-sm flex items-center justify-between shadow-lg backdrop-blur-sm">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-red-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('error') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-200 transition p-1">&times;</button>
                </div>
            @endif

            {{-- Cartes de Statistiques --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-slate-900/90 border border-amber-500/20 p-5 rounded-2xl shadow-xl flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Membres</p>
                        <p class="text-2xl font-black text-amber-400 mt-1">{{ method_exists($users, 'total') ? $users->total() : count($users) }}</p>
                    </div>
                    <div class="p-3 bg-amber-500/10 rounded-xl border border-amber-500/20 text-amber-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>

                <div class="bg-slate-900/90 border border-amber-500/20 p-5 rounded-2xl shadow-xl flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Comptes Actifs</p>
                        <p class="text-2xl font-black text-emerald-400 mt-1">{{ $users->where('is_active', true)->count() }}</p>
                    </div>
                    <div class="p-3 bg-emerald-500/10 rounded-xl border border-emerald-500/20 text-emerald-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <div class="bg-slate-900/90 border border-amber-500/20 p-5 rounded-2xl shadow-xl flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Inactifs / En Attente</p>
                        <p class="text-2xl font-black text-amber-500 mt-1">{{ $users->where('is_active', false)->count() }}</p>
                    </div>
                    <div class="p-3 bg-amber-500/10 rounded-xl border border-amber-500/20 text-amber-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>

                <div class="bg-slate-900/90 border border-amber-500/20 p-5 rounded-2xl shadow-xl flex items-center justify-between">
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Admins / Secrétaires</p>
                        <p class="text-2xl font-black text-purple-400 mt-1">{{ $users->whereIn('role', ['admin', 'secretaire'])->count() }}</p>
                    </div>
                    <div class="p-3 bg-purple-500/10 rounded-xl border border-purple-500/20 text-purple-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Formulaire de Filtre --}}
            <div class="bg-slate-900 border border-amber-500/20 rounded-2xl p-5 shadow-2xl">
                <form method="GET" action="{{ route('users.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3 items-end">
                    
                    <div class="lg:col-span-4">
                        <label class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">Recherche</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Nom, prénom ou email..." 
                                class="w-full pl-9 pr-3 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-slate-200 text-sm focus:border-amber-500 focus:ring-1 focus:ring-amber-500 placeholder-slate-600 transition">
                        </div>
                    </div>

                    <div class="lg:col-span-3">
                        <label class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">Rôle</label>
                        <select name="role" class="w-full py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-slate-200 text-sm focus:border-amber-500 focus:ring-1 focus:ring-amber-500">
                            <option value="">Tous les rôles</option>
                            <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Administrateur</option>
                            <option value="secretary" {{ request('role') === 'secretary' ? 'selected' : '' }}>Secrétaire</option>
                            <option value="supervisor" {{ request('role') === 'supervisor' ? 'selected' : '' }}>Superviseur</option>
                            <option value="agent" {{ request('role') === 'agent' ? 'selected' : '' }}>Agent</option>
                        </select>
                    </div>

                    <div class="lg:col-span-3">
                        <label class="block text-xs font-semibold text-slate-400 mb-1.5 uppercase tracking-wider">Statut</label>
                        <select name="status" class="w-full py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-slate-200 text-sm focus:border-amber-500 focus:ring-1 focus:ring-amber-500">
                            <option value="">Tous les statuts</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Actifs uniquement</option>
                            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactifs / En attente</option>
                        </select>
                    </div>

                    <div class="lg:col-span-2 flex gap-2">
                        <button type="submit" class="flex-1 py-2.5 bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold rounded-xl text-sm transition shadow-md shadow-amber-500/10 flex items-center justify-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            Filtrer
                        </button>
                        @if(request()->hasAny(['search', 'role', 'status']))
                            <a href="{{ route('users.index') }}" title="Réinitialiser" class="p-2.5 bg-slate-800 hover:bg-slate-700 text-slate-400 hover:text-slate-200 rounded-xl transition flex items-center justify-center border border-slate-700/50">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Liste / Tableau des utilisateurs --}}
            <div class="bg-slate-900 border border-amber-500/20 rounded-2xl overflow-hidden shadow-2xl">
                
                {{-- Vue Desktop (Tableau) --}}
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-950/80 text-amber-400 uppercase text-[11px] font-bold tracking-wider border-b border-amber-500/20">
                                <th class="px-6 py-4">Utilisateur</th>
                                <th class="px-6 py-4">Rôle</th>
                                <th class="px-6 py-4">Équipe</th>
                                <th class="px-6 py-4">Statut</th>
                                <th class="px-6 py-4">Inscription</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/80 text-sm">
                            @forelse($users as $user)
                                <tr class="hover:bg-slate-800/40 transition-colors group">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-500/20 to-amber-400/10 border border-amber-500/30 flex items-center justify-center font-bold text-amber-400 uppercase text-xs shadow-inner shrink-0">
                                                {{ strtoupper(substr($user->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-slate-100 group-hover:text-amber-400 transition-colors">{{ $user->name }}</div>
                                                <div class="text-xs text-slate-400">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @switch($user->role)
                                            @case('admin')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-purple-500/10 text-purple-400 border border-purple-500/30">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-purple-400"></span>
                                                    Administrateur
                                                </span>
                                                @break
                                            @case('secretary')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-500/10 text-blue-400 border border-blue-500/30">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-400"></span>
                                                    Secrétaire
                                                </span>
                                                @break
                                            @case('supervisor')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-500/10 text-amber-400 border border-amber-500/30">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                                    Superviseur
                                                </span>
                                                @break
                                            @default
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-slate-800 text-slate-300 border border-slate-700">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                                    Agent
                                                </span>
                                        @endswitch
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-slate-300 text-xs">
                                        @if($user->team)
                                            <span class="px-2.5 py-1 bg-slate-950 border border-slate-800 rounded-lg text-slate-300 font-medium">
                                                {{ $user->team->name }}
                                            </span>
                                        @else
                                            <span class="text-slate-600 italic">Sans équipe</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($user->is_active)
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/30">
                                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                                Actif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-500/10 text-amber-500 border border-amber-500/20">
                                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                                Inactif
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-400">
                                        {{ $user->created_at ? $user->created_at->format('d/m/Y') : '-' }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            @if(auth()->id() !== $user->id)
                                                <form method="POST" action="{{ route('users.toggle-status', $user) }}" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    @if($user->is_active)
                                                        <button type="submit" title="Désactiver le compte" class="px-3 py-1.5 bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/30 rounded-xl text-xs font-semibold transition">
                                                            Désactiver
                                                        </button>
                                                    @else
                                                        <button type="submit" title="Activer le compte" class="px-3 py-1.5 bg-emerald-600 hover:bg-emerald-500 text-white font-bold rounded-xl text-xs transition shadow-md shadow-emerald-600/20">
                                                            Activer
                                                        </button>
                                                    @endif
                                                </form>
                                            @endif

                                            <a href="{{ route('users.edit', $user) }}" class="p-2 bg-slate-800 hover:bg-amber-500 hover:text-slate-950 text-slate-300 rounded-xl transition border border-slate-700/50" title="Modifier">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                </svg>
                                            </a>

                                            @if(auth()->id() !== $user->id)
                                                <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer définitivement cet utilisateur ?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 bg-slate-800 hover:bg-red-600 text-slate-400 hover:text-white rounded-xl transition border border-slate-700/50" title="Supprimer">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center space-y-3">
                                            <div class="w-12 h-12 rounded-full bg-slate-800 flex items-center justify-center text-slate-500">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                </svg>
                                            </div>
                                            <p class="text-slate-400 text-sm font-medium">Aucun utilisateur ne correspond à vos critères de recherche.</p>
                                            <a href="{{ route('users.index') }}" class="text-xs text-amber-400 hover:underline">Réinitialiser les filtres</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Vue Mobile (Cartes) --}}
                <div class="block md:hidden divide-y divide-slate-800">
                    @forelse($users as $user)
                        <div class="p-4 space-y-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center font-bold text-amber-400 text-xs">
                                        {{ strtoupper(substr($user->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <div class="font-bold text-slate-100">{{ $user->name }}</div>
                                        <div class="text-xs text-slate-400">{{ $user->email }}</div>
                                    </div>
                                </div>
                                @if($user->is_active)
                                    <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                @else
                                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                                @endif
                            </div>

                            <div class="flex items-center justify-between text-xs pt-1">
                                <div class="text-slate-400">Rôle : <span class="text-slate-200 capitalize">{{ $user->role }}</span></div>
                                <div class="text-slate-400">Équipe : <span class="text-slate-200">{{ $user->team ? $user->team->name : 'Aucune' }}</span></div>
                            </div>

                            <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-800/60">
                                @if(auth()->id() !== $user->id)
                                    <form method="POST" action="{{ route('users.toggle-status', $user) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="px-2.5 py-1 bg-slate-800 text-slate-300 rounded-lg text-xs font-semibold">
                                            {{ $user->is_active ? 'Désactiver' : 'Activer' }}
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('users.edit', $user) }}" class="p-1.5 bg-slate-800 text-amber-400 rounded-lg">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="p-6 text-center text-slate-400 text-sm">
                            Aucun utilisateur trouvé.
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                @if(method_exists($users, 'hasPages') && $users->hasPages())
                    <div class="px-6 py-4 bg-slate-950/80 border-t border-slate-800/80">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>