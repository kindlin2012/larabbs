<?php

return [
    // HTTP 请求的超时时间（秒）
    'timeout' => 5.0,

    // 默认发送配置
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,

        // 默认可用的发送网关
        'gateways' => [
            // 'aliyun',
            'qcloud',
        ],
    ],
    // 可用的网关配置
    'gateways' => [
        'errorlog' => [
            'file' => '/tmp/easy-sms.log',
        ],
        // 'aliyun' => [
        //     'access_key_id' => env('SMS_ALIYUN_ACCESS_KEY_ID'),
        //     'access_key_secret' => env('SMS_ALIYUN_ACCESS_KEY_SECRET'),
        //     'sign_name' => 'Larabbs',
        // ],
        'qcloud' => [
            'sdk_app_id' => env('QCLOUD_SMS_APP_ID'),   // 要在.env文件配置好相应的值
            'app_key' => env('QCLOUD_SMS_APP_KEY'),   // 要在.env文件配置好相应的值
            'sign_name' => 'Larabbs',
            'templates' => [
                'register' => env('SMS_QCLOUD_TEMPLATE_REGISTER'),
        ],
       ],
    ],
];
