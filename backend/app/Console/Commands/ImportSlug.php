<?php

namespace App\Console\Commands;

use App\Http\Models\Post\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ImportSlug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:slug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import slugs from comment in posts';

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
        $count = 1;
        foreach ($posts as $post){
            $slug = Str::slug($post['comment'], '-');
            if ($slug === ''){
                $count++;
                Post::where('id',$post['id'])->update(['slug'=>"gifkawood-$count"]);
                echo "gifkawood-$count\r\n";
            }elseif ($isset_slug = Post::where('slug','LIKE',"$slug%")->where('id','!=',$post['id'])->orderBy('id','desc')->first()){
                $explode = explode('-',$isset_slug['slug']);
                if (((integer) end($explode)) >= 1){
                    $explode[count($explode)-1] = ((integer) end($explode)) +1;
                    $result = implode('-',$explode);
                    echo $result;
                }else{
                    $result = "$slug-1";
                    echo "$slug-1";
                }
                Post::where('id',$post['id'])->update(['slug'=>$result]);
            }
            else{
                Post::where('id',$post['id'])->update(['slug'=>$slug]);
                echo $slug."\r\n";
            }
        }
    }
}
