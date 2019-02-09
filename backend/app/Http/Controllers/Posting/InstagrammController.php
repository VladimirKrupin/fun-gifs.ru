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
class InstagrammController extends Controller
{

    private $login;

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
    private $password;


    /**
     * PostingController constructor.
     */
    public function __construct()
    {
        $this->setLogin('fun_gifs_official');
        $this->setPassword('$Vova1234;');
    }

    public function SendRequest($url, $post, $post_data, $user_agent, $cookies) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://instagram.com/api/v1/'.$url);
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        if($post) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        }

        if($cookies) {
            curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
        } else {
            curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
        }

        $response = curl_exec($ch);
        $http = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return array($http, $response);
    }

    public function GenerateGuid() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(16384, 20479),
            mt_rand(32768, 49151),
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(0, 65535));
    }

    public function GenerateUserAgent() {
        $resolutions = array('720x1280', '320x480', '480x800', '1024x768', '1280x720', '768x1024', '480x320');
        $versions = array('GT-N7000', 'SM-N9000', 'GT-I9220', 'GT-I9100');
        $dpis = array('120', '160', '320', '240');

        $ver = $versions[array_rand($versions)];
        $dpi = $dpis[array_rand($dpis)];
        $res = $resolutions[array_rand($resolutions)];

        return 'Instagram 4.'.mt_rand(1,2).'.'.mt_rand(0,2).' Android ('.mt_rand(10,11).'/'.mt_rand(1,3).'.'.mt_rand(3,5).'.'.mt_rand(0,5).'; '.$dpi.'; '.$res.'; samsung; '.$ver.'; '.$ver.'; smdkc210; en_US)';
    }

    public function GenerateSignature($data) {
        return hash_hmac('sha256', $data, 'b4a23f5e39b5929e0666ac5de94c89d1618a2916');
    }

    public function GetPostData($filename) {
        if(!$filename) {
            echo "The image doesn't exist ".$filename;
        } else {
            $post_data = array('device_timestamp' => time(),
                'photo' => '@'.$filename);
            return $post_data;
        }
    }


    public function sendInstagramm($filename, $caption)
    {
        $filename = '/var/www/fun-gifs.ru/backend/storage/app/files-store/fun_gifs_2019-02-09 23:48:27_IMG_20190202_194106_580.jpg';
        $caption = 'test';

        $username = $this->getLogin();
        $password = $this->getPassword();

        $agent = $this->GenerateUserAgent();
        $guid = $this->GenerateGuid();
        $device_id = "android-" . $guid;
        $data = '{"device_id":"' . $device_id . '","guid":"' . $guid . '","username":"' . $username . '","password":"' . $password . '","Content-Type":"application/x-www-form-urlencoded; charset=UTF-8"}';
        $sig = $this->GenerateSignature($data);
        $data = 'signed_body=' . $sig . '.' . urlencode($data) . '&ig_sig_key_version=4';
        $login = $this->SendRequest('accounts/login/', true, $data, $agent, false);
        $text = '';

        if (strpos($login[1], "Sorry, an error occurred while processing this request.")) {
            $text .= "Request failed, there's a chance that this proxy/ip is blocked";
            return $text;
        }

        if (empty($login[1])) {
            $text .= "Empty response received from the server while trying to login";
            return $text;
        }
        $obj = @json_decode($login[1], true);

        if (empty($obj)) {
            $text .= "Could not decode the response" ;
            return $text;
        }
        $data = $this->GetPostData($filename);
        $post = $this->SendRequest('media/upload/', true, $data, $agent, true);

        if (empty($post[1])) {
            $text .= "Empty response received from the server while trying to post the image";
            return $text;
        }
        $obj = @json_decode($post[1], true);

        if (empty($obj)) {
            $text .= "Could not decode the response";
            return $text;
        }
        $status = $obj['status'];

        if ($status != 'ok') {
            $text .= "Status isn't okay";
            return $text;
        }

        $media_id = $obj['media_id'];
        $device_id = "android-" . $guid;

        $data = (object)array(
            'device_id' => $device_id,
            'guid' => $guid,
            'media_id' => $media_id,
            'caption' => trim($caption),
            'device_timestamp' => time(),
            'source_type' => '5',
            'filter_type' => '0',
            'extra' => '{}',
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
        );
        $data = json_encode($data);
        $sig = $this->GenerateSignature($data);
        $new_data = 'signed_body=' . $sig . '.' . urlencode($data) . '&ig_sig_key_version=4';

        $conf = $this->SendRequest('media/configure/', true, $new_data, $agent, true);

        if (empty($conf[1])) {
            $text .= "Empty response received from the server while trying to configure the image";
        } else {
            if (strpos($conf[1], "login_required")) {
                $text .= "You are not logged in. There's a chance that the account is banned";
            } else {
                $obj = @json_decode($conf[1], true);
                $status = $obj['status'];
                if ($status != 'fail') {
                    $text .= "Success";
                } else {
                    $text .= 'Fail';
                }
            }
        }
        return $text;
    }
}