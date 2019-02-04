<?php
namespace App\Http\Controllers\User;
use App\Http\Models\User\UsersPasswordChange;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\User\User;
use App\Http\Models\User\OauthAccessToken;
use App;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserController extends Controller
{

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'data' => ['errors' => ['Не корректный email или пароль']],
            ]);
        }

        $input = $request->all();

        $user = User::where('email', $input['email'])->first();

        if (empty($user)){
            return response()->json([
                'status' => 'error',
                'data' => ['errors' => ['Не верный логин или пароль']],
            ]);
        }

        $validCredentials = Hash::check($input['password'], $user->getAuthPassword());

        if (!$validCredentials) {
            return response()->json([
                'status' => 'error',
                'data' => ['errors' => ['Не верный логин или пароль']],
            ]);
        }

        $user_array = $user->toArray();


        return response()->json([
            'status' => 'ok',
            'data' => ['token' => $user->createToken('MyApp')->accessToken],
        ]);
    }

    public function createUser()
    {
        $input = [
            'email' => 'Oksbolt202@gmail.com',
            'password' => bcrypt('35453970'),
        ];
        User::create($input);
    }


    public function checkUser($email){
        $user = User::where([
            'email'=>$email,
        ])->first();
        if ($user){
            return true;
        }else{
            return false;
        }
    }
}