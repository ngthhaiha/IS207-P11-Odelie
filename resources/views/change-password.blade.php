<!DOCTYPE html>
<html>

<head>
    <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet" />
    <link href="change-password.css" rel="stylesheet" />
    <title>Đổi mặt khẩu</title>
</head>

<body>
        <div class="form-change-password">
            <div class="dmk">ĐỔI MẬT KHẨU</div>
            <input type="password" id="old-password" class="input-old-password" placeholder="Mật khẩu cũ &ast;" required>
            <label class="label-old-password" for="old-password">
                <span>Mật khẩu cũ &ast;</span>
            </label>
            <input type="password" id="new-password" class="input-new-password" placeholder="Mật khẩu mới &ast;" required>
            <label class="label-new-password" for="new-password">
                <span>Mật khẩu mới &ast;</span>
            </label>
            <input type="password" id="confirm-password" class="confirm-password" placeholder="Nhập lại mật khẩu mới &ast;" required>
            <label class="label-confirm-password" for="confirm-password">
                <span>Nhập lại mật khẩu mới &ast;</span>
            </label>
            <button class="change-password-button">XÁC NHẬN</button>
        </div>
    </div>
</body>

</html>