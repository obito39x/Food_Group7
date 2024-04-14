<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Website</title>
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link rel="short icon" href="{{ asset('image/short_icon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="{{ asset('/js/menu.js') }}"></script>
</head>
@extends('layouts.app') <!-- Extend the main layout -->

@section('content')
    <section id="Home">

        <div class="main anim">

            <div class="main_text">

                <h1>Get Fresh<span> Food</span><br>in a Easy Way</h1>

                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Laborum, minus magnam nobis quam impedit nemo quaerat ex 
                    necessitatibus ipsum totam voluptatum, fugit cupiditate 
                    provident, quasi perspiciatis blanditiis illo nesciunt quae. 
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                    Accusantium odio tenetur laudantium corrupti impedit 
                    quidem dolore beatae, iure labore magni repellendus 
                    inventore, eaque obcaecati commodi ipsa numquam. Accusamus, 
                    molestiae veritatis.
                </p>

                <a href="#" class="btn"><i class="fa-solid fa-burger"></i>Order Now</a>

            </div>

            <div class="main_image">
                <img src="image/main_img.png">
            </div>

        </div>

    </section>




    <!--About-->

    <div class="about">

        <div class="about_main">

            <div class="about_image">
                <img src="image/about.png">
            </div>

            <div class="about_text">

                <h1><span>About</span>Us</h1>
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

                <a href="#" class="about_btn">
                    <i class="fa-solid fa-burger"></i>Order Now
                </a>

            </div>

        </div>

    </div>




    <!--Menu-->

    <div class="menu">

        <h1>Our<span>Menu</span></h1>

        <div class="menu_box">
            @foreach($topRatedProducts as $product)
            <div class="menu_card">

                <div class="menu_img">
                    <img src="{{ $product->image_url}}">
                </div>

                <div class="menu_text">

                    <h2>{{ $product->name }}</h2>
                    <p>
                        {{ $product->description}}
                    </p>

                    <div class="menu_icon">
                        @php
                            $fullStars = floor($product->rating); // Số sao đầy đủ
                            $halfStar = $product->rating - $fullStars; // Phần nửa sao
                            $emptyStars = 5 - ceil($product->rating); // Số sao trống
                        @endphp
                    
                        {{-- Hiển thị sao đầy đủ --}}
                        @for ($i = 0; $i < $fullStars; $i++)
                            <i class="fa-solid fa-star"></i>
                        @endfor
                    
                        {{-- Hiển thị sao nửa --}}
                        @if($halfStar >= 0.5)
                            <i class="fa-solid fa-star-half-stroke"></i>
                        @endif
                    
                        {{-- Hiển thị sao trống --}}
                        @for ($i = 0; $i < $emptyStars; $i++)
                            <i class="fa-solid fa-star-empty"></i>
                        @endfor
                    </div>

                    <p class="price">${{ $product->new_price }}<sub><del>${{ $product->old_price }}</del></sub></p>

                    <a href="#" class="menu_btn"><i class="fa-solid fa-burger"></i>Order Now</a>

                </div>

            </div>
            @endforeach
           
        </div>

    </div>




    <!--Banner-->

    <div class="banner">

        <h1>Special Offer</h1>

        <div class="banner_center">
            <h2>50%<br><span>Off</span></h2>
        </div>

        <a href="#" class="banner_btn"><i class="fa-solid fa-burger"></i>Order Now</a>

    </div>




    <!--Gallery-->

    <div class="gallery">

        <h1>Popular<span>Gallery</span></h1>

        <div class="gallery_box">

            <div class="gallery_image">
                <img src="image/gallery_1.jpg">
            </div>

            <div class="gallery_image">
                <img src="image/gallery_2.jpg">
            </div>

            <div class="gallery_image">
                <img src="image/gallery_3.webp">
            </div>

        </div>

    </div>



    <!--Offer-->

    <div class="offer">

        <div class="offer_box">

            <div class="offer_card_1">

                <div class="offer_img">
                    <img src="image/offer_1.jpg">
                </div>

                <div class="offer_tag">

                    <h2>Triplae Food</h2>
                    <h1>40%</h1>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Itaque quibusdam quas distinctio sit? Corrupti 
                        necessitatibus modi nobis?
                    </p>
                    <a href="#" class="offer_btn"><i class="fa-solid fa-burger"></i>Order Now</a>

                </div>

            </div>

            <div class="offer_card_2">

                <div class="offer_img">
                    <img src="image/offer_2.png">
                </div>

                <div class="offer_tag">

                    <h2>Buy 2 pizza and get a <br>free Drink</h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Itaque quibusdam quas distinctio sit? Corrupti 
                        necessitatibus modi nobis?
                    </p>
                    <a href="#" class="offer_btn"><i class="fa-solid fa-burger"></i>Order Now</a>

                </div>

            </div>

        </div>

    </div>




    <!--Team-->

    <div class="team">

        <h1>Our<span>Team</span></h1>

        <div class="team_line_1"></div>
        <div class="team_line_2"></div>

        <div class="team_box">

            <div class="team_card">

                <div class="team_img">
                    <img src="image/team_1.jpg">
                </div>

                <div class="team_tag">

                    <h2>John Deo</h2>
                    <p class="job">Cook</p>
                    <p class="info">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Accusantium cupiditate deserunt odio in fugiat dolore! 
                        Veniam sit quod iusto quas eligendi. Natus numquam 
                        aspernatur alias illo voluptates dolorem, id ad.
                    </p>

                </div>

            </div>

            <div class="team_card">

                <div class="team_img">
                    <img src="image/team_2.jpg">
                </div>

                <div class="team_tag">

                    <h2>John Deo</h2>
                    <p class="job">Cook</p>
                    <p class="info">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Accusantium cupiditate deserunt odio in fugiat dolore! 
                        Veniam sit quod iusto quas eligendi. Natus numquam 
                        aspernatur alias illo voluptates dolorem, id ad.
                    </p>

                </div>

            </div>

            <div class="team_card">

                <div class="team_img">
                    <img src="image/team_3.jpg">
                </div>

                <div class="team_tag">

                    <h2>John Deo</h2>
                    <p class="job">Cook</p>
                    <p class="info">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Accusantium cupiditate deserunt odio in fugiat dolore! 
                        Veniam sit quod iusto quas eligendi. Natus numquam 
                        aspernatur alias illo voluptates dolorem, id ad.
                    </p>

                </div>

            </div>

            <div class="team_card">

                <div class="team_img">
                    <img src="image/team_4.jpg">
                </div>

                <div class="team_tag">

                    <h2>John Deo</h2>
                    <p class="job">Cook</p>
                    <p class="info">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Accusantium cupiditate deserunt odio in fugiat dolore! 
                        Veniam sit quod iusto quas eligendi. Natus numquam 
                        aspernatur alias illo voluptates dolorem, id ad.
                    </p>

                </div>

            </div>

        </div>

    </div>




    <!--Blog-->

    <div class="blog">

        <h1>Our<span>Blog</span></h1>

        <div class="blog_box">

            <div class="blog_card">

                <div class="blog_img">
                    <img src="image/blog_1.jpeg">
                </div>

                <div class="blog_tag">

                    <div class="blog_date">
                        <p>18 May 2022<i class="fa-solid fa-calendar-days"></i></p>
                    </div>

                    <h3 class="blog_heading">
                        Do Not Leave toko before Eating this remen
                    </h3>

                    <p class="blog_text">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
                        Eos rerum commodi fugiat eum assumenda vel cumque eaque 
                        totam doloribus.
                    </p>

                    <hr>

                    <div class="view_and_like">

                        <div class="view">
                            <p>15.3K Views</p>
                            <p class="b_comm">786 comments</p>
                        </div>

                        <div class="like">
                            <p>3K</p>
                            <i class="fa-regular fa-heart"></i>
                        </div>

                    </div>

                </div>

            </div>

            <div class="blog_card">

                <div class="blog_img">
                    <img src="image/blog_2.jpg">
                </div>

                <div class="blog_tag">

                    <div class="blog_date">
                        <p>18 May 2022<i class="fa-solid fa-calendar-days"></i></p>
                    </div>

                    <h3 class="blog_heading">
                        Do Not Leave toko before Eating this remen
                    </h3>

                    <p class="blog_text">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
                        Eos rerum commodi fugiat eum assumenda vel cumque eaque 
                        totam doloribus.
                    </p>

                    <hr>

                    <div class="view_and_like">

                        <div class="view">
                            <p>15.3K Views</p>
                            <p class="b_comm">786 comments</p>
                        </div>

                        <div class="like">
                            <p>3K</p>
                            <i class="fa-regular fa-heart"></i>
                        </div>

                    </div>

                </div>

            </div>

            <div class="blog_card">

                <div class="blog_img">
                    <img src="image/blog_3.jpg">
                </div>

                <div class="blog_tag">

                    <div class="blog_date">
                        <p>18 May 2022<i class="fa-solid fa-calendar-days"></i></p>
                    </div>

                    <h3 class="blog_heading">
                        Do Not Leave toko before Eating this remen
                    </h3>

                    <p class="blog_text">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
                        Eos rerum commodi fugiat eum assumenda vel cumque eaque 
                        totam doloribus.
                    </p>

                    <hr>

                    <div class="view_and_like">

                        <div class="view">
                            <p>15.3K Views</p>
                            <p class="b_comm">786 comments</p>
                        </div>

                        <div class="like">
                            <p>3K</p>
                            <i class="fa-regular fa-heart"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!--Oder-->

    <div class="oder">

        <h1><span>Oder</span>Now</h1>

        <div class="oder_main">

            <div class="oder_img">
                <img src="image/oder.png">
            </div>

            <div class="oder_form">

                <h2>Home Delivery</h2>

                <div class="oder_list">

                    <div class="oder_left">

                        <p>Full Name</p>
                        <input type="text" placeholder="John Deo">

                        <p>Number</p>
                        <input type="number" placeholder="+94 12 345 6789">

                        <p>Extra food</p>
                        <input type="text" placeholder="with cola">

                        <p>You Address</p>
                        <textarea placeholder="Enter You Address"></textarea>

                    </div>

                    <div class="oder_right">

                        <p>Email</p>
                        <input type="email" placeholder="johndeo123@gmail.com">

                        <p>Food Name</p>
                        <input type="text" placeholder="Pizza">

                        <p>How Much</p>
                        <input type="number" placeholder="3">

                        <p>You Message</p>
                        <textarea placeholder="Enter Your Message"></textarea>

                    </div>

                </div>

                <a href="#" class="oder_btn"><i class="fa-solid fa-burger"></i>Oder Now</a>

            </div>

        </div>

    </div>
    @endsection