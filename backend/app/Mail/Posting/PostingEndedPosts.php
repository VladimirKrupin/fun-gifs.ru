<?php

namespace App\Mail\Posting;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostingEndedPosts extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Build the message.
     *
     * @return $this
     */

    public $count;
    public $theme;

    public function __construct($count,$theme)
    {
        $this->count = $count;
        $this->theme = $theme;
    }

    public function build()
    {
        return $this->view('emails.posting.posting-result-error')
            ->subject($this->theme.' Fun-gifs.ru '.date("Y-m-d H:i:s"));
    }
}
