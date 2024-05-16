<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Post</title>
    <link href="{{ asset('/css/blog/post.css') }}" rel="stylesheet">
    <link rel="short icon" href="image/short_icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('/js/menu.js') }}"></script>
    <script src="{{ asset('/js/post.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
@php
    $isLoggedIn = auth()->check();
    $account = auth()->user();
@endphp
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
                                            <p>{{ $blog->getTimeDiff() }}<i class="fa-solid fa-calendar-days"></i></p>
                                        </div>
                                        <div class="blog-options">
                                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                            <ul class="blog-menu" style="display: none;">
                                            @if ($isLoggedIn && $account->user->id_user == $blog->id_user)
                                                <li><a href="#" class="edit-blog" data-blog-id="{{ $blog->id_blog }}">Edit</a></li>
                                                <li><a href="#" class="delete-blog" data-blog-id_blog="{{ $blog->id_blog }}">Delete</a></li>
                                            @else
                                                <li><a href="#" class="report-blog" data-blog-id="{{ $blog->id_blog }}">Report</a></li>
                                            @endif
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="blog-head">
                                        <div class="blog_user">
                                        @if (!empty($blog->user->img))
                                            <img src="{{ $blog->user->img }}" alt="logo" class="img">
                                        @else
                                            <img src="{{ asset('img_profile/profile.png') }}" alt="logo" class="img">
                                        @endif
                                        @if (!empty($blog->user->fullname))
                                            <p class="name">{{ $blog->user->fullname }}</p>
                                        @else
                                            <p class="name">{{ $blog->user->username }}</p>
                                        @endif
                                        </div>
                                        <div class="follow">
                                            @if($isLoggedIn && $account->user->id_user != $blog->id_user)
                                                @if ($account->user->following()->where('following_user_id', $blog->id_user)->exists())
                                                    <button class="follow-btn" data-user-id="{{ $blog->id_user }}">Followed</button>
                                                @else
                                                    <button class="follow-btn" data-user-id="{{ $blog->id_user }}">Follow+</button>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                    <h2 class="blog_heading">
                                        {{ $blog->title }}
                                    </h2>
                                    <p class="blog_text">
                                        {{ $blog->content }}
                                    </p>
                                    <hr>
                                    <div class="view_and_like">
                                        <div class="view">
                                            <p id="view-count-{{ $blog->id_blog }}">{{ $blog->view_count }} views</p>
                                            <p class="b_com" id="comment-count-{{ $blog->id_blog }}">{{ $blog->comment_count }} comments</p>
                                        </div>
                                        <div class="like" onclick="toggleLike({{ $blog->id_blog }})">
                                            <p id="like-count-{{ $blog->id_blog }}">{{ $blog->like_count }}</p>
                                            <i id="like-icon-{{ $blog->id_blog }}" class="{{ $blog->is_liked ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
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
                <form action="/comments/{{ $blog->id_blog }}" method="post" class="mt-4" id="commentForm" data-blog-id="{{ $blog->id_blog }}">
                    @csrf
                    <div class="form-group">
                        <label for="comment">Leave a Comment:</label>
                        <textarea class="form-control" id="comment" rows="3" name="comment"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Comment</button>
                </form>
                <div class="comment-section">
                    @foreach ($blog->comments as $comment)
                    <div class="comment-list">
                        <div class="comment-avatar">
                            <img src="{{ $comment->user->img ?? asset('img_profile/profile.png') }}" alt="avatar" class="img">
                        </div>
                        <div class="comment-content">
                            <div class="comment-header">
                                <p class="comment-user">{{ $comment->user->fullname ?? $comment->user->username }}</p>
                                <div class="comment-options">
                                    <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                    <ul class="comment-menu" style="display: none;">
                                    @if ($isLoggedIn && $account->user->id_user == $comment->user_id)
                                        <li><a href="#" class="edit-comment" data-comment-id="{{ $comment->id }}">Edit</a></li>
                                        <li><a href="#" class="delete-comment" data-comment-id="{{ $comment->id }}">Delete</a></li>
                                    @else
                                        <li><a href="#" class="report-comment" data-comment-id="{{ $comment->id }}">Report</a></li>
                                    @endif
                                    </ul>
                                </div>
                            </div>
                            <p class="comment-time">{{ $comment->getTimeDiff() }}</p>
                            <p class="comment-text">{{ $comment->comment }}</p>
                            <form class="edit-comment-form" data-comment-id="{{ $comment->id }}" style="display: none;">
                                <textarea class="form-control edit-comment-text" rows="3">{{ $comment->comment }}</textarea>
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-secondary cancel-edit">Cancel</button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>