<?php

namespace App\Policies;

use App\Models\Lead;
use App\Models\User;

class LeadPolicy
{
    /**
     * Détermine si l'utilisateur peut voir la liste des fiches.
     */
    public function viewAny(User $user): bool
    {
        return true; // Tout utilisateur connecté a accès à la liste (filtrée par le Scope)
    }

    /**
     * Détermine si l'utilisateur peut voir une fiche précise.
     */
    public function view(User $user, Lead $lead): bool
    {
        if (in_array($user->role, ['admin', 'secretary'])) {
            return true;
        }

        if ($user->role === 'supervisor') {
            return $lead->team_id === $user->team_id;
        }

        return $lead->user_id === $user->id;
    }

    /**
     * Détermine si l'utilisateur peut créer une fiche.
     */
    public function create(User $user): bool
    {
        return true; // Tous les rôles peuvent créer des fiches
    }

    /**
     * Détermine si l'utilisateur peut modifier la fiche.
     */
    public function update(User $user, Lead $lead): bool
    {
        // 1. Les Admins et Secrétaires peuvent tout modifier
        if (in_array($user->role, ['admin', 'secretaire'])) {
            return true;
        }

        // 2. Les Superviseurs peuvent modifier seulement les fiches de leur équipe
        if ($user->role === 'superviseur') {
            return $user->team_id === $lead->user->team_id;
        }

        // 3. Les Agents ne peuvent PAS modifier les fiches (ou seulement sous condition si désiré)
        return false;
    }

    /**
     * Seuls l'Admin et la Secrétaire peuvent supprimer des fiches.
     */
    public function delete(User $user, Lead $lead): bool
    {
        return in_array($user->role, ['admin', 'secretary']);
    }
}