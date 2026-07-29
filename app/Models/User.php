<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'team_id', 'is_active'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Relation avec l'équipe à laquelle appartient l'utilisateur.
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Relation avec les fiches (leads) créées par cet utilisateur.
     */
    public function leads()
    {
        return $this->hasMany(Lead::class);
    }
    public function isAdmin(): bool
    {
        return $this->role === 'admin'; // Adaptez 'admin' selon la valeur dans votre BDD (ex: 'Admin', 'administrator', etc.)
    }

    /**
     * Vérifie si l'utilisateur est Superviseur
     */
    public function isSuperviseur(): bool
    {
        return $this->role === 'superviseur';
    }

    /**
     * Vérifie si l'utilisateur est Secrétaire
     */
    public function isSecretaire(): bool
    {
        return $this->role === 'secretaire';
    }

    /**
     * Vérifie si l'utilisateur est Agent
     */
    public function isAgent(): bool
    {
        return $this->role === 'agent';
    }
}