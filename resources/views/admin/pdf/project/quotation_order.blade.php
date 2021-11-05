<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Quotation Order {{ $project->code }}</title>
		<style>
			body {
				font-family: 'Lato', sans-serif;
			}
			
			th {
				font-size:14px;
			}
			
			.invoice-box {
				font-size: 16px;
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
				background: #51b6bc;
				border-bottom: 1px solid #51b6bc;
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
							<tr style="background-color:#51b6bc;">
								<td style="text-align:center;color:white;padding-top:10px;padding-bottom:10px;">
									<h3><b>QUOTATION ORDER</b></h3>
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
								<td width="20%" style="font-size:12px;">ATTENTION</td>
								<td style="text-align:left; font-size:12px;">: {{ strtoupper($project->customer->name) }}</td>
								<td></td>
								<td></td>
								<td width="20%" style="font-size:12px;">DATE</td>
								<td style="text-align:left; font-size:12px;">: {{ date('d F Y', strtotime($project->created_at)) }}</td>
							</tr>
							<tr style="line-height:0 !important;">
								<td width="20%" style="font-size:12px;">PROJECT NAME</td>
								<td style="text-align:left; font-size:12px;">: {{ $project->name }}</td>
								<td></td>
								<td></td>
								<td width="20%" style="font-size:12px;">PROJECT NO</td>
								<td style="text-align:left; font-size:12px;">: {{ $project->code }}</td>
							</tr>
							<tr style="line-height:0 !important;">
								<td width="20%" style="font-size:12px;">CITY</td>
								<td style="text-align:left; font-size:12px;">: {{ $project->city->name }}</td>
								<td></td>
								<td></td>
								<td width="20%" style="font-size:12px;">REVISION</td>
								<td style="text-align:left; font-size:12px;">: {{ count($project->projectQuotation)-1 }}</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td colspan="2"></td></tr>
				<tr>
					<td colspan="2">
						<p style="font-size:12px;">Dear mr. {{ $project->customer->name }}<br>
						We are delighted to provide a price offer for this exciting project . The quotation and details are as follow :</p>
					</td>
				</tr>
			</table>
			
			@php
				$adatile = false;
				$adalain = false;
				$total = 0;
				$totaltile = 0;
				$totallain = 0;
				foreach($project->projectProduct as $key => $pp){
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
						<tr style="background:#51b6bc;text-align:center;">
							<th style="color:white;" colspan="17"><center>TILE(S)</center></th>
						</tr>
					@php
						}
					@endphp
					<tr style="background:#51b6bc;text-align:center;">
						<th style="color:white;" rowspan="2"><center>NO</center></th>
						<th style="color:white;" rowspan="2"><center>AREA</center></th>
						<th style="color:white;" rowspan="2"><center>CODE</center></th>
						<th style="color:white;" rowspan="2"><center>PICTURE</center></th>
						<th style="color:white;" rowspan="2"><center>BRAND</center></th>
						<th style="color:white;" rowspan="2"><center>SIZE(cm)</center></th>
						<th style="color:white;" rowspan="2"><center>CATEGORY</center></th>
						<th style="color:white;" rowspan="2"><center>COLOR</center></th>
						<th style="color:white;" colspan="2"><center>VOL/CTN</center></th>
						<th style="color:white;" colspan="2"><center>QTY</center></th>
						<th style="color:white;" colspan="2"><center>PRICE LIST (BEFORE TAX)</center></th>
						<th style="color:white;" colspan="2"><center>BEST PRICE (BEFORE TAX)</center></th>
						<th style="color:white;" rowspan="2"><center>TOTAL</center></th>
					</tr>
					<tr style="background:#51b6bc;text-align:center;">
						<th style="color:white;">(M<sup>2</sup>)</th>
						<th style="color:white;">(Pcs)</th>
						<th style="color:white;">(M<sup>2</sup>)</th>
						<th style="color:white;">(BOX)</th>
						<th style="color:white;">(M<sup>2</sup>)</th>
						<th style="color:white;">(BOX)</th>
						<th style="color:white;">(M<sup>2</sup>)</th>
						<th style="color:white;">(BOX)</th>
					</th>
				</thead>
				<tbody>
					@foreach($project->projectProduct as $key => $pp)
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
									{{ $pp->area }}
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
									{{ $m2 }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $pp->product->carton_pcs }}
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
									@php
										foreach($project->projectQuotation as $pq){
											foreach($pq->projectQuotationProduct as $pqp){
												if($pqp->product_id == $pp->product_id){
													if($pp->recommended_price == $pqp->recommended_price){
														echo number_format($pqp->recommended_price, 0, ',', '.').'<br>';
													}else{
														echo '<del>'.number_format($pqp->recommended_price, 0, ',', '.').'</del><br>';
													}
												}
											}
										}
									@endphp
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ number_format($pp->recommended_price * $m2, 0, ',', '.') }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									@php
										foreach($project->projectQuotation as $pq2){
											foreach($pq2->projectQuotationProduct as $pqp2){
												if($pqp2->product_id == $pp->product_id){
													if($pp->best_price == $pqp2->best_price){
														echo number_format($pqp2->best_price, 0, ',', '.').'<br>';
													}else{
														echo '<del>'.number_format($pqp2->best_price, 0, ',', '.').'</del><br>';
													}
												}
											}
										}
									@endphp
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
						<th colspan="14"></th>
						<th colspan="2">Subtotal</th>
						<th colspan="2">{{ number_format($totaltile, 0, ',', '.') }}</th>
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
						<tr style="background:#51b6bc;text-align:center;">
							<th style="color:white;" colspan="17"><center>ETC(S)</center></th>
						</tr>
					@php
						}
					@endphp
					<tr style="background:#51b6bc;text-align:center;">
						<th style="color:white;" rowspan="2"><center>NO</center></th>
						<th style="color:white;" rowspan="2"><center>AREA</center></th>
						<th style="color:white;" rowspan="2"><center>CODE</center></th>
						<th style="color:white;" rowspan="2"><center>PICTURE</center></th>
						<th style="color:white;" rowspan="2"><center>BRAND</center></th>
						<th style="color:white;" rowspan="2"><center>SIZE(cm)</center></th>
						<th style="color:white;" rowspan="2"><center>CATEGORY</center></th>
						<th style="color:white;" rowspan="2"><center>COLOR</center></th>
						<th style="color:white;" colspan="2" rowspan="2"><center>SPEC</center></th>
						<th style="color:white;" colspan="2"><center>QTY</center></th>
						<th style="color:white;" colspan="2"><center>PRICE LIST (BEFORE TAX)</center></th>
						<th style="color:white;" colspan="2"><center>BEST PRICE (BEFORE TAX)</center></th>
						<th style="color:white;" rowspan="2"><center>TOTAL</center></th>
					</tr>
					<tr style="background:#51b6bc;text-align:center;">
						<th style="color:white;" colspan="2">PCS</th>
						<th style="color:white;" colspan="2">PCS</th>
						<th style="color:white;" colspan="2">PCS</th>
					</th>
				</thead>
				<tbody>
					@php
						$no = 1;
					@endphp
					@foreach($project->projectProduct as $key => $pp)
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
									{{ $pp->area }}
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
							<td style="vertical-align:center;" colspan="2">
								<center>
									{{ $pp->spec }}
								</center>
							</td>
							<td style="vertical-align:center;" colspan="2">
								<center>
									{{ $pp->qty }}
								</center>
							</td>
							<td style="vertical-align:center;" colspan="2">
								<center>
									@php
										foreach($project->projectQuotation as $pq){
											foreach($pq->projectQuotationProduct as $pqp){
												if($pqp->product_id == $pp->product_id){
													if($pp->recommended_price == $pqp->recommended_price){
														echo number_format($pqp->recommended_price, 0, ',', '.').'<br>';
													}else{
														echo '<del>'.number_format($pqp->recommended_price, 0, ',', '.').'</del><br>';
													}
												}
											}
										}
									@endphp
								</center>
							</td>
							<td style="vertical-align:center;" colspan="2">
								<center>
									@php
										foreach($project->projectQuotation as $pq2){
											foreach($pq2->projectQuotationProduct as $pqp2){
												if($pqp2->product_id == $pp->product_id){
													if($pp->best_price == $pqp2->best_price){
														echo number_format($pqp2->best_price, 0, ',', '.').'<br>';
													}else{
														echo '<del>'.number_format($pqp2->best_price, 0, ',', '.').'</del><br>';
													}
												}
											}
										}
									@endphp
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
						<th colspan="14"></th>
						<th colspan="2">Subtotal</th>
						<th colspan="2">{{ number_format($totallain, 0, ',', '.') }}</th>
					</tr>
				</tbody>
				@php
				}
				@endphp
			</table>
			<br>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td width="50%" style="background-color:#51b6bc;">
						<table cellpadding="2" cellspacing="0" border="1" style="font-size:14px;color:white;">
							<tr>
								<td>
									<b>GRANDTOTAL</b>
								</td>
								<td style="text-align:center;">
									<b>IDR {{ $project->ppn == '1' ? number_format($total + (0.1 * $total), 0, ',', '.') : number_format($total, 0, ',', '.') }} </b>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									PAYMENT WILL BE TRANSFERRED TO :
									<p>
										<b>{{ $project->coa->name }}</b>
									</p>
								</td>
							</tr>
						</table>
					</td>
					<td width="5%"></td>
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
									<h6>TAX</h6>
								</td>
								<td>
									<h6>IDR {{ $project->ppn == '1' ? number_format(0.1 * $total, 0, ',', '.') : number_format(0, 0, ',', '.') }}</h6>
								</td>
							</tr>
							<tr>
								<td>
									<h6>TOTAL</h6>
								</td>
								<td>
									<h6>IDR {{ $project->ppn == '1' ? number_format($total + (0.1 * $total), 0, ',', '.') : number_format($total, 0, ',', '.') }}</h6>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="4" style="padding-top:10px;">
						<h6 style="font-size:10px; text-align:center;"><u>TERMS & CONDITIONS</u> :</h6>
						<p style="font-size:10px;">
							<ol>
								<li>The unit price include 10% VAT.</li>
								<li>Prices do not include installation.</li>
								<li>Prices Franco {{ $project->city->name.' '.$project->country->name }} ( On Truck ).</li>
								<li>The price offer is valid for 30 days.</li>
								<li>Delivery time is between 8-24 weeks, depending on the stock of goods ordered.</li>
								<li>Payment {!! $project->paymentMethod() !!}.</li>
								<li>1st quality goods</li>
							</ol>
						</p>
						<br>
						<p style="font-size:10px;">
							We hope that we can work together in supplying the material of your project. 
							<br>For further information, please contact our sales person - {{ $project->user->name }}. 
							<br>Thank you for your time.
						</p>
					</td>
				</tr>
			</table><br><br><br><br>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td style="text-align:center;" width="33%">
						<div style="font-size:10px;">Created By</div>
						@if($project->user->sign)
							<div><img src="{{ asset(Storage::url($project->user->sign)) }}" height="65px"></div>
						@else
							<br><br><br>
						@endif
						<div style="font-size:10px;">{{ $project->user->name }}</div>
						<div style="font-size:10px;">( {{ $project->user->email }} )</div>
					</td>
					@if(isset($project->getApprovalQuotation()->approved_1->name))
					<td style="text-align:center;" width="33%">
						<div style="font-size:10px;">Approved By</div>
						@if($project->getApprovalQuotation()->approved_1->sign)
							<div><img src="{{ asset(Storage::url($project->getApprovalQuotation()->approved_1->sign)) }}" height="65px"></div>
						@else
							<br><br><br>
						@endif
						<div style="font-size:10px;">{{ $project->getApprovalQuotation()->approved_1->name }}</div>
						<div style="font-size:10px;">( {{ $project->getApprovalQuotation()->approved_1->email }} )</div>
					</td>
					@endif
					@if(isset($project->getApprovalQuotation()->approved_2->name))
					<td style="text-align:center;" width="33%">
						<div style="font-size:10px;">Approved By</div>
						@if($project->getApprovalQuotation()->approved_2->sign)
							<div><img src="{{ asset(Storage::url($project->getApprovalQuotation()->approved_1->sign)) }}" height="65px"></div>
						@else
							<br><br><br>
						@endif
						<div style="font-size:10px;">{{ $project->getApprovalQuotation()->approved_2->name }}</div>
						<div style="font-size:10px;">( {{ $project->getApprovalQuotation()->approved_2->email }} )</div>
					</td>
					@endif
				</tr>
			</table>
		</div>
	</body>
</html>