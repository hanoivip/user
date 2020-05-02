<?php

return [

    'email' => [
        'update' => [
            'success' => 'Chúc mừng bạn, chúng tôi đã gửi một thư xác thực đến địa chỉ :email.

            Vui lòng kiểm tra hộp thư và nhấn vào link xác thực.
            
            Quá trình xác thực có thể mất vài phút, nếu sau 5 phút mà bạn vẫn chưa nhận được thư xác thực. Vui lòng thử gửi lại .',
            
            'fail' => 'Cập nhật email đăng nhập thất bại.',
            
            'exception' => 'Cập nhật email đăng nhập có lỗi. Vui lòng liên hệ ngay GM để giải quyết.',
        ],
        
        'verify' => [
            'success' => 'Chúc mừng bạn đã cập nhật email đăng nhập mới thành công cho tài khoản :username.',
            
            'fail' => 'Xác thực email đăng nhập thất bại.',
            
            'exception' => 'Xác thực email đăng nhập có lỗi. Vui lòng liên hệ ngay GM để giải quyết.',
        ],
        'resend' => [
            'success' => 'Gửi lại xác nhận email thành công.',
            
            'fail' => 'Gửi lại xác nhận email thất bại.',
            
            'exception' => 'Gửi lại xác nhận email có lỗi. Vui lòng liên hệ ngay GM để giải quyết.',
        ],
        'exists' => 'Email đã tồn tại.',
    ],
    'pass2' => [
        'update' => [
            'success' => 'Cập nhật mật khẩu bảo mật thành công.',
            'fail' => 'Cập nhật mật khẩu bảo mật thất bại.',
            'exception' => 'Cập nhật mật khẩu bảo mật có lỗi. Vui lòng liên hệ ngay GM để giải quyết.',
        ],

        'duplicated_not_good' => 'Cập nhật mật khẩu bảo mật thất bại, phải khác với mật khẩu hiện tại.',
    ],

    'qna' => [
        'update' => [
            'success' => 'Cập nhật câu hỏi bảo mật thành công.',
            
            'fail' => 'Cập nhật câu hỏi bảo mật thất bại.',
            
            'exception' => 'Cập nhật câu hỏi bảo mật có lỗi. Vui lòng liên hệ ngay GM để giải quyết.',
        ],
        'question1' => 'Bạn ghét điều gì nhất?',
        'question2' => 'Bạn thường làm gì khi rảnh rỗi?',
        'question3' => 'Bạn yêu quí người nào nhất?',
        'question4' => 'Bộ phim nào gây ấn tượng nhất với bạn?',
        'question5' => 'Ca sĩ nào là thần tượng của bạn?',
        'question6' => 'Công việc lý tưởng của bạn là gì?',
        'question7' => 'Diễn viên nào là thần tượng của bạn?',
        'question8' => 'Mơ ước của bạn là gì?',
        'question9' => 'Món ăn bạn ưa thích nhất?',
        'question10' => 'Môn thể thao yêu thích của bạn là gì?',
        'question11' => 'Người bạn thân nhất của bạn là ai?',
        'question12' => 'Số PinCode trên thẻ tạo sẵn?',
        'question13' => 'Nơi sinh của bạn ở đâu?',
        'question14' => 'Trường học tiểu học của bạn tên gì?',
        'question15' => 'Họ của mẹ bạn là gì?',
        'question16' => 'Tên công ty đầu tiên bạn làm việc?',
        'question17' => 'Tên trường đại học mà bạn đã học?',
        'question18' => 'Bạn gặp vợ (chồng) mình ở đâu?',
        'question18' => 'Họ của bố bạn là gì?',
        'question18' => 'Tên của ông bạn là gì?',
    ],
];