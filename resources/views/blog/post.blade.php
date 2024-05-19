<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Post</title>
    <link href="{{ asset('/css/blog/post.css') }}" rel="stylesheet">
    <link rel="short icon" href="image/short_icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('/js/menu.js') }}"></script>
    <script src="{{ asset('/js/post.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    @extends('layouts.app') <!-- Extend the main layout -->

    @section('content')
        @php
            $isLoggedIn = auth()->check();
            $account = auth()->user();
        @endphp
        <section style="padding: 100px 0 50px 0;">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-8">
                        <div class="main_blog anim">
                            <div class="slide_1">
                                <div class="blog_box">
                                    <div class="blog_card">
                                        <div class="blog_image">
                                            <img src="{{ $blog->img }}">
                                        </div>
                                        <div class="blog_tag">
                                            <div class="blog-header">
                                                <div class="blog_date">
                                                    <p>{{ $blog->getTimeDiff() }}<i class="fa-solid fa-calendar-days"></i>
                                                    </p>
                                                </div>
                                                <div class="blog-options">
                                                    <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                    <ul class="blog-menu" style="display: none;">
                                                        @if ($isLoggedIn && $account->user->id == $blog->id_user)
                                                            <li><a href="#" class="edit-blog"
                                                                    data-blog-id="{{ $blog->id_blog }}">Edit</a></li>
                                                            <li><a href="#" class="delete-blog"
                                                                    data-blog-id="{{ $blog->id_blog }}">Delete</a></li>
                                                        @else
                                                            <li><a href="#" class="report-blog"
                                                                    data-blog-id="{{ $blog->id_blog }}">Report</a></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="blog-head">
                                                <div class="blog_user">
                                                    @if (!empty($blog->user))
                                                        @if (!empty($blog->user->img))
                                                            <img src="{{ $blog->user->img }}" alt="logo" class="img">
                                                        @else
                                                            <img src="{{ asset('img_profile/profile.png') }}"
                                                                alt="logo" class="img">
                                                        @endif
                                                        @if (!empty($blog->user->fullname))
                                                            <p class="name">{{ $blog->user->fullname }}</p>
                                                        @else
                                                            <p class="name">{{ $blog->user->username }}</p>
                                                        @endif
                                                    @else
                                                        <!-- Handle case when $blog->user is null -->
                                                    @endif
                                                </div>
                                                <div class="follow">
                                                    @if ($isLoggedIn && $account->user->id != $blog->id_user)
                                                        @if ($account->user->following()->where('following_user_id', $blog->id_user)->exists())
                                                            <button class="follow-btn"
                                                                data-user-id="{{ $blog->id_user }}">Followed</button>
                                                        @else
                                                            <button class="follow-btn"
                                                                data-user-id="{{ $blog->id_user }}">Follow+</button>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                            <h2 class="blog_heading">
                                                {{ $blog->title }}
                                            </h2>
                                            <form class="edit-blog-form" data-blog-id="{{ $blog->id_blog }}"
                                                style="display: none;">
                                                <textarea class="form-control edit-blog-text" rows="3">{{ $blog->content }}</textarea>
                                                <button type="submit" class="btn-save">Save</button>
                                                <button type="button" class="btn-cancel cancel-edit">Cancel</button>
                                            </form>
                                            <p class="blog_text">
                                                {{ $blog->content }}
                                            </p>
                                            <hr>
                                            <div class="view_and_like">
                                                <div class="view">
                                                    <p id="view-count-{{ $blog->id_blog }}">{{ $blog->view_count }} views
                                                    </p>
                                                    <p class="b_com" id="comment-count-{{ $blog->id_blog }}">
                                                        {{ $blog->comment_count }} comments
                                                    </p>
                                                </div>
                                                <div class="like" onclick="toggleLike({{ $blog->id_blog }})">
                                                    <p id="like-count-{{ $blog->id_blog }}">{{ $blog->like_count }}</p>
                                                    @if ($blog_like)
                                                        <i id="like-icon-{{ $blog->id_blog }}"
                                                            class="fa-solid fa-heart"></i>
                                                    @else
                                                        <i id="like-icon-{{ $blog->id_blog }}"
                                                            class="fa-regular fa-heart"></i>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 comment">
                        <h3>Comments</h3>
                        <form action="/comments/{{ $blog->id_blog }}" method="post" class="mt-4" id="commentForm"
                            data-blog-id="{{ $blog->id_blog }}">
                            @csrf
                            <div class="text-box">
                                <div class="box-container">
                                    <textarea placeholder="Reply" id="comment" name="comment"></textarea>
                                    <div>
                                        <button type="submit" class="send" title="Send" id="submitBtn">
                                            <svg fill="none" viewBox="0 0 24 24" height="18" width="18"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5"
                                                    stroke="#ffffff" d="M12 5L12 20"></path>
                                                <path stroke-linejoin="round" stroke-linecap="round" stroke-width="2.5"
                                                    stroke="#ffffff"
                                                    d="M7 9L11.2929 4.70711C11.6262 4.37377 11.7929 4.20711 12 4.20711C12.2071 4.20711 12.3738 4.37377 12.7071 4.70711L17 9">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>
                        <div class="comment-section">
                            @foreach ($blog->comments as $comment)
                                <div class="comment-list">
                                    <div class="comment-container">
                                        <div class="user">
                                            <div class="user-pic">
                                                @if (!empty($comment->user->img))
                                                    <div class="comment-avatar">
                                                        <img src="{{ $comment->user->img }}" alt="avatar">
                                                    </div>
                                                @else
                                                    <svg fill="none" viewBox="0 0 24 24" height="20"
                                                        width="20" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linejoin="round" fill="#707277"
                                                            stroke-linecap="round" stroke-width="2" stroke="#707277"
                                                            d="M6.57757 15.4816C5.1628 16.324 1.45336 18.0441 3.71266 20.1966C4.81631 21.248 6.04549 22 7.59087 22H16.4091C17.9545 22 19.1837 21.248 20.2873 20.1966C22.5466 18.0441 18.8372 16.324 17.4224 15.4816C14.1048 13.5061 9.89519 13.5061 6.57757 15.4816Z">
                                                        </path>
                                                        <path stroke-width="2" fill="#707277" stroke="#707277"
                                                            d="M16.5 6.5C16.5 8.98528 14.4853 11 12 11C9.51472 11 7.5 8.98528 7.5 6.5C7.5 4.01472 9.51472 2 12 2C14.4853 2 16.5 4.01472 16.5 6.5Z">
                                                        </path>
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="user-info">
                                                <span>{{ $comment->user->fullname ?? $comment->user->username }}</span>
                                                <p>{{ $comment->getTimeDiff() }}</p>
                                            </div>
                                            <div class="comment-options">
                                                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                                <ul class="comment-menu" style="display: none;">
                                                    @if ($isLoggedIn && $account->user->id == $comment->user_id)
                                                        <li><a href="#" class="edit-comment"
                                                                data-comment-id="{{ $comment->id }}">Edit</a></li>
                                                        <li><a href="#" class="delete-comment"
                                                                data-comment-id="{{ $comment->id }}">Delete</a></li>
                                                    @else
                                                        <li><a href="#" class="report-comment"
                                                                data-comment-id="{{ $comment->id }}">Report</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="comment-content">
                                            <p class="comment-text">
                                                {{ $comment->comment }}
                                            </p>
                                            <form class="edit-comment-form" data-comment-id="{{ $comment->id }}"
                                                style="display: none;">
                                                <textarea class="form-control edit-comment-text" rows="3">{{ $comment->comment }}</textarea>
                                                <button type="submit" class="btn-save">Save</button>
                                                <button type="button" class="btn-cancel cancel-edit">Cancel</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>

        </section>
    @endsection
