<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadLanterneau extends Model
{
    use HasFactory;

    protected $table = 'lead_lanterneaux';

    protected $fillable = [
        'lead_id',
        'superficie_lanterneau',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}