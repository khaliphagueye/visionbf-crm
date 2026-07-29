<?php

namespace App\Notifications;

use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewTicketNotification extends Notification
{
    use Queueable;

    public $ticket;
    public $messageObj;
    public $type; // 'new_ticket' ou 'reply'

    public function __construct(Ticket $ticket, TicketMessage $messageObj, string $type = 'new_ticket')
    {
        $this->ticket = $ticket;
        $this->messageObj = $messageObj;
        $this->type = $type;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        if ($this->type === 'new_ticket') {
            $msg = 'Nouveau ticket support de ' . $this->messageObj->user->name;
        } else {
            $msg = 'Nouvelle réponse de ' . $this->messageObj->user->name . ' au ticket #' . $this->ticket->id;
        }

        return [
            'ticket_id' => $this->ticket->id,
            'sujet' => $this->ticket->sujet,
            'message' => $msg,
            'raison_sociale' => 'Ticket Support: ' . $this->ticket->sujet,
            'url' => route('tickets.show', $this->ticket->id),
        ];
    }
}