@extends('hanoivip::layouts.app-id')

@section('content')

<h2>Please follow 3 steps to reset your password!</h2>

<h3>2. Enter verification code?</h3>

<br/>
<p>{{__("hanoivip::twofa.forgot.$way")}}</p>

<br/>
@if (!empty($message))
<span class="help-block" style="color: red;">
    <strong>{{ $message }}</strong>
</span>
@endif
<form action="{{route('forgot.checkotp')}}" method="post">
	{{ csrf_field() }}
	<input type="hidden" id="username" name="username" value="{{$username}}" />
	<input type="hidden" id="way" name="way" value="{{$way}}" />
	Enter OTP: <input type="text" id="otp" name="otp" value="" required autofocus/>
	@if ($errors->has('otp'))
        <span class="help-block">
            <strong>{{ $errors->first('otp') }}</strong>
        </span>
    @endif
	<input type="submit" value="Next"/>
</form>

<br/>
<p>Or choose another verification method:</p>
<form method="post" action="{{route('forgot.otp')}}" id="ways-form">
	{{ csrf_field() }}
	<input type="hidden" id="username" name="username" value="{{$username}}" />
	<select id="way" name="way" onchange="document.getElementById('ways-form').submit()">
	@foreach ($ways as $i => $j)
		<option value="{{$i}}" {{$i==$way?'selected':''}}>{{$i}}</option>
	@endforeach
    </select>
</form>

@endsection
