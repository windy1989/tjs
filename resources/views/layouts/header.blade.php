@php 
	$total_cart     = App\Models\Cart::where('customer_id', session('fo_id'))->count(); 
	$total_wishlist = App\Models\Wishlist::where('customer_id', session('fo_id'))->count(); 
@endphp
<body class="stretched">
	<div class="body-overlay"></div>
	<div id="side-panel" class="dark">
		<div id="side-panel-trigger-close" class="side-panel-trigger">
			<a href="#"><i class="icon-line-cross"></i></a>
		</div>
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
		<div id="top-bar" class="d-none d-lg-block p-0 m-0">
			<div class="container">
				<div class="row justify-content-between align-items-center">
					<div class="col-12 col-md-auto">
						<div class="top-links on-click">
							<ul class="top-links-container">
								<li class="top-links-item">
									<a href="tel:081230052352" style="text-transform:none;" class="font-weight-normal">
										<i class="icon-line-phone"></i> 0812-3005-2352
									</a>
								</li>
								<li class="top-links-item">
									<a href="https://wa.me/0315477501" target="_blank" style="text-transform:none;">
										<i class="icon-whatsapp"></i> (031) 5477501
									</a>
								</li>
								<li class="top-links-item">
									<a href="mailto:smartmarbleandbath@gmail.com" style="text-transform:none;">
										<i class="icon-line2-envelope"></i> smartmarbleandbath@gmail.com
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-12 col-md-auto">
						<p class="mb-0 py-2 text-center text-md-left">
							<a href="https://www.google.co.id/maps/place/smartmarbleandbath/@-7.2518882,112.7338775,17z/data=!3m1!4b1!4m5!3m4!1s0x2dd7f9699d672725:0x38ff0a5b6a1722a4!8m2!3d-7.2518978!4d112.736106" target="_blank" class="text-dark" style="text-transform:none;">Open Every Monday - Saturday, 08.30 - 17.00 WIB</a>
						</p>
					</div>
				</div>
			</div>
		</div>
		<header id="header" class="header-size-sm" data-sticky-shrink="false">
			<div id="header-wrap">
				<div class="container">
					<div class="header-row">
						<nav class="navbar navbar-expand-lg p-0 m-0 w-100">
							<div id="logo">
								<a href="{{ url('/') }}" class="standard-logo">
									<img src="{{ asset('website/logo-black.png') }}" class="img-fluid" alt="Logo">
								</a>
								<a href="{{ url('/') }}" class="retina-logo">
									<img src="{{ asset('website/logo-black.png') }}" class="img-fluid" alt="Logo">
								</a>
							</div>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
								<span class="icon-line-menu"></span>
							</button>
							<div class="collapse navbar-collapse align-items-end" id="navbarNav">
								<ul class="navbar-nav ml-auto">
									<li class="nav-item">
										<a class="nav-link" href="{{ url('/') }}">
											<div>Home</div>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="{{ url('information/how_to_buy') }}">
											<div>How To Buy</div>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="{{ url('information/about_us') }}">
											<div>About Us</div>
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" href="{{ url('information/contact') }}">
											<div>Contact</div>
										</a>
									</li>
								</ul>
							</div>
						</nav>
					</div>
				</div>
				<div class="bg-light">
					<div class="container">
						<div class="header-row flex-row-reverse flex-lg-row justify-content-between">
							<div class="header-misc">
								<div class="header-buttons mr-3">
									@if(session('fo_id'))
										<a href="{{ url('account/register') }}" class="side-panel-trigger text-dark m-0 ml-2"><i class="icon-line2-user"></i> My Account</a>
									@else
										<a href="{{ url('account/login') }}" class="btn btn-outline-dark btn-sm m-0">Log In</a>
										<a href="{{ url('account/register') }}" class="btn btn-dark btn-sm m-0 ml-2">Sign Up</a>
									@endif
								</div>
								<div id="top-search" class="header-misc-icon">
									<a href="#" id="top-search-trigger"><i class="icon-line-search"></i><i class="icon-line-cross"></i></a>
								</div>
								<div id="top-cart" class="header-misc-icon d-none d-sm-block">
									<a href="#" id="top-cart-trigger"><i class="icon-line-bag"></i><span class="top-cart-number">5</span></a>
									<div class="top-cart-content">
										<div class="top-cart-title">
											<h4>Shopping Cart</h4>
										</div>
										<div class="top-cart-items">
											<div class="top-cart-item">
												<div class="top-cart-item-image">
													<a href="#"><img src="images/shop/small/1.jpg" alt="Blue Round-Neck Tshirt" /></a>
												</div>
												<div class="top-cart-item-desc">
													<div class="top-cart-item-desc-title">
														<a href="#">Blue Round-Neck Tshirt with a Button</a>
														<span class="top-cart-item-price d-block">$19.99</span>
													</div>
													<div class="top-cart-item-quantity">x 2</div>
												</div>
											</div>
											<div class="top-cart-item">
												<div class="top-cart-item-image">
													<a href="#"><img src="images/shop/small/6.jpg" alt="Light Blue Denim Dress" /></a>
												</div>
												<div class="top-cart-item-desc">
													<div class="top-cart-item-desc-title">
														<a href="#">Light Blue Denim Dress</a>
														<span class="top-cart-item-price d-block">$24.99</span>
													</div>
													<div class="top-cart-item-quantity">x 3</div>
												</div>
											</div>
										</div>
										<div class="top-cart-action">
											<span class="top-checkout-price">$114.95</span>
											<a href="#" class="button button-3d button-small m-0">View Cart</a>
										</div>
									</div>
								</div><!-- #top-cart end -->

							</div>

							<div id="primary-menu-trigger">
								<svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
							</div>

							<!-- Primary Navigation
							============================================= -->
							<nav class="primary-menu with-arrows">

								<ul class="menu-container">
									<li class="menu-item"><a class="menu-link" href="#" class="pl-0"><div><i class="icon-line-grid"></i>All Categories</div></a>
										<ul class="sub-menu-container">
											<li class="menu-item"><a class="menu-link" href="#"><div><i class="icon-line2-user"></i>Teacher Training</div></a>
												<ul class="sub-menu-container">
													<li class="menu-item"><a class="menu-link" href="#"><div>All Teacher Training</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item"><a class="menu-link" href="#"><div>Level 3</div></a></li>
														</ul>
													</li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Educational Training</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Teaching Tools</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Others</div></a></li>
												</ul>
											</li>
											<li class="menu-item"><a class="menu-link" href="#"><div><i class="icon-chart-bar1"></i>Business</div></a>
												<ul class="sub-menu-container">
													<li class="menu-item"><a class="menu-link" href="#"><div>All Business Classes</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item"><a class="menu-link" href="#"><div>Level 3</div></a></li>
														</ul>
													</li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Finance</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Sales</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Marketing</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Industry</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Real Estates</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Others</div></a></li>
												</ul>
											</li>
											<li class="menu-item"><a class="menu-link" href="#"><div><i class="icon-code1"></i>Development</div></a>
												<ul class="sub-menu-container">
													<li class="menu-item"><a class="menu-link" href="#"><div>All Development Training</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item"><a class="menu-link" href="#"><div>Level 3</div></a></li>
														</ul>
													</li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Software Training</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Graphics Tools</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Development Skills</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Others</div></a></li>
												</ul>
											</li>
											<li class="menu-item"><a class="menu-link" href="#"><div><i class="icon-line2-screen-smartphone"></i>IT & Software</div></a>
												<ul class="sub-menu-container">
													<li class="menu-item"><a class="menu-link" href="#"><div>All IT & Software Training</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item"><a class="menu-link" href="#"><div>Level 3</div></a></li>
														</ul>
													</li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Software Training</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Application Tools</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Others</div></a></li>
												</ul>
											</li>
											<li class="menu-item"><a class="menu-link" href="#"><div><i class="icon-music1"></i>Music</div></a>
												<ul class="sub-menu-container">
													<li class="menu-item"><a class="menu-link" href="#"><div>All Music Classes</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item"><a class="menu-link" href="#"><div>Level 3</div></a></li>
														</ul>
													</li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Instrumental</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Vocals</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Lyrics</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Others</div></a></li>
												</ul>
											</li>
											<li class="menu-item"><a class="menu-link" href="#"><div><i class="icon-line2-game-controller"></i>Lifestyle</div></a>
												<ul class="sub-menu-container">
													<li class="menu-item"><a class="menu-link" href="#"><div>All Lifestyle Training</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item"><a class="menu-link" href="#"><div>Level 3</div></a></li>
														</ul>
													</li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Art &amp; Crafts</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Foods & Beverages</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Gaming</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Others</div></a></li>
												</ul>
											</li>
											<li class="menu-item"><a class="menu-link" href="#"><div><i class="icon-line2-globe"></i>Language</div></a>
												<ul class="sub-menu-container">
													<li class="menu-item"><a class="menu-link" href="#"><div>All Languages</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item"><a class="menu-link" href="#"><div>Level 3</div></a></li>
														</ul>
													</li>
													<li class="menu-item"><a class="menu-link" href="#"><div>English</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Spanish</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Germans</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Hindi</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Russian</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Others</div></a></li>
												</ul>
											</li>
											<li class="menu-item"><a class="menu-link" href="#"><div><i class="icon-health"></i>Health &amp; Fitness</div></a>
												<ul class="sub-menu-container">
													<li class="menu-item"><a class="menu-link" href="#"><div>All Health &amp; Fitness</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item"><a class="menu-link" href="#"><div>Level 3</div></a></li>
														</ul>
													</li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Yoga</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Gym</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Sports</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Nutrition</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Others</div></a></li>
												</ul>
											</li>
											<li class="menu-item"><a class="menu-link" href="#"><div><i class="icon-line2-crop"></i>Design</div></a>
												<ul class="sub-menu-container">
													<li class="menu-item"><a class="menu-link" href="#"><div>All Designs</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item"><a class="menu-link" href="#"><div>Level 3</div></a></li>
														</ul>
													</li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Game Design</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Graphic Design</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Web Design</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Others</div></a></li>
												</ul>
											</li>

											<li class="menu-item"><a class="menu-link" href="#"><div><i class="icon-food"></i>Food</div></a>
												<ul class="sub-menu-container">
													<li class="menu-item"><a class="menu-link" href="#"><div>All Food Recipes</div></a>
														<ul class="sub-menu-container">
															<li class="menu-item"><a class="menu-link" href="#"><div>Level 3</div></a></li>
														</ul>
													</li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Heathy Foods</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Fast Foods</div></a></li>
													<li class="menu-item"><a class="menu-link" href="#"><div>Others</div></a></li>
												</ul>
											</li>
										</ul>
									</li>
								</ul>

							</nav><!-- #primary-menu end -->

							<form class="top-search-form" action="search.html" method="get">
								<input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter.." autocomplete="off">
							</form>

						</div>
					</div>
				</div>
			</div>
			<div class="header-wrap-clone"></div>
		</header><!-- #header end -->
		{{-- <header id="header" class="full-header header-size-md">
			<div id="header-wrap">
				<div class="container">
					<div class="header-row justify-content-lg-between">
						<div id="logo">
							<a href="{{ url('/') }}" class="standard-logo">
								<img src="{{ asset('website/logo-black.png') }}" class="img-fluid" alt="Logo">
							</a>
							<a href="{{ url('/') }}" class="retina-logo">
								<img src="{{ asset('website/logo-black.png') }}" class="img-fluid" alt="Logo">
							</a>
						</div>
						<div class="header-misc">
							<div id="top-account">
								@if(session('fo_id'))
									<a href="javascript:void(0);" class="side-panel-trigger text-dark">
										<i class="icon-line2-user mr-1 position-relative" style="top: 1px;"></i>
										<span class="d-none d-sm-inline-block font-primary font-weight-medium text-dark">My Account</span>
									</a>
								@else
									<a href="{{ url('account/login') }}">
										<i class="icon-line2-user mr-1 position-relative text-dark" style="top: 1px;"></i>
										<span class="d-none d-sm-inline-block font-primary font-weight-medium text-dark">Login / Register</span>
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
									@php 
										$category = App\Models\Category::where('parent_id', 0)
											->where('status', 1)
											->oldest('name')
											->get(); 
									@endphp
									<ul class="sub-menu-container">
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
									</ul>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="{{ url('information/how_to_buy') }}">
										<div>How To Buy</div>
									</a>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="{{ url('information/about_us') }}">
										<div>About Us</div>
									</a>
								</li>
								<li class="menu-item">
									<a class="menu-link" href="{{ url('information/contact') }}">
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
		</header> --}}