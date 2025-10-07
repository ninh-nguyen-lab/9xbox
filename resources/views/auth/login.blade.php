<!doctype html>
<html lang="en">

<head>
    <title>Login 9X BOX</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('backend/assets/login/css/style.css') }}">
</head>

<body class="img js-fullheight" style="background-image: url({{ asset('backend/assets/login/images/bg.jpg') }});">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <img src="{{ asset('backend/assets/login/images/logo.png') }}" alt="Logo"
                        style="max-width: 180px; height: auto;">
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">Đăng Nhập</h3>

                        {{-- Hiển thị thông báo --}}
                        @if(Session::has('message'))
                        <div class="alert alert-danger text-center">
                            {{ Session::get('message') }}
                        </div>
                        {{ Session::put('message', null) }}
                        @endif

                        <form action="{{ URL::to('/admin-dashboard') }}" method="post" class="signin-form">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <input type="email" class="form-control" name="admin_email" placeholder="Nhập email"
                                    required>
                            </div>

                            <div class="form-group">
                                <input id="password-field" type="password" class="form-control" name="admin_password"
                                    placeholder="Nhập mật khẩu" required>
                                <span toggle="#password-field"
                                    class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Đăng
                                    Nhập</button>
                            </div>

                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label class="checkbox-wrap checkbox-primary">Nhớ đăng nhập
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="#" style="color: #fff">Quên mật khẩu</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('backend/assets/login/js/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/login/js/popper.js') }}"></script>
    <script src="{{ asset('backend/assets/login/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/assets/login/js/main.js') }}"></script>
</body>
</html>