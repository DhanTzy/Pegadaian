<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <section class="bg-light">
        <div class="d-flex flex-column align-items-center justify-content-center min-vh-100 py-5">
            <div class="mb-4 text-2xl font-weight-bold">
                Login
            </div>
            <div class="card w-100" style="max-width: 400px;">
                <div class="card-body">
                    <h1 class="card-title text-center mb-4">Sign in to your account</h1>
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
                        <div class="form-group">
                            <label for="email">Your email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="name@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password" required>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="#" class="text-primary">Forgot password?</a>
                            <button type="submit" class="btn btn-primary">Sign in</button>
                        </div>
                        <p class="text-center mt-3">
                            Belum Punya Akun? <a href="{{ route('register') }}" class="text-primary">Sign up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
