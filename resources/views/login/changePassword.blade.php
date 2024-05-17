<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="{{ asset('/css/login.css') }}" rel="stylesheet">
    <link rel="short icon" href="image/short_icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="hero">
        <div class="login_form">
            <h1>Change Password</h1>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div style="color: red;">{{ $error }}</div>
                @endforeach
            @endif
            
            <form action="{{ route('changePassword') }}" method="post" class="input_box">
                @csrf
                <input type="password" class="field" placeholder="Current Password" name="current_password" id="current_password">
                <input type="password" class="field" maxlength="10" placeholder="New Password" name="new_password" id="new_password">
                <input type="password" class="field" maxlength="10" placeholder="Confirm Password" name="new_password_confirmation" id="confirm_password">
                <input type="checkbox" class="check_box" id="show_password"><label for="show_password"><p>Show Password</p>
                <button type="submit" class="submit_btn">Change Password</button>
                
            </form>
            
        </div>

    </div>
    <script>
    document.getElementById('show_password').addEventListener('click', function () {
        // Lấy các trường input password
        var current_password = document.getElementById('current_password');
        var new_password = document.getElementById('new_password');
        var confirm_password = document.getElementById('confirm_password');

        // Kiểm tra trạng thái của checkbox và thay đổi kiểu của các trường input
        if (this.checked) {
            current_password.type = 'text';
            new_password.type = 'text';
            confirm_password.type = 'text';
        } else {
            current_password.type = 'password';
            new_password.type = 'password';
            confirm_password.type = 'password';
        }
    });
    </script>

</body>
</html>