<?php
return [
    'update' => [
        'success' => 'Chúc mừng bạn, chúng tôi đã gửi một thư xác thực đến địa chỉ :email.

        Vui lòng kiểm tra hộp thư và nhấn vào link xác thực.
        
        Quá trình xác thực có thể mất vài phút, nếu sau 5 phút mà bạn vẫn chưa nhận được thư xác thực. Vui lòng thử gửi lại .',

        'fail' => 'Cập nhật email đăng nhập thất bại.',

        'exception' => 'Cập nhật email đăng nhập có lỗi. Vui lòng liên hệ ngay GM để giải quyết.', 
        
        'verified' => 'Email đăng nhập đã được duyệt. Chúng tôi không hỗ trợ thay đổi email này!',
    ],

    'verify' => [
        'success' => 'Chúc mừng bạn đã cập nhật email đăng nhập mới thành công cho tài khoản :username.',

        'fail' => 'Xác thực email đăng nhập thất bại.',

        'exception' => 'Xác thực email đăng nhập có lỗi. Vui lòng liên hệ ngay GM để giải quyết.'
    ],
    'resend' => [
        'success' => 'Gửi lại xác nhận email thành công.',

        'fail' => 'Gửi lại xác nhận email thất bại.',

        'exception' => 'Gửi lại xác nhận email có lỗi. Vui lòng liên hệ ngay GM để giải quyết.'
    ]
];