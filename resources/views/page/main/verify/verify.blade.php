{{-- Welcome, {{ $name }}
Please active your account: {{route('get-page-verify',['code' => $code])}} --}}

Welcome {{ $name}},<br>
Please active your account:  <a href="{{route('get-page-verify',['code' => $code])}}">CLICK HERE</a>
Thank for using our service! 
Best regards,
Localif3