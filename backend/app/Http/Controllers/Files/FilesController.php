<?php
namespace App\Http\Controllers\Files;
use App\Http\Models\Post\Post;
use App\Http\Models\Post\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Validator;

class FilesController extends Controller
{
    /**
     * login api
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function putFiles(Request $request){
        $validator = Validator::make($request->all(), [
            'files.*' => 'mimes:jpeg,png,odt,docx,pdf|max:1000',
            'files' => 'required|max:10',
            'comment' => 'required|string|max:255',
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

            foreach ($request->allFiles() as $files){
                foreach ($files as $file){
                    $file_path = $file->path();
                    $file_name = $file->getClientOriginalName();
                    $content = file_get_contents($file_path, true);
                    $file = Storage::disk('local')->put('files-store/'.$file_name, $content);
                    $url = Storage::url('files-store/'.$file_name);
                    var_dump($url);
                    File::create([
                        'path' => $file_name,
                        'post_id' => $post['id']
                    ]);
                }

            }

            return response()->json([
                'status' => 'ok',
                'data' => ['message' =>
                    ["Файлы успешно загружены на сервер!"]
                ]
            ]);
        }
    }

}