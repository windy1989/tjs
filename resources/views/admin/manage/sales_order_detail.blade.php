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
			<input type="hidden" name="purchase_order" id="input_purchase_order" value="purchase_order">
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
									<li>Full Delivery:</li>
								</ul>
								<ul class="list list-unstyled text-right mb-0 ml-auto">
									<li><h5 class="font-weight-semibold my-2">Rp {{ number_format($order->grandtotal, 0, ',', '.') }}</h5></li>
									<li>{{ $order->number }}</li>
									<li>{{ $order->type() }}</li>
									<li>{{ $order->status() }}</li>
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
										@if($order->step == 1)
											@if(old('target_price'))
												@php $target_price = old('target_price')[$key]; @endphp
											@else
												@php $target_price = $od->target_price ; @endphp
											@endif
											<input type="number" class="form-control" name="target_price[]" id="target_price_{{ $od->id }}" value="{{ $target_price }}" onkeyup="checkBtn({{ $od->id }}, {{ $target_price }})" placeholder="0">
										@else
											@php $target_price = $od->target_price; @endphp
											Rp {{ number_format($od->target_price) }}
										@endif
									</td>
									<td class="align-middle" nowrap>
										@if($order->step == 1)
											@if(old('partial_delivery'))
												@php $partial_delivery = old('partial_delivery')[$key]; @endphp
											@else
												@php $partial_delivery = $od->partial_delivery ; @endphp
											@endif
											<input type="date" name="partial_delivery[]" id="partial_delivery" value="{{ $partial_delivery }}" class="form-control" required>
										@else
											{{ date('d-m-Y', strtotime($od->partial_delivery)) }}
										@endif
									</td>
									@php 
										$total_max_discount += $od->total - $od->product->pricingPolicy->discount_retail_sales;
										$total_target_price += $target_price; 
									@endphp
								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th colspan="6" class="text-right">TOTAL :</th>
								<td class="text-right text-danger">
									<h4 class="font-weight-semibold">Rp {{ number_format($order->grandtotal, 0, ',', '.') }}</h4>
								</td>
							</tr>
							<tr>
								<td colspan="4">
									<center>
										<img src="{{ asset(Storage::url($order->qr_code)) }}">
									</center>
								</td>
								<td colspan="3" class="align-middle text-center">
									<p class="font-weight-bold text-uppercase">Description</p>
									<div class="text-muted font-italic">
										@if($order->description)
											{{ $order->description }}
										@else
											No Description
										@endif
									</div>
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
				<div class="card-body">
					<div class="form-group">
						@if($order->step == 1 || $order->step == 3)
							<div class="text-right mt-3">
								<button type="submit" id="btn_approval" class="btn btn-warning btn-labeled btn-labeled-left" onclick="actionSubmit(this)" style="display:none;"><b><i class="icon-check"></i></b> Approval Now</button>
								<button type="submit" id="btn_purchase_order" class="btn btn-primary btn-labeled btn-labeled-left" onclick="actionSubmit(this)"><b><i class="icon-paperplane"></i></b> Create Purchase Order</button>
							</div>
						@else
							<div class="alert alert-info alert-styled-left alert-dismissible">
								<span class="font-weight-bold text-uppercase">Waiting For Approval!</span>
								<span class="float-right font-italic">Please be patient, your order is being approved</span>
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
			$('#btn_purchase_order').hide();
			$('#btn_approval').show();
			$('#input_purchase_order').val(null);
			$('#input_approval').val('approval');
		} else {
			$('#btn_purchase_order').show();
			$('#btn_approval').hide();
			$('#input_purchase_order').val('purchase_order');
			$('#input_approval').val(null);
		}
	}
</script>