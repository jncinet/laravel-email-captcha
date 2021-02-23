<div style="margin-bottom: 1em;">
    你好!
</div>
<div>
    感谢你注册{{ cache('config_site_name') }}会员。
    你的登录邮箱为：{{ $email }}。请回填如下6位验证码：
</div>
<p style="padding: 1em 0; font-size: 22px; letter-spacing: 10px;">
    {{ $captcha }}
</p>
<div>
    验证码在30分钟内有效，30分钟后需要重新获取
</div>