<?php

return [
    'default' => env('TEXTER_DEFAULT_TRANSPORT', 'sms_global'),
    'local_country_code' => '971',
    'transports' => [
        'sms_global' => [
            'driver' => 'sms_global',
            'server' => 'https://api.smsglobal.com',
            'username' => '',
            'password' => '',
            'token' => '',
            'secret' => '',
            'api_key' => ''
        ],
        'bulk_sms' => [
            'driver' => 'bulk_sms',
            'server' => 'https://api.bulksms.com/v1',
            'username' => '',
            'password' => '',
            'token' => '',
            'secret' => '',
            'api_key' => ''
        ],
        'bulk_sms_cloud' => [
            'driver' => 'bulk_sms_cloud',
            'server' => 'http://sms.bulk-sms-cloud.me',
            'username' => '',
            'password' => '',
            'token' => '',
            'secret' => '',
            'api_key' => ''
        ],
        'ad_ventura' => [
            'driver' => 'ad_ventura',
            'server' => 'http://msg.ad-ventura.ae/app',
            'username' => '',
            'password' => '',
            'token' => '',
            'secret' => '',
            'api_key' => '',
            'campaign' => '1784',
            'routeid' => '39',
        ]
    ]
];
