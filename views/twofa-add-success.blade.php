@extends('hanoivip::layouts.app-id')

@section('content')

<h1>Add verification method success</h1>
<p>Return home after 3 seconds..</p>
<a href="{{route('twofa')}}">OK</a>

<script>
setTimeout(function(){ window.location = "{{route('twofa')}}" }, 3000);
</script>

@endsection
