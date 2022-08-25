@extends('hanoivip::layouts.app-id')

@section('content')

@if (!empty($devices))
	@foreach ($devices as $device)
		{{ $device->device_id }}
	@endforeach
	
@else
	<p>Have no devices</p>
@endif

@endsection