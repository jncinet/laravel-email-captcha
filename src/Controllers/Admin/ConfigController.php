<?php

namespace Jncinet\EmailCaptcha\Controllers\Admin;

use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('邮箱设置')
            ->body(new ConfigForm());
    }
}
