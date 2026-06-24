<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url(
            route(
                'v4.password.reset',
                [
                    'token' => $this->token,
                    'email' => $notifiable->email,
                ],
                false,
            ),
        );

        return new MailMessage()

            ->subject('Reset Password SIMRS MU')

            ->view('pages.v4.auth.email-reset-password', [
                'url' => $url,
                'user' => $notifiable,
            ]);
    }
}
