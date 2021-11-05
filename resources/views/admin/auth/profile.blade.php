<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Profile</span>
				</h4>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<span class="breadcrumb-item active">Profile</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
      <div class="row">
         <div class="col-md-4">
            <div class="card">
               <div class="card-body text-center card-img-top" style="background-image: url({{ asset('template/back-office/global_assets/images/backgrounds/panel_bg.png') }}; background-size: contain;">
                  <div class="card-img-actions d-inline-block mb-3">
                     <img class="img-fluid rounded-circle" src="{{ Storage::exists($user->photo) ? asset(Storage::url($user->photo)) : asset('website/user.png') }}" width="170" height="170" alt="{{ $user->name }}">
                  </div>
                  <h6 class="font-weight-semibold mb-0">{{ $user->name }}</h6>
                  @foreach($user->userRole as $ur)
                     <span class="d-block opacity-75">{{ $ur->role() }}</span>
                  @endforeach
                  <span class="d-block opacity-75">{{ $user->branch() }}</span>
               </div>
               <div class="card-body p-0">
                  <ul class="nav nav-sidebar">
                     <li class="nav-item-header text-center">
                        Verification on {{ date('d F Y', strtotime($user->verification)) }}
                     </li>
                  </ul>
               </div>
            </div>
			<div class="card">
               <div class="card-body">
					<form id="form_data">
					   <div class="alert alert-danger" id="validation_alert" style="display:none;">
						  <ul id="validation_content"></ul>
					   </div>
					   <div class="form-group">
						  <label>Sign :</label>
						  <input type="file" id="image" name="image" class="form-control h-auto" accept="image/x-png,image/jpg,image/jpeg" onchange="previewImage(this, '#preview_image')">
						  <center class="mt-3">
							 <a href="{{ $user->sign ? asset(Storage::url($user->sign)) : asset("website/empty.jpg") }}" id="preview_image" data-lightbox="Brand" data-title="Preview Image">
								<img src="{{ $user->sign ? asset(Storage::url($user->sign)) : asset("website/empty.jpg") }}" class="img-fluid img-thumbnail w-100" style="max-width:200px;">
							 </a>
						  </center>
					   </div>
					   <div class="form-group text-center">
							<button type="button" class="btn bg-primary" id="btn_create" onclick="create()">Send</button>
					   </div>
					</form>
               </div>
            </div>
         </div>
         <div class="col-md-8">
            <div class="card">
               <div class="card-body">
                  @if($errors->any())
                     <div class="alert bg-warning text-white alert-styled-left alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">
                           <span>&times;</span>
                        </button>
                        <ul>
                           @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                           @endforeach
                        </ul>
                     </div>
                  @elseif(session('success'))
                     <div class="alert bg-success text-white alert-styled-left alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">
                           <span>&times;</span>
                        </button>
                        {{ session('success') }}
                     </div>
                  @elseif(session('failed'))
                     <div class="alert bg-danger text-white alert-styled-left alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">
                           <span>&times;</span>
                        </button>
                        {{ session('failed') }}
                     </div>
                  @endif
                  <form action="{{ url('admin/profile') }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="form-group">
                        <label>Photo :<sup class="text-danger">*</sup></label>
                        <input type="file" name="photo" id="photo" class="form-control h-auto">
                     </div>
                     <div class="form-group">
                        <label>Name :<sup class="text-danger">*</sup></label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" placeholder="Enter name">
                     </div>
                     <div class="form-group">
                        <label>Email :<sup class="text-danger">*</sup></label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" placeholder="Enter email">
                     </div>
                     <div class="form-group">
                        <div class="form-check">
                           <label class="form-check-label">
                              <input type="checkbox" name="change_password" id="change_password" class="form-check-input-styled-success" data-toggle="collapse" data-target="#collapse-link" {{ old('change_password') ? 'checked' : '' }}>
                              <span class="text-muted" for="change_password">With Change Password</span>
                           </label>
                        </div>
                     </div>
                     <div class="collapse {{ old('change_password') ? 'show' : '' }}" id="collapse-link">
								<div class="form-group">
                           <label>New Password :<sup class="text-danger">*</sup></label>
                           <input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
                        </div>
                        <div class="form-group">
                           <label>Password Confirm :<sup class="text-danger">*</sup></label>
                           <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Enter confirmation password">
                        </div>
							</div>
                     <div class="form-group">
                        <div class="text-right">
                           <button type="submit" class="btn bg-success">Update</button>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
	</div>
	<script>
		function create() {
		  $.ajax({
			 url: "{{ url('admin/profile/uploadSign') }}",
			 type: 'POST',
			 dataType: 'JSON',
			 data: new FormData($('#form_data')[0]),
			 contentType: false,
			 processData: false,
			 cache: true,
			 headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			 },
			 beforeSend: function() {
				$('#validation_alert').hide();
				$('#validation_content').html('');
				loadingOpen('#form_data');
			 },
			 success: function(response) {
				loadingClose('#form_data');
				if(response.status == 200) {
				   notif('success', 'bg-success', response.message);
				   setTimeout(function(){ location.reload() }, 1500);
				} else if(response.status == 422) {
				   $('#validation_alert').show();
				   notif('warning', 'bg-warning', 'Validation');
				   
				   $.each(response.error, function(i, val) {
					  $.each(val, function(i, val) {
						 $('#validation_content').append(`
							<li>` + val + `</li>
						 `);
					  });
				   });
				} else {
				   notif('error', 'bg-danger', response.message);
				}
			 },
			 error: function() {
				loadingClose('#form_data');
				swalInit.fire({
				   title: 'Server Error',
				   text: 'Please contact developer',
				   type: 'error'
				});
			 }
		  });
	   }
	</script>