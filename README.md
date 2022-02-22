## 邮件验证码

## 安装
```shell
$ composer require jncinet/laravel-email-captcha
```

#### 在配置中如果使用了中文会被转成base64码，使用时需要在对应的配置文件中转回原文
示例：
```php
...
'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        // 因为发件人名称使用了中文，所以在这里转回
        'name' => \Qihucms\Support\Str::decode(env('MAIL_FROM_NAME', 'Example')),
    ],
...
```

## 添加后台菜单
+ 菜单名称：邮件配置
+ 菜单链接：email-captcha/config

## 发送验证码请求
+ 地址: /email-captcha
+ 方法: POST
+ 参数：{"email": 'username@qihucms.com'}
+ 成功：{"status": "SUCCESS"}
+ 失败：{"errors":{"msg": "发送失败"},...}

## 示例
```
        function emailCaptcha(email) {
            var pattern = /^[A-Za-zd0-9]+([-_.][A-Za-zd]+)*@([A-Za-zd]+[-.])+[A-Za-zd]{2,8}$/;
            if(!pattern.test(email)){
                $.toast("@lang('email-captcha::email_captcha.email_error')", 'text');
                return false;
            }
            axios.post('{{ route('email.captcha') }}', {email})
                .then(function (response) {
                    $.toast(response.data.msg);
                    updateSendCaptchaText();
                })
                .catch(function (error) {
                    if (error.response.status === 422) {
                        var errors = error.response.data.errors, msg;
                        if (errors.length > 0) {
                            for (var i in errors) {
                                msg = errors[i][0];
                            }
                        } else {
                            msg = error.response.data.msg;
                        }
                        $.toast(msg, 'text');
                    } else {
                        $.toast("@lang('email-captcha::email_captcha.send_fail')", 'cancel');
                    }
                    clearInterval(c);
                    $('#sendCaptcha').text("@lang('email-captcha::email_captcha.send_btn_text')");
                    t = 0;
                });
        }
```