<?php

namespace App\Http\Controllers\Api;

// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\Api\UserRequest;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Cache;
use App\Models\Image;
use Overtrue\LaravelWeChat\EasyWeChat;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth', ['except' => ['register','weappStore','show']]);
    }

    public function store(UserRequest $request)
    {


        $cacheKey = 'verificationCode_'.$request->verification_key;
        $verifyData = Cache::get($cacheKey);
        // return $verifyData;

       if (!$verifyData) {
           abort(403, '验证码已失效');
        }

        if (!hash_equals($verifyData['code'], $request->verification_code)) {
            // 返回401
            throw new AuthenticationException('验证码错误');
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $verifyData['phone'],
            'password' => $request->password,
        ]);

        // 清除验证码缓存
        Cache::forget($cacheKey);

        return (new UserResource($user))->showSensitiveFields();
    }

    public function index()
    {
        return User::all();
    }

    public function show(User $user, Request $request)
    {
        return new UserResource($user);
    }

    public function me(Request $request)
    {
        return (new UserResource($request->user()))->showSensitiveFields();
    }

    public function update(UserRequest $request)
    {
        $user = $request->user();

        $attributes = $request->only(['name', 'email', 'introduction']);

        if ($request->avatar_image_id) {
            $image = Image::find($request->avatar_image_id);

            $attributes['avatar'] = $image->path;
        }

        $user->update($attributes);

        return (new UserResource($user))->showSensitiveFields();
    }

    public function activedIndex(User $user)
    {
        UserResource::wrap('data');
        return UserResource::collection($user->getActiveUsers());
    }

    public function weappStore(UserRequest $request)
    {
        //在laravel的log文件中输出$request


        // return request();
        log::debug($request);
        // EasyWeChat::miniApp();
        // // 缓存中是否存在对应的 key
        //检查缓存中是否存在对应的key

        // $verifyData = Cache::get($request->verification_key);
        // // return 'is'.$verifyData;

        // log::debug($verifyData);
        // if (!$verifyData) {
        //     abort(403, '验证码已失效');
        // }

        // // 判断验证码是否相等，不相等反回 401 错误
        // if (!hash_equals((string)$verifyData['code'], $request->verification_code)) {
        //     throw new AuthenticationException('验证码错误');
        // }
        // log::debug($verifyData['code']);
        // 获取微信的 openid 和 session_key
        // $miniProgram = EasyWeChat::miniProgram();
        // $data = $miniProgram->auth->session($request->code);
        $miniApp = app('easywechat.mini_app');
        $utils = $miniApp->getUtils();

        $data = $utils->codeToSession($request->code);



        if (isset($data['errcode'])) {
            throw new AuthenticationException('code 不正确');
        }

        log::debug($data);

        // 如果 openid 对应的用户已存在，报错403
        $user = User::where('weapp_openid', $data['openid'])->first();

        if ($user) {
            throw new AuthenticationException('微信已绑定其他用户，请直接登录');
        }




        // 创建用户

       $user = User::create([
            'name' => $request->name,
            // 'phone' => $verifyData['phone'],
            //'phone' =>$request->phone,

            'password' => $request->password,
            'weapp_openid' => $data['openid'],
            'weixin_session_key' => $data['session_key'],
        ]);



        return (new UserResource($user))->showSensitiveFields();
    }

}
