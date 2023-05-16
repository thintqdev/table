@extends('emails.layout')

@section('content')
    <p>Xin chào {{ $data['name'] }}</p>
    <p>Bạn đã yêu cầu reset mật khẩu cho tài khoản của mình. Dưới đây là mã xác nhận của bạn:</p>
    <p class="code">{{ $data['code'] }}</p>
    <p>Vui lòng không cấp mã code cho bất kì ai</p>
    <p>Hãy nhập mã này vào trang reset mật khẩu của chúng tôi để hoàn thành quá trình đặt lại mật khẩu.</p>
    <p>Nếu bạn không yêu cầu reset mật khẩu này, vui lòng bỏ qua email này hoặc liên hệ với chúng tôi.</p>
@endsection
