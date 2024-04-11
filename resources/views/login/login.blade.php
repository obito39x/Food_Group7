<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="{{ asset('/css/login.css') }}" rel="stylesheet">
    <link rel="short icon" href="image/short_icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    <div class="hero">

        <div class="login_form">

            <h1>Login</h1>
            <div class="flash-message">
                @foreach (['danger'] as $msg)
                    @if(Session::has('error'))
                    <p class="alert alert-{{ $msg }}">{{ Session::get('error') }}</p>
                    @endif
                @endforeach
            </div>
            <form action="" method="post" class="input_box">
                @csrf
                <input type="text" class="field" placeholder="User Name" name="username">
                <input type="password" class="field" maxlength="10" placeholder="Password" name="password">
                <input type="checkbox" class="check_box"><p>Remember Password</p>
                <button type="submit" class="submit_btn">Login</button>

                <div class="social_icon">
                    <i class="fa-brands fa-facebook-f"></i>
                    <i class="fa-brands fa-twitter"></i>
                    <i class="fa-brands fa-google"></i>
                </div>

                <div class="tag">
                    <span>New User?</span>
                    <a href="{{ route('singup') }}">Sign Up</a>
                </div>

            </form>
            
        </div>

    </div>
    
</body>
</html>