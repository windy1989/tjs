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
					<a href="javascript:void();" class="breadcrumb-item">Price</a>
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
                  <select name="product_id" onchange="getCompleteData()" id="product_id">
                     @if(old('product_id'))
                        @php $product = App\Models\Product::find(old('product_id')); @endphp
                        <option value="{{ $product->id }}" selected>{{ $product->code() }}</option>
                     @endif
                  </select>
               </div>
               <div class="form-group"><hr></div>
               <div class="row justify-content-center">
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Origin Country</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="origin_country"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Length</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="length"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Width</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="width"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Pcs</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="pcs_ctn"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Thickness</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="thickness"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Min Total (Dos)</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="min_total_dos"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Container</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="container"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-danger" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Unit Currency</h6>
                        </div>
                        <div class="card-body">
                           <select name="currency_id" id="currency_id" class="custom-select @error('currency_id') validation-select @enderror" onchange="getCompleteData()">
                              <option value="">-- Choose --</option>
                              @foreach($currency as $c)
                                 <option value="{{ $c->id }}" {{ old('currency_id') == $c->id ? 'selected' : '' }}>{{ $c->code }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-danger" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Price Profile Custom</h6>
                        </div>
                        <div class="card-body">
                           <input type="number" name="price_profile_custom" id="price_profile_custom" class="form-control @error('price_profile_custom') border-danger @enderror" title="@error('price_profile_custom') {{ $message }} @enderror" value="{{ old('price_profile_custom') }}" onkeyup="getCompleteData()" placeholder="0">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Product Price</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="product_price"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Buying Unit</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="buying_unit"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Selling Unit</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="selling_unit"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Conversion Unit</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="conversion_unit"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Rate Unit</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="rate_unit"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Local Price IDR</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="local_price_idr"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Total SQM Load</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="total_sqm_load"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-danger" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Agent Fee In USD (Container)</h6>
                        </div>
                        <div class="card-body">
                           <div class="form-group form-group-feedback form-group-feedback-right">
                              <div class="position-relative">
                                 <input type="number" name="agent_fee_usd" id="agent_fee_usd" class="form-control @error('agent_fee_usd') border-danger @enderror" title="@error('agent_fee_usd') {{ $message }} @enderror" value="{{ old('agent_fee_usd') }}" placeholder="0">
                                 <div class="form-control-feedback font-weight-bold">container</div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Agent Fee In USD (SQM)</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="agent_fee_usd_sqm"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Agent Fee In IDR</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="agent_fee_idr"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-danger" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Destination Port</h6>
                        </div>
                        <div class="card-body">
                           <select name="city_id" id="city_id" class="custom-select @error('city_id') validation-select @enderror" onchange="getCompleteData()">
                              <option value="">-- Choose --</option>
                              @foreach($city as $c)
                                 <option value="{{ $c->id }}" {{ old('city_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-danger" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Shipping</h6>
                        </div>
                        <div class="card-body">
                           <select name="shipping" id="shipping" class="custom-select @error('shipping') validation-select @enderror" onchange="getCompleteData()">
                              <option value="">-- Choose --</option>
                              <option value="1" {{ old('shipping') == 1 ? 'selected' : '' }}>FOB</option>
                              <option value="2" {{ old('shipping') == 2 ? 'selected' : '' }}>EXWORK</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Freight Cost in USD</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="freight_cost_usd"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">CBM</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="cbm_container"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Kg</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="kg_dos"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Total Weight (Kg)</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="total_weight_container"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Tonnage Of Container</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="tonnage_of_container"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">SQM</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="sqm_dos"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Freight Cost</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="freight_cost"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-danger" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Import</h6>
                        </div>
                        <div class="card-body">
                           <select name="import_id" id="import_id" class="custom-select @error('import_id') validation-select @enderror">
                              <option value="">-- Choose --</option>
                              @foreach($import as $i)
                                 <option value="{{ $i->id }}" {{ old('import_id') == $i->id ? 'selected' : '' }}>{{ $i->name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Landed Cost</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="landed_cost_container"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Total Landed Cost</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="total_landed_cost"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-danger" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">LS Cost</h6>
                        </div>
                        <div class="card-body">
                           <div class="form-group form-group-feedback form-group-feedback-right">
                              <div class="position-relative">
                                 <input type="number" name="ls_cost_document" id="ls_cost_document" class="form-control @error('ls_cost_document') border-danger @enderror" title="@error('ls_cost_document') {{ $message }} @enderror" value="{{ old('ls_cost_document') }}" onkeyup="getCompleteData()" placeholder="0">
                                 <div class="form-control-feedback font-weight-bold">document</div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-danger" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Number Of Container</h6>
                        </div>
                        <div class="card-body">
                           <div class="form-group form-group-feedback form-group-feedback-right">
                              <div class="position-relative">
                                 <input type="number" name="number_container" id="number_container" class="form-control @error('number_container') border-danger @enderror" title="@error('number_container') {{ $message }} @enderror" value="{{ old('number_container') }}" onkeyup="getCompleteData()" placeholder="0">
                                 <div class="form-control-feedback font-weight-bold">document</div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Rate Of In USD</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="rate_of_usd"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">LS Cost</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="ls_cost_sqm"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Import Duty</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="import_duty"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Value Tax</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="value_tax"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Income Tax</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="income_tax"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Total Import Tax</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="total_import_tax"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Safe Guard</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="safe_guard"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-danger" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">SNI Cost</h6>
                        </div>
                        <div class="card-body">
                           <div class="form-group form-group-feedback form-group-feedback-right">
                              <div class="position-relative">
                                 <input type="number" name="sni_cost" id="sni_cost" class="form-control @error('sni_cost') border-danger @enderror" title="@error('sni_cost') {{ $message }} @enderror" value="{{ old('sni_cost') }}" onkeyup="getCompleteData()" placeholder="0">
                                 <div class="form-control-feedback font-weight-bold">SQM</div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Cogs In IDR</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="cogs_idr"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Cogs PTA In IDR</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="cogs_pta_idr"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="card border-top-2 border-top-success" style="min-height:121px;">
                        <div class="card-header">
                           <h6 class="card-title font-weight-bold text-center">Cogs SMB In IDR</h6>
                        </div>
                        <div class="card-body">
                           <div class="text-center" id="cogs_smb_idr"></div>
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

      reset();
      select2ServerSide('#product_id', '{{ url("admin/select2/product") }}');
   });

   function reset() {
      $('#origin_country').html('-');
      $('#length').html('0 Cm');
      $('#width').html('0 Cm');
      $('#pcs_ctn').html('0 <sub>/ carton</sub>');
      $('#thickness').html('0 mm');
      $('#min_total_dos').html('0 mm <sub>/ container</sub>');
      $('#container').html('0');
      $('#currency_id').val(null);
      $('#price_profile_custom').val(null);
      $('#product_price').html('0');
      $('#buying_unit').html('-');
      $('#selling_unit').html('-');
      $('#conversion_unit').html('0');
      $('#rate_unit').html('0');
      $('#local_price_idr').html('0');
      $('#total_sqm_load').html('0 <sub>/ container</sub>');
      $('#agent_fee_usd').val(null);
      $('#agent_fee_usd_sqm').html('0 <sub>/ SQM</sub>');
      $('#agent_fee_idr').html('0');
      $('#city_id').val(null);
      $('#shipping').val(null);
      $('#freight_cost_usd').html('0 <sub>/ container</sub>');
      $('#cbm_container').html('0 <sub>/ container</sub>');
      $('#kg_dos').html('0 <sub>/ dos</sub>');
      $('#total_weight_container').html('0 <sub>/ container</sub>');
      $('#tonnage_of_container').html('0%');
      $('#sqm_dos').html('0 <sub>/ Dos</sub>');
      $('#freight_cost').html('0');
      $('#import_id').val(null);
      $('#landed_cost_container').html('0 <sub>/ container</sub>');
      $('#total_landed_cost').html('0 <sub>/ SQM</sub>');
      $('#ls_cost_document').val(null);
      $('#number_container').val(null);
      $('#rate_of_usd').html('0');
      $('#ls_cost_sqm').html('0 <sub>/ SQM</sub>');
      $('#import_duty').html('0 <sub>/ SQM</sub>');
      $('#value_tax').html('0 <sub>/ SQM</sub>');
      $('#income_tax').html('0 <sub>/ SQM</sub>');
      $('#total_import_tax').html('0 <sub>/ SQM</sub>');
      $('#safe_guard').html('0 <sub>/ SQM</sub>');
      $('#sni_cost').val(null);
      $('#cogs_idr').html('0 <sub>/ SQM</sub>');
      $('#cogs_pta_idr').html('0 <sub>/ SQM</sub>');
      $('#cogs_smb_idr').html('0 <sub>/ SQM</sub>');
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
               price_profile_custom: $('#price_profile_custom').val(),
               agent_fee_usd: $('#agent_fee_usd').val(),
               city_id: $('#city_id').val(),
               shipping: $('#shipping').val(),
               ls_cost_document: $('#ls_cost_document').val(),
               import_id: $('#import_id').val(),
               number_container: $('#number_container').val(),
               sni_cost: $('#sni_cost').val()
            },
            success: function(response) {
               $('#origin_country').html(response.origin_country);
               $('#length').html(response.lengths);
               $('#width').html(response.width);
               $('#pcs_ctn').html(response.pcs_ctn);
               $('#thickness').html(response.thickness);
               $('#min_total_dos').html(response.min_total_dos);
               $('#container').html(response.container);
               $('#product_price').html(response.product_price);
               $('#buying_unit').html(response.buying_unit);
               $('#selling_unit').html(response.selling_unit);
               $('#conversion_unit').html(response.conversion_unit);
               $('#rate_unit').html(response.rate_unit);
               $('#local_price_idr').html(response.local_price_idr);
               $('#total_sqm_load').html(response.total_sqm_load);
               $('#agent_fee_usd_sqm').html(response.agent_fee_usd_sqm);
               $('#agent_fee_idr').html(response.agent_fee_idr);
               $('#freight_cost_usd').html(response.freight_cost_usd);
               $('#cbm_container').html(response.cbm_container);
               $('#kg_dos').html(response.kg_dos);
               $('#total_weight_container').html(response.total_weight_container);
               $('#tonnage_of_container').html(response.tonnage_of_container);
               $('#sqm_dos').html(response.sqm_dos);
               $('#freight_cost').html(response.freight_cost);
               $('#landed_cost_container').html(response.landed_cost_container);
               $('#total_landed_cost').html(response.total_landed_cost);
               $('#rate_of_usd').html(response.rate_of_usd);
               $('#ls_cost_sqm').html(response.ls_cost_sqm);
               $('#import_duty').html(response.import_duty);
               $('#value_tax').html(response.value_tax);
               $('#income_tax').html(response.income_tax);
               $('#total_import_tax').html(response.total_import_tax);
               $('#safe_guard').html(response.safe_guard);
               $('#cogs_idr').html(response.cogs_idr);
               $('#cogs_pta_idr').html(response.cogs_pta_idr);
               $('#cogs_smb_idr').html(response.cogs_smb_idr);
            }
         });
      } else {
         reset();
         swalInit.fire({
            title: 'Please select a product',
            type: 'info'
         });
      }
   }
</script>