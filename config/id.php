<?php

return [
    'name' => [
        'portal' => 'VN1 Test',
        'site' => 'VN1 Test ID',
        'team' => 'VN1 Test Team'
    ],
    'email' => [
        'expires' => 86400, // khoảng thời gian email còn hợp lệ (theo giây)
        'toofast' => 300,  // bao lâu thì xem việc gửi email là không quá nhanh (theo giây)
    ],
    'sms' => [
        'enabled' => false    
    ],
];
