<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Create Blog</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="{{ asset('/css/blog/create_blog.css') }}" rel="stylesheet">
</head>

<body>
@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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
                    <textarea placeholder="What are you thinking?" spellcheck="false" required name="content"></textarea>
                    <img id="preview" src="" alt="Image Preview" style="max-width: 100%; display: none;">
                    
                    <div class="options">
                        <p>Add to Your Post</p>
                        <ul class="list">
                            <label class="">
                                <li>
                                    <img src="{{ asset('icons/gallery.svg') }}" alt="gallery">
                                    <input type="file" id="edit_image" name="img" class="input-file"  >
                                </li>
                            </label>
                        </ul>
                    </div>
                    <button type="submit">Post</button>
                </form>
            </section>
           
        </div>
    </div>

    <script>
        const container = document.querySelector(".container"),
            privacy = container.querySelector(".post .privacy"),
            arrowBack = container.querySelector(".audience .arrow-back");

        privacy.addEventListener("click", () => {
            container.classList.add("active");
        });

        arrowBack.addEventListener("click", () => {
            container.classList.remove("active");
        });
    </script>

</body>

</html>