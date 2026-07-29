<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Lead extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'user_id',
        'team_id',
        'product_type',
        'statut',
        'raison_sociale',
        'siret',
        'gerant',
        'telephone',
        'email',
        'adresse',
        'code_postal',
        'ville',
        'agent_comment',
        'confirmation_comment',
    ];
    public function scopeForUser(Builder $query, User $user): Builder
    {
        // Admin et Secrétaire voient tout
        if (in_array($user->role, ['admin', 'secretary'])) {
            return $query;
        }

        // Superviseur voit toutes les fiches de son équipe
        if ($user->role === 'supervisor') {
            return $query->where('team_id', $user->team_id);
        }

        // Agent voit uniquement ses propres fiches
        return $query->where('user_id', $user->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function lanterneau()
    {
        return $this->hasOne(LeadLanterneau::class);
    }
    // Dans app/Models/Lead.php

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function engiProducts()
    {
        return $this->hasMany(EngiProduct::class);
    }

    public function energyInfo()
    {
        return $this->hasOne(EnergyInfo::class);
    }
}