<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Update Product Code</span>
				</h4>
			</div>
			<div class="header-elements">
				<div class="d-flex justify-content-center">
					<a href="{{ url('admin/product/code') }}" class="btn bg-secondary btn-labeled btn-labeled-left">
						<b><i class="icon-arrow-left7"></i></b> Back To List
					</a>
				</div>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
					<a href="javascript:void(0);" class="breadcrumb-item">Product</a>
					<a href="{{ url('admin/product/code') }}" class="breadcrumb-item">Type</a>
					<span class="breadcrumb-item active">Update Data</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
      @if($errors->any())
         <div class="alert bg-warning text-white alert-styled-left alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            <ul>
               @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
      @elseif(session('success'))
         <div class="alert bg-success text-white alert-styled-left alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            <span class="font-weight-semibold">Success!</span> {{ session('success') }}
         </div>
      @elseif(session('failed'))
         <div class="alert bg-danger text-white alert-styled-left alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            <span class="font-weight-semibold">Failed!</span> {{ session('failed') }}
         </div>
      @endif
		<div class="card">
			<div class="card-body">
            <form action="" method="POST" id="form_data">
               @csrf
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
                           <input type="text" name="code" id="code" class="form-control" value="{{ $product->code() }}" placeholder="Auto Generate" readonly>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Type :<span class="text-danger">*</span></label>
                                 <select name="type_id" id="type_id" onchange="generateCode()">
                                    <option value="{{ $product->type->id }}" selected>{{ $product->type->code }}</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Hs Code :<span class="text-danger">*</span></label>
                                 <select name="hs_code_id" id="hs_code_id" class="select2">
                                    <option value="">-- Choose --</option>
                                    @foreach($hs_code as $hs)
                                       <option value="{{ $hs->id }}" {{ $product->hs_code_id == $hs->id ? 'selected' : '' }}>{{ $hs->name }}</option>
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
                                       <option value="{{ $c->id }}" {{ $product->company_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
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
                                       <option value="{{ $b->id }}" {{ $product->brand_id == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
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
                                       <option value="{{ $c->id }}" {{ $product->country_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
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
                                       <option value="{{ $s->id }}" {{ $product->supplier_id == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
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
                                       <option value="{{ $g->id }}" {{ $product->grade_id == $g->id ? 'selected' : '' }}>{{ $g->name }}</option>
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
                              <div class="form-group">
                                 <label>Carton :</label>
                                 <small class="font-italic float-right font-weight-bold text-danger">TILE PRODUCT</small>
                                 <div class="input-group">
                                    <input type="number" name="carton_pcs" id="carton_pcs" class="form-control" value="{{ $product->carton_pcs }}" placeholder="Enter number">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text">Pcs</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Pallet :</label>
                                 <small class="font-italic float-right font-weight-bold text-danger">TILE PRODUCT</small>
                                 <div class="input-group">
                                    <input type="number" name="carton_pallet" id="carton_pallet" class="form-control" value="{{ $product->carton_pallet }}" placeholder="Enter number">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text">Carton</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>SQM :</label>
                                 <small class="font-italic float-right font-weight-bold text-danger">TILE PRODUCT</small>
                                 <div class="input-group">
                                    <input type="number" name="carton_sqm" id="carton_sqm" class="form-control" value="{{ $product->carton_sqm }}" placeholder="Enter number">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text">Carton</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Stock Unit :<span class="text-danger">*</span></label>
                                 <div class="input-group">
                                    <input type="number" name="selling_unit" id="selling_unit" class="form-control" value="{{ $product->selling_unit }}" placeholder="Enter number">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text">Selling Unit</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Stock Unit :<span class="text-danger">*</span></label>
                                 <div class="input-group">
                                    <input type="number" name="cubic_meter" id="cubic_meter" class="form-control" value="{{ $product->cubic_meter }}" placeholder="Enter number">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text">Cubic Meters</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Stock Unit :<span class="text-danger">*</span></label>
                                 <div class="input-group">
                                    <input type="number" name="container_stock" id="container_stock" class="form-control" value="{{ $product->container_stock }}" placeholder="Enter number">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text">Container</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Standart Container :<span class="text-danger">*</span></label>
                                 <input type="number" name="container_standart" id="container_standart" class="form-control" value="{{ $product->container_standart }}" placeholder="Enter standart container">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Max Stock Unit :<span class="text-danger">*</span></label>
                                 <div class="input-group">
                                    <input type="number" name="container_max_stock" id="container_max_stock" class="form-control" value="{{ $product->container_max_stock }}" placeholder="Enter number">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text">Container</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </p>
                  </div>
                  <div class="tab-pane fade" id="highlighted-justified-tab3">
                     <p class="mt-4">
                        <div class="form-group">
                           <div class="text-right">
                              <button type="button" class="btn bg-success btn-sm" data-toggle="modal" data-target="#modal_form"><i class="icon-plus3"></i> Add New</button>
                           </div>
                        </div>
                        <div class="form-group"><hr></div>
                        <div class="table-responsive">
                           <table id="datatable_shading" class="table table-bordered table-striped w-100">
                              <thead class="bg-info">
                                 <tr class="text-center">
                                    <th>Warehouse</th>
                                    <th>Code</th>
                                    <th>Qty</th>
                                    <th>Delete</th>
                                 </tr>
                              </thead>
                              <tbody class="text-center" id="data_shading">
                                 @if($product->productShading)
                                    @foreach($product->productShading as $key => $pd)
                                       <tr>
                                          <td>{{ $pd->warehouse->name }}</td>
                                          <td>{{ $pd->code }}</td>
                                          <td>{{ $pd->qty }}</td>
                                          <td>
                                             <button type="button" class="btn bg-danger btn-sm" id="delete_data_shading">
                                                <i class="icon-trash-alt"></i>
                                             </button>
                                             <input type="hidden" name="shading_warehouse_code[]" value="{{ $pd->warehouse_code }}">
                                             <input type="hidden" name="shading_warehouse_name[]" value="{{ $pd->warehouse->name }}">
                                             <input type="hidden" name="shading_code[]" value="{{ $pd->code }}">
                                             <input type="hidden" name="shading_qty[]" value="{{ $pd->qty }}">
                                          </td>
                                       </tr>
                                    @endforeach
                                 @endif
                              </tbody>
                           </table>
                        </div>
                     </p>
                  </div>
                  <div class="tab-pane fade" id="highlighted-justified-tab4">
                     <p class="mt-4">
                        <textarea name="description" id="description" class="description">{!! $product->description !!}</textarea>
                     </p>
                  </div>
               </div>
               <div class="form-group"><hr></div>
               <div class="form-group text-center mt-4">
                  <div class="form-check form-check-inline">
                     <label class="form-check-label">
                        <input type="radio" class="form-check-input-styled-danger" name="status" value="2" {{ $product->status == 2 ? 'checked' : '' }} data-fouc>
                        Not Active
                     </label>
                  </div>
                  <div class="form-check form-check-inline">
                     <label class="form-check-label">
                        <input type="radio" class="form-check-input-styled-success" name="status" value="1" {{ $product->status != 2 ? 'checked' : '' }} data-fouc>
                        Active
                     </label>
                  </div>
               </div>
               <div class="form-group"><hr></div>
               <div class="form-group text-right">
                  <button type="reset" id="btn_reset" class="btn bg-danger btn-labeled btn-labeled-left">
                     <b><i class="icon-sync"></i></b> Reset Form
                  </button>
                  <button type="submit" id="btn_submit" class="btn bg-warning btn-labeled btn-labeled-left">
                     <b><i class="icon-pencil7"></i></b> Save
                  </button>
               </div>
            </form>
			</div>
		</div>
	</div>

<div class="modal fade" id="modal_form" data-backdrop="static" role="dialog">
   <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Shading</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="form-group">
               <label>Warehouse :<span class="text-danger">*</span></label>
               <select name="shading_warehouse" id="shading_warehouse" class="select2">
                  <option value="">-- Choose --</option>
                  @foreach($warehouse as $w)
                     <option value="{{ $w->code }};{{ $w->name }}">{{ $w->name }}</option>
                  @endforeach
               </select>
            </div>
            <div class="form-group">
               <label>Code :<span class="text-danger">*</span></label>
               <input type="text" name="shading_code" id="shading_code" class="form-control" placeholder="Enter code">
            </div>
            <div class="form-group">
               <label>Qty :</label>
               <input type="number" name="shading_qty" id="shading_qty" class="form-control" placeholder="Enter qty">
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="icon-switch2"></i> Close</button>
            <button type="button" class="btn btn-success" onclick="addShading()"><i class="icon-plus3"></i> Add</button>
         </div>
      </div>
   </div>
</div>

<script>
   $(function() {
      $('#datatable_shading').DataTable();
      CKEDITOR.replace('description');

      $('#datatable_shading tbody').on('click', '#delete_data_shading', function () {
         $('#datatable_shading').DataTable().row($(this).parents('tr')).remove().draw();
      });

      $('a[data-toggle="tab"]').on('shown.bs.tab', function() {
         $('#datatable_shading').DataTable().columns.adjust();
      });

      $('#btn_submit').click(function() {
         $('#btn_reset').attr('disabled', true);
         $('#btn_submit').attr('disabled', true);
         $('#btn_submit').html('<b><i class="icon-spinner4 spinner"></i></b> Processed ...');
         $('#form_data').submit();
      });

      select2ServerSide('#type_id', '{{ url("admin/select2/type") }}');
   });

   function generateCode() {
      $.ajax({
         url: '{{ url("admin/product/code/generate_code") }}',
         type: 'POST',
         dataType: 'JSON',
         data: {
            company_id: $('#company_id').val(),
            brand_id: $('#brand_id').val(),
            country_id: $('#country_id').val(),
            type_id: $('#type_id').val(),
            grade_id: $('#grade_id').val()
         },
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function(response) {
            $('#code').val(response);
         },
         error: function() {
            swalInit({
               title: 'Server Error',
               text: 'Please contact developer',
               type: 'error'
            });
         }
      });
   }

   function addShading() {
      let shading_warehouse = $('#shading_warehouse');
      let shading_code      = $('#shading_code');
      let shading_qty       = $('#shading_qty');

      if(!shading_warehouse.val() || !shading_code.val() || !shading_qty.val()) {
         swalInit({
            title: 'Please fill in all fields.',
            type: 'info'
         });
      } else {
         let arr_shading_warehouse = shading_warehouse.val().split(';');

         $('#datatable_shading').DataTable().row.add([
            arr_shading_warehouse[1],
            shading_code.val(),
            shading_qty.val(),
            `
               <button type="button" class="btn bg-danger btn-sm" id="delete_data_shading"><i class="icon-trash-alt"></i></button>
               <input type="hidden" name="shading_warehouse_code[]" value="` + arr_shading_warehouse[0] + `">
               <input type="hidden" name="shading_warehouse_name[]" value="` + arr_shading_warehouse[1] + `">
               <input type="hidden" name="shading_code[]" value="` + shading_code.val() + `">
               <input type="hidden" name="shading_qty[]" value="` + shading_qty.val() + `">
            `
         ]).draw().node();

         shading_warehouse.val(null).trigger('change');
         shading_code.val(null);
         shading_qty.val(null);
         $('#modal_form').modal('hide');
      }
   }
</script>