<?php

return [
    'system-error' => 'System error! Plz contact administrator (missing default verify way)',
    'turn-off-success' => '2fa had been turned off!',
    'device' => [
        'verified' => 'Device verification was success.',
        'revoke-success' => 'Device was removed success.',
    ],
    'way' => [
        'email' => 'Verify by email',
        'code' => 'Verify by backup codes',
        'authenticator' => 'Verify by third-party authenticator app',
        'protected-email' => 'Protected by email',
        'protected-code' => 'Protected by backup codes',
        'protected-authenticator' => 'Protected by authenticator app'
    ],
    'email' => [
        'empty' => 'Need to fill your email',
        'exists' => 'This email was used on our system. Plz use another email.'
    ],
    'user' => [
        'not-exists' => 'User not exists',
        'no-way' => 'User have not set any verification method'
    ],
    'validate' => [
        'success' => 'New way to protect your account has been added!'
    ],
    'verification' => [
        'email' => 'We detect a new device logging to your account and we have sent an email to your mailbox. Please check your email to get OTP there!',
        'code' => 'We detect a new device logging to your account. Please use 1 of your backup codes to get verified!',
        'authenticator' => 'We detect a new device logging to your account. Please use the code from your authenticator app to get verified!'
    ],
    'device' => [
        'revoke-success' => 'Device has been revoked from your account'
    ],
    'forgot' => [
        'email' => 'We have sent an email to your mail box. Check it out and input OTP here.',
        'code' => 'You have to use 1 of saved backup codes',
        'authenticator' => 'Retrieve code from authenticator app.',
    ]
];
