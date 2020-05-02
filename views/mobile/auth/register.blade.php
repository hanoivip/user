@extends('layouts.app')

@section('content')
<div class="zid_pagecont">
        <form class="zidregister_form" id="frmReg" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
        <div class="form_input_grp">
            <div class="form_input_wrapper" id="wrap_acn">
                <input id="name" type="text" class="form_input" name="name" placeholder="Tên đăng nhập" maxlength="24" value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong style="color: red;">{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form_input_wrapper" id="wrap_pwd">
                <input id="password" type="password" class="form_input" placeholder="Mật khẩu" maxlength="32" name="password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong style="color: red;">{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form_input_wrapper" id="wrap_repwd">
                <input id="password-confirm" type="password" class="form_input" placeholder="Xác nhận mật khẩu" maxlength="32" name="password_confirmation" required>
            </div>
        </div>        
        <label class="zidreg_checkterm">
            <div class="form_input_wrapper" id="wrap_checkbox">
                <input type="checkbox" id="checkbox">Tôi đồng ý với <a href="javascript:void(0);">điều khoản sử dụng</a>
            </div>
        </label>
        <div class="zidform_btn">
            <div class="zidform_twobtn">
                <p class="btn_cell">
                    <input type="button" class="zidregcancelbtn" onclick="window.location = '{{ url('/') }}'" value="Hủy bỏ">
                </p>
                <p class="btn_cell">
                    <input type="submit" class="zidbtn_default" value="Đăng ký">
                </p>
            </div>
        </div>

    </form>
</div>
@endsection
