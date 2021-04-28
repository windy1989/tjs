<section id="content">
	<div class="content-wrap">
		<div class="container clearfix">
			<div class="row justify-content-center">
				<div class="col-md-6">
					<div class="card">
						<div class="card-body text-center">
							<i class="icon-check-circle text-success" style="font-size:40px;"></i>
							<h4 class="mt-2">Order Successfully Created</h4>
							<p>Scan this barcode at cashier</p>
							<center>
								<img src="{{ asset(Storage::url($order->qr_code)) }}" alt="{{ $order->qr_code }}" class="img-fluid">
							</center>
							<h5 class="mt-4 text-uppercase">Thank you for your order.</h5>
							<a href="{{ url('account/history_order/detail/' . base64_encode($order->id)) }}" class="button button-green button-3d">Detail Order</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>