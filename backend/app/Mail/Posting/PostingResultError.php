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
    public $resource;

    public function __construct($result,$post,$resource = 'vk')
    {
        $this->result = $result;
        $this->post = $post;
        $this->resource = $resource;
    }

    public function build()
    {
        $theme = '';
        if ($this->resource === 'vk'){
            $theme = 'Vkontakte';
        }elseif ($this->resource === 'fb'){
            $theme = 'Face Book';
        }
        return $this->view('emails.posting.posting-result-error')
            ->subject('Ошибка автопостинга Fun-gifs.ru '.$theme.' '.date("Y-m-d H:i:s"));
    }
}
