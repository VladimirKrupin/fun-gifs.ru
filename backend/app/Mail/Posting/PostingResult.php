<?php

namespace App\Mail\Posting;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostingResult extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Build the message.
     *
     * @return $this
     */

    public $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    public function build()
    {
        return $this->view('emails.posting.posting-result')
            ->subject('Результат автопостинга Fun-gifs.ru '.date("Y-m-d H:i:s"));
    }
}
