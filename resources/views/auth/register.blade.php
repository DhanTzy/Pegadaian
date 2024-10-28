<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Register</title>
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
            <img src="{{ asset('img/pegadaian.png') }}" alt="logo" class="logo" />
                <p class="masuk">Buat Akun Baru</p>
                <p>
                    Selamat datang Di Aplikasi Go Pegadaian Ayo masuk ke akun mu supaya
                    kamu bisa menikmati banyak fitur
                </p>
            <hr style="background-color: black; height: 1px; border: none;">
            <form action="{{ route('register.save') }}" method="POST">
                @csrf
                <div>
                    <label for="name">Nama<span class="text-danger">*</span></label>
                    <input type="text" id="name" name="name" placeholder="Masukkan nama" class="form-control"
                        required />
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="email">Email<span class="text-danger">*</span></label>
                    <input type="text" id="email" name="email" class="form-control"
                        placeholder="Masukkan email" required />
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="password">Password<span class="text-danger">*</span>
                    </label>
                    <input type="password" id="password" name="password" class="form-control"
                        placeholder="Masukkan password" required />
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label for="password">Ulangi Password<span class="text-danger">*</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                        placeholder="Masukkan ulangi password" />
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <button type="submit" class="btn btn-primary w-100">Create an account</button>
                </div>
                <p class="text-center mt-1">
                    Sudah Punya Akun?
                    <a href="{{ route('login') }}" class="text-primary">Login here</a>
                </p>
                <p class="text-center">atau</p>
                <div class="icon">
                    <i class="fa-brands fa-google"></i>
                    <i class="fa-brands fa-facebook"></i>
                </div>
            </form>
        </div>
    </div>

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
                <img src="{{ asset('img/ryhnlogin.png') }}" alt="gambarlogin" class="gambarlogin" />
            </div>
        </div>
    </div>
</body>

</html>
