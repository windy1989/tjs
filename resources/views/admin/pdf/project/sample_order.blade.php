<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Sample Order {{ $project->code }}</title>
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
			<h3 style="text-align:right;">PT. PERWIRA TAMARAYA ABADI</h3>
			<table cellpadding="0" cellspacing="0">
				<tr class="top">
					<td colspan="2">
						<table>
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
					<td colspan="2">
						<table>
							<tr>
								@foreach($brand as $b)
									<td>
										<center>
											<img src="{{ asset(Storage::url($b->image)) }}" width="200px">
										</center>
									</td>
								@endforeach
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td colspan="2">
						<table>
							<tr>
								<td style="text-align:center;">
									<h4><b>SAMPLE ORDER</b></h4>
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
								<td width="20%" style="font-size:10px;">ATTENTION</td>
								<td style="text-align:left; font-size:10px;">: {{ strtoupper($project->customer->name) }}</td>
								<td></td>
								<td></td>
								<td width="20%" style="font-size:10px;">DATE</td>
								<td style="text-align:left; font-size:10px;">: {{ date('d F Y', strtotime($project->created_at)) }}</td>
							</tr>
							<tr style="line-height:0 !important;">
								<td width="20%" style="font-size:10px;">PROJECT NAME</td>
								<td style="text-align:left; font-size:10px;">: {{ $project->name }}</td>
								<td></td>
								<td></td>
								<td width="20%" style="font-size:10px;">PROJECT NO</td>
								<td style="text-align:left; font-size:10px;">: {{ $project->code }}</td>
							</tr>
							<tr style="line-height:0 !important;">
								<td width="20%" style="font-size:10px;">CITY</td>
								<td style="text-align:left; font-size:10px;">: {{ $project->city->name }}</td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td colspan="2"></td></tr>
				<tr>
					<td colspan="2">
						<!-- <p style="font-size:10px;">Dear mr. {{ $project->customer->name }}<br>
						We are delighted to provide a price offer for this exciting project . The quotation and details are as follow :</p> -->
					</td>
				</tr>
			</table>
			
			<table border="1" cellpadding="5" cellspacing="0" style="width:100%; font-size:10px;">
				<thead>
					<tr style="background:#1a73e8;text-align:center;">
						<th style="color:white;" rowspan="2"><center>NO</center></th>
						<th style="color:white;" rowspan="2"><center>CODE</center></th>
						<th style="color:white;" rowspan="2"><center>NAME</center></th>
						<th style="color:white;" rowspan="2"><center>PICTURE</center></th>
						<th style="color:white;" rowspan="2"><center>BRAND</center></th>
						<th style="color:white;" rowspan="2"><center>SIZE(cm)</center></th>
						<th style="color:white;" rowspan="2"><center>CATEGORY</center></th>
						<th style="color:white;" rowspan="2"><center>COLOR</center></th>
						<th style="color:white;" colspan="2"><center>VOL/CTN</center></th>
						<th style="color:white;" rowspan="2"><center>DATE</center></th>
						<th style="color:white;" rowspan="2"><center>QTY</center></th>
						<th style="color:white;" rowspan="2"><center>UNIT</center></th>
						<th style="color:white;" rowspan="2"><center>SIZE</center></th>
						<th style="color:white;" rowspan="2"><center>TOTAL(sqm)</center></th>
					</tr>
					<tr style="background:#1a73e8;text-align:center;">
						<th style="color:white;">(M<sup>2</sup>)</th>
						<th style="color:white;">(Pcs)</th>
					</th>
				</thead>
				<tbody>
					@foreach($project->projectSample as $key => $ps)
						<tr>
							<td style="vertical-align:center;">
								<center>
									{{ $key + 1 }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->product->type->code }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->product->name() }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									<img src="{{ $ps->product->type->image() }}" style="max-width:28px; border:1px solid #ddd; border-radius:4px; padding: 5px;" class="img-fluid img-thumbnail">
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->product->brand->name }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->product->type->length }}x{{ $ps->product->type->width }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->product->type->category->name }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->product->type->color->name }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ (($ps->product->type->length/100) * ($ps->product->type->width / 100)) * $ps->product->carton_pcs }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->product->carton_pcs }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->date }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->qty }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->unit() }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->size }}
								</center>
							</td>
							<td style="vertical-align:center;">
								<center>
									{{ $ps->qty * ((($ps->product->type->length/100) * ($ps->product->type->width / 100)) * $ps->product->carton_pcs) }}
								</center>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table><br>
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td style="text-align:center;">
						<div style="font-size:10px;">Created By</div>
						<br><br><br>
						<div style="font-size:10px;">{{ $project->user->name }}</div>
						<div style="font-size:10px;">( {{ $project->user->email }} )</div>
					</td>
				</tr>
			</table>
		</div>
	</body>
</html>