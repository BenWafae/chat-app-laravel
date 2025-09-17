<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


// shoulddbroadcast rend levenement difusable en temps reells
class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;   
    public $receiverId;

    /**
     * Crée une nouvelle instance de l’événement.
     */
    public function __construct(Message $message)
    {
        $this->message    = $message;
        $this->receiverId = $message->receiver_id;
    }

    /**
     * Canal de diffusion.
     * Ici on utilise un canal privé pour le destinataire.
     */
    public function broadcastOn(): Channel
    {

        // private channel securise le canale pour que seul le distinataire puisse ecouter 
        return new PrivateChannel('chat.' . $this->receiverId);
    }

    /**
     * Nom de l'événement côté front (facultatif, sinon = 'MessageSent').
     */
    public function broadcastAs(): string
    {
        return 'MessageSent';
    }
}
