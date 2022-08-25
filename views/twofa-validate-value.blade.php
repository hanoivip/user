@extends('hanoivip::layouts.app-id')

@section('content')

<form action="{{route('twofa.validate')}}" method="post">
	{{ csrf_field() }}
	<input type="hidden" name="way" id="way" value="{{$way}}"/>
	<input type="hidden" name="value" id="value" value="{{$value}}"/>
	Enter OTP:<input type="text" name="otp" id="otp" value=""/>
	@if ($errors->has('otp'))
		<p>{{ $errors->first('otp') }}</p>
	@endif
	<button type="submit">OK</button>
</form>

<a href="{{route('twofa')}}">Cancel</a>

@endsection
