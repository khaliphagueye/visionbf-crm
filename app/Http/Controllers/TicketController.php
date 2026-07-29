<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Models\User;
use App\Notifications\NewTicketNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class TicketController extends Controller
{
    /**
     * Afficher la liste des tickets
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            // L'admin voit TOUS les tickets
            $tickets = Ticket::with('user')->latest()->paginate(15);
        } else {
            // Les autres utilisateurs voient uniquement leurs propres tickets
            $tickets = Ticket::where('user_id', $user->id)->latest()->paginate(15);
        }

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Formulaire de création d'un ticket
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Enregistrement d'un nouveau ticket
     */
    public function store(Request $request)
    {
        $request->validate([
            'sujet' => 'required|string|max:255',
            'priorite' => 'required|in:basse,moyenne,haute,urgente',
            'message' => 'required|string',
        ]);

        // 1. Création du ticket
        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'sujet' => $request->sujet,
            'priorite' => $request->priorite,
            'statut' => 'ouvert',
        ]);

        // 2. Création du premier message associé
        $message = TicketMessage::create([
            'ticket_id' => $ticket->id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        // 🔔 NOTIFICATION : Prévenir tous les Administrateurs de la création
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new NewTicketNotification($ticket, $message, 'new_ticket'));

        return redirect()->route('tickets.show', $ticket->id)->with('success', 'Ticket créé avec succès.');
    }

    /**
     * Afficher la discussion d'un ticket
     */
    public function show(Ticket $ticket)
    {
        $user = Auth::user();

        // Vérification des accès : Seul l'admin ou le propriétaire du ticket peut y accéder
        if ($user->role !== 'admin' && $ticket->user_id !== $user->id) {
            abort(403);
        }

        // 🔔 Marquer les notifications non lues liées à ce ticket comme LUES pour l'utilisateur actuel
        $user->unreadNotifications
            ->filter(function ($notification) use ($ticket) {
                return isset($notification->data['ticket_id']) && $notification->data['ticket_id'] == $ticket->id;
            })
            ->markAsRead();

        // Chargement optimisé des relations
        $ticket->load(['messages.user', 'user']);

        return view('tickets.show', compact('ticket'));
    }

    /**
     * Répondre à un ticket existant
     */
public function reply(Request $request, Ticket $ticket)
{
    $request->validate([
        'message' => 'required|string',
    ]);

    $currentUser = Auth::user();

    // Enregistrement du message de réponse
    $message = TicketMessage::create([
        'ticket_id' => $ticket->id,
        'user_id' => $currentUser->id,
        'message' => $request->message,
    ]);

    // Si l'utilisateur (non-admin) répond alors que le ticket était résolu, repasser le statut en "ouvert"
    if ($currentUser->role !== 'admin' && $ticket->statut === 'resolu') {
        $ticket->update(['statut' => 'ouvert']);
    }

    // 🔔 NOTIFICATION (Un seul envoi ici) :
    if ($currentUser->role === 'admin') {
        // Si l'admin répond -> Notifier l'utilisateur créateur du ticket (s'il ne s'agit pas de lui-même)
        if ($ticket->user_id !== $currentUser->id) {
            $ticket->user->notify(new NewTicketNotification($ticket, $message, 'reply'));
        }
    } else {
        // Si l'utilisateur/agent répond -> Notifier tous les administrateurs
        $admins = User::where('role', 'admin')->get();
        Notification::send($admins, new NewTicketNotification($ticket, $message, 'reply'));
    }

    return back()->with('success', 'Votre réponse a bien été envoyée.');
}

    /**
     * Changer le statut du ticket (ADMIN SEULEMENT)
     */
    public function updateStatus(Request $request, Ticket $ticket)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'statut' => 'required|in:ouvert,en_cours,resolu,ferme',
        ]);

        $ticket->update(['statut' => $request->statut]);

        return back()->with('success', 'Statut du ticket mis à jour.');
    }
}