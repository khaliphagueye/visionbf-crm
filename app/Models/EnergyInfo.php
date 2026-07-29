<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnergyInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'mensualite_annoncee',
        'consommation_type',
        'type_contrat',
        'conso_elec_jour',
        'conso_elec_nuit',
        'conso_gaz',
        'panneaux_solaires',
    ];

    /**
     * Relation : Les infos énergétiques appartiennent à un Lead.
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}