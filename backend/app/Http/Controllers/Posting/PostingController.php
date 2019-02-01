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
        $post = Post::where('status', 0)
            ->with('files')
            ->first();
        if ($post) {
            $post = $post->toArray();
            var_dump($post);
        }

        $vk = new Vk;
        $vk = Vk::getInstance()->apiVersion('5.5')->setToken('ef3dee8969688d669f623a93366e6aa0c41a662ead97900f3c0d61e4b104f540e7498bc3a50686d98e089');
        //MESSAGES
        $data = $vk->request('messages.get', ['count' => 200]);

        var_dump($data);

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