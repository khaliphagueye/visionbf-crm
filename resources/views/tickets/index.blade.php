<x-app-layout>
    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Support Technique & Tickets</h1>
            <a href="{{ route('tickets.create') }}" class="px-4 py-2 bg-amber-600 text-white font-semibold rounded-md hover:bg-amber-700 transition">
                + Nouveau Ticket
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">#</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Sujet</th>
                        @if(Auth::user()->role === 'admin')
                            <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Créateur</th>
                        @endif
                        <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Priorité</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Statut</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-right font-medium text-gray-500 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($tickets as $ticket)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-bold text-gray-700">#{{ $ticket->id }}</td>
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $ticket->sujet }}</td>
                            @if(Auth::user()->role === 'admin')
                                <td class="px-6 py-4 text-gray-600">{{ $ticket->user->name }}</td>
                            @endif
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded-full font-semibold
                                    {{ $ticket->priorite === 'urgente' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ $ticket->priorite === 'haute' ? 'bg-orange-100 text-orange-800' : '' }}
                                    {{ $ticket->priorite === 'moyenne' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $ticket->priorite === 'basse' ? 'bg-gray-100 text-gray-800' : '' }}">
                                    {{ ucfirst($ticket->priorite) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded-full font-semibold
                                    {{ $ticket->statut === 'resolu' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $ticket->statut === 'ouvert' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $ticket->statut === 'en_cours' ? 'bg-purple-100 text-purple-800' : '' }}
                                    {{ $ticket->statut === 'ferme' ? 'bg-gray-200 text-gray-700' : '' }}">
                                    {{ ucfirst(str_replace('_', ' ', $ticket->statut)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500 text-xs">{{ $ticket->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('tickets.show', $ticket->id) }}" class="text-amber-600 hover:text-amber-900 font-semibold">
                                    Ouvrir →
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                Aucun ticket trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $tickets->links() }}
        </div>
    </div>
</x-app-layout>