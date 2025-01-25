<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StockMail extends Mailable
{
    use Queueable, SerializesModels;

    public $get_product_name;
    public $get_product_quantity;

    /**
     * Create a new message instance.
     *
     * @param string $email
     * @param string $otp_code
     * @param string $fullname
     */
    public function __construct($get_product_name,$get_product_quantity)
    {
        $this->get_product_name = $get_product_name;
        $this->get_product_quantity = $get_product_quantity;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Product stock alert')
                    ->view('emails.stock');
    }
}
