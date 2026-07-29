<x-app-layout>
    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Ouvrir un nouveau ticket</h1>
                <p class="text-sm text-gray-500">Décrivez votre problème ou demande pour que l'équipe technique puisse vous aider.</p>
            </div>
            <a href="{{ route('tickets.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-md hover:bg-gray-300 transition">
                ← Retour aux tickets
            </a>
        </div>

        <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
            <form action="{{ route('tickets.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="sujet" class="block text-sm font-medium text-gray-700 mb-1">
                        Sujet du ticket <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="sujet" id="sujet" value="{{ old('sujet') }}" required 
                        placeholder="Ex: Problème d'accès à la fiche client #1234"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('sujet') border-red-500 @enderror">
                    @error('sujet')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="priorite" class="block text-sm font-medium text-gray-700 mb-1">
                        Priorité <span class="text-red-500">*</span>
                    </label>
                    <select name="priorite" id="priorite" required 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('priorite') border-red-500 @enderror">
                        <option value="basse" {{ old('priorite') === 'basse' ? 'selected' : '' }}>Basse (Demande d'information / mineure)</option>
                        <option value="moyenne" {{ old('priorite', 'moyenne') === 'moyenne' ? 'selected' : '' }}>Moyenne (Impact modéré)</option>
                        <option value="haute" {{ old('priorite') === 'haute' ? 'selected' : '' }}>Haute (Bloque une partie de mon travail)</option>
                        <option value="urgente" {{ old('priorite') === 'urgente' ? 'selected' : '' }}>Urgente (Système totalement inaccessible)</option>
                    </select>
                    @error('priorite')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-1">
                        Description détaillée <span class="text-red-500">*</span>
                    </label>
                    <textarea name="message" id="message" rows="6" required
                        placeholder="Expliquez en détail le problème rencontré, les étapes pour le reproduire ou vos besoins..."
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('tickets.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 font-medium">
                        Annuler
                    </a>
                    <button type="submit" class="px-4 py-2 bg-amber-600 text-white font-semibold rounded-md hover:bg-amber-700 transition shadow-sm">
                        Soumettre le ticket
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout><x-app-layout>
    <div class="py-6 max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Ouvrir un nouveau ticket</h1>
                <p class="text-sm text-gray-500">Décrivez votre problème ou demande pour que l'équipe technique puisse vous aider.</p>
            </div>
            <a href="{{ route('tickets.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 font-medium rounded-md hover:bg-gray-300 transition">
                ← Retour aux tickets
            </a>
        </div>

        <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6">
            <form action="{{ route('tickets.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="sujet" class="block text-sm font-medium text-gray-700 mb-1">
                        Sujet du ticket <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="sujet" id="sujet" value="{{ old('sujet') }}" required 
                        placeholder="Ex: Problème d'accès à la fiche client #1234"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('sujet') border-red-500 @enderror">
                    @error('sujet')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="priorite" class="block text-sm font-medium text-gray-700 mb-1">
                        Priorité <span class="text-red-500">*</span>
                    </label>
                    <select name="priorite" id="priorite" required 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('priorite') border-red-500 @enderror">
                        <option value="basse" {{ old('priorite') === 'basse' ? 'selected' : '' }}>Basse (Demande d'information / mineure)</option>
                        <option value="moyenne" {{ old('priorite', 'moyenne') === 'moyenne' ? 'selected' : '' }}>Moyenne (Impact modéré)</option>
                        <option value="haute" {{ old('priorite') === 'haute' ? 'selected' : '' }}>Haute (Bloque une partie de mon travail)</option>
                        <option value="urgente" {{ old('priorite') === 'urgente' ? 'selected' : '' }}>Urgente (Système totalement inaccessible)</option>
                    </select>
                    @error('priorite')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-1">
                        Description détaillée <span class="text-red-500">*</span>
                    </label>
                    <textarea name="message" id="message" rows="6" required
                        placeholder="Expliquez en détail le problème rencontré, les étapes pour le reproduire ou vos besoins..."
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-amber-500 focus:ring-amber-500 @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('tickets.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 font-medium">
                        Annuler
                    </a>
                    <button type="submit" class="px-4 py-2 bg-amber-600 text-white font-semibold rounded-md hover:bg-amber-700 transition shadow-sm">
                        Soumettre le ticket
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>