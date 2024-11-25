<!DOCTYPE html>
<html lang="en">

<head>
  @include('admin.users.head')

</head>

<body>
  <div class="v11_16">  
    <div class="login-form">
      <div class="input-info-login">
        <div class="v6_634">ĐĂNG NHẬP</div>
        @include('admin.users.alert')
        <form action="{{ route('admin.users.login.store') }}" method="post">
          @csrf
            <input type="email" name="email" class="email" placeholder="Số điện thoại/Email" required autocomplete="on">
            <input type="password" name="password" class="password" placeholder="Mật khẩu" required>
          <div class="remember-me">
            <div class="rmb-me-position">Lưu đăng nhập</div>
            <input type="checkbox" class="rmb-me-checkbox" >
            <button class="rmb-me-position forgot-password">Quên mật khẩu?</button>
          </div>
          <button type="submit" class="v6_684"><span class="v6_685">ĐĂNG NHẬP</span></button>
        </form>
        <div class="v11_11">CHƯA CÓ TÀI KHOẢN?</div>
        <a href="{{ route('admin.users.register') }}" class="register-btn">ĐĂNG KÝ</a>
      </div>
    </div>
  </div>
</div>
  @include('admin.users.footer')
</body>

</html>
