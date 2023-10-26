<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\notificaUser;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class notificaUserCadastrado
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $user = User::find($event->user->id);
        $user->notify(new notificaUser($user));
    }
}
