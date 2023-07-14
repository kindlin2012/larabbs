<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VerificationCodesController;
use App\Http\Controllers\Api\CaptchasController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\AuthorizationsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::prefix('v1')
    ->name('api.v1.')
    ->group(function () {

        Route::middleware('throttle:' . config('api.rate_limits.sign'))
            ->group(function () {

                Route::get('version', function () {
                    // abort(403, 'test');
                    return 'this is version v1';
                })->name('version');
                // 短信验证码
                Route::post('verificationCodes', [VerificationCodesController::class, 'store'])
                    ->name('verificationCodes.store');

                // 用户注册
                Route::post('users', [UsersController::class, 'store'])
                    ->name('users.store');
                Route::get('users', [UsersController::class, 'index'])
                    ->name('users.index');

                // 图片验证码
                Route::post('captchas', [CaptchasController::class, 'store'])
                    ->name('captchas.store');

                // 第三方登录
                // Route::post('socials/{social_type}/authorizations', [App\Http\Controllers\Api\AuthorizationsController::class, 'socialStore'])
                Route::post('socials/{social_type}/authorizations', [AuthorizationsController::class, 'socialStore'])
                    // Route::post('socials/{social_type}/authorizations', 'Api\AuthorizationsController@socialStore')
                    ->where('social_type', 'wechat')
                    ->name('socials.authorizations.store');

                // 登录
                Route::post('authorizations', [AuthorizationsController::class, 'store'])
                    ->name('authorizations.store');

                // 刷新token
                Route::put('authorizations/current', [AuthorizationsController::class, 'update'])
                    ->name('authorizations.update');
                // 删除token
                Route::delete('authorizations/current', [AuthorizationsController::class, 'destroy'])
                    ->name('authorizations.destroy');
            });

        Route::middleware('throttle:' . config('api.rate_limits.access'))
            ->group(function () {
            });
    });
