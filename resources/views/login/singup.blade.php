<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <input type="text" class="field" placeholder="Name" name="username">
                <input type="password" class="field" placeholder="Password" maxlength="10" name="password">
                <!-- <input type="confirmPassword" class="field" placeholder="Confirm Password" maxlength="10" name="confirmPassword"> -->
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
</html>