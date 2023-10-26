<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class notificaUser extends Notification
{
    use Queueable;
    private $usuario;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $usuario)
    {
        $this->usuario = $usuario;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Enviando email de teste')
                    ->subject('Testando notificação via email') // subtítulo
                    ->greeting('Olá '. $this->usuario->name) // saudação
                    ->action('Entrar no sistema', url('/')) // botão de ação
                    ->line('Obrigado por utilizar nossos serviços!'); // nova linha no email
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
