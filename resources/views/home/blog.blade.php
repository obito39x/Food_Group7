<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Food Website</title>
    <link href="{{ asset('/css/blog/blog.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/menuAccount.css') }}" rel="stylesheet">
    <link rel="short icon" href="image/short_icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('/js/menu.js') }}"></script>
    <script src="{{ asset('/js/blog.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
@extends('layouts.app') <!-- Extend the main layout -->

@section('content')
    <!--Banner-->
@php
    $isLoggedIn = auth()->check();
    $account = auth()->user();
@endphp
    <div class="banner_bg">
        <h1>Our<span>Blog</span></h1>
    </div>
    <!--Blog-->

    <div class="container">
        <a href="{{ route('create_blog') }}" class="btn-create">Create Blog</a>
    </div>
    <div class="main_blog anim">
        <div class="slide_1">
            <div class="blog_box">           
                @foreach ($blogs as $blog)
                
                <div class="blog_card">
                    <div class="blog_image">
                        <img src="{{ $blog->img }}">
                    </div>
                    <div class="blog_tag">
                        <div class="blog-header">
                            <div class="blog_date">
                                <p>{{ $blog->getTimeDiff() }}<i class="fa-solid fa-calendar-days"></i></p>
                            </div>
                            <div class="blog-options">
                                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                <ul class="blog-menu" style="display: none;">
                                @if ($isLoggedIn && $account->user->id_user == $blog->id_user)
                                    <li><a href="#" class="edit-blog" data-blog-id="{{ $blog->id_blog }}">Edit</a></li>
                                    <li><a href="#" class="delete-blog" data-blog-id="{{ $blog->id_blog }}">Delete</a></li>
                                @else
                                    <li><a href="#" class="report-blog" data-blog-id="{{ $blog->id_blog }}">Report</a></li>
                                @endif
                                </ul>
                            </div>
                        </div>
                        <h2 class="blog_heading">
                            <a class="title" href="{{ route('blog.show', $blog->id_blog) }}">{{ $blog->title }}</a>
                        </h2>
                        <form class="edit-blog-form" data-blog-id="{{ $blog->id_blog }}" style="display: none;">
                            <textarea class="form-control edit-blog-text" rows="3">{{ $blog->content }}</textarea>
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" class="btn btn-secondary cancel-edit">Cancel</button>
                        </form>
                        <p class="blog_text">
                            {{ $blog->content }}
                        </p>
                        <hr>
                        <div class="view_and_like">
                            <div class="view">
                            <p id="view-count-{{ $blog->id_blog }}">{{ $blog->view_count }} views</p>
                                <p class="b_com">{{ $blog->comment_count }} comment</p>
                            </div>
                            <div class="like" onclick="toggleLike({{ $blog->id_blog }})">
                                <p id="like-count-{{ $blog->id_blog }}">{{ $blog->like_count }}</p>
                                <i id="like-icon-{{ $blog->id_blog }}" class="{{ $blog->is_liked ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach 
            </div>
        </div>
        
        <div class="slide_2">

            <div class="follow_card">

                <div class="follow_head">
                    <h2 class="most_follow">Followed</h2>
                    <h2 class="follow_view">View All</h2>
                </div>
                
                @foreach($followedUsers as $followedUser)
                    <div class="follow_profiles">
                        @if (!empty($followedUser->img))
                            <img src="{{ $followedUser->img }}" alt="">
                        @else
                            <img src="{{ asset('img_profile/profile.png') }}" alt="logo" class="img">
                        @endif
                        <div class="follow_profile_tag">
                        @if (!empty($followedUser->fullname))
                            <strong>{{ $followedUser->fullname }}</strong>
                        @else
                            <strong>{{ $followedUser->username }}</strong>
                        @endif
                            <p>{{ $followedUser->email }}</p>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>

    </div>

    @endsection