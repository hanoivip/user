@extends('hanoivip::layouts.app-id')

@section('content')

<div class="zid_pagecont">
    <div class="formrow">  
        Tìm lại mật khẩu bằng email
    </div>  
    <form class="zidregister_form" method="POST" action="{{ route('pass-forgot-do') }}">
        {{ csrf_field() }}
        <div class="form_input_grp">
            <div class="form_input_wrapper" id="wrap_oldpwd">
                <input id="email" type="text" placeholder="Nhập email" class="form_input" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="zidform_btn">
            <div class="zidform_twobtn">
                <p class="btn_cell">
                    <input type="button" class="zidregcancelbtn" onclick="window.location.href = '{{ route('user') }}'" value="Hủy bỏ">
                </p>
                <p class="btn_cell">
                    <input type="submit" class="zidbtn_default" value="Gửi">
                </p>
            </div>
        </div>
    </form>  
</div>

@endsection
