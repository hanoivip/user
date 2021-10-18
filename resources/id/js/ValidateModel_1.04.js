var errMsg = {
    require_err: 'Bạn cần nhập thông tin này.',
    choose_err: 'Bạn cần chọn thông tin này.',
    input_invalid: 'Thông tin không hợp lệ',
    Account_empty: 'Bạn chưa nhập tài khoản',
    Account_invalid1: 'Tên đăng nhập không hợp lệ.',
    Account_invalid: 'Cần nhập tài khoản từ 6-24 ký tự.',
    Account_existed: 'Tài khoản đã tồn tại.',
    Account_notexisted: 'Tài khoản không tồn tại.',
    Account_format: 'Tài khoản cần bao gồm cả chữ và số.',
    Fullname_empty: 'Cần nhập họ tên từ 2-40 ký tự.',
    Fullname_same: 'Vui lòng nhập giá trị mới.',
    Date_invalid: 'Ngày tháng không hợp lệ.',
    Dob_notchoosed: 'Bạn chưa chọn ngày sinh.',
    Mob_notchoosed: 'Bạn chưa chọn tháng sinh.',
    Yob_notchoosed: 'Bạn chưa chọn năm sinh.',
    Cmnd_Error: 'Bạn cần nhập số CMND từ 8-15 ký tự.',
    Cmnd_Invalid: 'Số CMND không hợp lệ.',
    Cmnd_notmatch: 'Số CMND không đúng.',
    Email_empty: 'Bạn cần nhập thông tin này.',
    Email_mapping: 'Email đã được đăng ký với tài khoản khác.',
    Email_mapping1: 'Email đã được bạn xác thực với tài khoản này.',
    Email_mapping2: 'Email đã được xác thực với tài khoản khác.',
    Email_notmatch: 'Email không đúng.',
    Email_notexits: 'Email không tồn tại.',
    Email_notsupport: 'Chúng tôi không hỗ trợ xác thực email cho tên miền zing.vn, bạn vui lòng chọn email khác.',
    Email_spamperday: 'Bạn đã sử dụng quá số lần quy định trong ngày, vui lòng quay lại sau 24h.',
    Email_sendsuccess: 'Gửi email thành công',
    Email_sendinputinvalid: 'Thông tin đăng nhập không hợp lệ.',
    Email_senderror: 'Lỗi trong quá trình gửi email',
    Email_invalid: 'Địa chỉ email không hợp lệ.',
    Email_getFail: 'Không tìm thấy email bảo vệ hiện tại.',
    ReEmail_empty: 'Bạn cần nhập thông tin này.',
    ReEmail_notmatch: 'Xác nhận email không đúng.',
    Qna_err: 'Câu hỏi hoặc câu trả lời không đúng.',
    Qna_Empty_a: 'Bạn cần nhập câu trả lời (< 100 ký tự).',
    Qna_Empty_q: 'Bạn chưa chọn câu hỏi.',
    Qna_Error_confirm: 'Xác nhận trả lời phải giống trả lời.',
    Pwd_empty: 'Bạn cần nhập thông tin này.',
    Pwd_matchAcn: 'Mật khẩu không được trùng với tên tài khoản.',
    Pwd_unsafe: 'Mật khẩu phải có 6-32 ký tự.',
    Pwd_invalid: 'Mật khẩu phải có 6-32 ký tự.',
    Pwd_nottrue: 'Mật khẩu không đúng định dạng.',
    Pwd_notmatch: 'Mật khẩu không đúng.',
    Pwd_matchGamecode: 'Mật khẩu không được trùng mã game.',
    Newpwd_matchole: 'Mật khẩu mới trùng mật khẩu cũ',
    RePwd_notmatch: 'Xác nhận mật khẩu không đúng.',
    Gamecode_notmatch: 'Mã game không đúng.',
    Gamecode_invalid2: 'Mã game không hợp lệ.',
    Gamecode_invalid: 'Mã game phải có 6-32 ký tự.',
    Gamecode_matchOldGamecode: 'Mã game không được trùng mã game cũ.',
    Gamecode_matchPassword: 'Mã game không được trùng mật khẩu.',
    Gamecode_matchAcn: 'Mã game không được trùng tên tài khoản.',
    Gamecode_unsafe: 'Mã game không an toàn.',
    ReGamecode_notmatch: 'Xác nhận mã game không đúng.',
    Phonelogin_existed: 'Số điện thoại đăng nhập đã tồn tại.',
    Phone_notmatch: 'Số điện thoại không đúng.',
    Phone_notfound: 'Số điện thoại không tồn tại.',
    Phone_invalid: 'Số điện thoại không hợp lệ.',
    Phone_thesame: 'Số điện thoại không được trùng nhau.',
    Phone_require: 'Bạn cần nhập Số điện thoại',
    PhoneProtect_notexisted: 'Tài khoản này chưa đăng ký hoặc chưa xác nhận số điện thoại bảo vệ.',
    Phone_getFail: 'Không tìm thấy số điện thoại bảo vệ hiện tại.',
    Phone_mapping1: 'Số điện thoại đã được bạn xác thực với tài khoản này.',
    Phone_mapping2: 'Số điện thoại này đã được xác thực với tài khoản khác.',
    Phone_dos: 'Số điện thoại này đã bị khóa, vui lòng thử lại vào ngày khác.',
    Phone_notexisted: 'Số điện thoại không tồn tại',
    smscode_require: 'Bạn cần nhập mã xác nhận',
    Smscode_invalid: 'Mã xác minh không hợp lệ.',
    Smscode_fail: 'Mã xác minh không đúng hoặc đã được sử dụng.',
    Sms_BLACKLIST: "Số điện thoại này đã bị nằm trong blacklist.",
    Sms_DOS_IP: "IP này đã bị khóa.",
    Sms_DOS_Phone: "Bạn đã yêu cầu gửi nhiều tin nhắn trong ngày, xin vui lòng thử gửi lại vào lúc khác.",
    Sms_Fail: "hông gửi được tin nhắn.",
    OTP_invalid: 'Bạn cần nhập mã OTP',
    Captcha_invalid: 'Mã xác nhận không đúng.',
    Checkbox_notcheck: 'Bạn chưa đồng ý điều khoản sử dụng.',
    Account_lock: 'Tài khoản này đã bị khóa. Vui lòng liên hệ 1900.561.558 để được hỗ trợ.',
    Login_fail: 'Tài khoản hoặc mật khẩu không đúng',
    ListProduct_require: 'Vui lòng chọn game muốn nhận SMS',
    Add_invalid: "Bạn phải nhập địa chỉ từ 2-100 ký tự.",
    City_invalid: "Bạn chưa chọn tỉnh thành.",
    Occupation_invalid: "Bạn chưa chọn nghề nghiệp.",
    marital_invalid: "Bạn chưa chọn tình trạng hôn nhân.",
    Gender_invalid: 'Bạn chưa chọn giới tính.',
    Error: 'Hệ thống đang bận, vui lòng thử lại sau.'
}
function ValidateModel() {

}
ValidateModel.regexPhone = /(0|84)+(9[0-9]|12[0-9]|16[0-9]|99[0-9]|19[0-9])\d{7}$/;
ValidateModel.passwordMin = 6;
ValidateModel.passwordMax = 32;
ValidateModel.fullnameMin = 2;
ValidateModel.fullnameMax = 40;
ValidateModel.addressMin = 2;
ValidateModel.addressMax = 100;
ValidateModel.isNotBlank = function (inputid) {
    var element = zm("#" + inputid);
    var value = element.val();
    return  value == "" || value == element.attr("placeholder");
}
ValidateModel.isValidPhone = function (value) {
    return ValidateModel.regexPhone.test(value);
}
ValidateModel.isValidPassword = function (value) {
    try {
        return (value.length >= ValidateModel.passwordMin &&
                value.length <= ValidateModel.passwordMax);
    }
    catch (e) {
    }
    return false;

}
ValidateModel.isValidFullname = function (value) {
    try {
        return (value.length >= ValidateModel.fullnameMin &&
                value.length <= ValidateModel.fullnameMax);
    }
    catch (e) {
    }
    return false;

}
ValidateModel.isValidAddress = function (value) {

    try {
        return (value.length >= ValidateModel.addressMin &&
                value.length <= ValidateModel.addressMax);
    }
    catch (e) {
    }
    return false;
}
ValidateModel.checkDate = function (year, month, day) {
    try {
        var d = new Date(parseInt(year), parseInt(month) - 1, parseInt(day));
        return d.getFullYear() === parseInt(year) && (d.getMonth() + 1) === parseInt(month) && d.getDate() === parseInt(day);
    }
    catch (e) {
    }
    return false;

}
ValidateModel.isValidDate = function (dob, mob, yob) {
    try {
        var currentTime = new Date();
        var currentYear = currentTime.getFullYear();
        if (dob < 1 || dob > 31 || mob < 1 || mob > 12 || yob < 1900 || yob > currentYear || !ValidateModel.checkDate(yob, mob, dob)) {
            return false;
        }
        return true;
    }
    catch (e) {
    }
    return false;
}

//check cmnd
ValidateModel.isValidCMND = function (value) {
    try {
        var pattern = /^[a-zA-Z0-9]*$/;
        if (value.match(pattern) != null)
            return true;
    }
    catch (e) {
    }
    return false;
}
ValidateModel.isValidEmail = function (email) {
    try {
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return (filter.test(email));
    }
    catch (e) {
    }
    return false;
}
