@extends('hanoivip::layouts.app-id')

@section('content')

@if (empty($status))

    @if (empty($default))
    	<p>System error! Plz contact administrator (missing default verify way)</p>
    @else
    	<a href="{{route('twofa.add', ['way' => $default])}}">Turn on</a>
    @endif

@else

    {{-- Show 2fa status --}}
    <script>
    function show_alert(form) {
    	  if(!confirm("Do you really want to do this?")) {
    	    return false;
    	  }
    	  form.submit();
    	}
    </script>
    <form action="{{route('twofa.turnoff')}}" method="post" onsubmit="return show_alert(this);">
    	{{ csrf_field() }}
    	<input type="submit" value="Turn off"/>
    </form>
    
    {{-- Show user ways --}}
    @if (!empty($userWays))
    	<h2>Your verify methods</h1>
    	@foreach ($userWays as $way => $i)
    		<br/>
    		<img src="{{asset('/id/images/success.png')}}" width="32"/>
    		<a href="{{route('twofa.list', ['way' => $way])}}">{{__("hanoivip::twofa.way.protected-" . $way)}}</a>
    	@endforeach
    @else
    <p>User have no way to verify!</p>
    @endif
    
    {{-- Show other ways --}}
    @if (!empty($otherWays))
    <h2>Another verify methods</h2>
    	@foreach ($otherWays as $way => $i)
    		<br/>
    		<a href="{{route('twofa.add', ['way' => $way])}}">{{__("hanoivip::twofa.way." . $way)}}</a>
    	@endforeach
    @endif
    
    {{-- Revoke all device --}}
    <h2>Revoke all devices</h1>
    <form action="{{route('twofa.device.revoke-all')}}" method="post" onsubmit="return show_alert(this);">
    	{{ csrf_field() }}
    	<input type="submit" value="Revoke"/>
    </form>

@endif

@endsection
