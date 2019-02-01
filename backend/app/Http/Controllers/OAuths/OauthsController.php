<?php
namespace App\Http\Controllers\OAuths;
use App\Http\Models\Post\Post;
use App\Http\Controllers\Controller;
use \getjump\Vk\Core as Vk;
use App;
//use getjump\Vk\Core;
use Illuminate\Http\Request;
use Validator;

class OauthsController extends Controller
{

    public function OAuthVk(Request $request)
    {

        echo json_encode($request->all());

    }

}