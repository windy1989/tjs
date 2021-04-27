<section id="page-title">
   <div class="container">
      <h1>Reset Password</h1>
   </div>
</section>
<section id="content">
   <div class="content-wrap">
      <div class="container clearfix">
         <div class="row justify-content-center">
            <div class="col-md-5">
               @if(session('failed'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                     <i class="icon-times-circle"></i>
                     <strong>Sorry,</strong> {{ session('failed') }}
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
               @endif
               <div class="card mb-0">
                  <div class="card-body" style="padding:40px;">
                     <form id="login-form" name="login-form" class="mb-0" action="{{ url()->full() }}" method="POST">
                        @csrf
                        <div class="row">
                           <div class="col-12 form-group">
                              <label>Password:</label>
                              <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
                              @error('password') <small class="text-danger font-italic">{{ $message }}</small> @enderror
                           </div>
                           <div class="col-12 form-group">
                              <label>Password Confirmation:</label>
                              <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Enter password confirmation" required>
                              @error('password_confirmation') <small class="text-danger font-italic">{{ $message }}</small> @enderror
                           </div>
                           <div class="col-12 form-group mt-3">
                              <button type="submit" class="button button-3d button-black float-right m-0">Reset Now</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>