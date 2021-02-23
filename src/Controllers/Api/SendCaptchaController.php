<?php

namespace Jncinet\EmailCaptcha\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Jncinet\EmailCaptcha\Requests\CheckRequest;
use Jncinet\EmailCaptcha\UserRegistering;

/**
 * Class SendCaptchaController
 * @package Jncinet\EmailCaptcha\Controller\Api
 */
class SendCaptchaController extends Controller
{
    /**
     * @param CheckRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(CheckRequest $request)
    {
        try {
            $code = str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
            $email = $request->input('email');
            // 缓存用户验证码，有效期30分钟
            Cache::put('registerCaptcha' . $email, $code, now()->addMinutes(30));
            // 发邮件验证码
            Mail::to($email)->send(new UserRegistering($code, $email));

            return $this->jsonResponse(['status' => 'SUCCESS']);
        } catch (\Exception $exception) {
            return $this->jsonResponse(['msg' => trans('email-captcha::email_captcha.send_fail')]);
        }
    }
}