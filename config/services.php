<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'facebook' => [
    'client_id' => '571767480689998',
    'client_secret' => '45a8229f7d266fa079cf36c18aa390f1', 
    'redirect' => 'http://localhost/Weblaravel/admin/callback',
    ],
    'google' => [
    'client_id' => '734685417220-rersodc2c65mbtj0n59is4p90p2786r8.apps.googleusercontent.com',
    'client_secret' => 'NSrUE7mvLeCOfW-NIU9UDqcV',
    'redirect' => 'http://localhost/Weblaravel/google/callback'
    ],

];
