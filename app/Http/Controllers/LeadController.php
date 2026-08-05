<?php


namespace App\Http\Controllers;


use App\Exports\LeadsExport;

use App\Imports\LeadsImport;

use App\Models\Lead;

use App\Models\LeadLanterneau;

use App\Models\User;

use App\Notifications\NewLeadCreatedNotification;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Notification;
use Maatwebsite\Excel\Facades\Excel;


class LeadController extends Controller
{

    use AuthorizesRequests;




    /**

     * Afficher la liste des fiches filtrée par rôle et critères.

     */

    public function index(Request $request)
    {

        $user = Auth::user();


        // Utilisation du scope 'forUser' du modèle Lead

        $query = Lead::forUser($user)->with(['user', 'team', 'lanterneau'])->latest();


        // Filtre Recherche texte

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('raison_sociale', 'like', "%{$search}%")

                    ->orWhere('telephone', 'like', "%{$search}%")

                    ->orWhere('siret', 'like', "%{$search}%")

                    ->orWhere('ville', 'like', "%{$search}%");

            });

        }


        // Filtre Statut

        if ($request->filled('statut')) {

            $query->where('statut', $request->statut);

        }


        // Filtre Période

        if ($request->filled('date_from')) {

            $query->whereDate('created_at', '>=', $request->date_from);

        }


        if ($request->filled('date_to')) {

            $query->whereDate('created_at', '<=', $request->date_to);

        }


        // Filtre par Agent (réservé aux supérieurs)

        if ($request->filled('user_id') && in_array($user->role, ['admin', 'secretary', 'supervisor'])) {

            $query->where('user_id', $request->user_id);

        }


        $leads = $query->paginate(15)->withQueryString();


        // Récupération dynamique des agents pour le filtre

        $agents = match ($user->role) {

            'admin', 'secretary' => User::where('role', 'agent')->get(),

            'supervisor' => User::where('team_id', $user->team_id)->where('role', 'agent')->get(),

            default => collect(),

        };


        return view('leads.index', compact('leads', 'agents'));

    }


    /**

     * Formulaire de création.

     */

    public function create()
    {

        $user = auth()->user();


        // Pour l'Admin et la Secrétaire : toutes les équipes et tous les agents

        if (in_array(strtolower($user->role), ['admin', 'secretaire'])) {

            $teams = \App\Models\Team::all();

            // On récupère tous les agents/superviseurs organisés par équipe ou globalement

            $agents = \App\Models\User::whereIn('role', ['agent', 'superviseur', 'Agent', 'Superviseur'])

                ->get(['id', 'name', 'team_id']);

        }

        // Pour le Superviseur : uniquement son équipe et ses agents
        elseif (in_array(strtolower($user->role), ['superviseur'])) {

            $teams = \App\Models\Team::where('id', $user->team_id)->get();

            $agents = \App\Models\User::where('team_id', $user->team_id)

                ->whereIn('role', ['agent', 'Agent', 'superviseur', 'Superviseur'])

                ->get(['id', 'name', 'team_id']);

        } else {

            $teams = collect();

            $agents = collect();

        }


        return view('leads.create', compact('teams', 'agents'));

    }


    /**

     * Enregistrement d'une nouvelle fiche Lanterneau.

     */

    public function store(Request $request)
    {

        $validated = $request->validate([

            'raison_sociale' => 'required|string|max:191|unique:leads,raison_sociale',

            'telephone' => 'nullable|string|max:191',

            'siret' => 'nullable|string|max:191',

            'gerant' => 'nullable|string|max:191',

            'email' => 'nullable|email|max:191',

            'adresse' => 'nullable|string|max:191',

            'code_postal' => 'nullable|string|max:191',

            'ville' => 'nullable|string|max:191',

            'statut' => 'required|string|in:' . implode(',', config('crm.statuts')),

            'agent_comment' => 'nullable|string',

            'confirmation_comment' => 'nullable|string',

            'superficie_lanterneau' => 'nullable|string|max:191',

        ]);
        $user = auth()->user();

        // Règle métier : Forcer le statut à 'Nouveau' pour Agent et Superviseur
        if (in_array($user->role, ['agent', 'supervisor'])) {
            $statut = 'Nouveau';
        } else {
            // Pour la secrétaire ou l'admin, on prend la valeur sélectionnée dans le formulaire
            $statut = $request->input('statut', 'Nouveau');
        }

        // 1. Création de la fiche principale

        $lead = Lead::create([

            'user_id' => Auth::id(),

            'team_id' => Auth::user()->team_id,

            'product_type' => 'lanterneau',

            'statut' => $statut,

            'raison_sociale' => $validated['raison_sociale'],

            'siret' => $validated['siret'] ?? null,

            'gerant' => $validated['gerant'] ?? null,

            'telephone' => $validated['telephone'] ?? null,

            'email' => $validated['email'] ?? null,

            'adresse' => $validated['adresse'] ?? null,

            'code_postal' => $validated['code_postal'] ?? null,

            'ville' => $validated['ville'] ?? null,

            'agent_comment' => $validated['agent_comment'] ?? null,

            'confirmation_comment' => $validated['confirmation_comment'] ?? null,

        ]);


        // 2. Données spécifiques Lanterneaux

        if (!empty($validated['superficie_lanterneau'])) {

            LeadLanterneau::create([

                'lead_id' => $lead->id,

                'superficie_lanterneau' => $validated['superficie_lanterneau'],

            ]);

        }

        $recipients = User::whereIn('role', ['admin', 'secretary'])->get();

        // Envoyer la notification
        Notification::send($recipients, new NewLeadCreatedNotification($lead));
        return redirect()->route('leads.index')->with('success', 'Fiche Lanterneau enregistrée avec succès !');

    }


    /**

     * Afficher le détail d'une fiche.

     */

    public function show(Lead $lead)
    {

        $lead->load(['user', 'team', 'lanterneau']);


        return view('leads.show', compact('lead'));

    }


    /**

     * Formulaire d'édition.

     */

    public function edit(Lead $lead)
    {

        // 1. Charger la liste des agents (utilisateurs avec le rôle 'agent')

        $agents = User::where('role', 'agent')->get();


        // Si la liste doit inclure tous les utilisateurs pouvant posséder un lead (ex: agents + superviseurs) :

        // $agents = User::all();


        // 2. Charger les relations spécifiques au produit si besoin

        $lead->load('lanterneau'); // Ajuster selon le type de produit


        // 3. Transmettre $agents à la vue

        return view('leads.edit', compact('lead', 'agents'));

    }

    /**

     * Mise à jour de la fiche.

     */

    public function update(Request $request, Lead $lead)
    {

        $this->authorize('update', $lead);

        $validated = $request->validate([

            'raison_sociale' => 'required|string|max:191|unique:leads,raison_sociale,' . $lead->id,

            'telephone' => 'nullable|string|max:191',

            'siret' => 'nullable|string|max:191',

            'gerant' => 'nullable|string|max:191',

            'email' => 'nullable|email|max:191',

            'adresse' => 'nullable|string|max:191',

            'code_postal' => 'nullable|string|max:191',

            'ville' => 'nullable|string|max:191',

            'statut' => 'required|string|in:' . implode(',', config('crm.statuts')),

            'agent_comment' => 'nullable|string',

            'confirmation_comment' => 'nullable|string',

            'superficie_lanterneau' => 'nullable|string|max:191',

        ]);


        $lead->update([

            'statut' => $validated['statut'],

            'raison_sociale' => $validated['raison_sociale'],

            'siret' => $validated['siret'] ?? null,

            'gerant' => $validated['gerant'] ?? null,

            'telephone' => $validated['telephone'] ?? null,

            'email' => $validated['email'] ?? null,

            'adresse' => $validated['adresse'] ?? null,

            'code_postal' => $validated['code_postal'] ?? null,

            'ville' => $validated['ville'] ?? null,

            'agent_comment' => $validated['agent_comment'] ?? null,

            'confirmation_comment' => $validated['confirmation_comment'] ?? null,

        ]);


        if ($lead->lanterneau) {

            $lead->lanterneau->update([

                'superficie_lanterneau' => $validated['superficie_lanterneau'] ?? null,

            ]);

        }


        return redirect()->route('leads.index')->with('success', 'Fiche mise à jour avec succès !');

    }


    /**

     * Suppression d'une fiche (Admin & Secrétaire uniquement).

     */

    public function destroy(Lead $lead)
    {

        $lead->delete();


        return redirect()->route('leads.index')->with('success', 'Fiche supprimée avec succès !');

    }


    /**

     * Export Excel.

     */

    /**

     * Exporter les leads en fichier Excel

     */

public function export(Request $request)
{
    $userRole = strtolower(auth()->user()->role ?? '');

    if (! in_array($userRole, ['admin', 'secretaire'])) {
        abort(403, 'Accès non autorisé.');
    }

    return Excel::download(
        new LeadsExport($request),
        'leads_' . now()->format('Y-m-d') . '.xlsx'
    );
}

    /**

     * Importer des leads depuis un fichier Excel

     */

    public function import(Request $request)
    {

        $userRole = strtolower(auth()->user()->role ?? '');


        // Vérification du rôle

        if (!in_array($userRole, ['admin', 'secretaire'])) {

            abort(403, 'Accès non autorisé : Seuls les administrateurs et secrétaires peuvent importer.');

        }


        $request->validate([

            'file' => 'required|mimes:xlsx,xls,csv|max:2048',

        ]);


        Excel::import(new LeadsImport, $request->file('file'));


        return back()->with('success', 'Importation des fiches réussie !');

    }

}