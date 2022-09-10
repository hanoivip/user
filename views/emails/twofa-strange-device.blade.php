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
				<p style="margin: 0; font-family: Arial, Helvetica, sans-serif; color: #333333; font-size: 20px; font-weight: 400; text-transform: uppercase">
					Cảnh báo bảo mật
				</p>
			</td>
		</tr>

		<tr>
			<td height="30">
				<p
					style="margin: 0; font-family: Arial, Helvetica, sans-serif; color: #555; font-size: 13px">
					Tài khoản của bạn vừa được đăng nhập trên 1 thiết bị mới.
				</p>
				<p>Tên thiết bị: {{$name}}</p>
				<p>IP: {{$ip}}</p>
				<p>Nếu không phải là bạn hãy liên hệ fanpage để được hỗ trợ</p>
			</td>
		</tr>

	</tbody>
</table>