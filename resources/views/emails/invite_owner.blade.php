@extends('emails.layout')
@section('content')
    <p>Xin chào,</p>

    <p>Cảm ơn bạn đã đăng ký ứng dụng của chúng tôi. Chúng tôi muốn mời bạn trở thành chủ shop trên ứng dụng của chúng tôi.</p>

    <p>Chúng tôi cung cấp cho bạn một tài khoản để quản lý các shop của bạn. Vui lòng đổi mật khẩu ngay sau khi đăng nhập</p>
    <table>
        <tr>
            <td>Email:</td>
            <td>{{ $data['email'] }}</td>
        </tr>
        <tr>
            <td>Mật khẩu:</td>
            <td>{{ $data['password'] }}</td>
        </tr>
    </table>
    <p>Chúng tôi rất mong sớm nhận được phản hồi từ bạn.</p>
    <p>Trân trọng,</p>
    <p>Đội ngũ hỗ trợ của chúng tôi</p>
@endsection
