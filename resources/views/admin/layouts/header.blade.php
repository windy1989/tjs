<body  onload="loadingOpen('body')">
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
			</ul>
			<div class="ml-md-3 mr-md-auto" style="font-size: 13px;"></div>
			<ul class="navbar-nav">
				<li class="nav-item dropdown dropdown-user">
					<a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
						<img src="{{ session('bo_photo') }}" class="rounded-circle mr-2" height="34" alt="">
						<span>{{ session('bo_name') }}</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
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