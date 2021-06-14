<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>SMB Admin - Login</title>
	<link rel="shortcut icon" href="{{ asset('website/icon.png') }}">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet">
	<link href="{{ asset('template/back-office/global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet">
	<link href="{{ asset('template/back-office/assets/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('template/back-office/assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet">
	<link href="{{ asset('template/back-office/assets/css/layout.min.css') }}" rel="stylesheet">
	<link href="{{ asset('template/back-office/assets/css/components.min.css') }}" rel="stylesheet">
	<link href="{{ asset('template/back-office/assets/css/colors.min.css') }}" rel="stylesheet">
	<link href="{{ asset('template/plugins/waitMe/waitMe.min.css') }}" rel="stylesheet">
	<link href="{{ asset('template/plugins/lightbox/dist/css/lightbox.min.css') }}" rel="stylesheet">
	<link href="{{ asset('template/back-office/custom.css') }}" rel="stylesheet">
	<script src="{{ asset('template/back-office/global_assets/js/main/jquery.min.js') }}"></script>
	<script src="{{ asset('template/back-office/global_assets/js/main/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('template/back-office/global_assets/js/plugins/loaders/blockui.min.js') }}"></script>
	<script src="{{ asset('template/back-office/global_assets/js/plugins/tables/datatables/datatables.min.js') }}"></script>
	<script src="{{ asset('template/back-office/global_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script src="{{ asset('template/back-office/global_assets/js/plugins/notifications/sweet_alert.min.js') }}"></script>
	<script src="{{ asset('template/back-office/global_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
	<script src="{{ asset('template/back-office/global_assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
	<script src="{{ asset('template/back-office/global_assets/js/plugins/forms/styling/switch.min.js') }}"></script>
	<script src="{{ asset('template/back-office/global_assets/js/plugins/ui/moment/moment.min.js') }}"></script>
	<script src="{{ asset('template/back-office/global_assets/js/plugins/notifications/jgrowl.min.js') }}"></script>
	<script src="{{ asset('template/back-office/global_assets/js/plugins/notifications/noty.min.js') }}"></script>
	<script src="{{ asset('template/back-office/global_assets/js/plugins/extensions/session_timeout.min.js') }}"></script>
	<script src="{{ asset('template/back-office/global_assets/js/plugins/ui/prism.min.js') }}"></script>
	<script src="{{ asset('template/back-office/global_assets/js/plugins/ui/sticky.min.js') }}"></script>
	<script src="{{ asset('template/plugins/waitMe/waitMe.min.js') }}"></script>
	<script src="{{ asset('template/plugins/number-format/jquery.number.min.js') }}"></script>
	<script src="{{ asset('template/plugins/lightbox/dist/js/lightbox.min.js') }}"></script>
	<script src="{{ asset('template/back-office/assets/js/app.js') }}"></script>
	<script src="{{ asset('template/back-office/custom.js') }}"></script>

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
					<div class="card shadow-lg bg-white rounded mb-0 w-100">
						<div class="card-body">
							<div class="text-center mb-3">
								<img src="{{ asset('website/icon.png') }}" style="max-width:70px;" alt="Logo">
								<div class="mb-3 mt-3">
									<h5 class="mb-0">LOGIN</h5>
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
								<a href="{{ url('admin/forgot_password') }}" id="link_forgot_password" data-toggle="modal" data-target=".bs-example-modal-lg">Forgot password?</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

<div class="modal fade bs-example-modal-lg" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-body">
         <div class="modal-content">
            <div class="modal-header bg-light">
               <h4 class="modal-title" id="myModalLabel">Forgot Password</h4>
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
               <div id="notif_forgot_password"></div>
               <div class="form-group">
                  <label>Email :</label>
                  <input type="text" name="email_forgot_password" id="email_forgot_password" class="form-control" placeholder="Enter email">
               </div>
               <div class="form-group"><hr></div>
               <div class="form-group">
                  <div class="text-right">
                     <button type="button" onclick="forgotPassword()" class="btn btn-success"><i class="icon-paperplane"></i> Send</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<script>
   $(function() {
      $('#link_forgot_password').click(function() {
         $('#notif_forgot_password').html('');
         $('#email_forgot_password').val('');
      });
   });

   function forgotPassword() {
      if($('#email_forgot_password').val()) {
         $.ajax({
            url: '{{ url("admin/forgot_password") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
               email: $('#email_forgot_password').val()
            },
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
               $('#notif_forgot_password').html('');
               loadingOpen('.modal-content');
            },
            success: function(response) {
               loadingClose('.modal-content');
               if(response.status == true) {
                  $('#email_forgot_password').val('');
                  $('#notif_forgot_password').html(`
                     <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="icon-checkmark4"></i>
                        <strong>Success!</strong> ` + response.message + `
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                  `);
               } else {
                  $('#notif_forgot_password').html(`
                     <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="icon-cross2"></i>
                        <strong>Sorry,</strong> ` + response.message + `
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                  `);
               }
            },
            error: function() {
               loadingClose('.modal-content');
               swalInit.fire('Server error!', '', 'error');
            }
         });
      } else {
         swalInit.fire('Please enter email!', '', 'info');
      }
   }
</script>

</body>
</html>
