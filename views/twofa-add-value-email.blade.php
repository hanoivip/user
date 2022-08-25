@extends('hanoivip::layouts.app-id')

@section('content')

<form action="{{route('twofa.add')}}" method="post">
	{{ csrf_field() }}
	<input type="hidden" name="way" id="way" value="{{$way}}"/>
	Enter Email:<input type="text" name="value" id="value" value=""/>
	<button type="submit">Next</button>
</form>

@endsection
