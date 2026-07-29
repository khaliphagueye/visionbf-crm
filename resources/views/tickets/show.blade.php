<x-app-layout>
    <div class="py-6 max-w-5xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-3">
                <a href="{{ route('tickets.index') }}" class="px-3 py-1.5 bg-gray-200 text-gray-700 font-medium rounded-md hover:bg-gray-300 transition text-sm">
                    ← Retour
                </a>
                <h1 class="text-2xl font-bold text-gray-800">
                    Ticket #{{ $ticket->id }} : {{ $ticket->sujet }}
                </h1>
            </div>

            <div class="flex items-center gap-2">
                <span class="px-3 py-1 text-xs rounded-full font-semibold
                    {{ $ticket->priorite === 'urgente' ? 'bg-red-100 text-red-800' : '' }}
                    {{ $ticket->priorite === 'haute' ? 'bg-orange-100 text-orange-800' : '' }}
                    {{ $ticket->priorite === 'moyenne' ? 'bg-blue-100 text-blue-800' : '' }}
                    {{ $ticket->priorite === 'basse' ? 'bg-gray-100 text-gray-800' : '' }}">
                    Priorité : {{ ucfirst($ticket->priorite) }}
                </span>

                <span class="px-3 py-1 text-xs rounded-full font-semibold
                    {{ $ticket->statut === 'resolu' ? 'bg-green-100 text-green-800' : '' }}
                    {{ $ticket->statut === 'ouvert' ? 'bg-yellow-100 text-yellow-800' : '' }}
                    {{ $ticket->statut === 'en_cours' ? 'bg-purple-100 text-purple-800' : '' }}
                    {{ $ticket->statut === 'ferme' ? 'bg-gray-200 text-gray-700' : '' }}">
                    Statut : {{ ucfirst(str_replace('_', ' ', $ticket->statut)) }}
                </span>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="lg:col-span-2 space-y-4">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Discussion</h2>

                @foreach($ticket->messages as $msg)
                    <div class="p-4 rounded-lg border shadow-sm {{ $msg->user->role === 'admin' ? 'bg-amber-50 border-amber-200' : 'bg-white border-gray-200' }}">
                        <div class="flex justify-between items-center mb-2 pb-2 border-b border-gray-100">
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-gray-800">{{ $msg->user->name }}</span>
                                @if($msg->user->role === 'admin')
                                    <span class="px-2 py-0.5 text-xs bg-amber-200 text-amber-800 rounded font-semibold">Support Admin</span>
                                @endif
                            </div>
                            <span class="text-xs text-gray-400">{{ $msg->created_at->format('d/m/Y à H:i') }}</span>
                        </div>
                        <div class="text-gray-700 text-sm whitespace-pre-line">
                            {{ $msg->message }}
                        </div>
                    </div>
                @endforeach

                @if($ticket->statut !== 'ferme')
                    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm mt-6">
                        <h3 class="text-md font-semibold text-gray-800 mb-3">Répondre au ticket</h3>
                        <form action="{{ route('tickets.reply', $ticket->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <textarea name="message" rows="4" required placeholder="Saisissez votre réponse ici..." 
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 text-sm"></textarea>
                                @error('message')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="px-4 py-2 bg-amber-600 text-white font-semibold rounded-md hover:bg-amber-700 transition text-sm">
                                    Envoyer la réponse
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="p-4 bg-gray-100 text-gray-600 text-center rounded-md text-sm border border-gray-200">
                        Ce ticket est fermé. Aucune nouvelle réponse ne peut être envoyée.
                    </div>
                @endif
            </div>

            <div class="space-y-4">
                
                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                    <h3 class="text-md font-semibold text-gray-800 mb-3 border-b pb-2">Informations</h3>
                    <div class="space-y-2 text-sm">
                        <div>
                            <span class="text-gray-500">Auteur :</span>
                            <p class="font-medium text-gray-800">{{ $ticket->user->name }} ({{ $ticket->user->email }})</p>
                        </div>
                        <div>
                            <span class="text-gray-500">Créé le :</span>
                            <p class="font-medium text-gray-800">{{ $ticket->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <span class="text-gray-500">Dernière mise à jour :</span>
                            <p class="font-medium text-gray-800">{{ $ticket->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                @if(Auth::user()->role === 'admin')
                    <div class="bg-amber-50 border border-amber-200 p-4 rounded-lg shadow-sm">
                        <h3 class="text-md font-semibold text-amber-900 mb-3 border-b border-amber-200 pb-2">
                            ⚙️ Action Administrateur
                        </h3>
                        <form action="{{ route('tickets.updateStatus', $ticket->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label for="statut" class="block text-xs font-medium text-amber-800 mb-1">
                                    Changer le statut du ticket :
                                </label>
                                <select name="statut" id="statut" class="w-full text-sm rounded-md border-amber-300 shadow-sm focus:border-amber-500 focus:ring-amber-500">
                                    <option value="ouvert" {{ $ticket->statut === 'ouvert' ? 'selected' : '' }}>Ouvert</option>
                                    <option value="en_cours" {{ $ticket->statut === 'en_cours' ? 'selected' : '' }}>En cours</option>
                                    <option value="resolu" {{ $ticket->statut === 'resolu' ? 'selected' : '' }}>Résolu</option>
                                    <option value="ferme" {{ $ticket->statut === 'ferme' ? 'selected' : '' }}>Fermé</option>
                                </select>
                            </div>
                            <button type="submit" class="w-full px-3 py-2 bg-amber-700 text-white font-semibold rounded-md hover:bg-amber-800 transition text-sm">
                                Mettre à jour le statut
                            </button>
                        </form>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>