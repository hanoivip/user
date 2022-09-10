@extends('hanoivip::layouts.app-id')

@section('content')

<h1>Thank for verification!</h1>
<p>Return home after 3 seconds</p>
<a href="{{route('home')}}">OK</a>

<script>
setTimeout(function(){ window.location = "{{route('home')}}" }, 3000);
</script>

@endsection
