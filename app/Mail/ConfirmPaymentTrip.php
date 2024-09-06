<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmPaymentTrip extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket_trip , $count_tickets , $total_price ; 
    public function __construct($ticket_trip , $count_tickets , $total_price)
    {
        $this->ticket_trip = $ticket_trip ;
        $this->count_tickets = $count_tickets ;
        $this->total_price = $total_price ; 
    }

    // يوجد اختصار لانشاء فانكشن البلد و هي كتابة بيلد و هيظهر علطول
    public function build()
    {
        return $this->from('abdelrahimmahmoud6@gmail.com')
            ->view('emails.confirmPaymentTrip')
            ->with([
                    'ticket' => $this->ticket_trip ,
                    'count_tickets' => $this->count_tickets,
                    'total_price' => $this->total_price
             ]);    
    }
}
