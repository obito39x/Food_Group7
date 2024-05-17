<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Create Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="{{ asset('/css/blog/create_blog.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    @extends('layouts.app') <!-- Extend the main layout -->

    @section('content')
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section style="padding: 100px 0 50px 0;">
        <div class="container">
            <div class="wrapper">
                <section class="post">
                    <header>Create Post</header>
                    <form action="{{ route('blog.add') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="content">
                            @if (!empty($user->img))
                                <img src="{{ $user->img }}" alt="logo" class="img">
                            @else
                                <img src="{{ asset('img_profile/profile.png') }}" alt="logo" class="img">
                            @endif
                            @if(!empty($user->fullname))
                                <div class="details">
                                    <p>{{ $user->fullname }}</p>
                                </div>
                            @else
                                <div class="details">
                                    <p>{{ $user->username }}</p>
                                </div>
                            @endif
                        </div>
                        <input type="text" name="title" id="tilte" placeholder="Title" class="no-border">
                        <textarea placeholder="What are you thinking?" spellcheck="false" required
                            name="content"></textarea>
                        <div class="image-preview-container">
                            <img id="preview" src="" alt="Image Preview">
                        </div>

                        <div class="foot">
                            <div class="options">
                                <p>Add to Your Post</p>
                                <ul class="list">
                                    <label class="">
                                        <li>
                                            <img src="{{ asset('icons/gallery.svg') }}" alt="gallery">
                                            <input type="file" id="edit_image" name="img" class="input-file"
                                                accept="image/*">
                                        </li>
                                    </label>
                                </ul>
                            </div>
                            <button type="submit">Post</button>
                        </div>
                    </form>
                </section>

            </div>
        </div>
    </section>

    @endsection

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const editImageInput = document.getElementById('edit_image');
            const imagePreviewContainer = document.querySelector('.image-preview-container');
            const preview = document.getElementById('preview');

            editImageInput.addEventListener('change', function (event) {
                const [file] = event.target.files;
                if (file) {
                    preview.src = URL.createObjectURL(file);
                    imagePreviewContainer.style.display = 'block';
                } else {
                    imagePreviewContainer.style.display = 'none';
                }
            });
        });


    </script>