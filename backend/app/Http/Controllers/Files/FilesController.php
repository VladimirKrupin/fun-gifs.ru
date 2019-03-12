<?php
namespace App\Http\Controllers\Files;
use App\Http\Models\Post\Post;
use App\Http\Models\Post\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            'files.*' => 'mimes:jpeg,png,mp4,gif|max:30000',
            'files' => 'required|max:6',
            'comment' => 'required|string|max:1000',
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
            $post = Post::create([
                'user_id' => $user['id'],
                'comment' => $request->input('comment'),
                'status' => 0,
            ]);
            if ($post){
                $post = $post->toArray();
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
        $posts = Post::where('status',0)->get();
        $posts = Post::where('status',44)->get();
        if (isset($posts[0])){
            return response()->json([
                'status' => 'ok',
                'data' => ['posts' =>[1,2,3,4,5]]
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'data' => ['error' => 'Посты закончились']
            ]);
        }
    }

}