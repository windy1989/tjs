<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Warehouse</span>
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
					<a href="javascript:void(0);" class="breadcrumb-item">Master Data</a>
					<a href="javascript:void(0);" class="breadcrumb-item">Product</a>
					<span class="breadcrumb-item active">Warehouse</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="card">
			<div class="card-header header-elements-inline mb-3">
				<h5 class="card-title">List Data</h5>
				<div class="header-elements">
					<select name="filter_status" id="filter_status" class="custom-select" onchange="loadDataTable()">
						<option value="">All Status</option>
						<option value="1">Active</option>
						<option value="2">Not Active</option>
					</select>
				</div>
			</div>
			<div class="card-body">
            <div class="table-responsive">
               <table id="datatable_serverside" class="table table-bordered table-striped w-100">
                  <thead class="bg-dark">
                     <tr class="text-center">
                        <th>No</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Status</th>
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
      $('#datatable_serverside').DataTable({
         serverSide: true,
         deferRender: true,
         destroy: true,
         iDisplayInLength: 10,
         order: [[0, 'asc']],
         ajax: {
            url: '{{ url("admin/master_data/product/warehouse/datatable") }}',
            type: 'GET',
            data: {
               status: $('#filter_status').val()
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
            { name: 'code', className: 'text-center align-middle' },
            { name: 'name', className: 'text-center align-middle' },
            { name: 'status', searchable: false, className: 'text-center align-middle' }
         ]
      }); 
   }
</script>