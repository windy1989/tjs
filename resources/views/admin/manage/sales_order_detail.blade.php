<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Sales Order Detail</span>
				</h4>
			</div>
			<div class="header-elements">
				<div class="d-flex justify-content-center">
					<a href="{{ url('admin/manage/sales_order') }}" class="btn bg-secondary btn-labeled btn-labeled-left">
						<b><i class="icon-arrow-left7"></i></b> Back To List
					</a>
				</div>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<a href="javascript:void(0);" class="breadcrumb-item">Manage</a>
					<a href="{{ url('admin/manage/sales_order') }}" class="breadcrumb-item">Sales Order</a>
					<span class="breadcrumb-item active">Detail</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		@if($errors->any())
			<div class="alert alert-danger">
				<ul>
					@php $validation = array_unique($errors->all()); @endphp
					@foreach($validation as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@elseif(session('success'))
			<div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible">
				<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
				<span class="font-weight-semibold">Success!</span> 
				{{ session('success') }}
			</div>
		@endif
		<form action="" method="POST" id="form_data">
			@csrf
			<input type="hidden" name="invoice" id="input_invoice" value="invoice">
			<input type="hidden" name="approval" id="input_approval">
			<div class="card">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="mb-4">
								<img src="{{ asset('website/logo-black.png') }}" class="mb-3 mt-2" alt="" style="width: 120px;">
								<ul class="list list-unstyled mb-0">
									<li>Jawa Timur, Surabaya</li>
									<li>Modern Ceramics, Baliwerti 119-121 Kav. 10</li>
									<li>082131972353</li>
								</ul>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="mb-4">
								<div class="text-sm-right">
									<h4 class="text-primary mb-2 mt-md-2">{{ $order->sales_order }}</h4>
									<ul class="list list-unstyled mb-0">
										<li>Date: <span class="font-weight-semibold">{{ date('F d, Y', strtotime($order->created_at)) }}</span></li>
										<li>Due date: <span class="font-weight-semibold">{{ date('F d, Y', strtotime('+1 day', strtotime($order->created_at))) }}</span></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="d-md-flex flex-md-wrap">
						<div class="mb-4 mb-md-2">
							<span class="text-muted">Sales Order To:</span>
							<ul class="list list-unstyled mb-0">
								<li><h5 class="my-2">{{ $order->customer->name }}</h5></li>
								<li>{{ $order->customer->phone ? $order->customer->phone : '-' }}</li>
								<li><a href="mailto:{{ $order->customer->email }}">{{ $order->customer->email }}</a></li>
							</ul>
						</div>
						<div class="mb-2 ml-auto">
							<span class="text-muted">Payment Details:</span>
							<div class="d-flex flex-wrap wmin-md-400">
								<ul class="list list-unstyled mb-0">
									<li><h5 class="my-2">Total Due:</h5></li>
									<li>Number:</li>
									<li>Type:</li>
									<li>Status:</li>
									@if(!$order->invoice)
										<li>Full Delivery:</li>
									@endif
								</ul>
								<ul class="list list-unstyled text-right mb-0 ml-auto">
									<li><h5 class="font-weight-semibold my-2">Rp {{ number_format($order->grandtotal, 0, ',', '.') }}</h5></li>
									<li>{{ $order->number }}</li>
									<li>{{ $order->type() }}</li>
									<li>{{ $order->status() }}</li>
									@if(!$order->invoice)
										<li>
											<div class="input-group">
												<span class="input-group-prepend">
													<span class="input-group-text" style="border-radius:0;">
														<input type="checkbox" name="full_delivery_check" id="full_delivery_check" onclick="changeAllPartial()" {{ old('full_delivery_check') ? 'checked' : '' }}>
													</span>
												</span>
												<input type="date" name="full_delivery_date" id="full_delivery_date" value="{{ old('full_delivery_date') }}" onchange="changeAllPartial()" style="border-radius:0; border: 1px solid lightgray;">
											</div>
										</li>
									@endif
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-lg">
						<thead>
							<tr class="text-center">
								<th>Image</th>
								<th>Product</th>
								<th>Price</th>
								<th>Max Discount</th>
								<th>Total</th>
								<th>Target Price</th>
								<th>Partial Delivery</th>
							</tr>
						</thead>
						<tbody>
							@php 
								$total_max_discount = 0;
								$total_target_price = 0; 
								$total_weight       = 0;
							@endphp
							@foreach($order->orderDetail as $key => $od)
								<input type="hidden" name="order_detail_id[]" value="{{ $od->id }}">
								<tr class="text-center">
									<td clas="align-middle">
										<a href="{{ $od->product->type->image() }}" data-lightbox="{{ $od->product->code() }}" data-title="{{ $od->product->code() }}"><img src="{{ $od->product->type->image() }}" style="max-width:70px;" class="img-fluid img-thumbnail"></a>
									</td>
									<td class="align-middle" nowrap>
										<h6 class="mb-0">{{ $od->product->code() }}</h6>
										<div class="text-muted">Qty <b>{{ $od->qty }}</b> Item</div>
										<div class="text-muted">Ready <b>{{ $od->ready }}</b> Item</div>
										<div class="text-muted">Indent <b>{{ $od->indent }}</b> Item</div>
									</td>
									<td class="align-middle">
										<center>
											Rp {{ number_format($od->price_list, 0, ',', '.') }}
										</center>
									</td>
									<td class="align-middle">
										<span class="font-weight-semibold">
											Rp {{ number_format($od->total - $od->product->pricingPolicy->discount_retail_sales, 0, ',', '.') }}
										</span>
									</td>
									<td class="align-middle">
										<span class="font-weight-semibold">Rp {{ number_format($od->total, 0, ',', '.') }}</span>
									</td>
									<td class="align-middle" nowrap>
										@if(old('target_price'))
											@php $target_price = old('target_price')[$key]; @endphp
										@else
											@php $target_price = $od->target_price ; @endphp
										@endif
										@if($order->approval || $order->invoice)
											<input type="hidden" name="target_price[]" value="{{ $target_price }}">
											Rp {{ number_format($target_price) }}
										@else
											<input type="number" class="form-control" name="target_price[]" id="target_price_{{ $od->id }}" value="{{ $target_price }}" onkeyup="checkBtn({{ $od->id }}, {{ $target_price }})" placeholder="0">
										@endif
									</td>
									<td class="align-middle" nowrap>
										@if(old('partial_delivery'))
											@php $partial_delivery = old('partial_delivery')[$key]; @endphp
										@else
											@php $partial_delivery = $od->partial_delivery ; @endphp
										@endif
										@if($order->approval || $order->invoice)
											<input type="hidden" name="partial_delivery[]" value="{{ $partial_delivery }}">
											{{ date('d-m-Y', strtotime($od->partial_delivery)) }}
										@else
											<input type="date" name="partial_delivery[]" id="partial_delivery" value="{{ $partial_delivery }}" class="form-control" required>
										@endif
									</td>
									@php 
										$total_max_discount += $od->total - $od->product->pricingPolicy->discount_retail_sales;
										$total_target_price += $target_price; 
										$total_weight       += $od->product->type->weight * $od->qty
									@endphp
								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th colspan="4" class="align-middle">
									@if($order->description)
										{{ $order->description }}
									@else
										No Description
									@endif
								</th>
								<th colspan="2" class="text-right align-middle">TOTAL :</th>
								<td colspan="1" class="text-right text-danger align-middle">
									<h4 class="font-weight-semibold">Rp {{ number_format($order->grandtotal, 0, ',', '.') }}</h4>
								</td>
							</tr>
							<tr>
								<td colspan="7">
									<div class="form-group">
										<h6 class="text-center font-weight-bold text-uppercase">Transport</h6>
									</div>
									@php
										if($order->orderShipping) {
											$city_id       = $order->orderShipping->city_id;
											$delivery      = $order->orderShipping->delivery;
											$receiver_name = $order->orderShipping->receiver_name;
											$email         = $order->orderShipping->email;
											$phone         = $order->orderShipping->phone;
											$address       = $order->orderShipping->address;
										} else {
											$city_id       = null;
											$delivery      = null;
											$receiver_name = $order->customer->name;
											$email         = $order->customer->email;
											$phone         = $order->customer->phone;
											$address       = null;
										}
									@endphp
									@if($order->approval || $order->invoice)
										<table class="table table-lg">
											<tbody>
												<tr>
													<th width="20%">Name</th>
													<td><b>:</b> {{ $order->orderShipping ? $order->orderShipping->receiver_name : 'Delivery not set' }}</td>
												</tr>
												<tr>
													<th width="20%">Email</th>
													<td><b>:</b> {{ $order->orderShipping ? $order->orderShipping->email : 'Delivery not set' }}</td>
												</tr>
												<tr>
													<th width="20%">Phone</th>
													<td><b>:</b> {{ $order->orderShipping ? $order->orderShipping->phone : 'Delivery not set' }}</td>
												</tr>
												<tr>
													<th width="20%">City</th>
													<td><b>:</b> {{ $order->orderShipping ? $order->orderShipping->city->name : 'Delivery not set' }}</td>
												</tr>
												<tr>
													<th width="20%">Address</th>
													<td><b>:</b> {{ $order->orderShipping ? $order->orderShipping->address : 'Delivery not set' }}</td>
												</tr>
											</tbody>
										</table>
									@else
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label>City :<span class="text-danger">*</span></label>
													<select name="city_id" id="city_id" class="select2" onchange="getDelivery()" required>
														<option value="">-- Choose --</option>
														@foreach($city as $c)
															<option value="{{ $c->id }}" {{ $city_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label>Fleet :<span class="text-danger">*</span></label>
													<select name="delivery_id" id="delivery_id" class="select2" required>
														<option value="">-- Choose --</option>
														@if($delivery)
															<option value="{{ $delivery->id }}" selected>({{ $delivery->transport->fleet }}) &nbsp;&nbsp; Rp {{ number_format($delivery->price, 0, ',', '.') }}</option> 
														@endif
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Receiver Name :<span class="text-danger">*</span></label>
													<input type="text" name="receiver_name" id="receiver_name" class="form-control" value="{{ old('receiver_name', $receiver_name) }}" placeholder="Enter receiver name" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Email :<span class="text-danger">*</span></label>
													<input type="text" name="email" id="email" class="form-control" value="{{ old('email', $email) }}" placeholder="Enter email" required>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Phone :<span class="text-danger">*</span></label>
													<input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $phone) }}" placeholder="Enter phone" required>
												</div>
											</div>
											<div class="col-md-12">
												<div class="form-group">
													<label>Address :<span class="text-danger">*</span></label>
													<textarea name="address" id="address" class="form-control" placeholder="Enter address" required>{{ old('address', $address) }}</textarea>
												</div>
											</div>
										</div>
									@endif
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
				<div class="card-body">
					<div class="form-group">
						@if($order->approval)
							@if($order->approval->status == 1)
								<div class="alert alert-info alert-styled-left alert-dismissible">
									<span class="font-weight-bold text-uppercase">Waiting For Approval!</span>
									<span class="float-right font-italic">Please be patient, your order is being approved</span>
								</div>
							@else
								<div class="alert alert-success alert-styled-left alert-dismissible">
									<span class="font-weight-bold text-uppercase">Well Done!</span>
									<span class="float-right font-italic">Data has been processed</span>
								</div>
							@endif
						@else
							<div class="text-right mt-3">
								<button type="submit" id="btn_approval" class="btn btn-warning btn-labeled btn-labeled-left" onclick="actionSubmit(this)" style="display:none;"><b><i class="icon-check"></i></b> Approval Now</button>
								<button type="submit" id="btn_invoice" class="btn btn-primary btn-labeled btn-labeled-left" onclick="actionSubmit(this)"><b><i class="icon-paperplane"></i></b> Create Invoice</button>
							</div>
						@endif
					</div>
				</div>
			</div>
		</form>
	</div>

<script>
	function actionSubmit(event) {
		$(event).attr('disabled', true);
		$(event).html('Processing ...');
		$('#form_data').submit();
	}

	function changeAllPartial() {
		var check            = $('#full_delivery_check');
		var date             = $('#full_delivery_date');
		var partial_delivery = $('input[name="partial_delivery[]"]');

		if(check.is(':checked')) {
			partial_delivery.attr('readonly', true);
			if(date.val()) {
				partial_delivery.val(date.val());
			}
		} else {
			date.val(null);
			partial_delivery.attr('readonly', false);
		}
	}

	function getDelivery() {
		$.ajax({
			url: '{{ url("admin/manage/sales_order/get_delivery") }}',
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
            loadingOpen('.content');
				$('#delivery_id').html('<option value="">-- Choose --</option>');
         },
         success: function(response) {
            loadingClose('.content');
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
            loadingClose('.content');
				swalInit.fire({
					title: 'Server Error',
					text: 'Please contact developer',
					type: 'error'
				});
         }
		});
	}

	function checkBtn(id, target_price_real) {
		var total_max_discount = parseFloat("{{ $total_max_discount }}");
		var total_target_price = parseFloat("{{ $total_target_price }}");
		var target_price_value = parseFloat($('#target_price_' + id).val());

		if(target_price_value >= target_price_real) {
			var total_all_target_price = total_target_price;
		} else {
			var total_all_target_price = (total_target_price - target_price_real) + target_price_value;
		}

		if(total_all_target_price < total_max_discount) {
			$('#btn_invoice').hide();
			$('#btn_approval').show();
			$('#input_invoice').val(null);
			$('#input_approval').val('approval');
		} else {
			$('#btn_invoice').show();
			$('#btn_approval').hide();
			$('#btn_invoice').val('invoice');
			$('#input_approval').val(null);
		}
	}
</script>