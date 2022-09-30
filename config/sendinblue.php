<?php

return [
    'identifier' => env('SENDINBLUE_IDENTIFIER'),
    'key' => env('SENDINBLUE_KEY'),
    'emailFrom' => [
        'email' => env('MAIL_FROM_ADDRESS'),
        'name' => env('MAIL_FROM_NAME')
    ],
    'smsFrom' => env('SENDINBLUE_SMS_SENDER')
];
