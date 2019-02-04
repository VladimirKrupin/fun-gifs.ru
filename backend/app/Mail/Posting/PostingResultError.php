<?php

namespace App\Mail\Posting;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostingResultError extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Build the message.
     *
     * @return $this
     */

    public $result;
    public $post;

    public function __construct($result,$post)
    {
        $this->result = $result;
        $this->post = $post;
    }

    public function build()
    {
        return $this->view('emails.posting.posting-result-error')
            ->subject('Ошибка автопостинга Fun-gifs.ru '.date("Y-m-d H:i:s"));
    }
}
