<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Register</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <section class="bg-light">
        <div class="d-flex flex-column align-items-center justify-content-center min-vh-100 py-5">
            <div class="mb-4 text-2xl font-weight-bold">
                Register
            </div>
            <div class="card w-100" style="max-width: 400px;">
                <div class="card-body">
                    <h1 class="card-title text-center mb-4">Create an account</h1>
                    <form action="{{ route('register.save') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Your name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Your email</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                            @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-check mb-3">
                            <input id="terms" aria-describedby="terms" type="checkbox" class="form-check-input" required>
                            <label for="terms" class="form-check-label">I accept the <a class="text-primary" href="#">Terms and Conditions</a></label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Create an account</button>
                        <p class="text-center mt-3">
                            Sudah Punya Akun? <a href="{{ route('login') }}" class="text-primary">Login here</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
