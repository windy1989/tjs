<div class="content-wrapper">
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4>
                    <i class="icon-arrow-left52 mr-2"></i>
                    <span class="font-weight-semibold">Cash & Bank</span>
                </h4>
            </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
                    <a href="javascript:void(0);" class="breadcrumb-item">Report</a>
                    <a href="javascript:void(0);" class="breadcrumb-item">Accounting</a>
                    <span class="breadcrumb-item active">Cash & Bank</span>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="card">
            <div class="card-body">
                <form method="GET" id="form_filter">
                    @csrf
                    <div class="form-group">
                        <center class="d-block">
                            <div class="row justify-content-center">
                                <div class="col-md-3">
                                    <input type="month" name="filter_month" id="filter_month" class="form-control" style="height:36px;" value="{{ $month }}" onchange="submitFilter()">
                                </div>
                                <div class="col-md-3">
                                    <select name="filter_coa_id" id="filter_coa_id" class="select2" onchange="submitFilter()"  style="height:36px;">
                                        <option value="">All Coa</option>
                                        @foreach($coa as $c)
                                            <option value="{{ $c->id }}" {{ $coa_id == $c->id ? 'selected' : '' }}>[{{ $c->code }}] {{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if(date('Y-m') != $month)
                                    <div class="col-md-1">
                                        <a href="{{ url('admin/report/accounting/cash_bank') }}" class="btn bg-danger" style="height:35px !important;">Reset</a>
                                    </div>
                                @endif
                            </div>
                        </center>
                    </div>
                </form>
                <div class="form-group"><hr></div>
                <div class="text-center mb-4">
                    <h4 class="font-weight-bold text-uppercase">List Account Cash & Bank</h4>
                    <h6 class="text-muted text-uppercase text-center font-weight-bold">Periode {{ date('F Y', strtotime($month)) }}</h6>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-secondary">
                            <tr class="text-center">
                                <th>Account No</th>
                                <th>Account Name</th>
                                <th>Income</th>
                                <th>Expense</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($result as $r)
                                <tr>
                                    <td class="align-middle text-left">{{ $r['no'] }}</td>
                                    <td class="align-middle text-left">{{ $r['name'] }}</td>
                                    <td class="align-middle text-right">{{ number_format($r['debit'], 2, ',', '.') }}</td>
                                    <td class="align-middle text-right">{{ number_format($r['credit'], 2, ',', '.') }}</td>
                                    <td class="align-middle text-right">
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#modal_detail" onclick="showDetail({{ $r['id'] }}, {{ $r['balance'] }});">{{ number_format($r['balance'], 2, ',', '.') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="modal_detail" data-backdrop="static" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="exampleModalLabel">Detail Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert bg-teal">
                    <table class="table w-100">
                        <tbody>
                            <tr class="text-white">
                                <td class="align-middle text-left" width="25%">
                                    <div>Year : <span id="data_detail_year"></span></div>
                                    <div>Month : <span id="data_detail_month"></span></div>
                                </td>
                                <td class="align-middle text-center" width="50%">
                                    <h4 class="text-uppercase" id="data_detail_account_name"></h4>
                                    <h6 class="text-uppercase" id="data_detail_account_no"></h6>
                                </td>
                                <td class="align-middle text-right" width="25%">
                                    <div>Total Transaction : <span id="data_detail_total_transaction"></span></div>
                                    <div>Balance : <span id="data_detail_balance"></span></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table-secondary">
                            <tr class="text-center">
                                <th>Date</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Income</th>
                                <th>Expense</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody id="data_detail"></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="icon-switch2"></i> Close</button>
            </div>
        </div>
    </div>
</div>

    <script>
        function submitFilter() {
            loadingOpen('.content');
            $('#form_filter').submit();
        }

        function showDetail(id, balance) {
            $.ajax({
                url: '{{ url("admin/report/accounting/cash_bank/detail") }}',
                type: 'POST',
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    month: $('#filter_month').val(),
                    balance: balance
                },
                beforeSend: function() {
                    loadingOpen('.modal-content');
                    $('#data_detail').html('');
                },
                success: function(response) {
                    loadingClose('.modal-content');
                    $('#data_detail_year').text(response.year);
                    $('#data_detail_month').text(response.month);
                    $('#data_detail_account_name').text(response.name);
                    $('#data_detail_account_no').text(response.code);
                    $('#data_detail_total_transaction').text(response.total_transaction);
                    $('#data_detail_balance').text(response.balance);

                    $.each(response.result, function(i, val) {
                        $('#data_detail').append(`
                        <tr>
                            <td class="align-middle text-center">` + val.date + `</td>
                            <td class="align-middle text-center">` + val.code + `</td>
                            <td class="align-middle text-center">` + val.description+ `</td>
                            <td class="align-middle text-right">` + val.income + `</td>
                            <td class="align-middle text-right">` + val.expense + `</td>
                            <td class="align-middle text-right">` + val.balance + `</td>
                        </tr>
                        `);
                    });
                },
                error: function() {
                    loadingClose('.modal-content');
                    swalInit.fire({
                        title: 'Server Error',
                        text: 'Please contact developer',
                        type: 'error'
                    });
                }
            });
        }
    </script>
