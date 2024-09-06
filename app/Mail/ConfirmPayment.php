<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmPayment extends Mailable
{
    use Queueable, SerializesModels;

    public $room  , $from_date , $to_date , $total_price ;
    public function __construct($room , $from_date , $to_date , $total_price)
    {
        $this->room = $room ;
        $this->from_date = $from_date ;
        $this->to_date = $to_date ;
        $this->total_price = $total_price ;
    }

    public function build()
    {
        return $this->from('abdelrahimmahmoud6@gmail.com')
                    ->subject('Confirm payment of hotel')
                    ->view('emails.confirmPaymentHotel')
                    ->with([
                        'room', $this->room ,
                        'from_date' => $this->from_date ,
                        'to_date' => $this->to_date ,
                        'total_price' => $this->total_price ,
                    ]);
    }
}
