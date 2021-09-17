<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i>
					<span class="font-weight-semibold">Cash & Bank Print</span>
				</h4>
			</div>
			<div class="header-elements">
				<div class="d-flex justify-content-center">
					<a href="{{ url('admin/finance/cash_bank') }}" class="btn bg-secondary btn-labeled btn-labeled-left">
						<b><i class="icon-arrow-left7"></i></b> Back To List
					</a>
				</div>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<a href="javascript:void(0);" class="breadcrumb-item">Finance</a>
					<a href="{{ url('admin/finance/cash_bank') }}" class="breadcrumb-item">Cash & Bank</a>
					<span class="breadcrumb-item active">Print</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 p-3" style="height:133px;">
                        <div class="card-title font-weight-bold text-uppercase mb-0">PT. Perwira Tamaraya Abadi</div>
                        <p class="mb-0">Jl. Baliwerti 119-121 Kav.10, Surabaya, Jawa Timur</p>
                        <p class="mb-0">Surabaya</p>
                        <p class="mb-0">Jawa Timur</p>
                        <p class="mb-0">60174</p>
                    </div>
                    <div class="col-md-8">
                        <div class="card shadow-0">
                            <div class="card-body">
                                <h3 class="card-title text-center font-weight-bold text-uppercase mb-0">
                                    @if($cash_bank->type == 1)
                                        Other Payment
                                    @elseif($cash_bank->type == 2)
                                        Other Deposit
                                    @else
                                        Journal Voucher
                                    @endif
                                </h3>
                                <div class="form-group mb-0"><hr></div>
                                <div class="row text-center">
                                    <div class="col-md-4">Code : <b>{{ $cash_bank->code }}</b></div>
                                    <div class="col-md-4">Date : <b>{{ $cash_bank->created_at->format('d M Y') }}</b></div>
                                    <div class="col-md-4">Amount : <b>{{ number_format($cash_bank->cashBankDetail->sum('nominal'), 2, ',', '.') }}</b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($cash_bank->type == 1)
                        <div class="col-md-12">
                            <div class="card shadow-0">
                                <div class="card-body">
                                    <h6 class="card-title font-weight-bold">Paid From :</h6>
                                    <p class="mb-0">
                                        @foreach($cash_bank->cashBankDetail as $cbd)
                                            <div class="badge badge-light badge-striped badge-striped-left border-left-danger mb-1 mr-1 text-uppercase">[{{ $cbd->coaCredit->code }}] {{ $cbd->coaCredit->name }}</div>
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                        </div>
                    @elseif($cash_bank->type == 2)
                        <div class="col-md-12">
                            <div class="card shadow-0">
                                <div class="card-body">
                                    <h6 class="card-title font-weight-bold">Deposit To :</h6>
                                    <p class="mb-0">
                                        @foreach($cash_bank->cashBankDetail as $cbd)
                                            <div class="badge badge-light badge-striped badge-striped-left border-left-success mb-1 mr-1 text-uppercase">[{{ $cbd->coaDebit->code }}] {{ $cbd->coaDebit->name }}</div>
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-secondary">
                            <tr class="text-center">
                                <th>Account No</th>
                                <th>Account Name</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Memo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @foreach($cash_bank->cashBankDetail as $cbd)
                                @php $total += $cbd->nominal; @endphp
                                @if($cash_bank->type == 1)
                                    <tr class="text-center">
                                        <td class="align-middle">{{ $cbd->coaDebit->code }}</td>
                                        <td class="align-middle">{{ $cbd->coaDebit->name }}</td>
                                        <td class="align-middle">0</td>
                                        <td class="align-middle">{{ number_format($cbd->nominal, 2, ',', '.') }}</td>
                                        <td class="align-middle">{{ $cbd->note }}</td>
                                    </tr>
                                @elseif($cash_bank->type == 2)
                                    <tr class="text-center">
                                        <td class="align-middle">{{ $cbd->coaCredit->code }}</td>
                                        <td class="align-middle">{{ $cbd->coaCredit->name }}</td>
                                        <td class="align-middle">{{ number_format($cbd->nominal, 2, ',', '.') }}</td>
                                        <td class="align-middle">0</td>
                                        <td class="align-middle">{{ $cbd->note }}</td>
                                    </tr>
                                @else
                                    <tr class="text-center">
                                        <td class="align-middle">{{ $cbd->coaDebit->code }}</td>
                                        <td class="align-middle">{{ $cbd->coaDebit->name }}</td>
                                        <td class="align-middle">{{ number_format($cbd->nominal, 2, ',', '.') }}</td>
                                        <td class="align-middle">0</td>
                                        <td class="align-middle">{{ $cbd->note }}</td>
                                    </tr>
                                    <tr class="text-center">
                                        <td class="align-middle">{{ $cbd->coaCredit->code }}</td>
                                        <td class="align-middle">{{ $cbd->coaCredit->name }}</td>
                                        <td class="align-middle">0</td>
                                        <td class="align-middle">{{ number_format($cbd->nominal, 2, ',', '.') }}</td>
                                        <td class="align-middle">{{ $cbd->note }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot class="table-secondary">
                            @if($cash_bank->type == 1 || $cash_bank->type == 2)
                                <tr>
                                    <td colspan="4" class="align-middle">
                                        Say : <span class="font-italic">{{ App\Helper\SMB::say($total) }}</span>
                                    </td>
                                    <td class="align-middle font-weight-bold text-uppercase">
                                        @if($cash_bank->type == 1)
                                            Total Payment : <span class="float-right">{{ number_format($total, 2, ',', '.') }}</span>
                                        @else
                                            Total Deposit : <span class="float-right">{{ number_format($total, 2, ',', '.') }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td colspan="4" rowspan="3" class="align-middle">
                                        Say : <span class="font-italic">{{ App\Helper\SMB::say($total) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle font-weight-bold text-uppercase">
                                        Total Debit : <span class="float-right">{{ number_format($total, 2, ',', '.') }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-middle font-weight-bold text-uppercase">
                                        Total Credit : <span class="float-right">{{ number_format($total, 2, ',', '.') }}</span>
                                    </td>
                                </tr>
                            @endif
                        </tfoot>
                    </table>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h6 class="card-title font-weight-bold text-uppercase">
                            @if($cash_bank->type == 1 || $cash_bank->type == 2)
                                Memo
                            @else
                                Description
                            @endif
                        </h6>
                        <p>{{ $cash_bank->description }}</p>
                    </div>
                </div>
                <div class="row mt-5">
                    @if($cash_bank->type == 1)
                        <div class="col-md-3">
                            <div class="mb-5 text-center">Prepared By</div>
                            <div class="text-center">(........................................)</div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-5 text-center">Approved By</div>
                            <div class="text-center">(........................................)</div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-5 text-center">Paid By</div>
                            <div class="text-center">(........................................)</div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-5 text-center">Received By</div>
                            <div class="text-center">(........................................)</div>
                        </div>
                    @elseif($cash_bank->type == 2)
                        <div class="col-md-3">
                            <div class="mb-5 text-center">Prepared By</div>
                            <div class="text-center">(........................................)</div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-5 text-center">Approved By</div>
                            <div class="text-center">(........................................)</div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-5 text-center">Deposit By</div>
                            <div class="text-center">(........................................)</div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-5 text-center">Received By</div>
                            <div class="text-center">(........................................)</div>
                        </div>
                    @else
                        <div class="col-md-4">
                            <div class="mb-5 text-center">Prepared By</div>
                            <div class="text-center">(........................................)</div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-5 text-center">Reviewed By</div>
                            <div class="text-center">(........................................)</div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-5 text-center">Approved By</div>
                            <div class="text-center">(........................................)</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
	</div>
