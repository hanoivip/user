@extends('hanoivip::layouts.app-id')

@section('content')

<p>Scan this barcode </p>
{!! QrCode::size(100)->generate($init['qrcode']) !!}

<p>Or add this key: {{$init['key']}}</p>

<form action="{{route('twofa.add')}}" method="post">
	{{ csrf_field() }}
	<input type="hidden" name="way" id="way" value="{{$way}}"/>
	<input type="hidden" name="value" id="value" value="{{$init['key']}}"/>
	<button type="submit">Next</button>
</form>

<a href="{{route('twofa')}}">Cancel</a>

@endsection
