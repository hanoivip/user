@extends('hanoivip::layouts.app-id')

@section('content')

<h2>Please follow 3 steps to reset your password!</h2>

<h3>3. Enter new password</h3>

<br/>
@if (!empty($message))
<span class="help-block" style="color: red;">
    <strong>{{ $message }}</strong>
</span>
@endif
<form action="{{route('forgot.reset')}}" method="post">
	{{ csrf_field() }}
	<input type="hidden" id="username" name="username" value="{{$username}}" />
	<input type="hidden" id="way" name="way" value="{{$way}}" />
	<input type="hidden" id="otp" name="otp" value="{{$otp}}"/>
	<input type="text" id="password" name="password" required autofocus />
	<input type="submit" value="Reset"/>
</form>


@endsection
