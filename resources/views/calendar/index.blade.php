<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gold-500">
                    Calendrier CRM
                </h2>
                <p class="text-sm text-gray-400 mt-1">
                    Rappels • Visites Techniques • Chantiers • SAV • Événements CRM
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">

        <div class="max-w-7xl mx-auto px-6">

            <div class="bg-[#111111] border border-yellow-600 rounded-2xl shadow-xl p-6">

                <div id="calendar"></div>
                <!-- Modal -->
<div id="eventModal"
     class="fixed inset-0 z-50 hidden">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>

    <!-- Fenêtre -->
    <div class="relative flex items-center justify-center min-h-screen p-6">

        <div class="w-full max-w-xl bg-[#111111] border border-yellow-600 rounded-2xl shadow-2xl">

            <!-- Header -->
            <div class="flex justify-between items-center px-6 py-4 border-b border-yellow-700">

                <h2 class="text-xl font-bold text-yellow-400">
                    Nouvel évènement
                </h2>

                <button id="closeModal"
                        class="text-gray-400 hover:text-yellow-400 text-2xl">
                    ×
                </button>

            </div>

            <form id="eventForm">

                @csrf

                <div class="p-6 space-y-5">

                    <div>

                        <label class="block mb-2 text-sm text-yellow-400">
                            Titre
                        </label>

                        <input
                            id="title"
                            type="text"
                            name="title"
                            class="w-full rounded-lg bg-[#1b1b1b] border border-gray-700 text-white focus:border-yellow-500 focus:ring-yellow-500">

                    </div>

                    <div>

                        <label class="block mb-2 text-sm text-yellow-400">
                            Type
                        </label>

                        <select
                            id="type"
                            name="type"
                            class="w-full rounded-lg bg-[#1b1b1b] border border-gray-700 text-white">

                            <option value="call">📞 Rappel</option>
                            <option value="meeting">🤝 Rendez-vous</option>
                            <option value="visit">🏠 Visite</option>
                            <option value="chantier">🔨 Chantier</option>
                            <option value="sav">🛠 SAV</option>

                        </select>

                    </div>

                    <div>

                        <label class="block mb-2 text-sm text-yellow-400">
                            Date
                        </label>

                        <input
                            type="datetime-local"
                            id="start"
                            name="start"
                            class="w-full rounded-lg bg-[#1b1b1b] border border-gray-700 text-white">

                    </div>

                    <div>

                        <label class="block mb-2 text-sm text-yellow-400">
                            Description
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            class="w-full rounded-lg bg-[#1b1b1b] border border-gray-700 text-white resize-none"></textarea>

                    </div>

                </div>

                <div class="flex justify-end gap-3 px-6 py-5 border-t border-yellow-700">

                    <button
                        type="button"
                        id="cancelModal"
                        class="px-5 py-2 rounded-lg bg-gray-700 hover:bg-gray-600 text-white">

                        Annuler

                    </button>

                    <button
                        type="submit"
                        class="px-6 py-2 rounded-lg bg-yellow-500 hover:bg-yellow-400 text-black font-bold">

                        Enregistrer

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

            </div>

        </div>

    </div>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/calendar.js'
    ])

</x-app-layout>