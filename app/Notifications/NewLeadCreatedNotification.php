<?php

namespace App\Notifications;

use App\Models\Lead;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewLeadCreatedNotification extends Notification
{
    use Queueable;

    public $lead;

    public function __construct(Lead $lead)
    {
        $this->lead = $lead;
    }

    // Définir les canaux : 'database' (pour l'interface) et/ou 'mail'
    public function via($notifiable)
    {
        return ['database']; // Vous pouvez ajouter 'mail' si vous voulez aussi des emails
    }

    // Données stockées en base de données pour l'affichage web
    public function toDatabase($notifiable)
    {
        return [
            'lead_id' => $this->lead->id,
            'raison_sociale' => $this->lead->raison_sociale ?? 'Nouveau prospect',
            'agent_name' => $this->lead->user->name ?? 'Un agent',
            'produit' => $this->lead->produit ?? 'Non spécifié',
            'message' => 'Une nouvelle fiche a été ajoutée par ' . ($this->lead->user->name ?? 'un agent'),
            'url' => route('leads.show', $this->lead->id),
        ];
    }
}