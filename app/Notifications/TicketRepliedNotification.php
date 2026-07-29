<?php

namespace App\Notifications;

use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketRepliedNotification extends Notification
{
    use Queueable;

    public $ticket;
    public $replyMessage;

    public function __construct(Ticket $ticket, TicketMessage $replyMessage)
    {
        $this->ticket = $ticket;
        $this->replyMessage = $replyMessage;
    }

    /**
     * Définir les canaux d'envoi (database pour le site, mail pour courriel)
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail']; // Vous pouvez retirer 'mail' si vous ne voulez que les notifs sur le site
    }

    /**
     * Notification par Email
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Nouvelle réponse sur votre ticket #' . $this->ticket->id)
                    ->greeting('Bonjour ' . $notifiable->name . ',')
                    ->line('Un administrateur a répondu à votre ticket : **' . $this->ticket->sujet . '**')
                    ->line('Réponse : "' . $this->replyMessage->message . '"')
                    ->action('Voir le ticket', route('tickets.show', $this->ticket->id))
                    ->line('Merci d\'utiliser notre plateforme !');
    }

    /**
     * Notification stockée en Base de données (pour affichage dans l'application)
     */
    public function toArray(object $notifiable): array
    {
        return [
            'ticket_id' => $this->ticket->id,
            'sujet'     => $this->ticket->sujet,
            'sender'    => $this->replyMessage->user->name,
            'message'   => $this->replyMessage->message,
            'url'       => route('tickets.show', $this->ticket->id),
        ];
    }
}