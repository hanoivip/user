<table style="width: 100%" border="0" cellspacing="0" cellpadding="0">
	<tbody>
		<tr>
			<td style="border-bottom: 1px solid #cccccc"><a
				href="{{ route('home') }}" target="_blank"><img title="zing id logo"
					src="{{ asset('img/logo-vn1.png') }}" alt="" vspace="10"
					class="m_4832652223584893077CToWUd CToWUd"></a></td>
		</tr>
		<tr>
			<td align="left" height="60">
				<p
					style="margin: 0; font-family: Arial, Helvetica, sans-serif; color: #333333; font-size: 20px; font-weight: 400; text-transform: uppercase">Mã
					OTP</p>
			</td>
		</tr>


		<tr>
			<td height="30">
				<p
					style="margin: 0; font-family: Arial, Helvetica, sans-serif; color: #555; font-size: 13px">
					Mã OTP của bạn là <strong>{{ $otp }}</strong>.
				</p>
			</td>
		</tr>

		<tr>
			<td height="30">
				<p
					style="margin: 0; font-family: Arial, Helvetica, sans-serif; color: red; font-size: 13px">
					Otp sẽ hết hạn sau {{ $expires }} giây!
				</p>
			</td>
		</tr>

	</tbody>
</table>