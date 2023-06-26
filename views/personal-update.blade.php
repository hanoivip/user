@extends('hanoivip::layouts.app-id')

@section('content')
<div class="zid_pagecont">
    <h2 class="content_title"><span class="titlebullet zidsprt"></span>Cập nhật thông tin cá nhân</h2>
    	<form class="form-horizontal" method="POST" action="{{ route('personal-update-result') }}">
            {{ csrf_field() }}
                
            <div class="form_input_grp{{ $errors->has('hoten') ? ' has-error' : '' }}">
            
                <input id="hoten" type="text" placeholder="Họ Tên" class="form_input" name="hoten" value="{{ old('hoten') }}" required autofocus>

                @if ($errors->has('hoten'))
                    <span class="help-block">
                        <strong>{{ $errors->first('hoten') }}</strong>
                    </span>
                @endif
            </div>
            
            <div class="form_input_grp{{ $errors->has('sex') ? ' has-error' : '' }}">
                <select name="sex" id="sex" class="form_input">
                        <option value="-1">Chọn giới tính</option>
                        @if (isset($sexs))
                            @foreach ($sexs as $sex)
                                <option value="{{$sex[0]}}" {{ old('sex') == $sex[0] ? 'selected' : '' }}>{{$sex[1]}}</option>
                            @endforeach
                        @endif
                </select>

                @if ($errors->has('sex'))
                    <span class="help-block">
                        <strong>{{ $errors->first('sex') }}</strong>
                    </span>
                @endif
            </div>
            
            <div class="form_input_grp{{ $errors->has('birthay') ? ' has-error' : '' }}">
                <input id="birthday" type="date" class="form_input" placeholder="Ngày sinh" name="birthday" required autofocus>
                
                </script>
                @if ($errors->has('birthay'))
                    <span class="help-block">
                        <strong>{{ $errors->first('birthay') }}</strong>
                    </span>
                @endif
            </div>
            
            <div class="form_input_grp{{ $errors->has('address') ? ' has-error' : '' }}">                            
                <input id="address" type="text" placeholder="Địa Chỉ" class="form_input" name="address" value="{{ old('address') }}" required autofocus>

                @if ($errors->has('address'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
            </div>
                
                
            <div class="form_input_grp{{ $errors->has('city') ? ' has-error' : '' }}">
                <select name="city" id="city" class="form_input">
                        <option value="-1">Chọn thành phố</option>
                        @if (isset($cities))
                            @foreach ($cities as $city)
                                <option value="{{$city[0]}}" {{ old('city') == $city[0] ? 'selected' : '' }}>{{$city[1]}}</option>
                            @endforeach
                        @endif
                    </select>

                @if ($errors->has('city'))
                    <span class="help-block">
                        <strong>{{ $errors->first('city') }}</strong>
                    </span>
                @endif
            </div>
            
            <div class="form_input_grp{{ $errors->has('career') ? ' has-error' : '' }}">
                
                    <select name="career" id="career" class="form_input">
                            <option value="-1">Chọn nghề nghiệp</option>
                            @if (isset($careers))
                                @foreach ($careers as $career)
                                    <option value="{{$career[0]}}" {{ old('career') == $career[0] ? 'selected' : '' }}>{{$career[1]}}</option>
                                @endforeach
                            @endif
                        </select>

                    @if ($errors->has('career'))
                        <span class="help-block">
                            <strong>{{ $errors->first('career') }}</strong>
                        </span>
                    @endif
            </div>
            
            <div class="form_input_grp{{ $errors->has('marriage') ? ' has-error' : '' }}">
                <select name="marriage" id="marriage" class="form_input" >
                    <option value="-1">Chọn tình trạng hôn nhân</option>
                    @if (isset($marriages))
                        @foreach ($marriages as $marriage)
                            <option value="{{$marriage[0]}}" {{ old('marriage') == $marriage[0] ? 'selected' : '' }}>{{$marriage[1]}}</option>
                        @endforeach
                    @endif
                </select>

                @if ($errors->has('marriage'))
                    <span class="help-block">
                        <strong>{{ $errors->first('marriage') }}</strong>
                    </span>
                @endif
            </div>
            
            <div class="form_input_grp{{ $errors->has('captcha') ? ' has-error' : '' }}">
                	<input id="captcha" type="text" name="captcha" required class="form_input" placeholder="Captcha">
                	<img src="{{ captcha_src() }}" alt="captcha"/>
                	@if ($errors->has('captcha'))
                        <span class="help-block">
                            <strong>{{ $errors->first('captcha') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            <div class="form_input_grp">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="zidbtn_default">
                        Cập nhật
                    </button>
                </div>
            </div>
            
        </form> 
</div>
@endsection
