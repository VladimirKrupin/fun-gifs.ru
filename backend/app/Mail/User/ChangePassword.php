<?php

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ChangePassword extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Build the message.
     *
     * @return $this
     */

    public $link_hash;

    public function __construct($link_hash)
    {
        $this->link_hash = $link_hash;
    }

    public function build()
    {
        return $this->view('emails.user.change-password')
            ->subject('Инструкции по смене пароля на сайте fun-gifs.ru '.date("Y-m-d H:i:s"));
    }
}
