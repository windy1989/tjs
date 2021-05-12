<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Price Cogs</span>
				</h4>
			</div>
			<div class="header-elements">
				<div class="d-flex justify-content-center">
					<button type="button" class="btn bg-success btn-labeled mr-2 btn-labeled-left" onclick="loadDataTable()">
						<b><i class="icon-sync"></i></b> Refresh Data
					</button>
					<a href="{{ url('admin/price/cogs/create') }}" class="btn bg-primary btn-labeled btn-labeled-left">
						<b><i class="icon-plus3"></i></b> Add Data
					</a>
				</div>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<a href="javascript:void(0);" class="breadcrumb-item">Price</a>
					<span class="breadcrumb-item active">Cogs</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="card">
			<div class="card-header header-elements-inline mb-3">
				<h5 class="card-title">List Data Cogs</h5>
			</div>
			<div class="card-body">
            <div class="table-responsive">
               <table id="datatable_serverside" class="table table-bordered table-striped w-100">
                  <thead class="bg-dark">
                     <tr class="text-center">
                        <th>No</th>
                        <th>Product</th>
                        <th>Currency</th>
                        <th>City</th>
                        <th>Shipping</th>
                        <th>Action</th>
                     </tr>
                  </thead>
               </table>
            </div>
			</div>
		</div>
	</div>

<div class="modal fade" id="modal_form" data-backdrop="static" role="dialog">
   <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header bg-light">
            <h5 class="modal-title" id="exampleModalLabel">Detail Price Cogs</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="card border-top-2 border-top-success">
               <div class="card-header">
                  <h6 class="card-title font-weight-bold text-center">Product</h6>
               </div>
               <div class="card-body">
                  <div class="text-center" id="detail_product"></div>
               </div>
            </div>
            <div class="form-group"><hr></div>
            <div class="row justify-content-center">
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Origin Country</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_origin_country"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Length</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_length"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Width</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_width"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Pcs</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_pcs_ctn"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Thickness</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_thickness"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Min Total (Dos)</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_min_total_dos"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Container</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_container"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Unit Currency</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_currency"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Price Profile Custom</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_price_profile_custom"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Product Price</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_product_price"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Buying Unit</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_buying_unit"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Selling Unit</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_selling_unit"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Conversion Unit</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_conversion_unit"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Rate Unit</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_rate_unit"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Local Price IDR</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_local_price_idr"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Total SQM Load</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_total_sqm_load"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Agent Fee In USD (Container)</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_agent_fee_usd"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Agent Fee In USD (SQM)</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_agent_fee_usd_sqm"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Agent Fee In IDR</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_agent_fee_idr"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Destination Port</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_city"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Shipping</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_shipping"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Freight Cost in USD</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_freight_cost_usd"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">CBM</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_cbm_container"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Kg</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_kg_dos"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Total Weight (Kg)</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_total_weight_container"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Tonnage Of Container</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_tonnage_of_container"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">SQM</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_sqm_dos"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Freight Cost</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_freight_cost"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Import</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_import"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Landed Cost</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_landed_cost_container"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Total Landed Cost</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_total_landed_cost"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">LS Cost Document</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_ls_cost_document"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Number Of Container</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_number_container"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Rate Of In USD</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_rate_of_usd"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">LS Cost SQM</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_ls_cost_sqm"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Import Duty</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_import_duty"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Value Tax</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_value_tax"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Income Tax</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_income_tax"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Total Import Tax</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_total_import_tax"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Safe Guard</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_safe_guard"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">SNI Cost</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_sni_cost"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Cogs In IDR</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_cogs_idr"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Cogs PTA In IDR</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_cogs_pta_idr"></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="card border-top-2 border-top-success" style="min-height:121px;">
                     <div class="card-header">
                        <h6 class="card-title font-weight-bold text-center">Cogs SMB In IDR</h6>
                     </div>
                     <div class="card-body">
                        <div class="text-center" id="detail_cogs_smb_idr"></div>
                     </div>
                  </div>
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
            url: '{{ url("admin/price/cogs/datatable") }}',
            type: 'POST',
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
            { name: 'product_id', className: 'text-center align-middle' },
            { name: 'currency_id', className: 'text-center align-middle' },
            { name: 'city_id', className: 'text-center align-middle' },
            { name: 'shipping', searchable: false, className: 'text-center align-middle' },
            { name: 'action', searchable: false, orderable: false, className: 'text-center nowrap align-middle' }
         ]
      }); 
   }

   function show(id) {
      $('#modal_form').modal('show');
      $.ajax({
         url: '{{ url("admin/price/cogs/show") }}',
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
            console.log(response);
            loadingClose('.modal-content');
            $('#detail_product').html(response.product);
            $('#detail_currency').html(response.currency);
            $('#detail_city').html(response.city);
            $('#detail_import').html(response.import);
            $('#detail_price_profile_custom').html(response.price_profile_custom);
            $('#detail_agent_fee_usd').html(response.agent_fee_usd);
            $('#detail_shipping').html(response.shipping);
            $('#detail_ls_cost_document').html(response.ls_cost_document);
            $('#detail_number_container').html(response.number_container);
            $('#detail_sni_cost').html(response.sni_cost);
            $('#detail_origin_country').html(response.origin_country);
            $('#detail_length').html(response.lengths);
            $('#detail_width').html(response.width);
            $('#detail_pcs_ctn').html(response.pcs_ctn);
            $('#detail_thickness').html(response.thickness);
            $('#detail_min_total_dos').html(response.min_total_dos);
            $('#detail_container').html(response.container);
            $('#detail_product_price').html(response.product_price);
            $('#detail_buying_unit').html(response.buying_unit);
            $('#detail_selling_unit').html(response.selling_unit);
            $('#detail_conversion_unit').html(response.conversion_unit);
            $('#detail_rate_unit').html(response.rate_unit);
            $('#detail_local_price_idr').html(response.local_price_idr);
            $('#detail_total_sqm_load').html(response.total_sqm_load);
            $('#detail_agent_fee_usd_sqm').html(response.agent_fee_usd_sqm);
            $('#detail_agent_fee_idr').html(response.agent_fee_idr);
            $('#detail_freight_cost_usd').html(response.freight_cost_usd);
            $('#detail_cbm_container').html(response.cbm_container);
            $('#detail_kg_dos').html(response.kg_dos);
            $('#detail_total_weight_container').html(response.total_weight_container);
            $('#detail_tonnage_of_container').html(response.tonnage_of_container);
            $('#detail_sqm_dos').html(response.sqm_dos);
            $('#detail_freight_cost').html(response.freight_cost);
            $('#detail_landed_cost_container').html(response.landed_cost_container);
            $('#detail_total_landed_cost').html(response.total_landed_cost);
            $('#detail_rate_of_usd').html(response.rate_of_usd);
            $('#detail_ls_cost_sqm').html(response.ls_cost_sqm);
            $('#detail_import_duty').html(response.import_duty);
            $('#detail_value_tax').html(response.value_tax);
            $('#detail_income_tax').html(response.income_tax);
            $('#detail_total_import_tax').html(response.total_import_tax);
            $('#detail_safe_guard').html(response.safe_guard);
            $('#detail_cogs_idr').html(response.cogs_idr);
            $('#detail_cogs_pta_idr').html(response.cogs_pta_idr);
            $('#detail_cogs_smb_idr').html(response.cogs_smb_idr);
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