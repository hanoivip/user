<?php

return [
    'system-error' => 'System error! Plz contact administrator (missing default verify way)',
    'device' => [
        'verified' => '',
    ],
    'way' => [
        'email' => 'Verify by email',
        'code' => 'Verify by backup codes',
        'authenticator' => 'Verify by third-party authenticator app',
        'protected-email' => 'Protected by email',
        'protected-code' => 'Protected by backup codes',
        'protected-authenticator' => 'Protected by authenticator app'
    ],
    'user' => [
        'not-exists' => 'User not exists',
        'no-way' => 'User have not set any verification method'
    ],
    'verification' => [
        'email' => 'We detect a new device logging to your account and we have sent an email to your mailbox. Please check your email to get OTP there!',
        'code' => 'We detect a new device logging to your account. Please use 1 of your backup codes to get verified!',
        'authenticator' => 'We detect a new device logging to your account. Please use the code from your authenticator app to get verified!'
    ]
];
