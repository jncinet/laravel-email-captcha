<?php

namespace Jncinet\EmailCaptcha;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegistering extends Mailable
{
    use Queueable, SerializesModels;

    protected $captcha;
    protected $email;

    /**
     * Create a new message instance.
     *
     * @param string $captcha
     * @param string $email
     * @return void
     */
    public function __construct($captcha, $email)
    {
        $this->captcha = $captcha;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     * @throws \Exception
     */
    public function build()
    {
        // 邮箱主题
        $this->subject = __('email-captcha::email_captcha.subject', ['site_name' => cache('config_site_name')]);
        // 验证码
        $captcha = $this->captcha;
        // 收件邮箱
        $email = $this->email;

        return $this->view('email-captcha::captcha', compact('captcha', 'email'));
    }
}
