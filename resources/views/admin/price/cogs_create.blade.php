<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Create New Price Cogs</span>
				</h4>
			</div>
			<div class="header-elements">
				<div class="d-flex justify-content-center">
					<a href="{{ url('admin/price/cogs') }}" class="btn bg-secondary btn-labeled btn-labeled-left">
						<b><i class="icon-arrow-left7"></i></b> Back To List
					</a>
				</div>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<a href="javascript:void(0);" class="breadcrumb-item">Price</a>
					<a href="{{ url('admin/price/cogs') }}" class="breadcrumb-item">Cogs</a>
					<span class="breadcrumb-item active">Add Data</span>
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
               <div class="form-group">
                  <label>Product :<span class="text-danger">*</span></label>
                  <select name="product_id" onchange="getCompleteData()" id="product_id"></select>
               </div>
               <div class="form-group"><hr></div>
               <div class="row justify-content-center">
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Origin Country</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="origin_country">0</div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Length</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="length">0 Cm</div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Width</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="width">0 Cm</div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Pcs</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="pcs_ctn">0 <sub>/ ctn</sub></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Thickness</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="thickness">0 mm</div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Min Total (Dos)</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="min_total_dos">0 mm <sub>/ container</sub></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Container</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="container">0</div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Unit Currency</h6>
                        </div>
                        <div class="card-body">
                           <select name="currency_id" id="currency_id" class="custom-select">
                              <option value="">-- Choose --</option>
                              @foreach($currency as $c)
                                 <option value="{{ $c->id }}">{{ $c->code }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Price Profile Custom</h6>
                        </div>
                        <div class="card-body">
                           <input type="number" name="price_profile_custom" id="price_profile_custom" class="form-control" onkeyup="getCompleteData()" placeholder="Enter number">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Product Price</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="product_price">0</div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Buying Unit</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="buying_unit">0</div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Selling Unit</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="selling_unit">0</div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Conversion Unit</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="conversion_unit">0</div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Rate Unit</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="rate_unit">0</div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Local Price IDR</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="local_price_idr">0</div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Total SQM Load</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="total_sqm_load">0 <sub>/ container</sub></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Agent Fee In USD (Container)</h6>
                        </div>
                        <div class="card-body">
                           <div class="input-group">
                              <input type="number" name="agent_fee_usd" id="agent_fee_usd" class="form-control" placeholder="Enter number">
                              <div class="input-group-prepend">
                                 <span class="input-group-text">container</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Agent Fee In USD (SQM)</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="agent_fee_usd_sqm">0 <sub>/ SQM</sub></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Agent Fee In IDR</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="agent_fee_idr">0</div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Destination Port</h6>
                        </div>
                        <div class="card-body">
                           <select name="city_id" id="city_id" class="select2">
                              <option value="">-- Choose --</option>
                              @foreach($city as $c)
                                 <option value="{{ $c->id }}">{{ $c->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Shipping</h6>
                        </div>
                        <div class="card-body">
                           <select name="shipping" id="shipping" class="custom-select">
                              <option value="">-- Choose --</option>
                              <option value="1">FOB</option>
                              <option value="2">EXWORK</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Freight Cost in USD</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="freight_cost_usd">0 <sub>/ container</sub></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">CBM</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="cbm_container">0 <sub>/ container</sub></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Kg</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="kg_dos">0 <sub>/ dos</sub></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Total Weight (Kg)</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="total_weight_container">0 <sub>/ container</sub></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Tonnage Of Container</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="tonnage_of_container">0%</div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">SQM</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="sqm_dos">0 <sub>/ dos</sub></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Freight Cost</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="freight_cost">0</div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Import</h6>
                        </div>
                        <div class="card-body">
                           <select name="import" id="import" class="custom-select">
                              <option value="">-- Choose --</option>
                              @foreach($import as $i)
                                 <option value="{{ $i->id }}">{{ $i->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Landed Cost</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="origin_country">0 <sub>/ container</sub></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Total Landed Cost</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="total_landed_cost">0 <sub>/ SQM</sub></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">LS Cost</h6>
                        </div>
                        <div class="card-body">
                           <div class="input-group">
                              <input type="number" name="ls_cost" id="ls_cost" class="form-control" onkeyup="getCompleteData()" placeholder="Enter number">
                              <div class="input-group-prepend">
                                 <span class="input-group-text">document</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Number Of Container</h6>
                        </div>
                        <div class="card-body">
                           <div class="input-group">
                              <input type="number" name="number_container" id="number_container" class="form-control" onkeyup="getCompleteData()" placeholder="Enter number">
                              <div class="input-group-prepend">
                                 <span class="input-group-text">document</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Rate Of In USD</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="rate_of_usd">0</div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">LS Cost</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="ls_cost">0 <sub>/ SQM</sub></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Import Duty</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="import_duty">0 <sub>/ SQM</sub></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Value Tax</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="value_tax">0 <sub>/ SQM</sub></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Income Tax</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="income_tax">0 <sub>/ SQM</sub></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Total Import Tax</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="total_import_tax">0 <sub>/ SQM</sub></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Safe Guard</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="safe_guard">0 <sub>/ SQM</sub></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">SNI Cost</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="sni_cost">0 <sub>/ SQM</sub></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Cogs In IDR</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="cogs_idr">0 <sub>/ SQM</sub></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Cogs PTA In IDR</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="cogs_pta_idr">0 <sub>/ SQM</sub></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="card" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Cogs SMB In IDR</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="cogs_smb_idr">0 <sub>/ SQM</sub></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="form-group"><hr></div>
               <div class="form-group text-right">
                  <button type="reset" id="btn_reset" class="btn bg-danger btn-labeled btn-labeled-left">
                     <b><i class="icon-sync"></i></b> Reset Form
                  </button>
                  <button type="submit" id="btn_submit" class="btn bg-primary btn-labeled btn-labeled-left">
                     <b><i class="icon-plus3"></i></b> Submit
                  </button>
               </div>
            </form>
			</div>
		</div>
	</div>

<script>
   $(function() {
      $('#btn_submit').click(function() {
         $('#btn_reset').attr('disabled', true);
         $('#btn_submit').attr('disabled', true);
         $('#btn_submit').html('<b><i class="icon-spinner4 spinner"></i></b> Processed ...');
         $('#form_data').submit();
      });

      getCompleteData();
      select2ServerSide('#product_id', '{{ url("admin/select2/product") }}');
   });

   function reset() {
      
   }

   function getCompleteData() {
      if($('#product_id').val()) {
         $.ajax({
            url: '{{ url("admin/price/cogs/get_complete_data") }}',
            type: 'GET',
            dataType: 'JSON',
            data: {
               product_id: $('#product_id').val(),
               currency_id: $('#currency_id').val(),
               price_profile_custom: $('#currency_id').val(),
               agent_fee_usd: $('#currency_id').val(),
               city_id: $('#city_id').val(),
               shipping: $('#shipping').val(),
               ls_cost: $('#ls_cost').val(),
               import_id: $('#import_id').val(),
               number_container: $('#number_container').val()
            },
            success: function(response) {

            }
         });
      } else {
         reset();
      }
   }
</script>