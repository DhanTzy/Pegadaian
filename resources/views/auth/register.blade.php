<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/stylinglogin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>
    <div class="container login-con">
        <div class="login-form container row justify-content-end">
            <img src="{{ asset('img/gadai.png') }}" alt="logo" class="logo" />
            <p class="masuk">Buat Akun Baru</p>
            <p>Selamat datang Di Aplikasi Go Pegadaian! Ayo masuk ke akunmu supaya bisa menikmati banyak fitur</p>
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
                    <label for="password">Password<span class="text-danger">*</span></label>
                    <div class="input-groupi">
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="Masukkan password" autocomplete="off" required />
                        <div class="input-group-append">
                            <span class="input-group-texti toggle-password" onclick="togglePassword('password')">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation">Ulangi Password<span class="text-danger">*</span></label>
                    <div class="input-groupi">
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="form-control" placeholder="Masukkan ulang password" autocomplete="off" required />
                        <div class="input-group-append">
                            <span class="input-group-texti" onclick="togglePassword('password_confirmation')">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                    </div>
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
    const passwordField = document.getElementById(fieldId);
    const icon = passwordField.nextElementSibling.querySelector('i');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
    </script>

</body>

</html>
