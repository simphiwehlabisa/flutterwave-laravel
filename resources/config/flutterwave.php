<?php

return [

    /**
     * Public Key: Your Rave publicKey. Sign up on https://dashboard.flutterwave.com/ to get one from your settings page
     *
     */
    'publicKey' => env('FLW_PUBLIC_KEY'),

    /**
     * Secret Key: Your Rave secretKey. Sign up on https://dashboard.flutterwave.com/ to get one from your settings page
     *
     */
    'secretKey' => env('FLW_SECRET_KEY'),

    /**
     * Prefix: Secret hash for webhook
     *
     */
    'secretHash' => env('FLW_SECRET_HASH', ''),
];
