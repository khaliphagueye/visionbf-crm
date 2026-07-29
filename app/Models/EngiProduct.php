<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EngiProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'type',
        'nom_produit',
        'numero_ean',
        'ancien_fournisseur',
    ];

    /**
     * Relation : Un produit appartient à un Lead.
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}