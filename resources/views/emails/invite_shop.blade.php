@extends('emails.layout')

@section('content')
    <table>
        <tr>
            <td>
                <h1>Thông tin cửa hàng của bạn</h1>
                <p>Xin chào {{ $data['representative_name'] }},</p>
                <p>Cảm ơn bạn đã đăng ký sử dụng dịch vụ của chúng tôi.</p>
                <p>Dưới đây là thông tin của cửa hàng của bạn:</p>
                <table>
                    <tr>
                        <td>Tên cửa hàng:</td>
                        <td>{{ $data['shop_name'] }}</td>
                    </tr>
                    <tr>
                        <td>Địa chỉ:</td>
                        <td>{{ $data['address'] }}</td>
                    </tr>
                    <tr>
                        <td>Số điện thoại:</td>
                        <td>{{ $data['phone'] }}</td>
                    </tr>
                    @if (!empty($data['fax']))
                    <tr>
                        <td>Fax:</td>
                        <td>{{ $data['fax'] }}</td>
                    </tr>
                    @endif
                    @if (!empty($data['facebook_url']))
                    <tr>
                        <td>Facebook url:</td>
                        <td>{{ $data['facebook_url'] }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td>Email:</td>
                        <td>{{ $data['email'] }}</td>
                    </tr>
                </table>
                <p>Chúng tôi cung cấp cho bạn một tài khoản admin để quản lý shop của bạn. Vui lòng đổi mật khẩu ngay sau khi login</p>
                <table>
                    <tr>
                        <td>Email:</td>
                        <td>{{ $data['email'] }}</td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td>{{ $data['password'] }}</td>
                    </tr>
                </table>
                <p>Chúng tôi rất mong sớm nhận được phản hồi từ bạn.</p>
                <p>Trân trọng,</p>
                <p>Đội ngũ hỗ trợ của chúng tôi</p>
            </td>
        </tr>
    </table>
@endsection
