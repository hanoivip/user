@extends('hanoivip::layouts.app-id')

@section('content')

<h2>Please follow 3 steps to reset your password!</h2>

<h3>1. What account did you forgot?</h3>

@if (!empty($message))
<span class="help-block" style="color: red;">
    <strong>{{ $message }}</strong>
</span>
@endif
<form action="{{route('forgot')}}" method="post">
	{{ csrf_field() }}
	Enter your username:<input type="text" id="username" name="username" value="{{ old('username') }}" required autofocus/>
	<input type="submit" value="Next"/>
</form>

@if($errors->any())
    <div class="alert alert-danger">
        <p><strong>Opps Something went wrong</strong></p>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

@endsection
