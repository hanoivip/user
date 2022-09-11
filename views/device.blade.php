@extends('hanoivip::layouts.app-id')

@section('content')

@if (!empty($devices))
	@foreach ($devices as $device)
		<div>
			<h2>Device: {{json_decode($device->device_info, true)['name']}}</h2>
			<p>OS: {{json_decode($device->device_info, true)['os']}}, Ip: {{json_decode($device->device_info, true)['ip']}}</p>
			<form method="post" action="{{route('twofa.device.revoke')}}">
			{{ csrf_field() }}
				<input type="hidden" id="deviceId" name="deviceId" value="{{$device->device_id}}"/>
				<button type="submit">Revoke</button>
		</div>
	@endforeach
	
@else
	<p>Have no devices</p>
@endif

@endsection