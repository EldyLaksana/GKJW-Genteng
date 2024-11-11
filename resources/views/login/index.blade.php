<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Dashboard GKJW Genteng</title>

    <link href="{{ asset('assets/img/logo-gkjw.png') }}" rel="icon">
    <link href="{{ asset('assets/img/logo-gkjw.png') }}" rel="apple-touch-icon">

    {{-- Bootstrap Css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- Bootstrap Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- CSS Style --}}
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>

    <div class="row justify-content-center mt-5">
        <div class="col-lg-5">

            @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissable fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <main class="form-signin w-100">
                {{-- <h4>Aplikasi HRIS PT. Ratu Makmur Abadi</h4> --}}
                <form action="/login" method="POST">
                    @csrf
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <img class="mb-4" src="{{ asset('assets/img/logo-gkjw.png') }}" alt="" width="100"
                            height="100">
                        <h1 class="h2 mb-4 fw-bold text-center">Selamat Datang di Dashboard Website GKJW Jemaat Genteng
                        </h1>
                    </div>
                    <h1 class="h3 mb-3 fw-normal">Silahkan Login</h1>
                    <div class="form-floating">
                        <input type="username" class="form-control" id="username" name="username"
                            placeholder="Username"required autofocus @error('username') is-invalid @enderror
                            value="{{ old('username') }}">
                        <label for="username">Username</label>
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-floating mt-2">
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Password" required>
                        <label for="password">Password</label>
                    </div>

                    <button class="btn btn-success w-100 py-2" type="submit" style="color: white">Login</button>

                </form>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</body>

</html>
