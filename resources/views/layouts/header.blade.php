@php 
	$total_cart     = App\Models\Cart::where('customer_id', session('fo_id'))->count(); 
	$total_wishlist = App\Models\Wishlist::where('customer_id', session('fo_id'))->count(); 
@endphp
<body class="stretched">
	<div class="body-overlay"></div>
	<div id="side-panel" class="dark">
		<div id="side-panel-trigger-close" class="side-panel-trigger"><a href="#"><i class="icon-line-cross"></i></a></div>
		<div class="side-panel-wrap">
			<div class="widget clearfix">
				<h4 class="mb-4">My Account</h4>
				<nav class="nav-tree">
					<ul>
						<li>
							<a href="{{ url('account/history_order') }}"><i class="icon-line2-notebook"></i> History Order</a>
						</li>
						<li>
							<a href="{{ url('account/profile') }}"><i class="icon-user-circle1"></i> Profile</a>
						</li>
						<li>
							<a href="{{ url('account/cart') }}"><i class="icon-line-shopping-cart"></i> Cart <sup class="badge badge-light">{{ $total_cart }}</sup></a>
						</li>
						<li>
							<a href="{{ url('account/wishlist') }}"><i class="icon-line-heart"></i> Wishlist <sup class="badge badge-light">{{ $total_wishlist }}</sup></a>
						</li>
					</ul>
				</nav>
			</div>
			<div class="form-group"><hr></div>
			<div class="form-group">
				<div class="text-center">
					<a href="{{ url('account/logout') }}" class="button button-red col-12">Logout</a>
				</div>	
			</div>	
		</div>
	</div>
	<div id="wrapper" class="clearfix">
		<div id="top-bar">
			<div class="container">
				<div class="row justify-content-between align-items-center">
					<div class="col-12 col-md-auto">
						<p class="mb-0 py-2 text-center text-md-left">
							<strong>Call:</strong> (+62) 811332642 | <strong>Email:</strong> smartmarbleandbath@gmail.com
						</p>
					</div>
					<div class="col-12 col-md-auto">
						<ul id="top-social">
							<li><a href="https://www.facebook.com/SmartMarble-and-Bath-102164961856844/" target="_blank" class="si-facebook"><span class="ts-icon"><i class="icon-facebook"></i></span></a></li>
							<li><a href="mailto:smartmarbleandbath@gmail.com" class="si-gplus"><span class="ts-icon"><i class="icon-gmail"></i></span></a></li>
							<li><a href="https://instagram.com/smartmarble_bath?igshid=49qciyirowph" target="_blank" class="si-instagram"><span class="ts-icon"><i class="icon-instagram"></i></span></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<header id="header" class="full-header header-size-md">
			<div id="header-wrap">
				<div class="container">
					<div class="header-row justify-content-lg-between">
						<div id="logo">
							<a href="{{ url('/') }}" class="standard-logo">
								<img src="{{ asset('website/logo-black.png') }}" alt="Logo">
							</a>
							<a href="{{ url('/') }}" class="retina-logo">
								<img src="{{ asset('website/logo-black.png') }}" alt="Logo">
							</a>
						</div>
						<div class="header-misc">
							<div id="top-account">
								@if(session('fo_id'))
									<a href="javascript:void(0);" class="side-panel-trigger">
										<i class="icon-line2-user mr-1 position-relative" style="top: 1px;"></i>
										<span class="d-none d-sm-inline-block font-primary font-weight-medium">My Account</span>
									</a>
								@else
									<a href="{{ url('account/login') }}">
										<i class="icon-line2-user mr-1 position-relative" style="top: 1px;"></i>
										<span class="d-none d-sm-inline-block font-primary font-weight-medium">Login / Register</span>
									</a>
								@endif
							</div>
							<div id="top-search" class="header-misc-icon">
								<a href="#" id="top-search-trigger">
									<i class="icon-line-search"></i>
									<i class="icon-line-cross"></i>
								</a>
							</div>
							<div id="top-search" class="header-misc-icon d-none d-sm-block">
								<a href="{{ url('account/wishlist') }}" id="top-search-trigger">
									<i class="icon-heart21"></i>
									<span class="top-cart-number">{{ $total_wishlist }}</span>
								</a>
							</div>
							<div id="top-search" class="header-misc-icon d-none d-sm-block">
								<a href="{{ url('account/cart') }}" id="top-search-trigger">
									<i class="icon-line-bag"></i>
									<span class="top-cart-number">{{ $total_cart }}</span>
								</a>
							</div>
						</div>
						<div id="primary-menu-trigger">
							<svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
						</div>
						<nav class="primary-menu with-arrows mr-lg-auto">
							<ul class="menu-container">
								<li class="menu-item">
									<a class="menu-link" href="{{ url('/') }}">
										<div>Home</div>
									</a>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="{{ url('product') }}">
										<div>Product</div>
									</a>
								</li>
								@php 
									$category = App\Models\Category::where('parent_id', 0)
										->where('status', 1)
										->oldest('name')
										->get(); 
								@endphp
								@foreach($category as $c)
									<li class="menu-item">
										@php
											$sub_1 = App\Models\Category::where('parent_id', $c->id)
												->where('status', 1)
												->oldest('name')
												->get();
										@endphp
										<a class="menu-link" href="{{ $sub_1->count() > 0 ? 'javascript:void(0);' : 'product?category=' . $c->slug }}">
											<div>{{ $c->name }}</div>
										</a>
										@if($sub_1->count() > 0)
											<ul class="sub-menu-container">
												@foreach($sub_1 as $s1)
													<li class="menu-item">
														<a class="menu-link" href="javascript:void(0);">
															<div>{{ $s1->name }}</div>
														</a>
														@php
															$sub_2 = App\Models\Category::where('parent_id', $s1->id)
																->where('status', 1)
																->oldest('name')
																->get();
														@endphp
														@if($sub_2->count() > 0)
															<ul class="sub-menu-container" style="max-height:300px; overflow-y:auto;">
																@foreach($sub_2 as $s2)
																	<li class="menu-item">
																		<a class="menu-link" href="product?category={{ $s2->slug }}">
																			<div>{{ $s2->name }}</div>
																		</a>
																	</li>
																@endforeach
															</ul>
														@endif
													</li>
												@endforeach
											</ul>
										@endif
									</li>
								@endforeach
								<li class="menu-item">
									<a class="menu-link" href="{{ url('infromation/contact') }}">
										<div>Contact</div>
									</a>
								</li>
							</ul>
						</nav>
						<form class="top-search-form" action="{{ url('product') }}" method="GET">
							<input type="text" name="search" class="form-control" placeholder="Search ..." autocomplete="off">
						</form>
					</div>
				</div>
			</div>
			<div class="header-wrap-clone"></div>
		</header>