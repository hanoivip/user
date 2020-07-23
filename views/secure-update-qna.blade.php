@extends('hanoivip::layouts.app-id')

@section('content')
<div class="zid_pagecont">
    <div class="formrow">  
        Đổi câu hỏi bảo mật
    </div>  
    <form class="zidregister_form" method="POST" action="{{ route('secure-update-qna-result') }}">
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
            @if (!empty($info->question) && !empty($info->answer))
                <div class="form_input_wrapper">
                    <select name="oldquestion" id="oldquestion" class="form_input">
                            <option value="-1">Chọn câu hỏi hiện tại</option>
                            @if (isset($questions))
                                @for ($i=0; $i<count($questions); ++$i)
                                    <option value="{{$questions[$i][0]}}">{{$questions[$i][1]}}</option>
                                @endfor
                            @endif
                        </select>

                    @if ($errors->has('oldquestion'))
                        <span class="help-block">
                            <strong>{{ $errors->first('oldquestion') }}</strong>
                        </span>
                    @endif
                </div>
                
                <div class="form_input_wrapper">
                    <input id="oldanswer" type="text" placeholder="Trả lời hiện tại" class="form_input" name="oldanswer" required autofocus>

                    @if ($errors->has('oldanswer'))
                        <span class="help-block">
                            <strong>{{ $errors->first('oldanswer') }}</strong>
                        </span>
                    @endif
                </div>
            @endif
            <div class="form_input_wrapper">
                <select name="newquestion" id="newquestion" class="form_input">
                        <option value="-1">Chọn câu hỏi mới</option>
                        @if (isset($questions))
                            @for ($i=0; $i<count($questions); ++$i)
                                <option value="{{$questions[$i][0]}}">{{$questions[$i][1]}}</option>
                            @endfor
                        @endif
                    </select>

                @if ($errors->has('newquestion'))
                    <span class="help-block">
                        <strong>{{ $errors->first('newquestion') }}</strong>
                    </span>
                @endif
            </div>
             <div class="form_input_wrapper">
                    <input id="newanswer" type="text" placeholder="Trả lời mới" class="form_input" name="newanswer" required autofocus>

                    @if ($errors->has('newanswer'))
                        <span class="help-block">
                            <strong>{{ $errors->first('newanswer') }}</strong>
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
