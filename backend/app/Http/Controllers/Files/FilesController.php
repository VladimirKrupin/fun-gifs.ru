<?php
namespace App\Http\Controllers\Files;
use App\Http\Models\Post\Post;
use Illuminate\Contracts\Logging\Log;
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
                'data' => ['errors' =>
                    ["Ошибка загрузки файлов! <br>
                    Убедитесь что размер одного файла не превышает <b>1мб</b> <br>
                    Допустимые типы фалов для загрузки <b>jpeg png odt docx pdf</b>"]
                ]
            ]);
        }else{
            $user = Auth::user();
            foreach ($request->allFiles() as $files){
                foreach ($files as $file){
                    $file_path = $file->path();
                    $file_name = $file->getClientOriginalName();
                    $content = file_get_contents($file_path, true);
                    Storage::disk('local')->put('files-store/'.$file_name, $content);
                    $post = Post::create([
                        'user_id' => $user['id'],
                        'comment' => $request->input('comment'),
                        'status' => 0,
                    ]);
                    var_dump($post->toArray());
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