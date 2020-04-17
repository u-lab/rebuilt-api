<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Auth\Notifications\VerifyEmail as Notification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * 最大試行回数
     *
     * @var int
     */
    public $tries = 5;

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Build the Database representation of the notification.
     *
     * @param mixed $notifiable
     * @return void
     */
    public function toDatabase($notifiable)
    {
        return [
            'action' => $this->verificationUrl($notifiable),
            'email' => $notifiable->email,
            'user' => $notifiable->id,
            'subject' => __('Reset Password Notification')
        ];
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        $appUrl = config('app.client_url', config('app.url'));

        $url = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            ['user' => $notifiable->id]
        );

        return str_replace(url('/api/v1'), $appUrl, $url);
    }
}
