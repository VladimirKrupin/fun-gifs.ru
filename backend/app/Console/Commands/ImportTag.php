<?php

namespace App\Console\Commands;

use App\Http\Models\Post\Post;
use App\Http\Models\Post\PostsTag;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

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
            PostsTag::create([
                'post_id' => $post['id'],
                'tag_id' => 1
            ]);
        }
    }
}
