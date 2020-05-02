XÁC THỰC ĐỊA CHỈ EMAIL

Chào {{ $username }},

Bạn vừa gửi yêu cầu xác thực email trên Zing ID.

Vui lòng nhấn vào liên kết bên dưới để hoàn tất quá trình đăng ký. Nếu bạn không nhấn được vào link vui lòng sao chép liên kết bên dưới và dán vào trình duyệt:

{{ route('email-verify', [ 'token' => $token ])}}

Nếu không phải bạn thực hiện, vui lòng KHÔNG nhấn vào đường dẫn trên.

Email này có giá trị đến hết ngày {{ $expires }} (ngày/tháng/năm).

Mọi thắc mắc xin vào liên liên hệ website: https://hotro.zing.vn.

Zing ID Team.