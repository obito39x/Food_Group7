<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sing Up</title>
    <link href="{{ asset('/css/singup.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="short icon" href="image/short_icon.png">
</head>

<body>
    
    <div class="hero">

        <div class="login_form">

            <h1>Register</h1>

            <form action="" method="post" class="input_box">
            @csrf
                <input type="email" class="field" placeholder="Email" name="email">
                @error('email') 
                    <div style="color: red;">{{ $message }}</div>
                @enderror
                <input type="text" class="field" placeholder="Username" name="username">
                @error('username')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
                <input type="password" class="field" placeholder="Password" name="password" id="password">
                <input type="password" class="field" placeholder="Confirm Password" name="password_confirmation" id="confirm_password">
                @error('password')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
                <input type="checkbox" class="check_box" id="show_password"><label for="show_password"><p>Show Password</p>
                <button type="submit" class="submit_btn" name="submit">Register</button>

                <div class="social_icon">
                    <i class="fa-brands fa-facebook-f"></i>
                    <i class="fa-brands fa-twitter"></i>
                    <i class="fa-brands fa-google"></i>
                </div>

                <div class="tag">
                    <span>New User?</span>
                    <a href="{{ route('login') }}">Log in</a>
                </div>

            </form>

        </div>

    </div>

    <script>
    document.getElementById('show_password').addEventListener('click', function () {
        // Lấy các trường input password
        var password = document.getElementById('password');
        var confirm_password = document.getElementById('confirm_password');

        // Kiểm tra trạng thái của checkbox và thay đổi kiểu của các trường input
        if (this.checked) {
            password.type = 'text';
            confirm_password.type = 'text';
        } else {
            password.type = 'password';
            confirm_password.type = 'password';
        }
    });
    </script>
</body>

</html>