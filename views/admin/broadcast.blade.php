@extends('hanoivip::admin.layouts.admin')

@section('title', 'Boardcast a message')

@section('content')

<h2>Broadcast a system message to all recent-login users</h2>
<form method="POST" action="{{ route('ecmin.broadcast') }}">
	{{ csrf_field() }}
	Message to broadcast: <textarea rows = "5" cols = "60" name = "broadcast" id="broadcast">
    </textarea>
	<button type="submit">OK</button>
</form>

@endsection