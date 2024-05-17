@extends('admin.dashboard') <!-- Kế thừa layout của trang dashboard -->

@section('content')

<main>
    <div class="head-title">
        <div class="left">
            <h1>Blogs</h1>
            <ul class="breadcrumb">
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li>
                    <a class="active" href="#">Blogs</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="blog_box">
        @foreach($blogs as $blog)
            <div class="blog_card">
                <div class="blog_image">
                    <img src="{{ $blog->img }}">
                </div>
                <div class="blog_tag">
                    <div class="blog-header">
                        <div class="blog_date">
                            <p>{{ $blog->getTimeDiff() }}<i class="fa-solid fa-calendar-days"></i></p>
                        </div>
                    </div>
                    <h2 class="blog_heading">
                        <div class="title">{{ $blog->title }}</div>
                    </h2>
                    <p class="blog_text">
                        {{ $blog->content }}
                    </p>
                </div>
                <div class="blog-status">
                    <form action="{{ route('admin.blogs.approve', $blog->id_blog) }}" method="POST">
                        @csrf
                        <button class="reward-btn" type="submit">
                            <span class="IconContainer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 60 20" class="box-top box">
                                    <path stroke-linecap="round" stroke-width="4" stroke="#6A8EF6" d="M2 18L58 18"></path>
                                    <circle stroke-width="5" stroke="#6A8EF6" fill="#101218" r="7" cy="9.5" cx="20.5">
                                    </circle>
                                    <circle stroke-width="5" stroke="#6A8EF6" fill="#101218" r="7" cy="9.5" cx="38.5">
                                    </circle>
                                </svg>

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 58 44"
                                    class="box-body box">
                                    <mask fill="white" id="path-1-inside-1_81_19">
                                        <rect rx="3" height="44" width="58"></rect>
                                    </mask>
                                    <rect mask="url(#path-1-inside-1_81_19)" stroke-width="8" stroke="#6A8EF6"
                                        fill="#101218" rx="3" height="44" width="58"></rect>
                                    <line stroke-width="6" stroke="#6A8EF6" y2="29" x2="58" y1="29" x1="-3.61529e-09">
                                    </line>
                                    <path stroke-linecap="round" stroke-width="5" stroke="#6A8EF6" d="M45.0005 20L36 3">
                                    </path>
                                    <path stroke-linecap="round" stroke-width="5" stroke="#6A8EF6"
                                        d="M21 3L13.0002 19.9992"></path>
                                </svg>

                                <span class="coin"></span>
                            </span>
                            <span class="text">Approve</span>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</main>


@endsection
<style>
    .blog_box {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 45px 0;
        padding-bottom: 10px;
        padding-top: 20px;
    }

    .blog_box .blog_card {
        width: 450px;
        height: auto;
        border-radius: 10px;
        background: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        margin: 0 auto;
        justify-content: space-between;
        display: flex;
        flex-direction: column;
    }

    .blog_box .blog_card .blog_image {
        width: 450px;
        height: 300px;
        overflow: hidden;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .blog_box .blog_card .blog_image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .blog_box .blog_card .blog_tag .blog_date {
        width: 100%;
        color: #facc22;
        padding: 15px 0 0 20px;
        font-size: 14px;
    }

    .blog_box .blog_card .blog_tag .blog_date i {
        margin-left: 5px;
        font-size: 14px;
        cursor: pointer;
        margin-left: 8px;
    }

    .blog_box .blog_card .blog_tag .blog_heading {
        padding: 10px 20px 10px 20px;
        font-size: 25px;
    }

    .blog_box .blog_card .blog_tag .blog_text {
        padding: 0 20px 10px 20px;
        text-align: justify;
        line-height: 21px;
    }

    .blog_box .blog_card .blog_tag hr {
        width: 95%;
        background: #facc22;
        height: 1px;
        margin: 0 auto;
        border: 0;
        border-radius: 5px;
    }

    .blog_box .blog_card .blog_tag .view_and_like {
        padding: 10px 20px 25px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .blog_box .blog_card .blog_tag .view_and_like .view {
        display: flex;
        align-items: center;
    }

    .blog_box .blog_card .blog_tag .view_and_like .view p {
        margin-right: 10px;
        font-size: 14px;
    }

    .blog_box .blog_card .blog_tag .view_and_like .like {
        display: flex;
        align-items: baseline;
        font-size: 14px;
    }

    .blog_box .blog_card .blog_tag .view_and_like .like i {
        cursor: pointer;
        margin-left: 5px;
    }

    .reward-btn {
        width: 120px;
        height: 40px;
        background-color: #101218;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .IconContainer {
        width: 40px;
        height: 40px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .IconContainer svg {
        width: 40%;
        z-index: 3;
    }

    .box-top {
        transition: all 0.3s;
    }

    .text {
        width: 70px;
        height: 100%;
        font-size: 13px;
        color: #6a8ef6;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        font-weight: 600;
    }

    .reward-btn:hover .IconContainer .box-top {
        transform: translateY(-5px);
    }

    .reward-btn:hover {
        background-color: #202531;
    }

    .reward-btn:hover .coin {
        transform: translateY(-5px);
        transition-delay: 0.2s;
    }

    .coin {
        width: 25%;
        height: 25%;
        background-color: #e4d61a;
        position: absolute;
        border-radius: 50%;
        transition: all 0.3s;
        z-index: 1;
        border: 2px solid #ffe956;
        margin-top: 4px;
    }

    .blog-status {
        justify-content: center;
        display: flex;
        margin-bottom: 5px;
    }
</style>