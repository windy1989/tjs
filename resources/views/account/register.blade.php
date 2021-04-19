<section id="content">
   <div class="content-wrap">
      <div class="container clearfix">
         <div class="row justify-content-center">
            <div class="col-md-8">
               @if($errors->any())
                  <div class="alert alert-warning">Data you sent is incorrect</div>
               @endif
               <div class="card mb-0">
                  <div class="card-body" style="padding:40px;">
                     <form id="login-form" name="login-form" class="mb-0" action="{{ url('account/register') }}" method="POST">
                        @csrf
                        <h3 class="mb-5">Registrasi Customer</h3>
                        <div class="form-group row">
                           <label class="col-sm-3 text-capitalize col-form-label">Full Name</label>
                           <div class="col-sm-9">
                              <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" placeholder="Enter full name" required>
                              @error('name') <small class="text-danger font-italic">{{ $message }}</small> @enderror
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 text-capitalize col-form-label">Email</label>
                           <div class="col-sm-9">
                              <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Enter email" required>
                              @error('email') <small class="text-danger font-italic">{{ $message }}</small> @enderror
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 text-capitalize col-form-label">Phone</label>
                           <div class="col-sm-9">
                              <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" placeholder="Enter phone" required>
                              @error('phone') <small class="text-danger font-italic">{{ $message }}</small> @enderror
                           </div>
                        </div>
                        <div class="form-group row">
                           <label class="col-sm-3 text-capitalize col-form-label">Password</label>
                           <div class="col-sm-9">
                              <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
                              @error('password') <small class="text-danger font-italic">{{ $message }}</small> @enderror
                           </div>
                        </div>
                        <div class="form-group">
                           <p class="text-center text-muted mt-4 mb-4">
                              <small>
                                 By registering, you agree to the applicable <a href="{{ url('information/terms_and_conditions') }}" class="text-primary">Terms and Conditions</a>
                              </small>
                           </p>
                        </div>
                        <div class="form-group mt-3">
                           <button type="submit" class="button button-3d button-black float-right m-0">Register</button>
                        </div>
                     </form>
                  </div>
                  <div class="card-footer">
                     <a href="{{ url('account/login') }}" class="text-primary">&larr; Login Here</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>