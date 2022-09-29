<?php

return [
    'identifier' => env('SENDINBLUE_APIIDENTIFIER', 'api-key'),
    'key' => env('SENDINBLUE_APIKEY', ''),
    'emailFrom' => [
        'email' => env('MAIL_FROM_ADDRESS'),
        'name' => env('MAIL_FROM_NAME', '')
    ],
    'smsFrom' => env('SENDINBLUE_SMS_SENDER')
];
