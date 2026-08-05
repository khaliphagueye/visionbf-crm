<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Affiche la liste des utilisateurs avec filtrage et pagination.
     */
    public function index(Request $request)
    {
        // 1. Récupération des données pour les selects des filtres
        $teams = Team::all();
        $agents = User::where('role', 'agent')->get();

        // 2. Liste des statuts gérés dans votre application
        $statuts = [
            'À Rappeler',
            'NRP',
            'À Retraiter',
            'Confirmer Régie',
            'Confirmé',
            'VT Programmée',
            'VT Réalisée',
            'Chantier Programmé',
            'Nettoyage',
            'Installer 100%',
            'Remplacement',
            'Chantier Annulé',
            'Annulé Tôle',
            'SAV',
            'SAV Réalisé'
        ];

        // 3. Construction de la requête de base pour les fiches (Leads) avec filtres
        $leadsQuery = Lead::query(); // Remplacez 'Lead' par le nom exact de votre modèle (ex: Fiche)

        // Filtre par équipe
        if ($request->filled('team_id')) {
            $leadsQuery->where('team_id', $request->team_id);
        }

        // Filtre par agent
        if ($request->filled('agent_id')) {
            $leadsQuery->where('user_id', $request->agent_id);
        }

        // Filtre par statut
        if ($request->filled('statut')) {
            $leadsQuery->where('statut', $request->statut);
        }

        // Filtre par période / date
        if ($request->filled('period')) {
            switch ($request->period) {
                case 'today':
                    $leadsQuery->whereDate('created_at', Carbon::today());
                    break;
                case 'week':
                    $leadsQuery->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    break;
                case 'month':
                    $leadsQuery->whereMonth('created_at', Carbon::now()->month)
                        ->whereYear('created_at', Carbon::now()->year);
                    break;
                case 'custom':
                    if ($request->filled('date_from')) {
                        $leadsQuery->whereDate('created_at', '>=', $request->date_from);
                    }
                    if ($request->filled('date_to')) {
                        $leadsQuery->whereDate('created_at', '<=', $request->date_to);
                    }
                    break;
            }
        }

        // 4. Calcul dynamique des statistiques (Stats KPI)
        $stats = [
            'total' => (clone $leadsQuery)->count(),
            'a_rappeler' => (clone $leadsQuery)->where('statut', 'À Rappeler')->count(),
            'nrp' => (clone $leadsQuery)->where('statut', 'NRP')->count(),
            'a_retraiter' => (clone $leadsQuery)->where('statut', 'À Retraiter')->count(),
            'confirmer_regie' => (clone $leadsQuery)->where('statut', 'Confirmer Régie')->count(),
            'confirmer' => (clone $leadsQuery)->where('statut', 'Confirmé')->count(),
            'vt_progammee' => (clone $leadsQuery)->where('statut', 'VT Programmée')->count(),
            'vt_realisee' => (clone $leadsQuery)->where('statut', 'VT Réalisée')->count(),
            'chantier_programme' => (clone $leadsQuery)->where('statut', 'Chantier Programmé')->count(),
            'chantier_termine_nettoyage' => (clone $leadsQuery)->where('statut', 'Nettoyage')->count(),
            'installer_100' => (clone $leadsQuery)->where('statut', 'Installer 100%')->count(),
            'chantier_termine_remplacement' => (clone $leadsQuery)->where('statut', 'Remplacement')->count(),
            'chantier_annule' => (clone $leadsQuery)->where('statut', 'Chantier Annulé')->count(),
            'annule_tole' => (clone $leadsQuery)->where('statut', 'Annulé Tôle')->count(),
            'sav' => (clone $leadsQuery)->where('statut', 'SAV')->count(),
            'sav_realise' => (clone $leadsQuery)->where('statut', 'SAV Réalisé')->count(),
        ];

        // 5. Récupération des prochains rappels à effectuer
        $upcomingRappels = (clone $leadsQuery)
            ->where('statut', 'À Rappeler')
            ->whereNotNull('rappel_at')
            ->orderBy('rappel_at', 'asc')
            ->limit(10)
            ->get();

        // 6. Gestion du listing des utilisateurs (avec recherche et filtres de rôle/statut)
        $users = User::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->when($request->role, function ($query, $role) {
                $query->where('role', $role);
            })
            ->when($request->status, function ($query, $status) {
                $query->where('is_active', $status === 'active');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // 7. Retour de la vue avec toutes les données requises
        return view('users.index', compact(
            'users',
            'teams',
            'agents',
            'statuts',
            'stats',
            'upcomingRappels'
        ));
    }

    /**
     * Affiche le formulaire de création.
     */
    public function create()
    {
        // 2. Récupérer toutes les équipes depuis la base de données
        $teams = Team::all(); // ou Team::orderBy('name')->get();
        return view('users.create', compact('teams'));
    }

    /**
     * Enregistre un nouvel utilisateur.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:admin,secretary,supervisor,agent',
            'team_id' => 'nullable|exists:teams,id',
        ]);

        // équipe obligatoire pour agent/superviseur
        if (in_array($validated['role'], ['agent', 'supervisor']) && empty($validated['team_id'])) {

            return back()
                ->withErrors([
                    'team_id' => 'Veuillez sélectionner une équipe.'
                ])
                ->withInput();
        }

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'team_id' => $validated['team_id'],
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Affiche le formulaire d'édition.
     */
    public function edit(User $user)
    {
        $teams = Team::orderBy('name')->get();
        return view('users.edit', compact('user', 'teams'));
    }

    /**
     * Met à jour les informations d'un utilisateur.
     */
public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'name'      => 'required|string|max:255',
        'email'     => 'required|email|unique:users,email,' . $user->id,
        'role'      => 'required|in:admin,secretary,supervisor,agent',
        'team_id'   => 'nullable|exists:teams,id',
        'is_active' => 'nullable|boolean',
    ]);

    // Pas d'équipe pour admin/secrétaire
    if (in_array($validated['role'], ['admin', 'secretary'])) {
        $validated['team_id'] = null;
    }

    // Équipe obligatoire pour agent/superviseur
    if (in_array($validated['role'], ['agent', 'supervisor']) && empty($validated['team_id'])) {
        return back()
            ->withErrors([
                'team_id' => 'Veuillez sélectionner une équipe.'
            ])
            ->withInput();
    }

    $user->update([
        'name'      => $validated['name'],
        'email'     => $validated['email'],
        'role'      => $validated['role'],
        'team_id'   => $validated['team_id'],
        'is_active' => $request->boolean('is_active'),
    ]);

    return redirect()
        ->route('users.index')
        ->with('success', 'Utilisateur mis à jour avec succès.');
}

    /**
     * Supprime un utilisateur.
     */
    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé.');
    }

    /**
     * Active/Désactive un compte utilisateur.
     */
    public function toggleStatus(User $user)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Action non autorisée.');
        }

        if (auth()->id() === $user->id) {
            return back()->with('error', 'Vous ne pouvez pas modifier votre propre statut.');
        }

        $newState = !$user->is_active;
        $user->update(['is_active' => $newState]);

        $status = $newState ? 'activé' : 'désactivé';
        return back()->with('success', "Le compte de {$user->name} a été {$status} avec succès.");
    }
}