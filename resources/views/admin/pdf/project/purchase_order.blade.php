<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Purchase Order {{ $project->code }}</title>
		<style>
			body {
				font-family: 'Lato', sans-serif;
			}
			
			th {
				font-size:12px;
			}
		
			.invoice-box {
				font-size: 16px;
				font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
				color: #555;
			}

			.invoice-box table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}

			.invoice-box table td {
				vertical-align: top;
			}

			.invoice-box table tr td:nth-child(2) {
				text-align: right;
			}

			.invoice-box table tr.top table td {
				padding-bottom: 0px;
			}

			.invoice-box table tr.information table td {
				padding-bottom: 0px;
			}

			.invoice-box table tr.heading td {
				background: #0b95b8;
				border-bottom: 1px solid #0b95b8;
				color: white;
				font-weight: bold;
			}

			.invoice-box table tr.details td {
				padding-bottom: 0px;
			}

			.invoice-box table tr.item td {
				border-bottom: 1px solid #eee;
			}

			.invoice-box table tr.item.last td {
				border-bottom: none;
			}

			.invoice-box table tr.total td:nth-child(2) {
				border-top: 2px solid #eee;
				font-weight: bold;
			}

			@media only screen and (max-width: 600px) {
				.invoice-box table tr.top table td {
					width: 100%;
					display: block;
					text-align: center;
				}

				.invoice-box table tr.information table td {
					width: 100%;
					display: block;
					text-align: center;
				}
			}

			.invoice-box.rtl {
				direction: rtl;
				font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			}

			.invoice-box.rtl table {
				text-align: right;
			}

			.invoice-box.rtl table tr td:nth-child(2) {
				text-align: left;
			}
			
			@page { margin: 1cm; }
			body { margin: 1cm; }
		</style>
	</head>
	<body>
		<div class="invoice-box">
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
							<tr>
								<td class="title" rowspan="2">
									<img src="{{ asset('website/logo-black.png') }}" width="275">
								</td>
								<td colspan="2" style="text-align:right;"><h3><img src="website/pta_small.png" height="13px" style="margin-right:5px;">PT. PERWIRA TAMARAYA ABADI</h3></td>
							</tr>
							<tr>
								<td style="padding-right:25px;">
									<div style="font-size:9px; font-weight:bold;">JAGAT BUILDING</div>
									<div style="font-size:9px; font-weight:500;">St. Tomang Raya No 28 - 30</div>
									<div style="font-size:9px; font-weight:500;">Jakarta 11430</div>
									<div style="font-size:9px; font-weight:500;">Phone : 0811257180 / 081225575295</div>
									<div style="font-size:9px; font-weight:500;">Email : infojkt@smartmarbleandbath.com</div>
								</td>
								<td style="border-left: 3px solid #51b6bc; text-align:right;">
									<div style="font-size:9px; font-weight:bold;">MODERN CERAMIC</div>
									<div style="font-size:9px; font-weight:500;">St. Baliwerti 119 - 121</div>
									<div style="font-size:9px; font-weight:500;">Surabaya, Jawa Timur 60174</div>
									<div style="font-size:9px; font-weight:500;">Phone : 031-5472860 / 031-5324505</div>
									<div style="font-size:9px; font-weight:500;">Email : info@smartmarbleandbath.com</div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="2" style="vertical-align: middle;padding-top:15px;padding-bottom:15px;">
						<center>
							<img src="website/kop_brand_report.png" width="100%">
						</center>
					</td>
				</tr>
			</table>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<table>
							<tr>
								<td style="background-color:#0b95b8;text-align:center;color:white;padding-top:10px;padding-bottom:10px;" width="55%">
									<h3><b>PURCHASE ORDER</b></h3>
								</td>
								<td width="5%">
									
								</td>
								<td width="40%" rowspan="6">
									<table style="border: 1px solid black;border-collapse: collapse;">
										<tr>
											<td width="40%" style="font-size:10px;">Company Address</td>
											<td style="text-align:left; font-size:10px;">: <b>PT PERWIRA TAMARAYA ABADI
												<br>
											PERGUD. BUMI MASPION IX/E-1, ROMOKALISARI,<br>
											BENOWO, SURABAYA, 60195, INDONESIA</b>									
											</td>
										</tr>
										<tr>
											<td width="40%" style="font-size:10px;">Telp/Fax.</td>
											<td style="text-align:left; font-size:10px;">:  <b>031-547 2860/031-547 8924</b></td>
										</tr>
										<tr>
											<td width="40%" style="font-size:10px;">Taxpayer Id No.</td>
											<td style="text-align:left; font-size:10px;">: <b>02.458.040.9-604.000</b></td>
										</tr>
									</table>
									<br>
									<table style="border: 1px solid black;border-collapse: collapse;">
										<tr>
											<td width="40%" style="font-size:10px;">For Delivery Address</td>
											<td style="text-align:left; font-size:10px;">: <b>{{ $project->on_behalf }}</b> </td>
										</tr>
										<tr>
											<td width="40%" style="font-size:10px;">Address</td>
											<td style="text-align:left; font-size:10px;">: <b>{{ $project->delivery_address }}</b> </td>
										</tr>
										<tr>
											<td width="40%" style="font-size:10px;">Courier Method</td>
											<td style="text-align:left; font-size:10px;">: 
												<b>{{ $project->courier_method }}</b>
												
											</td>
										</tr>
										<tr>
											<td width="40%" style="font-size:10px;">Destination</td>
											<td style="text-align:left; font-size:10px;">: 
												<b>{{ $project->city->name.', '.$project->country->name }}</b>
												
											</td>
										</tr>
										<tr>
											<td width="40%" style="font-size:10px;">PIC</td>
											<td style="text-align:left; font-size:10px;">: 
												<b>{{ $project->pic }}</b>
											</td>
										</tr>
										<tr>
											<td width="40%" style="font-size:10px;">PIC Phone No.</td>
											<td style="text-align:left; font-size:10px;">: 
												<b>{{ $project->pic_no }}</b>
											</td>
										</tr>
									</table>
									<br>
									<table style="border: 1px solid black;border-collapse: collapse;">
										<tr>
											<td width="40%" style="font-size:10px;">Payment Method</td>
											<td style="text-align:left; font-size:10px;">: <b>{{ $project->payment_method }}</b></td>
										</tr>
										<tr>
											<td width="40%" style="font-size:10px;">Price</td>
											<td style="text-align:left; font-size:10px;">: <b>{{ $project->price() }}</b></td>
										</tr>
										<tr>
											<td width="40%" style="font-size:10px;">Currency</td>
											<td style="text-align:left; font-size:10px;">: <b>{{ $project->currency->code.' '.$project->currency->name }}</b></td>
										</tr>
										<tr>
											<td width="40%" style="font-size:10px;">Brand on Box</td>
											<td style="text-align:left; font-size:10px;">: <b>{{ $project->brand_on_box }}</b></td>
										</tr>
										<tr>
											<td width="40%" style="font-size:10px;">SNI No.</td>
											<td style="text-align:left; font-size:10px;">: <b>{{ $project->sni }}</b></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td width="55%">
									<table style="border: 1px solid black;border-collapse: collapse;">
										<tr>
											<td width="30%" style="font-size:10px;">Date of PO</td>
											<td style="text-align:left; font-size:10px;">: <b>{{ date('d F Y', strtotime($project->created_at)) }}</b></td>
										</tr>
										<tr>
											<td width="30%" style="font-size:10px;">PO No.</td>
											<td style="text-align:left; font-size:10px;">: <b>{{ $project->code }}</b></td>
										</tr>
										<tr>
											<td width="30%" style="font-size:10px;">Ref SO No.</td>
											<td style="text-align:left; font-size:10px;">: <b>{{ $project->projectSale->code }}</b></td>
										</tr>
									</table>
									<br>
									<table style="border: 1px solid black;border-collapse: collapse;">
										<tr>
											<td width="30%" style="font-size:10px;">Customer</td>
											<td style="text-align:left; font-size:10px;">: <b>{{ $project->customer->name }}</b></td>
										</tr>
										<tr>
											<td width="30%" style="font-size:10px;">Sales</td>
											<td style="text-align:left; font-size:10px;">: <b>{{ $project->sales->name }}</b></td>
										</tr>
									</table>
									<br>
									<table style="border: 1px solid black;border-collapse: collapse;">
										<tr class="heading">
											<td colspan="2"><div style="font-size:10px;"><b>Order To :</b></div></td>
										</tr>
										<tr>
											<td width="30%" style="font-size:10px;">Supplier</td>
											<td style="text-align:left; font-size:10px;">: <b>{{ $project->supplier->name }} </b></td>
										</tr>
										<tr>
											<td width="30%" style="font-size:10px;">Address</td>
											<td style="text-align:left; font-size:10px;">: <b>{{ $project->supplier->address }} </b></td>
										</tr>
										<tr>
											<td width="30%" style="font-size:10px;">PIC</td>
											<td style="text-align:left; font-size:10px;">: <b>{{ $project->supplier->pic }}</b></td>
										</tr>
										<tr>
											<td width="30%" style="font-size:10px;">PIC Phone No.</td>
											<td style="text-align:left; font-size:10px;">: <b>{{ $project->supplier->phone }}</b></td>
										</tr>
										<tr>
											<td width="30%" style="font-size:10px;">Production Lead Time</td>
											<td style="text-align:left; font-size:10px;">: <b>{{ $project->production_lead_time }}</b></td>
										</tr>
										<tr>
											<td width="30%" style="font-size:10px;">Est. Del. Time</td>
											<td style="text-align:left; font-size:10px;">: <b>{{ $project->estimated_delivery }}</b></td>
										</tr>
										<tr>
											<td width="30%" style="font-size:10px;">Est. Arr. Time</td>
											<td style="text-align:left; font-size:10px;">: <b>{{ $project->estimated_arrival }}</b></td>
										</tr>
										<tr>
											<td width="30%" style="font-size:10px;">Factory Name</td>
											<td style="text-align:left; font-size:10px;">: <b>{{ $project->factory_name }}</b></td>
										</tr>
									</table>
								</td>
								<td width="5%">
									
								</td>
							</tr>
							<tr>
								<td width="55%">
									
									
								</td>
								<td width="5%"></td>
							</tr>
							<tr>
								<td width="55%"></td><td width="5%"></td>
							</tr>
							<tr>
								<td width="55%"></td><td width="5%"></td>
							</tr>
							<tr>
								<td width="55%"></td><td width="5%"></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<p style="font-size:10px;">Dear Supplier,
			<br>We would like to place an order with details as follow:
			</p>
			@php
				$adatile = false;
				$adalain = false;
				$total = 0;
				$totaltile = 0;
				$totallain = 0;
				foreach($project->projectPurchaseProduct as $key => $pp){
					if($pp->product->type->category->parent()->parent()->slug == 'tile'){
						$adatile = true;
					}
					if($pp->product->type->category->parent()->parent()->slug !== 'tile'){
						$adalain = true;
					}
				}
			@endphp
			<table border="1" cellpadding="5" cellspacing="0" style="width:100%; font-size:10px;">
				<thead>
					<tr style="background:#0b95b8;text-align:center;">
						<th style="color:white;" colspan="13"><center>DETAIL OF ORDER</center></th>
					</tr>
				</thead>
				@php
				if($adatile == true){
					$qtytot = 0;
					$qtym2 = 0;
				@endphp
				<thead>
					<tr style="background:#0b95b8;text-align:center;">
						<th style="color:white;" colspan="13"><center>TILE(S)</center></th>
					</tr>
					<tr style="background:#0b95b8;text-align:center;">
						<th style="color:white;"><center>NO</center></th>
						<th style="color:white;"><center>CODE</center></th>
						<th style="color:white;"><center>PRODUCT</center></th>
						<th style="color:white;"><center>SIZE(cm)</center></th>
						<th style="color:white;"><center>CATEGORY</center></th>
						<th style="color:white;"><center>COLOR</center></th>
						<th style="color:white;"><center>HS CODE</center></th>
						<th style="color:white;"><center>FINISHING</center></th>
						<th style="color:white;" width="5%"><center>QTY TO ORDER</center></th>
						<th style="color:white;"><center>TOTAL(sqm)</center></th>
						<th style="color:white;"><center>PRICE/M<sup>2</sup></center></th>
						<th style="color:white;"><center>TOTAL</center></th>
						<th style="color:white;"><center>CONTAINER</center></th>
					</tr>
				</thead>
				<tbody>
					@foreach($project->projectPurchaseProduct as $key => $pp)
						@php
							if($pp->product->type->category->parent()->parent()->slug == 'tile'){
								$m2 = (( $pp->product->type->length * $pp->product->type->width ) / 10000) * $pp->product->carton_pcs;
								$total += $pp->price * $pp->qty * $m2;
								$totaltile += $pp->price * $m2 * $pp->qty;
								$qtytot += $pp->qty;
								$qtym2 += $pp->qty*$m2;
						@endphp
						<tr>
							<td style="vertical-align:center;">
								<center>
									{{ $key + 1 }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $pp->product->type->code }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									<img src="{{ $pp->product->type->image() }}" style="max-width:28px; border:1px solid #ddd; border-radius:4px; padding: 5px;" class="img-fluid img-thumbnail">
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $pp->product->type->length }}x{{ $pp->product->type->width }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $pp->product->type->category->name }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $pp->product->type->color->name }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $pp->product->hsCode->code }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $pp->product->type->surface->name }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $pp->qty }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $pp->qty*$m2 }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ number_format($pp->price, 0, ',', '.') }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ number_format($pp->price * $pp->qty * $m2, 0, ',', '.') }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $pp->product->containerStandart() }}
								</center>
							</td>
						</tr>
						@php
							}
						@endphp
					@endforeach
					<tr>
						<td colspan="8" style="text-align:right;">Total</td>
						<td style="text-align:center;">{{ $qtytot }}</td>
						<td style="text-align:center;">{{ $qtym2 }}</td>
						<td colspan="3" style="text-align:right;">{{ $project->currency->symbol.' '.number_format($totaltile, 0, ',', '.') }}</td>
					</tr>
				</tbody>
				@php
				}
				if($adatile == true && $adalain == true){
				@endphp
				<thead>
					<tr>
						<th style="color:white;" colspan="13"> ... </th>
					</tr>
				</thead>
				@php
				}
				if($adalain == true){
					$qtytot = 0;
				@endphp
				<thead>
					<tr style="background:#0b95b8;text-align:center;">
						<th style="color:white;" colspan="13"><center>ETC(S)</center></th>
					</tr>
					<tr style="background:#0b95b8;text-align:center;">
						<th style="color:white;"><center>NO</center></th>
						<th style="color:white;"><center>CODE</center></th>
						<th style="color:white;"><center>PRODUCT</center></th>
						<th style="color:white;"><center>SIZE(cm)</center></th>
						<th style="color:white;"><center>CATEGORY</center></th>
						<th style="color:white;"><center>COLOR</center></th>
						<th style="color:white;"><center>HS CODE</center></th>
						<th style="color:white;"><center>FINISHING</center></th>
						<th style="color:white;"><center>QTY TO ORDER</center></th>
						<th style="color:white;"><center>PRICE/PCS</center></th>
						<th style="color:white;" colspan="2"><center>TOTAL</center></th>
						<th style="color:white;"><center>CONTAINER</center></th>
					</tr>
				</thead>
				<tbody>
					@php
						$no = 1;
					@endphp
					@foreach($project->projectPurchaseProduct as $key => $pp)
						@php
							if($pp->product->type->category->parent()->parent()->slug !== 'tile'){
								$total += $pp->price * $pp->qty;
								$totallain += $pp->price * $pp->qty;
								$qtytot += $pp->qty;
						@endphp
						<tr>
							<td style="vertical-align:center;">
								<center>
									{{ $no }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $pp->product->type->code }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									<img src="{{ $pp->product->type->image() }}" style="max-width:28px; border:1px solid #ddd; border-radius:4px; padding: 5px;" class="img-fluid img-thumbnail">
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $pp->product->type->length }}x{{ $pp->product->type->width }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $pp->product->type->category->name }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $pp->product->type->color->name }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $pp->product->hsCode->code }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $pp->product->type->surface->name }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $pp->qty }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ number_format($pp->price, 0, ',', '.') }}
								</center>
							</td>
							<td style="vertical-align:center;" colspan="2">
								<center>
									{{ number_format($pp->price * $pp->qty, 0, ',', '.') }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $pp->product->containerStandart() }}
								</center>
							</td>
						</tr>
						@php
								$no++;
							}
						@endphp
					@endforeach
					<tr>
						<td colspan="8" style="text-align:right;">Total</td>
						<td style="text-align:center;">{{ $qtytot }}</td>
						<td style="text-align:center;"></td>
						<td colspan="3" style="text-align:right;">{{ $project->currency->symbol.' '.number_format($totallain, 0, ',', '.') }}</td>
					</tr>
				</tbody>
				@php
				}
				@endphp
			</table><br>
			<table style="border: 1px solid black;border-collapse: collapse;">
				<tr>
					<td style="text-align:right;">
						<h6 style="font-size:10px;">Notes :</h6>
					</td>
					<td width="93%" style="text-align:left;">
						<div style="font-size:10px;">
							{{ $project->note }}
						</div>
					</td>
				</tr>
			</table><br><br>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td style="text-align:center;">
						<div style="font-size:10px;">PO released by</div>
						<div style="font-size:10px;">PT. Perwira Tamaraya Abadi</div>
						@if(isset($project->user->sign))
							<div><img src="{{ asset(Storage::url($project->user->sign)) }}" height="65px"></div>
						@else
							<br><br><br>
						@endif
						<div style="font-size:10px;font-weight:700;">{{ $project->user->name }}</div>
					</td>
					<td style="text-align:center;">
						<div style="font-size:10px;">PO accepted by</div>
						<div style="font-size:10px;">Supplier</div>
						<br><br><br>
						<div style="font-size:10px;font-weight:700;">(........................)</div>
					</td>
					@if(isset($project->checked->name))
					<td style="text-align:center;">
						<div style="font-size:10px;">Checked by</div>
						<div style="font-size:10px;">PT. Perwira Tamaraya Abadi</div>
						@if(isset($project->checked->sign))
							<div><img src="{{ asset(Storage::url($project->checked->sign)) }}" height="65px"></div>
						@else
							<br><br><br>
						@endif
						<div style="font-size:10px;font-weight:700;">{{ $project->checked->name }}</div>
					</td>
					@endif
					@if(isset($project->approved->name))
					<td style="text-align:center;">
						<div style="font-size:10px;">Approved By</div>
						<div style="font-size:10px;">Director</div>
						@if(isset($project->approved->sign))
							<div><img src="{{ asset(Storage::url($project->approved->sign)) }}" height="65px"></div>
						@else
							<br><br><br>
						@endif
						<div style="font-size:10px;font-weight:700;">{{ $project->approved->name }}</div>
					</td>
					@endif
				</tr>
			</table>
		</div>
	</body>
</html>