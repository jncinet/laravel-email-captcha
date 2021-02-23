<?php

namespace Jncinet\EmailCaptcha\Controllers\Admin;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class ConfigForm extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '邮箱设置';

    public function handle(Request $request)
    {
        $data = $request->all();

        if (app('env-editor')->setEnv($data)) {
            admin_success('设置成功');
        } else {
            admin_success('设置失败');
        }

        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->select('mail_driver', '邮件驱动')->options(['smtp' => 'SMTP']);
        $this->text('mail_host', '服务器地址');
        $this->text('mail_port', '服务器端口号');
        $this->divider('账号');
        $this->email('mail_username', '邮箱账号');
        $this->password('mail_password', '邮箱邮箱');
        $this->text('mail_from_name', '发件箱名称');
        $this->email('mail_from_address', '发件箱地址');
    }

    public function data()
    {
        return [
            'mail_driver' => config('mail.driver'),
            'mail_host' => config('mail.host'),
            'mail_port' => config('mail.port'),
            'mail_username' => config('mail.username'),
            'mail_password' => config('mail.password'),
            'mail_from_name' => config('mail.from.name'),
            'mail_from_address' => config('mail.from.address')
        ];
    }
}
