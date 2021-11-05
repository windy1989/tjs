<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Aging Payable</span>
				</h4>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<a href="javascript:void(0);" class="breadcrumb-item">Report</a>
					<a href="javascript:void(0);" class="breadcrumb-item">Accounting</a>
					<span class="breadcrumb-item active">Aging Payable</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="card">
			<div class="card-body">
			<div class="row justify-content-center">
               <div class="col-md-12">
                  <h6 class="text-muted text-uppercase text-center font-weight-bold">
                    Periode {{ date('F Y', strtotime($filter)) }}</h6>
					<form method="GET" id="form_filter">
						@csrf
						<div class="form-group">
							<center class="d-block">
								<div class="row justify-content-center no-gutters">
									<div class="col-md-3">
										<input type="month" name="filter" id="filter" class="form-control"
											style="height:32px;" value="{{ $filter }}" onchange="submitFilter()">
									</div>
									@if (date('Y-m') != $filter)
										<div class="col-md-1">
											<a href="{{ url('admin/report/finance/outstanding_a_r') }}"
												class="btn bg-danger btn-sm">Reset</a>
										</div>
									@endif
								</div>
							</center>
						</div>
					</form>
               </div>
            </div>
			<ul class="nav nav-tabs nav-tabs-solid bg-teal-400 border-0 nav-justified rounded">
				<li class="nav-item"><a href="#colored-rounded-justified-tab1" class="nav-link rounded-left active" data-toggle="tab">Surabaya</a></li>
				<li class="nav-item"><a href="#colored-rounded-justified-tab2" class="nav-link" data-toggle="tab">Jakarta</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade show active" id="colored-rounded-justified-tab1">
					<div class="table-responsive">
					   <table id="datatable_serverside" class="table table-bordered table-striped w-100">
						  <thead class="bg-dark">
							 <tr class="text-center">
								<th>No</th>
								<th>Date</th>
								<th>Code</th>
								<th>Account</th>
								<th>Ref. Cash Bank</th>
								<th>Information</th>
								<th>Debit</th>
								<th>Credit</th>
							 </tr>
						  </thead>
						  <tbody class="text-center">
							@php
								$debit = 0;
								$credit = 0;
							@endphp
							@foreach($resultsby as $key => $row)
								@php
									$debit += $row['debit'];
									$credit += $row['credit'];
								@endphp
								<tr>
									<td>{{ $key+1 }}</td>
									<td>{{ $row['date'] }}</td>
									<td>{{ $row['no'] }}</td>
									<td>{{ $row['name'] }}</td>
									<td><a href="{{ url('admin/delivery_order/project/progress/' . $row['project']) }}">{{ $row['code'] }}</a></td>
									<th>{{ $row['info'] }}</th>
									<td>{{ number_format($row['debit'],2,',','.') }}</td>
									<td>{{ number_format($row['credit'],2,',','.') }}</td>
								</tr>
							@endforeach
						  </tbody>
						  <tfoot>
							<tr class="text-center">
								<th colspan="6">Total</th>
								<th>{{ number_format($debit,2,',','.') }}</th>
								<th>{{ number_format($credit,2,',','.') }}</th>
							</tr>
						  </tfoot>
					   </table>
					</div>
				</div>
				<div class="tab-pane fade" id="colored-rounded-justified-tab2">
					<div class="table-responsive">
						<table id="datatable_serverside" class="table table-bordered table-striped w-100">
						  <thead class="bg-dark">
							 <tr class="text-center">
								<th>No</th>
								<th>Date</th>
								<th>Code</th>
								<th>Account</th>
								<th>Ref. Cash Bank</th>
								<th>Information</th>
								<th>Debit</th>
								<th>Credit</th>
							 </tr>
						  </thead>
						  <tbody class="text-center">
							@php
								$debit = 0;
								$credit = 0;
							@endphp
							@foreach($resultjkt as $key => $row)
								@php
									$debit += $row['debit'];
									$credit += $row['credit'];
								@endphp
								<tr>
									<td>{{ $key+1 }}</td>
									<td>{{ $row['date'] }}</td>
									<td>{{ $row['no'] }}</td>
									<td>{{ $row['name'] }}</td>
									<td><a href="{{ url('admin/delivery_order/project/progress/' . $row['project']) }}">{{ $row['code'] }}</a></td>
									<th>{{ $row['info'] }}</th>
									<td>{{ number_format($row['debit'],2,',','.') }}</td>
									<td>{{ number_format($row['credit'],2,',','.') }}</td>
								</tr>
							@endforeach
						  </tbody>
						  <tfoot>
							<tr class="text-center">
								<th colspan="6">Total</th>
								<th>{{ number_format($debit,2,',','.') }}</th>
								<th>{{ number_format($credit,2,',','.') }}</th>
							</tr>
						  </tfoot>
					   </table>
					</div>
				</div>
			</div>
		</div>
		</div>
	</div>
	<script>
        function submitFilter() {
            loadingOpen('.content');
            $('#form_filter').submit();
        }
    </script>
	