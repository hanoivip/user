@extends('hanoivip::layouts.app-id')

@section('content')

<form action="{{route('twofa.verify.do')}}" method="post">
	{{ csrf_field() }}
	Enter OTP:<input type="text" name="otp" id="otp" value=""/>
	@if ($errors->has('otp'))
		<p>{{ $errors->first('otp') }}</p>
	@endif
	<button type="submit">OK</button>
</form>

Another methods:
<select>
	<option>Authenticator App</option>
	<option>Backup Codes</option>
	<option>Secure Email</option>
</select>

@endsection
