<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i>
					<span class="font-weight-semibold">Profit & Loss</span>
				</h4>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<a href="javascript:void(0);" class="breadcrumb-item">Report</a>
					<a href="javascript:void(0);" class="breadcrumb-item">Accounting</a>
					<span class="breadcrumb-item active">Profit & Loss</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="card">
			<div class="card-body">
				<h6 class="text-muted text-uppercase text-center font-weight-bold">Periode {{ date('F Y', strtotime($filter)) }}</h6>
				<form action="{{ url('admin/report/accounting/profit_loss') }}" method="GET" id="form_filter">
					@csrf
					<div class="form-group">
						<center class="d-block">
							<div class="row justify-content-center no-gutters">
								<div class="col-md-3">
									<input type="month" name="filter" id="filter" class="form-control" style="height:32px;" value="{{ $filter }}" onchange="submitFilter()">
								</div>
								@if(date('Y-m') != $filter)
									<div class="col-md-1">
										<a href="{{ url('admin/report/accounting/profit_loss') }}" class="btn bg-danger btn-sm">Reset</a>
									</div>
								@endif
							</div>
						</center>
					</div>
				</form>
				<div class="form-group"><hr></div>
				<ul class="nav nav-tabs nav-tabs-highlight nav-justified">
					<li class="nav-item">
						<a href="#solid-bordered-justified-tab1" class="nav-link active" data-toggle="tab">Summary</a>
					</li>
					<li class="nav-item">
						<a href="#solid-bordered-justified-tab2" class="nav-link" data-toggle="tab">Surabaya</a>
					</li>
					<li class="nav-item">
						<a href="#solid-bordered-justified-tab3" class="nav-link" data-toggle="tab">Jakarta</a>
					</li>
					<li class="nav-item">
						<a href="#solid-bordered-justified-tab4" class="nav-link" data-toggle="tab">Non Operation</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade show active" id="solid-bordered-justified-tab1">
						<p class="mt-3">
							<div class="table-responsive">
								<table class="table table-sm table-bordered">
									<thead>
										<tr class="text-center">
											<th rowspan="2" class="bg-grey">Description</th>
											<th colspan="6" class="bg-primary">Current Month</th>
											<th colspan="4" class="bg-primary">Last Month</th>
										</tr>
										<tr class="text-center">
											<th class="bg-grey">Budget</th>
											<th class="bg-grey">%</th>
											<th class="bg-grey">Actual</th>
											<th class="bg-grey">%</th>
											<th class="bg-grey">Variance</th>
											<th class="bg-grey">%</th>
											<th class="bg-grey">Actual</th>
											<th class="bg-grey">%</th>
											<th class="bg-grey">Variance</th>
											<th class="bg-grey">%</th>
										</tr>
									</thead>
									<tbody>
										<tr class="font-weight-bold">
											<th colspan="12">INCOME</th>
										</tr>
										<tr class="font-weight-bold">
											<th colspan="12"><span class="ml-2">Sales</span></th>
										</tr>
										@php
											$total_sale_actual_current   = 0;
											$total_sale_budget           = 0;
											$total_sale_variance_current = 0;
											$total_sale_actual_last      = 0;
											$total_sale_variance_last    = 0;
										@endphp
										@foreach($profit_loss['summary']['sale'] as $s)
											@php
												$total_sale_actual_current   += $s['actual']['current'];
												$total_sale_budget           += $s['budget'];
												$total_sale_variance_current += $s['variance']['nominal']['current'];
												$total_sale_actual_last      += $s['actual']['last'];
												$total_sale_variance_last    += $s['variance']['nominal']['last'];
											@endphp
											<tr>
												<td class="text-left"><span class="ml-4">{{ $s['name'] }}</span></td>
												<td class="text-right">{{ number_format($s['budget']) }}</td>
												<td class="text-center">
												@if($profit_loss['summary']['total']['income']['budget'] > 0)
													{{ round(($s['budget'] / $profit_loss['summary']['total']['income']['budget']) * 100) }}%
												@else
													0%
												@endif
												</td>
												<td class="text-right">{{ number_format($s['actual']['current']) }}</td>
												<td class="text-center">
												@if($profit_loss['summary']['total']['income']['actual']['current'] > 0)
													{{ round(($s['actual']['current'] / $profit_loss['summary']['total']['income']['actual']['current']) * 100) }}%
												@else
													0%
												@endif
												</td>
												<td class="text-right">{{ number_format($s['variance']['nominal']['current']) }}</td>
												<td class="text-center">{{ number_format($s['variance']['percent']['current']) }}%</td>
												<td class="text-right">{{ number_format($s['actual']['last']) }}</td>
												<td class="text-center">
												@if($profit_loss['summary']['total']['income']['actual']['last'] > 0)
													{{ round(($s['actual']['last'] / $profit_loss['summary']['total']['income']['actual']['last']) * 100) }}%
												@else
													0%
												@endif
												</td>
												<td class="text-right">{{ number_format($s['variance']['nominal']['last']) }}</td>
												<td class="text-center">{{ number_format($s['variance']['percent']['last']) }}%</td>
											</tr>
										@endforeach
										<tr class="table-secondary font-italic">
											<th class="text-right font-weight-bold">Total Sales</th>
											<th class="text-right font-weight-bold">{{ number_format($total_sale_budget) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['budget'] > 0)
												@php $total['income_budget_percent'] += round(($total_sale_budget / $profit_loss['summary']['total']['income']['budget']) * 100); @endphp
												{{ round(($total_sale_budget / $profit_loss['summary']['total']['income']['budget']) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_sale_actual_current) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['actual']['current'] > 0)
												@php $total['income_actual_percent_current'] += round(($total_sale_actual_current / $profit_loss['summary']['total']['income']['actual']['current']) * 100); @endphp
												{{ round(($total_sale_actual_current / $profit_loss['summary']['total']['income']['actual']['current']) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_sale_variance_current) }}</th>
											<th class="text-center font-weight-bold">
												@if($total_sale_budget > 0)
												{{ round(($total_sale_variance_current / $total_sale_budget) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_sale_actual_last) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['actual']['last'] > 0)
												@php $total['income_actual_percent_last'] += round(($total_sale_actual_last / $profit_loss['summary']['total']['income']['actual']['last']) * 100); @endphp
												{{ round(($total_sale_actual_last / $profit_loss['summary']['total']['income']['actual']['last']) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_sale_variance_last) }}</th>
											<th class="text-center font-weight-bold">
												@if($total_sale_actual_last > 0)
												{{ round(($total_sale_variance_last / $total_sale_actual_last) * 100) }}%
												@else
												0%
												@endif
											</th>
										</tr>
										<tr class="font-weight-bold">
											<th colspan="12"><span class="ml-2">Sales Service</span></th>
										</tr>
										@php
											$total_sale_service_actual_current   = 0;
											$total_sale_service_budget           = 0;
											$total_sale_service_variance_current = 0;
											$total_sale_service_actual_last      = 0;
											$total_sale_service_variance_last    = 0;
										@endphp
										@foreach($profit_loss['summary']['sale_service'] as $ss)
											@php
												$total_sale_service_actual_current   += $ss['actual']['current'];
												$total_sale_service_budget           += $ss['budget'];
												$total_sale_service_variance_current += $ss['variance']['nominal']['current'];
												$total_sale_service_actual_last      += $ss['actual']['last'];
												$total_sale_service_variance_last    += $ss['variance']['nominal']['last'];
											@endphp
											<tr>
												<td class="text-left"><span class="ml-4">{{ $ss['name'] }}</span></td>
												<td class="text-right">{{ number_format($ss['budget']) }}</td>
												<td class="text-center">
												@if($profit_loss['summary']['total']['income']['budget'] > 0)
													{{ round(($ss['budget'] / $profit_loss['summary']['total']['income']['budget']) * 100) }}%
												@else
													0%
												@endif
												</td>
												<td class="text-right">{{ number_format($ss['actual']['current']) }}</td>
												<td class="text-center">
												@if($profit_loss['summary']['total']['income']['actual']['current'] > 0)
													{{ round(($ss['actual']['current'] / $profit_loss['summary']['total']['income']['actual']['current']) * 100) }}%
												@else
													0%
												@endif
												</td>
												<td class="text-right">{{ number_format($ss['variance']['nominal']['current']) }}</td>
												<td class="text-center">{{ number_format($ss['variance']['percent']['current']) }}%</td>
												<td class="text-right">{{ number_format($ss['actual']['last']) }}</td>
												<td class="text-center">
												@if($profit_loss['summary']['total']['income']['actual']['last'] > 0)
													{{ round(($ss['actual']['last'] / $profit_loss['summary']['total']['income']['actual']['last']) * 100) }}%
												@else
													0%
												@endif
												</td>
												<td class="text-right">{{ number_format($ss['variance']['nominal']['last']) }}</td>
												<td class="text-center">{{ number_format($ss['variance']['percent']['last']) }}%</td>
											</tr>
										@endforeach
										<tr class="table-secondary font-italic">
											<th class="text-right font-weight-bold">Total Income</th>
											<th class="text-right font-weight-bold">{{ number_format($total_sale_service_budget) }}</th>
											<th class="text-center font-weight-bold">
												@if($total_sale_service_budget > 0 | $profit_loss['summary']['total']['income']['budget'] > 0)
												@php $total['income_budget_percent'] += round(($total_sale_service_budget / $profit_loss['summary']['total']['income']['budget']) * 100); @endphp
												{{ round(($total_sale_service_budget / $profit_loss['summary']['total']['income']['budget']) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_sale_service_actual_current) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['actual']['current'] > 0)
												@php $total['income_actual_percent_current'] += round(($total_sale_service_actual_current / $profit_loss['summary']['total']['income']['actual']['current']) * 100); @endphp
												{{ round(($total_sale_service_actual_current / $profit_loss['summary']['total']['income']['actual']['current']) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_sale_service_variance_current) }}</th>
											<th class="text-center font-weight-bold">
												@if($total_sale_service_budget > 0)
												{{ round(($total_sale_service_variance_current / $total_sale_service_budget) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_sale_service_actual_last) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['actual']['last'] > 0)
												@php $total['income_actual_percent_last'] += round(($total_sale_service_actual_last / $profit_loss['summary']['total']['income']['actual']['last']) * 100); @endphp
												{{ round(($total_sale_service_actual_last / $profit_loss['summary']['total']['income']['actual']['last']) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_sale_service_variance_last) }}</th>
											<th class="text-center font-weight-bold">
												@if($total_sale_service_actual_last > 0)
												{{ round(($total_sale_service_variance_last / $total_sale_service_actual_last) * 100) }}%
												@else
												0%
												@endif
											</th>
										</tr>
										<tr class="bg-info-300 text-uppercase">
											<th class="text-left font-weight-bold">Total Income</th>
											<th class="text-right font-weight-bold">{{ number_format($profit_loss['summary']['total']['income']['budget']) }}</th>
											<th class="text-center font-weight-bold">{{ $total['income_budget_percent'] }}%</th>
											<th class="text-right font-weight-bold">{{ number_format($profit_loss['summary']['total']['income']['actual']['current']) }}</th>
											<th class="text-center font-weight-bold">{{ $total['income_actual_percent_current'] }}%</th>
											<th class="text-right font-weight-bold">{{ number_format($profit_loss['summary']['total']['income']['variance']['current']) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['budget'] > 0)
												{{ round(($profit_loss['summary']['total']['income']['variance']['current'] / $profit_loss['summary']['total']['income']['budget']) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($profit_loss['summary']['total']['income']['actual']['last']) }}</th>
											<th class="text-center font-weight-bold">{{ $total['income_actual_percent_last'] }}%</th>
											<th class="text-right font-weight-bold">{{ number_format($profit_loss['summary']['total']['income']['variance']['last']) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['actual']['last'] > 0)
												{{ round(($profit_loss['summary']['total']['income']['variance']['last'] / $profit_loss['summary']['total']['income']['actual']['last']) * 100) }}%
												@else
												0%
												@endif
											</th>
										</tr>
										<tr class="font-weight-bold">
											<th colspan="12">COGS</th>
										</tr>
										@php
											$total_cogs_actual_current   = 0;
											$total_cogs_budget           = 0;
											$total_cogs_variance_current = 0;
											$total_cogs_actual_last      = 0;
											$total_cogs_variance_last    = 0;
										@endphp
										@foreach($profit_loss['summary']['cogs'] as $c)
											@php
												$total_cogs_actual_current   += $c['actual']['current'];
												$total_cogs_budget           += $c['budget'];
												$total_cogs_variance_current += $c['variance']['nominal']['current'];
												$total_cogs_actual_last      += $c['actual']['last'];
												$total_cogs_variance_last    += $c['variance']['nominal']['last'];
											@endphp
											<tr>
												<td class="text-left"><span class="ml-2">{{ $c['name'] }}</span></td>
												<td class="text-right">{{ number_format($c['budget']) }}</td>
												<td class="text-center">
												@if($profit_loss['summary']['total']['income']['budget'] > 0)
													{{ round(($c['budget'] / $profit_loss['summary']['total']['income']['budget']) * 100) }}%
												@else
													0%
												@endif
												</td>
												<td class="text-right">{{ number_format($c['actual']['current']) }}</td>
												<td class="text-center">
												@if($profit_loss['summary']['total']['income']['actual']['current'] > 0)
													{{ round(($c['actual']['current'] / $profit_loss['summary']['total']['income']['actual']['current']) * 100) }}%
												@else
													0%
												@endif
												</td>
												<td class="text-right">{{ number_format($c['variance']['nominal']['current']) }}</td>
												<td class="text-center">{{ number_format($c['variance']['percent']['current']) }}%</td>
												<td class="text-right">{{ number_format($c['actual']['last']) }}</td>
												<td class="text-center">
												@if($profit_loss['summary']['total']['income']['actual']['last'] > 0)
													{{ round(($c['actual']['last'] / $profit_loss['summary']['total']['income']['actual']['last']) * 100) }}%
												@else
													0%
												@endif
												</td>
												<td class="text-right">{{ number_format($c['variance']['nominal']['last']) }}</td>
												<td class="text-center">{{ number_format($c['variance']['percent']['last']) }}%</td>
											</tr>
										@endforeach
										<tr class="bg-info-300 text-uppercase">
											<th class="text-left font-weight-bold">Total COGS</th>
											<th class="text-right font-weight-bold">{{ number_format($total_cogs_budget) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['budget'] > 0)
												{{ round(($total_cogs_budget / $profit_loss['summary']['total']['income']['budget']) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_cogs_actual_current) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['actual']['current'] > 0)
												{{ round(($total_cogs_actual_current / $profit_loss['summary']['total']['income']['actual']['current']) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_cogs_variance_current) }}</th>
											<th class="text-center font-weight-bold">
												@if($total_cogs_budget > 0)
												{{ round(($total_cogs_variance_current / $total_cogs_budget) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_cogs_actual_last) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['actual']['last'] > 0)
												{{ round(($total_cogs_actual_last / $profit_loss['summary']['total']['income']['actual']['last']) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_cogs_variance_last) }}</th>
											<th class="text-center font-weight-bold">
												@if($total_cogs_actual_last > 0)
												{{ round(($total_cogs_variance_last / $total_cogs_actual_last) * 100) }}%
												@else
												0%
												@endif
											</th>
										</tr>
										<tr class="font-weight-bold">
											<th colspan="12">Fixed Cost</th>
										</tr>
										<tr class="font-weight-bold">
											<th colspan="12"><span class="ml-2">Salary & Wages</span></th>
										</tr>
										@php
											$total_salary_wages_actual_current   = 0;
											$total_salary_wages_budget           = 0;
											$total_salary_wages_variance_current = 0;
											$total_salary_wages_actual_last      = 0;
											$total_salary_wages_variance_last    = 0;
										@endphp
										@foreach($profit_loss['summary']['salary_wages'] as $sw)
											@php
												$total_salary_wages_actual_current   += $sw['actual']['nominal']['current'];
												$total_salary_wages_budget           += $sw['budget']['nominal'];
												$total_salary_wages_variance_current += $sw['variance']['nominal']['current'];
												$total_salary_wages_actual_last      += $sw['actual']['nominal']['last'];
												$total_salary_wages_variance_last    += $sw['variance']['nominal']['last'];
											@endphp
											<tr>
												<td class="text-left"><span class="ml-4">{{ $sw['name'] }}</span></td>
												<td class="text-right">{{ number_format($sw['budget']['nominal']) }}</td>
												<td class="text-center">{{ $sw['budget']['percent'] }}%</td>
												<td class="text-right">{{ number_format($sw['actual']['nominal']['current']) }}</td>
												<td class="text-center">{{ $sw['actual']['percent']['current'] }}%</td>
												<td class="text-right">{{ number_format($sw['variance']['nominal']['current']) }}</td>
												<td class="text-center">{{ number_format($sw['variance']['percent']['current']) }}%</td>
												<td class="text-right">{{ number_format($sw['actual']['nominal']['last']) }}</td>
												<td class="text-center">{{ $sw['actual']['percent']['last'] }}%</td>
												<td class="text-right">{{ number_format($sw['variance']['nominal']['last']) }}</td>
												<td class="text-center">{{ number_format($sw['variance']['percent']['last']) }}%</td>
											</tr>
										@endforeach
										<tr class="table-secondary font-italic">
											<th class="text-right font-weight-bold">Total Salary & Wages</th>
											<th class="text-right font-weight-bold">{{ number_format($total_salary_wages_budget) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['budget'] > 0)
												@php $total['fee_budget_percent'] += round(($total_salary_wages_budget / $profit_loss['summary']['total']['income']['budget']) * 100); @endphp
												{{ round(($total_salary_wages_budget / $profit_loss['summary']['total']['income']['budget']) * 100) }}%
												@else
												@php $total['fee_budget_percent'] += 0; @endphp
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_salary_wages_actual_current) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['actual']['current'] > 0)
												@php $total['fee_actual_percent_current'] += round(($total_salary_wages_actual_current / $profit_loss['summary']['total']['income']['actual']['current']) * 100); @endphp
												{{ round(($total_salary_wages_actual_current / $profit_loss['summary']['total']['income']['actual']['current']) * 100) }}%
												@else
												@php $total['fee_actual_percent_current'] += 0; @endphp
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_salary_wages_variance_current) }}</th>
											<th class="text-center font-weight-bold">
												@if($total_salary_wages_budget > 0)
												{{ round(($total_salary_wages_variance_current / $total_salary_wages_budget) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_salary_wages_actual_last) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['actual']['last'] > 0)
												@php $total['fee_actual_percent_last'] += round(($total_salary_wages_actual_last / $profit_loss['summary']['total']['income']['actual']['last']) * 100); @endphp
												{{ round(($total_salary_wages_actual_last / $profit_loss['summary']['total']['income']['actual']['last']) * 100) }}%
												@else
												@php $total['fee_actual_percent_last'] += 0; @endphp
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_salary_wages_variance_last) }}</th>
											<th class="text-center font-weight-bold">
												@if($total_salary_wages_actual_last > 0)
												{{ round(($total_salary_wages_variance_last / $total_salary_wages_actual_last) * 100) }}%
												@else
												0%
												@endif
											</th>
										</tr>
                                        <tr class="font-weight-bold">
                                            <th colspan="12">Variable Cost</th>
                                        </tr>
										<tr class="font-weight-bold">
											<th colspan="12"><span class="ml-2">Fee Sales & Marketing</span></th>
										</tr>
										@php
											$total_fee_marketing_actual_current   = 0;
											$total_fee_marketing_budget           = 0;
											$total_fee_marketing_variance_current = 0;
											$total_fee_marketing_actual_last      = 0;
											$total_fee_marketing_variance_last    = 0;
										@endphp
										@foreach($profit_loss['summary']['fee_marketing'] as $fm)
											@php
												$total_fee_marketing_actual_current   += $fm['actual']['nominal']['current'];
												$total_fee_marketing_budget           += $fm['budget']['nominal'];
												$total_fee_marketing_variance_current += $fm['variance']['nominal']['current'];
												$total_fee_marketing_actual_last      += $fm['actual']['nominal']['last'];
												$total_fee_marketing_variance_last    += $fm['variance']['nominal']['last'];
											@endphp
											<tr>
												<td class="text-left"><span class="ml-4">{{ $fm['name'] }}</span></td>
												<td class="text-right">{{ number_format($fm['budget']['nominal']) }}</td>
												<td class="text-center">{{ $fm['budget']['percent'] }}%</td>
												<td class="text-right">{{ number_format($fm['actual']['nominal']['current']) }}</td>
												<td class="text-center">{{ $fm['actual']['percent']['current'] }}%</td>
												<td class="text-right">{{ number_format($fm['variance']['nominal']['current']) }}</td>
												<td class="text-center">{{ number_format($fm['variance']['percent']['current']) }}%</td>
												<td class="text-right">{{ number_format($fm['actual']['nominal']['last']) }}</td>
												<td class="text-center">{{ $fm['actual']['percent']['last'] }}%</td>
												<td class="text-right">{{ number_format($fm['variance']['nominal']['last']) }}</td>
												<td class="text-center">{{ number_format($fm['variance']['percent']['last']) }}%</td>
											</tr>
										@endforeach
										<tr class="table-secondary font-italic">
											<th class="text-right font-weight-bold">Total Fee Sales & Marketing</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_marketing_budget) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['budget'] > 0)
												@php $total['fee_budget_percent'] += round(($total_fee_marketing_budget / $profit_loss['summary']['total']['income']['budget']) * 100); @endphp
												{{ round(($total_fee_marketing_budget / $profit_loss['summary']['total']['income']['budget']) * 100) }}%
												@else
												@php $total['fee_budget_percent'] += 0; @endphp
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_marketing_actual_current) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['actual']['current'] > 0)
												@php $total['fee_actual_percent_current'] += round(($total_fee_marketing_actual_current / $profit_loss['summary']['total']['income']['actual']['current']) * 100); @endphp
												{{ round(($total_fee_marketing_actual_current / $profit_loss['summary']['total']['income']['actual']['current']) * 100) }}%
												@else
												@php $total['fee_actual_percent_current'] += 0; @endphp
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_marketing_variance_current) }}</th>
											<th class="text-center font-weight-bold">
												@if($total_fee_marketing_budget > 0)
												{{ round(($total_fee_marketing_variance_current / $total_fee_marketing_budget) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_marketing_actual_last) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['actual']['last'] > 0)
												@php $total['fee_actual_percent_last'] += round(($total_fee_marketing_actual_last / $profit_loss['summary']['total']['income']['actual']['last']) * 100); @endphp
												{{ round(($total_fee_marketing_actual_last / $profit_loss['summary']['total']['income']['actual']['last']) * 100) }}%
												@else
												@php $total['fee_actual_percent_last'] += 0; @endphp
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_marketing_variance_last) }}</th>
											<th class="text-center font-weight-bold">
												@if($total_fee_marketing_actual_last > 0)
												{{ round(($total_fee_marketing_variance_last / $total_fee_marketing_actual_last) * 100) }}%
												@else
												0%
												@endif
											</th>
										</tr>
										<tr class="font-weight-bold">
											<th colspan="12"><span class="ml-2">Other Expense</span></th>
										</tr>
										@php
											$total_fee_other_actual_current   = 0;
											$total_fee_other_budget           = 0;
											$total_fee_other_variance_current = 0;
											$total_fee_other_actual_last      = 0;
											$total_fee_other_variance_last    = 0;
										@endphp
										@foreach($profit_loss['summary']['fee_other'] as $fo)
											@php
												$total_fee_other_actual_current   += $fo['actual']['nominal']['current'];
												$total_fee_other_budget           += $fo['budget']['nominal'];
												$total_fee_other_variance_current += $fo['variance']['nominal']['current'];
												$total_fee_other_actual_last      += $fo['actual']['nominal']['last'];
												$total_fee_other_variance_last    += $fo['variance']['nominal']['last'];
											@endphp
											<tr>
												<td class="text-left"><span class="ml-4">{{ $fo['name'] }}</span></td>
												<td class="text-right">{{ number_format($fo['budget']['nominal']) }}</td>
												<td class="text-center">{{ $fo['budget']['percent'] }}%</td>
												<td class="text-right">{{ number_format($fo['actual']['nominal']['current']) }}</td>
												<td class="text-center">{{ $fo['actual']['percent']['current'] }}%</td>
												<td class="text-right">{{ number_format($fo['variance']['nominal']['current']) }}</td>
												<td class="text-center">{{ number_format($fo['variance']['percent']['current']) }}%</td>
												<td class="text-right">{{ number_format($fo['actual']['nominal']['last']) }}</td>
												<td class="text-center">{{ $fo['actual']['percent']['last'] }}%</td>
												<td class="text-right">{{ number_format($fo['variance']['nominal']['last']) }}</td>
												<td class="text-center">{{ number_format($fo['variance']['percent']['last']) }}%</td>
											</tr>
										@endforeach
										<tr class="table-secondary font-italic">
											<th class="text-right font-weight-bold">Total Other Expenses</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_other_budget) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['budget'] > 0)
												@php $total['fee_budget_percent'] += round(($total_fee_other_budget / $profit_loss['summary']['total']['income']['budget']) * 100); @endphp
												{{ round(($total_fee_other_budget / $profit_loss['summary']['total']['income']['budget']) * 100) }}%
												@else
												@php $total['fee_budget_percent'] += 0; @endphp
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_other_actual_current) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['actual']['current'] > 0)
												@php $total['fee_actual_percent_current'] += round(($total_fee_other_actual_current / $profit_loss['summary']['total']['income']['actual']['current']) * 100); @endphp
												{{ round(($total_fee_other_actual_current / $profit_loss['summary']['total']['income']['actual']['current']) * 100) }}%
												@else
												@php $total['fee_actual_percent_current'] += 0; @endphp
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_other_variance_current) }}</th>
											<th class="text-center font-weight-bold">
												@if($total_fee_other_budget > 0)
												{{ round(($total_fee_other_variance_current / $total_fee_other_budget) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_other_actual_last) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['actual']['last'] > 0)
												@php $total['fee_actual_percent_last'] += round(($total_fee_other_actual_last / $profit_loss['summary']['total']['income']['actual']['last']) * 100); @endphp
												{{ round(($total_fee_other_actual_last / $profit_loss['summary']['total']['income']['actual']['last']) * 100) }}%
												@else
												@php $total['fee_actual_percent_last'] += 0; @endphp
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_other_variance_last) }}</th>
											<th class="text-center font-weight-bold">
												@if($total_fee_other_actual_last > 0)
												{{ round(($total_fee_other_variance_last / $total_fee_other_actual_last) * 100) }}%
												@else
												0%
												@endif
											</th>
										</tr>
										<tr class="font-weight-bold">
											<th colspan="12"><span class="ml-2">Fee Maintenance</span></th>
										</tr>
										@php
											$total_fee_maintenance_actual_current   = 0;
											$total_fee_maintenance_budget           = 0;
											$total_fee_maintenance_variance_current = 0;
											$total_fee_maintenance_actual_last      = 0;
											$total_fee_maintenance_variance_last    = 0;
										@endphp
										@foreach($profit_loss['summary']['fee_maintenance'] as $fm)
											@php
												$total_fee_maintenance_actual_current   += $fm['actual']['nominal']['current'];
												$total_fee_maintenance_budget           += $fm['budget']['nominal'];
												$total_fee_maintenance_variance_current += $fm['variance']['nominal']['current'];
												$total_fee_maintenance_actual_last      += $fm['actual']['nominal']['last'];
												$total_fee_maintenance_variance_last    += $fm['variance']['nominal']['last'];
											@endphp
											<tr>
												<td class="text-left"><span class="ml-4">{{ $fm['name'] }}</span></td>
												<td class="text-right">{{ number_format($fm['budget']['nominal']) }}</td>
												<td class="text-center">{{ $fm['budget']['percent'] }}%</td>
												<td class="text-right">{{ number_format($fm['actual']['nominal']['current']) }}</td>
												<td class="text-center">{{ $fm['actual']['percent']['current'] }}%</td>
												<td class="text-right">{{ number_format($fm['variance']['nominal']['current']) }}</td>
												<td class="text-center">{{ number_format($fm['variance']['percent']['current']) }}%</td>
												<td class="text-right">{{ number_format($fm['actual']['nominal']['last']) }}</td>
												<td class="text-center">{{ $fm['actual']['percent']['last'] }}%</td>
												<td class="text-right">{{ number_format($fm['variance']['nominal']['last']) }}</td>
												<td class="text-center">{{ number_format($fm['variance']['percent']['last']) }}%</td>
											</tr>
										@endforeach
										<tr class="table-secondary font-italic">
											<th class="text-right font-weight-bold">Total Fee Maintenance</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_maintenance_budget) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['budget'] > 0)
												@php $total['fee_budget_percent'] += round(($total_fee_maintenance_budget / $profit_loss['summary']['total']['income']['budget']) * 100); @endphp
												{{ round(($total_fee_maintenance_budget / $profit_loss['summary']['total']['income']['budget']) * 100) }}%
												@else
												@php $total['fee_budget_percent'] += 0; @endphp
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_maintenance_actual_current) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['actual']['current'] > 0)
												@php $total['fee_actual_percent_current'] += round(($total_fee_maintenance_actual_current / $profit_loss['summary']['total']['income']['actual']['current']) * 100); @endphp
												{{ round(($total_fee_maintenance_actual_current / $profit_loss['summary']['total']['income']['actual']['current']) * 100) }}%
												@else
												@php $total['fee_actual_percent_current'] += 0; @endphp
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_maintenance_variance_current) }}</th>
											<th class="text-center font-weight-bold">
												@if($total_fee_maintenance_budget > 0)
												{{ round(($total_fee_maintenance_variance_current / $total_fee_maintenance_budget) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_maintenance_actual_last) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['actual']['last'] > 0)
												@php $total['fee_actual_percent_last'] += round(($total_fee_maintenance_actual_last / $profit_loss['summary']['total']['income']['actual']['last']) * 100); @endphp
												{{ round(($total_fee_maintenance_actual_last / $profit_loss['summary']['total']['income']['actual']['last']) * 100) }}%
												@else
												@php $total['fee_actual_percent_last'] += 0; @endphp
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_maintenance_variance_last) }}</th>
											<th class="text-center font-weight-bold">
												@if($total_fee_maintenance_actual_last > 0)
												{{ round(($total_fee_maintenance_variance_last / $total_fee_maintenance_actual_last) * 100) }}%
												@else
												0%
												@endif
											</th>
										</tr>
										<tr class="bg-info-300 text-uppercase">
											<th class="text-left font-weight-bold">Total Variable Cost</th>
											<th class="text-right font-weight-bold">{{ number_format($profit_loss['summary']['total']['fee']['budget']) }}</th>
											<th class="text-center font-weight-bold">{{ $total['fee_budget_percent'] }}%</th>
											<th class="text-right font-weight-bold">{{ number_format($profit_loss['summary']['total']['fee']['actual']['current']) }}</th>
											<th class="text-center font-weight-bold">{{ $total['fee_actual_percent_current'] }}%</th>
											<th class="text-right font-weight-bold">{{ number_format($profit_loss['summary']['total']['fee']['variance']['current']) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['fee']['budget'] > 0)
												{{ round(($profit_loss['summary']['total']['fee']['variance']['current'] / $profit_loss['summary']['total']['fee']['budget']) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($profit_loss['summary']['total']['fee']['actual']['last']) }}</th>
											<th class="text-center font-weight-bold">{{ $total['fee_actual_percent_last'] }}%</th>
											<th class="text-right font-weight-bold">{{ number_format($profit_loss['summary']['total']['fee']['variance']['last']) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['fee']['actual']['last'] > 0)
												{{ round(($profit_loss['summary']['total']['fee']['variance']['last'] / $profit_loss['summary']['total']['fee']['actual']['last']) * 100) }}%
												@else
												0%
												@endif
											</th>
										</tr>
										<tr><td colspan="12"></td></tr>
										<tr class="bg-success-300 text-uppercase">
											<th class="text-left font-weight-bold">Gross Profit (Loss)</th>
											<th class="text-right font-weight-bold">{{ number_format($profit_loss['summary']['grandtotal']['gross']['budget']['nominal']) }}</th>
											<th class="text-center font-weight-bold">{{ $profit_loss['summary']['grandtotal']['gross']['budget']['percent'] }}%</th>
											<th class="text-right font-weight-bold">{{ number_format($profit_loss['summary']['grandtotal']['gross']['actual']['current']['nominal']) }}</th>
											<th class="text-center font-weight-bold">{{ $profit_loss['summary']['grandtotal']['gross']['actual']['current']['percent'] }}%</th>
											<th class="text-right font-weight-bold">{{ number_format($profit_loss['summary']['grandtotal']['gross']['variance']['current']['nominal']) }}</th>
											<th class="text-center font-weight-bold">{{ $profit_loss['summary']['grandtotal']['gross']['variance']['current']['percent'] }}%</th>
											<th class="text-right font-weight-bold">{{ number_format($profit_loss['summary']['grandtotal']['gross']['actual']['last']['nominal']) }}</th>
											<th class="text-center font-weight-bold">{{ $profit_loss['summary']['grandtotal']['gross']['actual']['last']['percent'] }}%</th>
											<th class="text-right font-weight-bold">{{ number_format($profit_loss['summary']['grandtotal']['gross']['variance']['last']['nominal']) }}</th>
											<th class="text-center font-weight-bold">{{ $profit_loss['summary']['grandtotal']['gross']['variance']['last']['percent'] }}%</th>
										</tr>
										<tr><td colspan="12"></td></tr>
										<tr class="font-weight-bold">
											<th colspan="12">Depreciation & Amor</th>
										</tr>
										@php
											$total_fee_shrinkage_actual_current   = 0;
											$total_fee_shrinkage_budget           = 0;
											$total_fee_shrinkage_variance_current = 0;
											$total_fee_shrinkage_actual_last      = 0;
											$total_fee_shrinkage_variance_last    = 0;
										@endphp
										@foreach($profit_loss['summary']['fee_shrinkage'] as $fs)
											@php
												$total_fee_shrinkage_actual_current   += $fs['actual']['nominal']['current'];
												$total_fee_shrinkage_budget           += $fs['budget']['nominal'];
												$total_fee_shrinkage_variance_current += $fs['variance']['nominal']['current'];
												$total_fee_shrinkage_actual_last      += $fs['actual']['nominal']['last'];
												$total_fee_shrinkage_variance_last    += $fs['variance']['nominal']['last'];
											@endphp
											<tr>
												<td class="text-left"><span class="ml-2">{{ $fs['name'] }}</span></td>
												<td class="text-right">{{ number_format($fs['budget']['nominal']) }}</td>
												<td class="text-center">{{ $fs['budget']['percent'] }}%</td>
												<td class="text-right">{{ number_format($fs['actual']['nominal']['current']) }}</td>
												<td class="text-center">{{ $fs['actual']['percent']['current'] }}%</td>
												<td class="text-right">{{ number_format($fs['variance']['nominal']['current']) }}</td>
												<td class="text-center">{{ number_format($fs['variance']['percent']['current']) }}%</td>
												<td class="text-right">{{ number_format($fs['actual']['nominal']['last']) }}</td>
												<td class="text-center">{{ $fs['actual']['percent']['last'] }}%</td>
												<td class="text-right">{{ number_format($fs['variance']['nominal']['last']) }}</td>
												<td class="text-center">{{ number_format($fs['variance']['percent']['last']) }}%</td>
											</tr>
										@endforeach
										<tr class="table-secondary font-italic">
											<th class="text-right font-weight-bold">Total Depreciation & Amor</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_shrinkage_budget) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['budget'] > 0)
												{{ round(($total_fee_shrinkage_budget / $profit_loss['summary']['total']['income']['budget']) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_shrinkage_actual_current) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['actual']['current'] > 0)
												{{ round(($total_fee_shrinkage_actual_current / $profit_loss['summary']['total']['income']['actual']['current']) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_shrinkage_variance_current) }}</th>
											<th class="text-center font-weight-bold">
												@if($total_fee_shrinkage_budget > 0)
												{{ round(($total_fee_shrinkage_variance_current / $total_fee_shrinkage_budget) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_shrinkage_actual_last) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['actual']['last'] > 0)
												{{ round(($total_fee_shrinkage_actual_last / $profit_loss['summary']['total']['income']['actual']['last']) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_shrinkage_variance_last) }}</th>
											<th class="text-center font-weight-bold">
												@if($total_fee_shrinkage_actual_last > 0)
												{{ round(($total_fee_shrinkage_variance_last / $total_fee_shrinkage_actual_last) * 100) }}%
												@else
												0%
												@endif
											</th>
										</tr>
										<tr class="font-weight-bold">
											<th colspan="12">Expenses & Income Outside the Business</th>
										</tr>
										@php
											$total_fee_income_outside_actual_current   = 0;
											$total_fee_income_outside_budget           = 0;
											$total_fee_income_outside_variance_current = 0;
											$total_fee_income_outside_actual_last      = 0;
											$total_fee_income_outside_variance_last    = 0;
										@endphp
										@foreach($profit_loss['summary']['fee_income_outside'] as $key => $fio)
											@if($key == 0)
												@php
												$total_fee_income_outside_actual_current   += $fio['actual']['nominal']['current'];
												$total_fee_income_outside_budget           += $fio['budget']['nominal'];
												$total_fee_income_outside_variance_current += $fio['variance']['nominal']['current'];
												$total_fee_income_outside_actual_last      += $fio['actual']['nominal']['last'];
												$total_fee_income_outside_variance_last    += $fio['variance']['nominal']['last'];
												@endphp
											@else
												@php
												$total_fee_income_outside_actual_current   -= $fio['actual']['nominal']['current'];
												$total_fee_income_outside_budget           -= $fio['budget']['nominal'];
												$total_fee_income_outside_variance_current -= $fio['variance']['nominal']['current'];
												$total_fee_income_outside_actual_last      -= $fio['actual']['nominal']['last'];
												$total_fee_income_outside_variance_last    -= $fio['variance']['nominal']['last'];
												@endphp
											@endif
											<tr>
												<td class="text-left"><span class="ml-2">{{ $fio['name'] }}</span></td>
												<td class="text-right">{{ number_format($fio['budget']['nominal']) }}</td>
												<td class="text-center">{{ $fio['budget']['percent'] }}%</td>
												<td class="text-right">{{ number_format($fio['actual']['nominal']['current']) }}</td>
												<td class="text-center">{{ $fio['actual']['percent']['current'] }}%</td>
												<td class="text-right">{{ number_format($fio['variance']['nominal']['current']) }}</td>
												<td class="text-center">{{ number_format($fio['variance']['percent']['current']) }}%</td>
												<td class="text-right">{{ number_format($fio['actual']['nominal']['last']) }}</td>
												<td class="text-center">{{ $fio['actual']['percent']['last'] }}%</td>
												<td class="text-right">{{ number_format($fio['variance']['nominal']['last']) }}</td>
												<td class="text-center">{{ number_format($fio['variance']['percent']['last']) }}%</td>
											</tr>
										@endforeach
										<tr class="table-secondary font-italic">
											<th class="text-right font-weight-bold">Total Variable Cost & Income Outside the Business</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_income_outside_budget) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['budget'] > 0)
												{{ round(($total_fee_income_outside_budget / $profit_loss['summary']['total']['income']['budget']) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_income_outside_actual_current) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['actual']['current'] > 0)
												{{ round(($total_fee_income_outside_actual_current / $profit_loss['summary']['total']['income']['actual']['current']) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_income_outside_variance_current) }}</th>
											<th class="text-center font-weight-bold">
												@if($total_fee_income_outside_budget > 0)
												{{ round(($total_fee_income_outside_variance_current / $total_fee_income_outside_budget) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_income_outside_actual_last) }}</th>
											<th class="text-center font-weight-bold">
												@if($profit_loss['summary']['total']['income']['actual']['last'] > 0)
												{{ round(($total_fee_income_outside_actual_last / $profit_loss['summary']['total']['income']['actual']['last']) * 100) }}%
												@else
												0%
												@endif
											</th>
											<th class="text-right font-weight-bold">{{ number_format($total_fee_income_outside_variance_last) }}</th>
											<th class="text-center font-weight-bold">
												@if($total_fee_income_outside_actual_last > 0)
												{{ round(($total_fee_income_outside_variance_last / $total_fee_income_outside_actual_last) * 100) }}%
												@else
												0%
												@endif
											</th>
										</tr>
										<tr><td colspan="12"></td></tr>
										<tr class="bg-success-300 text-uppercase">
											<th class="text-left font-weight-bold">Nett Profit (Loss)</th>
											<th class="text-right font-weight-bold">{{ number_format($profit_loss['summary']['grandtotal']['nett']['budget']['nominal']) }}</th>
											<th class="text-center font-weight-bold">{{ $profit_loss['summary']['grandtotal']['nett']['budget']['percent'] }}%</th>
											<th class="text-right font-weight-bold">{{ number_format($profit_loss['summary']['grandtotal']['nett']['actual']['current']['nominal']) }}</th>
											<th class="text-center font-weight-bold">{{ $profit_loss['summary']['grandtotal']['nett']['actual']['current']['percent'] }}%</th>
											<th class="text-right font-weight-bold">{{ number_format($profit_loss['summary']['grandtotal']['nett']['variance']['current']['nominal']) }}</th>
											<th class="text-center font-weight-bold">{{ $profit_loss['summary']['grandtotal']['nett']['variance']['current']['percent'] }}%</th>
											<th class="text-right font-weight-bold">{{ number_format($profit_loss['summary']['grandtotal']['nett']['actual']['last']['nominal']) }}</th>
											<th class="text-center font-weight-bold">{{ $profit_loss['summary']['grandtotal']['nett']['actual']['last']['percent'] }}%</th>
											<th class="text-right font-weight-bold">{{ number_format($profit_loss['summary']['grandtotal']['nett']['variance']['last']['nominal']) }}</th>
											<th class="text-center font-weight-bold">{{ $profit_loss['summary']['grandtotal']['nett']['variance']['last']['percent'] }}%</th>
										</tr>
									</tbody>
								</table>
							</div>
						</p>
					</div>
					<div class="tab-pane fade" id="solid-bordered-justified-tab2">
						@php
							$total['income_actual_percent_current'] = 0;
							$total['income_actual_percent_last']    = 0;
							$total['income_budget_percent']         = 0;
							$total['fee_actual_percent_current']    = 0;
							$total['fee_actual_percent_last']       = 0;
							$total['fee_budget_percent']            = 0;
						@endphp
						<p class="mt-3">
							<div class="table-responsive">
								<table class="table table-sm table-bordered">
								<thead>
									<tr class="text-center">
										<th rowspan="2" class="bg-grey">Description</th>
										<th colspan="6" class="bg-primary">Current Month</th>
										<th colspan="4" class="bg-primary">Last Month</th>
									</tr>
									<tr class="text-center">
										<th class="bg-grey">Budget</th>
										<th class="bg-grey">%</th>
										<th class="bg-grey">Actual</th>
										<th class="bg-grey">%</th>
										<th class="bg-grey">Variance</th>
										<th class="bg-grey">%</th>
										<th class="bg-grey">Actual</th>
										<th class="bg-grey">%</th>
										<th class="bg-grey">Variance</th>
										<th class="bg-grey">%</th>
									</tr>
								</thead>
								<tbody>
									<tr class="font-weight-bold">
										<th colspan="12">INCOME</th>
									</tr>
									<tr class="font-weight-bold">
										<th colspan="12"><span class="ml-2">Sales</span></th>
									</tr>
									@php
										$total_sale_actual_current   = 0;
										$total_sale_budget           = 0;
										$total_sale_variance_current = 0;
										$total_sale_actual_last      = 0;
										$total_sale_variance_last    = 0;
									@endphp
									@foreach($profit_loss['surabaya']['sale'] as $s)
										@php
											$total_sale_actual_current   += $s['actual']['current'];
											$total_sale_budget           += $s['budget'];
											$total_sale_variance_current += $s['variance']['nominal']['current'];
											$total_sale_actual_last      += $s['actual']['last'];
											$total_sale_variance_last    += $s['variance']['nominal']['last'];
										@endphp
										<tr>
											<td class="text-left"><span class="ml-4">{{ $s['name'] }}</span></td>
											<td class="text-right">{{ number_format($s['budget']) }}</td>
											<td class="text-center">
											@if($profit_loss['surabaya']['total']['income']['budget'] > 0)
												{{ round(($s['budget'] / $profit_loss['surabaya']['total']['income']['budget']) * 100) }}%
											@else
												0%
											@endif
											</td>
											<td class="text-right">{{ number_format($s['actual']['current']) }}</td>
											<td class="text-center">
											@if($profit_loss['surabaya']['total']['income']['actual']['current'] > 0)
												{{ round(($s['actual']['current'] / $profit_loss['surabaya']['total']['income']['actual']['current']) * 100) }}%
											@else
												0%
											@endif
											</td>
											<td class="text-right">{{ number_format($s['variance']['nominal']['current']) }}</td>
											<td class="text-center">{{ number_format($s['variance']['percent']['current']) }}%</td>
											<td class="text-right">{{ number_format($s['actual']['last']) }}</td>
											<td class="text-center">
											@if($profit_loss['surabaya']['total']['income']['actual']['last'] > 0)
												{{ round(($s['actual']['last'] / $profit_loss['surabaya']['total']['income']['actual']['last']) * 100) }}%
											@else
												0%
											@endif
											</td>
											<td class="text-right">{{ number_format($s['variance']['nominal']['last']) }}</td>
											<td class="text-center">{{ number_format($s['variance']['percent']['last']) }}%</td>
										</tr>
									@endforeach
									<tr class="table-secondary font-italic">
										<th class="text-right font-weight-bold">Total Sales</th>
										<th class="text-right font-weight-bold">{{ number_format($total_sale_budget) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['income']['budget'] > 0)
											@php $total['income_budget_percent'] += round(($total_sale_budget / $profit_loss['surabaya']['total']['income']['budget']) * 100); @endphp
											{{ round(($total_sale_budget / $profit_loss['surabaya']['total']['income']['budget']) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_sale_actual_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['income']['actual']['current'] > 0)
											@php $total['income_actual_percent_current'] += round(($total_sale_actual_current / $profit_loss['surabaya']['total']['income']['actual']['current']) * 100); @endphp
											{{ round(($total_sale_actual_current / $profit_loss['surabaya']['total']['income']['actual']['current']) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_sale_variance_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_sale_budget > 0)
											{{ round(($total_sale_variance_current / $total_sale_budget) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_sale_actual_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['income']['actual']['last'] > 0)
											@php $total['income_actual_percent_last'] += round(($total_sale_actual_last / $profit_loss['surabaya']['total']['income']['actual']['last']) * 100); @endphp
											{{ round(($total_sale_actual_last / $profit_loss['surabaya']['total']['income']['actual']['last']) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_sale_variance_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_sale_actual_last > 0)
											{{ round(($total_sale_variance_last / $total_sale_actual_last) * 100) }}%
											@else
											0%
											@endif
										</th>
									</tr>
									<tr class="font-weight-bold">
										<th colspan="12"><span class="ml-2">Sales Service</span></th>
									</tr>
									@php
										$total_sale_service_actual_current   = 0;
										$total_sale_service_budget           = 0;
										$total_sale_service_variance_current = 0;
										$total_sale_service_actual_last      = 0;
										$total_sale_service_variance_last    = 0;
									@endphp
									@foreach($profit_loss['surabaya']['sale_service'] as $ss)
										@php
											$total_sale_service_actual_current   += $ss['actual']['current'];
											$total_sale_service_budget           += $ss['budget'];
											$total_sale_service_variance_current += $ss['variance']['nominal']['current'];
											$total_sale_service_actual_last      += $ss['actual']['last'];
											$total_sale_service_variance_last    += $ss['variance']['nominal']['last'];
										@endphp
										<tr>
											<td class="text-left"><span class="ml-4">{{ $ss['name'] }}</span></td>
											<td class="text-right">{{ number_format($ss['budget']) }}</td>
											<td class="text-center">
											@if($profit_loss['surabaya']['total']['income']['budget'] > 0)
												{{ round(($ss['budget'] / $profit_loss['surabaya']['total']['income']['budget']) * 100) }}%
											@else
												0%
											@endif
											</td>
											<td class="text-right">{{ number_format($ss['actual']['current']) }}</td>
											<td class="text-center">
											@if($profit_loss['surabaya']['total']['income']['actual']['current'] > 0)
												{{ round(($ss['actual']['current'] / $profit_loss['surabaya']['total']['income']['actual']['current']) * 100) }}%
											@else
												0%
											@endif
											</td>
											<td class="text-right">{{ number_format($ss['variance']['nominal']['current']) }}</td>
											<td class="text-center">{{ number_format($ss['variance']['percent']['current']) }}%</td>
											<td class="text-right">{{ number_format($ss['actual']['last']) }}</td>
											<td class="text-center">
											@if($profit_loss['surabaya']['total']['income']['actual']['last'] > 0)
												{{ round(($ss['actual']['last'] / $profit_loss['surabaya']['total']['income']['actual']['last']) * 100) }}%
											@else
												0%
											@endif
											</td>
											<td class="text-right">{{ number_format($ss['variance']['nominal']['last']) }}</td>
											<td class="text-center">{{ number_format($ss['variance']['percent']['last']) }}%</td>
										</tr>
									@endforeach
									<tr class="table-secondary font-italic">
										<th class="text-right font-weight-bold">Total Sales Service</th>
										<th class="text-right font-weight-bold">{{ number_format($total_sale_service_budget) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_sale_service_budget > 0 | $profit_loss['surabaya']['total']['income']['budget'] > 0)
											@php $total['income_budget_percent'] += round(($total_sale_service_budget / $profit_loss['surabaya']['total']['income']['budget']) * 100); @endphp
											{{ round(($total_sale_service_budget / $profit_loss['surabaya']['total']['income']['budget']) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_sale_service_actual_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['income']['actual']['current'] > 0)
											@php $total['income_actual_percent_current'] += round(($total_sale_service_actual_current / $profit_loss['surabaya']['total']['income']['actual']['current']) * 100); @endphp
											{{ round(($total_sale_service_actual_current / $profit_loss['surabaya']['total']['income']['actual']['current']) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_sale_service_variance_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_sale_service_budget > 0)
											{{ round(($total_sale_service_variance_current / $total_sale_service_budget) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_sale_service_actual_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['income']['actual']['last'] > 0)
											@php $total['income_actual_percent_last'] += round(($total_sale_service_actual_last / $profit_loss['surabaya']['total']['income']['actual']['last']) * 100); @endphp
											{{ round(($total_sale_service_actual_last / $profit_loss['surabaya']['total']['income']['actual']['last']) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_sale_service_variance_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_sale_service_actual_last > 0)
											{{ round(($total_sale_service_variance_last / $total_sale_service_actual_last) * 100) }}%
											@else
											0%
											@endif
										</th>
									</tr>
									<tr class="bg-info-300 text-uppercase">
										<th class="text-left font-weight-bold">Total Income</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['surabaya']['total']['income']['budget']) }}</th>
										<th class="text-center font-weight-bold">{{ $total['income_budget_percent'] }}%</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['surabaya']['total']['income']['actual']['current']) }}</th>
										<th class="text-center font-weight-bold">{{ $total['income_actual_percent_current'] }}%</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['surabaya']['total']['income']['variance']['current']) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['income']['budget'] > 0)
											{{ round(($profit_loss['surabaya']['total']['income']['variance']['current'] / $profit_loss['surabaya']['total']['income']['budget']) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['surabaya']['total']['income']['actual']['last']) }}</th>
										<th class="text-center font-weight-bold">{{ $total['income_actual_percent_last'] }}%</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['surabaya']['total']['income']['variance']['last']) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['income']['actual']['last'] > 0)
											{{ round(($profit_loss['surabaya']['total']['income']['variance']['last'] / $profit_loss['surabaya']['total']['income']['actual']['last']) * 100) }}%
											@else
											0%
											@endif
										</th>
									</tr>
									<tr class="font-weight-bold">
										<th colspan="12">COGS</th>
									</tr>
									@php
										$total_cogs_actual_current   = 0;
										$total_cogs_budget           = 0;
										$total_cogs_variance_current = 0;
										$total_cogs_actual_last      = 0;
										$total_cogs_variance_last    = 0;
									@endphp
									@foreach($profit_loss['surabaya']['cogs'] as $c)
										@php
											$total_cogs_actual_current   += $c['actual']['current'];
											$total_cogs_budget           += $c['budget'];
											$total_cogs_variance_current += $c['variance']['nominal']['current'];
											$total_cogs_actual_last      += $c['actual']['last'];
											$total_cogs_variance_last    += $c['variance']['nominal']['last'];
										@endphp
										<tr>
											<td class="text-left"><span class="ml-2">{{ $c['name'] }}</span></td>
											<td class="text-right">{{ number_format($c['budget']) }}</td>
											<td class="text-center">
											@if($profit_loss['surabaya']['total']['income']['budget'] > 0)
												{{ round(($c['budget'] / $profit_loss['surabaya']['total']['income']['budget']) * 100) }}%
											@else
												0%
											@endif
											</td>
											<td class="text-right">{{ number_format($c['actual']['current']) }}</td>
											<td class="text-center">
											@if($profit_loss['surabaya']['total']['income']['actual']['current'] > 0)
												{{ round(($c['actual']['current'] / $profit_loss['surabaya']['total']['income']['actual']['current']) * 100) }}%
											@else
												0%
											@endif
											</td>
											<td class="text-right">{{ number_format($c['variance']['nominal']['current']) }}</td>
											<td class="text-center">{{ number_format($c['variance']['percent']['current']) }}%</td>
											<td class="text-right">{{ number_format($c['actual']['last']) }}</td>
											<td class="text-center">
											@if($profit_loss['surabaya']['total']['income']['actual']['last'] > 0)
												{{ round(($c['actual']['last'] / $profit_loss['surabaya']['total']['income']['actual']['last']) * 100) }}%
											@else
												0%
											@endif
											</td>
											<td class="text-right">{{ number_format($c['variance']['nominal']['last']) }}</td>
											<td class="text-center">{{ number_format($c['variance']['percent']['last']) }}%</td>
										</tr>
									@endforeach
									<tr class="bg-info-300 text-uppercase">
										<th class="text-left font-weight-bold">Total COGS</th>
										<th class="text-right font-weight-bold">{{ number_format($total_cogs_budget) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['income']['budget'] > 0)
											{{ round(($total_cogs_budget / $profit_loss['surabaya']['total']['income']['budget']) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_cogs_actual_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['income']['actual']['current'] > 0)
											{{ round(($total_cogs_actual_current / $profit_loss['surabaya']['total']['income']['actual']['current']) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_cogs_variance_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_cogs_budget > 0)
											{{ round(($total_cogs_variance_current / $total_cogs_budget) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_cogs_actual_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['income']['actual']['last'] > 0)
											{{ round(($total_cogs_actual_last / $profit_loss['surabaya']['total']['income']['actual']['last']) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_cogs_variance_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_cogs_actual_last > 0)
											{{ round(($total_cogs_variance_last / $total_cogs_actual_last) * 100) }}%
											@else
											0%
											@endif
										</th>
									</tr>
									<tr class="font-weight-bold">
										<th colspan="12">Fixed Cost</th>
									</tr>
									<tr class="font-weight-bold">
										<th colspan="12"><span class="ml-2">Salary & Wages</span></th>
									</tr>
									@php
										$total_salary_wages_actual_current   = 0;
										$total_salary_wages_budget           = 0;
										$total_salary_wages_variance_current = 0;
										$total_salary_wages_actual_last      = 0;
										$total_salary_wages_variance_last    = 0;
									@endphp
									@foreach($profit_loss['surabaya']['salary_wages'] as $sw)
										@php
											$total_salary_wages_actual_current   += $sw['actual']['nominal']['current'];
											$total_salary_wages_budget           += $sw['budget']['nominal'];
											$total_salary_wages_variance_current += $sw['variance']['nominal']['current'];
											$total_salary_wages_actual_last      += $sw['actual']['nominal']['last'];
											$total_salary_wages_variance_last    += $sw['variance']['nominal']['last'];
										@endphp
										<tr>
											<td class="text-left"><span class="ml-4">{{ $sw['name'] }}</span></td>
											<td class="text-right">{{ number_format($sw['budget']['nominal']) }}</td>
											<td class="text-center">{{ $sw['budget']['percent'] }}%</td>
											<td class="text-right">{{ number_format($sw['actual']['nominal']['current']) }}</td>
											<td class="text-center">{{ $sw['actual']['percent']['current'] }}%</td>
											<td class="text-right">{{ number_format($sw['variance']['nominal']['current']) }}</td>
											<td class="text-center">{{ number_format($sw['variance']['percent']['current']) }}%</td>
											<td class="text-right">{{ number_format($sw['actual']['nominal']['last']) }}</td>
											<td class="text-center">{{ $sw['actual']['percent']['last'] }}%</td>
											<td class="text-right">{{ number_format($sw['variance']['nominal']['last']) }}</td>
											<td class="text-center">{{ number_format($sw['variance']['percent']['last']) }}%</td>
										</tr>
									@endforeach
									<tr class="table-secondary font-italic">
										<th class="text-right font-weight-bold">Total Salary & Wages</th>
										<th class="text-right font-weight-bold">{{ number_format($total_salary_wages_budget) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['income']['budget'] > 0)
											@php $total['fee_budget_percent'] += round(($total_salary_wages_budget / $profit_loss['surabaya']['total']['income']['budget']) * 100); @endphp
											{{ round(($total_salary_wages_budget / $profit_loss['surabaya']['total']['income']['budget']) * 100) }}%
											@else
											@php $total['fee_budget_percent'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_salary_wages_actual_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['income']['actual']['current'] > 0)
											@php $total['fee_actual_percent_current'] += round(($total_salary_wages_actual_current / $profit_loss['surabaya']['total']['income']['actual']['current']) * 100); @endphp
											{{ round(($total_salary_wages_actual_current / $profit_loss['surabaya']['total']['income']['actual']['current']) * 100) }}%
											@else
											@php $total['fee_actual_percent_current'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_salary_wages_variance_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_salary_wages_budget > 0)
											{{ round(($total_salary_wages_variance_current / $total_salary_wages_budget) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_salary_wages_actual_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['income']['actual']['last'] > 0)
											@php $total['fee_actual_percent_last'] += round(($total_salary_wages_actual_last / $profit_loss['surabaya']['total']['income']['actual']['last']) * 100); @endphp
											{{ round(($total_salary_wages_actual_last / $profit_loss['surabaya']['total']['income']['actual']['last']) * 100) }}%
											@else
											@php $total['fee_actual_percent_last'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_salary_wages_variance_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_salary_wages_actual_last > 0)
											{{ round(($total_salary_wages_variance_last / $total_salary_wages_actual_last) * 100) }}%
											@else
											0%
											@endif
										</th>
									</tr>
                                    <tr class="font-weight-bold">
                                        <th colspan="12">Variable Cost</th>
                                    </tr>
									<tr class="font-weight-bold">
										<th colspan="12"><span class="ml-2">Fee Sales & Marketing</span></th>
									</tr>
									@php
										$total_fee_marketing_actual_current   = 0;
										$total_fee_marketing_budget           = 0;
										$total_fee_marketing_variance_current = 0;
										$total_fee_marketing_actual_last      = 0;
										$total_fee_marketing_variance_last    = 0;
									@endphp
									@foreach($profit_loss['surabaya']['fee_marketing'] as $fm)
										@php
											$total_fee_marketing_actual_current   += $fm['actual']['nominal']['current'];
											$total_fee_marketing_budget           += $fm['budget']['nominal'];
											$total_fee_marketing_variance_current += $fm['variance']['nominal']['current'];
											$total_fee_marketing_actual_last      += $fm['actual']['nominal']['last'];
											$total_fee_marketing_variance_last    += $fm['variance']['nominal']['last'];
										@endphp
										<tr>
											<td class="text-left"><span class="ml-4">{{ $fm['name'] }}</span></td>
											<td class="text-right">{{ number_format($fm['budget']['nominal']) }}</td>
											<td class="text-center">{{ $fm['budget']['percent'] }}%</td>
											<td class="text-right">{{ number_format($fm['actual']['nominal']['current']) }}</td>
											<td class="text-center">{{ $fm['actual']['percent']['current'] }}%</td>
											<td class="text-right">{{ number_format($fm['variance']['nominal']['current']) }}</td>
											<td class="text-center">{{ number_format($fm['variance']['percent']['current']) }}%</td>
											<td class="text-right">{{ number_format($fm['actual']['nominal']['last']) }}</td>
											<td class="text-center">{{ $fm['actual']['percent']['last'] }}%</td>
											<td class="text-right">{{ number_format($fm['variance']['nominal']['last']) }}</td>
											<td class="text-center">{{ number_format($fm['variance']['percent']['last']) }}%</td>
										</tr>
									@endforeach
									<tr class="table-secondary font-italic">
										<th class="text-right font-weight-bold">Total Fee Sales & Marketing</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_marketing_budget) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['income']['budget'] > 0)
											@php $total['fee_budget_percent'] += round(($total_fee_marketing_budget / $profit_loss['surabaya']['total']['income']['budget']) * 100); @endphp
											{{ round(($total_fee_marketing_budget / $profit_loss['surabaya']['total']['income']['budget']) * 100) }}%
											@else
											@php $total['fee_budget_percent'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_marketing_actual_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['income']['actual']['current'] > 0)
											@php $total['fee_actual_percent_current'] += round(($total_fee_marketing_actual_current / $profit_loss['surabaya']['total']['income']['actual']['current']) * 100); @endphp
											{{ round(($total_fee_marketing_actual_current / $profit_loss['surabaya']['total']['income']['actual']['current']) * 100) }}%
											@else
											@php $total['fee_actual_percent_current'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_marketing_variance_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_fee_marketing_budget > 0)
											{{ round(($total_fee_marketing_variance_current / $total_fee_marketing_budget) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_marketing_actual_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['income']['actual']['last'] > 0)
											@php $total['fee_actual_percent_last'] += round(($total_fee_marketing_actual_last / $profit_loss['surabaya']['total']['income']['actual']['last']) * 100); @endphp
											{{ round(($total_fee_marketing_actual_last / $profit_loss['surabaya']['total']['income']['actual']['last']) * 100) }}%
											@else
											@php $total['fee_actual_percent_last'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_marketing_variance_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_fee_marketing_actual_last > 0)
											{{ round(($total_fee_marketing_variance_last / $total_fee_marketing_actual_last) * 100) }}%
											@else
											0%
											@endif
										</th>
									</tr>
									<tr class="font-weight-bold">
										<th colspan="12"><span class="ml-2">Other Expense</span></th>
									</tr>
									@php
										$total_fee_other_actual_current   = 0;
										$total_fee_other_budget           = 0;
										$total_fee_other_variance_current = 0;
										$total_fee_other_actual_last      = 0;
										$total_fee_other_variance_last    = 0;
									@endphp
									@foreach($profit_loss['surabaya']['fee_other'] as $fo)
										@php
											$total_fee_other_actual_current   += $fo['actual']['nominal']['current'];
											$total_fee_other_budget           += $fo['budget']['nominal'];
											$total_fee_other_variance_current += $fo['variance']['nominal']['current'];
											$total_fee_other_actual_last      += $fo['actual']['nominal']['last'];
											$total_fee_other_variance_last    += $fo['variance']['nominal']['last'];
										@endphp
										<tr>
											<td class="text-left"><span class="ml-4">{{ $fo['name'] }}</span></td>
											<td class="text-right">{{ number_format($fo['budget']['nominal']) }}</td>
											<td class="text-center">{{ $fo['budget']['percent'] }}%</td>
											<td class="text-right">{{ number_format($fo['actual']['nominal']['current']) }}</td>
											<td class="text-center">{{ $fo['actual']['percent']['current'] }}%</td>
											<td class="text-right">{{ number_format($fo['variance']['nominal']['current']) }}</td>
											<td class="text-center">{{ number_format($fo['variance']['percent']['current']) }}%</td>
											<td class="text-right">{{ number_format($fo['actual']['nominal']['last']) }}</td>
											<td class="text-center">{{ $fo['actual']['percent']['last'] }}%</td>
											<td class="text-right">{{ number_format($fo['variance']['nominal']['last']) }}</td>
											<td class="text-center">{{ number_format($fo['variance']['percent']['last']) }}%</td>
										</tr>
									@endforeach
									<tr class="table-secondary font-italic">
										<th class="text-right font-weight-bold">Total Other Expenses</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_other_budget) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['income']['budget'] > 0)
											@php $total['fee_budget_percent'] += round(($total_fee_other_budget / $profit_loss['surabaya']['total']['income']['budget']) * 100); @endphp
											{{ round(($total_fee_other_budget / $profit_loss['surabaya']['total']['income']['budget']) * 100) }}%
											@else
											@php $total['fee_budget_percent'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_other_actual_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['income']['actual']['current'] > 0)
											@php $total['fee_actual_percent_current'] += round(($total_fee_other_actual_current / $profit_loss['surabaya']['total']['income']['actual']['current']) * 100); @endphp
											{{ round(($total_fee_other_actual_current / $profit_loss['surabaya']['total']['income']['actual']['current']) * 100) }}%
											@else
											@php $total['fee_actual_percent_current'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_other_variance_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_fee_other_budget > 0)
											{{ round(($total_fee_other_variance_current / $total_fee_other_budget) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_other_actual_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['income']['actual']['last'] > 0)
											@php $total['fee_actual_percent_last'] += round(($total_fee_other_actual_last / $profit_loss['surabaya']['total']['income']['actual']['last']) * 100); @endphp
											{{ round(($total_fee_other_actual_last / $profit_loss['surabaya']['total']['income']['actual']['last']) * 100) }}%
											@else
											@php $total['fee_actual_percent_last'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_other_variance_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_fee_other_actual_last > 0)
											{{ round(($total_fee_other_variance_last / $total_fee_other_actual_last) * 100) }}%
											@else
											0%
											@endif
										</th>
									</tr>
									<tr class="font-weight-bold">
										<th colspan="12"><span class="ml-2">Fee Maintenance</span></th>
									</tr>
									@php
										$total_fee_maintenance_actual_current   = 0;
										$total_fee_maintenance_budget           = 0;
										$total_fee_maintenance_variance_current = 0;
										$total_fee_maintenance_actual_last      = 0;
										$total_fee_maintenance_variance_last    = 0;
									@endphp
									@foreach($profit_loss['surabaya']['fee_maintenance'] as $fm)
										@php
											$total_fee_maintenance_actual_current   += $fm['actual']['nominal']['current'];
											$total_fee_maintenance_budget           += $fm['budget']['nominal'];
											$total_fee_maintenance_variance_current += $fm['variance']['nominal']['current'];
											$total_fee_maintenance_actual_last      += $fm['actual']['nominal']['last'];
											$total_fee_maintenance_variance_last    += $fm['variance']['nominal']['last'];
										@endphp
										<tr>
											<td class="text-left"><span class="ml-4">{{ $fm['name'] }}</span></td>
											<td class="text-right">{{ number_format($fm['budget']['nominal']) }}</td>
											<td class="text-center">{{ $fm['budget']['percent'] }}%</td>
											<td class="text-right">{{ number_format($fm['actual']['nominal']['current']) }}</td>
											<td class="text-center">{{ $fm['actual']['percent']['current'] }}%</td>
											<td class="text-right">{{ number_format($fm['variance']['nominal']['current']) }}</td>
											<td class="text-center">{{ number_format($fm['variance']['percent']['current']) }}%</td>
											<td class="text-right">{{ number_format($fm['actual']['nominal']['last']) }}</td>
											<td class="text-center">{{ $fm['actual']['percent']['last'] }}%</td>
											<td class="text-right">{{ number_format($fm['variance']['nominal']['last']) }}</td>
											<td class="text-center">{{ number_format($fm['variance']['percent']['last']) }}%</td>
										</tr>
									@endforeach
									<tr class="table-secondary font-italic">
										<th class="text-right font-weight-bold">Total Fee Maintenance</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_maintenance_budget) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['income']['budget'] > 0)
											@php $total['fee_budget_percent'] += round(($total_fee_maintenance_budget / $profit_loss['surabaya']['total']['income']['budget']) * 100); @endphp
											{{ round(($total_fee_maintenance_budget / $profit_loss['surabaya']['total']['income']['budget']) * 100) }}%
											@else
											@php $total['fee_budget_percent'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_maintenance_actual_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['income']['actual']['current'] > 0)
											@php $total['fee_actual_percent_current'] += round(($total_fee_maintenance_actual_current / $profit_loss['surabaya']['total']['income']['actual']['current']) * 100); @endphp
											{{ round(($total_fee_maintenance_actual_current / $profit_loss['surabaya']['total']['income']['actual']['current']) * 100) }}%
											@else
											@php $total['fee_actual_percent_current'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_maintenance_variance_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_fee_maintenance_budget > 0)
											{{ round(($total_fee_maintenance_variance_current / $total_fee_maintenance_budget) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_maintenance_actual_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['income']['actual']['last'] > 0)
											@php $total['fee_actual_percent_last'] += round(($total_fee_maintenance_actual_last / $profit_loss['surabaya']['total']['income']['actual']['last']) * 100); @endphp
											{{ round(($total_fee_maintenance_actual_last / $profit_loss['surabaya']['total']['income']['actual']['last']) * 100) }}%
											@else
											@php $total['fee_actual_percent_last'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_maintenance_variance_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_fee_maintenance_actual_last > 0)
											{{ round(($total_fee_maintenance_variance_last / $total_fee_maintenance_actual_last) * 100) }}%
											@else
											0%
											@endif
										</th>
									</tr>
									<tr class="bg-info-300 text-uppercase">
										<th class="text-left font-weight-bold">Total Variable Cost</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['surabaya']['total']['fee']['budget']) }}</th>
										<th class="text-center font-weight-bold">{{ $total['fee_budget_percent'] }}%</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['surabaya']['total']['fee']['actual']['current']) }}</th>
										<th class="text-center font-weight-bold">{{ $total['fee_actual_percent_current'] }}%</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['surabaya']['total']['fee']['variance']['current']) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['fee']['budget'] > 0)
											{{ round(($profit_loss['surabaya']['total']['fee']['variance']['current'] / $profit_loss['surabaya']['total']['fee']['budget']) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['surabaya']['total']['fee']['actual']['last']) }}</th>
										<th class="text-center font-weight-bold">{{ $total['fee_actual_percent_last'] }}%</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['surabaya']['total']['fee']['variance']['last']) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['surabaya']['total']['fee']['actual']['last'] > 0)
											{{ round(($profit_loss['surabaya']['total']['fee']['variance']['last'] / $profit_loss['surabaya']['total']['fee']['actual']['last']) * 100) }}%
											@else
											0%
											@endif
										</th>
									</tr>
									<tr><td colspan="12"></td></tr>
									<tr class="bg-success-300 text-uppercase">
										<th class="text-left font-weight-bold">Nett Profit (Loss)</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['surabaya']['grandtotal']['nett']['budget']['nominal']) }}</th>
										<th class="text-center font-weight-bold">{{ $profit_loss['surabaya']['grandtotal']['nett']['budget']['percent'] }}%</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['surabaya']['grandtotal']['nett']['actual']['current']['nominal']) }}</th>
										<th class="text-center font-weight-bold">{{ $profit_loss['surabaya']['grandtotal']['nett']['actual']['current']['percent'] }}%</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['surabaya']['grandtotal']['nett']['variance']['current']['nominal']) }}</th>
										<th class="text-center font-weight-bold">{{ $profit_loss['surabaya']['grandtotal']['nett']['variance']['current']['percent'] }}%</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['surabaya']['grandtotal']['nett']['actual']['last']['nominal']) }}</th>
										<th class="text-center font-weight-bold">{{ $profit_loss['surabaya']['grandtotal']['nett']['actual']['last']['percent'] }}%</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['surabaya']['grandtotal']['nett']['variance']['last']['nominal']) }}</th>
										<th class="text-center font-weight-bold">{{ $profit_loss['surabaya']['grandtotal']['nett']['variance']['last']['percent'] }}%</th>
									</tr>
								</tbody>
								</table>
							</div>
						</p>
					</div>
					<div class="tab-pane fade" id="solid-bordered-justified-tab3">
						@php
							$total['income_actual_percent_current'] = 0;
							$total['income_actual_percent_last']    = 0;
							$total['income_budget_percent']         = 0;
							$total['fee_actual_percent_current']    = 0;
							$total['fee_actual_percent_last']       = 0;
							$total['fee_budget_percent']            = 0;
						@endphp
						<p class="mt-3">
							<div class="table-responsive">
								<table class="table table-sm table-bordered">
								<thead>
									<tr class="text-center">
										<th rowspan="2" class="bg-grey">Description</th>
										<th colspan="6" class="bg-primary">Current Month</th>
										<th colspan="4" class="bg-primary">Last Month</th>
									</tr>
									<tr class="text-center">
										<th class="bg-grey">Budget</th>
										<th class="bg-grey">%</th>
										<th class="bg-grey">Actual</th>
										<th class="bg-grey">%</th>
										<th class="bg-grey">Variance</th>
										<th class="bg-grey">%</th>
										<th class="bg-grey">Actual</th>
										<th class="bg-grey">%</th>
										<th class="bg-grey">Variance</th>
										<th class="bg-grey">%</th>
									</tr>
								</thead>
								<tbody>
									<tr class="font-weight-bold">
										<th colspan="12">INCOME</th>
									</tr>
									<tr class="font-weight-bold">
										<th colspan="12"><span class="ml-2">Sales</span></th>
									</tr>
									@php
										$total_sale_actual_current   = 0;
										$total_sale_budget           = 0;
										$total_sale_variance_current = 0;
										$total_sale_actual_last      = 0;
										$total_sale_variance_last    = 0;
									@endphp
									@foreach($profit_loss['jakarta']['sale'] as $s)
										@php
											$total_sale_actual_current   += $s['actual']['current'];
											$total_sale_budget           += $s['budget'];
											$total_sale_variance_current += $s['variance']['nominal']['current'];
											$total_sale_actual_last      += $s['actual']['last'];
											$total_sale_variance_last    += $s['variance']['nominal']['last'];
										@endphp
										<tr>
											<td class="text-left"><span class="ml-4">{{ $s['name'] }}</span></td>
											<td class="text-right">{{ number_format($s['budget']) }}</td>
											<td class="text-center">
											@if($profit_loss['jakarta']['total']['income']['budget'] > 0)
												{{ round(($s['budget'] / $profit_loss['jakarta']['total']['income']['budget']) * 100) }}%
											@else
												0%
											@endif
											</td>
											<td class="text-right">{{ number_format($s['actual']['current']) }}</td>
											<td class="text-center">
											@if($profit_loss['jakarta']['total']['income']['actual']['current'] > 0)
												{{ round(($s['actual']['current'] / $profit_loss['jakarta']['total']['income']['actual']['current']) * 100) }}%
											@else
												0%
											@endif
											</td>
											<td class="text-right">{{ number_format($s['variance']['nominal']['current']) }}</td>
											<td class="text-center">{{ number_format($s['variance']['percent']['current']) }}%</td>
											<td class="text-right">{{ number_format($s['actual']['last']) }}</td>
											<td class="text-center">
											@if($profit_loss['jakarta']['total']['income']['actual']['last'] > 0)
												{{ round(($s['actual']['last'] / $profit_loss['jakarta']['total']['income']['actual']['last']) * 100) }}%
											@else
												0%
											@endif
											</td>
											<td class="text-right">{{ number_format($s['variance']['nominal']['last']) }}</td>
											<td class="text-center">{{ number_format($s['variance']['percent']['last']) }}%</td>
										</tr>
									@endforeach
									<tr class="table-secondary font-italic">
										<th class="text-right font-weight-bold">Total Sales</th>
										<th class="text-right font-weight-bold">{{ number_format($total_sale_budget) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['income']['budget'] > 0)
											@php $total['income_budget_percent'] += round(($total_sale_budget / $profit_loss['jakarta']['total']['income']['budget']) * 100); @endphp
											{{ round(($total_sale_budget / $profit_loss['jakarta']['total']['income']['budget']) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_sale_actual_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['income']['actual']['current'] > 0)
											@php $total['income_actual_percent_current'] += round(($total_sale_actual_current / $profit_loss['jakarta']['total']['income']['actual']['current']) * 100); @endphp
											{{ round(($total_sale_actual_current / $profit_loss['jakarta']['total']['income']['actual']['current']) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_sale_variance_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_sale_budget > 0)
											{{ round(($total_sale_variance_current / $total_sale_budget) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_sale_actual_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['income']['actual']['last'] > 0)
											@php $total['income_actual_percent_last'] += round(($total_sale_actual_last / $profit_loss['jakarta']['total']['income']['actual']['last']) * 100); @endphp
											{{ round(($total_sale_actual_last / $profit_loss['jakarta']['total']['income']['actual']['last']) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_sale_variance_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_sale_actual_last > 0)
											{{ round(($total_sale_variance_last / $total_sale_actual_last) * 100) }}%
											@else
											0%
											@endif
										</th>
									</tr>
									<tr class="font-weight-bold">
										<th colspan="12"><span class="ml-2">Sales Service</span></th>
									</tr>
									@php
										$total_sale_service_actual_current   = 0;
										$total_sale_service_budget           = 0;
										$total_sale_service_variance_current = 0;
										$total_sale_service_actual_last      = 0;
										$total_sale_service_variance_last    = 0;
									@endphp
									@foreach($profit_loss['jakarta']['sale_service'] as $ss)
										@php
											$total_sale_service_actual_current   += $ss['actual']['current'];
											$total_sale_service_budget           += $ss['budget'];
											$total_sale_service_variance_current += $ss['variance']['nominal']['current'];
											$total_sale_service_actual_last      += $ss['actual']['last'];
											$total_sale_service_variance_last    += $ss['variance']['nominal']['last'];
										@endphp
										<tr>
											<td class="text-left"><span class="ml-4">{{ $ss['name'] }}</span></td>
											<td class="text-right">{{ number_format($ss['budget']) }}</td>
											<td class="text-center">
											@if($profit_loss['jakarta']['total']['income']['budget'] > 0)
												{{ round(($ss['budget'] / $profit_loss['jakarta']['total']['income']['budget']) * 100) }}%
											@else
												0%
											@endif
											</td>
											<td class="text-right">{{ number_format($ss['actual']['current']) }}</td>
											<td class="text-center">
											@if($profit_loss['jakarta']['total']['income']['actual']['current'] > 0)
												{{ round(($ss['actual']['current'] / $profit_loss['jakarta']['total']['income']['actual']['current']) * 100) }}%
											@else
												0%
											@endif
											</td>
											<td class="text-right">{{ number_format($ss['variance']['nominal']['current']) }}</td>
											<td class="text-center">{{ number_format($ss['variance']['percent']['current']) }}%</td>
											<td class="text-right">{{ number_format($ss['actual']['last']) }}</td>
											<td class="text-center">
											@if($profit_loss['jakarta']['total']['income']['actual']['last'] > 0)
												{{ round(($ss['actual']['last'] / $profit_loss['jakarta']['total']['income']['actual']['last']) * 100) }}%
											@else
												0%
											@endif
											</td>
											<td class="text-right">{{ number_format($ss['variance']['nominal']['last']) }}</td>
											<td class="text-center">{{ number_format($ss['variance']['percent']['last']) }}%</td>
										</tr>
									@endforeach
									<tr class="table-secondary font-italic">
										<th class="text-right font-weight-bold">Total Sales Service</th>
										<th class="text-right font-weight-bold">{{ number_format($total_sale_service_budget) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['income']['budget'] > 0)
											@php $total['income_budget_percent'] += round(($total_sale_service_budget / $profit_loss['jakarta']['total']['income']['budget']) * 100); @endphp
											{{ round(($total_sale_service_budget / $profit_loss['jakarta']['total']['income']['budget']) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_sale_service_actual_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['income']['actual']['current'] > 0)
											@php $total['income_actual_percent_current'] += round(($total_sale_service_actual_current / $profit_loss['jakarta']['total']['income']['actual']['current']) * 100); @endphp
											{{ round(($total_sale_service_actual_current / $profit_loss['jakarta']['total']['income']['actual']['current']) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_sale_service_variance_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_sale_service_budget > 0)
											{{ round(($total_sale_service_variance_current / $total_sale_service_budget) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_sale_service_actual_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['income']['actual']['last'] > 0)
											@php $total['income_actual_percent_last'] += round(($total_sale_service_actual_last / $profit_loss['jakarta']['total']['income']['actual']['last']) * 100); @endphp
											{{ round(($total_sale_service_actual_last / $profit_loss['jakarta']['total']['income']['actual']['last']) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_sale_service_variance_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_sale_service_actual_last > 0)
											{{ round(($total_sale_service_variance_last / $total_sale_service_actual_last) * 100) }}%
											@else
											0%
											@endif
										</th>
									</tr>
									<tr class="bg-info-300 text-uppercase">
										<th class="text-left font-weight-bold">Total Income</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['jakarta']['total']['income']['budget']) }}</th>
										<th class="text-center font-weight-bold">{{ $total['income_budget_percent'] }}%</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['jakarta']['total']['income']['actual']['current']) }}</th>
										<th class="text-center font-weight-bold">{{ $total['income_actual_percent_current'] }}%</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['jakarta']['total']['income']['variance']['current']) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['income']['budget'] > 0)
											{{ round(($profit_loss['jakarta']['total']['income']['variance']['current'] / $profit_loss['jakarta']['total']['income']['budget']) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['jakarta']['total']['income']['actual']['last']) }}</th>
										<th class="text-center font-weight-bold">{{ $total['income_actual_percent_last'] }}%</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['jakarta']['total']['income']['variance']['last']) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['income']['actual']['last'] > 0)
											{{ round(($profit_loss['jakarta']['total']['income']['variance']['last'] / $profit_loss['jakarta']['total']['income']['actual']['last']) * 100) }}%
											@else
											0%
											@endif
										</th>
									</tr>
									<tr class="font-weight-bold">
										<th colspan="12">COGS</th>
									</tr>
									@php
										$total_cogs_actual_current   = 0;
										$total_cogs_budget           = 0;
										$total_cogs_variance_current = 0;
										$total_cogs_actual_last      = 0;
										$total_cogs_variance_last    = 0;
									@endphp
									@foreach($profit_loss['jakarta']['cogs'] as $c)
										@php
											$total_cogs_actual_current   += $c['actual']['current'];
											$total_cogs_budget           += $c['budget'];
											$total_cogs_variance_current += $c['variance']['nominal']['current'];
											$total_cogs_actual_last      += $c['actual']['last'];
											$total_cogs_variance_last    += $c['variance']['nominal']['last'];
										@endphp
										<tr>
											<td class="text-left"><span class="ml-2">{{ $c['name'] }}</span></td>
											<td class="text-right">{{ number_format($c['budget']) }}</td>
											<td class="text-center">
											@if($profit_loss['jakarta']['total']['income']['budget'] > 0)
												{{ round(($c['budget'] / $profit_loss['jakarta']['total']['income']['budget']) * 100) }}%
											@else
												0%
											@endif
											</td>
											<td class="text-right">{{ number_format($c['actual']['current']) }}</td>
											<td class="text-center">
											@if($profit_loss['jakarta']['total']['income']['actual']['current'] > 0)
												{{ round(($c['actual']['current'] / $profit_loss['jakarta']['total']['income']['actual']['current']) * 100) }}%
											@else
												0%
											@endif
											</td>
											<td class="text-right">{{ number_format($c['variance']['nominal']['current']) }}</td>
											<td class="text-center">{{ number_format($c['variance']['percent']['current']) }}%</td>
											<td class="text-right">{{ number_format($c['actual']['last']) }}</td>
											<td class="text-center">
											@if($profit_loss['jakarta']['total']['income']['actual']['last'] > 0)
												{{ round(($c['actual']['last'] / $profit_loss['jakarta']['total']['income']['actual']['last']) * 100) }}%
											@else
												0%
											@endif
											</td>
											<td class="text-right">{{ number_format($c['variance']['nominal']['last']) }}</td>
											<td class="text-center">{{ number_format($c['variance']['percent']['last']) }}%</td>
										</tr>
									@endforeach
									<tr class="bg-info-300 text-uppercase">
										<th class="text-left font-weight-bold">Total COGS</th>
										<th class="text-right font-weight-bold">{{ number_format($total_cogs_budget) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['income']['budget'] > 0)
											{{ round(($total_cogs_budget / $profit_loss['jakarta']['total']['income']['budget']) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_cogs_actual_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['income']['actual']['current'] > 0)
											{{ round(($total_cogs_actual_current / $profit_loss['jakarta']['total']['income']['actual']['current']) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_cogs_variance_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_cogs_budget > 0)
											{{ round(($total_cogs_variance_current / $total_cogs_budget) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_cogs_actual_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['income']['actual']['last'] > 0)
											{{ round(($total_cogs_actual_last / $profit_loss['jakarta']['total']['income']['actual']['last']) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_cogs_variance_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_cogs_actual_last > 0)
											{{ round(($total_cogs_variance_last / $total_cogs_actual_last) * 100) }}%
											@else
											0%
											@endif
										</th>
									</tr>
									<tr class="font-weight-bold">
										<th colspan="12">Fixed Cost</th>
									</tr>
									<tr class="font-weight-bold">
										<th colspan="12"><span class="ml-2">Salary & Wages</span></th>
									</tr>
									@php
										$total_salary_wages_actual_current   = 0;
										$total_salary_wages_budget           = 0;
										$total_salary_wages_variance_current = 0;
										$total_salary_wages_actual_last      = 0;
										$total_salary_wages_variance_last    = 0;
									@endphp
									@foreach($profit_loss['jakarta']['salary_wages'] as $sw)
										@php
											$total_salary_wages_actual_current   += $sw['actual']['nominal']['current'];
											$total_salary_wages_budget           += $sw['budget']['nominal'];
											$total_salary_wages_variance_current += $sw['variance']['nominal']['current'];
											$total_salary_wages_actual_last      += $sw['actual']['nominal']['last'];
											$total_salary_wages_variance_last    += $sw['variance']['nominal']['last'];
										@endphp
										<tr>
											<td class="text-left"><span class="ml-4">{{ $sw['name'] }}</span></td>
											<td class="text-right">{{ number_format($sw['budget']['nominal']) }}</td>
											<td class="text-center">{{ $sw['budget']['percent'] }}%</td>
											<td class="text-right">{{ number_format($sw['actual']['nominal']['current']) }}</td>
											<td class="text-center">{{ $sw['actual']['percent']['current'] }}%</td>
											<td class="text-right">{{ number_format($sw['variance']['nominal']['current']) }}</td>
											<td class="text-center">{{ number_format($sw['variance']['percent']['current']) }}%</td>
											<td class="text-right">{{ number_format($sw['actual']['nominal']['last']) }}</td>
											<td class="text-center">{{ $sw['actual']['percent']['last'] }}%</td>
											<td class="text-right">{{ number_format($sw['variance']['nominal']['last']) }}</td>
											<td class="text-center">{{ number_format($sw['variance']['percent']['last']) }}%</td>
										</tr>
									@endforeach
									<tr class="table-secondary font-italic">
										<th class="text-right font-weight-bold">Total Salary & Wages</th>
										<th class="text-right font-weight-bold">{{ number_format($total_salary_wages_budget) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['income']['budget'] > 0)
											@php $total['fee_budget_percent'] += round(($total_salary_wages_budget / $profit_loss['jakarta']['total']['income']['budget']) * 100); @endphp
											{{ round(($total_salary_wages_budget / $profit_loss['jakarta']['total']['income']['budget']) * 100) }}%
											@else
											@php $total['fee_budget_percent'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_salary_wages_actual_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['income']['actual']['current'] > 0)
											@php $total['fee_actual_percent_current'] += round(($total_salary_wages_actual_current / $profit_loss['jakarta']['total']['income']['actual']['current']) * 100); @endphp
											{{ round(($total_salary_wages_actual_current / $profit_loss['jakarta']['total']['income']['actual']['current']) * 100) }}%
											@else
											@php $total['fee_actual_percent_current'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_salary_wages_variance_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_salary_wages_budget > 0)
											{{ round(($total_salary_wages_variance_current / $total_salary_wages_budget) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_salary_wages_actual_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['income']['actual']['last'] > 0)
											@php $total['fee_actual_percent_last'] += round(($total_salary_wages_actual_last / $profit_loss['jakarta']['total']['income']['actual']['last']) * 100); @endphp
											{{ round(($total_salary_wages_actual_last / $profit_loss['jakarta']['total']['income']['actual']['last']) * 100) }}%
											@else
											@php $total['fee_actual_percent_last'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_salary_wages_variance_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_salary_wages_actual_last > 0)
											{{ round(($total_salary_wages_variance_last / $total_salary_wages_actual_last) * 100) }}%
											@else
											0%
											@endif
										</th>
									</tr>
                                    <tr class="font-weight-bold">
                                        <th colspan="12">Variable Cost</th>
                                    </tr>
									<tr class="font-weight-bold">
										<th colspan="12"><span class="ml-2">Fee Sales & Marketing</span></th>
									</tr>
									@php
										$total_fee_marketing_actual_current   = 0;
										$total_fee_marketing_budget           = 0;
										$total_fee_marketing_variance_current = 0;
										$total_fee_marketing_actual_last      = 0;
										$total_fee_marketing_variance_last    = 0;
									@endphp
									@foreach($profit_loss['jakarta']['fee_marketing'] as $fm)
										@php
											$total_fee_marketing_actual_current   += $fm['actual']['nominal']['current'];
											$total_fee_marketing_budget           += $fm['budget']['nominal'];
											$total_fee_marketing_variance_current += $fm['variance']['nominal']['current'];
											$total_fee_marketing_actual_last      += $fm['actual']['nominal']['last'];
											$total_fee_marketing_variance_last    += $fm['variance']['nominal']['last'];
										@endphp
										<tr>
											<td class="text-left"><span class="ml-4">{{ $fm['name'] }}</span></td>
											<td class="text-right">{{ number_format($fm['budget']['nominal']) }}</td>
											<td class="text-center">{{ $fm['budget']['percent'] }}%</td>
											<td class="text-right">{{ number_format($fm['actual']['nominal']['current']) }}</td>
											<td class="text-center">{{ $fm['actual']['percent']['current'] }}%</td>
											<td class="text-right">{{ number_format($fm['variance']['nominal']['current']) }}</td>
											<td class="text-center">{{ number_format($fm['variance']['percent']['current']) }}%</td>
											<td class="text-right">{{ number_format($fm['actual']['nominal']['last']) }}</td>
											<td class="text-center">{{ $fm['actual']['percent']['last'] }}%</td>
											<td class="text-right">{{ number_format($fm['variance']['nominal']['last']) }}</td>
											<td class="text-center">{{ number_format($fm['variance']['percent']['last']) }}%</td>
										</tr>
									@endforeach
									<tr class="table-secondary font-italic">
										<th class="text-right font-weight-bold">Total Fee Sales & Marketing</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_marketing_budget) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['income']['budget'] > 0)
											@php $total['fee_budget_percent'] += round(($total_fee_marketing_budget / $profit_loss['jakarta']['total']['income']['budget']) * 100); @endphp
											{{ round(($total_fee_marketing_budget / $profit_loss['jakarta']['total']['income']['budget']) * 100) }}%
											@else
											@php $total['fee_budget_percent'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_marketing_actual_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['income']['actual']['current'] > 0)
											@php $total['fee_actual_percent_current'] += round(($total_fee_marketing_actual_current / $profit_loss['jakarta']['total']['income']['actual']['current']) * 100); @endphp
											{{ round(($total_fee_marketing_actual_current / $profit_loss['jakarta']['total']['income']['actual']['current']) * 100) }}%
											@else
											@php $total['fee_actual_percent_current'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_marketing_variance_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_fee_marketing_budget > 0)
											{{ round(($total_fee_marketing_variance_current / $total_fee_marketing_budget) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_marketing_actual_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['income']['actual']['last'] > 0)
											@php $total['fee_actual_percent_last'] += round(($total_fee_marketing_actual_last / $profit_loss['jakarta']['total']['income']['actual']['last']) * 100); @endphp
											{{ round(($total_fee_marketing_actual_last / $profit_loss['jakarta']['total']['income']['actual']['last']) * 100) }}%
											@else
											@php $total['fee_actual_percent_last'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_marketing_variance_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_fee_marketing_actual_last > 0)
											{{ round(($total_fee_marketing_variance_last / $total_fee_marketing_actual_last) * 100) }}%
											@else
											0%
											@endif
										</th>
									</tr>
									<tr class="font-weight-bold">
										<th colspan="12"><span class="ml-2">Other Expense</span></th>
									</tr>
									@php
										$total_fee_other_actual_current   = 0;
										$total_fee_other_budget           = 0;
										$total_fee_other_variance_current = 0;
										$total_fee_other_actual_last      = 0;
										$total_fee_other_variance_last    = 0;
									@endphp
									@foreach($profit_loss['jakarta']['fee_other'] as $fo)
										@php
											$total_fee_other_actual_current   += $fo['actual']['nominal']['current'];
											$total_fee_other_budget           += $fo['budget']['nominal'];
											$total_fee_other_variance_current += $fo['variance']['nominal']['current'];
											$total_fee_other_actual_last      += $fo['actual']['nominal']['last'];
											$total_fee_other_variance_last    += $fo['variance']['nominal']['last'];
										@endphp
										<tr>
											<td class="text-left"><span class="ml-4">{{ $fo['name'] }}</span></td>
											<td class="text-right">{{ number_format($fo['budget']['nominal']) }}</td>
											<td class="text-center">{{ $fo['budget']['percent'] }}%</td>
											<td class="text-right">{{ number_format($fo['actual']['nominal']['current']) }}</td>
											<td class="text-center">{{ $fo['actual']['percent']['current'] }}%</td>
											<td class="text-right">{{ number_format($fo['variance']['nominal']['current']) }}</td>
											<td class="text-center">{{ number_format($fo['variance']['percent']['current']) }}%</td>
											<td class="text-right">{{ number_format($fo['actual']['nominal']['last']) }}</td>
											<td class="text-center">{{ $fo['actual']['percent']['last'] }}%</td>
											<td class="text-right">{{ number_format($fo['variance']['nominal']['last']) }}</td>
											<td class="text-center">{{ number_format($fo['variance']['percent']['last']) }}%</td>
										</tr>
									@endforeach
									<tr class="table-secondary font-italic">
										<th class="text-right font-weight-bold">Total Other Expenses</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_other_budget) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['income']['budget'] > 0)
											@php $total['fee_budget_percent'] += round(($total_fee_other_budget / $profit_loss['jakarta']['total']['income']['budget']) * 100); @endphp
											{{ round(($total_fee_other_budget / $profit_loss['jakarta']['total']['income']['budget']) * 100) }}%
											@else
											@php $total['fee_budget_percent'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_other_actual_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['income']['actual']['current'] > 0)
											@php $total['fee_actual_percent_current'] += round(($total_fee_other_actual_current / $profit_loss['jakarta']['total']['income']['actual']['current']) * 100); @endphp
											{{ round(($total_fee_other_actual_current / $profit_loss['jakarta']['total']['income']['actual']['current']) * 100) }}%
											@else
											@php $total['fee_actual_percent_current'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_other_variance_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_fee_other_budget > 0)
											{{ round(($total_fee_other_variance_current / $total_fee_other_budget) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_other_actual_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['income']['actual']['last'] > 0)
											@php $total['fee_actual_percent_last'] += round(($total_fee_other_actual_last / $profit_loss['jakarta']['total']['income']['actual']['last']) * 100); @endphp
											{{ round(($total_fee_other_actual_last / $profit_loss['jakarta']['total']['income']['actual']['last']) * 100) }}%
											@else
											@php $total['fee_actual_percent_last'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_other_variance_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_fee_other_actual_last > 0)
											{{ round(($total_fee_other_variance_last / $total_fee_other_actual_last) * 100) }}%
											@else
											0%
											@endif
										</th>
									</tr>
									<tr class="font-weight-bold">
										<th colspan="12"><span class="ml-2">Fee Maintenance</span></th>
									</tr>
									@php
										$total_fee_maintenance_actual_current   = 0;
										$total_fee_maintenance_budget           = 0;
										$total_fee_maintenance_variance_current = 0;
										$total_fee_maintenance_actual_last      = 0;
										$total_fee_maintenance_variance_last    = 0;
									@endphp
									@foreach($profit_loss['jakarta']['fee_maintenance'] as $fm)
										@php
											$total_fee_maintenance_actual_current   += $fm['actual']['nominal']['current'];
											$total_fee_maintenance_budget           += $fm['budget']['nominal'];
											$total_fee_maintenance_variance_current += $fm['variance']['nominal']['current'];
											$total_fee_maintenance_actual_last      += $fm['actual']['nominal']['last'];
											$total_fee_maintenance_variance_last    += $fm['variance']['nominal']['last'];
										@endphp
										<tr>
											<td class="text-left"><span class="ml-4">{{ $fm['name'] }}</span></td>
											<td class="text-right">{{ number_format($fm['budget']['nominal']) }}</td>
											<td class="text-center">{{ $fm['budget']['percent'] }}%</td>
											<td class="text-right">{{ number_format($fm['actual']['nominal']['current']) }}</td>
											<td class="text-center">{{ $fm['actual']['percent']['current'] }}%</td>
											<td class="text-right">{{ number_format($fm['variance']['nominal']['current']) }}</td>
											<td class="text-center">{{ number_format($fm['variance']['percent']['current']) }}%</td>
											<td class="text-right">{{ number_format($fm['actual']['nominal']['last']) }}</td>
											<td class="text-center">{{ $fm['actual']['percent']['last'] }}%</td>
											<td class="text-right">{{ number_format($fm['variance']['nominal']['last']) }}</td>
											<td class="text-center">{{ number_format($fm['variance']['percent']['last']) }}%</td>
										</tr>
									@endforeach
									<tr class="table-secondary font-italic">
										<th class="text-right font-weight-bold">Total Fee Maintenance</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_maintenance_budget) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['income']['budget'] > 0)
											@php $total['fee_budget_percent'] += round(($total_fee_maintenance_budget / $profit_loss['jakarta']['total']['income']['budget']) * 100); @endphp
											{{ round(($total_fee_maintenance_budget / $profit_loss['jakarta']['total']['income']['budget']) * 100) }}%
											@else
											@php $total['fee_budget_percent'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_maintenance_actual_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['income']['actual']['current'] > 0)
											@php $total['fee_actual_percent_current'] += round(($total_fee_maintenance_actual_current / $profit_loss['jakarta']['total']['income']['actual']['current']) * 100); @endphp
											{{ round(($total_fee_maintenance_actual_current / $profit_loss['jakarta']['total']['income']['actual']['current']) * 100) }}%
											@else
											@php $total['fee_actual_percent_current'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_maintenance_variance_current) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_fee_maintenance_budget > 0)
											{{ round(($total_fee_maintenance_variance_current / $total_fee_maintenance_budget) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_maintenance_actual_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['income']['actual']['last'] > 0)
											@php $total['fee_actual_percent_last'] += round(($total_fee_maintenance_actual_last / $profit_loss['jakarta']['total']['income']['actual']['last']) * 100); @endphp
											{{ round(($total_fee_maintenance_actual_last / $profit_loss['jakarta']['total']['income']['actual']['last']) * 100) }}%
											@else
											@php $total['fee_actual_percent_last'] += 0; @endphp
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($total_fee_maintenance_variance_last) }}</th>
										<th class="text-center font-weight-bold">
											@if($total_fee_maintenance_actual_last > 0)
											{{ round(($total_fee_maintenance_variance_last / $total_fee_maintenance_actual_last) * 100) }}%
											@else
											0%
											@endif
										</th>
									</tr>
									<tr class="bg-info-300 text-uppercase">
										<th class="text-left font-weight-bold">Total Variable Cost</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['jakarta']['total']['fee']['budget']) }}</th>
										<th class="text-center font-weight-bold">{{ $total['fee_budget_percent'] }}%</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['jakarta']['total']['fee']['actual']['current']) }}</th>
										<th class="text-center font-weight-bold">{{ $total['fee_actual_percent_current'] }}%</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['jakarta']['total']['fee']['variance']['current']) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['fee']['budget'] > 0)
											{{ round(($profit_loss['jakarta']['total']['fee']['variance']['current'] / $profit_loss['jakarta']['total']['fee']['budget']) * 100) }}%
											@else
											0%
											@endif
										</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['jakarta']['total']['fee']['actual']['last']) }}</th>
										<th class="text-center font-weight-bold">{{ $total['fee_actual_percent_last'] }}%</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['jakarta']['total']['fee']['variance']['last']) }}</th>
										<th class="text-center font-weight-bold">
											@if($profit_loss['jakarta']['total']['fee']['actual']['last'] > 0)
											{{ round(($profit_loss['jakarta']['total']['fee']['variance']['last'] / $profit_loss['jakarta']['total']['fee']['actual']['last']) * 100) }}%
											@else
											0%
											@endif
										</th>
									</tr>
									<tr><td colspan="12"></td></tr>
									<tr class="bg-success-300 text-uppercase">
										<th class="text-left font-weight-bold">Nett Profit (Loss)</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['jakarta']['grandtotal']['nett']['budget']['nominal']) }}</th>
										<th class="text-center font-weight-bold">{{ $profit_loss['jakarta']['grandtotal']['nett']['budget']['percent'] }}%</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['jakarta']['grandtotal']['nett']['actual']['current']['nominal']) }}</th>
										<th class="text-center font-weight-bold">{{ $profit_loss['jakarta']['grandtotal']['nett']['actual']['current']['percent'] }}%</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['jakarta']['grandtotal']['nett']['variance']['current']['nominal']) }}</th>
										<th class="text-center font-weight-bold">{{ $profit_loss['jakarta']['grandtotal']['nett']['variance']['current']['percent'] }}%</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['jakarta']['grandtotal']['nett']['actual']['last']['nominal']) }}</th>
										<th class="text-center font-weight-bold">{{ $profit_loss['jakarta']['grandtotal']['nett']['actual']['last']['percent'] }}%</th>
										<th class="text-right font-weight-bold">{{ number_format($profit_loss['jakarta']['grandtotal']['nett']['variance']['last']['nominal']) }}</th>
										<th class="text-center font-weight-bold">{{ $profit_loss['jakarta']['grandtotal']['nett']['variance']['last']['percent'] }}%</th>
									</tr>
								</tbody>
								</table>
							</div>
						</p>
					</div>
					<div class="tab-pane fade" id="solid-bordered-justified-tab4">
					@php
						$total['income_actual_percent_current'] = 0;
						$total['income_actual_percent_last']    = 0;
						$total['income_budget_percent']         = 0;
						$total['fee_actual_percent_current']    = 0;
						$total['fee_actual_percent_last']       = 0;
						$total['fee_budget_percent']            = 0;
					@endphp
					<p class="mt-3">
						<div class="table-responsive">
							<table class="table table-sm table-bordered">
							<thead>
								<tr class="text-center">
									<th rowspan="2" class="bg-grey">Description</th>
									<th colspan="6" class="bg-primary">Current Month</th>
									<th colspan="4" class="bg-primary">Last Month</th>
								</tr>
								<tr class="text-center">
									<th class="bg-grey">Budget</th>
									<th class="bg-grey">%</th>
									<th class="bg-grey">Actual</th>
									<th class="bg-grey">%</th>
									<th class="bg-grey">Variance</th>
									<th class="bg-grey">%</th>
									<th class="bg-grey">Actual</th>
									<th class="bg-grey">%</th>
									<th class="bg-grey">Variance</th>
									<th class="bg-grey">%</th>
								</tr>
							</thead>
							<tbody>
								<tr class="font-weight-bold">
									<th colspan="12">Depreciation & Amor</th>
								</tr>
								@php
									$total_depreciation_actual_current   = 0;
									$total_depreciation_budget           = 0;
									$total_depreciation_variance_current = 0;
									$total_depreciation_actual_last      = 0;
									$total_depreciation_variance_last    = 0;
								@endphp
								@foreach($profit_loss['non_operation']['depreciation'] as $d)
									@php
										$total_depreciation_actual_current   += $d['actual']['current'];
										$total_depreciation_budget           += $d['budget'];
										$total_depreciation_variance_current += $d['variance']['nominal']['current'];
										$total_depreciation_actual_last      += $d['actual']['last'];
										$total_depreciation_variance_last    += $d['variance']['nominal']['last'];
									@endphp
									<tr>
										<td class="text-left"><span class="ml-2">{{ $d['name'] }}</span></td>
										<td class="text-right">{{ number_format($d['budget']) }}</td>
										<td class="text-center">
										@if($profit_loss['non_operation']['total']['non_operation']['budget'] > 0)
											{{ round(($d['budget'] / $profit_loss['non_operation']['total']['non_operation']['budget']) * 100) }}%
										@else
											0%
										@endif
										</td>
										<td class="text-right">{{ number_format($d['actual']['current']) }}</td>
										<td class="text-center">
										@if($profit_loss['non_operation']['total']['non_operation']['actual']['current'] > 0)
											{{ round(($d['actual']['current'] / $profit_loss['non_operation']['total']['non_operation']['actual']['current']) * 100) }}%
										@else
											0%
										@endif
										</td>
										<td class="text-right">{{ number_format($d['variance']['nominal']['current']) }}</td>
										<td class="text-center">{{ number_format($d['variance']['percent']['current']) }}%</td>
										<td class="text-right">{{ number_format($d['actual']['last']) }}</td>
										<td class="text-center">
										@if($profit_loss['non_operation']['total']['non_operation']['actual']['last'] > 0)
											{{ round(($d['actual']['last'] / $profit_loss['non_operation']['total']['non_operation']['actual']['last']) * 100) }}%
										@else
											0%
										@endif
										</td>
										<td class="text-right">{{ number_format($d['variance']['nominal']['last']) }}</td>
										<td class="text-center">{{ number_format($d['variance']['percent']['last']) }}%</td>
									</tr>
								@endforeach
								<tr class="table-secondary font-italic">
									<th class="text-right font-weight-bold">Total Depreciation & Amor</th>
									<th class="text-right font-weight-bold">{{ number_format($total_depreciation_budget) }}</th>
									<th class="text-center font-weight-bold">
										@if($profit_loss['non_operation']['total']['non_operation']['budget'] > 0)
										@php $total['income_budget_percent'] = round(($total_depreciation_budget / $profit_loss['non_operation']['total']['non_operation']['budget']) * 100); @endphp
										{{ round(($total_depreciation_budget / $profit_loss['non_operation']['total']['non_operation']['budget']) * 100) }}%
										@else
										0%
										@endif
									</th>
									<th class="text-right font-weight-bold">{{ number_format($total_depreciation_actual_current) }}</th>
									<th class="text-center font-weight-bold">
										@if($profit_loss['non_operation']['total']['non_operation']['actual']['current'] > 0)
										@php $total['income_actual_percent_current'] = round(($total_depreciation_actual_current / $profit_loss['non_operation']['total']['non_operation']['actual']['current']) * 100); @endphp
										{{ round(($total_depreciation_actual_current / $profit_loss['non_operation']['total']['non_operation']['actual']['current']) * 100) }}%
										@else
										0%
										@endif
									</th>
									<th class="text-right font-weight-bold">{{ number_format($total_depreciation_variance_current) }}</th>
									<th class="text-center font-weight-bold">
										@if($total_depreciation_budget > 0)
										{{ round(($total_depreciation_variance_current / $total_depreciation_budget) * 100) }}%
										@else
										0%
										@endif
									</th>
									<th class="text-right font-weight-bold">{{ number_format($total_depreciation_actual_last) }}</th>
									<th class="text-center font-weight-bold">
										@if($profit_loss['non_operation']['total']['non_operation']['actual']['last'] > 0)
										@php $total['income_actual_percent_last'] = round(($total_depreciation_actual_last / $profit_loss['non_operation']['total']['non_operation']['actual']['last']) * 100); @endphp
										{{ round(($total_depreciation_actual_last / $profit_loss['non_operation']['total']['non_operation']['actual']['last']) * 100) }}%
										@else
										0%
										@endif
									</th>
									<th class="text-right font-weight-bold">{{ number_format($total_depreciation_variance_last) }}</th>
									<th class="text-center font-weight-bold">
										@if($total_depreciation_actual_last > 0)
										{{ round(($total_depreciation_variance_last / $total_depreciation_actual_last) * 100) }}%
										@else
										0%
										@endif
									</th>
								</tr>
								<tr class="font-weight-bold">
									<th colspan="12">Other Income</th>
								</tr>
								@php
									$total_other_income_actual_current   = 0;
									$total_other_income_budget           = 0;
									$total_other_income_variance_current = 0;
									$total_other_income_actual_last      = 0;
									$total_other_income_variance_last    = 0;
								@endphp
								@foreach($profit_loss['non_operation']['other_income'] as $oi)
									@php
										$total_other_income_actual_current   += $oi['actual']['current'];
										$total_other_income_budget           += $oi['budget'];
										$total_other_income_variance_current += $oi['variance']['nominal']['current'];
										$total_other_income_actual_last      += $oi['actual']['last'];
										$total_other_income_variance_last    += $oi['variance']['nominal']['last'];
									@endphp
									<tr>
										<td class="text-left"><span class="ml-2">{{ $oi['name'] }}</span></td>
										<td class="text-right">{{ number_format($oi['budget']) }}</td>
										<td class="text-center">
										@if($profit_loss['non_operation']['total']['non_operation']['budget'] > 0)
											{{ round(($oi['budget'] / $profit_loss['non_operation']['total']['non_operation']['budget']) * 100) }}%
										@else
											0%
										@endif
										</td>
										<td class="text-right">{{ number_format($oi['actual']['current']) }}</td>
										<td class="text-center">
										@if($profit_loss['non_operation']['total']['non_operation']['actual']['current'] > 0)
											{{ round(($oi['actual']['current'] / $profit_loss['non_operation']['total']['non_operation']['actual']['current']) * 100) }}%
										@else
											0%
										@endif
										</td>
										<td class="text-right">{{ number_format($oi['variance']['nominal']['current']) }}</td>
										<td class="text-center">{{ number_format($oi['variance']['percent']['current']) }}%</td>
										<td class="text-right">{{ number_format($oi['actual']['last']) }}</td>
										<td class="text-center">
										@if($profit_loss['non_operation']['total']['non_operation']['actual']['last'] > 0)
											{{ round(($oi['actual']['last'] / $profit_loss['non_operation']['total']['non_operation']['actual']['last']) * 100) }}%
										@else
											0%
										@endif
										</td>
										<td class="text-right">{{ number_format($oi['variance']['nominal']['last']) }}</td>
										<td class="text-center">{{ number_format($oi['variance']['percent']['last']) }}%</td>
									</tr>
								@endforeach
								<tr class="table-secondary font-italic">
									<th class="text-right font-weight-bold">Total Other Income</th>
									<th class="text-right font-weight-bold">{{ number_format($total_other_income_budget) }}</th>
									<th class="text-center font-weight-bold">
										@if($profit_loss['non_operation']['total']['non_operation']['budget'] > 0)
										{{ round(($total_other_income_budget / $profit_loss['non_operation']['total']['non_operation']['budget']) * 100) }}%
										@else
										0%
										@endif
									</th>
									<th class="text-right font-weight-bold">{{ number_format($total_other_income_actual_current) }}</th>
									<th class="text-center font-weight-bold">
										@if($profit_loss['non_operation']['total']['non_operation']['actual']['current'] > 0)
										{{ round(($total_other_income_actual_current / $profit_loss['non_operation']['total']['non_operation']['actual']['current']) * 100) }}%
										@else
										0%
										@endif
									</th>
									<th class="text-right font-weight-bold">{{ number_format($total_other_income_variance_current) }}</th>
									<th class="text-center font-weight-bold">
										@if($total_other_income_budget > 0)
										{{ round(($total_other_income_variance_current / $total_other_income_budget) * 100) }}%
										@else
										0%
										@endif
									</th>
									<th class="text-right font-weight-bold">{{ number_format($total_other_income_actual_last) }}</th>
									<th class="text-center font-weight-bold">
										@if($profit_loss['non_operation']['total']['non_operation']['actual']['last'] > 0)
										{{ round(($total_other_income_actual_last / $profit_loss['non_operation']['total']['non_operation']['actual']['last']) * 100) }}%
										@else
										0%
										@endif
									</th>
									<th class="text-right font-weight-bold">{{ number_format($total_other_income_variance_last) }}</th>
									<th class="text-center font-weight-bold">
										@if($total_other_income_actual_last > 0)
										{{ round(($total_other_income_variance_last / $total_other_income_actual_last) * 100) }}%
										@else
										0%
										@endif
									</th>
								</tr>
								<tr class="font-weight-bold">
									<th colspan="12">Other Deduction</th>
								</tr>
								@php
									$total_other_deduction_actual_current   = 0;
									$total_other_deduction_budget           = 0;
									$total_other_deduction_variance_current = 0;
									$total_other_deduction_actual_last      = 0;
									$total_other_deduction_variance_last    = 0;
								@endphp
								@foreach($profit_loss['non_operation']['other_deduction'] as $od)
									@php
										$total_other_deduction_actual_current   += $od['actual']['current'];
										$total_other_deduction_budget           += $od['budget'];
										$total_other_deduction_variance_current += $od['variance']['nominal']['current'];
										$total_other_deduction_actual_last      += $od['actual']['last'];
										$total_other_deduction_variance_last    += $od['variance']['nominal']['last'];
									@endphp
									<tr>
										<td class="text-left"><span class="ml-2">{{ $od['name'] }}</span></td>
										<td class="text-right">{{ number_format($od['budget']) }}</td>
										<td class="text-center">
										@if($profit_loss['non_operation']['total']['non_operation']['budget'] > 0)
											{{ round(($od['budget'] / $profit_loss['non_operation']['total']['non_operation']['budget']) * 100) }}%
										@else
											0%
										@endif
										</td>
										<td class="text-right">{{ number_format($od['actual']['current']) }}</td>
										<td class="text-center">
										@if($profit_loss['non_operation']['total']['non_operation']['actual']['current'] > 0)
											{{ round(($oi['actual']['current'] / $profit_loss['non_operation']['total']['non_operation']['actual']['current']) * 100) }}%
										@else
											0%
										@endif
										</td>
										<td class="text-right">{{ number_format($od['variance']['nominal']['current']) }}</td>
										<td class="text-center">{{ number_format($od['variance']['percent']['current']) }}%</td>
										<td class="text-right">{{ number_format($od['actual']['last']) }}</td>
										<td class="text-center">
										@if($profit_loss['non_operation']['total']['non_operation']['actual']['last'] > 0)
											{{ round(($od['actual']['last'] / $profit_loss['non_operation']['total']['non_operation']['actual']['last']) * 100) }}%
										@else
											0%
										@endif
										</td>
										<td class="text-right">{{ number_format($od['variance']['nominal']['last']) }}</td>
										<td class="text-center">{{ number_format($od['variance']['percent']['last']) }}%</td>
									</tr>
								@endforeach
								<tr class="table-secondary font-italic">
									<th class="text-right font-weight-bold">Total Other Deduction</th>
									<th class="text-right font-weight-bold">{{ number_format($total_other_deduction_budget) }}</th>
									<th class="text-center font-weight-bold">
										@if($profit_loss['non_operation']['total']['non_operation']['budget'] > 0)
										{{ round(($total_other_deduction_budget / $profit_loss['non_operation']['total']['non_operation']['budget']) * 100) }}%
										@else
										0%
										@endif
									</th>
									<th class="text-right font-weight-bold">{{ number_format($total_other_deduction_actual_current) }}</th>
									<th class="text-center font-weight-bold">
										@if($profit_loss['non_operation']['total']['non_operation']['actual']['current'] > 0)
										{{ round(($total_other_deduction_actual_current / $profit_loss['non_operation']['total']['non_operation']['actual']['current']) * 100) }}%
										@else
										0%
										@endif
									</th>
									<th class="text-right font-weight-bold">{{ number_format($total_other_deduction_variance_current) }}</th>
									<th class="text-center font-weight-bold">
										@if($total_other_deduction_budget > 0)
										{{ round(($total_other_deduction_variance_current / $total_other_deduction_budget) * 100) }}%
										@else
										0%
										@endif
									</th>
									<th class="text-right font-weight-bold">{{ number_format($total_other_deduction_actual_last) }}</th>
									<th class="text-center font-weight-bold">
										@if($profit_loss['non_operation']['total']['non_operation']['actual']['last'] > 0)
										{{ round(($total_other_deduction_actual_last / $profit_loss['non_operation']['total']['non_operation']['actual']['last']) * 100) }}%
										@else
										0%
										@endif
									</th>
									<th class="text-right font-weight-bold">{{ number_format($total_other_deduction_variance_last) }}</th>
									<th class="text-center font-weight-bold">
										@if($total_other_deduction_actual_last > 0)
										{{ round(($total_other_deduction_variance_last / $total_other_deduction_actual_last) * 100) }}%
										@else
										0%
										@endif
									</th>
								</tr>
								<tr><td colspan="12"></td></tr>
								<tr class="bg-info-300 text-uppercase">
									<th class="text-left font-weight-bold">Total Income & Deduction</th>
									<th class="text-right font-weight-bold">{{ number_format($profit_loss['non_operation']['total']['income_deduction']['budget']) }}</th>
									<th class="text-center font-weight-bold">
										@if($profit_loss['non_operation']['total']['non_operation']['budget'] > 0)
										@php $total['income_budget_percent'] = round(($profit_loss['non_operation']['total']['income_deduction']['budget'] / $profit_loss['non_operation']['total']['non_operation']['budget']) * 100); @endphp
										{{ round(($profit_loss['non_operation']['total']['income_deduction']['budget'] / $profit_loss['non_operation']['total']['non_operation']['budget']) * 100) }}%
										@else
										0%
										@endif
									</th>
									<th class="text-right font-weight-bold">{{ number_format($profit_loss['non_operation']['total']['income_deduction']['actual']['current']) }}</th>
									<th class="text-center font-weight-bold">
										@if($profit_loss['non_operation']['total']['non_operation']['actual']['current'] > 0)
										@php $total['income_actual_percent_current'] = round(($profit_loss['non_operation']['total']['income_deduction']['actual']['current'] / $profit_loss['non_operation']['total']['non_operation']['actual']['current']) * 100); @endphp
										{{ round(($profit_loss['non_operation']['total']['income_deduction']['actual']['current'] / $profit_loss['non_operation']['total']['non_operation']['actual']['current']) * 100) }}%
										@else
										0%
										@endif
									</th>
									<th class="text-right font-weight-bold">{{ number_format($profit_loss['non_operation']['total']['income_deduction']['variance']['current']) }}</th>
									<th class="text-center font-weight-bold">
										@if($profit_loss['non_operation']['total']['income_deduction']['budget'] > 0)
										{{ round(($profit_loss['non_operation']['total']['income_deduction']['actual']['current'] / $profit_loss['non_operation']['total']['income_deduction']['budget']) * 100) }}%
										@else
										0%
										@endif
									</th>
									<th class="text-right font-weight-bold">{{ number_format($profit_loss['non_operation']['total']['income_deduction']['actual']['last']) }}</th>
									<th class="text-center font-weight-bold">
										@if($profit_loss['non_operation']['total']['income_deduction']['budget'] > 0)
										@php $total['income_actual_percent_last'] = round(($profit_loss['non_operation']['total']['income_deduction']['actual']['last'] / $profit_loss['non_operation']['total']['income_deduction']['budget']) * 100); @endphp
										{{ round(($profit_loss['non_operation']['total']['income_deduction']['actual']['last'] / $profit_loss['non_operation']['total']['income_deduction']['budget']) * 100) }}%
										@else
										0%
										@endif
									</th>
									<th class="text-right font-weight-bold">{{ number_format($profit_loss['non_operation']['total']['income_deduction']['variance']['last']) }}</th>
									<th class="text-center font-weight-bold">
										@if($profit_loss['non_operation']['total']['income_deduction']['actual']['last'] > 0)
										{{ round(($profit_loss['non_operation']['total']['income_deduction']['variance']['last'] / $profit_loss['non_operation']['total']['income_deduction']['actual']['last']) * 100) }}%
										@else
										0%
										@endif
									</th>
								</tr>
								<tr><td colspan="12"></td></tr>
								<tr class="bg-success-300 text-uppercase">
									<th class="text-left font-weight-bold">Total Non Operation</th>
									<th class="text-right font-weight-bold">{{ number_format($profit_loss['non_operation']['total']['non_operation']['budget']) }}</th>
									<th class="text-center font-weight-bold">
										{{ $total['income_budget_percent'] }}%
									</th>
									<th class="text-right font-weight-bold">{{ number_format($profit_loss['non_operation']['total']['non_operation']['actual']['current']) }}</th>
									<th class="text-center font-weight-bold">
										{{ $total['income_actual_percent_current'] }}%
									</th>
									<th class="text-right font-weight-bold">
										{{ number_format($profit_loss['non_operation']['total']['non_operation']['variance']['current']) }}
									</th>
									<th class="text-center font-weight-bold">
										@if($profit_loss['non_operation']['total']['non_operation']['budget'] > 0)
										{{ round(($profit_loss['non_operation']['total']['non_operation']['variance']['current'] / $profit_loss['non_operation']['total']['non_operation']['budget']) * 100) }}%
										@else
										0%
										@endif
									</th>
									<th class="text-right font-weight-bold">{{ number_format($profit_loss['non_operation']['total']['non_operation']['actual']['last']) }}</th>
									<th class="text-center font-weight-bold">
										{{ $total['income_actual_percent_last'] }}%
									</th>
									<th class="text-right font-weight-bold">{{ number_format($profit_loss['non_operation']['total']['non_operation']['variance']['last']) }}</th>
									<th class="text-center font-weight-bold">
										@if($profit_loss['non_operation']['total']['non_operation']['actual']['last'] > 0)
										{{ round(($profit_loss['non_operation']['total']['non_operation']['variance']['last'] / $profit_loss['non_operation']['total']['non_operation']['actual']['last']) * 100) }}%
										@else
										0%
										@endif
									</th>
								</tr>
							</tbody>
							</table>
						</div>
					</p>
				</div>
				</div>
			</div>
		</div>
	</div>

<script>
   $(function() {
	  $('.sidebar-main-toggle').click();
   });

   function submitFilter() {
	  loadingOpen('.content');
	  $('#form_filter').submit();
   }
</script>
