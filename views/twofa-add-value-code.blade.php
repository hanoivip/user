@extends('hanoivip::layouts.app-id')

@section('content')

<form action="{{route('twofa.add')}}" method="post">
	{{ csrf_field() }}
	<input type="hidden" name="way" id="way" value="{{$way}}"/>
	<button type="submit">Generate</button>
</form>

@endsection
