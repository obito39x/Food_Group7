<?php

namespace App\Notifications;

use App\Models\Voucher; 
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VoucherNotification extends Notification
{
    use Queueable;
    protected $voucher;

    public function __construct(Voucher $voucher)
    {
        $this->voucher = $voucher;
    }

    public function via($notifiable)
    {
        return ['mail']; // Hoặc các phương tiện thông báo khác như database, broadcast, ...
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Congratulations! You have received a voucher.')
            ->line('Voucher Code: ' . $this->voucher->code)
            ->line('Discount: ' . $this->voucher->discount_percent . '%')
            ->line('Expiration Date: ' . $this->voucher->expiration_date->format('Y-m-d'))
            ->line('Enjoy your shopping!');
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
