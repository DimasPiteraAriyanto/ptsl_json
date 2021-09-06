<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login - Control Panel</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset(url('logo.png')) }}" rel="icon" type="image/png">
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/animsition/css/animsition.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
</head>
<body>
    <div class="limiter">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-5">
                <div class="text-center mb-3">
                    <br>
                    <br>
                    <img src="{{asset('logo.png')}}" style="width: 120px; background-color: none !important;" alt="...">
                    <h2 class="text-dark py-3" style="text-align: center">Pelayanan Pertanahan Desa Mandiri</h2>
                </div>
                <div class="card bg-transparent">
                    <div class="card-body px-lg-4 py-lg-3">
                        <form action="{{ route('postlogin') }}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="Username" class="text-dark">Username</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-person-83"></i></span>
                                    </div>
                                    <input class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="Username" type="username" style="color: black">
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-dark">Password</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" type="password" value="{{ old('password') }}" style="color: black">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-2">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
	</div>

	<script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
	<script src="{{ asset('vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
	<script src="{{ asset('vendor/countdowntime/countdowntime.js') }}"></script>
	<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
