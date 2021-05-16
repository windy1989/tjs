<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Report Profit & Loss</span>
				</h4>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item">Report</a>
					<span class="breadcrumb-item active">Profit & Loss</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="card">
			<div class="card-body">
            <h6 class="text-muted text-uppercase text-center">Periode {{ date('F Y', strtotime($filter)) }}</h6>
            <form action="{{ url('admin/report/profit_loss') }}" method="GET" id="form_filter">
               @csrf
               <div class="form-group">
                  <center class="d-block">
                     <div class="row justify-content-center no-gutters">
                        <div class="col-md-3">
                           <input type="month" name="filter" id="filter" class="form-control" style="height:32px;" value="{{ $filter }}" onchange="submitFilter()">
                        </div>
                        @if(date('Y-m') != $filter)
                           <div class="col-md-1">
                              <a href="{{ url('admin/report/profit_loss') }}" class="btn bg-danger btn-sm">Reset</a> 
                           </div>
                        @endif
                     </div>
                  </center>
               </div>
            </form>
            <div class="form-group"><hr></div>
            <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
               <li class="nav-item">
                  <a href="#solid-bordered-justified-tab1" class="nav-link active" data-toggle="tab">Surabaya & Jakarta</a>
               </li>
               <li class="nav-item">
                  <a href="#solid-bordered-justified-tab2" class="nav-link" data-toggle="tab">Non Operating</a>
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
                                 <th class="bg-grey">Actual</th>
                                 <th class="bg-grey">%</th>
                                 <th class="bg-grey">Budget</th>
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
                              <tr>
                                 <td colspan="12" class="font-weight-bold text-uppercase">Income</td>
                              </tr>
                              <tr>
                                 <th colspan="12" class="align-middle font-weight-bold">
                                    {{ $profit_loss['sby_jkt']['income']['sale']['name'] }}
                                 </th>
                              </tr>
                              @foreach($profit_loss['sby_jkt']['income']['sale']['sub'] as $s)
                                 <tr>
                                    <td class="align-middle">{{ $s['name'] }}</td>
                                    <td class="align-middle text-right">{{ number_format($s['current']['actual']) }}</td>
                                    <td class="align-middle text-center">
                                       @if($s['current']['actual'] > 0 && $profit_loss['sby_jkt']['income']['total_actual_current'] > 0)
                                          {{ round($s['current']['actual'] / $profit_loss['sby_jkt']['income']['total_actual_current']) }}%
                                       @else
                                          0%
                                       @endif
                                    </td>
                                    <td class="align-middle text-right">{{ number_format($s['current']['budget']) }}</td>
                                    <td class="align-middle text-center">
                                       @if($s['current']['budget'] > 0 && $profit_loss['sby_jkt']['income']['total_budget'] > 0)
                                          {{ round($s['current']['budget'] / $profit_loss['sby_jkt']['income']['total_budget']) }}%
                                       @else
                                          0%
                                       @endif
                                    </td>
                                    <td class="align-middle text-right">
                                       {{ number_format($s['current']['actual'] - $s['current']['budget']) }}
                                    </td>
                                    <td class="align-middle text-right">
                                       @if($s['current']['actual'] > 0 && $s['current']['budget'] > 0)
                                          {{ round(($s['current']['actual'] - $s['current']['budget']) / $s['current']['budget']) }}%
                                       @else
                                          0%
                                       @endif
                                    </td>
                                    <td class="align-middle text-right">
                                       {{ number_format($s['last']['actual']) }}
                                    </td>
                                    <td class="align-middle text-right">
                                       @if($s['last']['actual'] > 0 && $profit_loss['sby_jkt']['income']['total_actual_last'] > 0)
                                          {{ round($s['last']['actual'] / $profit_loss['sby_jkt']['income']['total_actual_last']) }}%
                                       @else
                                          0%
                                       @endif
                                    </td>
                                    <td class="align-middle text-right">
                                       {{ number_format($s['current']['actual'] - $s['last']['actual']) }}
                                    </td>
                                    <td class="align-middle text-right">
                                       @if($s['current']['actual'] > 0 && $s['last']['actual'] > 0)
                                          {{ round(($s['current']['actual'] - $s['last']['actual']) / $s['last']['actual']) }}%
                                       @else
                                          0%
                                       @endif
                                    </td>
                                 </tr>
                              @endforeach
                              <tr class="table-secondary">
                                 <td class="align-middle font-weight-bold text-right font-italic">Total Sale</td>
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