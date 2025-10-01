@component('mail::message')
<h1 align="center">Khôi Phục Mật Khẩu</h1>

<b>Kính gửi quý khách hàng,</b>

Chúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn tại <b><i>Phenikaa Clinic</i></b>.

Để đảm bảo an toàn cho tài khoản, chúng tôi cần bạn xác nhận yêu cầu này bằng cách nhấp vào liên kết hoặc nút bên dưới:
@component('mail::button', ['url' => $url])
Đặt lại mật khẩu
@endcomponent

Nếu nút không hoạt động, bạn có thể sao chép và dán đường dẫn sau vào trình duyệt của mình: <a href="{{$url}}">đường dẫn</a>.

<hr>

<b>Lưu ý quan trọng về bảo mật:<b>
<ol>
    <li>
        <b>Liên kết này chỉ có hiệu lực trong vòng 1 giờ</b>. Nếu quá thời gian này, bạn sẽ cần thực hiện lại quy trình "Quên Mật khẩu". 
    </li>
    <li>
        <b>Nếu bạn không phải là người yêu cầu đặt lại mật khẩu</b>, vui lòng bỏ qua email này. Mật khẩu hiện tại của bạn sẽ không thay đổi. Tuy nhiên, để tăng cường bảo mật, bạn có thể cân nhắc đăng nhập và thay đổi mật khẩu của mình ngay lập tức.
    </li>
</ol>

<hr>
Nếu bạn có bất kỳ thắc mắc nào khác hoặc cần hỗ trợ ngay lập tức, vui lòng liên hệ với bộ phận hỗ trợ của chúng tôi.<br><br>

<b>Trân trọng</b>,<br>
Đội ngũ <b><i>Phenikaa Clinic</i></b><br>
<a href="http://clinic.phenikaa.vn">clinic.phenikaa.vn</a><br>
0123.456.789
@endcomponent
