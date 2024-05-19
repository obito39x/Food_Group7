<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Website</title>
    <link href="{{ asset('/css/profile.css') }}" rel="stylesheet">
    <link rel="short icon" href="{{ asset('image/short_icon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="{{ asset('/js/menu.js') }}"></script>
    <script src="{{ asset('/js/profile.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<style>
    section{
        background-image: url('image/bg.png');
    }
</style>
<body>
    @extends('layouts.app')
    <!-- profile -->
    @section('content')
    <section class="" style="padding: 100px 0 50px 0;">
        <form action="{{ route('profile.update', $profile->id_user) }}" method="post" enctype="multipart/form-data"
            id="profileForm">
            @csrf
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="text-center">
                            @if(!empty($profile->img))
                                <img id="preview-image" src="{{ $profile->img }}" alt="User Image"
                                    class="img-fluid profile-image mb-3" style="width: 150px; height: 150px;">
                            @else
                                <img id="preview-image" src="{{ asset('img_profile/profile.png') }}" alt="Default Image"
                                    class="img-fluid profile-image mb-3" style="width: 150px; height: 150px;">
                            @endif
                            @if(!empty($profile->fullname))
                                <h4>{{ $profile->fullname }}</h4>
                            @else
                                <h4>{{ $profile->username }}</h4>
                            @endif
                            <label class="btnn img">
                                Edit Image
                                <input type="file" id="edit_image" name="image" class="input-file" disabled>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="d-lex justify-content-between align-items-center mb-4">
                            <h2 class="fw-bold text-uppercase">Profile</h2>
                        </div>
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div style="color: red;">{{ $error }}</div>
                            @endforeach
                        @endif
                        <div class="row mt-4">
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Username:</label>
                                <input type="text" class="form-control" name="username" id="username"
                                    value="{{ $profile->username }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">FullName:</label>
                                <input type="text" class="form-control" name="fullname" id="fullname"
                                    value="{{ $profile->fullname }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Email:</label>
                                <input type="text" class="form-control" name="email" id="email"
                                    value="{{ $profile->email }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="" class="form-label">Phone Number:</label>
                                <input type="number" class="form-control" name="phone_number" id="phone"
                                    value="{{ $profile->phone_number }}" readonly>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="ngaySinh" class="form-label" min="1997-01-01" max="2030-12-31"
                                    placeholder="dd-mm-yyyy">Day of
                                    Birth:</label>
                                <input type="date" class="form-control" id="date" name="date_user"
                                    value="{{ $profile->date_user }}" readonly>

                            </div>
                            <div class="col-md-1 mb-3">
                                <label class="form-label">Gender:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="nam" value="nam"
                                        {{ $profile->gender == 'nam' ? 'checked' : '' }} disabled>
                                    <label class="form-check-label" for="nam">Nam</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gender" id="nu" value="nu"
                                        {{ $profile->gender == 'nu' ? 'checked' : '' }} disabled>
                                    <label class="form-check-label" for="nu">Nữ</label>
                                </div>
                            </div>

                        </div>
                        <input type="hidden" name="user_id" value="">
                        <div class="col-md-6 mb-3">
                            <button class="Btn" type="button" id="editButton" onclick="enableEdit()">Edit
                                <svg class="svg" viewBox="0 0 512 512">
                                    <path
                                        d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z">
                                    </path>
                                </svg>
                            </button>

                            <button class="custom-btn btn-1" type="submit" name="submit" id="saveButton" style="display: none;">Save</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </section>
    @endsection
    <!-- end of profile -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('edit_image').addEventListener('change', function (event) {
                var output = document.getElementById('preview-image');
                if (event.target.files && event.target.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        output.src = e.target.result;
                    }
                    reader.readAsDataURL(event.target.files[0]);
                }
            });
        });
        $(document).ready(function () {
            $('#profileForm').submit(function (e) {
                e.preventDefault();

                // Hiển thị SweetAlert xác nhận trước khi lưu thay đổi
                Swal.fire({
                    title: "Do you want to save the changes?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Save",
                    denyButtonText: `Don't save`
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Nếu người dùng chấp nhận lưu, thực hiện yêu cầu AJAX để lưu thay đổi
                        var formData = new FormData(this);
                        $.ajax({
                            url: $(this).attr('action'),
                            type: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                // Hiển thị SweetAlert khi lưu thành công
                                Swal.fire("Saved!", "Your changes have been saved.", "success").then(() => {
                                    // Tải lại trang hoặc làm gì đó sau khi lưu thành công
                                    location.reload();
                                });
                            },
                            error: function (xhr) {
                                // Hiển thị SweetAlert khi có lỗi yêu cầu AJAX
                                Swal.fire("Error!", "Failed to save changes. Please try again.", "error");
                            }
                        });
                    } else if (result.isDenied) {
                        // Hiển thị SweetAlert khi người dùng không muốn lưu thay đổi
                        Swal.fire("Changes are not saved", "", "info");
                    }
                });
            });
        });

    </script>
</body>

</html>