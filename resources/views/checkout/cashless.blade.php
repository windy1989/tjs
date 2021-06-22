<section id="page-title">
   <div class="container">
      <h1>Cashless</h1>
   </div>
</section>
<section id="content">
	<div class="content-wrap">
		<div class="container clearfix">
			<form action="{{ url('checkout/cashless') }}" method="POST" id="form_order">
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
				<div class="row col-mb-50 gutter-50 justify-content-end">
					<div class="w-100"></div>
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<h4>Your Product</h4>
								<div class="table-responsive">
									<table class="table cart mb-5">
										<thead>
											<tr>
												<th class="cart-product-thumbnail">Image</th>
												<th class="cart-product-name">Product</th>
												<th class="cart-product-price">Unit Price</th>
												<th class="cart-product-quantity">Qty</th>
												<th class="cart-product-quantity">Ready Stock</th>
												<th class="cart-product-quantity">Indent Stock</th>
												<th class="cart-product-subtotal">Total</th>
											</tr>
										</thead>
										<tbody>
											@php 
												$total_checkout = 0; 
												$total_weight   = 0; 
											@endphp
											@foreach($customer->cart as $c)
												@php 
													$total_checkout += $c->product->price() * $c->qty; 
													$total_weight   += $c->product->type->weight * $c->qty; 
												@endphp
												<tr class="cart_item">
													<td class="cart-product-thumbnail">
														<a href="{{ url('product/detail/' . base64_encode($c->id)) }}">
															<img width="64" height="64" src="{{ $c->product->type->image() }}" class="img-fluid">
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
													<td class="cart-product-quantity">
														<span class="amount">
															<span class="d-inline">Ready</span> 
															<strong class="badge badge-success"> 
																@php
																	$total_stock   = $c->product->productShading->sum('qty');
																	$total_request = abs($c->qty);

																	if($total_request > $total_stock) {
																		$total_indent = $total_request - $total_stock;
																		echo abs($total_request - $total_indent);
																	} else {
																		echo $total_request;
																	}
																@endphp
															</strong>
														</span>
													</td>
													<td class="cart-product-quantity">
														<span class="amount">
															<span class="d-inline">Indent</span> 
															<strong class="badge badge-info"> 
																@php
																	$total_stock   = $c->product->productShading->sum('qty');
																	$total_request = abs($c->qty);

																	if($total_request > $total_stock) {
																		echo $total_request - $total_stock;
																	} else {
																		echo 0;
																	}
																@endphp
															</strong>
														</span>
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
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<h4>Shipping Address</h4>
								<div class="form-group"><hr></div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Receiver Name :<span class="text-danger">*</span></label>
											<input type="text" name="receiver_name" id="receiver_name" class="form-control" value="{{ old('receiver_name', session('fo_name')) }}" placeholder="Enter receiver name" onkeyup="checkSubmitButton()" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Email :<span class="text-danger">*</span></label>
											<input type="email" name="email" id="email" class="form-control" value="{{ old('email', session('fo_email')) }}" placeholder="Enter email" onkeyup="checkSubmitButton()" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Phone :<span class="text-danger">*</span></label>
											<input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', session('fo_phone')) }}" placeholder="Enter phone" onkeyup="checkSubmitButton()" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>City :<span class="text-danger">*</span></label>
											<select name="city_id" id="city_id" class="form-control" onchange="getDelivery()" required>
												<option value="">-- Choose --</option>
												@foreach($city as $c)
													<option value="{{ $c->id }}">{{ $c->name }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Address :<span class="text-danger">*</span></label>
											<textarea name="address" id="address" class="form-control" placeholder="Enter address" onkeyup="checkSubmitButton()" required>{{ old('address') }}</textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<h4>Fleet</h4>
								<div class="form-group"><hr></div>
								<div class="form-group">
									<label>Transport :<span class="text-danger">*</span></label>
									<select name="delivery_id" id="delivery_id" class="form-control" onchange="grandtotal()">
										<option value="">-- Choose --</option>
									</select>
								</div>
								<div class="form-group">
									<label>Additional Note :</label>
									<textarea name="description" id="description" class="form-control" placeholder="Enter additional note" onkeyup="checkSubmitButton()">{{ old('description') }}</textarea>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="card">
							<div class="card-body">
								<h4>Summary</h4>
								<div class="table-responsive">
									<table class="table cart">
										<tbody>
											<tr class="cart_item">
												<td class="cart-product-name">
													<strong>Subtotal</strong>
												</td>
												<td class="cart-product-name">
													<span class="amount">
														<strong id="subtotal">Rp {{ number_format($total_checkout, 0, ',', '.') }}</strong>
													</span>
												</td>
											</tr>
											<tr class="cart_item">
												<td class="cart-product-name">
													<strong>Transport</strong>
												</td>
												<td class="cart-product-name">
													<span class="amount">
														<strong id="transport"></strong>
													</span>
												</td>
											</tr>
											<tr class="cart_item">
												<td class="cart-product-name">
													<strong>Shipping Fee</strong>
												</td>
												<td class="cart-product-name">
													<span class="amount">
														<strong id="shipping_fee"></strong>
													</span>
												</td>
											</tr>
											<tr class="cart_item">
												<td class="cart-product-name">
													<strong>Total</strong>
												</td>
												<td class="cart-product-name">
													<span class="amount color lead">
														<strong style="font-size:20px;" class="text-danger font-weight-bold" id="grandtotal"></strong>
													</span>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-dark float-right mt-4" id="submit_order">Submit Order</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

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
			type: 'POST',
         dataType: 'JSON',
         data: {
            city_id: $('#city_id').val(),
				weight: '{{ $total_weight }}'
         },
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
			type: 'POST',
         dataType: 'JSON',
         data: {
            delivery_id: $('#delivery_id').val(),
				weight: '{{ $total_weight }}',
				subtotal: '{{ $total_checkout }}'
         },
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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