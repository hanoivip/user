@extends('hanoivip::layouts.app-id')

@section('content')

<p>{{__("hanoivip::twofa.verification.$way")}}</p>
<form action="{{route('twofa.verify.do')}}" method="post">
	{{ csrf_field() }}
	<input type="hidden" name="way" id="way" value="{{$way}}"/>
	Enter OTP:<input type="text" name="otp" id="otp" value=""/>
	@if ($errors->has('otp'))
		<p>{{ $errors->first('otp') }}</p>
	@endif
	<button type="submit">OK</button>
</form>

Or choose another verification methods:
<form method="get" action="{{route('twofa.verify')}}" id="ways-form">
	<select id="way" name="way" onchange="document.getElementById('ways-form').submit()">
    	<option value="authenticator" selected={{$way=='authenticator'?'true':'false'}}>Authenticator App</option>
    	<option value="code" selected={{$way=='code'?'true':'false'}}>Backup Codes</option>
    	<option value="email" selected={{$way=='email'?'true':'false'}}>Secure Email</option>
    </select>
</form>

@endsection
