<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Report Balance Sheet</span>
				</h4>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item">Report</a>
					<span class="breadcrumb-item active">Balance Sheet</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="card">
			<div class="card-body">
            <h6 class="text-muted text-uppercase text-center">Periode {{ date('F Y', strtotime($filter)) }}</h6>
            <form action="{{ url('admin/report/balance_sheet') }}" method="GET" id="form_filter">
               @csrf
               <div class="form-group">
                  <center class="d-block">
                     <div class="row justify-content-center no-gutters">
                        <div class="col-md-3">
                           <input type="month" name="filter" id="filter" class="form-control" style="height:32px;" value="{{ $filter }}" onchange="submitFilter()">
                        </div>
                        @if(date('Y-m') != $filter)
                           <div class="col-md-1">
                              <a href="{{ url('admin/report/balance_sheet') }}" class="btn bg-danger btn-sm">Reset</a> 
                           </div>
                        @endif
                     </div>
                  </center>
               </div>
            </form>
            <div class="form-group"><hr></div>
            <div class="row">
               <div class="col-md-6">
                  <div class="card">
                     <div class="card-header bg-white">
                        <h6 class="card-title font-weight-bold text-uppercase">Assets</h6>
                     </div>
                     <div class="card-body">
                        <div class="row border p-1">
                           <div class="col-md-12 text-uppercase font-weight-bolder font-italic">Cash & Bank</div>
                        </div>
                        @foreach($balance_sheet['assets']['cash_bank'] as $cb)
                           <div class="row p-1 border">
                              <div class="col-md-9 font-weight-semibold">{{ $cb['name'] }}</div>
                              <div class="col-md-3">
                                 {{ is_numeric($cb['balance']) ? number_format($cb['balance']) : '' }}
                              </div>
                           </div>
                           @if($cb['sub'])
                              @foreach($cb['sub'] as $s)
                                 <div class="row p-1 border">
                                    <div class="col-md-9"><span class="ml-4">{{ $s['name'] }}</span></div>
                                    <div class="col-md-3">{{ number_format($s['balance']) }}</div>
                                 </div>
                              @endforeach
                           @endif
                        @endforeach
                        <div class="row border p-1">
                           <div class="col-md-9 text-uppercase font-weight-bolder font-italic">Total Cash & Bank</div>
                           <div class="col-md-3 text-right font-weight-bolder font-italic">
                              {{ number_format($balance_sheet['assets']['total']['total_cash_bank']) }}
                           </div>
                        </div>
                        <div class="row border p-1">
                           <div class="col-md-12 text-uppercase font-weight-bolder font-italic">Account Receivable</div>
                        </div>
                        @foreach($balance_sheet['assets']['receivable'] as $r)
                           <div class="row p-1 border">
                              <div class="col-md-9 font-weight-semibold">{{ $r['name'] }}</div>
                              <div class="col-md-3">
                                 {{ is_numeric($r['balance']) ? number_format($r['balance']) : '' }}
                              </div>
                           </div>
                           @if($r['sub'])
                              @foreach($r['sub'] as $s)
                                 <div class="row p-1 border">
                                    <div class="col-md-9"><span class="ml-4">{{ $s['name'] }}</span></div>
                                    <div class="col-md-3">{{ number_format($s['balance']) }}</div>
                                 </div>
                              @endforeach
                           @endif
                        @endforeach
                        <div class="row border p-1">
                           <div class="col-md-9 text-uppercase font-weight-bolder font-italic">Total Account Receivable</div>
                           <div class="col-md-3 text-right font-weight-bolder font-italic">
                              {{ number_format($balance_sheet['assets']['total']['total_receivable']) }}
                           </div>
                        </div>
                        <div class="row border p-1">
                           <div class="col-md-12 text-uppercase font-weight-bolder font-italic">Supply</div>
                        </div>
                        @foreach($balance_sheet['assets']['supply'] as $su)
                           <div class="row p-1 border">
                              <div class="col-md-9 font-weight-semibold">{{ $su['name'] }}</div>
                              <div class="col-md-3">
                                 {{ is_numeric($su['balance']) ? number_format($su['balance']) : '' }}
                              </div>
                           </div>
                           @if($su['sub'])
                              @foreach($su['sub'] as $s)
                                 <div class="row p-1 border">
                                    <div class="col-md-9"><span class="ml-4">{{ $s['name'] }}</span></div>
                                    <div class="col-md-3">{{ number_format($s['balance']) }}</div>
                                 </div>
                              @endforeach
                           @endif
                        @endforeach
                        <div class="row border p-1">
                           <div class="col-md-9 text-uppercase font-weight-bolder font-italic">Total Supply</div>
                           <div class="col-md-3 text-right font-weight-bolder font-italic">
                              {{ number_format($balance_sheet['assets']['total']['total_supply']) }}
                           </div>
                        </div>
                        <div class="row border p-1">
                           <div class="col-md-12 text-uppercase font-weight-bolder font-italic">Assets Facile</div>
                        </div>
                        @foreach($balance_sheet['assets']['assets_facile'] as $af)
                           <div class="row p-1 border">
                              <div class="col-md-9 font-weight-semibold">{{ $af['name'] }}</div>
                              <div class="col-md-3">
                                 {{ is_numeric($af['balance']) ? number_format($af['balance']) : '' }}
                              </div>
                           </div>
                           @if($af['sub'])
                              @foreach($af['sub'] as $s)
                                 <div class="row p-1 border">
                                    <div class="col-md-9"><span class="ml-4">{{ $s['name'] }}</span></div>
                                    <div class="col-md-3">{{ number_format($s['balance']) }}</div>
                                 </div>
                              @endforeach
                           @endif
                        @endforeach
                        <div class="row border p-1">
                           <div class="col-md-9 text-uppercase font-weight-bolder font-italic">Total Assets Facile</div>
                           <div class="col-md-3 text-right font-weight-bolder font-italic">
                              {{ number_format($balance_sheet['assets']['total']['total_assets_facile']) }}
                           </div>
                        </div>
                        <div class="row border p-1">
                           <div class="col-md-12 text-uppercase font-weight-bolder font-italic">Assets Consistenly</div>
                        </div>
                        @foreach($balance_sheet['assets']['assets_consistenly'] as $ac)
                           <div class="row p-1 border">
                              <div class="col-md-9 font-weight-semibold">{{ $ac['name'] }}</div>
                              <div class="col-md-3">
                                 {{ is_numeric($ac['balance']) ? number_format($ac['balance']) : '' }}
                              </div>
                           </div>
                           @if($ac['sub'])
                              @foreach($ac['sub'] as $s)
                                 <div class="row p-1 border">
                                    <div class="col-md-9"><span class="ml-4">{{ $s['name'] }}</span></div>
                                    <div class="col-md-3">{{ number_format($s['balance']) }}</div>
                                 </div>
                              @endforeach
                           @endif
                        @endforeach
                        <div class="row border p-1">
                           <div class="col-md-9 text-uppercase font-weight-bolder font-italic">Total Assets Consistenly</div>
                           <div class="col-md-3 text-right font-weight-bolder font-italic">
                              {{ number_format($balance_sheet['assets']['total']['total_assets_consistenly']) }}
                           </div>
                        </div>
                        <div class="row border p-1">
                           <div class="col-md-12 text-uppercase font-weight-bolder font-italic">Accumulated Shrinkage</div>
                        </div>
                        @foreach($balance_sheet['assets']['accumulated_shrinkage'] as $as)
                           <div class="row p-1 border">
                              <div class="col-md-9 font-weight-semibold">{{ $as['name'] }}</div>
                              <div class="col-md-3">
                                 {{ is_numeric($as['balance']) ? $as['balance'] : '' }}
                              </div>
                           </div>
                           @if($as['sub'])
                              @foreach($as['sub'] as $s)
                                 <div class="row p-1 border">
                                    <div class="col-md-9"><span class="ml-4">{{ $s['name'] }}</span></div>
                                    <div class="col-md-3">{{ number_format($s['balance']) }}</div>
                                 </div>
                              @endforeach
                           @endif
                        @endforeach
                        <div class="row border p-1">
                           <div class="col-md-9 text-uppercase font-weight-bolder font-italic">Total Accumulated Shrinkage</div>
                           <div class="col-md-3 text-right font-weight-bolder font-italic">
                              {{ number_format($balance_sheet['assets']['total']['total_accumulated_shrinkage']) }}
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="card" style="height:2408px;">
                     <div class="card-header bg-white">
                        <h6 class="card-title font-weight-bold text-uppercase">Responbility & Equity</h6>
                     </div>
                     <div class="card-body">
                        <div class="row border p-1">
                           <div class="col-md-12 text-uppercase font-weight-bolder font-italic">Debt</div>
                        </div>
                        @foreach($balance_sheet['responbility_equity']['debt'] as $d)
                           <div class="row p-1 border">
                              <div class="col-md-9 font-weight-semibold">{{ $d['name'] }}</div>
                              <div class="col-md-3">
                                 {{ is_numeric($d['balance']) ? $d['balance'] : '' }}
                              </div>
                           </div>
                           @if($d['sub'])
                              @foreach($d['sub'] as $s)
                                 <div class="row p-1 border">
                                    <div class="col-md-9"><span class="ml-4">{{ $s['name'] }}</span></div>
                                    <div class="col-md-3">{{ number_format($s['balance']) }}</div>
                                 </div>
                              @endforeach
                           @endif
                        @endforeach
                        <div class="row border p-1">
                           <div class="col-md-9 text-uppercase font-weight-bolder font-italic">Total Debt</div>
                           <div class="col-md-3 text-right font-weight-bolder font-italic">
                              {{ number_format($balance_sheet['responbility_equity']['total']['total_debt']) }}
                           </div>
                        </div>
                        <div class="row border p-1">
                           <div class="col-md-12 text-uppercase font-weight-bolder font-italic">Responbility</div>
                        </div>
                        @foreach($balance_sheet['responbility_equity']['responbility'] as $r)
                           <div class="row p-1 border">
                              <div class="col-md-9 font-weight-semibold">{{ $r['name'] }}</div>
                              <div class="col-md-3">
                                 {{ is_numeric($r['balance']) ? number_format($r['balance']) : '' }}
                              </div>
                           </div>
                           @if($r['sub'])
                              @foreach($r['sub'] as $s)
                                 <div class="row p-1 border">
                                    <div class="col-md-9"><span class="ml-4">{{ $s['name'] }}</span></div>
                                    <div class="col-md-3">{{ number_format($s['balance']) }}</div>
                                 </div>
                              @endforeach
                           @endif
                        @endforeach
                        <div class="row border p-1">
                           <div class="col-md-9 text-uppercase font-weight-bolder font-italic">Total Responbility</div>
                           <div class="col-md-3 text-right font-weight-bolder font-italic">
                              {{ number_format($balance_sheet['responbility_equity']['total']['total_responbility']) }}
                           </div>
                        </div>
                        <div class="row border p-1">
                           <div class="col-md-12 text-uppercase font-weight-bolder font-italic">Equity</div>
                        </div>
                        @foreach($balance_sheet['responbility_equity']['equity'] as $e)
                           <div class="row p-1 border">
                              <div class="col-md-9 font-weight-semibold">{{ $e['name'] }}</div>
                              <div class="col-md-3">
                                 {{ is_numeric($e['balance']) ? number_format($e['balance']) : '' }}
                              </div>
                           </div>
                           @if($e['sub'])
                              @foreach($e['sub'] as $s)
                                 <div class="row p-1 border">
                                    <div class="col-md-9"><span class="ml-4">{{ $s['name'] }}</span></div>
                                    <div class="col-md-3">{{ number_format($s['balance']) }}</div>
                                 </div>
                              @endforeach
                           @endif
                        @endforeach
                        <div class="row border p-1">
                           <div class="col-md-9 text-uppercase font-weight-bolder font-italic">Total Equity</div>
                           <div class="col-md-3 text-right font-weight-bolder font-italic">
                              {{ number_format($balance_sheet['responbility_equity']['total']['total_equity']) }}
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="row p-2">
                     <div class="col-md-6">
                        <div class="row p-1 border border">
                           <div class="col-md-8 text-uppercase font-weight-bold">Total Assets</div>
                           <div class="col-md-4 font-weight-bold">
                              {{ number_format(collect($balance_sheet['assets']['total'])->flatten()->sum()) }}
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="row p-1 border border">
                           <div class="col-md-8 text-uppercase font-weight-bold">Total Responbility & Equity</div>
                           <div class="col-md-4 font-weight-bold">
                              {{ number_format(collect($balance_sheet['responbility_equity']['total'])->flatten()->sum()) }}
                           </div>
                        </div>
                     </div>
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