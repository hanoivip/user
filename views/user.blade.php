@extends('hanoivip::layouts.app-id')

@section('content')
<div class="zid_pagecont">     
    <h2>Trạng thái an toàn
    	@if ($status)
    		<img src="{{asset('/id/images/success.png')}}" width="32"/>
    	@else
    		<img src="{{asset('/id/images/failure.png')}}" width="32"/>
    	@endif
    </h2>
	
    @include('hanoivip::user-menu')
</div>

@endsection