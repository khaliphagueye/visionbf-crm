<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'adresse',
        'numero',
        'bte',
        'cp',
        'ville',
    ];

    /**
     * Relation : Une adresse appartient à un Lead.
     */
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}