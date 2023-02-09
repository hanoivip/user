<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="description" content="">
		<meta name="keywords" content="">
			<meta property="og:title" content="">
				<meta property="og:description" content="">
					<meta property="og:image" content="">
						<meta name="viewport"
							content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height">
							<link
								href="{{ asset('id/css/touch_style_1.02.css') }}?{Ơtime()}}"
								rel="stylesheet" type="text/css">
								<script src="{{ asset('id/js/jquery-1.9.1.js') }}"
									type="text/javascript"></script>
								<script id="widget-jssdk" async=""
									src="{{ asset('id/js/openwidget4.js?t=9043') }}"></script>
								<script src="{{ asset('id/js/ValidateModel_1.04.js') }}"
									type="text/javascript"></script>
								<script src="{{ asset('id/js/Util_1.01.js') }}"
									type="text/javascript"></script>
								<script type="text/javascript"
									src="{{ asset('id/js/zmCore-1.46.min.js') }}"></script>
								<script type="text/javascript"
									src="{{ asset('id/js/swfobject.js') }}"></script>
								<script type="text/javascript"
									src="{{ asset('id/js/zmxcall.js') }}"></script>
								<script type="text/javascript"
									src="{{ asset('id/js/zm.ui-2.15.min.js') }}"></script>
								<link href="{{ asset('id/css/jcarousel.basic-1.01.css') }}"
									rel="stylesheet" type="text/css">
									<link
										href="{{ asset('id/bootstrap/bootstrap-datetimepicker.css') }}"
										rel="stylesheet" media="screen">
										<script type="text/javascript"
											src="{{ asset('id/bootstrap/bootstrap-datetimepicker.js') }}"
											charset="UTF-8"></script>

										<title>{{ config('id.name.site') }} – Tài khoản {{
											config('id.name.portal') }} của {{ config('id.name.team') }}</title>
										<script type="text/javascript"
											src="{{ asset('id/js/openwidget_config.js') }}"></script>
										<link rel="stylesheet" type="text/css"
											href="{{ asset('id/css/login_widget.css') }}">
											<script id="zmzt" type="text/javascript"
												src="{{ asset('id/js/zt-1.04-1.min.js') }}"></script>
</head>
<body class="zid_register_touch">
	<div class="zid_header">
		<div class="zid_header_inner" style="display:">
			<h1 class="zid_mainlogo2">
				<a class="navbar-brand"
					style="color: #fff; line-height: 30px; background: none;"
					href="{{ route('user') }}">{{ config('id.name.site') }}</a>
			</h1>
		</div>
	</div>
	<div class="zid_pagecont">
    	@if (Auth::check())
    		<h2 class="landing_menu_title" style="text-align: right;">
    			ID: <strong>{{ Auth::user()->getAuthIdentifier() }}</strong>
    				<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">,Thoát
    				</a>
        			<form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">{{ csrf_field() }}</form>
    		</h2>
    	@endif
        @if(isset($message))
            <div style="background-color: green; color: black;">
            {{ $message }}
            </div>
        @endif
        
        @if(isset($error))
            <div style="background-color: red; color: black;">
            {{ $error }}
            </div>
        @endif
		@yield('content')
	</div>
	<p class="text_copyright">Copyright © {{ config('id.name.portal') }}</p>

</body>
</html>