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
                <input type="password" class="field" placeholder="Password" name="password">
                <input type="password" class="field" placeholder="Confirm Password" name="password_confirmation">
                @error('password')
                    <div style="color: red;">{{ $message }}</div>
                @enderror
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

</body>
<!-- <script>
    window.onload = function() {
        var form = document.querySelector("form");
        form.addEventListener('submit', function(event) {
            var password = document.querySelector('input[name="password"]').value;
            var confirmPassword = document.querySelector('input[name="confirmPassword"]').value;

            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                event.preventDefault(); // Ngăn chặn form được gửi đi nếu mật khẩu không khớp
            }
        });
    };

    document.addEventListener("DOMContentLoaded", function() {
    const usernameInput = document.querySelector('input[name="username"]');
    const emailInput = document.querySelector('input[name="email"]');
    const form = document.querySelector('form');
    
    function checkCredentials() {
        fetch('{{ route('check-credentials') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                username: usernameInput.value,
                email: emailInput.value
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.username_exists) {
                alert('Username already exists.');
            }
            if (data.email_exists) {
                alert('Email already exists.');
            }
        })
        .catch(error => console.error('Error:', error));
    }

    usernameInput.addEventListener('blur', checkCredentials);
    emailInput.addEventListener('blur', checkCredentials);
});
</script> -->

</html>