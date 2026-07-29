<?php

namespace App\Exports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadsExport implements FromQuery, WithHeadings, WithMapping
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function query()
    {
        $user = Auth::user();
        $query = Lead::with(['user', 'team', 'lanterneau'])->latest();

        // Respect des droits (RBAC)
        if ($user->role === 'agent') {
            $query->where('user_id', $user->id);
        } elseif ($user->role === 'supervisor') {
            $query->where('team_id', $user->team_id);
        }

        // Application des filtres actifs lors de l'export
        if ($this->request->filled('search')) {
            $search = $this->request->search;
            $query->where(function($q) use ($search) {
                $q->where('raison_sociale', 'like', "%{$search}%")
                  ->orWhere('telephone', 'like', "%{$search}%")
                  ->orWhere('siret', 'like', "%{$search}%");
            });
        }

        if ($this->request->filled('statut')) {
            $query->where('statut', $this->request->statut);
        }

        if ($this->request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $this->request->date_from);
        }

        if ($this->request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $this->request->date_to);
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Date de Création',
            'Raison Sociale',
            'SIRET',
            'Gérant',
            'Téléphone',
            'Email',
            'Adresse',
            'Code Postal',
            'Ville',
            'Superficie Lanterneau (m²)',
            'Statut',
            'Agent',
            'Équipe',
            'Commentaire Agent',
            'Commentaire Confirmation',
        ];
    }

    public function map($lead): array
    {
        return [
            $lead->id,
            $lead->created_at->format('d/m/Y H:i'),
            $lead->raison_sociale,
            $lead->siret,
            $lead->gerant,
            $lead->telephone,
            $lead->email,
            $lead->adresse,
            $lead->code_postal,
            $lead->ville,
            $lead->lanterneau->superficie_lanterneau ?? 'N/A',
            $lead->statut,
            $lead->user->name ?? 'N/A',
            $lead->team->name ?? 'N/A',
            $lead->agent_comment,
            $lead->confirmation_comment,
        ];
    }
}
