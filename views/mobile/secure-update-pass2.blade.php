@extends('layouts.app')

@section('content')
<div class="zid_pagecont">
    <div class="formrow">  
        Đổi mật khẩu bảo mật
    </div>  
    <form class="zidregister_form" method="POST" action="{{ route('secure-update-pass2-result') }}">
        {{ csrf_field() }}
        <div class="form_input_grp">
             @if (!empty($info->personal_id))
                <div class="form_input_wrapper">
                    <input id="personid" type="text" placeholder="CMTND" class="form_input" name="personid" value="{{ old('personid') }}">

                    @if ($errors->has('personid'))
                        <span class="help-block">
                            <strong>{{ $errors->first('personid') }}</strong>
                        </span>
                    @endif
                </div>
            @endif
            @if (!empty($info->pass2))
                <div class="form_input_wrapper">
                    <input id="oldpass2" type="password" placeholder="Mã game hiện tại" class="form_input" name="oldpass2" required autofocus>

                    @if ($errors->has('oldpass2'))
                        <span class="help-block">
                            <strong>{{ $errors->first('oldpass2') }}</strong>
                        </span>
                    @endif
                </div>
            @endif
            <div class="form_input_wrapper">
                <input id="newpass2" type="password" placeholder="Mã game mới" class="form_input" name="newpass2" required autofocus>

                @if ($errors->has('newpass2'))
                    <span class="help-block">
                        <strong>{{ $errors->first('newpass2') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form_input_wrapper">
                <input id="newpass2_confirmation" type="password" placeholder="Nhắc lại mã game mới" class="form_input" name="newpass2_confirmation" required>

                @if ($errors->has('newpass2_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('newpass2_confirmation') }}</strong>
                    </span>
                @endif
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
                    <input type="button" class="zidregcancelbtn" onclick="window.location = '{{ route("home") }}'" value="Hủy bỏ">
                </p>
                <p class="btn_cell">
                    <input type="submit" class="zidbtn_default" value="Cập nhật">
                </p>
            </div>
        </div>

    </form>  
</div>
@endsection
