@extends('layouts.app')

@section('content')
<div class="zid_pagecont">           
<form class="zidlogin_form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <div class="form_input_grp">
        <div class="form_input_wrapper" id="wrap_phone">
            <input id="email_username_phone" class="form_input" name="email_username_phone"  placeholder="Tên, email hoặc số điện thoại" value="{{ old('email_username_phone') }}" required autofocus>

            @if ($errors->has('email_username_phone'))
                <span class="help-block">
                    <strong style="color: red;">{{ $errors->first('email_username_phone') }}</strong>
                </span>
            @endif
        </div>
        <div class="form_input_wrapper" id="wrap_pwd">
            <input id="password" type="password" class="form_input" name="password"  placeholder="Mật Khẩu" required>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong style="color: red;">{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form_input_grp"> 
        <div class="grpoption_left">
            <label class="zidreg_checkterm forgetpass_link">
                <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
            </label>
        </div>
        <div class="grpoption_right align_right">
            <button type="submit" class="zidloginbtn">
                Đăng nhập
            </button>
        </div>
    </div>
</form>
<div class="other_loginmethod" style="display: none;">
    <div class="other_loginmethod_inner">
        <h3>Đăng nhập bằng tài khoản </h3>
        <div class="otheracc_icon">
            <p>
                <a href="javascript:void(0)" class="btn_loginsocial via_facebook bgsolid">
                    <span></span><strong class="btntext">Facebook</strong>
                </a>
            </p>
            <p>
                <a href="javascript:void(0)" class="btn_loginsocial via_gplus bgsolid">
                    <span></span><strong class="btntext">Google+</strong>
                </a>
            </p>
        </div>
    </div>
</div>
    <div class="zidlogin_regnewacc">
        <div class="zidlogin_regnewacc_inner">
            <a href="{{ route('register') }}" class="zidregbtn">Đăng ký tài khoản {{ config('id.name.site') }}</a>
        </div>
    </div>
</div>
@endsection
