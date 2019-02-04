<?php
namespace App\Http\Controllers\Posting;
use App\Http\Models\Post\Post;
use App\Http\Controllers\Controller;
use App\Mail\Posting\PostingResult;
use CURLFile;
use \getjump\Vk\Core as Vk;
use App;
use getjump\Vk\Core;use Carbon\Carbon;
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

    /**
     *
     */
    public function posting()
    {

        //https://oauth.vk.com/authorize?client_id=3544010&scope=photos,audio,video,docs,notes,pages,status,offers,questions,wall,groups,messages,email,notifications,stats,ads,offline,docs,pages,stats,notifications&response_type=token

        $post = Post::where('status', 0)
            ->with('files')
            ->first();
        if ($post) {
            $post = $post->toArray();
            var_dump($post);
        }

        $this->wallPosting($post);

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
                    $attachments[] = $this->getVideo($file);
                    break;
            }
        }

        $params_wall_post = http_build_query([
            'owner_id' => $this->getGroupId()*-1,
            'message' => $post['comment'],
            'from_group' => 1,
            'attachments' => implode(',',$attachments),
            'access_token' => $this->getAccessToken(),
            'v' => '',
        ]);

        $result = file_get_contents('https://api.vk.com/method/wall.post?'. $params_wall_post);

        Mail::to('vladimir.krupin133@gmail.com')->send(new PostingResult($result));

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

    /**
     * @param $file
     * @return string
     */
    private function getVideo($file){
        // загрузка видео
        $params_video_save = http_build_query([
            'group_id' => $this->getGroupId(),
            'access_token' => $this->getAccessToken(),
            'name' => 'fun_gifs_'.$this->getCurrentTime().'.mp4',
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