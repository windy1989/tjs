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
					<button type="button" class="btn bg-primary btn-labeled btn-labeled-left" onclick="cancel()" data-toggle="modal" data-target="#modal_form">
						<b><i class="icon-plus3"></i></b> Add Data
					</button>
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
				<div class="header-elements form-inline">
               <select name="filter_brand_id" id="filter_brand_id" class="custom-select mr-3" onchange="loadDataTable()">
						<option value="">All Brand</option>
                  @foreach($brand as $b)
                     <option value="{{ $b->id }}">{{ $b->name }}</option>
                  @endforeach
					</select>
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
                        <th>Type</th>
                        <th>Code</th>
                        <th>Brand</th>
                        <th>Stock</th>
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
         <div class="modal-header bg-light">
            <h5 class="modal-title" id="exampleModalLabel">Form Product Code</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form id="form_data">
               <div class="alert alert-danger" id="validation_alert" style="display:none;">
                  <ul id="validation_content"></ul>
               </div>
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
                        <div class="form-group">
                           <label>Code :</label>
                           <input type="text" name="code" id="code" class="form-control" placeholder="Auto Generate" readonly>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Type :<span class="text-danger">*</span></label>
                                 <select name="type_id" id="type_id" onchange="generateCode()"></select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Hs Code :<span class="text-danger">*</span></label>
                                 <select name="hs_code_id" id="hs_code_id" class="select2">
                                    <option value="">-- Choose --</option>
                                    @foreach($hs_code as $hs)
                                       <option value="{{ $hs->id }}">({{ $hs->code }}) {{ $hs->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Company :<span class="text-danger">*</span></label>
                                 <select name="company_id" id="company_id" class="select2" onchange="generateCode()">
                                    <option value="">-- Choose --</option>
                                    @foreach($company as $c)
                                       <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Brand :<span class="text-danger">*</span></label>
                                 <select name="brand_id" id="brand_id" class="select2" onchange="generateCode()">
                                    <option value="">-- Choose --</option>
                                    @foreach($brand as $b)
                                       <option value="{{ $b->id }}">{{ $b->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Country :<span class="text-danger">*</span></label>
                                 <select name="country_id" id="country_id" class="select2" onchange="generateCode()">
                                    <option value="">-- Choose --</option>
                                    @foreach($country as $c)
                                       <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Supplier :<span class="text-danger">*</span></label>
                                 <select name="supplier_id" id="supplier_id" class="select2">
                                    <option value="">-- Choose --</option>
                                    @foreach($supplier as $s)
                                       <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Grade :<span class="text-danger">*</span></label>
                                 <select name="grade_id" id="grade_id" class="select2" onchange="generateCode()">
                                    <option value="">-- Choose --</option>
                                    @foreach($grade as $g)
                                       <option value="{{ $g->id }}">{{ $g->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                     </p>
                  </div>
                  <div class="tab-pane fade" id="highlighted-justified-tab2">
                     <p class="mt-4">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group form-group-feedback form-group-feedback-right">
                                 <label>Pcs :</label>
                                 <div class="position-relative">
                                    <input type="number" name="carton_pcs" id="carton_pcs" class="form-control" onkeyup="formula()" placeholder="0">
                                    <div class="form-control-feedback font-weight-bold">/ Carton</div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group form-group-feedback form-group-feedback-right">
                                 <label>Carton :</label>
                                 <div class="position-relative">
                                    <input type="number" name="carton_pallet" id="carton_pallet" class="form-control" placeholder="0">
                                    <div class="form-control-feedback font-weight-bold">/ Pallet</div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group form-group-feedback form-group-feedback-right">
                                 <label>SQM :</label>
                                 <div class="position-relative">
                                    <input type="number" name="carton_sqm" id="carton_sqm" class="form-control" placeholder="0" disabled>
                                    <div class="form-control-feedback font-weight-bold">/ Carton</div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group form-group-feedback form-group-feedback-right">
                                 <label>Cubic Meters :<span class="text-danger">*</span></label>
                                 <div class="position-relative">
                                    <input type="number" name="cubic_meter" id="cubic_meter" class="form-control" disabled>
                                    <div class="form-control-feedback font-weight-bold">/ Stock Unit</div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group form-group-feedback form-group-feedback-right">
                                 <label>Stock Unit :<span class="text-danger">*</span></label>
                                 <div class="position-relative">
                                    <input type="number" name="container_stock" id="container_stock" class="form-control" placeholder="0">
                                    <div class="form-control-feedback font-weight-bold">/ Container</div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label>Standart Container :<span class="text-danger">*</span></label>
                                 <select name="container_standart" id="container_standart" class="custom-select">
                                    <option value="">-- Choose --</option>
                                    <option value="1">20 Feet</option>
                                    <option value="2">40 Feet</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group form-group-feedback form-group-feedback-right">
                                 <label>Max Stock Unit :<span class="text-danger">*</span></label>
                                 <div class="position-relative">
                                    <input type="number" name="container_max_stock" id="container_max_stock" class="form-control" placeholder="0">
                                    <div class="form-control-feedback font-weight-bold">/ Container</div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </p>
                  </div>
                  <div class="tab-pane fade" id="highlighted-justified-tab3">
                     <p class="mt-4">
                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Warehouse :<span class="text-danger">*</span></label>
                                 <select name="shading_warehouse" id="shading_warehouse" class="select2">
                                    <option value="">-- Choose --</option>
                                    @foreach($warehouse as $w)
                                       <option value="{{ $w->code }};{{ $w->name }}">{{ $w->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Ventura:<span class="text-danger">*</span></label>
                                 <input type="text" name="shading_stock_code" id="shading_stock_code" class="form-control" placeholder="Enter code ventura">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Code :<span class="text-danger">*</span></label>
                                 <input type="text" name="shading_code" id="shading_code" class="form-control" placeholder="Enter code">
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="text-right">
                              <button type="button" class="btn btn-success" onclick="addShading()"><i class="icon-plus3"></i> Add New</button>
                           </div>
                        </div>
                        <div class="form-group"><hr></div>
                        <div class="table-responsive">
                           <table id="datatable_shading" class="table table-bordered table-striped w-100">
                              <thead class="bg-info">
                                 <tr class="text-center">
                                    <th>Warehouse</th>
                                    <th>Ventura</th>
                                    <th>Code</th>
                                    <th>qty</th>
                                 </tr>
                              </thead>
                              <tbody class="text-center" id="data_shading"></tbody>
                           </table>
                        </div>
                     </p>
                  </div>
                  <div class="tab-pane fade" id="highlighted-justified-tab4">
                     <p class="mt-4">
                        <textarea name="description" id="description" class="form-control" rows="8" placeholder="Enter description"></textarea>
                     </p>
                  </div>
               </div>
               <div class="form-group"><hr></div>
               <div class="form-group text-center mt-4">
                  <div class="form-check form-check-inline">
                     <label class="form-check-label">
                        <input type="radio" class="form-check-input-styled-danger" name="status" value="2" data-fouc>
                        Not Active
                     </label>
                  </div>
                  <div class="form-check form-check-inline">
                     <label class="form-check-label">
                        <input type="radio" class="form-check-input-styled-success" name="status" value="1" data-fouc checked>
                        Active
                     </label>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="icon-switch2"></i> Close</button>
            <button type="button" class="btn bg-danger" id="btn_cancel" onclick="cancel()" style="display:none;"><i class="icon-cross3"></i> Cancel</button>
            <button type="button" class="btn bg-warning" id="btn_update" onclick="update()" style="display:none;"><i class="icon-pencil7"></i> Save</button>
            <button type="button" class="btn bg-primary" id="btn_create" onclick="create()"><i class="icon-plus3"></i> Add</button>
         </div>
      </div>
   </div>
</div>

<script>
   $(function() {
      loadDataTable();
      $('#datatable_shading').DataTable();

      $('#datatable_shading tbody').on('click', '#delete_data_shading', function () {
         $('#datatable_shading').DataTable().row($(this).parents('tr')).remove().draw();
      });

      $('a[data-toggle="tab"]').on('shown.bs.tab', function() {
         $('#datatable_shading').DataTable().columns.adjust();
      });

      select2ServerSide('#type_id', '{{ url("admin/select2/type") }}');
   });

   function formula() {
      $.ajax({
         url: '{{ url("admin/product/code/formula") }}',
         type: 'POST',
         dataType: 'JSON',
         data: {
            type_id: $('#type_id').val(),
            carton_pcs: $('#carton_pcs').val()
         },
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function(response) {
            $('#carton_sqm').val(response.carton_sqm);
            $('#cubic_meter').val(response.cubic_meter);
         }
      });
   }

   function generateCode() {
      $.ajax({
         url: '{{ url("admin/product/code/generate_code") }}',
         type: 'POST',
         dataType: 'JSON',
         data: {
            brand_id: $('#brand_id').val(),
            country_id: $('#country_id').val(),
            type_id: $('#type_id').val(),
            grade_id: $('#grade_id').val()
         },
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function(response) {
            formula();
            $('#code').val(response);
         },
         error: function() {
            swalInit.fire({
               title: 'Server Error',
               text: 'Please contact developer',
               type: 'error'
            });
         }
      });
   }

   function addShading() {
      let shading_warehouse  = $('#shading_warehouse');
      let shading_stock_code = $('#shading_stock_code');
      let shading_code       = $('#shading_code');

      if(!shading_warehouse.val() || !shading_stock_code.val() || !shading_code.val()) {
         swalInit.fire({
            title: 'Please fill in all fields.',
            type: 'info'
         });
      } else {
         let arr_shading_warehouse = shading_warehouse.val().split(';');

         $('#datatable_shading').DataTable().row.add([
            arr_shading_warehouse[1],
            shading_stock_code.val(),
            shading_code.val(),
            `
               <button type="button" class="btn bg-danger btn-sm" id="delete_data_shading"><i class="icon-trash-alt"></i></button>
               <input type="hidden" name="shading_warehouse_code[]" value="` + arr_shading_warehouse[0] + `">
               <input type="hidden" name="shading_warehouse_name[]" value="` + arr_shading_warehouse[1] + `">
               <input type="hidden" name="shading_stock_code[]" value="` + shading_stock_code.val() + `">
               <input type="hidden" name="shading_code[]" value="` + shading_code.val() + `">
            `
         ]).draw().node();

         shading_warehouse.val(null).trigger('change');
         shading_stock_code.val(null);
         shading_code.val(null);
      }
   }

   function cancel() {
      reset();
      $('#modal_form').modal('hide');
      $('#btn_create').show();
      $('#btn_update').hide();
      $('#btn_cancel').hide();
   }

   function toShow() {
      $('#modal_form').modal('show');
      $('#validation_alert').hide();
      $('#validation_content').html('');
      $('#btn_create').hide();
      $('#btn_update').show();
      $('#btn_cancel').show();
   }

   function reset() {
      $('#validation_alert').hide();
      $('#validation_content').html('');
      $('#form_data').trigger('reset');
      $('.nav-tabs-highlight > li.nav-item > a.nav-link').removeClass('active');
      $('.nav-tabs-highlight > li.nav-item > a[href="#highlighted-justified-tab1"]').addClass('active');
      $('.tab-pane').removeClass('active');
      $('.tab-pane#highlighted-justified-tab1').addClass('show active');
      $('#type_id').val(null).change();
      $('#hs_code_id').val(null).change();
      $('#company_id').val(null).change();
      $('#brand_id').val(null).change();
      $('#country_id').val(null).change();
      $('#supplier_id').val(null).change();
      $('#grade_id').val(null).change();
      $('#datatable_shading').DataTable().clear().draw();
   }

   function success() {
      reset();
      $('#modal_form').modal('hide');
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
               brand_id: $('#filter_brand_id').val(),
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
            { name: 'type_id', className: 'text-center align-middle' },
            { name: 'code', orderable: false, searchable: false, className: 'text-center align-middle' },
            { name: 'brand_id', className: 'text-center align-middle' },
            { name: 'stock', orderable: false, searchable: false, className: 'text-center align-middle' },
            { name: 'country_id', className: 'text-center align-middle' },
            { name: 'status', searchable: false, className: 'text-center align-middle' },
            { name: 'action', searchable: false, orderable: false, className: 'text-center nowrap align-middle' }
         ]
      }); 
   }

   function create() {
      $.ajax({
         url: '{{ url("admin/product/code/create") }}',
         type: 'POST',
         dataType: 'JSON',
         data: $('#form_data').serialize(),
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         beforeSend: function() {
            $('#validation_alert').hide();
            $('#validation_content').html('');
            loadingOpen('.modal-content');
         },
         success: function(response) {
            loadingClose('.modal-content');
            if(response.status == 200) {
               success();
               notif('success', 'bg-success', response.message);
            } else if(response.status == 422) {
               $('#validation_alert').show();
               $('.modal-body').scrollTop(0);
               notif('warning', 'bg-warning', 'Validation');
               
               $.each(response.error, function(i, val) {
                  $.each(val, function(i, val) {
                     $('#validation_content').append(`
                        <li>` + val + `</li>
                     `);
                  });
               });
            } else {
               notif('error', 'bg-danger', response.message);
            }
         },
         error: function() {
            $('.modal-body').scrollTop(0);
            loadingClose('.modal-content');
            swalInit.fire({
               title: 'Server Error',
               text: 'Please contact developer',
               type: 'error'
            });
         }
      });
   }

   function show(id) {
      toShow();
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
         },
         success: function(response) {
            loadingClose('.modal-content');
            $('#type_id').html('<option value="' + response.type_id + '" selected>' + response.type_code + '</option>');
            $('#company_id').val(response.company_id).change();
            $('#hs_code_id').val(response.hs_code_id).change();
            $('#brand_id').val(response.brand_id).change();
            $('#country_id').val(response.country_id).change();
            $('#supplier_id').val(response.supplier_id).change();
            $('#grade_id').val(response.grade_id).change();
            $('#carton_pallet').val(response.carton_pallet);
            $('#carton_pcs').val(response.carton_pcs);
            $('#container_standart').val(response.container_standart);
            $('#container_stock').val(response.container_stock);
            $('#container_max_stock').val(response.container_max_stock);
            $('#description').val(response.description);
            $('input[name="status"][value="' + response.status + '"]').prop('checked', true);

            $.each(response.shading, function(i, val) {
               $('#datatable_shading').DataTable().row.add([
                  val.warehouse_code,
                  val.stock_code,
                  val.code,
                  val.qty
               ]).draw().node();
            });

            $('#btn_update').attr('onclick', 'update(' + id + ')');
         },
         error: function() {
            cancel();
            loadingClose('.modal-content');
            swalInit.fire({
               title: 'Server Error',
               text: 'Please contact developer',
               type: 'error'
            });
         }
      });
   }

   function update(id) {
      $.ajax({
         url: '{{ url("admin/product/code/update") }}' + '/' + id,
         type: 'POST',
         dataType: 'JSON',
         data: $('#form_data').serialize(),
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         beforeSend: function() {
            $('#validation_alert').hide();
            $('#validation_content').html('');
            loadingOpen('.modal-content');
         },
         success: function(response) {
            loadingClose('.modal-content');
            if(response.status == 200) {
               success();
               notif('success', 'bg-success', response.message);
            } else if(response.status == 422) {
               $('#validation_alert').show();
               $('.modal-body').scrollTop(0);
               notif('warning', 'bg-warning', 'Validation');
               
               $.each(response.error, function(i, val) {
                  $.each(val, function(i, val) {
                     $('#validation_content').append(`
                        <li>` + val + `</li>
                     `);
                  });
               });
            } else {
               notif('error', 'bg-danger', response.message);
            }
         },
         error: function() {
            $('.modal-body').scrollTop(0);
            loadingClose('.modal-content');
            swalInit.fire({
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
                     swalInit.fire({
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