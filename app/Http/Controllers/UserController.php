<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\notificaUser;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
{
    public function salvaUser(Request $request) {
        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt(123456);
        $user->name = $request->name;
        $user->save();

        // $user->notify(new notificaUser($user)); // Envia para apenas um Utilizador
        $usuarios = User::whereNotIn('id', [$user->id])->get();

        Notification::send($usuarios, new notificaUser($user)); // Está a notificar certos utilizadores que o utilizador actual foi criado
    }
}
