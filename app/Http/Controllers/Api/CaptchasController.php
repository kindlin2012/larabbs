<?php

namespace App\Http\Controllers\Api;

// use App\Http\Controllers\Controller;
//继承同文件夹下controller
use Illuminate\Http\Request;
use  Illuminate\Support\Str;
use Gregwar\Captcha\CaptchaBuilder;
use App\Http\Requests\Api\CaptchaRequest;
use Illuminate\Support\Facades\Cache;

class CaptchasController extends Controller
{
    public function store(CaptchaRequest $request, CaptchaBuilder $captchaBuilder)
    // public function store()
    {

        $key = Str::random(15);
        $cacheKey =  'captcha_'.$key;
        $phone = $request->phone;

        $captcha = $captchaBuilder->build();
        $expiredAt = now()->addMinutes(5);
        \Cache::put($cacheKey, ['phone' => $phone, 'code' => $captcha->getPhrase()], $expiredAt);
        //  return \cache()::get($cacheKey);
        $result = [
            'captcha_key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
            'captcha_image_content' => $captcha->inline(),
            'captcha_content' => $captcha->getPhrase()
        ];

        return response()->json($result)->setStatusCode(201);
    }
}
