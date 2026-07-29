<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-amber-500 leading-tight">
            Créer une nouvelle fiche Lead
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">

                <form action="{{ route('leads.store') }}" method="POST">
                    @csrf

                    <div class="border-b border-gray-200 pb-6 mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m3 0h1m-4-8l2-2m0 0l2 2m-2-2v6">
                                </path>
                            </svg>
                            1. Informations de l'entreprise
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Raison Sociale *</label>
                                <input type="text" name="raison_sociale" value="{{ old('raison_sociale') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                @error('raison_sociale') <span class="text-red-500 text-xs">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Téléphone *</label>
                                <input type="text" name="telephone" value="{{ old('telephone') }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                @error('telephone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">SIRET</label>
                                <input type="text" name="siret" value="{{ old('siret') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                @error('siret') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Gérant / Contact</label>
                                <input type="text" name="gerant" value="{{ old('gerant') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Adresse</label>
                                <input type="text" name="adresse" value="{{ old('adresse') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Code Postal</label>
                                <input type="text" name="code_postal" value="{{ old('code_postal') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Ville</label>
                                <input type="text" name="ville" value="{{ old('ville') }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                            </div>
                        </div>
                    </div>

                    <div class="border-b border-gray-200 pb-6 mb-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            2. Caractéristiques du produit
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Gamme Produit *</label>
                                <select name="product_type" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                    <option value="lanterneau" {{ old('product_type') == 'lanterneau' ? 'selected' : '' }}>Lanterneau</option>
                                    <option value="energie" {{ old('product_type') == 'energie' ? 'selected' : '' }}>
                                        Énergie</option>
                                    <option value="autre" {{ old('product_type') == 'autre' ? 'selected' : '' }}>Autre
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Superficie Lanterneau
                                    (m²)</label>
                                <input type="number" step="0.01" name="superficie_lanterneau"
                                    value="{{ old('superficie_lanterneau') }}" placeholder="Ex: 76.15"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                            </div>
                        </div>
                    </div>

                    <div class="pb-6 mb-6 border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            3. Qualification & Planification
                        </h3>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
    <div>
        <label class="block text-sm font-medium text-gray-700">Statut *</label>

        @if(in_array(auth()->user()->role, ['agent', 'supervisor']))
            {{-- Pour l'agent et le superviseur : statut forcé à "Nouveau" --}}
            <input type="text" value="Nouveau" disabled class="form-select bg-gray-100 cursor-not-allowed">
            <input type="hidden" name="statut" value="Nouveau">
        @else
            {{-- Pour les autres (Admin, Secrétaire) : menu déroulant classique --}}
            <select name="statut" id="statut" class="form-select">
                @foreach(config('crm.statuts') as $st)
                    <option value="{{ $st }}" {{ old('statut', $lead->statut ?? config('crm.default_statut')) === $st ? 'selected' : '' }}>
                        {{ $st }}
                    </option>
                @endforeach
            </select>
        @endif
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Date & Heure de Rappel / RDV</label>
        <input type="datetime-local" name="rappel_at" value="{{ old('rappel_at') }}"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
    </div>
</div>

                        @if(in_array(strtolower(auth()->user()->role ?? ''), ['admin', 'secretaire', 'superviseur']))
                            <div x-data="agentSelector({
                                                allAgents: {{ json_encode($agents) }},
                                                selectedTeam: '{{ old('team_id', $lead->team_id ?? auth()->user()->team_id ?? '') }}',
                                                selectedAgent: '{{ old('user_id', $lead->user_id ?? auth()->id()) }}'
                                            })"
                                class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 bg-gray-50 p-4 rounded-lg border border-gray-200">

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Équipe attribuée *</label>
                                    <select name="team_id" x-model="selectedTeam" @change="filterAgents()"
                                        @if(in_array(strtolower(auth()->user()->role), ['superviseur'])) disabled @endif
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                        <option value="">-- Sélectionner une équipe --</option>
                                        @foreach($teams ?? [] as $team)
                                            <option value="{{ $team->id }}">{{ $team->nom ?? $team->name }}</option>
                                        @endforeach
                                    </select>
                                    {{-- Champ caché si le select est désactivé pour le superviseur --}}
                                    @if(in_array(strtolower(auth()->user()->role), ['superviseur']))
                                        <input type="hidden" name="team_id" value="{{ auth()->user()->team_id }}">
                                    @endif
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Agent Référent *</label>
                                    <select name="user_id" x-model="selectedAgent"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                        <option value="">-- Sélectionner un agent --</option>
                                        <template x-for="agent in filteredAgents" :key="agent.id">
                                            <option :value="agent.id" :selected="agent.id == selectedAgent"
                                                x-text="agent.name">
                                            </option>
                                        </template>
                                    </select>
                                </div>
                            </div>

                            <script>
                                document.addEventListener('alpine:init', () => {
                                    Alpine.data('agentSelector', (config) => ({
                                        allAgents: config.allAgents,
                                        selectedTeam: config.selectedTeam,
                                        selectedAgent: config.selectedAgent,
                                        filteredAgents: [],

                                        init() {
                                            this.filterAgents();
                                        },

                                        filterAgents() {
                                            // Si aucune équipe n'est sélectionnée, la liste des agents devient vide
                                            if (!this.selectedTeam) {
                                                this.filteredAgents = [];
                                            } else {
                                                // Filtrer les agents selon l'équipe sélectionnée
                                                this.filteredAgents = this.allAgents.filter(
                                                    agent => agent.team_id == this.selectedTeam
                                                );
                                            }

                                            // Réinitialiser le champ de sélection de l'agent si l'agent précédemment choisi 
                                            // n'appartient pas à la nouvelle liste filtrée
                                            const agentExists = this.filteredAgents.some(a => a.id == this.selectedAgent);
                                            if (!agentExists) {
                                                this.selectedAgent = '';
                                            }
                                        }
                                    }));
                                });
                            </script>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Commentaire Agent</label>
                                <textarea name="agent_comment" rows="3"
                                    placeholder="Saisissez les remarques de l'appel..."
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">{{ old('agent_comment') }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Commentaire Confirmation /
                                    Superviseur</label>
                                <textarea name="confirmation_comment" rows="3"
                                    placeholder="Remarques éventuelles de confirmation..."
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">{{ old('confirmation_comment') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('leads.index') }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors">
                            Annuler
                        </a>
                        <button type="submit"
                            class="px-5 py-2 bg-amber-500 text-white font-semibold rounded-md hover:bg-amber-600 shadow-sm transition-colors flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4"></path>
                            </svg>
                            Créer la fiche
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>