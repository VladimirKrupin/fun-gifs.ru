<?php
namespace App\Http\Controllers\Files;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App;
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
            foreach ($request->allFiles() as $files){
                foreach ($files as $file){
                    $file_path = $file->path();
                    $file_name = $file->getClientOriginalName();
                    $content = file_get_contents($file_path.'/'.$file_name, true);
                    Storage::disk('local')->put('files-store/'.$file_name, $content);
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