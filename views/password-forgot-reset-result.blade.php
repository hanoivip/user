@extends('hanoivip::layouts.app-id')

@section('content')

<div class="zid_pagecont">     
    <div class="formrow">  
        Tìm lại mật khẩu
    </div>       
    <div class="zidregister_form">
        @if (empty($error))
        <div class="zidreg_feedback">
            <p><img src="/images/success.jpg" alt="" width="100"></p>
                {{ $message }}
        </div>
        <p class="align_center">
            <input type="button" class="zidloginnowbtn zidbtn_default" value="Trở về {{ config('id.name.site') }}" onclick="window.location.href = '{{ route('user') }}'">
        </p>
        @endif
        @if (!empty($error))
            <div class="zidreg_feedback">
            <p><img src="/images/failure.jpg" alt="" width="100"></p>            
                {{ $message }}                        
        </div>
        @endif
    </div>
</div>

@endsection
