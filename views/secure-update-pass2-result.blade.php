@extends('hanoivip::layouts.app-id')

@section('content')
<div class="zid_pagecont">     
    <div class="formrow">  
        Cập nhật mật khẩu bảo mật
    </div>       
    <div class="zidregister_form">
        @if (!empty($message))
        <div class="zidreg_feedback">
            <p><img src="/images/success.png" alt="" width="100"></p>
                {{ $message }}
        </div>
        <p class="align_center">
            <input type="button" class="zidloginnowbtn zidbtn_default" value="Trở về {{ config('id.name.site') }}" onclick="window.location.href = '{{ route("user") }}'">
        </p>
        @endif
        @if (!empty($error_message))
            <div class="zidreg_feedback">
            <p><img src="/images/failure.png" alt="" width="100"></p>            
                {{ $error_message }}                        
        </div>
        @endif
    </div>
</div>
@endsection
