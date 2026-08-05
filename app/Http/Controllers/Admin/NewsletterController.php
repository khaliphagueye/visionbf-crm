<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $query = Newsletter::query();

        // Recherche
        if ($request->filled('search')) {
            $query->where('email', 'like', '%' . $request->search . '%');
        }

        // Filtre par date
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // Liste des abonnés
        $newsletters = $query
            ->latest()
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Dates
        |--------------------------------------------------------------------------
        */

        $today = Carbon::today();

        $yesterday = Carbon::yesterday();

        $startWeek = Carbon::now()->startOfWeek();

        $endWeek = Carbon::now()->endOfWeek();

        $startMonth = Carbon::now()->startOfMonth();

        $endMonth = Carbon::now()->endOfMonth();

        $lastMonth = Carbon::now()->subMonth();

        $startYear = Carbon::now()->startOfYear();

        $endYear = Carbon::now()->endOfYear();

        /*
        |--------------------------------------------------------------------------
        | Statistiques
        |--------------------------------------------------------------------------
        */

        $stats = [

            // Total
            'total' => Newsletter::count(),

            // Aujourd'hui
            'today' => Newsletter::whereDate('created_at', $today)->count(),

            // Hier
            'yesterday' => Newsletter::whereDate('created_at', $yesterday)->count(),

            // Cette semaine
            'week' => Newsletter::whereBetween(
                'created_at',
                [$startWeek, $endWeek]
            )->count(),

            // Ce mois
            'month' => Newsletter::whereBetween(
                'created_at',
                [$startMonth, $endMonth]
            )->count(),

            // Mois précédent
            'lastMonth' => Newsletter::whereYear(
                'created_at',
                $lastMonth->year
            )
                ->whereMonth(
                    'created_at',
                    $lastMonth->month
                )
                ->count(),

            // Cette année
            'year' => Newsletter::whereBetween(
                'created_at',
                [$startYear, $endYear]
            )->count(),

            // Dernières 24h
            'last24Hours' => Newsletter::where(
                'created_at',
                '>=',
                now()->subDay()
            )->count(),

            // Derniers 7 jours
            'last7Days' => Newsletter::where(
                'created_at',
                '>=',
                now()->subDays(7)
            )->count(),

            // Derniers 30 jours
            'last30Days' => Newsletter::where(
                'created_at',
                '>=',
                now()->subDays(30)
            )->count(),

            // Derniers 90 jours
            'last90Days' => Newsletter::where(
                'created_at',
                '>=',
                now()->subDays(90)
            )->count(),

            // Ce trimestre
            'quarter' => Newsletter::whereBetween(
                'created_at',
                [
                    now()->startOfQuarter(),
                    now()->endOfQuarter()
                ]
            )->count(),

            // Dernier trimestre
            'lastQuarter' => Newsletter::whereBetween(
                'created_at',
                [
                    now()->subQuarter()->startOfQuarter(),
                    now()->subQuarter()->endOfQuarter()
                ]
            )->count(),

            // Dernière inscription
            'lastSubscriber' => Newsletter::latest()->first(),

            // Première inscription
            'firstSubscriber' => Newsletter::oldest()->first(),
        ];

        /*
        |--------------------------------------------------------------------------
        | Evolution par jour (30 derniers jours)
        |--------------------------------------------------------------------------
        */

        $dailySubscriptions = Newsletter::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Evolution par mois
        |--------------------------------------------------------------------------
        */

        $monthlySubscriptions = Newsletter::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as total')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Inscriptions par heure (aujourd'hui)
        |--------------------------------------------------------------------------
        */

        $hourlySubscriptions = Newsletter::selectRaw('HOUR(created_at) as hour, COUNT(*) as total')
            ->whereDate('created_at', today())
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();
        $dailyLabels = $dailySubscriptions->pluck('date');
        $dailyData = $dailySubscriptions->pluck('total');

        $monthlyLabels = $monthlySubscriptions->map(function ($item) {
            return $item->month . '/' . $item->year;
        });

        $monthlyData = $monthlySubscriptions->pluck('total');

        $hourlyLabels = $hourlySubscriptions->pluck('hour');
        $hourlyData = $hourlySubscriptions->pluck('total');
        return view('newsletters.index', array_merge(
            [
                'newsletters' => $newsletters,
                'dailySubscriptions' => $dailySubscriptions,
                'monthlySubscriptions' => $monthlySubscriptions,
                'hourlySubscriptions' => $hourlySubscriptions,
                'dailyLabels' => $dailyLabels,
                'dailyData' => $dailyData,
                'monthlyLabels' => $monthlyLabels,
                'monthlyData' => $monthlyData,
                'hourlyLabels' => $hourlyLabels,
                'hourlyData' => $hourlyData,
            ],
            $stats
        ));
    }
    

public function destroy(Newsletter $newsletter): RedirectResponse
{
    try {

        $email = $newsletter->email;

        $newsletter->delete();

        return redirect()
            ->route('newsletters.index')
            ->with('success', "L'abonné {$email} a été supprimé avec succès.");

    } catch (\Exception $e) {

        return redirect()
            ->route('newsletters.index')
            ->with('error', "Une erreur est survenue lors de la suppression.");
    }
}
    

}