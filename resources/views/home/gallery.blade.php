<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Website</title>
    <link href="{{ asset('/css/gallery.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="short icon" href="image/short_icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="{{ asset('/js/menu.js') }}"></script>
</head>
@extends('layouts.app') <!-- Extend the main layout -->

@section('content')
    <!--Banner-->

    <div class="banner_bg">
        <h1>Popular<span>Gallery</span></h1>
    </div>

    <!--Gallery-->

    <div class="gallery anim">

        <div class="gallery_box">
            @foreach ($image_path as $image)
            <div class="gallery_image">
                <img src="{{$image->img}}">
            </div>
            @endforeach
            

        </div>

    </div>
    @endsection