@extends('layouts.app')

@section('content')
<div class="zid_pagecont">     
    <div class="formrow">  
        Đổi Mật Khẩu
    </div>       
    <div class="zidregister_form">
        @if (!empty($message))
        <div class="zidreg_feedback">
            <p><img src="https://stc-id.zing.vn/touch/images/smiley.png" alt="" width="100"></p>
                {{ $message }}
        </div>
        <p class="align_center">
            <input type="button" class="zidloginnowbtn zidbtn_default" value="Trở về {{ config('id.name.site') }}" onclick="window.location.href = '{{ route("home") }}'">
        </p>
        @endif
        @if (!empty($error_message))
            <div class="zidreg_feedback">
            <p><img src="https://stc-id.zing.vn/touch/images/smiley.png" alt="" width="100"></p>            
                {{ $error_message }}                        
        </div>
        @endif
    </div>
</div>
@endsection
