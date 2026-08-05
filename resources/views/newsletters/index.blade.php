<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <div>

                <h2 class="text-3xl font-bold text-slate-800 dark:text-white">

                    Gestion Newsletter

                </h2>

                <p class="text-slate-500 mt-1">

                    Gérez les abonnés de votre newsletter.

                </p>

            </div>

        </div>

    </x-slot>
    @if(session('success'))

        <script>

            Swal.fire({

                icon: 'success',

                title: 'Succès',

                text: '{{ session("success") }}',

                timer: 2500,

                showConfirmButton: false

            });

        </script>

    @endif

    <div class="py-8">

        <div class="max-w-7xl mx-auto px-6">

            {{-- Cartes statistiques --}}

            {{-- ===================== --}}
            {{-- Statistiques Premium --}}
            {{-- ===================== --}}

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

                {{-- Total --}}
                <x-stat-card icon="fa-solid fa-envelope" color="blue" title="Total abonnés" :value="$total" />

                {{-- Aujourd'hui --}}
                <x-stat-card icon="fa-solid fa-calendar-day" color="green" title="Aujourd'hui" :value="$today" />

                {{-- Hier --}}
                <x-stat-card icon="fa-solid fa-clock-rotate-left" color="orange" title="Hier" :value="$yesterday" />

                {{-- Cette semaine --}}
                <x-stat-card icon="fa-solid fa-calendar-week" color="amber" title="Cette semaine" :value="$week" />

                {{-- Ce mois --}}
                <x-stat-card icon="fa-solid fa-chart-line" color="purple" title="Ce mois" :value="$month" />

                {{-- Mois précédent --}}
                <x-stat-card icon="fa-solid fa-chart-column" color="pink" title="Mois précédent" :value="$lastMonth" />

                {{-- Cette année --}}
                <x-stat-card icon="fa-solid fa-calendar" color="indigo" title="Cette année" :value="$year" />

                {{-- Dernières 24h --}}
                <x-stat-card icon="fa-solid fa-stopwatch" color="cyan" title="Dernières 24h" :value="$last24Hours" />

                {{-- 7 jours --}}
                <x-stat-card icon="fa-solid fa-calendar-days" color="emerald" title="7 derniers jours"
                    :value="$last7Days" />

                {{-- 30 jours --}}
                <x-stat-card icon="fa-solid fa-calendar-days" color="red" title="30 derniers jours"
                    :value="$last30Days" />

                {{-- Trimestre --}}
                <x-stat-card icon="fa-solid fa-chart-pie" color="violet" title="Ce trimestre" :value="$quarter" />

                {{-- Année --}}
                <x-stat-card icon="fa-solid fa-trophy" color="yellow" title="Dernier trimestre" :value="$lastQuarter" />

            </div>
            <div class="grid lg:grid-cols-2 gap-6 mb-8">

    <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-6">
        <h2 class="text-xl font-bold mb-5">
            Inscriptions (30 jours)
        </h2>

        <canvas id="dailyChart"></canvas>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-6">
        <h2 class="text-xl font-bold mb-5">
            Répartition par heure
        </h2>

        <canvas id="hourlyChart"></canvas>
    </div>

</div>

<div class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl p-6 mb-8">

    <h2 class="text-xl font-bold mb-5">

        Evolution mensuelle

    </h2>

    <canvas id="monthlyChart"></canvas>

</div>

            {{-- ===================== --}}
            {{-- Recherche --}}
            {{-- ===================== --}}

            <div
                class="bg-white dark:bg-slate-900 rounded-3xl shadow-xl border border-slate-200 dark:border-slate-800 p-6 mb-8">

                <div class="flex items-center justify-between mb-6">

                    <h2 class="text-xl font-bold flex items-center gap-2">

                        <i class="fa-solid fa-filter text-amber-500"></i>

                        Filtrer les abonnés

                    </h2>

                    <span class="text-sm text-slate-500">

                        {{ $newsletters->count() }} résultat(s)

                    </span>

                </div>

                <form method="GET" action="{{ route('newsletters.index') }}">

                    <div class="grid lg:grid-cols-4 gap-5">

                        <div>

                            <label class="block mb-2 font-medium">

                                Email

                            </label>

                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Rechercher un email..."
                                class="w-full rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-800">

                        </div>

                        <div>

                            <label class="block mb-2 font-medium">

                                Date

                            </label>

                            <input type="date" name="date" value="{{ request('date') }}"
                                class="w-full rounded-xl border-slate-300 dark:border-slate-700 dark:bg-slate-800">

                        </div>

                        <div class="flex items-end">

                            <button class="w-full rounded-xl bg-blue-600 hover:bg-blue-700 text-white py-3 transition">

                                <i class="fa-solid fa-magnifying-glass mr-2"></i>

                                Rechercher

                            </button>

                        </div>

                        <div class="flex items-end">

                            <a href="{{ route('newsletters.index') }}"
                                class="w-full text-center rounded-xl bg-slate-200 dark:bg-slate-700 py-3 hover:bg-slate-300 dark:hover:bg-slate-600 transition">

                                <i class="fa-solid fa-rotate-left mr-2"></i>

                                Réinitialiser

                            </a>

                        </div>

                    </div>

                </form>

            </div>

            {{-- Tableau --}}

            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-lg overflow-hidden">

                <table id="newsletterTable" class="min-w-full">

                    <thead class="bg-slate-100 dark:bg-slate-800">

                        <tr>

                            <th class="p-4 text-left">#</th>

                            <th class="p-4 text-left">Adresse email</th>

                            <th class="p-4 text-left">Date d'inscription</th>

                            <th class="p-4 text-center">Actions</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($newsletters as $newsletter)

                            <tr class="border-t dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800">

                                <td class="p-4">

                                    {{ $newsletter->id }}

                                </td>

                                <td class="p-4">

                                    {{ $newsletter->email }}

                                </td>

                                <td class="p-4">

                                    {{ $newsletter->created_at->format('d/m/Y H:i') }}

                                </td>

                                <td class="p-4 text-center">

                                    <form id="delete-form-{{ $newsletter->id }}"
                                        action="{{ route('newsletters.destroy', $newsletter) }}" method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="button" onclick="deleteNewsletter({{ $newsletter->id }})" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl
                                                            bg-red-600 hover:bg-red-700 text-white transition">

                                            <i class="fa-solid fa-trash"></i>



                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="text-center py-10">

                                    Aucun abonné trouvé.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>
                <script>

                    function deleteNewsletter(id) {

                        Swal.fire({

                            title: 'Supprimer cet abonné ?',

                            text: 'Cette action est irréversible.',

                            icon: 'warning',

                            showCancelButton: true,

                            confirmButtonColor: '#dc2626',

                            cancelButtonColor: '#64748b',

                            confirmButtonText: 'Oui, supprimer',

                            cancelButtonText: 'Annuler'

                        }).then((result) => {

                            if (result.isConfirmed) {

                                document.getElementById('delete-form-' + id).submit();

                            }

                        });

                    }

                </script>
                <script>

                    new DataTable('#newsletterTable', {

                        responsive: true,

                        pageLength: 10,

                        lengthMenu: [
                            [10, 25, 50, 100, -1],
                            [10, 25, 50, 100, "Tout"]
                        ],

                        language: {

                            url: 'https://cdn.datatables.net/plug-ins/2.3.2/i18n/fr-FR.json'

                        },

                        layout: {

                            topStart: {

                                buttons: [

                                    'copy',

                                    'csv',

                                    'excel',

                                    'pdf',

                                    'print'

                                ]

                            }

                        }

                    });

                </script>

            </div>



        </div>

    </div>

</x-app-layout>
<script>

new Chart(document.getElementById('dailyChart'),{

type:'line',

data:{
labels:@json($dailyLabels),
datasets:[{

label:'Abonnés',

data:@json($dailyData),

borderWidth:3,

fill:true,

tension:.35

}]
}

});

new Chart(document.getElementById('monthlyChart'),{

type:'bar',

data:{

labels:@json($monthlyLabels),

datasets:[{

label:'Abonnés',

data:@json($monthlyData)

}]
}

});

new Chart(document.getElementById('hourlyChart'),{

type:'doughnut',

data:{

labels:@json($hourlyLabels),

datasets:[{

data:@json($hourlyData)

}]
}

});

</script>