<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Report Ledger</span>
				</h4>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<a href="javascript:void(0);" class="breadcrumb-item">Report</a>
					<span class="breadcrumb-item active">Ledger</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
      <div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title">Filter</h5>
			</div>
         <div class="card-body">
            <div class="row">
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Source :</label>
                     <select name="filter_coa_id" id="filter_coa_id" class="select2">
                        <option value="">All</option>
                        @foreach($coa as $c)
                           <option value="{{ $c->id }}">[{{ $c->code }}] {{ $c->name }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Nominal :</label>
                     <input type="month" name="filter_date" id="filter_date" class="form-control" placeholder="0" value="{{ date('Y-m') }}">
                  </div>
               </div>
            </div>
            <div class="form-group text-right">
               <button type="button" onclick="filter('reset')" class="btn bg-danger"><i class="icon-sync"></i> Reset</button>
               <button type="button" onclick="filter()" class="btn bg-purple"><i class="icon-filter4"></i> Search</button>
            </div>
         </div>
      </div>
		<div class="card">
			<div class="card-header header-elements-inline mb-3">
				<h5 class="card-title">List Data Ledger</h5>
			</div>
			<div class="card-body">
            <div class="table-responsive">
               <table id="datatable_serverside" class="table table-bordered table-striped w-100">
                  <thead class="bg-dark">
                     <tr class="text-center">
                        <th>#</th>
                        <th>No</th>
                        <th>Date</th>
                        <th>Source</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Balance</th>
                     </tr>
                  </thead>
               </table>
            </div>
			</div>
		</div>
	</div>

<script>
   $(function() {
      filter();

      $('#datatable_serverside tbody').on('click', 'td.details-control', function() {
         var tr    = $(this).closest('tr');
         var badge = tr.find('span.badge');
         var icon  = tr.find('i');
         var row   = table.row(tr);

         if(row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
            badge.first().removeClass('badge-danger');
            badge.first().addClass('badge-success');
            icon.first().removeClass('icon-minus3');
            icon.first().addClass('icon-plus3');
         } else {
            row.child(rowDetail(row.data())).show();
            tr.addClass('shown');
            badge.first().removeClass('badge-success');
            badge.first().addClass('badge-danger');
            icon.first().removeClass('icon-plus3');
            icon.first().addClass('icon-minus3');
         }
      });
   });

   function rowDetail(data) {
      console.log($('#filter_date').val())
      var content = '';
      $.ajax({
         url: '{{ url("admin/report/ledger/row_detail") }}',
         type: 'POST',
         async: false,
         data: {
            id: $(data[0]).data('id'),
            date: $('#filter_date').val()
         },
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function(response) {
            content += response;
         },
         error: function() {
            swalInit.fire({
               title: 'Server Error',
               text: 'Please contact developer',
               type: 'error'
            });
         }
      });

      return content;
   }

   function resetFilter() {
      $('#filter_coa_id').val(null).trigger('change');
      $('#filter_date').val('{{ date("Y-m") }}');
   }

   function filter(param = null) {
      if(param == 'reset') {
         resetFilter();
      }

      window.table = loadDataTable();
   }

   function loadDataTable() {
      return $('#datatable_serverside').DataTable({
         serverSide: true,
         deferRender: true,
         destroy: true,
         iDisplayInLength: 10,
         order: [[1, 'asc']],
         ajax: {
            url: '{{ url("admin/report/ledger/datatable") }}',
            type: 'POST',
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
               coa_id: $('#filter_coa_id').val(),
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
            { name: 'detail', orderable: false, searchable: false, className: 'text-center align-middle details-control' },
            { name: 'id', searchable: false, className: 'text-center align-middle' },
            { name: 'date', searchable: false, orderable: false, className: 'text-center align-middle' },
            { name: 'name', className: 'align-middle' },
            { name: 'debit', searchable: false, orderable: false, className: 'text-center nowrap align-middle' },
            { name: 'credit', searchable: false, orderable: false, className: 'text-center nowrap align-middle' },
            { name: 'balance', searchable: false, orderable: false, className: 'text-center nowrap align-middle' }
         ]
      }); 
   }
</script>