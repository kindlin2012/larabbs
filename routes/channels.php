<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// return response()->json(['test_message' => 'store verification code']);
    //     $captchaCacheKey =  'captcha_'.$request->captcha_key;
    //     $captchaData = Cache::get($captchaCacheKey);

    //     if (!$captchaData) {
    //         abort(403, '图片验证码已失效');
    //     }

    //     if (!hash_equals($captchaData['code'], $request->captcha_code)) {
    //         // 验证错误就清除缓存
    //         Cache::forget($captchaCacheKey);
    //         throw new AuthenticationException('验证码错误');
    //     }

    //     $phone = $captchaData['phone'];

    //     if (!app()->environment('production')) {
    //         $code = '1234';
    //     } else {
    //         // 生成4位随机数，左侧补0
    //         $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);

    //         try {
    //             $result = $easySms->send($phone, [
    //                 'template' => config('easysms.gateways.aliyun.templates.register'),
    //                 'data' => [
    //                     'code' => $code
    //                 ],
    //             ]);
    //         } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
    //             $message = $exception->getException('aliyun')->getMessage();
    //             abort(500, $message ?: '短信发送异常');
    //         }
    //     }

    //     $smsKey = 'verificationCode_'.Str::random(15);
    //     $smsCacheKey = 'verificationCode_'.$smsKey;
    //     $expiredAt = now()->addMinutes(5);
    //     // 缓存验证码 5分钟过期。
    //     Cache::put($smsCacheKey, ['phone' => $phone, 'code' => $code], $expiredAt);
    //     // 清除图片验证码缓存
    //     Cache::forget($captchaCacheKey);

    //     return response()->json([
    //         'key' => $smsKey,
    //         'expired_at' => $expiredAt->toDateTimeString(),
    //     ])->setStatusCode(201);
