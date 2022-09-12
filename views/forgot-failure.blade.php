@extends('hanoivip::layouts.app-id')

@section('content')


@if (!empty($message))
<span class="help-block" style="color: red;">
    <strong>{{ $message }}</strong>
</span>
@endif

<br/>
<a href="{{route('home')}}">Home</a>

@endsection
