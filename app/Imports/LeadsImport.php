<?php

namespace App\Imports;

use App\Models\Lead;
use App\Models\Lanterneau;
use App\Models\LeadLanterneau;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LeadsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // 1. Création de la fiche principale (Lead)
        $lead = Lead::create([
            'user_id'           => Auth::id(),
            'team_id'           => Auth::user()->team_id,
            'raison_sociale'    => $row['raison_sociale'] ?? 'Non spécifié',
            'telephone'         => $row['telephone'] ?? null,
            'siret'             => $row['siret'] ?? null,
            'gerant'            => $row['gerant'] ?? null,
            'email'             => $row['email'] ?? null,
            'adresse'           => $row['adresse'] ?? null,
            'code_postal'       => $row['code_postal'] ?? null,
            'ville'             => $row['ville'] ?? null,
            'statut'            => $row['statut'] ?? 'Nouveau',
            'commentaire_agent' => $row['commentaire_agent'] ?? null,
        ]);

        // 2. Création de la sous-fiche associée (ex: Lanterneau)
        if (isset($row['superficie_lanterneau'])) {
            LeadLanterneau::create([
                'lead_id'               => $lead->id,
                'superficie_lanterneau' => $row['superficie_lanterneau'],
            ]);
        }

        return $lead;
    }
}