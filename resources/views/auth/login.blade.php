<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- CSS Links -->
    <link rel="stylesheet" href="{{ asset('css/stylinglogin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- JS Links -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
        <div class="container login-con">
            <div class="login-form container row justify-content-end">
                <br>
                <img src="{{ asset('img/gadai.png') }}" alt="logo" class="logo" />
                <h1 class="fs-1 fw-semibold font-poppins">Masuk</h1>
                <p>Selamat datang di Aplikasi Go Pegadaian. Ayo masuk ke akunmu supaya kamu bisa menikmati banyak fitur.
                </p>
                <hr style="background-color: black; height: 1px; border: none;">

                <form method="post" action="{{ route('login.action') }}">
                    @csrf

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email">Your email</label>
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="name@company.com" required>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="password" required>
                            <div class="input-group-append">
                                <span class="input-group-text" onclick="togglePassword('password')">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                        </div>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Login Button -->
                    <button class="btn btn-primary" type="submit">Login</button>

                    <!-- Signup Link -->
                    <div class="mt-3">
                        Belum punya akun? <a href="{{ route('register') }}" class="text-primary">Sign up</a> sekarang.
                    </div>

                    <p class="text-center mt-5">atau</p>

                    <!-- Social Media Login Icons -->
                    <div class="icon">
                        <button class="google-btn">
                            <img src="https://img.icons8.com/color/48/000000/google-logo.png" alt="Google Logo">
                            <span>Lanjutkan Dengan Google</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="container boxlogin">
            <div class="container box position-relative" style="height: 100%;">
                <img src="{{ asset('img/bgSAN.png') }}" alt="background" class="position-absolute"
                    style="width: 100%; height: 100%;">
                <div class="position-absolute d-flex justify-content-center align-items-center"
                    style="left: 0; right: 0; top: 0; bottom: 0; margin: auto;">
                    <img src="{{ asset('img/SANabsolute.png') }}" width="400" alt="centered-image">
                </div>
            </div>
        </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = field.nextElementSibling.querySelector('i');
            if (field.type === "password") {
                field.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>
