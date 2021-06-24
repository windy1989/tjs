<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Approval Sales Order</span>
				</h4>
			</div>
			<div class="header-elements">
				<div class="d-flex justify-content-center">
					<a href="{{ url('admin/approval') }}" class="btn bg-secondary btn-labeled btn-labeled-left">
						<b><i class="icon-arrow-left7"></i></b> Back To List
					</a>
				</div>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<a href="{{ url('admin/approval') }}" class="breadcrumb-item">Approval</a>
					<span class="breadcrumb-item active">Detail</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		@if($approval->approvedBy)
			@if($approval->status == 2)
				<div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible">
					<span class="font-weight-semibold">Has been approved!</span> 
					This data has been approved by <b class="font-italic">{{ $approval->approvedBy->name }}</b>
				</div>
			@else
				<div class="alert alert-danger alert-styled-left alert-arrow-left alert-dismissible">
					<span class="font-weight-semibold">Has been rejected!</span> 
					This data has been rejected by <b class="font-italic">{{ $approval->approvedBy->name }}</b>
				</div>
			@endif
		@endif
		<form action="" method="POST" id="form_data">
			@csrf
			<input type="hidden" name="reject" id="input_reject">
			<input type="hidden" name="approved" id="input_approved">
			<div class="card">
				<div class="card-body">
					<p class="text-center font-weight-semibold text-uppercase">Request from {{ $approval->references->name }}</p>
					<div class="form-group"><hr></div>
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
								</ul>
								<ul class="list list-unstyled text-right mb-0 ml-auto">
									<li><h5 class="font-weight-semibold my-2">Rp {{ number_format($order->grandtotal, 0, ',', '.') }}</h5></li>
									<li>{{ $order->number }}</li>
									<li>{{ $order->type() }}</li>
									<li>{{ $order->status() }}</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-sm">
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
							@foreach($order->orderDetail as $key => $od)
								@php $discount = $od->product->pricingPolicy ? $od->product->pricingPolicy->discount_retail_sales : 0; @endphp
								<tr class="text-center">
									<td clas="align-middle">
										<a href="{{ $od->product->type->image() }}" data-lightbox="{{ $od->product->code() }}" data-title="{{ $od->product->code() }}"><img src="{{ $od->product->type->image() }}" style="max-width:70px;" class="img-fluid img-thumbnail"></a>
									</td>
									<td class="align-middle">
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
											Rp {{ number_format($discount * $od->qty, 0, ',', '.') }}
										</span>
									</td>
									<td class="align-middle">
										<span class="font-weight-semibold">Rp {{ number_format($od->total, 0, ',', '.') }}</span>
									</td>
									<td class="align-middle nowrap">
										Rp {{ number_format($od->target_price) }}
									</td>
									<td class="align-middle nowrap">
										{{ date('d-m-Y', strtotime($od->partial_delivery)) }}
									</td>
								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th colspan="3" rowspan="4" class="align-middle">
									@if($order->description)
										{{ $order->description }}
									@else
										No Description
									@endif
								</th>
							</tr>
							<tr>
								<th colspan="2" class="text-right align-middle">SUBTOTAL :</th>
								<th colspan="2" class="text-right text-danger align-middle">
									<h6 class="font-weight-semibold">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</h6>
								</th>
							</tr>
							<tr>
								<th colspan="2" class="text-right align-middle">SHIPPING :</th>
								<th colspan="2" class="text-right text-danger align-middle">
									<h6 class="font-weight-semibold">Rp {{ number_format($order->shipping, 0, ',', '.') }}</h6>
								</th>
							</tr>
							<tr>
								<th colspan="2" class="text-right align-middle">TOTAL :</th>
								<th colspan="2" class="text-right text-danger align-middle">
									<h6 class="font-weight-semibold">Rp {{ number_format($order->grandtotal, 0, ',', '.') }}</h6>
								</th>
							</tr>
							<tr>
								<th colspan="7">
									<div class="form-group mt-3 mb-4">
										<h6 class="text-center font-weight-bold text-uppercase">Delivery</h6>
									</div>
									<table class="table table-sm">
										<tbody>
											<tr>
												<td width="20%">Receiver Name</td>
												<td><b>:</b> {{ $order->orderShipping->receiver_name }}</td>
											</tr>
											<tr>
												<td width="20%">Email</td>
												<td><b>:</b> {{ $order->orderShipping->email }}</td>
											</tr>
											<tr>
												<td width="20%">Phone</td>
												<td><b>:</b> {{ $order->orderShipping->phone }}</td>
											</tr>
											<tr>
												<td width="20%">City</td>
												<td><b>:</b> {{ $order->orderShipping->city->name }}</td>
											</tr>
											<tr>
												<td width="20%">Address</td>
												<td><b>:</b> {{ $order->orderShipping->address }}</td>
											</tr>
											<tr>
												<td width="20%">Transport</td>
												<td>
													<b>:</b> 
													{{ $order->orderShipping->delivery->transport->fleet }}
													&nbsp;&nbsp;
													({{ $order->orderShipping->delivery->vendor->name }})
												</td>
											</tr>
										</tbody>
									</table>
								</th>
							</tr>
						</tfoot>
					</table>
				</div>
				<div class="card-body">
					@if(!$approval->approvedBy)
						<div class="form-group">
							<div class="text-right mt-3">
								<button type="submit" id="btn_reject" class="btn btn-danger btn-labeled btn-labeled-left" onclick="actionSubmit('reject')"><b><i class="icon-cross3"></i></b> Reject</button>
								<button type="submit" id="btn_approved" class="btn btn-success btn-labeled btn-labeled-left" onclick="actionSubmit('approved')"><b><i class="icon-check"></i></b> Agree</button>
							</div>
						</div>
					@endif
				</div>
			</div>
		</form>
	</div>

<script>
	$(function() {
		var notif = '{{ session("success") }}';
		if(notif) {
			swalInit.fire({
				title: 'Success!',
				text: notif,
				type: 'success'
			});
		}
	});

	function actionSubmit(param) {
		if(param == 'reject') {
			$('#input_reject').val('reject');
			$('#input_approved').val(null);
		} else {
			$('#input_reject').val(null);
			$('#input_approved').val('approved');
		}

		$('#btn_reject').attr('disabled', true);
		$('#btn_reject').html('Processing ...');
		$('#btn_approved').attr('disabled', true);
		$('#btn_approved').html('Processing ...');
		$('#form_data').submit();
	}
</script>