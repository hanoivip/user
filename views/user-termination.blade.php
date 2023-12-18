@extends('hanoivip::layouts.app-id')

@section('content')
<div class="zid_pagecont">
	<h2>App {{config('id.name.portal')}} Developer {{config('id.name.team')}}</h2>
    <h3>User termination request steps</h3>
    <ul>
    	<li>1. Submit the following form</li>
    	<li>2. Our customer service will contact you within 2 business days to confirm your termination request</li>
    	<li>3. Our system will terminate your account within 3 business days since confirmation</li>
    </ul>
    <h3>Termination Form</h3>
    <form method="post" action="{{ route('user.terminate') }}" >
    	{{ csrf_field() }}
    	<label>Username/Email</label>
    	<input type="text" name="usernameOrEmail" /><br/>
    	<label>Reason</label>
    	<input type="text" name="reason" /><br/>
    	<button type="submit">OK</button>
    </form>
</div>

@endsection