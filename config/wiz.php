<?php
return [
    //用户名及密码
    'user_id' => env('WIZ_USER_ID', ''),
    'password' => env('WIZ_PASSWORD', ''),
    //请求uri
    'base_uri' => env('WIZ_BASE_URI', 'https://note.wiz.cn'),
    //缓存前缀
    'cache_prefix' => 'wiz:',
];