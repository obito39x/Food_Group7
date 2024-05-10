
<!DOCTYPE html>
<html lang="en"> 

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Website</title>
    <link href="{{ asset('/css/profile.css') }}" rel="stylesheet">
    <link rel="short icon" href="{{ asset('image/short_icon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="{{ asset('/js/menu.js') }}"></script>
    <script src="{{ asset('/js/profile.js') }}"></script>
</head>

<body>
    @extends('layouts.app')
    <!-- profile -->
    @section('content');
    <section class="" style="padding: 100px 0 50px 0;">
        <form action="{{ route('profile.update', $profile->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-4">
                        <div class="text-center">
                            @if(!empty($profile->img))
                                <img id="preview-image" src="{{ $profile->img }}" alt="User Image" class="img-fluid profile-image mb-3" style="width: 150px; height: 150px;">
                            @else
                                <img id="preview-image" src="{{ asset('img_profile/profile.png') }}" alt="Default Image" class="img-fluid profile-image mb-3" style="width: 150px; height: 150px;">
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
                                    <input type="text" class="form-control" name="phone_number" id="phone"
                                        value="{{ $profile->phone_number ?? 'Không có thông tin' }}" readonly>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="ngaySinh" class="form-label">Day of Birth:</label>
                                    <input type="date" class="form-control" id="date" name="date_user"
                                        value="{{ $profile->date_user }}" readonly>
                                </div>
                                <div class="col-md-3 mb-3">
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
                                <button type="button" class="btnn btn-primary" id="editButton" onclick="enableEdit()">Edit</button>
                                <button type="submit" class="btnn btn-success" name="submit" id="saveButton" style="display: none;">Save</button>
                            </div>
                        
                    </div>
                </div>
            </div>
        </form>
    </section>
    @endsection
    <!-- end of profile -->

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('edit_image').addEventListener('change', function(event) {
            var output = document.getElementById('preview-image');
            if (event.target.files && event.target.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    output.src = e.target.result;
                }
                reader.readAsDataURL(event.target.files[0]);
            }
        });
    });
    </script>
</body>

</html>