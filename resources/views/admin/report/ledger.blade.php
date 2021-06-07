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
                     <label>Date :</label>
                     <div class="input-group">
                        <input type="date" name="filter_start_date" id="filter_start_date" max="{{ date('Y-m-d') }}" class="form-control">
                        <div class="input-group-prepend">
                           <span class="input-group-text">To</span>
                        </div>
                        <input type="date" name="filter_finish_date" id="filter_finish_date" max="{{ date('Y-m-d') }}" class="form-control">
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group text-right">
               <button type="button" onclick="filter('reset')" class="btn bg-danger"><i class="icon-sync"></i> Reset</button>
               <button type="button" onclick="filter()" class="btn bg-purple"><i class="icon-filter4"></i> Search</button>
            </div>
         </div>
      </div>
      <div class="mb-3">
         <h6 class="mb-0 font-weight-semibold text-center text-uppercase">
            <span id="string_filter_periode"></span>
         </h6>
      </div>
		<div class="card">
			<div class="card-body">
            <div class="table-responsive">
               <table id="datatable_serverside" class="table table-bordered table-striped w-100">
                  <thead class="bg-dark">
                     <tr class="text-center">
                        <th>#</th>
                        <th>No</th>
                        <th>Source</th>
                        <th>Beginning</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Ending</th>
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
      $('.sidebar-main-toggle').click();
      filter();

      $('#datatable_serverside tbody').on('click', 'td.details-control', function() {
         loadingOpen('#datatable_serverside');
         var tr    = $(this).closest('tr');
         var badge = tr.find('span.badge');
         var icon  = tr.find('i');
         var row   = table.row(tr);

         if(row.child.isShown()) {
            loadingClose('#datatable_serverside');
            row.child.hide();
            tr.removeClass('shown');
            badge.first().removeClass('badge-danger');
            badge.first().addClass('badge-success');
            icon.first().removeClass('icon-minus3');
            icon.first().addClass('icon-plus3');
         } else {
            loadingClose('#datatable_serverside');
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
      var content = '';
      $.ajax({
         url: '{{ url("admin/report/ledger/row_detail") }}',
         type: 'POST',
         async: false,
         data: {
            id: $(data[0]).data('id'),
            start_date: $('#filter_start_date').val(),
            finish_date: $('#filter_finish_date').val()
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
      $('#filter_start_date').val(null);
      $('#filter_finish_date').val(null);
   }

   function filter(param = null) {
      if(param == 'reset') {
         resetFilter();
      }

      var start_date  = $('#filter_start_date').val();
      var finish_date = $('#filter_finish_date').val();

      if(start_date && finish_date) {
         $('#string_filter_periode').html('Periode <br>' + $.dateString(start_date) + ' - ' + $.dateString(finish_date));
      } else if(start_date) {
         $('#string_filter_periode').html('Periode <br>' + $.dateString(start_date));
      } else if(finish_date) {
         $('#string_filter_periode').html('Periode <br>' + $.dateString(finish_date));
      } else {
         $('#string_filter_periode').html('All Periode');
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
               start_date: $('#filter_start_date').val(),
               finish_date: $('#filter_finish_date').val()
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
            { name: 'name', className: 'align-middle' },
            { name: 'beginning', searchable: false, orderable: false, className: 'text-center nowrap align-middle' },
            { name: 'debit', searchable: false, orderable: false, className: 'text-center nowrap align-middle' },
            { name: 'credit', searchable: false, orderable: false, className: 'text-center nowrap align-middle' },
            { name: 'ending', searchable: false, orderable: false, className: 'text-center nowrap align-middle' },
            { name: 'balance', searchable: false, orderable: false, className: 'text-center nowrap align-middle' }
         ]
      }); 
   }
</script>