<?php
namespace App\Http\Controllers\Posting;
use App\Http\Models\Post\Post;
use App\Http\Controllers\Controller;
use App\Mail\Posting\PostingEndedPosts;
use App\Mail\Posting\PostingResult;
use App\Mail\Posting\PostingResultError;
use CURLFile;
use \getjump\Vk\Core as Vk;
use App;
use getjump\Vk\Core;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Validator;

/**
 * Class PostingController
 * @package App\Http\Controllers\Posting
 */
class PostingController extends Controller
{

    /**
     * @var
     */
    private $access_token;
    /**
     * @var
     */
    private $group_id;
    /**
     * @var
     */
    private $version;

    /**
     * @var
     */
    private $current_time;

    /**
     * @return mixed
     */
    public function getCurrentTime()
    {
        return $this->current_time;
    }

    /**
     * @param mixed $current_time
     */
    public function setCurrentTime($current_time)
    {
        $this->current_time = $current_time;
    }

    /**
     * PostingController constructor.
     */
    public function __construct()
    {
        // загрузка фото
        $this->setAccessToken('a3dfe02790399bc1fa057bd6cfd10a6c0859b44a3a76e66369fe9254ff454a5f37fbbc9b4bee2de99e679');
        $this->setGroupId(176519720);
        $this->setVersion(5.92);
        $this->setCurrentTime(Carbon::now()->toDateTimeString());
    }

    /**
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param mixed $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return mixed
     */
    public function getGroupId()
    {
        return $this->group_id;
    }

    /**
     * @param integer $group_id
     */
    public function setGroupId($group_id)
    {
        $this->group_id = $group_id;
    }

    /**
     * @return mixed
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * @param mixed $access_token
     */
    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
    }

    public function test(){
//        Mail::to('vladimir.krupin133@gmail.com')->send(new PostingEndedPosts(0, '123123'));
    }
    /**
     *
     */
    public function postingFb()
    {
        // https://habr.com/ru/post/329196/
        $token_fb = 'EAAFup9Mb6rsBAPplQKdOnyKfUOGj2tAAE5ychZB0KZC9I8dY3ZAbyblCaf7c2BzTYddeAIIS2MB6NkBhZCf20nFkvRzFg54MIiZBjrEcoGxZCR4DLZCya2oj4tOp57Ri7eUnjzKXvZBODGGFD0egYzOMaQTZBKOz0ZC8O2ZCbwjubYP1YD2VFWPGG2coZAchDJwENCuyIaJnOW0FwQZDZD';

        $page_id = '603196956795307';

        $data = array(
            'access_token' => $token_fb,
            'message'      => 'Hello, world!',
//            'url'          => 'fun_gifs_2019-02-04 17:46:26_376418_yaponiya_sakura_art_1680x1050_www.jpg ',
            'file_url'     => 'http://file-store.fun-gifs.ru/fun_gifs_2019-02-04 15:24:57_video-10e00016f16965099ed09713b5215fa0-V.mp4'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/' . $page_id . '/videos');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        curl_close($ch);

        $res = json_decode($res, true);
        var_dump($res);
    }


    // Запрос
    public function getUrl($url, $type = "GET", $params = array(), $timeout = 30, $image = false, $decode = true)
    {
        if ($ch = curl_init())
        {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, false);

            if ($type == "POST")
            {
                curl_setopt($ch, CURLOPT_POST, true);

                // Картинка
                if ($image) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
                }
                // Обычный запрос
                elseif($decode) {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, urldecode(http_build_query($params)));
                }
                // Текст
                else {
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
                }
            }

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_USERAGENT, 'PHP Bot');
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

            $data = curl_exec($ch);

            curl_close($ch);

            // Еще разок, если API завис
            if (isset($data['error_code']) && $data['error_code'] == 5000) {
                $data = $this->getUrl($url, $type, $params, $timeout, $image, $decode);
            }

            return $data;

        }
        else {
            return "{}";
        }
    }

    // Массив аргументов в строку
    public function arInStr($array)
    {
        ksort($array);

        $string = "";

        foreach($array as $key => $val) {
            if (is_array($val)) {
                $string .= $key."=".$this->arInStr($val);
            } else {
                $string .= $key."=".$val;
            }
        }

        return $string;
    }
    /**
     *
     */
    public function postingOk()
    {
        $link = 'http://file-store.fun-gifs.ru/fun_gifs_2019-02-04%2015:24:57_video-10e00016f16965099ed09713b5215fa0-V.mp4';
        $link = 'http://file-store.fun-gifs.ru/';

        $ok_access_token = "tkn1YaPmlptYnlEdZoMnCduvcoTO4Tb0dHKD106DB8nHZuBCTPtbnfTrvBv2SY2U3TA3e0";//Наш вечный токен
        $ok_private_key = "BB0E30802A51BBD73A969742";//Секретный ключ приложения
        $ok_public_key = "CBAONMANEBABABABA";//Публичный ключ приложения
        $ok_group_id = "56022813442280";


        // 1. Получим адрес для загрузки 1 фото
        $params = array(
            "application_key"   =>  $ok_public_key,
            "method"            => "photosV2.getUploadUrl",
            "count"             => 1,  // количество фото для загрузки
            "gid"               => $ok_group_id,
            "format"            =>  "json"
        );

        // Подпишем запрос
        $sig = md5( $this->arInStr($params) . md5("{$ok_access_token}{$ok_private_key}") );

        $params['access_token'] = $ok_access_token;
        $params['sig']          = $sig;

        // Выполним
        $step1 = json_decode($this->getUrl("https://api.ok.ru/fb.do", "POST", $params), true);

        // Если ошибка
        if (isset($step1['error_code'])) {
            // Обработка ошибки
            Mail::to('vladimir.krupin133@gmail.com')->send(new PostingEndedPosts(0, $step1['error_code']));
            exit();
        }

        // Идентификатор для загрузки фото
        $photo_id = $step1['photo_ids'][0];

        // Предполагается, что картинка располагается в каталоге со скриптом
        $params = array(
            "pic1" => "/var/www/fun-gifs.ru/backend/storage/app/files-store/fun_gifs_2019-02-04 17:46:26_376418_yaponiya_sakura_art_1680x1050_www.jpg",
        );

        // Отправляем картинку на сервер, подписывать не нужно
        $step2 = json_decode( $this->getUrl( $step1['upload_url'], "POST", $params, 30, true), true);

        // Если ошибка
        if (isset($step2['error_code'])) {
            // Обработка ошибки
            Mail::to('vladimir.krupin133@gmail.com')->send(new PostingEndedPosts(0, $step2['error_code']));
            exit();
        }

        // Токен загруженной фотки
        $token = $step2['photos'][$photo_id]['token'];

        // Заменим переносы строк, чтоб не вываливалась ошибка аттача
        $message_json = str_replace("\n", "\\n", "test message");

        // 3. Запостим в группу
        $attachment = '{
                    "media": [
                        {
                            "type": "text",
                            "text": "'.$message_json.'"
                        },
                        {
                            "type": "photo",
                            "list": [
                                {
                                    "id": "'.$token.'"
                                }
                            ]
                        }
                    ]
                }';

        $params = array(
            "application_key"=>$ok_public_key,
            "method"=>"mediatopic.post",
            "gid"=>$ok_group_id,//ID нашей группы
            "type"=>"GROUP_THEME",
            "attachment"=>$attachment,
            "format"=>"json"
        );
        // Подпишем
        $sig = md5( $this->arInStr($params) . md5("{$ok_access_token}{$ok_private_key}") );

        $params['access_token'] = $ok_access_token;
        $params['sig']          = $sig;

        $step3 = json_decode( $this->getUrl("https://api.ok.ru/fb.do", "POST", $params, 30, false, false ), true);

// Если ошибка
        if (isset($step3['error_code'])) {
            // Обработка ошибки
            Mail::to('vladimir.krupin133@gmail.com')->send(new PostingEndedPosts(0, $step3['error_code']));
            exit();
        }

// Успешно
        echo 'OK';


        var_dump($step3);

    }

    public function posting()
    {

        //https://oauth.vk.com/authorize?client_id=3544010&scope=photos,audio,video,docs,notes,pages,status,offers,questions,wall,groups,messages,email,notifications,stats,ads,offline,docs,pages,stats,notifications&response_type=token

        $post = Post::where('status', 0)
            ->with('files')
            ->first();

        if ($post) {
            $post = $post->toArray();
            $this->wallPosting($post);
            $posts = Post::where('status', 0)
                ->get();
            if ($posts){
                $posts = $posts->toArray();
                $count = count($posts);
                $theme = false;
                if ($count === 5){
                    $theme = 'Предупреждение: осталось всего 5 постов';
                }elseif ($count === 10){
                    $theme = 'Предупреждение: осталось всего 10 постов';
                }
                if ($theme){
                    Mail::to('vladimir.krupin133@gmail.com')->send(new PostingEndedPosts(0, $theme));
                    Mail::to('Oksbolt202@gmail.com')->send(new PostingEndedPosts(0, $theme));
                }
            }else{
                $theme = 'Предупреждение: только что был опубликован последний пост';
                Mail::to('Oksbolt202@gmail.com')->send(new PostingEndedPosts(0, $theme));
            }
        }else{
            $theme = 'Предупреждение: закончились посты';
            Mail::to('vladimir.krupin133@gmail.com')->send(new PostingEndedPosts(0, $theme));
            Mail::to('Oksbolt202@gmail.com')->send(new PostingEndedPosts(0, $theme));
        }


    }

    /**
     * @param $post
     */
    private function wallPosting($post){
        $attachments = [];
        foreach ($post['files'] as $file){
            switch ($this->checkTypeFile($file)){
                case 'photo':
                    $attachments[] = $this->getPhoto($file);
                    break;
                case 'video':
                    $attachments[] = $this->getVideo($post,$file);
                    break;
            }
        }
//        $eng_comment = $this->translate('ru','en',$post['comment']);
        $eng_comment = '';
        $hashtags = "\n\r〰️〰️〰️〰️〰️\n\r".$eng_comment."#fun #gif #funny #funnyvideos #video #fungifs #gifs #people #смешные #видео #видосики #гиф #гифки #веселые #ржачные #крутые";

        $params_wall_post = http_build_query([
            'owner_id' => $this->getGroupId()*-1,
            'message' => $post['comment'],
            'from_group' => 1,
            'attachments' => implode(',',$attachments),
            'access_token' => $this->getAccessToken(),
            'v' => $this->getVersion(),
        ]);

        $result = json_decode(file_get_contents('https://api.vk.com/method/wall.post?'. $params_wall_post));
        $mail_data = [];
        if (isset($result->error)){
            $mail_data['result']['status'] = 'error';
            $mail_data['result']['data'] = $result->error;
            Post::where('id',$post['id'])->update([
                'status' => 2
            ]);
            Mail::to('vladimir.krupin133@gmail.com')->send(new PostingResultError($mail_data,$post));
        }else{
            $mail_data = json_encode($result);
            Post::where('id',$post['id'])->update([
                'status' => 1
            ]);
//            Mail::to('vladimir.krupin133@gmail.com')->send(new PostingResult($mail_data));
        }

        // загрузка фото
    }

    /**
     * @param $link
     * @param $post_params
     * @return mixed
     */
    private function getCurlResponse($link, $post_params){
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
        return json_decode($response);
    }

    /**
     * @param $file
     * @return string
     */
    private function getPhoto($file){
        $params_upload_photo = http_build_query([
            'group_id' => $this->getGroupId(),
            'access_token' => $this->getAccessToken(),
            'v' => $this->getVersion(),
        ]);

        //Получаем адрес для загрузки фото на сервер
        $file_upload_link = json_decode(file_get_contents("https://api.vk.com/method/photos.getWallUploadServer?".$params_upload_photo));
        $link = $file_upload_link->response->upload_url;

        //составляем данные и загружаем фото на сервер по ссылке которую дали из предыдущего запроса
        $post_params = [
            'photo' => new CURLFile('/var/www/fun-gifs.ru/backend/storage/app/files-store/'.$file['path'])
        ];
        $response = $this->getCurlResponse($link,$post_params);

        //сохраняем фото для стены
        $params_save_photo = http_build_query([
            'access_token' => $this->getAccessToken(),
            'group_id' => $this->getGroupId(),
            'v' => $this->getVersion(),
            'server' => $response->server,
            'photo' => $response->photo,
            'hash' => $response->hash,
        ]);
        $save_photo_data = json_decode(file_get_contents("https://api.vk.com/method/photos.saveWallPhoto?".$params_save_photo));
        $id= $save_photo_data->response[0]->id;
        $owner_id= $save_photo_data->response[0]->owner_id;
        return "photo".$owner_id."_".$id;
    }

    function translate($from_lan, $to_lan, $text){
        $json = json_decode(file_get_contents('https://translation.googleapis.com/language/translate/v2?q='.$text.'&target='.$to_lan.'&source='.$from_lan));
        var_dump($json);
        $translated_text = $json->responseData->translatedText;

        return $translated_text;
    }

    /**
     * @param $post
     * @param $file
     * @return string
     */
    private function getVideo($post,$file){
        // загрузка видео
//        $eng_comment = $this->translate('ru','en',$post['comment']);
        $eng_comment = '';
        $hashtags_video = " #fun #gif #funny #video #gifs #смешные #видео #видосики #гиф #гифки #веселые #ржачные #крутые";
        $params_video_save = http_build_query([
            'group_id' => $this->getGroupId(),
            'access_token' => $this->getAccessToken(),
            'name' => $post['comment'].$eng_comment.' Fun_gifs'.$hashtags_video.'.mp4',
            'v' => $this->getVersion(),
        ]);

        $file_upload_link = json_decode(file_get_contents("https://api.vk.com/method/video.save?".$params_video_save));

        $link = $file_upload_link->response->upload_url;

        $post_params = [
            'video_file' => new CURLFile('/var/www/fun-gifs.ru/backend/storage/app/files-store/'.$file['path'])
        ];

        $response = $this->getCurlResponse($link, $post_params);

        $video_id= $response->video_id;
        $owner_id= $response->owner_id;

        return "video".$owner_id."_".$video_id;
        // загрузка видео
    }

    /**
     * @param $file
     * @return string
     */
    private function checkTypeFile($file){
        $name_array = explode('.',$file['path']);
        $last_ellement_name = end($name_array);
        switch ($last_ellement_name){
            case 'mp4':
                return 'video';
                break;
            default:
                return 'photo';
                break;
        }
    }

}