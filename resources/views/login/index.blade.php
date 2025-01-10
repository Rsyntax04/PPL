<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('css/layouts.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="full-container d-flex">
        <div class="form-section">
            <div class="form-box">
                <h1 class="mb-3 poppins-bold title" align="center">Login</h1>
                <h3 class="poppins-regular subtitle">Selamat datang</h3>
                <p class="poppins-regular subtitle">Silahkan masukkan email/ID dan password anda.</p>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label poppins-medium">Email / ID</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter Email / ID" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label poppins-medium">Password</label>
                        <input type="password" name="password" placeholder="Password" class="form-control">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <input type="checkbox" name="remember"> <span class="poppins-regular">Remember me</span>
                        </div>
                        <a href="#" class="poppins-regular">Forgot Password?</a>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 poppins-medium">LOGIN</button>
                </form>
            </div>
        </div>
        <div class="gradient-section">
            <div class="overlay-image"></div>
        </div>
    </div>
</body>
</html>