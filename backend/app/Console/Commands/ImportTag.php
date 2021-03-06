<?php

namespace App\Console\Commands;

use App\Http\Models\Post\Post;
use App\Http\Models\Post\PostsTag;
use Illuminate\Console\Command;

class ImportTag extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:tag';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import tag for all posts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $posts = Post::all()->toArray();
        foreach ($posts as $post){
            if (!PostsTag::where('post_id',$post['id'])->where('tag_id',1)->first()){
                PostsTag::create([
                    'post_id' => $post['id'],
                    'tag_id' => 1
                ]);
                var_dump($post['id'].' '.$post['comment']);
            }
        }
    }
}
