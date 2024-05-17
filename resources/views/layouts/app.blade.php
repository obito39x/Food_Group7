<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Website</title>
    <link href="{{ asset('/css/layouts.css') }}" rel="stylesheet">
    <link rel="short icon" href="{{ asset('image/short_icon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    @include('includes.navigation') 
    @yield('content') 
    @include('includes.footer') 
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var button = document.getElementById('notification-btn');
            var dropdown = document.getElementById('notification-dropdown');

            button.addEventListener('click', function (event) {
                dropdown.classList.toggle('active');
            });

            // Đóng dropdown nếu click ra ngoài
            document.addEventListener('click', function (event) {
                if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                    dropdown.classList.remove('active');
                }
            });
        });
        $(document).ready(function () {
            $(document).on('click', '.notification-options i', function () {
                $(this).next('.notification-menu').toggle();
            });
            $(document).on('click', function (e) {
                if (!$(e.target).closest('.notification-options').length) {
                    $('.notification-menu').hide();
                }
            });
        });

    </script>
</body>

</html>