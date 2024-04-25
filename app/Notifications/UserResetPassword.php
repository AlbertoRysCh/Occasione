<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserResetPassword extends Notification
{
    use Queueable;

    protected $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    { 

        return (new MailMessage)
                    ->subject('Aviso para restablecer contraseña')
                    ->greeting('Hola que tal !.')
                    ->line('Hemos recibido una petición para restablecer tu contraseña de su cuenta.')
                    ->action('Restablecer la Contraseña', url('/reset-password/'.$this->token))
                    ->line('Este enlace para el reinicio de contraseña caducará en 60 minutos.')
                    ->line('Si no solicitó un restablecimiento de contraseña, no es necesario realizar ninguna otra acción.')
                    ->salutation('Gracias');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
