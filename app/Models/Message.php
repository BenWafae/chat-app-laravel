<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
     protected $fillable = [
        'user_id',
        'receiver_id',
        'message',
        'is_read',
        'read_at'
     ];

      protected $casts = [
        'read_at' => 'datetime',
        'is_read' => 'boolean'
    ];
      // Relation : un message appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }



    // Relation : un message appartient à un destinataire
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
