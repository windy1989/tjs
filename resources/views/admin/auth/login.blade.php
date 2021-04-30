<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>SMB Admin - Login</title>
	<link rel="shortcut icon" href="{{ asset('website/icon.png') }}">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet">
	<link href="{{ asset('template/back-office/global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet">
	<link href="{{ asset('template/back-office/assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('template/back-office/assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet">
	<link href="{{ asset('template/back-office/assets/css/layout.min.css') }}" rel="stylesheet">
	<link href="{{ asset('template/back-office/assets/css/components.min.css') }}" rel="stylesheet">
	<link href="{{ asset('template/back-office/assets/css/colors.min.css') }}" rel="stylesheet">
	<script src="{{ asset('template/back-office/global_assets/js/main/jquery.min.js') }}"></script>
	<script src="{{ asset('template/back-office/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('template/back-office/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
	<script src="{{ asset('template/back-office/assets/js/app.js') }}"></script>

	<style>
		body {
			background: url('{{ asset("website/bg-login-bo.jpg") }}') no-repeat center center fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}
	</style>

</head>
<body>
	<div class="page-content">
		<div class="content-wrapper">
			<div class="content d-flex justify-content-center align-items-center">
				<form class="login-form" action="{{ url('admin/login') }}" method="POST">
					@csrf
					<div class="card shadow-lg bg-white rounded mb-0">
						<div class="card-body">
							<div class="text-center mb-3">
								<img src="{{ asset('website/icon.png') }}" style="max-width:70px;" alt="Logo">
								<div class="mb-3 mt-3">
									<h5 class="mb-0">SMB Back Office</h5>
									<span class="d-block text-muted">Login to your account</span>
								</div>
							</div>
							@if(session('success'))
								<div class="alert alert-success font-weight-bold text-center">{{ session('success') }}</div>
							@elseif(session('info'))
								<div class="alert alert-info font-weight-bold text-center">{{ session('info') }}</div>
							@elseif(session('failed'))
								<div class="alert alert-danger font-weight-bold text-center">{{ session('failed') }}</div>
							@endif
							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
								<div class="form-control-feedback">
									<i class="icon-envelope text-muted"></i>
								</div>
							</div>
							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
							</div>
							<div class="text-center">
								<a href="{{ url('admin/forgot_password') }}">Forgot password?</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
