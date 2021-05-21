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
                  <a href="#solid-bordered-justified-tab1" class="nav-link active" data-toggle="tab">Summary</a>
               </li>
               <li class="nav-item">
                  <a href="#solid-bordered-justified-tab2" class="nav-link" data-toggle="tab">Surabaya</a>
               </li>
               <li class="nav-item">
                  <a href="#solid-bordered-justified-tab3" class="nav-link" data-toggle="tab">Jakarta</a>
               </li>
               <li class="nav-item">
                  <a href="#solid-bordered-justified-tab4" class="nav-link" data-toggle="tab">Non Operating</a>
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
                              <tr class="font-weight-bold">
                                 <th colspan="12">INCOME</th>
                              </tr>
                              <tr class="font-weight-bold">
                                 <th colspan="12">Sale</th>
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
                                    <td class="text-left">{{ $s['name'] }}</td>   
                                    <td class="text-right">{{ number_format($s['actual']['current']) }}</td>   
                                    <td class="text-center">
                                       @if($s['actual']['current'] > 0 && $profit_loss['summary']['total']['income']['actual']['current'] > 0) 
                                          {{ round($s['actual']['current'] / $profit_loss['summary']['total']['income']['current']) }}%
                                       @else
                                          0%
                                       @endif  
                                    </td>  
                                    <td class="text-right">{{ number_format($s['budget']) }}</td>   
                                    <td class="text-center">
                                       @if($s['budget'] > 0 && $profit_loss['summary']['total']['income']['budget'] > 0) 
                                          {{ round($s['budget'] / $profit_loss['summary']['total']['budget']) }}%
                                       @else
                                          0%
                                       @endif     
                                    </td> 
                                    <td class="text-right">{{ number_format($s['variance']['nominal']['current']) }}</td>   
                                    <td class="text-center">{{ number_format($s['variance']['percent']['current']) }}%</td> 
                                    <td class="text-right">{{ number_format($s['actual']['last']) }}</td>  
                                    <td class="text-center">
                                       @if($s['actual']['last'] > 0 && $profit_loss['summary']['total']['income']['actual']['last'] > 0) 
                                          {{ round($s['actual']['last'] / $profit_loss['summary']['total']['income']['last']) }}%
                                       @else
                                          0%
                                       @endif  
                                    </td>  
                                    <td class="text-right">{{ number_format($s['variance']['nominal']['last']) }}</td>   
                                    <td class="text-center">{{ number_format($s['variance']['percent']['last']) }}%</td> 
                                 </tr> 
                              @endforeach
                              <tr class="table-secondary font-italic">
                                 <th class="text-right font-weight-bold">Total Sale</th>
                                 <th class="text-right font-weight-bold">{{ number_format($total_sale_actual_current) }}</th>
                                 <th class="text-center font-weight-bold">
                                    @if($total_sale_actual_current > 0 && $profit_loss['summary']['total']['income']['actual']['current'] > 0) 
                                       {{ round($total_sale_actual_current / $profit_loss['summary']['total']['income']['current']) }}%
                                    @else
                                       0%
                                    @endif     
                                 </th>
                                 <th class="text-right font-weight-bold">{{ number_format($total_sale_budget) }}</th>   
                                 <th class="text-center font-weight-bold">
                                    @if($total_sale_budget > 0 && $profit_loss['summary']['total']['income']['budget'] > 0) 
                                       {{ round($total_sale_budget / $profit_loss['summary']['total']['budget']) }}%
                                    @else
                                       0%
                                    @endif     
                                 </th> 
                                 <th class="text-right font-weight-bold">{{ number_format($total_sale_variance_current) }}</th>   
                                 <th class="text-center font-weight-bold">
                                    @if($total_sale_variance_current > 0 && $total_sale_budget > 0) 
                                       {{ round($total_sale_variance_current / $total_sale_budget) }}%
                                    @else
                                       0%
                                    @endif     
                                 </th> 
                                 <th class="text-right font-weight-bold">{{ number_format($total_sale_actual_last) }}</th>   
                                 <th class="text-center font-weight-bold">
                                    @if($total_sale_actual_last > 0 && $profit_loss['summary']['total']['income']['actual']['last'] > 0) 
                                       {{ round($total_sale_actual_last / $profit_loss['summary']['total']['income']['actual']['last']) }}%
                                    @else
                                       0%
                                    @endif     
                                 </th>
                                 <th class="text-right font-weight-bold">{{ number_format($total_sale_variance_last) }}</th>   
                                 <th class="text-center font-weight-bold">
                                    @if($total_sale_variance_last > 0 && $total_sale_actual_last > 0) 
                                       {{ round($total_sale_variance_last / $total_sale_actual_last) }}%
                                    @else
                                       0%
                                    @endif     
                                 </th>
                              </tr>
                              <tr class="font-weight-bold">
                                 <th colspan="12">Sale Service</th>
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
                                    <td class="text-left">{{ $ss['name'] }}</td>   
                                    <td class="text-right">{{ number_format($ss['actual']['current']) }}</td>   
                                    <td class="text-center">
                                       @if($ss['actual']['current'] > 0 && $profit_loss['summary']['total']['income']['actual']['current'] > 0) 
                                          {{ round($ss['actual']['current'] / $profit_loss['summary']['total']['income']['current']) }}%
                                       @else
                                          0%
                                       @endif  
                                    </td>  
                                    <td class="text-right">{{ number_format($ss['budget']) }}</td>   
                                    <td class="text-center">
                                       @if($ss['budget'] > 0 && $profit_loss['summary']['total']['income']['budget'] > 0) 
                                          {{ round($ss['budget'] / $profit_loss['summary']['total']['budget']) }}%
                                       @else
                                          0%
                                       @endif     
                                    </td> 
                                    <td class="text-right">{{ number_format($ss['variance']['nominal']['current']) }}</td>   
                                    <td class="text-center">{{ number_format($ss['variance']['percent']['current']) }}%</td> 
                                    <td class="text-right">{{ number_format($ss['actual']['last']) }}</td>  
                                    <td class="text-center">
                                       @if($ss['actual']['last'] > 0 && $profit_loss['summary']['total']['income']['actual']['last'] > 0) 
                                          {{ round($ss['actual']['last'] / $profit_loss['summary']['total']['income']['last']) }}%
                                       @else
                                          0%
                                       @endif  
                                    </td>  
                                    <td class="text-right">{{ number_format($ss['variance']['nominal']['last']) }}</td>   
                                    <td class="text-center">{{ number_format($ss['variance']['percent']['last']) }}%</td> 
                                 </tr> 
                              @endforeach
                              <tr class="table-secondary font-italic">
                                 <th class="text-right font-weight-bold">Total Sale Service</th>
                                 <th class="text-right font-weight-bold">{{ number_format($total_sale_service_actual_current) }}</th>
                                 <th class="text-center font-weight-bold">
                                    @if($total_sale_service_actual_current > 0 && $profit_loss['summary']['total']['income']['actual']['current'] > 0) 
                                       {{ round($total_sale_service_actual_current / $profit_loss['summary']['total']['income']['current']) }}%
                                    @else
                                       0%
                                    @endif     
                                 </th>
                                 <th class="text-right font-weight-bold">{{ number_format($total_sale_service_budget) }}</th>   
                                 <th class="text-center font-weight-bold">
                                    @if($total_sale_service_budget > 0 && $profit_loss['summary']['total']['income']['budget'] > 0) 
                                       {{ round($total_sale_service_budget / $profit_loss['summary']['total']['budget']) }}%
                                    @else
                                       0%
                                    @endif     
                                 </th> 
                                 <th class="text-right font-weight-bold">{{ number_format($total_sale_service_variance_current) }}</th>   
                                 <th class="text-center font-weight-bold">
                                    @if($total_sale_service_variance_current > 0 && $total_sale_service_budget > 0) 
                                       {{ round($total_sale_service_variance_current / $total_sale_service_budget) }}%
                                    @else
                                       0%
                                    @endif     
                                 </th> 
                                 <th class="text-right font-weight-bold">{{ number_format($total_sale_service_actual_last) }}</th>   
                                 <th class="text-center font-weight-bold">
                                    @if($total_sale_service_actual_last > 0 && $profit_loss['summary']['total']['income']['actual']['last'] > 0) 
                                       {{ round($total_sale_service_actual_last / $profit_loss['summary']['total']['income']['actual']['last']) }}%
                                    @else
                                       0%
                                    @endif     
                                 </th>
                                 <th class="text-right font-weight-bold">{{ number_format($total_sale_service_variance_last) }}</th>   
                                 <th class="text-center font-weight-bold">
                                    @if($total_sale_service_variance_last > 0 && $total_sale_service_actual_last > 0) 
                                       {{ round($total_sale_service_variance_last / $total_sale_service_actual_last) }}%
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