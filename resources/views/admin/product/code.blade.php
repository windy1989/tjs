<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Product Code</span>
				</h4>
			</div>
			<div class="header-elements">
				<div class="d-flex justify-content-center">
					<button type="button" class="btn bg-success btn-labeled mr-2 btn-labeled-left" onclick="loadDataTable()">
						<b><i class="icon-sync"></i></b> Refresh Data
					</button>
					<a href="{{ url('admin/product/code/create') }}" class="btn bg-primary btn-labeled btn-labeled-left">
						<b><i class="icon-plus3"></i></b> Add Data
					</a>
				</div>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<a href="javascript:void(0);" class="breadcrumb-item">Product</a>
					<span class="breadcrumb-item active">Code</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="card">
			<div class="card-header header-elements-inline mb-3">
				<h5 class="card-title">List Data Code</h5>
				<div class="header-elements">
					<select name="filter_status" id="filter_status" class="form-control" onchange="loadDataTable()">
						<option value="">All</option>
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
                        <th>Type</th>
                        <th>Code</th>
                        <th>Brand</th>
                        <th>Country</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
               </table>
            </div>
			</div>
		</div>
	</div>

<div class="modal fade" id="modal_form" data-backdrop="static" role="dialog">
   <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detail Product Type</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
             <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
               <li class="nav-item">
                  <a href="#highlighted-justified-tab1" class="nav-link active" data-toggle="tab">Data</a>
               </li>
               <li class="nav-item">
                  <a href="#highlighted-justified-tab2" class="nav-link" data-toggle="tab">Stock</a>
               </li>
               <li class="nav-item">
                  <a href="#highlighted-justified-tab3" class="nav-link" data-toggle="tab">Shading</a>
               </li>
               <li class="nav-item">
                  <a href="#highlighted-justified-tab4" class="nav-link" data-toggle="tab">Description</a>
               </li>
            </ul>
            <div class="tab-content">
               <div class="tab-pane fade show active" id="highlighted-justified-tab1">
                  <p class="mt-4">
                     <table cellpadding="10" cellspacing="0" width="100%">
                        <tbody>
                           <tr>
                              <th width="20%" class="align-middle">Code</th>
                              <td class="align-middle" id="detail_code"></td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">Type</th>
                              <td class="align-middle" id="detail_type"></td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">Hs Code</th>
                              <td class="align-middle" id="detail_hs_code"></td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">Company</th>
                              <td class="align-middle" id="detail_company"></td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">Brand</th>
                              <td class="align-middle" id="detail_brand"></td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">Country</th>
                              <td class="align-middle" id="detail_country"></td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">Supplier</th>
                              <td class="align-middle" id="detail_supplier"></td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">Grade</th>
                              <td class="align-middle" id="detail_grade"></td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">Status</th>
                              <td class="align-middle" id="detail_status"></td>
                           </tr>
                        </tbody>
                     </table>
                  </p>
               </div>
               <div class="tab-pane fade" id="highlighted-justified-tab2">
                  <p class="mt-4">
                     <table cellpadding="10" cellspacing="0" width="100%">
                        <tbody>
                           <tr>
                              <th width="20%" class="align-middle">Carton</th>
                              <td class="align-middle" id="detail_carton_pcs"></td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">Pallet</th>
                              <td class="align-middle" id="detail_carton_pallet"></td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">Container</th>
                              <td class="align-middle" id="detail_container_stock"></td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">Standart Container</th>
                              <td class="align-middle" id="detail_container_standart"></td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">Max Stock Container</th>
                              <td class="align-middle" id="detail_container_max_stock"></td>
                           </tr>
                        </tbody>
                     </table>
                  </p>
               </div>
               <div class="tab-pane fade" id="highlighted-justified-tab3">
                  <p class="mt-4">
                     <div class="table-responsive">
                        <table id="datatable_shading" class="table table-bordered table-striped w-100">
                           <thead class="bg-info">
                              <tr class="text-center">
                                 <th>Warehouse</th>
                                 <th>Ventura</th>
                                 <th>Code</th>
                                 <th>Qty</th>
                              </tr>
                           </thead>
                           <tbody class="text-center" id="data_shading"></tbody>
                        </table>
                     </div>
                  </p>
               </div>
               <div class="tab-pane fade" id="highlighted-justified-tab4">
                  <p class="mt-4" id="detail_description"></p>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="icon-switch2"></i> Close</button>
         </div>
      </div>
   </div>
</div>

<script>
   $(function() {
      loadDataTable();
      $('#datatable_shading').DataTable();

      $('a[data-toggle="tab"]').on('shown.bs.tab', function() {
         $('#datatable_shading').DataTable().columns.adjust();
      });
   });

  function success() {
      $('#datatable_serverside').DataTable().ajax.reload(null, false);
   }

   function loadDataTable() {
      $('#datatable_serverside').DataTable({
         serverSide: true,
         deferRender: true,
         destroy: true,
         iDisplayInLength: 10,
         order: [[0, 'asc']],
         ajax: {
            url: '{{ url("admin/product/code/datatable") }}',
            type: 'POST',
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
               quality: $('#filter_quality').val(),
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
               swalInit({
                  title: 'Server Error',
                  text: 'Please contact developer',
                  type: 'error'
               });
            }
         },
         columns: [
            { name: 'id', searchable: false, className: 'text-center align-middle' },
            { name: 'type_id', className: 'text-center align-middle' },
            { name: 'code', orderable: false, searchable: false, className: 'text-center align-middle' },
            { name: 'brand_id', className: 'text-center align-middle' },
            { name: 'country_id', className: 'text-center align-middle' },
            { name: 'status', searchable: false, className: 'text-center align-middle' },
            { name: 'action', searchable: false, orderable: false, className: 'text-center nowrap align-middle' }
         ]
      }); 
   }

   function show(id) {
      $('.nav-tabs-highlight > li.nav-item > a.nav-link').removeClass('active')
      $('.nav-tabs-highlight > li.nav-item > a[href="#highlighted-justified-tab1"]').addClass('active');
      $('.tab-pane').removeClass('active')
      $('.tab-pane#highlighted-justified-tab1').addClass('show active')
      $('#modal_form').modal('show');
      
      $.ajax({
         url: '{{ url("admin/product/code/show") }}',
         type: 'POST',
         dataType: 'JSON',
         data: {
            id: id
         },
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         beforeSend: function() {
            loadingOpen('.modal-content');
            $('#datatable_shading').DataTable().clear().draw();
         },
         success: function(response) {
            loadingClose('.modal-content');
            $('#detail_code').html(': ' + response.code);
            $('#detail_type').html(': ' + response.type);
            $('#detail_company').html(': ' + response.company);
            $('#detail_hs_code').html(': ' + response.hs_code);
            $('#detail_brand').html(': ' + response.brand);
            $('#detail_country').html(': ' + response.country);
            $('#detail_supplier').html(': ' + response.supplier);
            $('#detail_grade').html(': ' + response.grade);
            $('#detail_carton_pallet').html(': ' + response.carton_pallet);
            $('#detail_carton_pcs').html(': ' + response.carton_pcs);
            $('#detail_container_standart').html(': ' + response.container_standart);
            $('#detail_container_stock').html(': ' + response.container_stock);
            $('#detail_container_max_stock').html(': ' + response.container_max_stock);
            $('#detail_description').html(response.description);
            $('#detail_status').html(': ' + response.status);

            $.each(response.shading, function(i, val) {
               $('#datatable_shading').DataTable().row.add([
                  val.warehouse,
                  val.stock_code,
                  val.code,
                  val.qty
               ]).draw().node();
            });
         },
         error: function() {
            loadingClose('.modal-content');
            swalInit({
               title: 'Server Error',
               text: 'Please contact developer',
               type: 'error'
            });
         }
      });
   }

   function destroy(id) {
      var notyConfirm = new Noty({
         theme: 'limitless',
         text: '<h6 class="font-weight-bold mb-3">Are sure you want to delete?</h6><label>Deleted data can no longer be recovered.</label>',
         timeout: false,
         modal: true,
         layout: 'center',
         closeWith: 'button',
         type: 'confirm',
         buttons: [
            Noty.button('<i class="icon-cross3"></i>', 'btn bg-danger', function() {
               notyConfirm.close();
            }),
            Noty.button('<i class="icon-trash"></i>', 'btn bg-success ml-1', function() {
               $.ajax({
                  url: '{{ url("admin/product/code/destroy") }}',
                  type: 'POST',
                  dataType: 'JSON',
                  data: {
                     id: id
                  },
                  headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(response) {
                     if(response.status == 200) {
                        $('#datatable_serverside').DataTable().ajax.reload(null, false);
                        notif('success', 'bg-success', response.message);
                        notyConfirm.close();
                     } else {
                        notif('error', 'bg-danger', response.message);
                     }
                  },
                  error: function() {
                     swalInit({
                        title: 'Server Error',
                        text: 'Please contact developer',
                        type: 'error'
                     });
                  }
               });
            })
         ]
      }).show();
   }
</script>