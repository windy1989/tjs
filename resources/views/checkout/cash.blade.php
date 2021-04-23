<section id="page-title">
   <div class="container">
      <h1>Confirmation Order</h1>
   </div>
</section>
<section id="content">
	<div class="content-wrap">
		<div class="container clearfix">
			<form action="{{ url('checkout/cash') }}" method="POST" id="form_order">
				@csrf
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
											@php $total_checkout = 0; @endphp
											@foreach($customer->cart as $c)
												@php $total_checkout += $c->product->price() * $c->qty; @endphp
												<tr class="cart_item">
													<td class="cart-product-thumbnail">
														<a href="{{ url('product/detail/' . base64_encode($c->id)) }}">
															<img width="64" height="64" src="{{ Storage::exists($c->product->type->image) ? asset(Storage::url($c->product->type->image)) : asset('website/empty.jpg') }}">
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
															<strong class="badge badge-success" id="total_ready_{{ $c->id }}"> 
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
															<strong class="badge badge-info"  id="total_indent_{{ $c->id }}"> 
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
														<span class="amount" id="total_price_{{ $c->id }}">
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
					<div class="col-lg-6">
						<div class="card">
							<div class="card-body">
								<h4>Summary</h4>
								<div class="table-responsive">
									<table class="table cart">
										<tbody>
											<tr class="cart_item">
												<td class="cart-product-name">
													<strong style="font-size:20px;" class="text-uppercase">Total</strong>
												</td>
												<td class="cart-product-name">
													<span class="amount color lead">
														<strong id="grandtotal">Rp {{ number_format($total_checkout, 0, ',', '.') }}</strong>
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
		$('#submit_order').click(function() {
			$('#submit_order').attr('disabled', true);
			$('#submit_order').html('Processing ...');
			$('#form_order').submit();
		});
	});
</script>