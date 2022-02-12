<?php

namespace App\Notifications;

use App\Helpers\Helper;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewRoomReservationDownPayment extends Notification
{
    use Queueable;
    public $transaction;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            // 'mail',
            'database',
            'broadcast'
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // return (new MailMessage)
        //     ->line('Habitacion'.$this->transaction->room->number . ' ha sido reservada por ' . $this->transaction->customer->name)
        //     ->line('Pago: ' . Helper::convertToRupiah($this->payment->price))
        //     ->line('Estado: ' . $this->payment->status.' Success')
        //     ->action('See invoice', route('payment.invoice',['payment'=>$this->payment->id]));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        // return [
        //     'message' => 'Habitacion' . $this->transaction->room->number . ' reservada por ' . $this->transaction->customer->name . '. Pago: ' . Helper::convertToRupiah($this->payment->price),
        //     'url' => route('payment.invoice', ['payment' => $this->payment->id])
        // ];
    }

    public function toBroadcast($notifiable)
    {
        // return new BroadcastMessage([
        //     'message' => 'Habitacion' . $this->transaction->room->number . ' reservada por ' . $this->transaction->customer->name,
        //     'url' => route('payment.invoice', ['payment' => $this->payment->id])
        // ]);
    }
}
