@extends('hanoivip::layouts.app-id')

@section('content')

<div class="zid_pagecont">
    <div class="formrow">  
        Đặt lại mật khẩu
    </div>  
    <form class="zidregister_form" method="POST" action="{{ route('pass-reset-do') }}">
        {{ csrf_field() }}
        <input type="hidden" id="token" name="token" value="{{$token}}"/>
        <div class="form_input_grp">
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
