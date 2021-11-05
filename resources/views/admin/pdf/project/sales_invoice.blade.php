<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Sales Invoice {{ $project->code }}</title>
		<style>
			body {
				font-family: 'Lato', sans-serif;
			}
			
			th {
				font-size:14px;
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
				background: #c92089;
				border-bottom: 1px solid #c92089;
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
				border-top: 1px solid #eee;
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
					<td colspan="2">
						<table>
							<tr style="background-color:#c92089;">
								<td style="text-align:center;color:white;padding-top:10px;padding-bottom:10px;">
									<h3><b>SALES INVOICE</b></h3>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table><br>
			<table>
				<tr>
					<td colspan="2">
						<table width="100%">
							<tr style="line-height:0 !important;">
								<td width="20%" style="font-size:12px;">INVOICE</td>
								<td style="text-align:left; font-size:12px;">: {{ $project->code }}</td>
								<td></td>
								<td></td>
								<td width="20%" style="font-size:12px;">CUSTOMER</td>
								<td style="text-align:left; font-size:12px;">: {{ $project->projectSale->project->customer->name }}</td>
							</tr>
							<tr style="line-height:0 !important;">
								<td width="20%" style="font-size:12px;">DATE - DUE</td>
								<td style="text-align:left; font-size:12px;">: {{ date('d F Y', strtotime($project->date)) }} - {{ $project->term_payment !== '0' ? date('d F Y', strtotime($project->due_date)) : 'Default' }}</td>
								<td></td>
								<td></td>
								<td width="20%" style="font-size:12px;">ADDRESS</td>
								<td style="text-align:left; font-size:12px;">: {{ $project->projectSale->address }}</td>
							</tr>
							<tr style="line-height:0 !important;">
								<td width="20%" style="font-size:12px;">SALES NO.</td>
								<td style="text-align:left; font-size:12px;">: {{ $project->projectSale->code }}</td>
								<td></td>
								<td></td>
								<td width="20%" style="font-size:12px;">SALES</td>
								<td style="text-align:left; font-size:12px;">: {{ $project->projectSale->sales->name }}</td>
							</tr>
							<tr style="line-height:0 !important;">
								<td width="20%" style="font-size:12px;">SO Date</td>
								<td style="text-align:left; font-size:12px;">: {{ date('d F Y', strtotime($project->projectSale->created_at)) }}</td>
								<td></td>
								<td></td>
								<td width="20%" style="font-size:12px;">PHONE</td>
								<td style="text-align:left; font-size:12px;">: {{ $project->projectSale->project->customer->phone }}</td>
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
				$totalpaid = 0;
				
				foreach($project->projectSale->projectSalePay as $key => $psp){
					$totalpaid += $psp->nominal;
				}
				
				foreach($project->projectSale->projectSaleProduct as $key => $pp){
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
				@endphp
				<thead>
					@php
						if($adalain == true){
					@endphp
						<tr style="background:#c92089;text-align:center;">
							<th style="color:white;" colspan="12"><center>TILE(S)</center></th>
						</tr>
					@php
						}
					@endphp
					<tr style="background:#c92089;text-align:center;">
						<th style="color:white;" rowspan="2"><center>NO</center></th>
						<th style="color:white;" rowspan="2"><center>CODE</center></th>
						<th style="color:white;" rowspan="2"><center>PICTURE</center></th>
						<th style="color:white;" rowspan="2"><center>BRAND</center></th>
						<th style="color:white;" rowspan="2"><center>SIZE(cm)</center></th>
						<th style="color:white;" rowspan="2"><center>CATEGORY</center></th>
						<th style="color:white;" rowspan="2"><center>COLOR</center></th>
						<th style="color:white;" colspan="2"><center>QTY</center></th>
						<th style="color:white;" colspan="2"><center>PRICE (BEFORE TAX)</center></th>
						<th style="color:white;" rowspan="2"><center>TOTAL</center></th>
					</tr>
					<tr style="background:#c92089;text-align:center;">
						<th style="color:white;">(M<sup>2</sup>)</th>
						<th style="color:white;">(BOX)</th>
						<th style="color:white;">(M<sup>2</sup>)</th>
						<th style="color:white;">(BOX)</th>
					</th>
				</thead>
				<tbody>
					@foreach($project->projectSale->projectSaleProduct as $key => $pp)
						@php
							if($pp->product->type->category->parent()->parent()->slug == 'tile'){
								$m2 = (( $pp->product->type->length * $pp->product->type->width ) / 10000) * $pp->product->carton_pcs;
								$countbox = ceil($pp->qty / $m2);
								$total += $pp->best_price * $m2 * $countbox;
								$totaltile += $pp->best_price * $m2 * $countbox;
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
									{{ $pp->product->brand->name }}
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
									{{ $pp->qty }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $countbox }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ number_format($pp->best_price, 0, ',', '.') }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ number_format($pp->best_price * $m2, 0, ',', '.') }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ number_format($pp->best_price * $m2 * $countbox, 0, ',', '.') }}
								</center>
							</td>
						</tr>
						@php
							}
						@endphp
					@endforeach
					<tr>
						<th colspan="9"></th>
						<th colspan="2">Subtotal</th>
						<th colspan="1">{{ number_format($totaltile, 0, ',', '.') }}</th>
					</tr>
				</tbody>
				@php
				}
				if($adalain == true){
				@endphp
				<thead>
					@php
						if($adatile == true){
					@endphp
						<tr style="background:#c92089;text-align:center;">
							<th style="color:white;" colspan="12"><center>ETC(S)</center></th>
						</tr>
					@php
						}
					@endphp
					<tr style="background:#c92089;text-align:center;">
						<th style="color:white;" rowspan="2"><center>NO</center></th>
						<th style="color:white;" rowspan="2"><center>CODE</center></th>
						<th style="color:white;" rowspan="2"><center>PICTURE</center></th>
						<th style="color:white;" rowspan="2"><center>BRAND</center></th>
						<th style="color:white;" rowspan="2"><center>SIZE(cm)</center></th>
						<th style="color:white;" rowspan="2"><center>CATEGORY</center></th>
						<th style="color:white;" rowspan="2"><center>COLOR</center></th>
						<th style="color:white;" rowspan="2"><center>SPEC</center></th>
						<th style="color:white;" rowspan="2"><center>QTY</center></th>
						<th style="color:white;" colspan="2"><center>PRICE (BEFORE TAX)</center></th>
						<th style="color:white;" rowspan="2"><center>TOTAL</center></th>
					</tr>
					<tr style="background:#1a73e8;text-align:center;">
						<th style="color:white;" colspan="2">PCS</th>
					</th>
				</thead>
				<tbody>
					@php
						$no = 1;
					@endphp
					@foreach($project->projectSale->projectSaleProduct as $key => $pp)
						@php
							if($pp->product->type->category->parent()->parent()->slug !== 'tile'){
								$total += $pp->best_price * $pp->qty;
								$totallain += $pp->best_price * $pp->qty;
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
									{{ $pp->product->brand->name }}
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
									{{ $pp->spec }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $pp->qty }}
								</center>
							</td>
							<td style="vertical-align:center;" colspan="2">
								<center>
									{{ number_format($pp->best_price, 0, ',', '.') }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ number_format($pp->best_price * $pp->qty, 0, ',', '.') }}
								</center>
							</td>
						</tr>
						@php
								$no++;
							}
						@endphp
					@endforeach
					<tr>
						<th colspan="9"></th>
						<th colspan="2">Subtotal</th>
						<th colspan="1">{{ number_format($totallain, 0, ',', '.') }}</th>
					</tr>
				</tbody>
				@php
				}
				@endphp
			</table>
			<br>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td width="45%">
						<table cellpadding="2" cellspacing="0" border="1" style="width:100% !important;">
							<tr>
								<td>
									<div style="font-size:12px;">Note :
									<br>{{ $project->projectSale->note }}
									</div>
								</td>
							</tr>
						</table>
					</td>
					<td width="10%"></td>
					<td width="45%">
						<table cellpadding="2" cellspacing="0" border="1">
							<tr>
								<td>
									<h6>SUBTOTAL</h6>
								</td>
								<td>
									<h6>IDR {{ number_format($total, 0, ',', '.') }}</h6>
								</td>
							</tr>
							<tr>
								<td>
									<h6>DELIVERY COST</h6>
								</td>
								<td>
									<h6>IDR {{ number_format($project->projectSale->delivery_cost, 0, ',', '.') }}</h6>
								</td>
							</tr>
							<tr>
								<td>
									<h6>CUTTING COST</h6>
								</td>
								<td>
									<h6>IDR {{ number_format($project->projectSale->cutting_cost, 0, ',', '.') }}</h6>
								</td>
							</tr>
							<tr>
								<td>
									<h6>MISCELLANEOUS COST</h6>
								</td>
								<td>
									<h6>IDR {{ number_format($project->projectSale->misc_cost, 0, ',', '.') }}</h6>
								</td>
							</tr>
							<tr>
								<td>
									<h6>TOTAL</h6>
								</td>
								<td>
									<h6>IDR {{ number_format($total + $project->projectSale->delivery_cost + $project->projectSale->cutting_cost + $project->projectSale->misc_cost, 0, ',', '.') }}</h6>
								</td>
							</tr>
							<tr>
								<td>
									<h6>TAX</h6>
								</td>
								<td>
									<h6>IDR {{ $project->projectSale->project->ppn == '1' ? number_format(0.1 * ($total + $project->projectSale->delivery_cost + $project->projectSale->cutting_cost + $project->projectSale->misc_cost), 0, ',', '.') : number_format(0, 0, ',', '.') }}</h6>
								</td>
							</tr>
							<tr>
								<td>
									<h6>GRANDTOTAL</h6>
								</td>
								<td>
									<h6>IDR {{ $project->projectSale->project->ppn == '1' ? number_format(($total + $project->projectSale->delivery_cost + $project->projectSale->cutting_cost + $project->projectSale->misc_cost) + (0.1 * ($total + $project->projectSale->delivery_cost + $project->projectSale->cutting_cost + $project->projectSale->misc_cost)), 0, ',', '.') : number_format(($total + $project->projectSale->delivery_cost + $project->projectSale->cutting_cost + $project->projectSale->misc_cost), 0, ',', '.') }}</h6>
								</td>
							</tr>
							<tr>
								<td>
									<h6>PAID</h6>
								</td>
								<td>
									<h6>IDR {{ number_format($totalpaid, 0, ',', '.') }}</h6>
								</td>
							</tr>
							<tr>
								<td>
									<h6>UNDERPAYMENT</h6>
								</td>
								<td>
									<h6>IDR {{ $project->projectSale->project->ppn == '1' ? number_format(($total + $project->projectSale->delivery_cost + $project->projectSale->cutting_cost + $project->projectSale->misc_cost) + (0.1 * ($total + $project->projectSale->delivery_cost + $project->projectSale->cutting_cost + $project->projectSale->misc_cost)) - $totalpaid, 0, ',', '.') : number_format(($total + $project->projectSale->delivery_cost + $project->projectSale->cutting_cost + $project->projectSale->misc_cost) - $totalpaid, 0, ',', '.') }}</h6>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						
					</td>
				</tr>
			</table>
			<br>
			<table border="1" cellpadding="5" cellspacing="0" style="width:100%; font-size:12px;">
				<thead>
					<tr style="background:#c92089;text-align:center;">
						<th style="color:white;" colspan="7"><center>List Payments</center></th>
					</tr>
					<tr style="background:#c92089;text-align:center;">
						<th style="color:white;"><center>No.</center></th>
						<th style="color:white;"><center>Invoice</center></th>
						<th style="color:white;"><center>Date</center></th>
						<th style="color:white;"><center>Due</center></th>
						<th style="color:white;"><center>Payment</center></th>
						<th style="color:white;"><center>Note</center></th>
						<th style="color:white;"><center>Nominal</center></th>
					</tr>
				</thead>
				<tbody>
					@foreach($project->projectSale->projectSalePay as $key => $psp)
						@php
							$style = '';
							if($project->id == $psp->id){
								$style = 'background:#65f075;';
							}
						@endphp
						<tr style="{{ $style }}">
							<td><center>{{ $key + 1 }}</center></td>
							<td><center>{{ $psp->code }}</center></td>
							<td><center>{{ date('d F Y', strtotime($psp->date)) }}</center></td>
							<td><center>{{ date('d F Y', strtotime($psp->due_date)) }}</center></td>
							<td><center>{{ $psp->payment() }}</center></td>
							<td><center>{{ $psp->note }}</center></td>
							<td><center>IDR {{ number_format($psp->nominal,2,',','.') }}</center></td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<br><br><br><br>
			<table cellpadding="0" cellspacing="0">
				<tr>
					@if(isset($project->approved->name))
					<td style="text-align:center;" width="33%">
						<div style="font-size:10px;">Acknowledged By,</div>
						@if(isset($project->approved->sign))
							<div><img src="{{ asset(Storage::url($project->approved->sign)) }}" height="65px"></div>
						@else
							<br><br><br>
						@endif
						<div style="font-size:10px;">{{ $project->approved->name }}</div>
						<div style="font-size:10px;">( {{ $project->approved->email }} )</div>
					</td>
					@endif
					@if(isset($project->marketing->name))
					<td style="text-align:center;" width="33%">
						<div style="font-size:10px;">Marketing,</div>
						@if(isset($project->marketing->sign))
							<div><img src="{{ asset(Storage::url($project->marketing->sign)) }}" height="65px"></div>
						@else
							<br><br><br>
						@endif
						<div style="font-size:10px;">{{ $project->marketing->name }}</div>
						<div style="font-size:10px;">( {{ $project->marketing->email }} )</div>
					</td>
					@endif
					<td style="text-align:center;" width="33%">
						<div style="font-size:10px;">Created By</div>
						@if(isset($project->user->sign))
							<div><img src="{{ asset(Storage::url($project->user->sign)) }}" height="65px"></div>
						@else
							<br><br><br>
						@endif
						<div style="font-size:10px;">{{ $project->user->name }}</div>
						<div style="font-size:10px;">( {{ $project->user->email }} )</div>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>