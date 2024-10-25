<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta name="author" content=""> --}}
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/stylinglogin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container login-con">
        <div class="login-form container row justify-content-end">
            <br>
            <img src="{{ asset('img/pegadaian.png') }}" alt="logo" class="logo"/>
            <h1 class="fs-1 fw-semibold font-poppins">
                Masuk
            </h1>
            <div>
                <p>
                    Selamat datang Di Aplikasi Go Pegadaian Ayo masuk ke akun mu supaya
                    kamu bisa menikmati banyak fitur
                </p>
            </div>
            <hr style="background-color: black; height: 1px; border: none;">
            <form method="post" action="{{ route('login.action') }}">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong class="font-weight-bold">Error!</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                {{-- rayy --}}
                <div class="form-group">
                    <label for="email">Your email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="name@company.com" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="passwoard" required>
                </div>
                <div style="float: right; margin-top: 10px;">
                    <a href="#">Lupa Password?</a>
                </div>
                <div>
                    <button class="btn btn-primary" type="submit">
                        Login
                    </button>
                </div>
                <div style="margin-top: 10px;">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-primary">Sign up</a>
                    Sekarang
                </div>
                <p class="text-center mt-5">atau</p>
                <div class="icon">
                    <a href="#"><i class="fa-brands fa-google"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                </div>
            </form>
        </div>
    </div>
    {{-- box kanan --}}
    <div class="container right">
        <div class="container box">
            <div style="margin-left: 5%; margin-top: 8%">
                <h2>Gaada Uang?</h2>
            </div>
            <div style="margin-left: 25%">
                <h2>Di Go Pegadaian Aja</h2>
            </div>
            <div style="margin-left: 45%">
                <h2>Dijadmin Aman 100%</h2>
            </div>
            <div class="img-container">
                <img src="{{ asset('img/gambarlogin.png') }}" alt="logo" class="gambarlogin">
            </div>
        </div>
    </div>
</body>
</html>
