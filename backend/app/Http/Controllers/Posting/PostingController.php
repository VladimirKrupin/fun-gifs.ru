<?php
namespace App\Http\Controllers\Posting;
use App\Http\Models\Post\Post;
use App\Http\Controllers\Controller;
use CURLFile;
use \getjump\Vk\Core as Vk;
use App;
//use getjump\Vk\Core;
use Validator;

class PostingController extends Controller
{

    public function posting()
    {

        //https://oauth.vk.com/authorize?client_id=3544010&scope=photos,audio,video,docs,notes,pages,status,offers,questions,wall,groups,messages,email,notifications,stats,ads,offline,docs,pages,stats,notifications&response_type=token

//        $post = Post::where('status', 0)
//            ->with('files')
//            ->first();
//        if ($post) {
//            $post = $post->toArray();
//            var_dump($post);
//        }
        $access_token = 'a3dfe02790399bc1fa057bd6cfd10a6c0859b44a3a76e66369fe9254ff454a5f37fbbc9b4bee2de99e679';
        $group_id = 176519720;
        $version = 5.92;

        $params = array(
            'group_id' => $group_id,
            'access_token' => $access_token,
            'v' => 5.92,
        );

        $file_upload_link = file_get_contents("https://api.vk.com/method/photos.getWallUploadServer?access_token=".$access_token."&group_id=".$group_id."&v=".$version);

        //Получаем адрес для загрузки фото на сервер
        $data=json_decode($file_upload_link);

        var_dump($data);

        $link=$data->response->upload_url;

        $post_params = array(
            'photo' => new CURLFile('/var/www/fun-gifs.ru/backend/storage/app/files-store/fun_gifs_2019-01-31 16:30:13_fun-gifs-logo.png')
        );

//Загружаем фото
        $ch = curl_init($link);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type:multipart/form-data"
        ));
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_params);
        $response = curl_exec( $ch );
        curl_close( $ch );
        $response=json_decode($response);

        $server=$response->server;
        $photo=$response->photo;
        $hash=$response->hash;
        var_dump($response);
//        var_dump($hash);
//        $link2 = "https://api.vk.com/method/photos.saveWallPhoto?access_token=".$access_token."&server=".$server."&hash=".$hash."&photo=".$photo."&group_id=".abs($group_id)."&v=".$version;
//        $link2 = "https://api.vk.com/method/photos.saveWallPhoto?access_token=".$access_token."&server=".$server."&hash=".$hash."&photo=".$photo."&v=".$version;
//        $data3 = file_get_contents($link2);
        $link2 = "https://api.vk.com/method/photos.saveWallPhoto?access_token=".$access_token."&server=".$server."&hash=".$hash."&photo=".$photo."&group_id=".$group_id."&v=".$version;
        $data3 = file_get_contents($link2);

        $data3 = json_decode($data3, true);
        var_dump($data3);

        $photo= $data3['response'][0]['id'];
        $own= $data3['response'][0]['owner_id'];
        $gf = "_";
        $photo3= "photo$own$gf$photo";

        $request_params = array(
            'owner_id' => -176519720,
            'message' => 'test wall',
            'from_group' => 1,
            'attachments' => $photo3,
            'access_token' => $access_token,  // access_token можно вбить хардкодом, если работа будет идти из под одного юзера
            'v' => 5.92,
        );

        $get_params = http_build_query($request_params);
        $result = json_decode(file_get_contents('https://api.vk.com/method/wall.post?'. $get_params));

        var_dump($result);


    }

}