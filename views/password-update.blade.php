@extends('hanoivip::layouts.app-id')

@section('content')
<div class="zid_pagecont">
    <div class="formrow">  
        Đổi Mật Khẩu
    </div>  
    <form class="zidregister_form" method="POST" action="{{ route('pass-update-result') }}">
        {{ csrf_field() }}
        <div class="form_input_grp">
            <div class="form_input_wrapper" id="wrap_oldpwd">
                <input id="oldpass" type="password" placeholder="Mật khẩu hiện tại" class="form_input" name="oldpass" value="{{ old('oldpass') }}" required autofocus>

                @if ($errors->has('oldpass'))
                    <span class="help-block">
                        <strong>{{ $errors->first('oldpass') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form_input_wrapper" id="wrap_newpwd">
                <input id="newpass" type="password" placeholder="Mật khẩu mới" class="form_input" name="newpass" required>
                @if ($errors->has('newpass'))
                    <span class="help-block">
                        <strong>{{ $errors->first('newpass') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form_input_wrapper" id="wrap_renewpwd">
                <input id="password-confirm" placeholder="Xác nhận mật khẩu mới" type="password" class="form_input" name="newpass_confirmation" required>
            </div>
        </div>
        <div class="form_input_grp">
            <div class="form_input_wrapper form_captcha_input" id="wrap_captcha">
                <input id="captcha" type="text" class="form_input" placeholder="Mã kiểm tra" name="captcha" required>
            </div>
            <div class="form_captcha_pic">
                <a class="form_catpcha_reload" href="javascript:void(0)" onclick='window.location.reload();' title="Tạo mã kiểm tra khác"><em></em></a>
                <p><img src="{{ captcha_src() }}" alt="captcha"/></p>
            </div>
        </div>
        <div class="zidform_btn">
            <div class="zidform_twobtn">
                <p class="btn_cell">
                    <input type="button" class="zidregcancelbtn" onclick="window.location.href = '{{ route('user') }}'" value="Hủy bỏ">
                </p>
                <p class="btn_cell">
                    <input type="submit" class="zidbtn_default" value="Đổi mật khẩu">
                </p>
            </div>
        </div>

    </form>  
</div>
@endsection
