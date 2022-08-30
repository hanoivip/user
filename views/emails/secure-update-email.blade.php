<table style="width: 100%" border="0" cellspacing="0" cellpadding="0">
	<tbody>
		<tr>
			<td style="border-bottom: 1px solid #cccccc"><a
				href="{{ route('home') }}" target="_blank"><img title="zing id logo"
					src="{{ asset('img/logo.png') }}" alt="" vspace="10"
					class="m_4832652223584893077CToWUd CToWUd" style="width: 64px; height: 64px;"></a></td>
		</tr>
		<tr>
			<td align="left" height="60">
				<p
					style="margin: 0; font-family: Arial, Helvetica, sans-serif; color: #333333; font-size: 20px; font-weight: 400; text-transform: uppercase">Xác
					thực ĐỊA CHỈ EMAIL</p>
			</td>
		</tr>
		<tr>
			<td height="30">
				<p
					style="margin: 0; font-family: Arial, Helvetica, sans-serif; color: #555; font-size: 13px">
					Chào <strong>{{ $username }}</strong>,
				</p>
			</td>
		</tr>
		<tr>
			<td height="30">
				<p
					style="margin: 0; font-family: Arial, Helvetica, sans-serif; color: #555; font-size: 13px">
					Bạn vừa gửi yêu cầu xác thực email bảo mật trên <strong>{{
						config('id.name.site') }}</strong>.
				</p>
			</td>
		</tr>
		<tr>
			<td height="30">
				<p
					style="margin: 0; font-family: Arial, Helvetica, sans-serif; color: #555; font-size: 13px">Vui
					lòng nhấn vào liên kết bên dưới để hoàn tất quá trình đăng ký.</p>
			</td>
		</tr>
		<tr>
			<td height="60"><a
				href="{{route('secure-verify', [ 'token' => $token ])}}"
				style="margin: 0; font-family: Arial, Helvetica, sans-serif; font-size: 13px">Click
					vào đây</a></td>
		</tr>
		<tr>
			<td height="30">
				<p
					style="margin: 0; font-family: Arial, Helvetica, sans-serif; color: #555; font-size: 13px">
					Nếu không phải bạn thực hiện, vui lòng <strong>KHÔNG</strong> nhấn
					vào đường dẫn trên.
				</p>
			</td>
		</tr>
		<tr>
			<td height="30">
				<p
					style="margin: 0; font-family: Arial, Helvetica, sans-serif; color: red; font-size: 13px">
					Email này có giá trị đến hết ngày {{ $expires }}<span
						style="color: #555">(ngày/tháng/năm).</span>
				</p>
			</td>
		</tr>
		<tr>
			<td height="30">
				<p
					style="margin: 0; font-family: Arial, Helvetica, sans-serif; color: #555; font-size: 13px">Mọi
					thắc mắc xin vào liên liên hệ Fanpage.</p>
			</td>
		</tr>
		<tr>
			<td height="30">
				<p
					style="margin: 0; font-family: Arial, Helvetica, sans-serif; color: #555; font-size: 13px">{{
					config('id.name.site') }} Team</p>
			</td>
		</tr>
		<tr>
		</tr>
	</tbody>
</table>