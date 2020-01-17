<?php
namespace App\Http\Controllers\Files;
use App\Http\Models\Post\Post;
use App\Http\Models\Post\File;
use App\Http\Models\Post\PostsTag;
use App\Http\Models\Tag\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Validator;

/**
 * Class FilesController
 * @package App\Http\Controllers\Files
 */
class FilesController extends Controller
{
    /**
     * @var Carbon
     */
    private $date_time;

    /**
     * @return Carbon
     */
    public function getDateTime()
    {
        return $this->date_time;
    }

    /**
     * @param Carbon $date_time
     */
    public function setDateTime($date_time)
    {
        $this->date_time = $date_time;
    }

    /**
     * FilesController constructor.
     */
    public function __construct()
    {
        date_default_timezone_set('Europe/Moscow');
        $this->setDateTime(Carbon::now());
    }

    /**
     * login api
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function putFiles(Request $request){
        $validator = Validator::make($request->all(), [
            'files.*' => 'mimes:jpeg,png,mp4,gif,mov,ogg',
            'files' => 'required|max:100',
            'comment' => 'required|string|min:2|max:10000',
            'tags' => 'required|string',
        ]);
        if($validator->errors()->first('files')){
            return response()->json([
                'status' => 'error',
                'data' => ['errors' =>
                    ["Выберите файлы для загрузки! <br> Общее колличество файлов не больше <b>10 шт</b>"]
                ]
            ]);
        }
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'data' => ['errors' =>$validator->errors()]
            ]);
        }else{
            $user = Auth::user();

            $slug = Str::slug($request->input('comment'), '-');
            $isset_slug = Post::where('slug','LIKE', $slug."%")->orderBy('id','desc')->first();
            $explode = explode('-',$isset_slug['slug']);
            if (((integer) end($explode)) >= 1){
                $explode[count($explode)-1] = ((integer) end($explode)) +1;
                $res = implode('-',$explode);
            }else{
                $res = "$slug-1";
            }

            $post = Post::create([
                'user_id' => $user['id'],
                'comment' => $request->input('comment'),
                'slug' => $res,
                'status' => 0,
            ]);



            if ($post){
                $post = $post->toArray();

                if (isset($request->input('tags')[1])){
                    foreach (explode(',',$request->input('tags')) as $tag){
                        PostsTag::create([
                            'post_id' => $post['id'],
                            'tag_id' => (integer) $tag
                        ]);
                    }
                }else{
                    PostsTag::create([
                        'post_id' => $post['id'],
                        'tag_id' => (integer) $request->input('tags')
                    ]);
                }
            }else{
                return response()->json([
                    'status' => 'error',
                    'data' => ['errors' =>["Ошибка при записи поста в базу, обратитесь в поддержку"]]
                ]);
            }

            try{
                foreach ($request->allFiles() as $files){
                    foreach ($files as $file){
                        $file_path = $file->path();
                        $file_name = 'fun_gifs_'.$this->getDateTime().'_'.str_replace(' ','',trim($file->getClientOriginalName()));
                        $content = file_get_contents($file_path, true);
                        $result = Storage::disk('local')->put('files-store/'.$file_name, $content);

                        File::create([
                            'path' => $file_name,
                            'post_id' => $post['id']
                        ]);
                    }

                }
            }catch (\Throwable $e){
                Post::where('id',$post['id'])->delete();
                return response()->json([
                    'status' => 'error',
                    'data' => ['errors' =>["Ошибка при сохранении файлов, обратитесь в поддержку"]]
                ]);
            }


            return response()->json([
                'status' => 'ok',
                'data' => ['message' =>
                    ["Файлы успешно загружены на сервер!"]
                ]
            ]);
        }
    }

    public function getPosts(){
        $posts = Post::where('status','>=',0)
            ->take(30)
            ->with('files')
            ->with(['postTag'=>function($query){
                $query->with('tag');
            }])
            ->orderBy('created_at', 'desc')
            ->get()->toArray();

        $tags = Tag::where('id','>=',1)->get()->toArray();

        $tag_ids = [];
        $post_tags = [];
        foreach ($posts as &$post){

            foreach ($tags as $tag){
                $tag_ids[] = $tag['id'];
                $post_tags[$tag['id']] = [
                  'id'=>$tag['id'],
                  'name'=>$tag['name'],
                  'value'=>false,
                ];
            }
            foreach ($post['post_tag'] as $post_tag){
                if (in_array($post_tag['tag']['id'],$tag_ids)){
                    $post_tags[$post_tag['tag']['id']]['value'] = true;
                }
            }

            $post['tags'] = $post_tags;
        }

        if (isset($posts[0])){
            return response()->json([
                'status' => 'ok',
                'data' => ['posts' =>$posts]
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'data' => ['error' => 'Посты закончились']
            ]);
        }
    }

    public function changeTag(Request $request){
        $validator = Validator::make($request->all(), [
            'tagId' => 'required|integer',
            'tagValue' => 'required|boolean',
            'postId' => 'required|integer',
            'tagName' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'data' => ['errors' =>$validator->errors()]
            ]);
        }else{

            $tag_id = $request->input('tagId');
            $post_id = $request->input('postId');
            $tag_name = $request->input('tagName');
            if ($request->input('tagValue') === true){
                if (!PostsTag::where('post_id',$post_id)->where('tag_id',$tag_id)->first()){
                    PostsTag::create([
                        'post_id' => $post_id,
                        'tag_id' => $tag_id
                    ]);
                    $message = "Пост $post_id добавлен к категории $tag_name";
                }else{
                    $message = "Пост $post_id уже прикреплен к категории $tag_name";
                }
            }else{
                PostsTag::where('post_id',$request->input('postId'))->where('tag_id',$request->input('tagId'))->delete();
                $message = "Пост $post_id удален из категории $tag_name";
            }

            return response()->json([
                'status' => 'ok',
                'data' => ['message' =>
                    [$message]
                ]
            ]);
        }
    }
}