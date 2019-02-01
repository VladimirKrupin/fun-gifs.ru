<?php
namespace App\Http\Controllers\Posting;
use App\Http\Models\Post\Post;
use App\Http\Controllers\Controller;
use \getjump\Vk\Core as Vk;
use App;
//use getjump\Vk\Core;
use Validator;

class PostingController extends Controller
{

    public function posting()
    {

        //https://vk.com/dev/authcode_flow_user

        //https://oauth.vk.com/authorize?client_id=6842537&display=page&redirect_uri=http://api.fun-gifs.ru/oauthvk/&scope=manage,offline&response_type=code&v=5.92

        $post = Post::where('status', 0)
            ->with('files')
            ->first();
        if ($post) {
            $post = $post->toArray();
            var_dump($post);
        }

//        $request_access_params = array(
//            'client_id' => 6842537,
//            'client_secret' => '6Zc4xQCYQzFOFswOsQJt',
//            'redirect_uri' => 'http://api.fun-gifs.ru/oauthvk/',
//            'code' => 'b7fbd302dfd8d7f328',
//        );
////        https://oauth.vk.com/authorize?=1&=&=&group_ids=1,2&=messages&=&v=5.92
////
//        $request_access_params = http_build_query($request_access_params);
//        $access_tocken = file_get_contents('https://oauth.vk.com/access_token?'.$request_access_params);
//        $access_tocken = json_decode($access_tocken)['access_token'];
////
//        var_dump($access_tocken);

        //autorization oauth2.0 server
//        $get_code = 'https://oauth.vk.com/authorize?client_id=6829105&redirect_uri=http://api.fun-gifs.ru/api/OAuthVk/&display=page&scope=manage,offline&response_type=code&v=5.92';
//        $get_token = 'https://oauth.vk.com/access_token?client_id=6829105&client_secret=MM3phppJM18qS1gY8vDS&redirect_uri=https://oauth.vk.com/blank.html&code=2cf2d70970ceb7b9be';
//
//
//
        $request_params = array(
            'owner_id' => -176519720,    // Кому отправляем
            'message' => 'test wall',   // Что отправляем
            'from_group' => 1,
            'access_token' => 'cdbe8a1a51b47a34f99fc4f1123303320bbf0fa8dc1580138fdd2bf3ec8091b0b72b7bbd9289d71cc7550',  // access_token можно вбить хардкодом, если работа будет идти из под одного юзера
            'v' => 5.92,
        );

        $get_params = http_build_query($request_params);
        $result = json_decode(file_get_contents('https://api.vk.com/method/wall.post?'. $get_params));

        var_dump($result);



//        $vk = new Vk;
//        $vk = Vk::getInstance()->apiVersion('5.5')->setToken('ef3dee8969688d669f623a93366e6aa0c41a662ead97900f3c0d61e4b104f540e7498bc3a50686d98e089');
//        //MESSAGES
//        $data = $vk->request('messages.get', ['count' => 200]);
//
//        var_dump($data);
//        $date = date_create_from_format('d.m.Y H:i', $_POST["date_delay"]);
//        $date_delay = mktime (date_format($date, 'H'),date_format($date, 'i'),0,date_format($date, 'm'),date_format($date, 'd'),date_format($date, 'Y'));
//        var_dump($date_delay);



//        $url = 'https://api.vk.com/method/wall.post?v=$v';
//        $params = array(
//            'owner_id' => -6829105,    // Кому отправляем
//            'message' => 'test wall',   // Что отправляем
//            'from_group' => 1,
////            'attachments' => $photo3.",".$pageURL,
////            "lat" => $lat,
////            "long" => $long,
////            "publish_date" =>  mktime (date_format($date, 'H'),date_format($date, 'i'),0,date_format($date, 'm'),date_format($date, 'd'),date_format($date, 'Y')),
//            'access_token' => '9f4c857308084ced1a6fa8ef2d2661a515bf2b60ee307ddc3298d1d157f710c019b432884af628b173c22',  // access_token можно вбить хардкодом, если работа будет идти из под одного юзера
//            'v' => 5.92,
//        );
//        $result = file_get_contents($url, false, stream_context_create(array(
//            'http' => array(
//                'method'  => 'POST',
//                'header'  => 'Content-type: application/x-www-form-urlencoded',
//                'content' => http_build_query($params)
//            )
//        )));



//
//        $url = 'https://oauth.vk.com/authorize?client_id=6829105&scope=offline,wall,manage&redirect_uri=https://oauth.vk.com/blank.html&display=page&v=5.92&response_type=token';
//        $result = file_get_contents($url, false, stream_context_create(array(
//            'http' => array(
//                'method'  => 'POST',
//                'header'  => 'Content-type: application/x-www-form-urlencoded',
//                'content' => 'html'
//            )
//        )));


// https://oauth.vk.com/authorize?client_id=6829105&scope=offline,wall,manage,groups&redirect_uri=https://oauth.vk.com/blank.html&display=page&v=5.92&response_type=token
        //https://oauth.vk.com/authorize?client_id=6829105&scope=manage,offline&redirect_uri=https://oauth.vk.com/blank.html&v=5.92&response_type=token

//        $userMap = [];
//        $userCache = [];
//
//        $user = new \getjump\Vk\Wrapper\User($vk);
//
//        $fetchData = function($id) use($user, &$userMap, &$userCache)
//        {
//            if(!isset($userMap[$id]))
//            {
//                $userMap[$id] = sizeof($userCache);
//                $userCache[] = $user->get($id)->response->get();
//            }
//
//            return $userCache[$userMap[$id]];
//        };
//
////REQUEST WILL ISSUE JUST HERE! SINCE __get overrided
//        $data->each(function($key, $value) use($fetchData) {
//            $user = $fetchData($value->user_id);
//            printf("[%s] %s <br>", $user->getName(), $value->body);
//            return;
//        });

    }

}