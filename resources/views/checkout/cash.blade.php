<section id="page-title" class="page-title-mini">
   <div class="container clearfix">
      <h1>Confirmation Order</h1>
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="{{ url('/') }}">Home</a>
         </li>
         <li class="breadcrumb-item">
            <a href="javascript:void(0);">Checkout</a>
         </li>
         <li class="breadcrumb-item active" aria-current="page">
            Confirmation Order
         </li>
      </ol>
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
								<div class="form-group">
									<textarea name="description" id="description" class="form-control mb-0" placeholder="Enter important note">{{ old('description') }}</textarea>
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