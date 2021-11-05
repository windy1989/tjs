<body data-spy="scroll" data-target=".sidebar-component-right">
	<div class="navbar navbar-expand-md navbar-dark">
		<div class="navbar-brand">
			<a href="{{ url('admin/dashboard') }}" class="d-inline-block">
				<img src="{{ asset('website/logo-white.png') }}" alt="Logo">
			</a>
		</div>
		<div class="d-md-none mt-2">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>
		<div class="collapse navbar-collapse" id="navbar-mobile">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
						<i class="icon-paragraph-justify3"></i>
					</a>
				</li>
				@if(in_array(1, session('bo_role')) || in_array(5, session('bo_role')))
					<li class="nav-item text-left">
						<a href="{{ url('admin/approval') }}" class="navbar-nav-link" data-popup="tooltip" title="Approval">
							<i class="icon-shield-check"></i>
							<span class="d-lg-none ml-3">Approval</span>
							<span class="badge badge-warning badge-pill ml-auto ml-lg-0">
								{{ App\Models\Approval::where('user_id', session('bo_id'))->where('seen', 0)->count() }}
							</span>
						</a>
					</li>
				@endif
			</ul>
			<span class="badge badge-success my-3 my-lg-0 ml-lg-3 d-none d-lg-block d-xl-block">ONLINE</span>
			<ul class="navbar-nav ml-lg-auto">
				<li class="nav-item nav-item-dropdown-lg dropdown">
					@php 
						$notify = App\Models\Notification::where('user_id', session('bo_id'))
							->where('seen', 1)
							->whereDate('created_at', date('Y-m-d')); 
					@endphp
					<a href="#" class="navbar-nav-link navbar-nav-link-toggler" data-toggle="dropdown" data-popup="tooltip" title="Notification">
						<i class="icon-bell2"></i>
						<span class="d-lg-none ml-3">Notification</span>
						<span class="badge badge-warning badge-pill ml-auto ml-lg-0">{{ $notify->count() }}</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-content wmin-lg-350">
						<div class="dropdown-content-header">
							<span class="font-weight-semibold">Notification</span>
						</div>
						<div class="dropdown-content-body dropdown-scrollable">
							<ul class="media-list">
								@if($notify->count() > 0)
									@foreach($notify->latest()->limit(4)->get() as $n)
										<li class="media">
											<div class="media-body">
												<div class="media-title">
													<a href="{{ $n->link }}" class="text-dark">
														<span class="font-weight-semibold">{{ $n->title }}</span>
														<span class="float-right font-size-sm">
															{{ date('d F Y, H:i', strtotime($n->created_at)) }}
														</span>
													</a>
												</div>
												<span class="text-muted">{{ $n->description }}</span>
											</div>
										</li>
									@endforeach
								@else
									<li class="media">
										<div class="media-body">
											<div class="alert alert-warning text-center">Empty</div>
										</div>
									</li>
								@endif
							</ul>
						</div>
						<div class="dropdown-content-footer justify-content-center p-0 mt-0">
							<a href="{{ url('admin/notification') }}" class="btn btn-light text-primary font-weight-bold btn-block border-0 rounded-top-0">View All</a>
						</div>
					</div>
				</li>
				<li class="nav-item">
					<a href="https://apps.smartmarbleandbath.com/quickcount.apk" target="_blank" class="navbar-nav-link navbar-nav-link-toggler" data-popup="tooltip" title="Calculator">
						<i class="icon-calculator"></i>
						<span class="d-lg-none ml-3">Calculator</span>
					</a>
				</li>
				<li class="nav-item dropdown dropdown-user">
					<a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
						<img src="{{ session('bo_photo') }}" class="rounded-circle mr-2" height="34" alt="{{ session('fo_name') }}">
						<span>{{ session('bo_name') }}</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a href="{{ url('/') }}" class="dropdown-item" target="_blank">
							<i class="icon-home"></i> Main Page
						</a>
						<a href="{{ url('admin/profile') }}" class="dropdown-item">
							<i class="icon-user-plus"></i> Profile
						</a>
						<a href="{{ url('admin/my_activity') }}" class="dropdown-item">
							<i class="icon-person"></i> My Activity
						</a>
						<div class="dropdown-divider"></div>
						<a href="{{ url('admin/logout') }}" class="dropdown-item">
							<i class="icon-switch2"></i> Logout
						</a>
					</div>
				</li>
			</ul>
		</div>
	</div>