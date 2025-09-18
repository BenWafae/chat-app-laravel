<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $receiverId;

    public function __construct(Message $message)
    {
        $this->message = $message->load('user'); // Charger la relation user
        $this->receiverId = $message->receiver_id;
    }

    /**
     * Canal de diffusion
     */
    public function broadcastOn(): Channel
    {
        return new PrivateChannel('chat.' . $this->receiverId);
    }

    /**
     * Nom de l'événement côté front
     */
    public function broadcastAs(): string
    {
        return 'MessageSent';
    }

    /**
     * Données à envoyer
     */
    public function broadcastWith(): array
    {
        return [
            'message' => $this->message
        ];
    }
}
