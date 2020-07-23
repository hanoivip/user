@extends('hanoivip::layouts.app-id')

@section('content')
<div class="zid_pagecont">
    <div class="formrow">  
         Cập nhật email bảo mật
    </div>  
    <form class="zidregister_form" method="POST" action="{{ route('secure-update-email-result') }}">
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
            @if (!empty($info->email) && !empty($info->email_verified) && $info->email_verified)
            <div class="form_input_wrapper" id="wrap_newpwd">                
                <input id="oldmail" type="text" placeholder="Email hiện tại" class="form_input" name="oldmail" required autofocus>
                @if ($errors->has('oldmail'))
                    <span class="help-block">
                        <strong>{{ $errors->first('oldmail') }}</strong>
                    </span>
                @endif
                       
            </div>
            @endif
            <div class="form_input_wrapper" id="wrap_renewpwd">
                <input id="newmail" type="text" placeholder="Email mới" class="form_input" name="newmail" required>

                @if ($errors->has('newmail'))
                    <span class="help-block">
                        <strong>{{ $errors->first('newmail') }}</strong>
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
                    <input type="button" class="zidregcancelbtn" onclick="window.location = '{{ route("user") }}'" value="Hủy bỏ">
                </p>
                <p class="btn_cell">
                    <input type="submit" class="zidbtn_default" value="Cập nhật">
                </p>
            </div>
        </div>

    </form>  
</div>
@endsection
