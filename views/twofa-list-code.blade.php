@extends('hanoivip::layouts.app-id')

@section('content')

@if (!empty($values))

    <p>Your backup codes</p>
    @foreach ($values as $value)
        @if (empty($value->use_count))
        	<p>{{$value->value}}</p>
        @else
        	<p>-------</p>
        @endif
	@endforeach

    <form method="post" action="{{route('twofa.refresh')}}">
    	{{ csrf_field() }}
    	<input type="hidden" id="way" name="way" value="{{$way}}"/>
    	<input type="hidden" id="value" name="value" value=""/>
    	<button type="submit">Refresh</button>
    </form>
    
    <form method="post" action="{{route('twofa.rem')}}">
    	{{ csrf_field() }}
    	<input type="hidden" id="way" name="way" value="{{$way}}"/>
    	<input type="hidden" id="value" name="value" value=""/>
    	<button type="submit">Del</button>
    </form>
    
    <form method="post" action="{{route('twofa.download')}}">
    	{{ csrf_field() }}
    	<input type="hidden" id="way" name="way" value="{{$way}}"/>
    	<input type="hidden" id="value" name="value" value=""/>
    	<button type="submit">Download</button>
    </form>

@endif
<a href="{{route('twofa')}}">Back</a>

@endsection
