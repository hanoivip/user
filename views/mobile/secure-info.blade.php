@extends('layouts.app')

@section('content')
<div class="zid_pagecont">  
    @if (empty($info))
            <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                Something went wrong. Please contact Customer Service now.
                </div></div>
    @else   
    <div class="formrow">
        @if (empty($info->email_verified) ||
            empty($info->phone_verified))
            Bạn vui lòng cập nhật email bảo vệ, mật khẩu cấp 2, câu hỏi bảo vệ để lấy lại mật khẩu trong trường hợp bị quên.
        @endif            
    </div>  
    <div class="formrow">
        <label class="formrow_label">
            <span>Email bảo vệ:</span>
        </label>
        <div class="formrow_content">
            <strong class="formrow_text">
                @if (empty($info->email))
                     (Chưa có thông tin)
                @else
                    {{ hideEmail($info->email) }}
                    @if (empty($info->email_verified))
                        <a href="{{route('secure-resend-email')}}">Xác thực</a>
                    @else
                        (Đã xác nhận)
                    @endif
                @endif
            </strong>
        </div>       
        <a href="{{route('secure-update-email')}}" class="formrow_editbtn">Cập nhật</a>
    </div>
    <div class="formrow">
        <a href="javascript:void(0)" id="btn_edit_email" class="formrow_editbtn">Edit</a>
        <label class="formrow_label">
            <span>Mật khẩu bảo mật:</span>
        </label>
        <div class="formrow_content">
            <span style="font-size:12px"><i>
                @if (empty($info->pass2))
                        (Chưa có thông tin)
                @else
                        {{ hidePassword($info->pass2) }}
                @endif</i></span>
            <strong class="formrow_text"></strong>
            
        </div>        
        <a href="{{route('secure-update-pass2')}}"  class="formrow_editbtn">Cập nhật</a>
    </div>
    <div class="formrow">
        <a href="javascript:void(0)" id="btn_edit_email" class="formrow_editbtn">Edit</a>
        <label class="formrow_label">
            <span>Câu hỏi bảo mật:</span>
        </label>
        <div class="formrow_content">
            <span style="font-size:12px"><i>
                @if (empty($info->question) ||
                        empty($info->answer))
                        (Chưa có thông tin)
                @else
                        {{ hidePassword($info->answer) }}
                @endif</i></span>
            <strong class="formrow_text"></strong>
            
        </div>        
        <a href="{{route('secure-update-qna')}}" class="formrow_editbtn">Cập nhật</a>
    </div>
    @endif
    <div class="landing_menu clearfix">
        <div class="menu_cell m05">
            <a href="{{ route('pass-update') }}" title="Đổi mật khẩu">
                <span class="zid_subnav_icon"></span>
                Đổi mật khẩu
            </a>
        </div>
        <div class="menu_cell m04">
            <a href="{{ route('secure') }}" title="Thông tin bảo vệ">
                <span class="zid_subnav_icon"></span>
                Thông tin bảo vệ
            </a>
        </div>
        <div class="menu_cell m01">
            <a href="{{ route('general') }}" title="Thông tin đăng nhập">
                <span class="zid_subnav_icon"></span>
                Thông tin đăng nhập
            </a>
        </div>
        <div class="menu_cell m02">
            <a href="{{ route('personal') }}" title="Thông tin cá nhân">
                <span class="zid_subnav_icon"></span>
                Thông tin cá nhân
            </a>
        </div>

        <div class="menu_cell m06">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); 
            document.getElementById('logout-form').submit();"><span class="zid_subnav_icon"></span> Thoát</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
</div>
@endsection
