@php $grandtotal = $order->orderDetail->sum('bottom_price') * $order->orderDetail->sum('qty'); @endphp
<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Purchase Order Detail</span>
				</h4>
			</div>
			<div class="header-elements">
				<div class="d-flex justify-content-center">
					<a href="{{ url('admin/manage/purchase_order') }}" class="btn bg-secondary btn-labeled btn-labeled-left">
						<b><i class="icon-arrow-left7"></i></b> Back To List
					</a>
					<a href="{{ url('admin/manage/purchase_order/print/' . $order->id) }}" class="btn bg-success btn-labeled btn-labeled-left ml-2">
						<b><i class="icon-printer2"></i></b> Print
					</a>
				</div>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<a href="javascript:void(0);" class="breadcrumb-item">Manage</a>
					<a href="{{ url('admin/manage/purchase_order') }}" class="breadcrumb-item">Purchase Order</a>
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
									<h4 class="text-primary mb-2 mt-md-2">{{ $order->purchase_order }}</h4>
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
							<span class="text-muted">Purchase Order To:</span>
							<ul class="list list-unstyled mb-0">
								<li><h5 class="my-2">Karya Modern</h5></li>
								<li>0315477964</li>
								<li><a href="mailto:admin@karyamoderngroup.com">admin@karyamoderngroup.com</a></li>
							</ul>
						</div>
						<div class="mb-2 ml-auto">
							<span class="text-muted">Payment Details:</span>
							<div class="d-flex flex-wrap wmin-md-400">
								<ul class="list list-unstyled mb-0">
									<li><h5 class="my-2">Total Due:</h5></li>
									<li>Number:</li>
								</ul>
								<ul class="list list-unstyled text-right mb-0 ml-auto">
									<li><h5 class="font-weight-semibold my-2">Rp {{ number_format($grandtotal, 0, ',', '.') }}</h5></li>
									<li>{{ $order->number }}</li>
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
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
							@foreach($order->orderDetail as $key => $od)
								<input type="hidden" name="order_detail_id[]" value="{{ $od->id }}">
								<tr class="text-center">
									<td clas="align-middle">
										<a href="{{ $od->product->type->image() }}" data-lightbox="{{ $od->product->code() }}" data-title="{{ $od->product->code() }}"><img src="{{ $od->product->type->image() }}" style="max-width:70px;" class="img-fluid img-thumbnail"></a>
									</td>
									<td class="align-middle nowrap">
										<h6 class="mb-0">{{ $od->product->code() }}</h6>
										<div class="text-muted">Qty <b>{{ $od->qty }}</b> Item</div>
										<div class="text-muted">Ready <b>{{ $od->ready }}</b> Item</div>
										<div class="text-muted">Indent <b>{{ $od->indent }}</b> Item</div>
									</td>
									<td class="align-middle">
										<center>
											Rp {{ number_format($od->bottom_price, 0, ',', '.') }}
										</center>
									</td>
									<td class="align-middle">
										<span class="font-weight-semibold">Rp {{ number_format($od->bottom_price * $od->qty, 0, ',', '.') }}</span>
									</td>
								</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<th colspan="3" class="text-right">TOTAL :</th>
								<td class="text-right text-danger">
									<h4 class="font-weight-semibold">Rp {{ number_format($grandtotal, 0, ',', '.') }}</h4>
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
				<div class="card-body">
					<div class="form-group">
						<div class="text-right mt-3">
							<button type="submit" id="btn_delivery_order" class="btn btn-primary btn-labeled btn-labeled-left"><b><i class="icon-paperplane"></i></b> Create Delivery Order</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

<script>
	$(function() {
		$('#btn_delivery_order').click(function() {
			$('#btn_delivery_order').attr('disabled', true);
			$('#btn_delivery_order').html('Processing ...');
			$('#form_data').submit();
		});
	});
</script>