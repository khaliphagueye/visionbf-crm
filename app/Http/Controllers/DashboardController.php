<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        // Listes pour les sélecteurs de filtres
        $teams = Team::all();
        $agents = User::where('role', 'agent')->get();

        // Liste exhaustive des 15 statuts
        $statuts = [
            'A Rappeler',
            'Nrp',
            'A retraiter',
            'Confirmer régie',
            'Confirmer',
            'VT programmée',
            'VT réalisée',
            'Chantier programmé',
            'Chantier terminé nettoyage',
            'Installer 100%',
            'Chantier terminé remplacement',
            'Chantier annulé',
            'Annulé tole',
            'SAV',
            'SAV réalisé'
        ];

        // Requête de base
        $query = Lead::query();

        // --- RESTRICTION PAR RÔLE ---
        if ($user->role === 'agent') {
            $query->where('user_id', $user->id);
        } elseif ($user->role === 'superviseur') {
            $query->whereHas('user', function ($q) use ($user) {
                $q->where('team_id', $user->team_id);
            });
        }

        // --- FILTRES (Admin, Secrétaire, Superviseur & Agent) ---
        if ($request->filled('team_id')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('team_id', $request->team_id);
            });
        }

        if ($request->filled('agent_id')) {
            $query->where('user_id', $request->agent_id);
        }

        // NOVEAU: Filtre par statut
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        // Filtre par période
        if ($request->filled('period')) {
            switch ($request->period) {
                case 'today':
                    $query->whereDate('created_at', Carbon::today());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', Carbon::now()->month)
                        ->whereYear('created_at', Carbon::now()->year);
                    break;
                case 'custom':
                    if ($request->filled('date_from')) {
                        $query->whereDate('created_at', '>=', $request->date_from);
                    }
                    if ($request->filled('date_to')) {
                        $query->whereDate('created_at', '<=', $request->date_to);
                    }
                    break;
            }
        }

        // --- CALCUL DES STATISTIQUES ---
        $stats = [
            'total' => (clone $query)->count(),
            'a_rappeler' => (clone $query)->where('statut', 'A Rappeler')->count(),
            'nrp' => (clone $query)->where('statut', 'Nrp')->count(),
            'a_retraiter' => (clone $query)->where('statut', 'A retraiter')->count(),
            'confirmer_regie' => (clone $query)->where('statut', 'Confirmer régie')->count(),
            'confirmer' => (clone $query)->where('statut', 'Confirmer')->count(),
            'vt_progammee' => (clone $query)->where('statut', 'VT programmée')->count(),
            'vt_realisee' => (clone $query)->where('statut', 'VT réalisée')->count(),
            'chantier_programme' => (clone $query)->where('statut', 'Chantier programmé')->count(),
            'chantier_termine_nettoyage' => (clone $query)->where('statut', 'Chantier terminé nettoyage')->count(),
            'installer_100' => (clone $query)->where('statut', 'Installer 100%')->count(),
            'chantier_termine_remplacement' => (clone $query)->where('statut', 'Chantier terminé remplacement')->count(),
            'chantier_annule' => (clone $query)->where('statut', 'Chantier annulé')->count(),
            'annule_tole' => (clone $query)->where('statut', 'Annulé tole')->count(),
            'sav' => (clone $query)->where('statut', 'SAV')->count(),
            'sav_realise' => (clone $query)->where('statut', 'SAV réalisé')->count(),
        ];

        // Prochains rappels (filtrés également selon la requête courante)
        $upcomingRappels = (clone $query)
            ->whereNotNull('rappel_at')
            ->where('rappel_at', '>=', now())
            ->orderBy('rappel_at', 'asc')
            ->take(5)
            ->get();
        // =======================
// EVOLUTION DES LEADS
// =======================

        $chartLabels = [];
        $chartData = [];

        switch ($request->period) {

            case 'today':

                // Par heure
                for ($i = 0; $i < 24; $i++) {

                    $chartLabels[] = sprintf('%02dh', $i);

                    $chartData[] = (clone $query)
                        ->whereDate('created_at', today())
                        ->whereHour('created_at', $i)
                        ->count();
                }

                break;

            case 'week':

                // Lundi -> Dimanche
                $start = now()->startOfWeek();

                for ($i = 0; $i < 7; $i++) {

                    $date = $start->copy()->addDays($i);

                    $chartLabels[] = $date->translatedFormat('D');

                    $chartData[] = (clone $query)
                        ->whereDate('created_at', $date)
                        ->count();
                }

                break;

            case 'year':

                // Janvier -> Décembre
                for ($i = 1; $i <= 12; $i++) {

                    $chartLabels[] = Carbon::create()->month($i)->translatedFormat('M');

                    $chartData[] = (clone $query)
                        ->whereYear('created_at', now()->year)
                        ->whereMonth('created_at', $i)
                        ->count();
                }

                break;

            default:

                // Mois courant -> par jour
                $days = now()->daysInMonth;

                for ($i = 1; $i <= $days; $i++) {

                    $chartLabels[] = $i;

                    $chartData[] = (clone $query)
                        ->whereYear('created_at', now()->year)
                        ->whereMonth('created_at', now()->month)
                        ->whereDay('created_at', $i)
                        ->count();
                }

                break;
        }
        // =======================
// TOP 3 AGENTS
// =======================

        $agentsQuery = User::query()
            ->where('role', 'agent')
            ->with('team');

        // Restriction si superviseur
        if ($user->role === 'supervisor') {
            $agentsQuery->where('team_id', $user->team_id);
        }

        // Filtre équipe
        if ($request->filled('team_id')) {
            $agentsQuery->where('team_id', $request->team_id);
        }

        $topAgents = $agentsQuery
            ->withCount([
                'leads as total_leads' => function ($q) use ($request) {

                    if ($request->filled('period')) {

                        switch ($request->period) {

                            case 'today':
                                $q->whereDate('created_at', today());
                                break;

                            case 'week':
                                $q->whereBetween('created_at', [
                                    now()->startOfWeek(),
                                    now()->endOfWeek()
                                ]);
                                break;

                            case 'month':
                                $q->whereMonth('created_at', now()->month)
                                    ->whereYear('created_at', now()->year);
                                break;

                            case 'year':
                                $q->whereYear('created_at', now()->year);
                                break;

                            case 'custom':

                                if ($request->filled('date_from')) {
                                    $q->whereDate('created_at', '>=', $request->date_from);
                                }

                                if ($request->filled('date_to')) {
                                    $q->whereDate('created_at', '<=', $request->date_to);
                                }

                                break;
                        }

                    }

                },

                'leads as confirmed_leads' => function ($q) use ($request) {

                    $q->where('statut', 'chantier terminé nettoyage')
                        ->orWhere('statut', 'installer 100%')
                        ->orWhere('statut', 'chantier terminé remplacement')
                        ->orWhere('statut', 'SAV réalisé');

                    if ($request->filled('period')) {

                        switch ($request->period) {

                            case 'today':
                                $q->whereDate('created_at', today());
                                break;

                            case 'week':
                                $q->whereBetween('created_at', [
                                    now()->startOfWeek(),
                                    now()->endOfWeek()
                                ]);
                                break;

                            case 'month':
                                $q->whereMonth('created_at', now()->month)
                                    ->whereYear('created_at', now()->year);
                                break;

                            case 'year':
                                $q->whereYear('created_at', now()->year);
                                break;

                            case 'custom':

                                if ($request->filled('date_from')) {
                                    $q->whereDate('created_at', '>=', $request->date_from);
                                }

                                if ($request->filled('date_to')) {
                                    $q->whereDate('created_at', '<=', $request->date_to);
                                }

                                break;
                        }

                    }

                }
            ])
            ->get()
            ->map(function ($agent) {

                $agent->conversion = $agent->total_leads > 0
                    ? round(($agent->confirmed_leads / $agent->total_leads) * 100, 1)
                    : 0;

                // Score CRM
                $agent->score =
                    ($agent->total_leads * 1) +
                    ($agent->confirmed_leads * 15);

                return $agent;

            })
            ->sortByDesc('score')
            ->values();

        $podium = $topAgents->take(3);

        return view('dashboard', compact('stats', 'upcomingRappels', 'teams', 'agents', 'statuts', 'chartLabels', 'chartData', 'topAgents', 'podium'));
    }
}