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
	<link rel="stylesheet" href="{{ asset('template/front-office/css/colors.php?color=30302E') }}">
   <link rel="stylesheet" href="{{ asset('template/plugins/waitMe/waitMe.min.css') }}">
   <link rel="stylesheet" href="{{ asset('template/plugins/countdown/resources/default.css') }}">
	<link rel="stylesheet" href="{{ asset('template/front-office/custom.css') }}">
   <script src="{{ asset('template/front-office/js/jquery.js') }}"></script>
   <script src="{{ asset('template/plugins/waitMe/waitMe.min.js') }}"></script>
   <script src="{{ asset('template/plugins/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
   <script src="{{ asset('template/front-office/custom.js') }}"></script>
   <title>Smart Marble & Bath | {{ $title }}</title>
</head>
<body class="stretched">
	<div id="wrapper" class="clearfix">
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">
					<div class="text-center mb-5">
						<img src="{{ asset('website/logo-black.png') }}" alt="">
					</div>
					<form action="{{ url('checkout/cashless') }}" method="POST" id="form_order" class="topmargin-lg mb-0">
						@csrf
						@if($errors->any())
							<div class="style-msg2 errormsg">
								<div class="msgtitle">Something Wrong :</div>
								<div class="sb-msg">
									<ul>
										@foreach($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>
								</div>
							</div>
						@endif
						<div class="row">
							<div class="col-md-8 mb-3">
								<div class="fancy-title title-double-border">
									<h5 class="text-uppercase">Your Product</h5>
								</div>
								<p>
									<div class="table-responsive">
										<table class="table table-bordered cart">
											<tbody class="table-secondary">
												@php 
													$total_checkout = 0; 
													$total_weight   = 0; 
												@endphp
												@foreach($customer->cart as $c)
													@php 
														$total_checkout += $c->product->price() * $c->qty; 
														$total_weight   += $c->product->type->weight * $c->qty; 
													@endphp
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
									<h5 class="text-uppercase">Shipping Address</h5>
								</div>
								<p>
									<div class="card">
										<div class="card-body">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label class="font-size-11">Receiver Name :<span class="text-danger">*</span></label>
														<input type="text" name="receiver_name" id="receiver_name" class="form-control no-outline font-size-12" value="{{ old('receiver_name', session('fo_name')) }}" placeholder="Enter receiver name" onkeyup="checkSubmitButton()" required>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="font-size-11">Email :<span class="text-danger">*</span></label>
														<input type="email" name="email" id="email" class="form-control no-outline font-size-12" value="{{ old('email', session('fo_email')) }}" placeholder="Enter email" onkeyup="checkSubmitButton()" required>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="font-size-11">Phone :<span class="text-danger">*</span></label>
														<input type="text" name="phone" id="phone" class="form-control no-outline font-size-12" value="{{ old('phone', session('fo_phone')) }}" placeholder="Enter phone" onkeyup="checkSubmitButton()" required>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label class="font-size-11">City :<span class="text-danger">*</span></label>
														<select name="city_id" id="city_id" class="form-control no-outline font-size-12" onchange="getDelivery()" required>
															<option value="">-- Choose --</option>
															@foreach($city as $c)
																<option value="{{ $c->id }}">{{ $c->name }}</option>
															@endforeach
														</select>
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label class="font-size-11">Address :<span class="text-danger">*</span></label>
														<textarea name="address" id="address" class="form-control no-outline font-size-12" placeholder="Enter address" onkeyup="checkSubmitButton()" required>{{ old('address') }}</textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
								</p>
								<div class="fancy-title title-double-border">
									<h5 class="text-uppercase">Fleet</h5>
								</div>
								<p>
									<div class="card">
										<div class="card-body">
											<div class="form-group">
												<label class="font-size-11">Transport :<span class="text-danger">*</span></label>
												<select name="delivery_id" id="delivery_id" class="form-control no-outline font-size-12" onchange="grandtotal()">
													<option value="">-- Choose --</option>
												</select>
											</div>
											<div class="form-group">
												<label class="font-size-11">Important Note :</label>
												<textarea name="description" id="description" class="form-control no-outline font-size-12" placeholder="Enter important note">{{ old('description') }}</textarea>
											</div>
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
															<span class="font-size-13 font-weight-normal">Type Of Transport</span>
														</td>
														<td class="cart-product-name">
															<span class="amount">
																<span class="font-weight-normal font-size-13" id="transport"></span>
															</span>
														</td>
													</tr>
													<tr class="cart_item">
														<td class="cart-product-name">
															<strong class="font-size-13 font-weight-normal">Delivery Cost</strong>
														</td>
														<td class="cart-product-name">
															<span class="amount">
																<span class="font-weight-normal font-size-13" id="shipping_fee"></span>
															</span>
														</td>
													</tr>
													<tr class="cart_item">
														<td class="cart-product-name">
															<span class="font-weight-semibold text-uppercase font-size-14">Total</span>
														</td>
														<td class="cart-product-name">
															<span class="amount color lead">
																<span class="font-weight-semibold font-size-14" id="grandtotal"></span>
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
		grandtotal();
		$('#submit_order').click(function() {
			$('#submit_order').attr('disabled', true);
			$('#submit_order').html('Processing ...');
			$('#form_order').submit();
		});
	});

	function checkSubmitButton() {
		var receiver_name = $('#receiver_name').val();
		var email         = $('#email').val();
		var phone         = $('#phone').val();
		var city_id       = $('#city_id').val();
		var address       = $('#address').val();
		var delivery_id   = $('#delivery_id').val();

		if(receiver_name && email && phone && city_id && address && delivery_id) {
			$('#submit_order').attr('disabled', false);
		} else {
			$('#submit_order').attr('disabled', true);
		}
	}

	function getDelivery() {
		$.ajax({
			url: '{{ url("checkout/process/get_delivery") }}',
			type: 'GET',
         dataType: 'JSON',
         data: {
            city_id: $('#city_id').val(),
				weight: '{{ $total_weight }}'
         },
         beforeSend: function() {
            loadingOpen('#content');
				$('#delivery_id').html('<option value="">-- Choose --</option>');
         },
         success: function(response) {
				grandtotal();
            loadingClose('#content');
				if($('#city_id').val()) {
					if(response.length > 0) {
						$.each(response, function(i, val) {
							$('#delivery_id').append(`
								<option value="` + val.id + `">(` + val.transport_name + `) &nbsp;&nbsp; ` + val.price + `</option>
							`);
						});
					}
				}
         },
         error: function() {
            loadingClose('#content');
				Swal.fire('Ooppsss', 'Server Error', 'error');
         }
		});
	}

	function grandtotal() {
		$.ajax({
			url: '{{ url("checkout/process/grandtotal") }}',
			type: 'GET',
         dataType: 'JSON',
         data: {
            delivery_id: $('#delivery_id').val(),
				weight: '{{ $total_weight }}',
				subtotal: '{{ $total_checkout }}'
         },
         beforeSend: function() {
            loadingOpen('#content');
				$('#transport').html('Not Selected');
				$('#shipping_fee').html('Rp 0');
				$('#grandtotal').html('Rp ' + '{{ number_format($total_checkout) }}');
         },
         success: function(response) {
				checkSubmitButton();
            loadingClose('#content');
				$('#transport').html(response.transport);
				$('#shipping_fee').html(response.shipping_fee);
				$('#grandtotal').html(response.grandtotal);
         },
         error: function() {
            loadingClose('#content');
				Swal.fire('Ooppsss', 'Server Error', 'error');
         }
		});
	}
</script>

<script src="{{ asset('template/front-office/js/plugins.min.js') }}"></script>
<script src="{{ asset('template/front-office/js/functions.js') }}"></script>
</body>
</html>