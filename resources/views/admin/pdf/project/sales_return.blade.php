<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Sales Return {{ $project->code }}</title>
		<style>
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
				background: #1a73e8;
				border-bottom: 1px solid #1a73e8;
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
								<td class="title">
									<img src="{{ asset('website/logo-black.png') }}" width="150">
								</td>
								<td>
									<div style="font-size:9px; font-weight:bold;">JAGAT BUILDING</div>
									<div style="font-size:9px; font-weight:500;">St. Tomang Raya No 28 - 30</div>
									<div style="font-size:9px; font-weight:500;">Jakarta 11430</div>
									<div style="font-size:9px; font-weight:500;">Phone : 0811257180 / 081225575295</div>
									<div style="font-size:9px; font-weight:500;">Email : infojkt@smartmarbleandbath.com</div>
								</td>
								<td style="text-align:right;">
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
							<tr>
								<td style="text-align:center;">
									<h4><b>SALES RETURN</b></h4>
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
								<td width="20%" style="font-size:10px;">Sales No.</td>
								<td style="text-align:left; font-size:10px;">: {{ $project->projectSale->code }}</td>
								<td></td>
								<td></td>
								<td width="20%" style="font-size:10px;"></td>
								<td style="text-align:left; font-size:10px;">: </td>
							</tr>
							<tr style="line-height:0 !important;">
								<td width="20%" style="font-size:10px;">Sales Return</td>
								<td style="text-align:left; font-size:10px;">: {{ $project->code }}</td>
								<td></td>
								<td></td>
								<td width="20%" style="font-size:10px;"></td>
								<td style="text-align:left; font-size:10px;"></td>
							</tr>
							<tr style="line-height:0 !important;">
								<td width="20%" style="font-size:10px;">Customer</td>
								<td style="text-align:left; font-size:10px;">: {{ $project->projectSale->project->customer->name }}</td>
								<td></td>
								<td></td>
								<td width="20%" style="font-size:10px;"></td>
								<td style="text-align:left; font-size:10px;"></td>
							</tr>
							<tr style="line-height:0 !important;">
								<td width="20%" style="font-size:10px;">Date</td>
								<td style="text-align:left; font-size:10px;">: {{ date('d F Y',strtotime($project->created_at)) }}</td>
								<td></td>
								<td></td>
								<td width="20%" style="font-size:10px;"></td>
								<td style="text-align:left; font-size:10px;"></td>
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
				foreach($project->projectSaleReturnProduct as $key => $pp){
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
						<tr style="background:#1a73e8;text-align:center;">
							<th style="color:white;" colspan="10"><center>TILE(S)</center></th>
						</tr>
					@php
						}
					@endphp
					<tr style="background:#1a73e8;text-align:center;">
						<th style="color:white;"><center>NO</center></th>
						<th style="color:white;"><center>CODE</center></th>
						<th style="color:white;"><center>PICTURE</center></th>
						<th style="color:white;"><center>BRAND</center></th>
						<th style="color:white;"><center>SIZE(cm)</center></th>
						<th style="color:white;"><center>CATEGORY</center></th>
						<th style="color:white;"><center>COLOR</center></th>
						<th style="color:white;"><center>QTY</center></th>
						<th style="color:white;"><center>UNIT</center></th>
					</tr>
				</thead>
				<tbody>
					@foreach($project->projectSaleReturnProduct as $key => $pp)
						@php
							if($pp->product->type->category->parent()->parent()->slug == 'tile'){
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
									{{ $pp->unit() }}
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
				if($adalain == true){
				@endphp
				<thead>
					@php
						if($adatile == true){
					@endphp
						<tr style="background:#1a73e8;text-align:center;">
							<th style="color:white;" colspan="10"><center>ETC(S)</center></th>
						</tr>
					@php
						}
					@endphp
					<tr style="background:#1a73e8;text-align:center;">
						<th style="color:white;"><center>NO</center></th>
						<th style="color:white;"><center>CODE</center></th>
						<th style="color:white;"><center>PICTURE</center></th>
						<th style="color:white;"><center>BRAND</center></th>
						<th style="color:white;"><center>SIZE(cm)</center></th>
						<th style="color:white;"><center>CATEGORY</center></th>
						<th style="color:white;"><center>COLOR</center></th>
						<th style="color:white;"><center>QTY</center></th>
						<th style="color:white;"><center>UNIT</center></th>
					</tr>
				</thead>
				<tbody>
					@php
						$no = 1;
					@endphp
					@foreach($project->projectSaleReturnProduct as $key => $pp)
						@php
							if($pp->product->type->category->parent()->parent()->slug !== 'tile'){
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
									{{ $pp->qty }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $pp->unit() }}
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
			</table>
			<br>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td width="45%"></td>
					<td width="10%"></td>
					<td width="45%"></td>
				</tr>
				<tr>
					<td colspan="3" style="padding-top:10px;">
						<h6 style="font-size:10px; text-align:center;">Note :</h6>
						<p style="font-size:10px;">
							{{ $project->note }}
						</p>
					</td>
				</tr>
			</table><br><br><br>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td style="text-align:center;">
						<div style="font-size:10px;">Created by</div>
						<div style="font-size:10px;"></div>
						@if(isset($project->user->sign))
							<div><img src="{{ asset(Storage::url($project->user->sign)) }}" height="65px"></div>
						@else
							<br><br><br>
						@endif
						<div style="font-size:10px;font-weight:700;">{{ $project->user->name }}</div>
					</td>
					<td style="text-align:center;">
						<div style="font-size:10px;">Approved by</div>
						<div style="font-size:10px;"></div>
						@if(isset($project->approve->sign))
							<div><img src="{{ asset(Storage::url($project->approve->sign)) }}" height="65px"></div>
						@else
							<br><br><br>
						@endif
						<div style="font-size:10px;font-weight:700;">{{ $project->approve->name }}</div>
					</td>
					<td style="text-align:center;">
						<div style="font-size:10px;">Customer sign</div>
						<div style="font-size:10px;"></div>
						<br><br><br>
						<div style="font-size:10px;font-weight:700;">{{ $project->projectSale->project->customer->name }}</div>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>