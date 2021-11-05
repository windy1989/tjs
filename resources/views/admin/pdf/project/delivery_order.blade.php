<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Delivery Order {{ $project->code }}</title>
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
				background: #cf9604;
				border-bottom: 1px solid #cf9604;
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
						@php
							if($project->is_dropshipper == '1'){
						@endphp
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
						@php
							}elseif($project->is_dropshipper == '2'){
						@endphp
						<table>
							<tr>
								<td class="title" rowspan="2">
									@php
										if($project->dropshipper->image !== ''){
											echo '<img src="'.$project->dropshipper->image().'" height="75">';
										}
									@endphp
								</td>
								<td colspan="2" style="text-align:right;"><h3>{{ strtoupper($project->dropshipper->name) }}</h3></td>
							</tr>
							<tr>
								<td></td>
								<td style="text-align:right;">
									<div style="font-size:9px; font-weight:bold;">{{ $project->dropshipper->address }}</div>
									<div style="font-size:9px; font-weight:500;">Phone : {{ $project->dropshipper->phone }}</div>
									<div style="font-size:9px; font-weight:500;">Email : {{ $project->dropshipper->email }}</div>
								</td>
							</tr>
						</table>
						@php
							}
						@endphp
					</td>
				</tr>
			</table>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="2" style="vertical-align: middle;padding-top:15px;padding-bottom:15px;">
						@php
							if($project->is_dropshipper == '1'){
						@endphp
						<center>
							<img src="website/kop_brand_report.png" width="100%">
						</center>
						@php
							}
						@endphp
					</td>
				</tr>
			</table>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="2">
						<table>
							<tr style="background-color:#cf9604;">
								<td style="text-align:center;color:white;padding-top:10px;padding-bottom:10px;">
									<h3><b>DELIVERY ORDER</b></h3>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table><br>
			<table>
				<tr>
					<td width="50%">
						<table>
							<tr class="heading">
								<td colspan="2"><div style="font-size:12px;"><b>INFORMATION :</b></div></td>
							</tr>
							<tr style="line-height:0 !important;">
								<td width="40%" style="font-size:12px;">Date of DO</td>
								<td style="text-align:left; font-size:12px;">: {{ date('d F Y', strtotime($project->delivery_date)) }}</td>
							</tr>
							<tr>
								<td width="40%" style="font-size:12px;">DO. Number</td>
								<td style="text-align:left; font-size:12px;">: {{ $project->code }}</td>
							</tr>
							@php
								if($project->is_dropshipper == '1'){
							@endphp
							<tr>
								<td width="40%" style="font-size:12px;">SO. Number</td>
								<td style="text-align:left; font-size:12px;">: {{ $project->projectSale->code }}</td>
							</tr>
							<tr>
								<td width="40%" style="font-size:12px;">Project</td>
								<td style="text-align:left; font-size:12px;">: {{ $project->project->name }}</td>
							</tr>
							<tr>
								<td width="40%" style="font-size:12px;">Warehouse</td>
								<td style="text-align:left; font-size:12px;">: {{ $project->warehouse->name }}</td>
							</tr>
							<tr>
								<td width="40%" style="font-size:12px;">Expedition</td>
								<td style="text-align:left; font-size:12px;">: {{ $project->vendor->name }}</td>
							</tr>
							@php
								}
							@endphp
						</table>
					</td>
					<td width="50%">
						<table>
							<tr class="heading">
								<td colspan="2"><div style="font-size:12px;"><b>SHIP TO :</b></div></td>
							</tr>
							<tr style="line-height:0 !important;">
								<td width="40%" style="font-size:12px;">Receiver</td>
								<td style="text-align:left; font-size:12px;">: {{ $project->receiver_name }}</td>
							</tr>
							<tr>
								<td width="40%" style="font-size:12px;">Phone</td>
								<td style="text-align:left; font-size:12px;">: {{ $project->phone }}</td>
							</tr>
							<tr>
								<td width="40%" style="font-size:12px;">Email</td>
								<td style="text-align:left; font-size:12px;">: {{ $project->email }}</td>
							</tr>
							<tr>
								<td width="40%" style="font-size:12px;">City</td>
								<td style="text-align:left; font-size:12px;">: {{ $project->city->name }}</td>
							</tr>
							<tr>
								<td width="40%" style="font-size:12px;">Address</td>
								<td style="text-align:left; font-size:12px;">: {{ $project->address }}</td>
							</tr>
						</table>
					</td>
				</tr>
			</table><br>
			@php
				$adatile = false;
				$adalain = false;
				$total = 0;
				$totaltile = 0;
				$totallain = 0;
				foreach($project->projectDeliveryProduct as $key => $pp){
					if($pp->product->type->category->parent()->parent()->slug == 'tile'){
						$adatile = true;
					}
					if($pp->product->type->category->parent()->parent()->slug !== 'tile'){
						$adalain = true;
					}
				}
			@endphp
			<table border="1" cellpadding="5" cellspacing="0" style="width:100%; font-size:10px;">
				@php
				if($adatile == true){
					$qtytot = 0;
					$qtym2 = 0;
				@endphp
				<thead>
					<tr style="background:#cf9604;text-align:center;">
						<th style="color:white;" colspan="8"><center>TILE(S)</center></th>
					</tr>
					<tr style="background:#cf9604;text-align:center;">
						<th style="color:white;"><center>NO</center></th>
						<th style="color:white;"><center>NAME</center></th>
						<th style="color:white;"><center>BRAND</center></th>
						<th style="color:white;"><center>FINISHING</center></th>
						<th style="color:white;"><center>SHADING</center></th>
						<th style="color:white;"><center>SIZE(cm)</center></th>
						<th style="color:white;"><center>PCS/BOX</center></th>
						<th style="color:white;"><center>QTY DELIVERED</center></th>
					</tr>
				</thead>
				<tbody>
					@foreach($project->projectDeliveryProduct as $key => $ps)
						@php
							if($ps->product->type->category->parent()->parent()->slug == 'tile'){
						@endphp
						<tr>
							<td style="vertical-align:center;">
								<center>
									{{ $key + 1 }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->product->name() }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->product->brand->name }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->product->type->surface->name }}
								</center>
							</td>
							<td style="vertical-align:center;">
								@foreach($project->projectSale->projectSaleShading()->where('product_id',$ps->product_id)->get() as $pss)
									{!! 'Code : '.$pss->code.' Qty : '.$pss->qty.'<br>' !!}
								@endforeach
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->product->type->length }}x{{ $ps->product->type->width }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->product->carton_pcs }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->qty.' '.$ps->unit() }}
								</center>
							</td>
						</tr>
						@php
							}
						@endphp
					@endforeach
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
					<tr style="background:#cf9604;text-align:center;">
						<th style="color:white;" colspan="8"><center>ETC(S)</center></th>
					</tr>
					<tr style="background:#cf9604;text-align:center;">
						<th style="color:white;"><center>NO</center></th>
						<th style="color:white;"><center>NAME</center></th>
						<th style="color:white;"><center>BRAND</center></th>
						<th style="color:white;"><center>FINISHING</center></th>
						<th style="color:white;"><center>SHADING</center></th>
						<th style="color:white;"><center>SIZE(cm)</center></th>
						<th style="color:white;"><center>PCS/BOX</center></th>
						<th style="color:white;"><center>QTY DELIVERED</center></th>
					</tr>
				</thead>
				<tbody>
					@php
						$no = 1;
					@endphp
					@foreach($project->projectDeliveryProduct as $key => $ps)
						@php
							if($ps->product->type->category->parent()->parent()->slug !== 'tile'){
						@endphp
						<tr>
							<td style="vertical-align:center;">
								<center>
									{{ $no }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->product->name() }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->product->brand->name }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->product->type->surface->name }}
								</center>
							</td>
							<td style="vertical-align:center;">
								@foreach($project->projectSale->projectSaleShading()->where('product_id',$ps->product_id)->get() as $pss)
									{!! 'Code : '.$pss->code.' Qty : '.$pss->qty.'<br>' !!}
								@endforeach
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->product->type->length }}x{{ $ps->product->type->width }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->product->carton_pcs }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->qty.' '.$ps->unit() }}
								</center>
							</td>
						</tr>
						@php
								$no++;
							}
						@endphp
					@endforeach
				</tbody>
				@php
				}
				@endphp
			</table><br>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<h6 style="font-size:10px; text-align:center;">Notes :</h6>
						<div></div>
						<div style="font-size:10px; text-align:left;">
							<ol>
								<li>Goods are sent according to the address on the delivery order.</li>
								<li>When goods are received, please check it immediately. If there is no claim, then Delivery Order considered finished.</li>
								<li>Signature must be completed by name and stamp.</li>
							</ol>
						</div>
					</td>
				</tr>
			</table><br><br><br><br>
			<table cellpadding="0" cellspacing="0">
				<tr>
					@php
						if($project->is_dropshipper == '1'){
					@endphp
					<td style="text-align:center;">
						<div style="font-size:10px;">Approved By</div>
						@if(isset($project->approve->sign))
							<div><img src="{{ asset(Storage::url($project->approve->sign)) }}" height="65px"></div>
						@else
							<br><br><br>
						@endif
						<div style="font-size:10px;font-weight:700;">( {{ isset($project->approve->name) ? $project->approve->name : '........................' }} )</div>
					</td>
					@php
						}
					@endphp
					<td style="text-align:center;">
						<div style="font-size:10px;">Warehouse</div>
						<br><br><br>
						<div style="font-size:10px;font-weight:700;">(........................)</div>
					</td>
					@php
						if($project->is_dropshipper == '1'){
					@endphp
					<td style="text-align:center;">
						<div style="font-size:10px;">Created by</div>
						@if($project->user->sign)
							<div><img src="{{ asset(Storage::url($project->user->sign)) }}" height="65px"></div>
						@else
							<br><br><br>
						@endif
						<div style="font-size:10px;font-weight:700;">( {{ $project->user->name ? $project->user->name : '' }} )</div>
					</td>
					@php
						}
					@endphp
					<td style="text-align:center;">
						<div style="font-size:10px;">Sent by</div>
						<br><br><br>
						<div style="font-size:10px;font-weight:700;">(........................)</div>
					</td>
					<td style="text-align:center;">
						<div style="font-size:10px;">Received by</div>
						<br><br><br>
						<div style="font-size:10px;font-weight:700;">(........................)</div>
					</td>
					
				</tr>
			</table>
		</div>
	</body>
</html>