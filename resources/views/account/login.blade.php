<section id="content">
   <div class="content-wrap">
      <div class="container clearfix">
         <div class="row justify-content-center">
            <div class="col-md-5">
               <div class="card mb-0">
                  <div class="card-body" style="padding:40px;">
                     <form id="login-form" name="login-form" class="mb-0" action="{{ url('account/login') }}" method="POST">
                        <h3 class="mb-3">Login Customer</h3>
                        <div class="row">
                           <div class="col-12 form-group">
                              <label>Email:</label>
                              <input type="email" name="email" id="email" class="form-control" placeholder="Enter email">
                           </div>
                           <div class="col-12 form-group">
                              <label>Password:</label>
                              <input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
                           </div>
                           <div class="col-12 form-group mt-3">
                              <a href="{{ url('account/forgot_password') }}">Forgot Password?</a>
                              <button type="submit" class="button button-3d button-black float-right m-0">Login</button>
                           </div>
                           <div class="line line-sm"></div>
                           <div class="center col-12">
										<a href="#" class="button button-rounded si-facebook si-colored col-12">
                                 <i class="icon-facebook"></i> Login With Facebook
                              </a>
										<a href="#" class="button button-rounded si-google si-colored col-12">
                                 <i class="icon-google"></i> Login With Google
                              </a>
									</div>
                        </div>
                     </form>
                  </div>
                  <div class="card-footer">
                     <a href="{{ url('account/register') }}" class="text-primary">+ Register here</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>