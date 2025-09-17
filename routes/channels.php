<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/



Broadcast::channel('chat.{receiverId}', function ($user, $receiverId) {
    // Autorise uniquement le destinataire à écouter
    return (int) $user->id === (int) $receiverId;
});

// ici on diffuse le canale private chat.recieved_id et pour qu un user ecoute un canale prv laravel 
// doit savoir s il a la possibilite d y acceder sinon nimport qui poura lacceder that why we use private channel
// chat.{receiverId} : c le nom de canal cote backend  receivedId est un parametre dynamqiue qui sera remplace par lid de user
//  exemple :chat.6