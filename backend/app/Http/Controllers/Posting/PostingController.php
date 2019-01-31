<?php
namespace App\Http\Controllers\Posting;
use App\Http\Models\Post\Post;
use App\Http\Controllers\Controller;
use App;
use Validator;

class PostingController extends Controller
{

    public function posting()
    {
        $post = Post::where('status', 0)
            ->with('files')
            ->first();
        if ($post) {
            $post = $post->toArray();
            var_dump($post);
        }

        session_start();
        require_once('/var/www/yourculture.ru/config.php');

        $img_src = 'img_path';

        $client_id = '5668453'; //id приложения
        $owner_id = '5668453';//id группы, положительное
        $token = '5668453';//id группы, положительное
        $v = "5.59";

//Получаем адрес для загрузки фото на сервер
        $data = file_get_contents("https://api.vk.com/method/photos.getWallUploadServer?access_token=" . $token . "&group_id=" . $owner_id . "&v=" . $v);
        $data = json_decode($data);

        $link = $data->response->upload_url;


        $post_params = array(
            'photo' => new CURLFile($img_src)
        );

//Загружаем фото
        $ch = curl_init($link);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_params);
        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);

        $server = $response->server;
        $photo = $response->photo;
        $hash = $response->hash;

        $link2 = "https://api.vk.com/method/photos.saveWallPhoto?access_token=" . $token . "&server=" . $server . "&hash=" . $hash . "&photo=" . $photo . "&group_id=" . $owner_id . "&v=" . $v;
        $data3 = file_get_contents($link2);

        $data3 = json_decode($data3, true);

        $photo = $data3[response][0][id];
        $own = $data3[response][0][owner_id];
        $gf = "_";
        $photo3 = "photo$own$gf$photo";

        $url = 'https://api.vk.com/method/wall.post?v=$v';
        $params = array(
            'owner_id' => $owner_id1,    // Кому отправляем
            'message' => $message,   // Что отправляем
            'from_group' => 1,
            'attachments' => $photo3 . "," . $pageURL,
            "lat" => $lat,
            "long" => $long,
            //       "publish_date" =>  $date_delay,
            'access_token' => $token,  // access_token можно вбить хардкодом, если работа будет идти из под одного юзера
            'v' => '5.59',
        );
        $result = file_get_contents($url, false, stream_context_create(array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => http_build_query($params)
            )
        )));

        error_log($result);
        $result = json_decode($result, true);
        $id = $result[response][post_id]; //id поста в VK

    }

}