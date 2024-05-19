<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Website</title>
    <link href="{{ asset('/css/menuAccount.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="shortcut icon" href="image/short_icon.png">
    <script src="{{ asset('/js/menu.js') }}"></script>
    <link href="{{ asset('/css/layouts.css') }}" rel="stylesheet">
    <link rel="short icon" href="{{ asset('image/short_icon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> <!-- Thêm jQuery -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJmQdW5s2USl6ungjcVLe6iQRbKNOTSWw&callback=initMap" async
        defer></script>
    <script>
        function initMap() {
            var hoChiMinh = {
                lat: 10.852410,
                lng: 106.758740
            };
            var mapOptions = {
                center: hoChiMinh,
                zoom: 15
            };
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);

            var marker = new google.maps.Marker({
                position: hoChiMinh,
                map: map,
                title: 'Hồ Chí Minh'
            });
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>


<body>

    @include('includes.navigation')
    @yield('content')
    @include('includes.footer')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var button = document.getElementById('notification-btn');
            var dropdown = document.getElementById('notification-dropdown');

            if (button && dropdown) {
                button.addEventListener('click', function(event) {
                    dropdown.classList.toggle('active');
                });

                // Đóng dropdown nếu click ra ngoài
                document.addEventListener('click', function(event) {
                    if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                        dropdown.classList.remove('active');
                    }
                });
            }
        });
        $(document).ready(function() {
            $(document).on('click', '.notification-options i', function() {
                $(this).next('.notification-menu').toggle();
            });
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.notification-options').length) {
                    $('.notification-menu').hide();
                }
            });
        });
    </script>
</body>


</html>
