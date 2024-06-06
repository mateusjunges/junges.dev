<?php

namespace App\Notifications;

use App\Modules\Products\Models\Customer;
use App\Modules\Products\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

final class PairingSessionBooked extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public readonly Product $product)
    {
    }

    /** @return array<int, string> */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        assert($notifiable instanceof Customer);

        return (new MailMessage)
                    ->from('mateus@mail.junges.dev', 'Mateus Junges')
                    ->subject('Pairing session booked!')
                    ->greeting("Hey {$notifiable->name}")
                    ->line("Thank you for booking a {$this->product->name}.")
                    ->line("I'll reach out soon to schedule it!");
    }
}
