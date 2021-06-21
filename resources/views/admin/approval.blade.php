<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Approval</span>
				</h4>
			</div>
			<div class="header-elements">
				<div class="d-flex justify-content-center">
					<button type="button" class="btn bg-success btn-labeled mr-2 btn-labeled-left" onclick="loadDataTable()">
						<b><i class="icon-sync"></i></b> Refresh Data
					</button>
				</div>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<span class="breadcrumb-item active">Approval</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
      <div class="card">
         <div class="card-body">
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
            <div class="form-group text-right mt-4">
               <div class="form-check form-check-inline">
                  <label class="form-check-label">
                     <input type="radio" class="form-check-input" name="filter_type" value="" checked>
                     All
                  </label>
               </div>
               <div class="form-check form-check-inline">
                  <label class="form-check-label">
                     <input type="radio" class="form-check-input" name="filter_type" value="orders">
                     Order
                  </label>
               </div>
               <div class="form-check form-check-inline">
                  <label class="form-check-label">
                     <input type="radio" class="form-check-input" name="filter_type" value="projects">
                     Project
                  </label>
               </div>
            </div>
            <div class="form-group"><hr></div>
            <div class="form-group">
               <div class="text-right">
                  <button type="button" onclick="resetFilter()" class="btn bg-danger"><i class="icon-cross2"></i> Reset</button>
                  <button type="button" onclick="loadDataTable()" class="btn bg-teal"><i class="icon-filter4"></i> Search</button>
               </div>
            </div>
         </div>
      </div>
		<div class="card">
			<div class="card-header header-elements-inline mb-3">
				<h5 class="card-title">List Data Approval</h5>
			</div>
			<div class="card-body">
            <div class="table-responsive">
               <table id="datatable_serverside" class="table table-bordered table-striped w-100">
                  <thead class="bg-dark">
                     <tr class="text-center">
                        <th>No</th>
                        <th>Type</th>
                        <th>Ref</th>
                        <th>Date</th>
                        <th>Approval</th>
                        <th>Status</th>
                        <th>Action</th>
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

   function resetFilter() {
      $('#filter_start_date').val(null);
      $('#filter_finish_date').val(null);
      $('input[name="filter_type"][value=""]').prop('checked', true);
      loadDataTable();
   }

   function loadDataTable() {
      $('#datatable_serverside').DataTable({
         serverSide: true,
         deferRender: true,
         destroy: true,
         iDisplayInLength: 10,
         order: [[3, 'desc']],
         ajax: {
            url: '{{ url("admin/approval/datatable") }}',
            type: 'POST',
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
               type: $('input[name="filter_type"]:checked').val(),
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
            { name: 'id', searchable: false, className: 'text-center align-middle' },
            { name: 'approvalable_type', className: 'text-center align-middle' },
            { name: 'ref', orderable: false, searchable: false, className: 'text-center nowrap align-middle' },
            { name: 'created_at', searchable: false, className: 'text-center nowrap align-middle' },
            { name: 'approved_by', className: 'text-center nowrap align-middle' },
            { name: 'status', className: 'text-center nowrap align-middle' },
            { name: 'action', searchable: false, orderable: false, className: 'text-center nowrap align-middle' }
         ]
      }); 
   }
</script>