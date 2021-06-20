<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Manage Detail Transaction</span>
				</h4>
			</div>
			<div class="header-elements">
				<div class="d-flex justify-content-center">
					<a href="{{ url('admin/manage/transaction') }}" class="btn bg-secondary btn-labeled btn-labeled-left">
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
					<a href="{{ url('admin/manage/transaction') }}" class="breadcrumb-item">Transaction</a>
					<span class="breadcrumb-item active">Detail</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		@if(session('success'))
			<div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible">
				<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
				<span class="font-weight-semibold">Well done!</span> 
				{{ session('success') }}
			</div>
		@elseif($order->type == 2 && $order->status == 2)
			<div class="alert alert-info font-weight-bold font-italic">Please send items for this order quickly</div>
		@endif
		<form action="" method="POST" id="form_data">
			@csrf
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body text-center">
							<h4 class="font-weight-semibold text-uppercase">{{ $order->number }}</h4>
							<h6 class="font-weight-semibold text-uppercase">{{ $order->type() }}</h6>
							<h6 class="font-weight-semibold mb-0 text-muted text-uppercase font-italic">{{ $order->status() }}</h6>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-lg">
									<thead>
										<tr>
											<th class="text-center">Image</th>
											<th>Product</th>
											<th class="text-center">Unit Price</th>
											<th class="text-center">Qty</th>
											<th class="text-center">Ready Stock</th>
											<th class="text-center">Indent Stock</th>
											<th class="text-center">Total</th>
										</tr>
									</thead>
									<tbody>
										@foreach($order->orderDetail as $od)
											<tr>
												<td class="align-middle text-center">
													<img width="64" height="64" src="{{ $od->product->type->image() }}" class="img-fluid img-thumbnail">
												</td>
												<td class="align-middle">{{ $od->product->code() }}</td>
												<td class="align-middle text-center">Rp {{ number_format($od->price_list, 0, ',', '.') }}</td>
												<td class="align-middle text-center">x{{ $od->qty }}</td>
												<td class="align-middle text-center">{{ $od->ready }}</td>
												<td class="align-middle text-center">{{ $od->indent }}</td>
												<td class="align-middle text-center">Rp {{ number_format($od->total, 0, ',', '.') }}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="card">
						<div class="card-header bg-transparent">
							<h6 class="card-title font-weight-semibold text-uppercase">Billing Address</h6>
						</div>
						<div class="card-body">
							<table class="table table-lg">
								<tbody>
									<tr>
										<th width="20%">Name</th>
										<td><b>:</b> {{ $order->customer->name }}</td>
									</tr>
									<tr>
										<th width="20%">Email</th>
										<td><b>:</b> {{ $order->customer->email }}</td>
									</tr>
									<tr>
										<th width="20%">Phone</th>
										<td><b>:</b> {{ $order->customer->phone }}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="card">
						<div class="card-header bg-transparent">
							<h6 class="card-title font-weight-semibold text-uppercase">Shipping Address</h6>
						</div>
						<div class="card-body">
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
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="card">
						<div class="card-header bg-transparent">
							<h6 class="card-title font-weight-semibold text-uppercase">Payment Information</h6>
						</div>
						<div class="card-body">
							@if($order->orderPayment)
								<table class="table table-lg">
									<tbody>
										<tr>
											<th width="20%">Paid At</th>
											<td><b>:</b> {{ date('d F Y, H:i', strtotime($order->orderPayment->created_at)) }}</td>
										</tr>
										<tr>
											<th width="20%">Method</th>
											<td><b>:</b> {{ $order->orderPayment->method }}</td>
										</tr>
										<tr>
											<th width="20%">Channel</th>
											<td><b>:</b> {{ $order->orderPayment->channel }}</td>
										</tr>
									</tbody>
								</table>
							@else
								<div class="alert alert-secondary alert-styled-left alert-dismissible">
									<span class="font-weight-semibold">Ooppsss!</span>
									There is no payment in this order
								</div>
							@endif
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="card">
						<div class="card-header bg-transparent">
							<h6 class="card-title font-weight-semibold text-uppercase">Summary</h6>
						</div>
						<div class="card-body">
							<table class="table table-lg">
								<tbody>
									@if(Storage::exists($order->qr_code))
										<tr class="cart_item">
											<td rowspan="6">
												<center>
													<img src="{{ asset(Storage::url($order->qr_code)) }}" class="img-fluid img-thumbnail">
												</center>
											</td>
										</tr>
									@endif
									<tr>
										<th width="20%">Subtotal</th>
										<td><b>:</b>  Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
									</tr>
									<tr>
										<th width="20%">Discount</th>
										<td><b>:</b> Rp {{ number_format($order->discount, 0, ',', '.') }}</td>
									</tr>
									<tr>
										<th width="20%">Shipping Fee</th>
										<td><b>:</b> Rp {{ number_format($order->shipping, 0, ',', '.') }}</td>
									</tr>
									<tr>
										<th width="20%">Total</th>
										<td style="font-size:20px;"><b>:</b> Rp {{ number_format($order->grandtotal, 0, ',', '.') }}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="alert alert-success">
						<div class="text-center">
							<h6 class="font-weight-bold text-uppercase">Transport</h6>
							<div class="form-group"><hr></div>
							<div class="font-weight-semibold">{{ $order->orderShipping ? $order->orderShipping->delivery->transport->fleet : 'Delivery not set' }}</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="alert alert-danger">
						<div class="text-center">
							<h6 class="font-weight-bold text-uppercase">Payment Method</h6>
							<div class="form-group"><hr></div>
							<div class="font-weight-semibold">{{ $order->type() }}</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="alert alert-warning">
						<div class="text-center">
							<h6 class="font-weight-bold text-uppercase">Status</h6>
							<div class="form-group"><hr></div>
							<div class="font-weight-semibold">
								@if($order->status == 1)
									Waiting for payment
								@elseif($order->status == 2)
									Order has been paid
								@elseif($order->status == 3)                           
									Orders are being packed
								@elseif($order->status == 4)
									Order has been sent
								@elseif($order->status == 5)
									Transaction has been completed
								@elseif($order->status == 6)
									Order canceled
								@endif	
							</div>
						</div>
					</div>
				</div>
			</div>
			@if($order->status == 1)
				<div class="card">
					<div class="card-body">
						<div class="text-right">
							<button type="button" id="btn_cancel" class="btn btn-danger"><i class="icon-cross3"></i> Cancel This Order</button>
						</div>
					</div>
				</div>
			@endif
		</form>
	</div>

<script>
	$(function() {
		$('#btn_cancel').click(function() {
			swalInit.fire({
				title: 'Cancel Order?',
				text: 'Are you sure to cancel this order?',
				type: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Yes, canceled!',
				cancelButtonText: "No, don't do it!",
				confirmButton: 'btn btn-success',
    			cancelButton: 'cancel-button-class',
				customClass: {
					confirmButton: 'btn btn-success',
					cancelButton: 'btn btn-danger'
				}
			}).then(function(result) {
				if(result.value) {
					$('#btn_cancel').attr('disabled', true);
					$('#btn_cancel').html('Processing ...');
					$('#form_data').submit();
				}
			});
		});
	});
</script>