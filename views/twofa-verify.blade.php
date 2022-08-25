@extends('hanoivip::layouts.app-id')

@section('content')

<p>We detect a new device logging to your account. Please do verification:</p>
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
<select>
	<option>Authenticator App</option>
	<option>Backup Codes</option>
	<option>Secure Email</option>
</select>

@endsection
