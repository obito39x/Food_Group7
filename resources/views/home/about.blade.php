<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Website</title>
    <link href="{{ asset('/css/about.css') }}" rel="stylesheet">
    <link rel="short icon" href="image/short_icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="{{ asset('/js/menu.js') }}"></script>
</head>
@extends('layouts.app') <!-- Extend the main layout -->

@section('content')

    <!--Banner-->

    <div class="banner_bg">

        <h1><span>About</span>Us</h1>

    </div>




    <!--About-->

    <div class="about anim">

        <div class="about_main">

            <div class="about_image">
                <img src="image/about.png">
            </div>

            <div class="about_text">

                <h3>why food choose us?</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Itaque recusandae dolore tempora fugiat quisquam illum, 
                    veniam adipisci iusto consequuntur porro explicabo 
                    repudiandae nam quis beatae obcaecati. Magnam provident 
                    fuga aspernatur. Lorem ipsum dolor sit amet consectetur 
                    adipisicing elit. Cum minus facilis placeat sint repellendus 
                    dolorum nostrum, corrupti magni ducimus, et neque nihil enim. 
                    Tempore quia rerum placeat laboriosam, sit quasi!
                </p>

                <div class="about_services">

                    <div class="s_1">
                        <i class="fa-solid fa-truck-fast"></i>
                        <a href="#">Fast Delivery</a>
                    </div>

                    <div class="s_1">
                        <i class="fa-brands fa-amazon-pay"></i>
                        <a href="#">Easy Payment</a>
                    </div>

                    <div class="s_1">
                        <i class="fa-solid fa-headset"></i>
                        <a href="#">24 x 7 Services</a>
                    </div>

                </div>

                <a href="#" class="about_btn"><i class="fa-solid fa-burger"></i>Order Now</a>

            </div>

        </div>

    </div>
@endsection