<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Manage Order SO</span>
				</h4>
			</div>
			<div class="header-elements">
				<div class="d-flex justify-content-center">
					<a href="{{ url('admin/manage/order') }}" class="btn bg-secondary btn-labeled btn-labeled-left">
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
					<a href="{{ url('admin/manage/order') }}" class="breadcrumb-item">Order</a>
					<span class="breadcrumb-item active">SO</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
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
								<h4 class="text-primary mb-2 mt-md-2">{{ $order->code }}</h4>
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
						<span class="text-muted">SO To:</span>
						<ul class="list list-unstyled mb-0">
							<li><h5 class="my-2">{{ $order->customer->name }}</h5></li>
							<li><span class="font-weight-semibold">Province</span></li>
							<li>City</li>
							<li>Address</li>
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
												<input type="checkbox" name="full_delivery_check" id="full_delivery_check" onclick="changeAllPartial()">
											</span>
										</span>
										<input type="date" name="full_delivery_date" id="full_delivery_date" onchange="changeAllPartial()" style="border-radius:0; border: 1px solid lightgray;">
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
							<th>Target Price</th>
							<th>Max Discount</th>
							<th>Total</th>
							<th>Partial Delivery</th>
						</tr>
					</thead>
					<tbody>
						@foreach($order->orderDetail as $od)
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
									<input type="number" class="form-control" placeholder="0">
								</td>
								<td class="align-middle">
									<span class="font-weight-semibold">Rp {{ number_format($od->product->pricingPolicy->discount_retail_sales, 0, ',', '.') }}</span>
								</td>
								<td class="align-middle">
									<span class="font-weight-semibold">Rp {{ number_format($od->total, 0, ',', '.') }}</span>
								</td>
								<td class="align-middle" width="10%">
									<input type="date" name="partial_delivery[]" id="partial_delivery" class="form-control">
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="card-body">
				<div class="d-md-flex flex-md-wrap">
					<div class="pt-2 mb-3">
						<img src="{{ asset(Storage::url($order->qr_code)) }}">
					</div>
					<div class="pt-2 mb-3 wmin-md-400 ml-auto">
						<div class="table-responsive">
							<table class="table">
								<tbody>
									<tr>
										<th><h4>TOTAL :</h4></th>
										<td class="text-right text-primary">
											<h4 class="font-weight-semibold">Rp {{ number_format($order->grandtotal, 0, ',', '.') }}</h4>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="form-group"><hr></div>
				<div class="form-group">
					<div class="text-right mt-3">
						<button type="button" class="btn btn-primary btn-labeled btn-labeled-left">
							<b><i class="icon-paperplane"></i></b> 
							Create Invoice
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>

<script>
	function changeAllPartial() {
		var check            = $('#full_delivery_check');
		var date             = $('#full_delivery_date');
		var partial_delivery = $('input[name="partial_delivery[]"]');

		if(check.is(':checked') && date.val()) {
			partial_delivery.val(date.val());
		} else {
			date.val(null);
		}
	}
</script>