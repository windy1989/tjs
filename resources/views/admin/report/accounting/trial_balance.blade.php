<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Trial Balance</span>
				</h4>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<a href="javascript:void(0);" class="breadcrumb-item">Report</a>
					<a href="javascript:void(0);" class="breadcrumb-item">Accounting</a>
					<span class="breadcrumb-item active">Trial Balance</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="card">
			<div class="card-body">
            <div class="row justify-content-center">
               <div class="col-md-4">
                  <div class="text-center mb-2 text-uppercase font-weight-bold">Periode :</div>
                  <input type="month" name="filter_date" id="filter_date" max="{{ date('Y-m') }}" value="{{ date('Y-m') }}" onchange="loadDataTable()" class="form-control">
               </div>
            </div>
            <div class="form-group"><hr></div>
            <div class="table-responsive">
               <table id="datatable_serverside" class="table table-bordered table-striped w-100">
                  <thead class="bg-dark">
                     <tr class="text-center">
                        <th>No</th>
                        <th>Account</th>
                        <th>Balance Debit</th>
                        <th>Balance Credit</th>
                        <th>Change Debit</th>
                        <th>Change Credit</th>
                        <th>End Balance Debit</th>
                        <th>End Balance Credit</th>
                     </tr>
                  </thead>
               </table>
            </div>
			</div>
		</div>
	</div>

<script>
   $(function() {
      loadDataTable();
   });

   function loadDataTable() {
      return $('#datatable_serverside').DataTable({
         serverSide: true,
         deferRender: true,
         destroy: true,
         iDisplayInLength: 10,
         order: [[0, 'asc']],
         ajax: {
            url: '{{ url("admin/report/accounting/trial_balance/datatable") }}',
            type: 'GET',
            data: {
               date: $('#filter_date').val()
            },
            beforeSend: function() {
               loadingOpen('#datatable_serverside');
            },
            complete: function() {
               loadingClose('#datatable_serverside');
            },
            error: function() {
               loadingClose('#datatable_serverside');
               swalInit.fire({
                  title: 'Server Error',
                  text: 'Please contact developer',
                  type: 'error'
               });
            }
         },
         columns: [
            { name: 'id', searchable: false, className: 'text-center align-middle' },
            { name: 'coa_id', className: 'align-middle' },
            { name: 'balance_debit', searchable: false, orderable: false, className: 'text-center nowrap align-middle' },
            { name: 'balance_credit', searchable: false, orderable: false, className: 'text-center nowrap align-middle' },
            { name: 'change_debit', searchable: false, orderable: false, className: 'text-center nowrap align-middle' },
            { name: 'change_credit', searchable: false, orderable: false, className: 'text-center nowrap align-middle' },
            { name: 'end_debit', searchable: false, orderable: false, className: 'text-center nowrap align-middle' },
            { name: 'end_credit', searchable: false, orderable: false, className: 'text-center nowrap align-middle' }
         ]
      }); 
   }
</script>