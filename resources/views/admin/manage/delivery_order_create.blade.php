<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Create Delivery Order</span>
				</h4>
			</div>
			<div class="header-elements">
				<div class="d-flex justify-content-center">
					<a href="{{ url('admin/manage/delivery_order') }}" class="btn bg-secondary btn-labeled btn-labeled-left">
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
					<a href="{{ url('admin/manage/delivery_order') }}" class="breadcrumb-item">Delivery Order</a>
					<span class="breadcrumb-item active">Create</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		@if($errors->any())
			<div class="alert bg-warning text-white alert-styled-left alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">
					<span>&times;</span>
				</button>
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@elseif(session('success'))
			<div class="alert alert-success alert-styled-left alert-arrow-left alert-dismissible">
				<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
				<span class="font-weight-semibold">Success!</span> 
				{!! session('success') !!}
			</div>
		@endif
      <form action="{{ url('admin/manage/delivery_order/create') }}" method="POST" id="form_data">
         @csrf
         <div class="card">
            <div class="card-body">
               <div class="form-group">
                  <label>Order :<span class="text-danger">*</span></label>
						<select name="order_id" id="order_id" class="select2" onchange="getDataOrder()">
							<option value="">-- Choose --</option>
							@foreach($order as $o)
								<option value="{{ $o->id }}">{{ $o->number }}</option>
							@endforeach
						</select>
               </div>
            </div>
         </div>
			<div class="card" id="data_order" style="display:none;">
				<div class="card-body">
					<div class="card-header header-elements-inline mb-3">
						<h5 class="card-title">Shipping Address</h5>
					</div>
					<table class="table table-lg">
						<tbody>
							<tr>
								<th width="20%">Name</th>
								<td><b>:</b> <span id="order_shipping_name"></span></td>
							</tr>
							<tr>
								<th width="20%">Email</th>
								<td><b>:</b> <span id="order_shipping_email"></span></td>
							</tr>
							<tr>
								<th width="20%">Phone</th>
								<td><b>:</b> <span id="order_shipping_phone"></span></td>
							</tr>
							<tr>
								<th width="20%">City</th>
								<td><b>:</b> <span id="order_shipping_city"></span></td>
							</tr>
							<tr>
								<th width="20%">Transport</th>
								<td><b>:</b> <span id="order_shipping_transport"></span></td>
							</tr>
							<tr>
								<th width="20%">Address</th>
								<td><b>:</b> <span id="order_shipping_address"></span></td>
							</tr>
						</tbody>
					</table>
					<div class="form-group">
						<hr class="border-5 border-secondary">
					</div>
					<div class="card-header header-elements-inline mb-3">
						<h5 class="card-title">Product</h5>
					</div>
					<div class="table-responsive">
						<table class="table table-borderd table-striped">
							<thead class="table-secondary">
								<tr class="text-center">
									<th>Image</th>
									<th>Product</th>
									<th>Qty</th>
								</tr>
							</thead>
							<tbody id="data_order_detail"></tbody>
						</table>
					</div>
					<div class="form-group">
						<hr class="border-5 border-secondary">
					</div>
					<div class="form-group">
						<div class="text-right">
							<button type="submit" class="btn btn-primary" id="submit_form"><i class="icon-paperplane"></i> Submit</button>
						</div>
					</div>
				</div>
			</div>
      </form>
	</div>

<script>
	$(function() {
		$('#submit_form').click(function() {
			$('#submit_form').attr('disabled', true);
			$('#submit_form').html('Processing ...');
			$('#form_data').submit();
		});
	});

	function getDataOrder() {
		if($('#order_id').val()) {
			$.ajax({
				url: '{{ url("admin/manage/delivery_order/get_data_order") }}',
				type: 'POST',
				dataType: 'JSON',
				data: {
					order_id: $('#order_id').val()
				},
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				beforeSend: function() {
					loadingOpen('.content');
					$('#data_order').hide();
					$('#data_order_detail').html('');
				},
				success: function(response) {
					loadingClose('.content');
					$('#data_order').fadeIn(500);
					$('#order_shipping_name').html(response.order_shipping.name);
					$('#order_shipping_email').html(response.order_shipping.email);
					$('#order_shipping_phone').html(response.order_shipping.phone);
					$('#order_shipping_city').html(response.order_shipping.city);
					$('#order_shipping_transport').html(response.order_shipping.fleet + '&nbsp;&nbsp;(' + response.order_shipping.vendor + ')');
					$('#order_shipping_address').html(response.order_shipping.address);

					$.each(response.order_detail, function(i, val) {
						$('#data_order_detail').append(`
							<tr class="text-center">
								<td class="align-middle">
									<img src="` + val.image + `" width="80" class="img-fluid img-thumbnail">
								</td>
								<td class="align-middle">` + val.product + `</td>
								<td class="align-middle">` + val.qty + `</td>
							</tr>
						`);
					});
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
		} else {
			$('#data_order').hide();
		}
	}
</script>