<!DOCTYPE html>
<html dir="ltr" lang="id-ID">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="author" content="Calvin Dito Pratama">
   <meta name="google-site-verification" content="-PVsEPUU7R41vERWZ6fLe04fbAUA8mlyRjNHM2AkCDg">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Montserrat:300,400,500,600,700|Merriweather:300,400,300i,400i&display=swap" rel="stylesheet">
   <link rel="shortcut icon" href="{{ asset('website/icon.png') }}">
	<link rel="stylesheet" href="{{ asset('template/front-office/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('template/front-office/style.css') }}">
	<link rel="stylesheet" href="{{ asset('template/front-office/css/dark.css') }}">
	<link rel="stylesheet" href="{{ asset('template/front-office/css/swiper.css') }}">
	<link rel="stylesheet" href="{{ asset('template/front-office/demos/shop/css/fonts.css') }}">
	<link rel="stylesheet" href="{{ asset('template/front-office/demos/shop/shop.css') }}">
	<link rel="stylesheet" href="{{ asset('template/front-office/css/font-icons.css') }}">
	<link rel="stylesheet" href="{{ asset('template/front-office/css/animate.css') }}">
	<link rel="stylesheet" href="{{ asset('template/front-office/css/magnific-popup.css') }}">
	<link rel="stylesheet" href="{{ asset('template/front-office/css/colors.php?color=51b4ba') }}">
   <link rel="stylesheet" href="{{ asset('template/plugins/waitMe/waitMe.min.css') }}">
   <link rel="stylesheet" href="{{ asset('template/plugins/countdown/resources/default.css') }}">
	<link rel="stylesheet" href="{{ asset('template/front-office/custom.css') }}">
   <script src="{{ asset('template/front-office/js/jquery.js') }}"></script>
   <script src="{{ asset('template/plugins/waitMe/waitMe.min.js') }}"></script>
   <script src="{{ asset('template/plugins/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
   <script src="{{ asset('template/plugins/countdown/source/syotimer.lang.js') }}"></script>
   <script src="{{ asset('template/plugins/countdown/source/jquery.syotimer.js') }}"></script>
   <script src="{{ asset('template/plugins/side-panel/dist/jquery.slidereveal.min.js') }}"></script>
   <script src="{{ asset('template/front-office/custom.js') }}"></script>
   <title>Smart Marble & Bath | {{ $title }}</title>
</head>
<body class="stretched">
	<section id="page-title" class="page-title">
		<div class="container clearfix">
			<h1>
				<img src="{{ asset('website/logo-black.png') }}" alt="">
			</h1>
			<ol class="breadcrumb text-uppercase font-weight-bold">
				<li class="breadcrumb-item active" aria-current="page">
					Checkout
				</li>
			</ol>
		</div>
	</section>
	<div id="wrapper" class="clearfix">
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">
					<form action="{{ url('checkout/cash') }}" method="POST" id="form_order" class="mb-0">
						@csrf
						<div class="row">
							<div class="col-md-8 mb-3">
								<div class="fancy-title title-double-border">
									<h5 class="text-uppercase">Your Product</h5>
								</div>
								<p>
									<div class="table-responsive">
										<table class="table table-bordered cart">
											<tbody class="table-secondary">
												@php $total_checkout = 0; @endphp
												@foreach($customer->cart as $c)
													@php $total_checkout += $c->product->price() * $c->qty; @endphp
													<tr class="cart_item text-center">
														<td class="cart-product-name">
															<a href="{{ url('product/detail/' . base64_encode($c->id)) }}">
																<center>
																	<img width="64" height="64" src="{{ $c->product->type->image() }}" class="img-fluid img-thumbnail">
																</center>
															</a>
														</td>
														<td class="cart-product-name">
															<a href="{{ url('product/detail/' . base64_encode($c->id)) }}">{{ $c->product->code() }}</a>
														</td>
														<td class="cart-product-quantity">
															<span class="amount">Rp {{ number_format($c->product->price(), 0, ',', '.') }}</span>
														</td>
														<td class="cart-product-quantity">
															<div class="quantity">
																<span class="amount">x{{ $c->qty }}</span>
															</div>
														</td>
														<td class="cart-product-subtotal">
															<span class="amount">
																Rp {{ number_format($c->product->price() * $c->qty, 0, ',', '.') }}
															</span>
														</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</p>
								<div class="fancy-title title-double-border">
									<h5 class="text-uppercase">Important Note</h5>
								</div>
								<p>
									<div class="form-group">
										<textarea name="description" id="description" class="form-control no-outline font-size-14" placeholder="Enter important note">{{ old('description') }}</textarea>
									</div>
								</p>
								<div class="form-group"><hr></div>
								<p>
									<div class="input-group mb-3">
										<input type="text" name="voucher_code" id="voucher_code" class="form-control font-size-12 text-uppercase" placeholder="Enter voucher code">
										<div class="input-group-append">
											<button type="button" class="btn bg-teal font-size-12 text-uppercase">Claim</button>
										</div>
									</div>
								</p>
							</div>
							<div class="col-md-4">
								<div class="card border-secondary">
									<div class="card-body">
										<h4>Summary</h4>
										<div class="table-responsive">
											<table class="table cart">
												<tbody>
													<tr class="cart_item">
														<td class="cart-product-name">
															<span class="font-size-13 font-weight-normal">Subtotal</span>
														</td>
														<td class="cart-product-name">
															<span class="amount">
																<span class="font-weight-normal font-size-13" id="subtotal">Rp {{ number_format($total_checkout, 0, ',', '.') }}</span>
															</span>
														</td>
													</tr>
													<tr class="cart_item">
														<td class="cart-product-name">
															<span class="font-size-13 font-weight-normal">Discount</span>
														</td>
														<td class="cart-product-name">
															<span class="amount">
																<span class="font-weight-normal font-size-13" id="discount">Rp 0</span>
															</span>
														</td>
													</tr>
													<tr class="cart_item">
														<td class="cart-product-name">
															<span class="font-weight-semibold text-uppercase font-size-14">Total</span>
														</td>
														<td class="cart-product-name">
															<span class="amount color lead">
																<span class="font-weight-semibold font-size-14 text-dark" id="grandtotal">Rp {{ number_format($total_checkout, 0, ',', '.') }}</span>
															</span>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="fancy-title"></div>
								<div class="form-group">
									<div class="row justify-content-center">
										<div class="col-md-6">
											<button type="submit" class="btn bg-teal text-white col-12 font-size-14" id="submit_order">Submit Order</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>

<script>
	$(function() {
		$('#submit_order').click(function() {
			$('#submit_order').attr('disabled', true);
			$('#submit_order').html('Processing ...');
			$('#form_order').submit();
		});
	});
</script>

<script src="{{ asset('template/front-office/js/plugins.min.js') }}"></script>
<script src="{{ asset('template/front-office/js/functions.js') }}"></script>
</body>
</html>