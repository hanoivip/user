@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                @if (!empty($message))
                    <span class="help-block">
                        <strong>{{ $message }}</strong>
                    </span>
                @endif
                @if (!empty($error_message))
                    <span class="help-block">
                        <strong>{{ $error_message }}</strong>
                    </span>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
