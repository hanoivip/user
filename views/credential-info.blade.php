@extends('hanoivip::layouts.app-id')

@section('content')
<div class="zid_pagecont">     
    <h2>Thông tin đăng nhập</h2>
    <div class="formrow">
        <label class="formrow_label">
            <span>Tên đăng nhập</span>
        </label>
        <div class="formrow_content">
            
            <strong class="formrow_text">{{ $credential->name }}</strong>
                 
            <div class="formrow_text"><i></i></div>
            
        </div>      

    </div>
    <div class="formrow">
        <label class="formrow_label">
            <span>Email đăng nhập:</span>
        </label>
        <div class="formrow_content">
            <strong class="formrow_text">
                @if (!empty($credential->email))
                        {{ $credential->email }}
                        @if (empty($credential->email_verified))
                            (Chưa xác thực)
                        @else
                            (Đã xác thực)
                        @endif
                    @else
                        (Chưa có thông tin)
                @endif
            </strong>
        </div>
        @if (empty($credential->email_verified))
                @if (!empty($credential->email))
                    <a href="{{ route('resend-email') }}" class="formrow_editbtn">Gửi lại</a>
                @endif
                @if ($errors->has('toofast'))
                    <span class="help-block">
                        <strong>{{ $errors->first('toofast') }}</strong>
                    </span>
                @endif
                <a href="{{ route('email-update') }}" class="formrow_editbtn">Cập nhật</a>
        @endif
    </div>
    <div class="formrow">
        <a href="javascript:void(0)" id="btn_edit_email" class="formrow_editbtn">Edit</a>
        <label class="formrow_label">
            <span>Mật khẩu:</span>
        </label>
        <div class="formrow_content">
            <span style="font-size:12px"><i>{{ $credential->password }}</i></span>
            <strong class="formrow_text"></strong>
            
        </div>
        <a href="{{ route('pass-update') }}" class="formrow_editbtn">Thay đổi</a>
    </div>
    
</div>
@endsection
