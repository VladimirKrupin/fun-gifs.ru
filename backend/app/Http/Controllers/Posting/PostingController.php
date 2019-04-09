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

    private $access_token;
    private $group_id;
    private $version;
    private $current_time;

    private $ok_access_token;
    private $ok_private_key;
    private $ok_public_key;
    private $ok_group_id;

    private $fb_token;
    private $fb_group_id;

    private $key_words;
    private $hash_tags;

    /**
     * @return mixed
     */
    public function getHashTags()
    {
        return $this->hash_tags;
    }

    /**
     * @param mixed $hash_tags
     */
    public function setHashTags($hash_tags)
    {
        $this->hash_tags = $hash_tags;
    }

    /**
     * @return mixed
     */
    public function getFbGroupId()
    {
        return $this->fb_group_id;
    }

    /**
     * @param mixed $fb_group_id
     */
    public function setFbGroupId($fb_group_id)
    {
        $this->fb_group_id = $fb_group_id;
    }

    /**
     * @return mixed
     */
    public function getFbToken()
    {
        return $this->fb_token;
    }

    /**
     * @param mixed $fb_token
     */
    public function setFbToken($fb_token)
    {
        $this->fb_token = $fb_token;
    }


    /**
     * @return mixed
     */
    public function getKeyWords()
    {
        return $this->key_words;
    }

    /**
     * @param mixed $key_words
     */
    public function setKeyWords($key_words)
    {
        $this->key_words = $key_words;
    }

    /**
     * @return mixed
     */
    public function getOkGroupId()
    {
        return $this->ok_group_id;
    }

    /**
     * @param mixed $ok_group_id
     */
    public function setOkGroupId($ok_group_id)
    {
        $this->ok_group_id = $ok_group_id;
    }

    /**
     * @return mixed
     */
    public function getOkPublicKey()
    {
        return $this->ok_public_key;
    }

    /**
     * @param mixed $ok_public_key
     */
    public function setOkPublicKey($ok_public_key)
    {
        $this->ok_public_key = $ok_public_key;
    }

    /**
     * @return mixed
     */
    public function getOkPrivateKey()
    {
        return $this->ok_private_key;
    }

    /**
     * @param mixed $ok_private_key
     */
    public function setOkPrivateKey($ok_private_key)
    {
        $this->ok_private_key = $ok_private_key;
    }

    /**
     * @return mixed
     */
    public function getOkAccessToken()
    {
        return $this->ok_access_token;
    }

    /**
     * @param mixed $ok_access_token
     */
    public function setOkAccessToken($ok_access_token)
    {
        $this->ok_access_token = $ok_access_token;
    }

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
        //https://oauth.vk.com/blank.html#access_token=00a513ea13d012c80d1719aec01d214cb22cc38c3543c942cea55b7b1d241bd6f4a9bae2e658c2e160a2a&expires_in=0&user_id=244842255
        //https://oauth.vk.com/authorize?client_id=6842537&display=popup&redirect_uri=https://oauth.vk.com/blank.html%20&scope=wall,offline,groups&response_type=token
        // загрузка фото
        $this->setAccessToken('00a513ea13d012c80d1719aec01d214cb22cc38c3543c942cea55b7b1d241bd6f4a9bae2e658c2e160a2a');
        $this->setGroupId(176519720);
        $this->setVersion(5.92);
        $this->setCurrentTime(Carbon::now()->toDateTimeString());


        $this->setOkAccessToken("tkn1ce3LbLBhQmompbntGdPpbvpqe6d9mgSbumqnQ3H0FgjdF8FP75wjqgkisckqNHPD8");//Наш вечный токен
        $this->setOkPrivateKey("BB0E30802A51BBD73A969742");//Секретный ключ приложения
        $this->setOkPublicKey("CBAONMANEBABABABA");//Публичный ключ приложения
        $this->setOkGroupId("56022813442280");

        $this->setKeyWords(' Лучшие видео приколы смешные свежие подборка новинки самые топ смотреть интересно смех веселая животные котики 2019');

        $this->setFbToken('EAAFup9Mb6rsBAPoYF3wtI8rBxdbZCGG65mMPzyUSVa4AlSEZClkBQZCbg9uI8w286hSrDJE6OAC6uzO18IPSGl9CyctY0jGGOZAxzqK7OhfLXGNMnOBnnh8v1mnKFDHhSjCUMB7ZBurniKyZCHdcw2chS0A7r3ZA9YZAZAWrQ4ujZC9u7Y8unagtXm');
        $this->setFbGroupId('603196956795307');

        $russian_hash_tags = explode(' ',$this->getKeyWords());
        $russian_hash_tags = implode(' #',$russian_hash_tags);
        $hashtags = "#funny #video #gifs #people #movies #top #super #art #smile #girls #cat \n\r".$russian_hash_tags;
        $this->setHashTags($hashtags);
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

    public function returnPostStatus($post){
        Post::where('id',$post['id'])->update([
            'status' => 0
        ]);
    }

    public function wallAllPosting(){
        $post = Post::where('status', 0)
            ->with('files')
            ->first();
//        $post = Post::where('id', 167)
//            ->with('files')
//            ->first();
//


        if ($post) {
            $post = $post->toArray();

            $this->wallPosting($post);
            var_dump('Vk');
            $this->postingOk($post);
            var_dump('Ok');
//            $this->postingFb($post);
//            var_dump('Fb');

            $posts = Post::where('status', 0)->get();
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
            Post::where('id',$post['id'])->update([
                'status' => 1
            ]);
        }else{
            $theme = 'Предупреждение: закончились посты';
            Mail::to('vladimir.krupin133@gmail.com')->send(new PostingEndedPosts(0, $theme));
            Mail::to('Oksbolt202@gmail.com')->send(new PostingEndedPosts(0, $theme));
        }

    }

    /**
     * @param $post
     */
    public function postingFb($post)
    {
        // https://habr.com/ru/post/329196/
        switch ($this->checkTypeFile($post['files'][0])){
            case 'photo':
                $this->getPhotoFb($post,$post['files'][0]);
                break;
            case 'video':
                 $this->getVideoFb($post,$post['files'][0]);
                break;
        }
    }

    /**
     * @param $file
     * @return string
     */
    private function getPhotoFb($post,$file){
        $data = array(
            'access_token' => $this->getFbToken(),
            'message'      => $post['comment'],
            'url'          => 'http://file-store.fun-gifs.ru/'.str_replace(' ','%20',$file['path']),
            'name_tags'    => $this->getKeyWords(),
            'name'    => $post['comment'],
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/' . $this->getFbGroupId() . '/photos');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($res);
        if ($res->error){
            Mail::to('vladimir.krupin133@gmail.com')->send(new PostingResultError($res,$post,'fb'));
        }
    }


    /**
     * @param $file
     * @return string
     */
    private function getVideoFb($post,$file){

        $no_hash_tags = str_replace('#','',$this->getHashTags());

        $data = array(
            'access_token' => $this->getFbToken(),
            //тут в название между \n\r------\n\r <- находятся спецсимволы
            'description'      => $post['comment']."\n\r\n\r".'🔹'."\n\r\n\r".$this->getHashTags(),
            'title'      => substr($no_hash_tags,0,224),
            'source'    => 'true',
            'file_url'     => 'http://file-store.fun-gifs.ru/'.str_replace(' ','%20',$file['path'])
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/' . $this->getFbGroupId() . '/videos');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($ch);
        curl_close($ch);
        $res = json_decode($res);
        var_dump($res);
        if (isset($res->error)){
            var_dump($res);
            Mail::to('vladimir.krupin133@gmail.com')->send(new PostingResultError($res,$post,'fb'));
        }
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
    public function postingOk($post)
    {
        $video_content = false;

        $attachments = [];
        foreach ($post['files'] as $file){
            switch ($this->checkTypeFile($file)){
                case 'photo':
                    $attachments['photo'][] = $this->getPhotoOk($post,$file);
                    break;
                case 'video':
                    $attachments['video'][] = $this->getVideoOk($post,$file);
                    $video_content = true;
                    break;
            }
        }

        if ($video_content){
//            Post::where('id',$post['id'])->update([
//                'status' => 1
//            ]);
            return true;
        }

        // Заменим переносы строк, чтоб не вываливалась ошибка аттача
        $message_json = str_replace("\n", "\\n", $post['comment']);

        $attachment['media'][] = ['type'=>'text','text'=>$message_json];

//        if (isset($photos)){
        if (isset($attachments['photo'])){
//            $attachment['media'][] = ['type'=>'photo','list'=>$photos];
            $attachment['media'][] = ['type'=>'photo','list'=>$attachments['photo']];
        }
        if (isset($attachments['video'])){
            $attachment['media'][] = ['type'=>'movie-reshare','movieId'=>$attachments['video'][0]['movieId']];
        }

//        var_dump($attachment);

        // 3. Запостим в группу
//        $attachment = '{
//                    "media": [
//                        {
//                            "type": "text",
//                            "text": "'.$message_json.'"
//                        },
//                        {
//                            "type": "photo",
//                            "list": [
//                                '.$photos.'
//                            ]
//                        }
//                    ]
//                }';
//        [{"media":{"type":"text","text":"test message"}}]


//        die;

        //сделаем json
        $attachment = json_encode($attachment);

        $params = array(
            "application_key"=>$this->getOkPublicKey(),
            "method"=>"mediatopic.post",
            "gid"=>$this->getOkGroupId(),//ID нашей группы
//            "uid"=>$this->getOkGroupId(),//ID нашей группы
            "type"=>"GROUP_THEME",
            "attachment"=>$attachment,
            "format"=>"json"
        );
        // Подпишем
        $sig = md5( $this->arInStr($params) . md5("{$this->getOkAccessToken()}{$this->getOkPrivateKey()}") );

        $params['access_token'] = $this->getOkAccessToken();
        $params['sig']          = $sig;

        $step3 = json_decode( $this->getUrl("https://api.ok.ru/fb.do", "POST", $params, 30, false, false ), true);

// Если ошибка
        if (isset($step3['error_code'])) {
            // Обработка ошибки
            var_dump($step3);
//            Mail::to('vladimir.krupin133@gmail.com')->send(new PostingEndedPosts(0, $step3));
            exit();
        }

// Успешно
        echo 'OK';


        var_dump($step3);

    }

//    public function posting()
//    {
//
//        //https://oauth.vk.com/authorize?client_id=6842537&display=page&redirect_uri=https://oauth.vk.com/blank.html &scope=photos,audio,video,docs,notes,pages,status,offers,questions,wall,groups,email,notifications,stats,ads,offline,docs,pages,stats,notifications&response_type=token
//
//        $post = Post::where('status', 0)
//            ->with('files')
//            ->first();
//
////        $post = Post::where('id', 82)
////            ->with('files')
////            ->first();
//
//        if ($post) {
//            $post = $post->toArray();
//            $this->wallPosting($post);
//            $posts = Post::where('status', 0)
//                ->get();
//            if ($posts){
//                $posts = $posts->toArray();
//                $count = count($posts);
//                $theme = false;
//                if ($count === 5){
//                    $theme = 'Предупреждение: осталось всего 5 постов';
//                }elseif ($count === 10){
//                    $theme = 'Предупреждение: осталось всего 10 постов';
//                }
//                if ($theme){
//                    Mail::to('vladimir.krupin133@gmail.com')->send(new PostingEndedPosts(0, $theme));
//                    Mail::to('Oksbolt202@gmail.com')->send(new PostingEndedPosts(0, $theme));
//                }
//            }else{
//                $theme = 'Предупреждение: только что был опубликован последний пост';
//                Mail::to('Oksbolt202@gmail.com')->send(new PostingEndedPosts(0, $theme));
//            }
//        }else{
//            $theme = 'Предупреждение: закончились посты';
//            Mail::to('vladimir.krupin133@gmail.com')->send(new PostingEndedPosts(0, $theme));
//            Mail::to('Oksbolt202@gmail.com')->send(new PostingEndedPosts(0, $theme));
//        }
//
//
//    }

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
        $hashtags_video = " Fun-gifs.ru | смешные лучшие видео приколы 2019 гиф веселые ржачные крутые смешное угары топ веселое fun gif funny video gifs";
        $key_words = 'Лучшие видео приколы смешные свежие подборка новые новинки самые топ смотреть февраль 2019 интересно смех веселая 2018';
        $params_video_save = http_build_query([
            'group_id' => $this->getGroupId(),
            'access_token' => $this->getAccessToken(),
            'name' => $this->getKeyWords().' | Fun Gifs .mp4',
            'description' => $hashtags_video,
            'v' => $this->getVersion(),
        ]);

        $file_upload_link = json_decode(file_get_contents("https://api.vk.com/method/video.save?".$params_video_save));

        if (isset($file_upload_link->error)){
            $this->returnPostStatus($post);
            Mail::to('vladimir.krupin133@gmail.com')->send(new PostingResultError($file_upload_link,$post,'vk'));
            var_dump($file_upload_link);
        }

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

    private function getVideoOk($post,$file)
    {
        // 1. Получим адрес для загрузки 1 фото
        $params = array(
            "application_key"   =>  $this->getOkPublicKey(),
            "method"            => "video.getUploadUrl",
            "file_name"         => $post['comment'],
            "file_size"         => 0,
            "count"             => 1,  // количество видео для загрузки
            "gid"               => $this->getOkGroupId(),
//            "uid"               => '578434590952',
            "format"            =>  "json",
//            "post_form"            =>  'false'
        );

        // Подпишем запрос
        $sig = md5( $this->arInStr($params) . md5("{$this->getOkAccessToken()}{$this->getOkPrivateKey()}") );
//
        $params['access_token'] = $this->getOkAccessToken();
        $params['sig']          = $sig;

        // Выполним
        $step1 = json_decode($this->getUrl("https://api.ok.ru/fb.do", "POST", $params), true);

        // Если ошибка
        if (isset($step1['error_code'])) {
            // Обработка ошибки
            var_dump('step1');
            var_dump($step1);
            exit();
        }

        // Идентификатор для загрузки фото
        $video_id = intval($step1['video_id']);

        $video_real_path = realpath('/var/www/fun-gifs.ru/backend/storage/app/files-store/'.$file['path']);
        $curl_file = curl_file_create($video_real_path,'video/mp4',$post['comment'].' Fun Gifs.mp4');

        // Предполагается, что картинка располагается в каталоге со скриптом
        $params2 = array(
            "video_file" => $curl_file,
        );

        // Отправляем картинку на сервер, подписывать не нужно
        $step2 = json_decode( $this->getUrl( $step1['upload_url'], "POST", $params2, 30, true), true);

        // Если ошибка
        if (isset($step2['error_code'])) {
            // Обработка ошибки
            var_dump('step2');
            var_dump($step2);
            exit();
        }


        // 3.Загрузка видео
        $params3 = array(
            "application_key"   =>  $this->getOkPublicKey(),
            "method"            => "video.update",
            "vid"         => $video_id,
            "title"         => $post['comment']." | Fun-gifs.ru",
            "tags"         => $this->getKeyWords(),
            "description"         => $this->getKeyWords(),
//            "gid"               => $this->getOkGroupId(),
            "format"            =>  "json"
        );


        // Подпишем запрос
        $sig3 = md5( $this->arInStr($params3) . md5("{$this->getOkAccessToken()}{$this->getOkPrivateKey()}") );
        $params3['access_token'] = $this->getOkAccessToken();

        $params3['sig'] = $sig3;

        // Выполним
        $step3 = json_decode($this->getUrl("https://api.ok.ru/fb.do", "POST", $params3), true);

        // Если ошибка
        if (isset($step3['error_code'])) {
            var_dump('step3');
            var_dump($step3);
            // Обработка ошибки
            exit();
        }

        return ['movieId' => $video_id];

    }

    private function getPhotoOk($post,$file)
    {

        // 1. Получим адрес для загрузки 1 фото
        $params = array(
            "application_key"   =>  $this->getOkPublicKey(),
            "method"            => "photosV2.getUploadUrl",
            "count"             => 1,  // количество фото для загрузки
            "gid"               => $this->getOkGroupId(),
            "format"            =>  "json"
        );

        // Подпишем запрос
        $sig = md5( $this->arInStr($params) . md5("{$this->getOkAccessToken()}{$this->getOkPrivateKey()}") );

        $params['access_token'] = $this->getOkAccessToken();
        $params['sig']          = $sig;

        // Выполним
        $step1 = json_decode($this->getUrl("https://api.ok.ru/fb.do", "POST", $params), true);

        // Если ошибка
        if (isset($step1['error_code'])) {
            // Обработка ошибки
            var_dump($step1);
//            Mail::to('vladimir.krupin133@gmail.com')->send(new PostingEndedPosts(0, $step1));
            exit();
        }

        // Идентификатор для загрузки фото
        $photo_id = $step1['photo_ids'][0];

        $img_real_path = realpath('/var/www/fun-gifs.ru/backend/storage/app/files-store/'.$file['path']);
        $extension = explode('.',$file['path']);
        $extension = end($extension);
        $curl_file = curl_file_create($img_real_path,'image/jpeg',$post['comment'].'.'.$extension);

        // Предполагается, что картинка располагается в каталоге со скриптом
        $params = array(
            "pic1" => $curl_file,
        );

        // Отправляем картинку на сервер, подписывать не нужно
        $step2 = json_decode( $this->getUrl( $step1['upload_url'], "POST", $params, 30, true), true);

        // Если ошибка
        if (isset($step2['error_code'])) {
            // Обработка ошибки
            var_dump($step2);
//            Mail::to('vladimir.krupin133@gmail.com')->send(new PostingEndedPosts(0, $step2));
            exit();
        }

        // Токен загруженной фотки
        $token = $step2['photos'][$photo_id]['token'];

//        return '{"id": "'.$token.'"}';
        return ['id' => $token];
    }

}
