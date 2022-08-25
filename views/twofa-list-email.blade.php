@extends('hanoivip::layouts.app-id')

@section('content')

@if (!empty($values))

@foreach ($values as $value)
    Email: {{$value->value}} - verified
    <form method="post" action="{{route('twofa.rem')}}">
    	{{ csrf_field() }}
    	<input type="hidden" id="way" name="way" value="{{$way}}"/>
    	<input type="hidden" id="value" name="value" value="{{$value->value}}"/>
    	<button type="submit">Del</button>
    </form>
@endforeach

<a href="{{route('twofa')}}">Back</a>

@endif

@endsection
