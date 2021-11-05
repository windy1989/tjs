<style>
   html {
      scroll-behavior: smooth;
   }
	
	.sidebar-sticky{
		position: -webkit-sticky;
		position: sticky;
		top: 0;
		overflow: visible;
	}
	
	.sidebar-content::-webkit-scrollbar {
	  width: 0px;
	  height: 8px;
	  background-color: white;
	}
	
	.sidebar-light .nav-sidebar .nav-link {
		color:white !important;
	}
	
	.sidebar-light .nav-sidebar .nav-link:hover{
		background-color:#457c80 !important;
		transform: scale(1.10);
	}
	
	.icon-check.text-success {
		color:#92ff01 !important;
	}
</style>
<div class="content-sticky">
	<div class="sidebar-sticky">
		<!-- Secondary sidebar -->
		<div class="sidebar sidebar-light sidebar-secondary sidebar-expand-md">

			<!-- Sidebar mobile toggler -->
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-secondary-toggle">
					<i class="icon-arrow-left8"></i>
				</a>
				<span class="font-weight-semibold">Secondary sidebar</span>
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div>
			<!-- /sidebar mobile toggler -->

			<!-- Sidebar content -->
			<div class="sidebar-content" style="height:100vh !important;overflow-y: scroll;background-color:#457c80 !important;">

				<div class="card">
					 <div class="card-header bg-transparent header-elements-inline" style="background-color:#457c80 !important;color:white !important;">
						<span class="text-uppercase font-size-sm font-weight-semibold">Progress</span>
					 </div>
					 <ul class="nav nav-sidebar nav-scrollspy">
						<li class="nav-item">
						   <a href="#step-1" class="nav-link">
							  <i class="icon-check text-success"></i>
							  Project Information
							  <span class="badge bg-warning badge-pill ml-auto">10%</span>
						   </a>
						</li>
						<li class="nav-item">
						   <a href="#step-2" class="nav-link">
							  @if($project->progress >= 15)
								 <i class="icon-check text-success"></i>
							  @else
								 <i class="icon-spinner10"></i>
							  @endif
							  Spec Project
							  <span class="badge bg-warning badge-pill ml-auto">15%</span>
						   </a>
						</li>
						<li class="nav-item">
						   <a href="#step-3" class="nav-link {{ $project->progress >= 15 ? '' : 'disabled' }}">
							  @if($project->progress >= 20)
								 <i class="icon-check text-success"></i>
							  @else
								 <i class="icon-spinner10"></i>
							  @endif
							  Consultant Meeting
							  <span class="badge bg-warning badge-pill ml-auto">20%</span>
						   </a>
						</li>
						<li class="nav-item">
						   <a href="#step-4" class="nav-link {{ $project->progress >= 20 ? '' : 'disabled' }}">
							  @if($project->progress >= 25)
								 <i class="icon-check text-success"></i>
							  @else
								 <i class="icon-spinner10"></i>
							  @endif
							  Quotation
							  <span class="badge bg-warning badge-pill ml-auto">25%</span>
						   </a>
						</li>
						<li class="nav-item">
						   <a href="#step-5" class="nav-link {{ $project->progress >= 25 ? '' : 'disabled' }}">
							  @if($project->progress >= 30)
								 <i class="icon-check text-success"></i>
							  @else
								 <i class="icon-spinner10"></i>
							  @endif
							  Form Sample
							  <span class="badge bg-warning badge-pill ml-auto">30%</span>
						   </a>
						</li>
						<li class="nav-item">
						   <a href="#step-6" class="nav-link {{ $project->progress >= 30 ? '' : 'disabled' }}">
							  @if($project->progress >= 35)
								 <i class="icon-check text-success"></i>
							  @else
								 <i class="icon-spinner10"></i>
							  @endif
							  Negotiation
							  <span class="badge bg-warning badge-pill ml-auto">35%</span>
						   </a>
						</li>
						<li class="nav-item">
						   <a href="#step-7" class="nav-link {{ $project->progress >= 35 ? '' : 'disabled' }}">
							  @if($project->progress >= 37)
								 <i class="icon-check text-success"></i>
							  @else
								 <i class="icon-spinner10"></i>
							  @endif
							  SO Project
							  <span class="badge bg-warning badge-pill ml-auto">37%</span>
						   </a>
						</li>
						<li class="nav-item">
						   <a href="#step-8" class="nav-link {{ $project->progress >= 37 ? '' : 'disabled' }}">
							  @if($project->progress >= 40)
								 <i class="icon-check text-success"></i>
							  @else
								 <i class="icon-spinner10"></i>
							  @endif
							  Down Payment
							  <span class="badge bg-warning badge-pill ml-auto">40%</span>
						   </a>
						</li>
						<li class="nav-item">
						   <hr style="width: 70%;border-top: 1px solid black;">
						   <a href="#step-9" class="nav-link {{ $project->progress >= 40 ? '' : 'disabled' }}">
							  @if($project->progress >= 43)
								 <i class="icon-check text-success"></i>
							  @else
								 <i class="icon-spinner10"></i>
							  @endif
							  PO Supplier
							  <span class="badge bg-warning badge-pill ml-auto">43%</span>
						   </a>
						</li>
						<li class="nav-item">
						   <a href="#step-10" class="nav-link {{ $project->progress >= 43 ? '' : 'disabled' }}">
							  @if($project->progress >= 45)
								 <i class="icon-check text-success"></i>
							  @else
								 <i class="icon-spinner10"></i>
							  @endif
							  Proof of Proforma Inv
							  <span class="badge bg-warning badge-pill ml-auto">45%</span>
						   </a>
						</li>
						<li class="nav-item">
						   <a href="#step-11" class="nav-link {{ $project->progress >= 45 ? '' : 'disabled' }}">
							  @if($project->progress >= 48)
								 <i class="icon-check text-success"></i>
							  @else
								 <i class="icon-spinner10"></i>
							  @endif
							  Down Payment Purchase
							  <span class="badge bg-warning badge-pill ml-auto">48%</span>
						   </a>
						</li>
						<li class="nav-item">
						   <a href="#step-12" class="nav-link {{ $project->progress >= 48 ? '' : 'disabled' }}">
							  @if($project->progress >= 50)
								 <i class="icon-check text-success"></i>
							  @else
								 <i class="icon-spinner10"></i>
							  @endif
							  Progress Production
							  <span class="badge bg-warning badge-pill ml-auto">50%</span>
						   </a>
						</li>
						<li class="nav-item">
						   <a href="#step-13" class="nav-link {{ $project->progress >= 50 ? '' : 'disabled' }}">
							  @if($project->progress >= 55)
								 <i class="icon-check text-success"></i>
							  @else
								 <i class="icon-spinner10"></i>
							  @endif
							  Pay Full Purchase
							  <span class="badge bg-warning badge-pill ml-auto">55%</span>
						   </a>
						</li>
						<li class="nav-item">
							
						   <a href="#step-14" class="nav-link {{ $project->progress >= 55 ? '' : 'disabled' }}">
							  @if($project->progress >= 60)
								 <i class="icon-check text-success"></i>
							  @else
								 <i class="icon-spinner10"></i>
							  @endif
							  Shipment
							  <span class="badge bg-warning badge-pill ml-auto">60%</span>
						   </a>
						</li>
						<li class="nav-item">
						   <a href="#step-15" class="nav-link {{ $project->progress >= 60 ? '' : 'disabled' }}">
								@if($project->progress >= 65)
								 <i class="icon-check text-success"></i>
								  @else
									 <i class="icon-spinner10"></i>
								  @endif
								Warehouse Receive
								<span class="badge bg-warning badge-pill ml-auto">65%</span>
						   </a>
						</li>
						
						<li class="nav-item">
							<hr style="width: 70%;border-top: 1px solid black;">
						   <a href="#step-16" class="nav-link {{ $project->progress >= 65 ? '' : 'disabled' }}">
							  @if($project->progress >= 75)
								 <i class="icon-check text-success"></i>
							  @else
								 <i class="icon-spinner10"></i>
							  @endif
							  Delivery To Project
							  <span class="badge bg-warning badge-pill ml-auto">75%</span>
						   </a>
						</li>
						<li class="nav-item">
						   <a href="#step-17" class="nav-link {{ $project->progress >= 75 ? '' : 'disabled' }}">
								@if($project->progress >= 80)
								 <i class="icon-check text-success"></i>
							  @else
								 <i class="icon-spinner10"></i>
							  @endif
								Sales Return
								<span class="badge bg-warning badge-pill ml-auto">80%</span>
						   </a>
						</li>
						<li class="nav-item">
						   <a href="#step-18" class="nav-link {{ $project->progress >= 80 ? '' : 'disabled' }}">
							  @if($project->progress >= 85)
								 <i class="icon-check text-success"></i>
							  @else
								 <i class="icon-spinner10"></i>
							  @endif
							  Process Payment
							  <span class="badge bg-warning badge-pill ml-auto">85%</span>
						   </a>
						</li>
						<li class="nav-item">
						   <a href="#step-19" class="nav-link {{ $project->progress >= 85 ? '' : 'disabled' }}">
							  @if($project->progress >= 90)
								 <i class="icon-check text-success"></i>
							  @else
								 <i class="icon-spinner10"></i>
							  @endif
							  Troubleshooting
							  <span class="badge bg-warning badge-pill ml-auto">90%</span>
						   </a>
						</li>
						<li class="nav-item">
						   <a href="#step-20" class="nav-link {{ $project->progress >= 90 ? '' : 'disabled' }}">
							  @if($project->progress >= 100)
								 <i class="icon-check text-success"></i>
							  @else
								 <i class="icon-spinner10"></i>
							  @endif
							  Done
							  <span class="badge bg-warning badge-pill ml-auto">100%</span>
						   </a>
						</li>
					 </ul>
				  </div>

			</div>
			<!-- /sidebar content -->

		</div>
		<!-- /secondary sidebar -->
	</div>
</div>
<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Progress Sales Project : <b><i>{{ $project->name }}</i></b></span>
				</h4>
			</div>
         <div class="header-elements">
				<div class="d-flex justify-content-center">
					<a href="{{ url('admin/purchase_order/project') }}" class="btn bg-secondary btn-labeled btn-labeled-left">
						<b><i class="icon-arrow-left7"></i></b> Back To All
					</a>
				</div>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<a href="javascript:void(0);" class="breadcrumb-item">Data</a>
					<a href="{{ url('admin/purchase_order/project') }}" class="breadcrumb-item">Project</a>
					<span class="breadcrumb-item active">Detail</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="d-block d-flex align-items-start flex-column flex-md-row">
         <div class="order-2 order-md-1 w-100">
			<div class="card" id="step-1">
               <div class="card-body">
                  <h3 class="card-title" id="scrollspy"><b>Project Information</b></h3>
                  <div class="form-group"><hr></div>
				  <div class="row">
					<div class="col-md-6">
						<dl class="row">
						  <dt class="col-sm-4">Project Name</dt>
						  <dd class="col-sm-8">: {{ $project->name }}</dd>
						  <dt class="col-sm-4">Phone</dt>
						  <dd class="col-sm-8">: {{ $project->customer->phone }}</dd>
						  <dt class="col-sm-4">Email</dt>
						  <dd class="col-sm-8">: {{ $project->customer->email }}</dd>
						  <dt class="col-sm-4">Constructor Name</dt>
						  <dd class="col-sm-8">: {{ $project->customer->constructor }}</dd>
						  <dt class="col-sm-4">Country</dt>
						  <dd class="col-sm-8">: {{ $project->country->name }}</dd>
						  <dt class="col-sm-4">City</dt>
						  <dd class="col-sm-8">: {{ $project->city->name }}</dd>
						  <dt class="col-sm-4">Timeline</dt>
						  <dd class="col-sm-8">: {{ date('d F Y', strtotime($project->timeline)) }}</dd>
						  <dt class="col-sm-4">Project Manager</dt>
						  <dd class="col-sm-8">: {{ $project->manager }}</dd>
						</dl>
					</div>
					<div class="col-md-6">
						<dl class="row">
						  <dt class="col-sm-4">Consultant Name</dt>
						  <dd class="col-sm-8">: {{ $project->consultant }}</dd>
						  <dt class="col-sm-4">Owner</dt>
						  <dd class="col-sm-8">: {!! $project->owner !!}</dd>
						  <dt class="col-sm-4">Bank Destination</dt>
						  <dd class="col-sm-8">: {!! $project->coa->name !!}</dd>
						  <dt class="col-sm-4">Payment Method</dt>
						  <dd class="col-sm-8">: {!! $project->paymentMethod() !!}</dd>
						  <dt class="col-sm-4">Payment Term</dt>
						  <dd class="col-sm-8">: {!! $project->paymentTerm() !!}</dd>
						  <dt class="col-sm-4">Supply Method</dt>
						  <dd class="col-sm-8">: {!! $project->supplyMethod() !!}</dd>
						  <dt class="col-sm-4">PPN</dt>
						  <dd class="col-sm-8">: {!! $project->ppn() !!}</dd>
						</dl>
					</div>
				  </div>
               </div>
            </div>
			
			@if($project->progress < 40)
				<div class="alert alert-warning alert-styled-left alert-dismissible">
					<button type="button" class="close" data-dismiss="alert"><span>×</span></button>
					<span class="font-weight-semibold">Warning!</span> This project <b>hasn't reached</b> 43% yet, please contact <b>Sales team</b> to complete their tasks.
				</div>
			@endif
			
            @if($project->progress >= 40)
               <div class="card" id="step-9">
                  <form action="{{ url()->full() }}" method="POST">
                     @csrf
                     <div class="card-body">
                        <h3 class="card-title" id="scrollspy"><b>PO Supplier</b></h3>
                        <div class="form-group"><hr></div>
						@if(isset($_GET['step-9']))
                           @if($errors->any())
                              <div class="alert bg-warning text-white alert-styled-left alert-dismissible">
                                 <button type="button" class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                 </button>
                                 <ul>
                                    @foreach ($errors->all() as $error)
                                       <li>{{ $error }}</li>
                                    @endforeach
                                 </ul>
                              </div>
                           @elseif(session('success'))
                              <div class="alert bg-teal text-white alert-styled-left alert-dismissible">
                                 <button type="button" class="close" data-dismiss="alert">
                                    <span>&times;</span>
                                 </button>
                                 {{ session('success') }}
                              </div>
                           @endif
                        @endif
						<div class="row">
							<div class="col-md-4">
								 <div class="form-group">
									<label>Sales Order :<sup class="text-danger">*</sup></label>
									<select name="so_id" id="so_id" class="select2" onchange="getSalesProduct(this,this.value);getSalesInfo(this,this.value);">
									   <option value="">-- Choose --</option>
									   @foreach($project->projectSale as $ps)
										  <option value="{{ $ps->id }}">{{ $ps->code }}</option>
									   @endforeach
									</select>
								 </div>
							</div>
							
							<div class="col-md-4">
							 <div class="form-group">
								<label>Customer :<sup class="text-danger">*</sup></label>
								<select name="customer_id" id="customer_id"></select>
							 </div>
							</div>
							<div class="col-md-4">
							 <div class="form-group">
								<label>Sales :<sup class="text-danger">*</sup></label>
								<select name="sales_po" id="sales_po"></select>
							 </div>
							</div>
							<div class="col-md-4">
								 <div class="form-group">
									<label>Purchase Note :</label>
									<textarea name="sales_note" id="sales_note" class="form-control" placeholder="Enter note here" rows="1" value="{{ old('sales_note') }}"></textarea>
							    </div>
							</div>
						</div>
						<h5 class="card-title"><b>Order To</b></h5>
                        <div class="form-group"><hr></div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Supplier :<sup class="text-danger">*</sup></label>
									<select name="supplier_id" id="supplier_id" onchange="getSupplierCurrency(this.value)"></select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Production Lead Time :<sup class="text-danger">*</sup></label>
									<input type="text" name="production_lead_time" id="production_lead_time" class="form-control" placeholder="Enter here" value="{{ old('production_lead_time') }}"></textarea>
							    </div>
							</div>
							<div class="col-md-4">
                                 <div class="form-group">
                                    <label>Estimated Delivery Date :<sup class="text-danger">*</sup></label>
                                    <input type="date" name="est_delivery_date" id="est_delivery_date" class="form-control" value="{{ old('est_delivery_date') }}">
                                 </div>
                             </div>
							<div class="col-md-4">
                                 <div class="form-group">
                                    <label>Estimated Arrival Date :<sup class="text-danger">*</sup></label>
                                    <input type="date" name="est_arrival_date" id="est_arrival_date" class="form-control" value="{{ old('est_arrival_date') }}">
                                 </div>
                             </div>
							 <div class="col-md-4">
								<div class="form-group">
									<label>Factory Name :<sup class="text-danger">*</sup></label>
									<input type="text" name="factory_name" id="factory_name" class="form-control" placeholder="Enter here" value="{{ old('factory_name') }}"></textarea>
							    </div>
							</div>
						</div>
						<h5 class="card-title"><b>Receiver Information</b></h5>
                        <div class="form-group"><hr></div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>On Behalf Of :<sup class="text-danger">*</sup></label>
									<input type="text" name="on_behalf" id="on_behalf" class="form-control" placeholder="Enter here" value="{{ old('on_behalf') }}"></textarea>
							    </div>
							</div>
							<div class="col-md-4">
								 <div class="form-group">
									<label>Delivery Address :<sup class="text-danger">*</sup></label>
									<textarea type="text" name="delivery_address" id="delivery_address" class="form-control" placeholder="Enter address here" rows="1" value="{{ old('delivery_address') }}"></textarea>
							    </div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Courier Method :<sup class="text-danger">*</sup></label>
									<input type="text" name="courier_method" id="courier_method" class="form-control" placeholder="Enter here" value="{{ old('courier_method') }}"></textarea>
							    </div>
							</div>
							<div class="col-md-4">
								 <div class="form-group">
									<label>Country :<sup class="text-danger">*</sup></label>
									<select name="country_id" id="country_id"></select>
								 </div>
							</div>
							<div class="col-md-4">
								 <div class="form-group">
									<label>City :<sup class="text-danger">*</sup></label>
									<select name="city_id" id="city_id"></select>
								 </div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>PIC Name :<sup class="text-danger">*</sup></label>
									<input type="text" name="pic_name" id="pic_name" class="form-control" placeholder="Enter here" value="{{ old('pic_name') }}"></textarea>
							    </div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>PIC Number :<sup class="text-danger">*</sup></label>
									<input type="text" name="pic_number" id="pic_number" class="form-control" placeholder="Enter here" value="{{ old('pic_number') }}"></textarea>
							    </div>
							</div>
						</div>
						<h5 class="card-title"><b>Payment Information</b></h5>
                        <div class="form-group"><hr></div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label>Payment Method :<sup class="text-danger">*</sup></label>
									<input type="text" name="payment_method" id="payment_method" class="form-control" placeholder="Enter here" value="{{ old('payment_method') }}"></textarea>
							    </div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Price :<sup class="text-danger">*</sup></label>
									<select name="price" id="price" class="form-control">
									   <option value="1">FOB</option>   
									   <option value="2">EXW</option>   
									   <option value="3">Franco</option> 
									   <option value="4">CIF</option>
									</select>
							    </div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Currency :<sup class="text-danger">*</sup></label>
									<select name="currency" id="currency" class="custom-select">
										<option value="" disabled selected>Select supplier first...</option>
									</select>
							    </div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Brand on box :</label>
									<input type="text" name="brand" id="brand" class="form-control" placeholder="Enter here" value="{{ old('brand') }}">
							    </div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>SNI No. :</label>
									<input type="text" name="sni" id="sni" class="form-control" placeholder="Enter here" value="{{ old('sni') }}">
							    </div>
							</div>
							
						</div>
						<h5 class="card-title"><b>Detail Products</b></h5>
                        <div class="form-group"><hr></div>
						<div class="form-group">
                           <div class="table-responsive">
                              <table class="table table-bordered table-striped" width="100%">
                                 <thead class="table-secondary">
                                    <tr class="text-center">
                                       <th width="10%">Product</th>
                                       <th width="10%">Qty Need</th>
									   <th width="10%">Qty Left</th>
									   <th width="10%">Qty Order</th>
									   <th width="15%">Price</th>
									   <th width="15%">Total</th>
									   <th width="20%">Remark</th>
									   <th>Delete</th>
                                    </tr>
                                 </thead>
                                 <tbody id="data_purchase">
                                    
                                 </tbody>
                              </table>
                           </div>
                        </div>
					   <div class="form-group"><hr></div>
					   <div class="form-group">
						  <div class="text-right">
							 <button type="submit" name="submit" value="step-9" class="btn bg-purple">Save & Next <i class="icon-square-right"></i></button>
						  </div>
					   </div>
					   <div class="form-group"><hr></div>
					   <div class="form-group">
							<h5><b>All Purchase Order</b></h5>
							<div class="table-responsive">
							  <table class="table table-bordered table-striped">
								 <thead class="table-secondary">
									<tr class="text-center">
									   <th>Code</th>
									   <th>SO No.</th>
									   <th>Supplier</th>
									   <th>Checked</th>
									   <th>Approved</th>
									   <th>View</th>
									</tr>
								 </thead>
								 <tbody>
									@foreach($project->projectPurchase as $pp)
									   <tr class="text-center">
										  <td class="align-middle">{{ $pp->code }}</td>
										  <td class="align-middle">{{ $pp->projectSale->code }}</td>
										  <td class="align-middle">{{ $pp->supplier->name }}</td>
										  <td class="align-middle">
											@php
												if(isset($pp->checked->name)){
													echo $pp->checked->name;
												}else{
													echo '<button type="button" class="btn btn-primary btn-icon" onclick="approvePurchase(1,'.$pp->id.')"><i class="icon-checkmark2"></i></button>';
												}
											@endphp
										  </td>   
										  <td class="align-middle">
											@php
												if(isset($pp->approved->name)){
													echo $pp->approved->name;
												}else{
													echo '<button type="button" class="btn btn-primary btn-icon" onclick="approvePurchase(2,'.$pp->id.')"><i class="icon-checkmark2"></i></button>';
												}
											@endphp
										  </td>
										  <td>
											@php
												echo '<a href="'.url('admin/purchase_order/project/print/purchase_order/' . base64_encode($pp->id)).'" class="btn bg-info" target="_blank"><i class="icon-file-pdf"></i></a>';
											@endphp
										  </td>
									   </tr>
									@endforeach
								 </tbody>
							  </table>
						   </div>
						</div>
					   
                     </div>
                  </form>
               </div>
            @endif
            @if($project->progress >= 43)
               <div class="card" id="step-10">
                  <form action="{{ url()->full() }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="card-body">
                        <h3 class="card-title" id="scrollspy"><b>Proof of Proforma Invoice</b></h3>
                        <div class="form-group"><hr></div>
						<div class="alert alert-info alert-styled-left alert-dismissible">
							<button type="button" class="close" data-dismiss="alert"><span>×</span></button>
							<span class="font-weight-semibold">Attention!</span> Please select purchase order first before input the proforma invoice.
						</div>
						@if(isset($_GET['step-10']))
						  @if($errors->any())
							 <div class="alert bg-warning text-white alert-styled-left alert-dismissible">
								<button type="button" class="close" data-dismiss="alert">
								   <span>&times;</span>
								</button>
								<ul>
								   @foreach ($errors->all() as $error)
									  <li>{{ $error }}</li>
								   @endforeach
								</ul>
							 </div>
						  @elseif(session('success'))
							 <div class="alert bg-teal text-white alert-styled-left alert-dismissible">
								<button type="button" class="close" data-dismiss="alert">
								   <span>&times;</span>
								</button>
								{{ session('success') }}
							 </div>
						  @endif
					   @endif
					   <div class="row">
							<div class="col-md-4">
								 <div class="form-group">
									<label>Purchase Order :<sup class="text-danger">*</sup></label>
									<select name="pop_id" id="pop_id" class="select2" onchange="getPurchaseInfo(this,this.value);">
									   <option value="">-- Choose --</option>
									   @foreach($project->projectPurchase as $pp)
										  <option value="{{ $pp->id }}">{{ $pp->code.' - '.$pp->supplier->name.' - '.$pp->projectSale->code }}</option>
									   @endforeach
									</select>
								 </div>
							</div>
							<div class="col-md-4">
								 <div class="form-group">
									<label>Date :<sup class="text-danger">*</sup></label>
									<input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}">
								 </div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Supplier :</label>
									<input type="text" name="supplier_name" id="supplier_name" class="form-control" placeholder="Enter here" value="{{ old('supplier_name') }}">
							    </div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label>Origin of Goods :</label>
									<input type="text" name="supplier_warehouse" id="supplier_warehouse" class="form-control" placeholder="Enter here" value="{{ old('supplier_warehouse') }}">
							    </div>
							</div>
							<div class="col-md-4">
                                 <div class="form-group">
									<label>Proof of Proforma :</label>
                                    <div class="input-group">
                                       <div class="custom-file">
                                          <input type="file" id="file" name="file" class="form-control h-auto" accept="image/x-png,image/jpg,image/jpeg,application/pdf">
                                       </div>
                                    </div>
                                 </div>
                            </div>
					   </div>
					   <div class="form-group"><hr></div>
					   <div class="form-group">
							<h5><b>All Proof of Proforma</b></h5>
							<div class="table-responsive">
							  <table class="table table-bordered table-striped">
								 <thead class="table-secondary">
									<tr class="text-center">
									   <th>PO Code</th>
									   <th>SO No.</th>
									   <th>Date</th>
									   <th>Supplier</th>
									   <th>Warehouse</th>
									   <th>Proof</th>
									</tr>
								 </thead>
								 <tbody>
									@foreach($project->projectProforma as $pp)
									   <tr class="text-center">
										  <td class="align-middle"><a href="javascript:void(0);" onclick="showPurchaseProduct(this,'{{ $pp->projectPurchase->id }}')">{{ $pp->projectPurchase->code }}</a></td>
										  <td class="align-middle">{{ $pp->projectPurchase->projectSale->code }}</td>
										  <td class="align-middle">{{ $pp->date }}</td>
										  <td class="align-middle">{{ $pp->supplier_name }}</td>
										  <td class="align-middle">{{ $pp->supplier_warehouse }}</td>
										  <td class="align-middle">
											<a href="{{ $pp->attachment() }}" class="btn bg-info" target="_blank"><i class="icon-search4"></i></a>
										  </td>
									   </tr>
									@endforeach
								 </tbody>
							  </table>
						   </div>
						</div>
					   <div class="form-group">
						  <div class="text-right">
							 <button type="submit" name="submit" value="step-10" class="btn bg-purple">Save & Next <i class="icon-square-right"></i></button>
						  </div>
					   </div>
                     </div>
                  </form>
               </div>
            @endif
			@if($project->progress >= 45)
               <div class="card" id="step-11">
                  <form action="{{ url()->full() }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="card-body">
                        <h3 class="card-title" id="scrollspy"><b>Down Payment Purchase</b></h3>
                        <div class="form-group"><hr></div>
						<div class="alert alert-info alert-styled-left alert-dismissible">
							<button type="button" class="close" data-dismiss="alert"><span>×</span></button>
							<span class="font-weight-semibold">Attention!</span> Please select purchase order first before input down payment purchase.
						</div>
					   @if(isset($_GET['step-11']))
						  @if($errors->any())
							 <div class="alert bg-warning text-white alert-styled-left alert-dismissible">
								<button type="button" class="close" data-dismiss="alert">
								   <span>&times;</span>
								</button>
								<ul>
								   @foreach ($errors->all() as $error)
									  <li>{{ $error }}</li>
								   @endforeach
								</ul>
							 </div>
						  @elseif(session('success'))
							 <div class="alert bg-teal text-white alert-styled-left alert-dismissible">
								<button type="button" class="close" data-dismiss="alert">
								   <span>&times;</span>
								</button>
								{{ session('success') }}
							 </div>
						  @endif
					   @endif
					   <div class="row">
						  <div class="col-md-12 text-center">
							<button type="button" class="btn btn-primary mb-2">Total : <i class="icon-cash4 mr-2"></i> <b id="proforma_total">0</b></button>
							&nbsp;
							<button type="button" class="btn btn-success mb-2">Paid : <i class="icon-cash4 mr-2"></i> <b id="proforma_paid">0</button>
							<!-- <button type="button" class="btn btn-warning mb-2">Left : <i class="icon-cash4 mr-2"></i> 0</button>-->
						  </div>
						  <div class="col-md-3">
								<div class="form-group">
									<label>Purchase Order :<sup class="text-danger">*</sup></label>
									<select name="po_id" id="po_id" class="select2" onchange="getPurchaseInfo(this,this.value);">
									   <option value="">-- Choose --</option>
									   @foreach($project->projectPurchase as $pp)
										  <option value="{{ $pp->id }}">{{ $pp->code }}</option>
									   @endforeach
									</select>
								</div>
							</div>
						  <div class="col-md-3">
							 <div class="form-group">
								<label>Date :<sup class="text-danger">*</sup></label>
								<input type="hidden" value="0" id="proforma_total_raw">
								<input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}">
							 </div>
						  </div>
						  <div class="col-md-3">
							 <div class="form-group">
								<label>Bank :<sup class="text-danger">*</sup></label>
								<select name="bank" id="bank" class="custom-select">
								   <option value="">-- Choose --</option>
								   @foreach($bank as $b)
									  <optgroup label="{{ $b->name }}">
										  @foreach($b->child() as $bc)
											<option value="{{ $bc->id }}">{{ $bc->name }}</option>
										  @endforeach
									  </optgroup>
								   @endforeach
								</select>
							 </div>
						  </div>
						  <div class="col-md-3">
							 <div class="form-group">
								<label>Type :<sup class="text-danger">*</sup></label>
								<select name="status" id="status" class="custom-select">
								   <option value="1">Down Payment</option>
								   <option value="2">Full Payment</option>
								</select>
							 </div>
						  </div>
						  <div class="col-md-3">
                                 <div class="form-group">
									<label>Proof of Payment :<sup class="text-danger">*</sup></label>
                                    <div class="input-group">
                                       <div class="custom-file">
                                          <input type="file" id="file" name="file" class="form-control h-auto" accept="image/x-png,image/jpg,image/jpeg,application/pdf">
                                       </div>
                                    </div>
                                 </div>
                           </div>
						  <div class="col-md-3">
							 <div class="form-group">
								<label>Percentage :</label>
								<input type="text" name="percentage" id="percentage" class="form-control" placeholder="0" value="50" onkeyup="convertToNominal(this,'.nominal-proforma')">
							 </div>
						  </div>
						  <div class="col-md-3">
							 <div class="form-group">
								<label>Nominal :<sup class="text-danger">*</sup></label>
								<input type="text" name="nominal" id="nominal" class="form-control nominal-proforma" placeholder="0" value="0" onkeyup="formatRupiah(this)">
							 </div>
						  </div>
					   </div>
						<div class="form-group"><hr></div>
					   <div class="form-group">
							<h5><b>All Down Payment PO</b></h5>
							<div class="table-responsive">
							  <table class="table table-bordered table-striped">
								 <thead class="table-secondary">
									<tr class="text-center">
									   <th>PO Code</th>
									   <th>SO No.</th>
									   <th>Date</th>
									   <th>Bank</th>
									   <th>Nominal</th>
									   <th>Proof</th>
									</tr>
								 </thead>
								 <tbody>
									@foreach($project->projectPayment()->where('status', 1)->get() as $pp)
									   <tr class="text-center">
										  <td class="align-middle"><a href="javascript:void(0);" onclick="showPurchaseProduct(this,'{{ $pp->projectPurchase->id }}')">{{ $pp->projectPurchase->code }}</a></td>
										  <td class="align-middle">{{ $pp->projectPurchase->projectSale->code }}</td>
										  <td class="align-middle">{{ $pp->date }}</td>
										  <td class="align-middle">{{ $pp->coa->name }}</td>
										  <td class="align-middle">{{ $pp->projectPurchase->currency->symbol.' '.number_format($pp->nominal,2,',','.') }}</td>
										  <td class="align-middle">
											<a href="{{ $pp->attachment() }}" class="btn bg-info" target="_blank"><i class="icon-search4"></i></a>
										  </td>
									   </tr>
									@endforeach
								 </tbody>
							  </table>
						   </div>
						</div>
					   <div class="form-group"><hr></div>
					   <div class="form-group">
						  <div class="text-right">
							 <button type="submit" name="submit" value="step-11" class="btn bg-purple">Save & Next <i class="icon-square-right"></i></button>
						  </div>
					   </div>
                     </div>
                  </form>
               </div>
            @endif
            @if($project->progress >= 48)
               <div class="card" id="step-12">
                  <form action="{{ url()->full() }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="card-body">
                        <h3 class="card-title" id="scrollspy"><b>Progress Production</b></h3>
                        <div class="form-group"><hr></div>
                           @if(isset($_GET['step-12']))
                              @if($errors->any())
                                 <div class="alert bg-warning text-white alert-styled-left alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">
                                       <span>&times;</span>
                                    </button>
                                    <ul>
                                       @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                       @endforeach
                                    </ul>
                                 </div>
                              @elseif(session('success'))
                                 <div class="alert bg-teal text-white alert-styled-left alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">
                                       <span>&times;</span>
                                    </button>
                                    {{ session('success') }}
                                 </div>
                              @endif
                           @endif
                           <div class="row">
							  <div class="col-md-4">
								 <div class="form-group">
									<label>Purchase Order :<sup class="text-danger">*</sup></label>
									<select name="pr_id" id="pr_id" class="select2" onchange="getPurchaseInfo(this,this.value);">
									   <option value="">-- Choose --</option>
									   @foreach($project->projectPurchase as $pp)
										  <option value="{{ $pp->id }}">{{ $pp->code }}</option>
									   @endforeach
									</select>
								 </div>
							  </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label>Start Date :<sup class="text-danger">*</sup></label>
                                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}">
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label>Finish Date :<sup class="text-danger">*</sup></label>
                                    <input type="date" name="finish_date" id="finish_date" class="form-control" value="{{ old('finish_date') }}">
                                 </div>
                              </div>
							  <div class="col-md-4">
                                 <div class="form-group">
                                    <label>Progress(%) :<sup class="text-danger">*</sup></label>
                                    <input type="number" name="progress_production" id="progress_production" placeholder="0" class="form-control" value="{{ old('progress_production') }}">
                                 </div>
                              </div>
							  <div class="col-md-4">
                                 <div class="form-group">
									<label>Proof of Production :</label>
                                    <div class="input-group">
                                       <div class="custom-file">
                                          <input type="file" id="file" name="file" class="form-control h-auto" accept="image/x-png,image/jpg,image/jpeg,application/pdf">
                                       </div>
                                    </div>
                                 </div>
							  </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label>Note :<sup class="text-danger">*</sup></label>
                                    <textarea name="note" id="note" class="form-control" placeholder="Enter note" rows="1">{{ old('note') }}</textarea>
                                 </div>
                              </div>
                           </div>
						   <div class="form-group"><hr></div>
                           <div class="form-group">
                              <div class="text-right">
                                 <button type="submit" name="submit" value="step-12" class="btn bg-purple">Save & Next <i class="icon-square-right"></i></button>
                              </div>
                           </div>
							<h5><b>All Progress Production PO</b></h5>
							<div class="form-group">
							   <div class="table-responsive">
								  <table class="table table-bordered table-striped">
									 <thead class="table-secondary">
										<tr class="text-center">
										   <th>PO No.</th>
										   <th>SO No.</th>
										   <th>Start</th>
										   <th>Finish</th>
										   <th>Note</th>
										   <th>Progress</th>
										   <th>Proof</th>
										</tr>
									 </thead>
									 <tbody>
										@php
										$total = 0;
										$temppo = 0;
										foreach($project->projectProduction()->orderBy('project_purchase_id')->get() as $pp){
											if($temppo == 0 || $temppo == $pp->project_purchase_id){
												$total += $pp->progress;
											}else{
												$total = $pp->progress;
											}
											$temppo = $pp->project_purchase_id;
										@endphp
										   <tr class="text-center">
											  <td class="align-middle">
												<a href="javascript:void(0);" onclick="showPurchaseProduct(this,'{{ $pp->projectPurchase->id }}')">{{ $pp->projectPurchase->code }}</a>
											  </div>
											  <td class="align-middle">
												{{ $pp->projectPurchase->projectSale->code }}
											  </div>
										      <td class="align-middle">
												{{ $pp->start_date }}
											  </div>
											  <td class="align-middle">
												{{ $pp->finish_date }}
											  </div>
											  <td class="align-middle">
												{{ $pp->note }}
											  </div>
											  <td class="align-middle">
												{{ $total }}%
											  </td>
											  <td class="align-middle">
												 <a href="{{ $pp->attachment() }}" class="btn bg-info" target="_blank"><i class="icon-search4"></i></a>
											  </td>
										   </tr>
										@php
										}
										@endphp
									 </tbody>
								  </table>
							   </div>
							</div>
						</div>
                  </form>
               </div>
            @endif
            @if($project->progress >= 50)
               <div class="card" id="step-13">
                  <form action="{{ url()->full() }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="card-body">
                        <h3 class="card-title" id="scrollspy"><b>Pay Full Purchase</b></h3>
                        <div class="form-group"><hr></div>
                        @if(isset($_GET['step-13']))
						@if($errors->any())
						 <div class="alert bg-warning text-white alert-styled-left alert-dismissible">
							<button type="button" class="close" data-dismiss="alert">
							   <span>&times;</span>
							</button>
							<ul>
							   @foreach ($errors->all() as $error)
								  <li>{{ $error }}</li>
							   @endforeach
							</ul>
						 </div>
						@elseif(session('success'))
						 <div class="alert bg-teal text-white alert-styled-left alert-dismissible">
							<button type="button" class="close" data-dismiss="alert">
							   <span>&times;</span>
							</button>
							{{ session('success') }}
						 </div>
						@endif
						@endif
						<div class="row">
						  <div class="col-md-12 text-center">
							<button type="button" class="btn btn-primary mb-2">Total : <i class="icon-cash4 mr-2"></i> <b id="proforma_total_1">0</b></button>
							&nbsp;
							<button type="button" class="btn btn-success mb-2">Paid : <i class="icon-cash4 mr-2"></i> <b id="proforma_paid_1">0</button>
						  </div>
						  <div class="col-md-4">
							 <div class="form-group">
								<label>Purchase Order :<sup class="text-danger">*</sup></label>
								<select name="por_id" id="por_id" class="select2" onchange="getPurchaseInfo(this,this.value);">
								   <option value="">-- Choose --</option>
								   @foreach($project->projectPurchase as $pp)
									  <option value="{{ $pp->id }}">{{ $pp->code }}</option>
								   @endforeach
								</select>
							 </div>
						  </div>
						  <div class="col-md-4">
							 <div class="form-group">
								<label>Date :<sup class="text-danger">*</sup></label>
								<input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}">
							 </div>
						  </div>
						  <div class="col-md-4">
							 <div class="form-group">
								<label>Bank :<sup class="text-danger">*</sup></label>
								<select name="bank" id="bank" class="custom-select">
								   <option value="">-- Choose --</option>
								   @foreach($bank as $b)
									  <optgroup label="{{ $b->name }}">
										  @foreach($b->child() as $bc)
											<option value="{{ $bc->id }}">{{ $bc->name }}</option>
										  @endforeach
									  </optgroup>
								   @endforeach
								</select>
							 </div>
						  </div>
						  <div class="col-md-4">
							 <div class="form-group">
								<label>Type :<sup class="text-danger">*</sup></label>
								<select name="status" id="status" class="custom-select">
								   <option value="1">Down Payment</option>
								   <option value="2">Full Payment</option>
								   <option value="3">Other</option>
								</select>
							 </div>
						  </div>
						  <div class="col-md-4">
							 <div class="form-group">
								<label>Nominal Pay :<sup class="text-danger">*</sup></label>
								<input type="text" name="nominal_payment" id="nominal_payment" class="form-control" placeholder="0" value="{{ old('nominal') }}" onkeyup="formatRupiah(this)">
							 </div>
							</div>
							<div class="col-md-4">
                                <div class="form-group">
									<label>Proof of Payment :<sup class="text-danger">*</sup></label>
                                    <div class="input-group">
                                       <div class="custom-file">
                                          <input type="file" id="file" name="file" class="form-control h-auto" accept="image/x-png,image/jpg,image/jpeg,application/pdf">
                                       </div>
                                    </div>
                                </div>
							</div>
					   </div>
					   <div class="form-group">
							<h5><b>Detail Payment Purchases #<span id="po-payment-code"></span></b></h5>
							<div class="table-responsive">
							  <table class="table table-bordered table-striped">
								 <thead class="table-secondary">
									<tr class="text-center">
									   <th>Date</th>
									   <th>Bank</th>
									   <th>Nominal</th>
									   <th>Type</th>
									</tr>
								 </thead>
								 <tbody id="data_payment_purchase">
									<tr>
										<td class="bg-warning" colspan="4" style="text-align:center;">Choose Purchase Order first to see detail payment each Purchases</td>
									</tr>
								 </tbody>
								 <tbody style="text-align:center;">
									<tr class="bg-info">
										<td colspan="2">TOTAL</td>
										<td id="paymentotal"></td>
										<td></td>
									</tr>
								 </tbody>
							  </table>
						   </div>
						</div>
						<div class="form-group">
							<h5><b>All Payment Purchase</b></h5>
							<div class="table-responsive">
							  <table class="table table-bordered table-striped">
								 <thead class="table-secondary">
									<tr class="text-center">
									   <th>PO Code</th>
									   <th>SO No.</th>
									   <th>Date</th>
									   <th>Bank</th>
									   <th>Nominal</th>
									   <th>Proof</th>
									</tr>
								 </thead>
								 <tbody>
									@foreach($project->projectPayment()->orderBy('project_purchase_id')->get() as $pp)
									   <tr class="text-center">
										  <td class="align-middle"><a href="javascript:void(0);" onclick="showPurchaseProduct(this,'{{ $pp->projectPurchase->id }}')">{{ $pp->projectPurchase->code }}</a></td>
										  <td class="align-middle">{{ $pp->projectPurchase->projectSale->code }}</td>
										  <td class="align-middle">{{ $pp->date }}</td>
										  <td class="align-middle">{{ $pp->coa->name }}</td>
										  <td class="align-middle">{{ $pp->projectPurchase->currency->symbol.' '.number_format($pp->nominal,2,',','.') }}</td>
										  <td class="align-middle">
											<a href="{{ $pp->attachment() }}" class="btn bg-info" target="_blank"><i class="icon-search4"></i></a>
										  </td>
									   </tr>
									@endforeach
								 </tbody>
							  </table>
						   </div>
						</div>
					   <div class="form-group"><hr></div>
					   <div class="form-group">
						  <div class="text-right">
							 <button type="submit" name="submit" value="step-13" class="btn bg-purple">Save & Next <i class="icon-square-right"></i></button>
						  </div>
					   </div>
                     </div>
                  </form>
               </div>
            @endif
            @if($project->progress >= 55)
               <div class="card" id="step-14">
                  <form action="{{ url()->full() }}" method="POST">
                     @csrf
                     <div class="card-body">
                        <h3 class="card-title" id="scrollspy"><b>Shipment</b></h3>
                        <div class="form-group"><hr></div>
                           @if(isset($_GET['step-14']))
                              @if($errors->any())
                                 <div class="alert bg-warning text-white alert-styled-left alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">
                                       <span>&times;</span>
                                    </button>
                                    <ul>
                                       @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                       @endforeach
                                    </ul>
                                 </div>
                              @elseif(session('success'))
                                 <div class="alert bg-teal text-white alert-styled-left alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert">
                                       <span>&times;</span>
                                    </button>
                                    {{ session('success') }}
                                 </div>
                              @endif
                           @endif
						<div class="row">
						  <div class="col-md-4">
							 <div class="form-group">
								<label>Purchase Order :<sup class="text-danger">*</sup></label>
								<select name="pos_id" id="pos_id" class="select2" onchange="getPurchaseProduct(this,this.value);">
								   <option value="">-- Choose --</option>
								   @foreach($project->projectPurchase as $pp)
									  <option value="{{ $pp->id }}">{{ $pp->code }}</option>
								   @endforeach
								</select>
							 </div>
						  </div>
						  <div class="col-md-4">
							 <div class="form-group">
								<label>Shipment Document Code :<sup class="text-danger">*</sup></label>
								<input type="text" name="shipment_code" id="shipment_code" class="form-control" placeholder="Enter shipment code" value="{{ old('shipment_code') }}">
							 </div>
						  </div>
						  <div class="col-md-4">
							 <div class="form-group">
								<label>Loading Date :<sup class="text-danger">*</sup></label>
								<input type="date" name="loading_date" id="loading_date" class="form-control" value="{{ old('loading_date') }}">
							 </div>
						  </div>
						  <div class="col-md-4">
							 <div class="form-group">
								<label>Departure Date :<sup class="text-danger">*</sup></label>
								<input type="date" name="departure_date" id="departure_date" class="form-control" value="{{ old('departure_date') }}">
							 </div>
						  </div>
						  <div class="col-md-4">
							 <div class="form-group">
								<label>From Port :<sup class="text-danger">*</sup></label>
								<input type="text" name="from_port" id="from_port" class="form-control" placeholder="Enter from port" value="{{ old('from_port') }}">
							 </div>
						  </div>
						  <div class="col-md-4">
							 <div class="form-group">
								<label>To Port :<sup class="text-danger">*</sup></label>
								<input type="text" name="to_port" id="to_port" class="form-control" placeholder="Enter to port" value="{{ old('to_port') }}">
							 </div>
						  </div>
						  <div class="col-md-4">
							 <div class="form-group">
								<label>ETA :<sup class="text-danger">*</sup></label>
								<input type="date" name="eta" id="eta" class="form-control" value="{{ old('eta') }}">
							 </div>
						  </div>
						  <div class="col-md-4">
							 <div class="form-group">
								<label>Note :</label>
								<textarea name="note" id="note" class="form-control" placeholder="Enter note" rows="1">{{ old('note') }}</textarea>
							 </div>
						  </div>
						</div>
						<h5 class="card-title"><b>Detail Purchase Products</b></h5>
                        <div class="form-group"><hr></div>
						<div class="form-group">
                           <div class="table-responsive">
                              <table class="table table-bordered table-striped">
                                 <thead class="table-secondary">
                                    <tr class="text-center">
									   <th width="5%">No</th>
                                       <th width="45%">Product</th>
									   <th width="20%">Qty Order</th>
									   <th width="20%">Qty Sent</th>
									   <th width="10%">Unit</th>
									   <th>Delete</th>
                                    </tr>
                                 </thead>
                                 <tbody id="data_shipment_product">
                                    <tr>
										<td class="bg-warning" colspan="6" style="text-align:center;">Choose Purchase Order first to see All products can be sent.</td>
									</tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
						<div class="form-group"><hr></div>
						<div class="form-group">
						  <div class="text-right">
							 <button type="submit" name="submit" value="step-14" class="btn bg-purple">Save & Next <i class="icon-square-right"></i></button>
						  </div>
						</div>
						<div class="form-group">
							<h5><b>All Shipment Purchase</b></h5>
							<div class="table-responsive">
							  <table class="table table-bordered table-striped">
								 <thead class="table-secondary">
									<tr class="text-center">
									   <th>PO Code</th>
									   <th>Shipment Code</th>
									   <th>Loading</th>
									   <th>Departure</th>
									   <th>From Port</th>
									   <th>To Port</th>
									   <th>ETA</th>
									   <th>Note</th>
									   <th>Tracking</th>
									</tr>
								 </thead>
								 <tbody>
									@foreach($project->projectShipment()->orderBy('project_purchase_id')->get() as $ps)
									   <tr class="text-center">
										  <td class="align-middle"><a href="javascript:void(0);" onclick="showPurchaseProduct(this,'{{ $ps->projectPurchase->id }}')">{{ $ps->projectPurchase->code }}</a></td>
										  <td class="align-middle">{{ $ps->shipment_code }}</td>
										  <td class="align-middle">{{ $ps->loading_date }}</td>
										  <td class="align-middle">{{ $ps->departure_date }}</td>
										  <td class="align-middle">{{ $ps->from_port }}</td>
										  <td class="align-middle">{{ $ps->to_port }}</td>
										  <td class="align-middle">{{ $ps->eta }}</td>
										  <td class="align-middle">{{ $ps->note }}</td>
										  <td class="align-middle"><a class="btn bg-info" href="javascript:void(0);" onclick="addTrackingShipment({{ $ps->id }},'{{ $ps->shipment_code }}')"><i class="icon-truck"></i></a></td>
									   </tr>
									@endforeach
								 </tbody>
							  </table>
						   </div>
						</div>
                     </div>
                  </form>
               </div>
            @endif
			@if($project->progress >= 60)
               <div class="card" id="step-15">
                  <form action="{{ url()->full() }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="card-body">
                        <h3 class="card-title" id="scrollspy"><b>Warehouse Receive</b></h3>
                        <div class="form-group"><hr></div>
						
						@if(isset($_GET['step-15']))
						  @if($errors->any())
							 <div class="alert bg-warning text-white alert-styled-left alert-dismissible">
								<button type="button" class="close" data-dismiss="alert">
								   <span>&times;</span>
								</button>
								<ul>
								   @foreach ($errors->all() as $error)
									  <li>{{ $error }}</li>
								   @endforeach
								</ul>
							 </div>
						  @elseif(session('success'))
							 <div class="alert bg-teal text-white alert-styled-left alert-dismissible">
								<button type="button" class="close" data-dismiss="alert">
								   <span>&times;</span>
								</button>
								{{ session('success') }}
							 </div>
						  @endif
					   @endif
					   <div class="row">
						  <div class="col-md-4">
							 <div class="form-group">
								<label>Purchase Order :<sup class="text-danger">*</sup></label>
								<select name="posw_id" id="posw_id" class="select2" onchange="getShipmentInfo(this.value)">
								   <option value="">-- Choose --</option>
								   @foreach($project->projectPurchase as $pp)
									  <option value="{{ $pp->id }}">{{ $pp->code }}</option>
								   @endforeach
								</select>
							 </div>
						  </div>
						  <div class="col-md-4">
							 <div class="form-group">
								<label>Shipment :<sup class="text-danger">*</sup></label>
								<select name="shipment_id" id="shipment_id" class="form-control" onchange="getShipmentProduct(this.value)">
								   <option value="">-- Empty --</option>
								</select>
							 </div>
						  </div>
						  <div class="col-md-4">
							 <div class="form-group">
								<label>Receiver :<sup class="text-danger">*</sup></label>
								<input type="text" name="person" id="person" class="form-control" value="{{ old('person') }}">
							 </div>
						  </div>
						  <div class="col-md-4">
							 <div class="form-group">
								<label>Date & time received :<sup class="text-danger">*</sup></label>
								<input class="form-control" type="datetime-local" name="date_receive" id="date_receive" value="{{ old('date_receive') }}">
							 </div>
						  </div>
						  <div class="col-md-4">
							 <div class="form-group">
								<label>Warehouse :<sup class="text-danger">*</sup></label>
								<select name="warehouse_id" id="warehouse_id"></select>
							 </div>
						  </div>
						  <div class="col-md-4">
                                <div class="form-group">
									<label>Proof of Shipment :<sup class="text-danger">*</sup></label>
                                    <div class="input-group">
                                       <div class="custom-file">
                                          <input type="file" id="file" name="file" class="form-control h-auto" accept="image/x-png,image/jpg,image/jpeg,application/pdf">
                                       </div>
                                    </div>
                                </div>
							</div>
					   </div>
					   <h5 class="card-title"><b>Detail Shipment Products</b></h5>
                        <div class="form-group"><hr></div>
						<div class="form-group">
                           <div class="table-responsive">
                              <table class="table table-bordered table-striped">
                                 <thead class="table-secondary">
                                    <tr class="text-center">
									   <th width="5%">No</th>
                                       <th width="40%">Product</th>
									   <th width="15%">Qty</th>
									   <th width="10%">Unit</th>
									   <th width="15%">Qty Broken</th>
									   <th width="10%">Unit</th>
									   <th>Delete</th>
                                    </tr>
                                 </thead>
                                 <tbody id="data_warehouse_product">
                                    <tr>
										<td class="bg-warning" colspan="7" style="text-align:center;">Choose Shipment first to see All products that can be received.</td>
									</tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
						<div class="form-group"><hr></div>
						<div class="form-group">
						  <div class="text-right">
							 <button type="submit" name="submit" value="step-15" class="btn bg-purple">Save & Next <i class="icon-square-right"></i></button>
						  </div>
					   </div>
					   <h5 class="card-title"><b>All Warehouse Receive</b></h5>
						<div class="form-group">
						   <div class="table-responsive">
							  <table class="table table-bordered table-striped">
								 <thead class="table-secondary">
									<tr class="text-center">
									   <th>PO Code</th>
									   <th>Shipment</th>
									   <th>Code</th>
									   <th>Warehouse</th>
									   <th>Person</th>
									   <th>Date & Time Received</th>
									   <th>Proof</th>
									   <th><i class="icon-printer2"></i></th>
									</tr>
								 </thead>
								 <tbody>
									@php
										$tempid = 0;
									@endphp
									@foreach($project->projectWarehouse()->orderBy('project_purchase_id')->get() as $pw)
									   <tr class="text-center">
										  <td class="align-middle"><a href="javascript:void(0);" onclick="showPurchaseProduct(this,'{{ $pw->projectPurchase->id }}')">{{ $pw->projectPurchase->code }}</a></td>
										  <td class="align-middle">{{ $pw->projectShipment->shipment_code }}</td>
										  <td class="align-middle">{{ $pw->code }}</td>
										  <td class="align-middle">{{ $pw->warehouse->name.' - '.$pw->warehouse->code }}</td>
										  <td class="align-middle">{{ $pw->person }}</td>
										  <td class="align-middle">{{ $pw->date_receive }}</td>
										  <td class="align-middle">
											<a href="{{ $pw->attachment() }}" class="btn bg-info" target="_blank"><i class="icon-search4"></i></a>
										  </td>
										  <td class="align-middle">
											@php
												echo '<a href="'.url('admin/purchase_order/project/print/warehouse_receive/' . base64_encode($pw->id)).'" class="btn bg-info" target="_blank"><i class="icon-file-pdf"></i></a>';
											@endphp
										  </td>
									   </tr>
									@endforeach
								 </tbody>
							  </table>
						   </div>
						</div>
                     </div>
                  </form>
               </div>
            @endif
         </div>
      </div>
   </div>
	<!-- Info modal -->
	<div id="modal_purchase_product" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content" style="max-width: 800px !important;">
				<div class="modal-header bg-info">
					<h6 class="modal-title">Purchase <b id="modal_title_purchase_code">A</b></h6>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<h5 class="card-title"><b>Detail Products</b></h5>
					<div class="form-group"><hr></div>
					<div class="form-group">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-secondary">
                                    <tr class="text-center">
									   <th>No</th>
                                       <th>Product</th>
                                       <th>Qty Needed</th>
									   <th>Qty Sent</th>
									   <th>Qty Left</th>
									   <th>Unit</th>
									   <th>M<sup>2</sup></th>
                                    </tr>
                                 </thead>
                                 <tbody id="data_purchase_detail">
                                    
                                 </tbody>
                              </table>
                        </div>
                    </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /info modal -->
	<!-- Info modal -->
	<div id="modal_stock_product" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content" style="max-width: 800px !important;">
				<div class="modal-header bg-info">
					<h6 class="modal-title">Stock <b id="modal_title_stock_product"></b></h6>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<h5 class="card-title"><b>Detail Stock</b></h5>
					<div class="form-group"><hr></div>
					<div class="form-group">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-secondary">
                                    <tr class="text-center">
									   <th>No</th>
                                       <th>Warehouse</th>
                                       <th>Stock Code</th>
									   <th>Code</th>
									   <th>Qty</th>
									   <th>Unit</th>
                                    </tr>
                                 </thead>
                                 <tbody id="data_stock_product">
                                    
                                 </tbody>
								 <tfoot class="font-weight-black" style="font-size:20px;">
									<tr>
										<td colspan="4" class="text-right">Total</td>
										<td class="text-center" id="totalshading">0</td>
										<td class="text-center"></td>
									</tr>
								 </tfoot>
                              </table>
                        </div>
                    </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /info modal -->
	<!-- Info modal -->
	<div id="modal_tracking_shipment" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content" style="max-width: 800px !important;">
				<div class="modal-header bg-info">
					<h6 class="modal-title">Shipment No. <b id="modal_title_tracking_shipment"></b></h6>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<h5 class="card-title">
						<b>Detail Tracking Shipment</b> 
						<a href="javascript:void(0);" target="_blank" id="link-tracking-shipment" class="btn btn-primary btn-sm float-right ml-1">View <i class="icon-file-eye"></i></a>
						<a href="javascript:void(0);" id="email-tracking-shipment" class="btn btn-info btn-sm float-right ml-1" onclick="emailTrackingShipment()">Email <i class="icon-envelop3"></i></a>
						<a href="" target="_blank" id="whatsapp-tracking-shipment" class="btn btn-success btn-sm float-right ml-1">Whatsapp <i class="icon-phone-plus"></i></a>
					</h5>
					
					<div class="form-group"><hr></div>
					<div class="row">
					   <div class="col-md-10">
						  <div class="form-group">
							<input type="hidden" id="tempshipmentid">
							<input type="text" class="form-control" name="tracking-shipment-note" id="tracking-shipment-note" placeholder="Type note">
						  </div>
					   </div>
					   <div class="col-md-2">
						  <div class="form-group">
							 <button type="button" onclick="addTrackingShipmentDetail(this)" class="btn bg-success col-12" id="btnaddtrackingshipment"><i class="icon-plus2"></i> Add</button>
						  </div>
					   </div>
					</div>
					<div class="form-group">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-secondary">
                                    <tr class="text-center">
                                       <th width="25%">Date</th>
                                       <th>Note</th>
									   <th width="15%">Delete</th>
                                    </tr>
                                 </thead>
                                 <tbody id="data_shipment_tracking">
                                    <tr>
										<td colspan="3">
											<div class="alert alert-info alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Empty!</span> There is no tracking data.</div>
										</td>
									</tr>
                                 </tbody>
                              </table>
                        </div>
                    </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- /info modal -->
	<!-- Info modal -->
	<div id="modal_tracking_delivery" class="modal fade" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content" style="max-width: 800px !important;">
				<div class="modal-header bg-info">
					<h6 class="modal-title">Delivery No. <b id="modal_title_tracking_delivery"></b></h6>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<h5 class="card-title">
						<b>Detail Tracking Delivery</b> 
						<a href="javascript:void(0);" target="_blank" id="link-tracking-delivery" class="btn btn-primary btn-sm float-right ml-1">View <i class="icon-file-eye"></i></a>
						<a href="javascript:void(0);" id="email-tracking-delivery" class="btn btn-info btn-sm float-right ml-1">Email <i class="icon-envelop3"></i></a>
						<a href="javascript:void(0);" target="_blank" id="whatsapp-tracking-delivery" class="btn btn-success btn-sm float-right ml-1">Whatsapp <i class="icon-phone-plus"></i></a>
					</h5>
					
					<div class="form-group"><hr></div>
					<div class="row">
					   <div class="col-md-5">
						  <div class="form-group">
							<input type="hidden" id="tempdeliveryid">
							 <input type="text" class="form-control" name="tracking-delivery-note" id="tracking-delivery-note" placeholder="Type note">
						  </div>
					   </div>
					   <div class="col-md-5">
						  <div class="form-group">
							 <div class="input-group">
							   <div class="custom-file">
								  <input type="file" id="tracking-delivery-file" name="tracking-delivery-file" class="form-control h-auto" accept="image/x-png,image/jpg,image/jpeg">
							   </div>
							</div>
						  </div>
					   </div>
					   <div class="col-md-2">
						  <div class="form-group">
							 <button type="button" data-id="" onclick="addTrackingDeliveryDetail(this)" class="btn bg-success col-12" id="btnaddtrackingdelivery"><i class="icon-plus2"></i> Add</button>
						  </div>
					   </div>
					</div>
					<div class="form-group">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-secondary">
                                    <tr class="text-center">
                                       <th width="25%">Date</th>
                                       <th>Note</th>
									   <th>Proof</th>
									   <th width="15%">Delete</th>
                                    </tr>
                                 </thead>
                                 <tbody id="data_delivery_tracking">
                                    <tr>
										<td colspan="4">
											<div class="alert alert-info alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Empty!</span> There is no tracking data.</div>
										</td>
									</tr>
                                 </tbody>
                              </table>
                        </div>
                    </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
<script>
   $(function() {
      var no = 0;

      $('.sidebar-main-toggle').click();
      select2ServerSide('#product_id,#product_id2', '{{ url("admin/select2/product") }}');
	  select2ServerSide('#sales_id,#sales_po', '{{ url("admin/select2/user") }}');
	  select2ServerSide('#customer_id', '{{ url("admin/select2/customer") }}');
	  select2ServerSide('#supplier_id', '{{ url("admin/select2/supplier") }}');
	  select2ServerSide('#warehouse_id,#warehousereturn_id,#warehousedeliver_id,#warehouse_destination', '{{ url("admin/select2/warehouse") }}');
      select2ServerSide('#sample_product_id', '{{ url("admin/select2/product") }}');
	  select2ServerSide('#country_id', '{{ url("admin/select2/country") }}');
	  select2ServerSide('#city_id,#city_id2', '{{ url("admin/select2/city") }}');
	  //select2ServerSide('#currency', '{{ url("admin/select2/currency") }}');
      
      $('#data_product').on('click', '#delete_data_product', function() {
         $(this).closest('tr').remove();
		 $('.warning-product').fadeIn(500);
      });

      $('#data_consultant').on('click', '#delete_data_consultant', function() {
         $(this).closest('tr').remove();
		 $('.warning-consultant').fadeIn(500);
      });
	  
	  $('#data_negotiation').on('click', '#delete_data_negotiation', function() {
         $(this).closest('tr').remove();
		 $('.warning-negotiation').fadeIn(500);
      });

      $('#data_sample').on('click', '#delete_data_sample', function() {
         $(this).closest('tr').remove();
		 $('.warning-sample').fadeIn(500);
      });
	  
	  $('#data_purchase').on('click', '#delete_data_product_purchase', function() {
         $(this).closest('tr').remove();
      });
	  
	  $('#data_shipment_product').on('click', '#delete_ship_product', function() {
         $(this).closest('tr').remove();
      });
	  
	  $('#data_warehouse_product').on('click', '#delete_shipment_product', function() {
         $(this).closest('tr').remove();
      });
	  
	  $('#data_purchase_return').on('click', '#delete_purchase_return_product', function() {
         $(this).closest('tr').remove();
      });
	  
	  $('#data_delivery_products').on('click', '#delete_delivery_products', function() {
         $(this).closest('tr').remove();
      });
	  
	  $('#data_sales_return').on('click', '#delete_sales_return_products', function() {
         $(this).closest('tr').remove();
      });
	  $('#data_transfer_product').on('click', '#delete_transfer_product', function() {
         $(this).closest('tr').remove();
      });
	  
   });
   
	function getShading(val){
		if(val !== ''){
			$.ajax({
				url: '{{ url("admin/purchase_order/project/get_shading_product") }}',
				type: 'GET',
			 dataType: 'JSON',
			 data: {
				val : val
			 },
			 beforeSend: function() {
				loadingOpen('.content');
			 },
			 success: function(response) {
				var total = 0;
				if(response.shading.length > 0) {
					var no = 1;
					$('#data_stock_product').empty();
					$.each(response.shading, function(i, val) {
						$('#data_stock_product').append(`
							<tr class="text-center">
							 <td>` + no + `</td>
							 <td class="align-middle">` + val.warehouse_code + `</td>
							 <td class="align-middle">
								` + val.stock_code + `
							 </td>
							 <td class="align-middle">
								` + val.code +`
							 </td>
							 <td class="align-middle">
								` + val.qty +`
							 </td>
							 <td class="align-middle">
								` + val.unit +`
							 </td>
							</tr>
						`);
						no++;
						total += parseFloat(val.qty);
					});
					$('#modal_title_stock_product').html(response.product_name);
					$('#totalshading').html(total);
					$('#modal_stock_product').modal('toggle');
				}else{
					swalInit.fire('Info Stock!', 'Stock / shading is not available.', 'info');
				}
				
				loadingClose('.content');
			 },
			 error: function() {
				loadingClose('.content');
				swalInit.fire('Server Error!', 'Please contact developer', 'error');
			 }
			});
		}
	}
	
	function getListShading(val){
		if(val !== ''){
			$.ajax({
				url: '{{ url("admin/purchase_order/project/get_shading_product") }}',
				type: 'GET',
			 dataType: 'JSON',
			 data: {
				val : val
			 },
			 beforeSend: function() {
				loadingOpen('.content');
			 },
			 success: function(response) {
				if(response.shading.length > 0) {
					$('#warehouse_from').empty();
					$.each(response.shading, function(i, val) {
						$('#warehouse_from').append(`
							<option value="` + val.product_id + `_` + val.warehouse_code + `_` + val.warehouse_name + `">` + val.warehouse_code + ` Shading : ` + val.code  + ` Stok : ` + val.qty + ` ` + val.unit + `</option>
						`);
					});
				}else{
					swalInit.fire('Info Stock!', 'Stock / shading is not available.', 'info');
				}
				
				loadingClose('.content');
			 },
			 error: function() {
				loadingClose('.content');
				swalInit.fire('Server Error!', 'Please contact developer', 'error');
			 }
			});
		}
	}
	
	function getSalesInfo(element, idprojectsale) {
		var elemen = element.getAttribute('name');
		
		$.ajax({
			url: '{{ url("admin/purchase_order/project/get_sales_info") }}',
			type: 'GET',
         dataType: 'JSON',
         data: {
            idprojectsale : idprojectsale
         },
         beforeSend: function() {
			if(elemen == 'so_id'){
				loadingOpen('#step-9');
			}else if(elemen == 'sop_id'){
				loadingOpen('#step-18');
			}else if(elemen == 'sod_id'){
				loadingOpen('#step-16');
			}
         },
         success: function(response) {
			if(elemen == 'so_id'){
			 
				loadingClose('#step-9');
				
				if(response) {
					$('#sales_po').empty();
					$('#customer_id').empty();
					$('#sales_po').append(`
						<option value="` + response.sales_id + `">` + response.sales_name + `</option>
					`);
					$('#customer_id').append(`
						<option value="` + response.customer_id + `">` + response.customer_name + `</option>
					`);
				}
			}else if(elemen == 'sop_id'){
				loadingClose('#step-18');
				
				if(response) {
					$('#payment_total').text(response.payment_total);
					$('#payment_paid').text(response.payment_paid);
					$('#payment_left').text(response.payment_left);
				}
			}else if(elemen == 'sod_id'){
				loadingClose('#step-16');
				
				if(response) {
					$('#receiver_name').val(response.customer_name);
					$('#email').val(response.customer_email);
					$('#phone').val(response.customer_phone);
					$('#city_id2').empty();
					$('#city_id2').append(`
						<option value="` + response.city_id + `">` + response.city_name + `</option>
					`);
				}
			}
         },
         error: function() {
            if(elemen == 'so_id'){
				loadingClose('#step-9');
			}else if(elemen == 'sop_id'){
				loadingClose('#step-18');
			}else if(elemen == 'sod_id'){
				loadingClose('#step-16');
			}
				swalInit.fire('Server Error!', 'Please contact developer', 'error');
         }
		});
	}
	
	function getSupplierCurrency(idsupp) {
		$('#currency').empty();
		$.ajax({
			url: '{{ url("admin/purchase_order/project/get_supplier_currency") }}',
			type: 'GET',
         dataType: 'JSON',
         data: {
            idsupp : idsupp
         },
         beforeSend: function() {
            loadingOpen('#step-9');
         },
         success: function(response) {
            loadingClose('#step-9');
				if(response.length > 0) {
					$.each(response, function(i, val) {
						$('#currency').append(`
							<option value="` + val.id + `">` + val.code + ` ` + val.name + ` ` + val.symbol + `</option>
						`);
					});
				}
         },
         error: function() {
            loadingClose('#step-9');
				swalInit.fire('Server Error!', 'Please contact developer', 'error');
         }
		});
	}
	
	function getSalesProduct(element, idprojectsale) {
		var elemen = element.getAttribute('name');
		$.ajax({
			url: '{{ url("admin/purchase_order/project/get_sales_product") }}',
			type: 'GET',
         dataType: 'JSON',
         data: {
            idprojectsale : idprojectsale
         },
         beforeSend: function() {
			if(elemen == 'so_id'){
				loadingOpen('#step-9');
			}else if(elemen == 'sor_id'){
				loadingOpen('#step-17');
			}else if(elemen == 'sod_id'){
				loadingOpen('#step-16');
			}
         },
         success: function(response) {
			 
			if(elemen == 'so_id'){
				loadingClose('#step-9');
				
				if(response.length > 0) {
					$('#data_purchase').empty();
					
					$.each(response, function(i, val) {
						$('#data_purchase').append(`
							<tr class="text-center rowproductsale purchaseproductdata` + val.product_id + `" data-m2="` + val.m2 + `">
							 <input type="hidden" name="product_id[]" value="` + val.product_id + `">
							 <input type="hidden" name="product_unit[]" value="` + val.unitraw + `">
							 <td class="align-middle">` + val.product_name + `</td>
							 <td class="align-middle">
								` + val.qty + ` ` + val.unit + `
							 </td>
							 <td class="align-middle">
								` + val.qty_left +`
							 </td>
							 <td class="align-middle">
								<input type="number" name="product_qty[]" id="purchaseproductqty` + val.product_id + `" class="form-control" placeholder="0" value="` + val.qty_left +`" required>
							 </td>
							 <td class="align-middle">
								<input type="text" name="product_price[]" class="form-control" placeholder="0" required onkeyup="formatRupiah(this);countTotalPurchase(this,'`+ val.product_id +`');">
							 </td>
							 <td class="align-middle">
								<div id="purchaseproducttotal`+ val.product_id +`"></div>
							 </td>
							 <td class="align-middle">
								<textarea class="form-control" rows="1" name="product_remark[]"></textarea>
							 </td>
							 <td class="align-middle">
								<button type="button" id="delete_data_product_purchase" class="btn bg-danger btn-sm"><i class="icon-trash"></i></button>   
							 </td>
						  </tr>
						`);
					});
				}
			}else if(elemen == 'sor_id'){
				loadingClose('#step-17');
				
				if(response.length > 0) {
					$('#data_sales_return').empty();
					var no = 1;
					
					$.each(response, function(i, val) {
						$('#data_sales_return').append(`
							<tr class="text-center">
							 <input type="hidden" name="product_id[]" value="` + val.product_id + `">
							 <td>` + no + `</td>
							 <td class="align-middle">` + val.product_name + `</td>
							 <td class="align-middle">
								<input type="number" name="product_qty[]" class="form-control" placeholder="0" value="0" required>
							 </td>
							 <td class="align-middle">
								<select name="product_unit[]" class="custom-select" required>
								   <option value="1">Pcs</option>   
								   <option value="2">Box</option>   
								   <option value="3">Meter</option>   
								</select>
							 </td>
							 <td class="align-middle">
								<button type="button" id="delete_sales_return_products" class="btn bg-danger btn-sm"><i class="icon-trash"></i></button>   
							 </td>
							</tr>
						`);
						no++;
					});
				}
			}else if(elemen == 'sod_id'){
				loadingClose('#step-16');
				
				if(response.length > 0) {
					$('#data_delivery_products').empty();
					var no = 1;
					
					$.each(response, function(i, val) {
						$('#data_delivery_products').append(`
							<tr class="text-center">
							 <input type="hidden" name="product_id[]" value="` + val.product_id + `">
							 <input type="hidden" name="product_unit[]" value="` + val.unitconvert + `">
							 <td>` + no + `</td>
							 <td class="align-middle">` + val.product_name + `</td>
							 <td class="align-middle">
								` + val.qty + ` ` + val.unit + `
							 </td>
							 <td class="align-middle">
								` + val.qty_left_deliver +`
							 </td>
							 <td class="align-middle">
								<input type="number" name="product_qty[]" class="form-control" placeholder="0" value="` + val.qty_left_deliver +`" required>
							 </td>
							 <td class="align-middle">
								<button type="button" id="delete_delivery_products" class="btn bg-danger btn-sm"><i class="icon-trash"></i></button>   
							 </td>
						  </tr>
						`);
						no++;
					});
				}
			}
         },
         error: function() {
			
            if(elemen == 'so_id'){
				loadingClose('#step-9');
			}else if(elemen == 'sor_id'){
				loadingClose('#step-17');
			}else if(elemen == 'sod_id'){
				loadingClose('#step-16');
			}
				swalInit.fire('Server Error!', 'Please contact developer', 'error');
         }
		});
	}
	
	function getPurchaseProduct(elemen,idpo){
		var elemen = elemen.getAttribute('name');
		$.ajax({
			url: '{{ url("admin/purchase_order/project/get_purchase_product") }}',
			type: 'GET',
         dataType: 'JSON',
         data: {
            idpo : idpo
         },
         beforeSend: function() {
			 if(elemen == 'pos_id'){
				loadingOpen('#step-14');
			 }
         },
         success: function(response) {
			 
			var no = 1;
			
			if(elemen == 'pos_id'){
				if(response.length > 0) {
					$('#data_shipment_product').empty();
					
					$.each(response, function(i, val) {
						$('#data_shipment_product').append(`
							<tr class="text-center" data-m2="` + val.m2 + `">
							 <input type="hidden" name="product_id[]" value="` + val.product_id + `">
							 <input type="hidden" name="product_unit[]" value="` + val.convertunit + `">
							 <td>` + no + `</td>
							 <td class="align-middle">` + val.product_name + `</td>
							 <td class="align-middle">
								` + val.qty + `
							 </td>
							 <td class="align-middle">
								<input type="number" name="product_qty[]" class="form-control" placeholder="" value="` + val.qty_left +`" required>
							 </td>
							 <td class="align-middle">
								` + val.unit + `
							 </td>
							 <td class="align-middle">
								<button type="button" id="delete_ship_product" class="btn bg-danger btn-sm"><i class="icon-trash"></i></button>   
							 </td>
						  </tr>
						`);
						
						no++;
					});
					
				}
			}
			
			if(elemen == 'pos_id'){
				loadingClose('#step-14');
			}
         },
         error: function() {
			swalInit.fire('Server Error!', 'Please contact developer', 'error');
         }
		});
	}
	
	function showPurchaseProduct(element,idpo){
		$.ajax({
			url: '{{ url("admin/purchase_order/project/get_purchase_product") }}',
			type: 'GET',
         dataType: 'JSON',
         data: {
            idpo : idpo
         },
         beforeSend: function() {
			 loadingOpen('.order-2');
         },
         success: function(response) {
			$('#modal_title_purchase_code').html(element.innerHTML);
			 
			if(response.length > 0) {
				$('#data_purchase_detail').empty();
				
				var no = 1;
				
				$.each(response, function(i, val) {
					$('#data_purchase_detail').append(`
						<tr class="text-center" data-m2="` + val.m2 + `">
						 <td>` + no + `</td>
						 <td class="align-middle">` + val.product_name + `</td>
						 <td class="align-middle">
							` + val.qty + `
						 </td>
						 <td class="align-middle">
							` + val.qty_sent + `
						 </td>
						 <td class="align-middle">
							` + val.qty_left + `
						 </td>
						 <td class="align-middle">
							` + val.unit + `
						 </td>
						 <td class="align-middle">
							` + val.fixunit + `
						 </td>
					  </tr>
					`);
					
					no++;
				});
				
				$('#modal_purchase_product').modal('toggle');
				
				loadingClose('.order-2');
			}
         },
         error: function() {
			swalInit.fire('Server Error!', 'Please contact developer', 'error');
         }
		});
	}
	
	function getShipmentInfo(idpo){
		$.ajax({
			url: '{{ url("admin/purchase_order/project/get_shipment_info") }}',
			type: 'GET',
         dataType: 'JSON',
         data: {
            idpo : idpo
         },
         beforeSend: function() {
            loadingOpen('#step-15');
         },
         success: function(response) {
            loadingClose('#step-15');
				$('#shipment_id').empty();
				$('#shipment_id').append('<option value="">-- Empty --</option>');
				if(response.shipment_list.length > 0) {
					$.each(response.shipment_list, function(i, val) {
						$('#shipment_id').append(`
							<option value="` + val.shipment_id + `">` + val.shipment_code + `</option>
						`);
					});
				}
         },
         error: function() {
            loadingClose('#step-15');
				swalInit.fire('Server Error!', 'Please contact developer', 'error');
         }
		});
	}
	
	function getShipmentProduct(idshipment){
		$.ajax({
			url: '{{ url("admin/purchase_order/project/get_shipment_product") }}',
			type: 'GET',
         dataType: 'JSON',
         data: {
            idshipment : idshipment
         },
         beforeSend: function() {
            loadingOpen('#step-15');
         },
         success: function(response) {
            loadingClose('#step-15');
				if(response.shipment_product.length > 0) {
					$('#data_warehouse_product').empty();
					
					var no = 1;
					
					$.each(response.shipment_product, function(i, val) {
						$('#data_warehouse_product').append(`
							<tr class="text-center">
								 <input type="hidden" name="product_id[]" value="` + val.product_id + `">
								 <input type="hidden" name="product_unit[]" value="` + val.unitraw + `">
								 <td>` + no + `</td>
								 <td class="align-middle">` + val.product_name + `</td>
								 <td class="align-middle">
									<input type="number" name="product_qty[]" class="form-control" value="` + val.qty + `" required>
								 </td>
								 <td class="align-middle">
									` + val.unit + `
								 </td>
								 <td class="align-middle">
									<input type="number" name="product_qty_broken[]" class="form-control" value="0" required>
								 </td>
								 <td class="align-middle">
									` + val.unit + `
								 </td>
								 <td class="align-middle">
									<button type="button" id="delete_shipment_product" class="btn bg-danger btn-sm"><i class="icon-trash"></i></button>
								 </td>
							</tr>
						`);
						
						no++;
					});
				}
         },
         error: function() {
            loadingClose('#step-15');
				swalInit.fire('Server Error!', 'Please contact developer', 'error');
         }
		});
	}
	
	function getPurchaseInfo(element,purchaseid) {
		var elemen = element.getAttribute('name');
		$.ajax({
			url: '{{ url("admin/purchase_order/project/get_purchase_info") }}',
			type: 'GET',
         dataType: 'JSON',
         data: {
            purchaseid : purchaseid
         },
         beforeSend: function() {
			if(elemen == 'pop_id'){
				loadingOpen('#step-10');
			}else if(elemen == 'pr_id'){
				loadingOpen('#step-12');
			}else if(elemen == 'por_id'){
				loadingOpen('#step-13');
			}else{
				loadingOpen('#step-11');
			}
         },
         success: function(response) {
			if(elemen == 'pop_id'){
				loadingClose('#step-10');
			}else if(elemen == 'pr_id'){
				loadingClose('#step-12');
			}else if(elemen == 'por_id'){
				loadingClose('#step-13');
			}else{
				loadingClose('#step-11');
			}
			
			if(response) {
				if(elemen == 'pop_id'){
					$('#supplier_name').val(response.supplier_name);
				}else if(elemen == 'po_id'){
					$('#proforma_total').html(response.total);
					$('#proforma_paid').html(response.totalpaid);
					$('#proforma_total_raw').val(response.totalraw);
					$('#percentage').trigger('keyup');
				}else if(elemen == 'por_id'){
					$('#data_payment_purchase').empty();
					if(response.datapayment.length > 0){
						$('#proforma_total_1').html(response.total);
						$('#proforma_paid_1').html(response.totalpaid);
						$('#nominal_payment').val(response.totalleft);
						$('#paymentotal').html(response.total);
						$('#po-payment-code').html(element.options[element.selectedIndex].text);
						
						$.each(response.datapayment, function(i, val) {
							$('#data_payment_purchase').append(`
								<tr class="text-center">
									<td>`+ val.date +`</td>
									<td>`+ val.bank +`</td>
									<td>`+ val.nominal +`</td>
									<td>`+ val.status +`</td>
								</tr>
							`);
						});
					}else{
						$('#data_payment_purchase').append(`
							<tr>
								<td class="bg-warning" colspan="4" style="text-align:center;">Choose Purchase Order first to see detail payment each Purchases</td>
							</tr>
						`);
						swalInit.fire('Warning!', 'This Purchase Order has no down payment yet!', 'warning');
						$('#po-payment-code').html('');
					}
				}else if(elemen == 'pr_id'){
					$('#progress_production').val(response.progress_left);
				}
			}
         },
         error: function() {
            if(elemen == 'pop_id'){
				loadingClose('#step-10');
			}else if(elemen == 'pr_id'){
				loadingClose('#step-12');
			}else if(elemen == 'por_id'){
				loadingClose('#step-13');
			}else{
				loadingClose('#step-11');
			}
				swalInit.fire('Server Error!', 'Please contact developer', 'error');
         }
		});
	}
   
   function addProduct() {
      var id = $('#product_id');

      if(id.val()) {
		  
		  
         $.ajax({
            url: '{{ url("admin/purchase_order/project/get_product") }}',
            type: 'GET',
            dataType: 'JSON',
            data: {
               id: id.val()
            },
            beforeSend: function() {
               loadingOpen('#step-2');
            },
            success: function(response) {
			    var same = false;
				
				$('input[name^="product_id"]').each(function() {
					if($(this).val() == response.id){
						same = true;
					}
				});
				
				if(same == false){
				   id.val(null).trigger('change');
				   
				   if($('.rowproduct').length == 0){
					  no = 1;
				   }else{
					  no = $('.rowproduct').length + 1;
				   }

				   $('#data_product').append(`
					  <tr class="text-center rowproduct">
						 <input type="hidden" name="product_id[]" value="` + response.id + `">
						 <input type="hidden" name="product_price[]" value="` + response.price + `">
						 <td>` + no + `</td>
						 <td class="align-middle">` + response.product + `</td>
						 <td class="align-middle">
							<input type="text" name="product_area[]" class="form-control" placeholder="Type area" required>
						 </td>
						 <td class="align-middle">
							<textarea name="product_spec[]" class="form-control" placeholder="Type spec" rows="1" required>` + response.surface + `</textarea>
						 </td>
						 <td class="align-middle">
							<input type="number" name="product_qty[]" class="form-control" min="1" placeholder="0" required>
						 </td>  
						 <td class="align-middle">
							<select name="product_unit[]" class="custom-select" required>
							   <option value="1">Pcs</option>   
							   <option value="2">Box</option>   
							   <option value="3">Meter</option>   
							</select>
						 </td>   
						 <td class="align-middle">
							` + response.carton_pcs + ` pcs / carton, ` + response.carton_sqm + `
						 </td>  
						 <td class="align-middle">
							<button type="button" id="delete_data_product" class="btn bg-danger btn-sm"><i class="icon-trash"></i></button>   
						 </td>
					  </tr>
				   `);
				}else{
					swalInit.fire('Ooppsss!', 'Product was already added.', 'info');
				}
				
				loadingClose('#step-2');
            },
            error: function() {
               loadingClose('#step-2');
               swalInit.fire('Server Error!', 'Please contact developer', 'error');
            }
         });
      } else {
         swalInit.fire('Ooppsss!', 'Please select a product', 'info');
      }
   }
   
   function addTransfer() {
      var tgl = $('#transfer_date').val(), product_id = $('#product_id2').val(), product_name = $('#product_id2 option:selected').text(), from = $('#warehouse_from').val(), to = $('#warehouse_destination').val(), to_name = $('#warehouse_destination option:selected').text();

      if(from !== '') {
		   $('#data_transfer_product').append(`
			  <tr class="text-center">
				 <input type="hidden" name="transfer_date[]" value="` + tgl + `">
				 <input type="hidden" name="product_id[]" value="` + product_id + `">
				 <input type="hidden" name="from_warehouse[]" value="` + from + `">
				 <input type="hidden" name="to_warehouse[]" value="` + to + `">
				 <td class="align-middle">` + tgl + `</td>
				 <td class="align-middle">` + product_name + `</td>
				 <td class="align-middle">` + from + `</td>
				 <td class="align-middle"><input type="number" name="product_qty[]" class="form-control" min="1" placeholder="0" required></td>
				 <td class="align-middle">` + to_name + `</td>
				 <td class="align-middle">
					<button type="button" id="delete_transfer_product" class="btn bg-danger btn-sm"><i class="icon-trash"></i></button>
				 </td>
			  </tr>
		   `);
      } else {
         swalInit.fire('Ooops! This product has no stock.', 'Please contact Ventura to confirm this problem.', 'info');
      }
   }

   function addConsultant() {
      var consultant_date   = $('#consultant_date');
      var consultant_person = $('#consultant_person');
      var consultant_result = $('#consultant_result');

      if(consultant_date.val() && consultant_person.val() && consultant_result.val()) {
         $('#data_consultant').append(`
            <tr class="text-center">
			   <input type="hidden" name="consultant_id[]" value="0">
               <input type="hidden" name="consultant_date[]" value="` + consultant_date.val() + `">
               <input type="hidden" name="consultant_person[]" value="` + consultant_person.val() + `">
               <input type="hidden" name="consultant_result[]" value="` + consultant_result.val() + `">

               <td class="align-middle">` + consultant_date.val() + `</td>   
               <td class="align-middle">` + consultant_person.val() + `</td>   
               <td class="align-middle">` + consultant_result.val() + `</td>   
               <td class="align-middle">
                  <button type="button" id="delete_data_consultant" class="btn bg-danger btn-sm"><i class="icon-trash"></i></button>   
               </td>
            </tr>
         `);

         consultant_date.val(null);
         consultant_person.val(null);
         consultant_result.val(null);
      } else {
         swalInit.fire('Ooppsss!', 'Please entry all field', 'info');
      }
   }
   
   function addNegotiation() {
      var negotiation_date   = $('#negotiation_date');
      var negotiation_person = $('#negotiation_person');
      var negotiation_result = $('#negotiation_result');

      if(negotiation_date.val() && negotiation_person.val() && negotiation_result.val()) {
         $('#data_negotiation').append(`
            <tr class="text-center">
			   <input type="hidden" name="negotiation_id[]" value="0">
               <input type="hidden" name="negotiation_date[]" value="` + negotiation_date.val() + `">
               <input type="hidden" name="negotiation_person[]" value="` + negotiation_person.val() + `">
               <input type="hidden" name="negotiation_result[]" value="` + negotiation_result.val() + `">

               <td class="align-middle">` + negotiation_date.val() + `</td>   
               <td class="align-middle">` + negotiation_person.val() + `</td>   
               <td class="align-middle">` + negotiation_result.val() + `</td>   
               <td class="align-middle">
                  <button type="button" id="delete_data_negotiation" class="btn bg-danger btn-sm"><i class="icon-trash"></i></button>   
               </td>
            </tr>
         `);

         negotiation_date.val(null);
         negotiation_person.val(null);
         negotiation_result.val(null);
      } else {
         swalInit.fire('Ooppsss!', 'Please entry all field', 'info');
      }
   }

	
   function approveQuotation(approvalKe,id){
	   $.ajax({
         url: '{{ url("admin/purchase_order/project/approval") }}',
         type: 'POST',
         dataType: 'JSON',
         data: { approvalKe:approvalKe,id:id,mode:"quotation" },
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         beforeSend: function() {
            loadingOpen('#step-4');
         },
         success: function(response) {
			 if(response.status == '200'){
				 location.reload();
			 }
         }
      });
	  
	  return false;
   }
   
   function approveSample(approvalKe,id){
	   $.ajax({
         url: '{{ url("admin/purchase_order/project/approval") }}',
         type: 'POST',
         dataType: 'JSON',
         data: { approvalKe:approvalKe,id:id,mode:"sample" },
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         beforeSend: function() {
            loadingOpen('#step-5');
         },
         success: function(response) {
			 if(response.status == '200'){
				 location.reload();
			 }
         }
      });
	  
	  return false;
   }
   
   function approveSale(approvalKe,id){
	   $.ajax({
         url: '{{ url("admin/purchase_order/project/approval") }}',
         type: 'POST',
         dataType: 'JSON',
         data: { approvalKe:approvalKe,id:id,mode:"sale" },
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         beforeSend: function() {
            loadingOpen('#step-7');
         },
         success: function(response) {
			 if(response.status == '200'){
				 location.reload();
			 }
         }
      });
	  
	  return false;
   }
   
   function approvePurchase(approvalKe,id){
	   $.ajax({
         url: '{{ url("admin/purchase_order/project/approval") }}',
         type: 'POST',
         dataType: 'JSON',
         data: { approvalKe:approvalKe,id:id,mode:"purchase" },
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         beforeSend: function() {
            loadingOpen('#step-9');
         },
         success: function(response) {
			 if(response.status == '200'){
				 location.reload();
			 }
         }
      });
	  
	  return false;
   }
   
   function approveDelivery(approvalKe,id){
	   $.ajax({
         url: '{{ url("admin/purchase_order/project/approval") }}',
         type: 'POST',
         dataType: 'JSON',
         data: { approvalKe:approvalKe,id:id,mode:"delivery" },
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         beforeSend: function() {
            loadingOpen('#step-16');
         },
         success: function(response) {
			 if(response.status == '200'){
				 location.reload();
			 }
         }
      });
	  
	  return false;
   }
   
   function approveSaleReturn(approvalKe,id){
	   $.ajax({
         url: '{{ url("admin/purchase_order/project/approval") }}',
         type: 'POST',
         dataType: 'JSON',
         data: { approvalKe:approvalKe,id:id,mode:"sales_return" },
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         beforeSend: function() {
            loadingOpen('#step-17');
         },
         success: function(response) {
			 if(response.status == '200'){
				 location.reload();
			 }
         }
      });
	  
	  return false;
   }
   
   function updateStatusSample(val,id){
	   $.ajax({
         url: '{{ url("admin/purchase_order/project/update_status_sample") }}',
         type: 'POST',
         dataType: 'JSON',
         data: { val:val,id:id },
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         beforeSend: function() {
            loadingOpen('#step-5');
         },
         success: function(response) {
			 if(response.status == '200'){
				 //location.reload();
				 swalInit.fire('Success!', 'Sample status successfully changed.', 'success');
				 loadingClose('#step-5');
			 }
         }
      });
	  
	  return false;
   }
   
   function approveSalesInvoice(approvalKe,id){
	   $.ajax({
         url: '{{ url("admin/purchase_order/project/approval") }}',
         type: 'POST',
         dataType: 'JSON',
         data: { approvalKe:approvalKe,id:id,mode:"sales_invoice" },
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         beforeSend: function() {
            loadingOpen('#step-18');
         },
         success: function(response) {
			 if(response.status == '200'){
				 location.reload();
			 }
         }
      });
	  
	  return false;
   }
   
   function addSample() {
      var sample_product_id = $('#sample_product_id');
      var sample_qty        = $('#sample_qty');
	  var sample_unit       = $('#sample_unit');
      var sample_size       = $('#sample_size');

      if(sample_product_id.val() && sample_qty.val() && sample_size.val()) {
         $.ajax({
            url: '{{ url("admin/purchase_order/project/get_product") }}',
            type: 'GET',
            dataType: 'JSON',
            data: {
               id: sample_product_id.val()
            },
            beforeSend: function() {
               loadingOpen('#step-5');
            },
            success: function(response) {
               loadingClose('#step-5');
			   
				var same = false;
				
				$('input[name^="sample_product_id"]').each(function() {
					if($(this).val() == response.id){
						same = true;
					}
				});
				
				if(same == false){
					
					$('#data_sample').append(`
					  <tr class="text-center">
						 <input type="hidden" name="sample_product_id[]" value="` + sample_product_id.val() + `">
						 <input type="hidden" name="sample_qty[]" value="` + sample_qty.val() + `">
						 <input type="hidden" name="sample_unit[]" value="` + sample_unit.val() + `">
						 <input type="hidden" name="sample_size[]" value="` + sample_size.val() + `">

						 <td class="align-middle">` + response.product + `</td>  
						 <td class="align-middle">` + sample_qty.val() + `</td>
						 <td class="align-middle">` + $("#sample_unit option:selected").text() + `</td>
						 <td class="align-middle">` + $("#sample_size option:selected").text() + `</td>  
						 <td class="align-middle">
							<button type="button" id="delete_data_sample" class="btn bg-danger btn-sm"><i class="icon-trash"></i></button>   
						 </td>
					  </tr>
				   `);

				   sample_product_id.val(null).trigger('change');
				   sample_qty.val(null);
				   sample_unit.find('option:eq(0)').prop('selected', true);
				   sample_size.val(null);
				
				}else{
					swalInit.fire('Ooppsss!', 'Product was already added.', 'info');
				}
			   
               
            },
            error: function() {
               loadingClose('#step-5');
               swalInit.fire('Server Error!', 'Please contact developer', 'error');
            }
         });
      } else {
         swalInit.fire('Ooppsss!', 'Please entry all field', 'info');
      }
   }
   
   function countTotalPurchase(element,id){
	   
		var result = parseFloat($(element).val().replace(',','.').replace(/\./g,'')) * parseFloat($('#purchaseproductqty' + id).val());
	   
		var number_string = result.toString(),
		split   		= number_string.split('.'),
		sisa     		= split[0].length % 3,
		rupiah     		= split[0].substr(0, sisa),
		ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

		if(ribuan){
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		if(split[1]){
			split[1] = toFixed(parseFloat("0." + split[1]),2);
			split[1] = split[1].toString().split('.')[1];
		}
		
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	   
		$('#purchaseproducttotal'+id).html(rupiah);
		
   }
   
   function countBestPrice(percent,id){
	    var projectPrice = $('#project-price' + id).val().replace(',','.').replace(/\./g,'');
	   
		var result = parseFloat(projectPrice) - (parseFloat((parseFloat(projectPrice) * parseFloat(percent.value)) / 100));
	   
		var number_string = result.toString(),
		split   		= number_string.split('.'),
		sisa     		= split[0].length % 3,
		rupiah     		= split[0].substr(0, sisa),
		ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

		if(ribuan){
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		if(split[1]){
			split[1] = toFixed(parseFloat("0." + split[1]),2);
			split[1] = split[1].toString().split('.')[1];
		}
		
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	   
		$('#best-price'+id).val(rupiah);
		
   }
   
	function countDueDate(){
		var tanggal = {{ $project->term_payment }};
		if($('#date_create').val() !== ''){
			var datenow = new Date($('#date_create').val())
			datenow.setDate(datenow.getDate() + parseInt(tanggal));
			var day = day_of_the_month(datenow);
			$('#due_date').val(datenow.getFullYear().toString() + '-' + (datenow.getMonth()+1).toString() + '-' + day.toString());
		}else{
			swalInit.fire('Error!', 'Please determine date create first if you want to auto count due date.', 'error');
			$('#date_create').focus();
		}
	}
	
	function day_of_the_month(d)
	{ 
	  return (d.getDate() < 10 ? '0' : '') + d.getDate();
	}
   
   function convertToNominal(ini,element){
		var result = parseFloat((parseFloat($('#proforma_total_raw').val()) * parseFloat(ini.value)) / 100);
	   
		var number_string = result.toString(),
		split   		= number_string.split('.'),
		sisa     		= split[0].length % 3,
		rupiah     		= split[0].substr(0, sisa),
		ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

		if(ribuan){
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
		
		if(split[1]){
			split[1] = toFixed(parseFloat("0." + split[1]),2);
			split[1] = split[1].toString().split('.')[1];
		}
		
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	   
		$(element).val(rupiah);
   }
   
	function toFixed( num, precision ) {
		return (+(Math.round(+(num + 'e' + precision)) + 'e' + -precision)).toFixed(precision);
	}
	
	function skipForm(step,project) {
		$.ajax({
            url: '{{ url("admin/purchase_order/project/skip_form") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
               step : step, project : project
            },
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
            beforeSend: function() {
               loadingOpen('#step-' + step);
            },
            success: function(response) {
				if(response.status == '200'){
					location.reload();
				}
				loadingClose('#step-' + step);
            },
            error: function() {
               loadingClose('#step-' + step);
               swalInit.fire('Server Error!', 'Please contact developer', 'error');
            }
         });
		 
		 return false;
	}
	
	function addTrackingShipment(idshipment,codeshipment){
		$('#modal_title_tracking_shipment').html(codeshipment);
		$('#tempshipmentid').val(idshipment);
		
		$.ajax({
            url: '{{ url("admin/purchase_order/project/get_tracking_shipment") }}',
            type: 'GET',
            dataType: 'JSON',
            data: {
               id: $('#tempshipmentid').val()
            },
            beforeSend: function() {
               loadingOpen('#data_shipment_tracking');
            },
            success: function(response) {
			   
			   var link = '{{ url("/project/tracking/shipment") }}/' + idshipment + '/' + codeshipment;
			   var whatsapptemplate = 'https://wa.me/?text=' + encodeURIComponent('Hi Mr/Mrs. Here we send you a tracking shipment link for your products. \n' + link);
			   
			   $('#data_shipment_tracking').empty();
			   $('#link-tracking-shipment').prop('href', '{{ url("/project/tracking/shipment") }}/' + idshipment + '/' + codeshipment);
			   $('#whatsapp-tracking-shipment').prop('href', whatsapptemplate);
			   
			   if(response.length > 0) {
					$.each(response, function(i, val) {
						var date = new Date(val.created_at);
						
						$('#data_shipment_tracking').append(`
							<tr class="text-center">
								<td>` + date.toLocaleString() + `</td>
								<td>` + val.note + `</td>
								<td><button type="button" onclick="delete_tracking_shipment(this,` + val.id + `)" class="btn bg-danger btn-sm"><i class="icon-trash"></i></button></td>
							</tr>
						`);
					});
					
				}else{
					$('#data_shipment_tracking').append(`
						<tr>
							<td colspan="3">
								<div class="alert alert-info alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Empty!</span> There is no tracking data.</div>
							</td>
						</tr>
					`);
				}
				
				loadingClose('#data_shipment_tracking');
            },
            error: function() {
               loadingClose('#step-5');
               swalInit.fire('Server Error!', 'Please contact developer', 'error');
            }
         });
		
		$('#modal_tracking_shipment').modal('toggle');
	}
	
	function addTrackingShipmentDetail(element){
		var id = $('#tempshipmentid').val(), note = $('#tracking-shipment-note').val();
		
		$.ajax({
			url: '{{ url("admin/purchase_order/project/add_shipment_tracking") }}',
			type: 'POST',
			dataType: 'JSON',
			data: {
				id : id, note : note
			},
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			beforeSend: function() {
				 loadingOpen('#data_shipment_tracking');
			},
			success: function(response) {
				 $('#data_shipment_tracking').empty();
				if(response.length > 0) {
					$.each(response, function(i, val) {
						var date = new Date(val.created_at);
						
						$('#data_shipment_tracking').append(`
							<tr class="text-center">
								<td>` + date.toLocaleString() + `</td>
								<td>` + val.note + `</td>
								<td><button type="button" onclick="delete_tracking_shipment(this,` + val.id + `)" class="btn bg-danger btn-sm"><i class="icon-trash"></i></button></td>
							</tr>
						`);
					});
					
				}else{
					$('#data_shipment_tracking').append(`
						<tr>
							<td colspan="3">
								<div class="alert alert-info alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Empty!</span> There is no tracking data.</div>
							</td>
						</tr>
					`);
				}
				
				$('#tracking-shipment-note').val('');
				$('#tracking-shipment-note').focus();
				
				loadingClose('#data_shipment_tracking');
			},
			error: function() {
				swalInit.fire('Server Error!', 'Please contact developer', 'error');
			}
		});
	}
	
	function delete_tracking_shipment(element,id){
		$.ajax({
			url: '{{ url("admin/purchase_order/project/delete_shipment_tracking") }}',
			type: 'POST',
			dataType: 'JSON',
			data: {
				id : id
			},
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			beforeSend: function() {
				 loadingOpen('#data_shipment_tracking');
			},
			success: function(response) {
				if(response.status == '200'){
					$(element).closest('tr').remove();
				}
				loadingClose('#data_shipment_tracking');
			},
			error: function() {
				swalInit.fire('Server Error!', 'Please contact developer', 'error');
			}
		});
	}
	
	function addTrackingDelivery(iddelivery,codedelivery){
		$('#modal_title_tracking_delivery').html(codedelivery);
		$('#tempdeliveryid').val(iddelivery);
		
		$.ajax({
            url: '{{ url("admin/purchase_order/project/get_tracking_delivery") }}',
            type: 'GET',
            dataType: 'JSON',
            data: {
               id: $('#tempdeliveryid').val()
            },
            beforeSend: function() {
               loadingOpen('#data_delivery_tracking');
            },
            success: function(response) {
				var link = '{{ url("/project/tracking/delivery") }}/' + iddelivery + '/' + replaceAll(codedelivery,'/','-');
				var whatsapptemplate = 'https://wa.me/?text=' + encodeURIComponent('Hi Mr/Mrs. Here we send you a tracking delivery link for your products. \n' + link);
			   
				loadingClose('#data_delivery_tracking');
				$('#data_delivery_tracking').empty();
				$('#link-tracking-delivery').prop('href', '{{ url("/project/tracking/delivery") }}/' + iddelivery + '/' + replaceAll(codedelivery,'/','-'));
				$('#whatsapp-tracking-delivery').prop('href', whatsapptemplate);
				
				if(response.length > 0) {
					$.each(response, function(i, val) {
						var date = new Date(val.created_at);
						
						$('#data_delivery_tracking').append(`
							<tr class="text-center">
								<td>` + date.toLocaleString() + `</td>
								<td>` + val.note + `</td>
								<td>` + val.image + `</td>
								<td><button type="button" onclick="delete_tracking_delivery(this,` + val.id + `)" class="btn bg-danger btn-sm"><i class="icon-trash"></i></button></td>
							</tr>
						`);
					});
					
				}else{
					$('#data_delivery_tracking').append(`
						<tr>
							<td colspan="4">
								<div class="alert alert-info alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Empty!</span> There is no tracking data.</div>
							</td>
						</tr>
					`);
				}
				
				loadingClose('#data_delivery_tracking');
            },
            error: function() {
               loadingClose('#data_delivery_tracking');
               swalInit.fire('Server Error!', 'Please contact developer', 'error');
            }
         });
		
		$('#modal_tracking_delivery').modal('toggle');
	}
	
	function addTrackingDeliveryDetail(element){
		var id = $('#tempdeliveryid').val(), note = $('#tracking-delivery-note').val();
		var fd = new FormData(), files = $('#tracking-delivery-file')[0].files;
		fd.append('note',note);
		fd.append('id',id);
		if(files.length > 0 ){
           fd.append('file',files[0]);
		}
		
		$.ajax({
			url: '{{ url("admin/purchase_order/project/add_delivery_tracking") }}',
			type: 'POST',
			dataType: 'JSON',
			data: fd,
			contentType: false,
			processData: false,
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			beforeSend: function() {
				 loadingOpen('#data_delivery_tracking');
			},
			success: function(response) {
				 $('#data_delivery_tracking').empty();
				if(response.length > 0) {
					$.each(response, function(i, val) {
						var date = new Date(val.created_at);
						
						$('#data_delivery_tracking').append(`
							<tr class="text-center">
								<td>` + date.toLocaleString() + `</td>
								<td>` + val.note + `</td>
								<td>` + val.image + `</td>
								<td><button type="button" onclick="delete_tracking_delivery(this,` + val.id + `)" class="btn bg-danger btn-sm"><i class="icon-trash"></i></button></td>
							</tr>
						`);
					});
					
				}else{
					$('#data_delivery_tracking').append(`
						<tr>
							<td colspan="4">
								<div class="alert alert-info alert-styled-left alert-dismissible"><button type="button" class="close" data-dismiss="alert"><span>×</span></button><span class="font-weight-semibold">Empty!</span> There is no tracking data.</div>
							</td>
						</tr>
					`);
				}
				
				$('#tracking-delivery-file').val('');
				$('#tracking-delivery-note').val('');
				
				loadingClose('#data_delivery_tracking');
			},
			error: function() {
				swalInit.fire('Server Error!', 'Please contact developer', 'error');
			}
		});
	}
	
	function delete_tracking_delivery(element,id){
		$.ajax({
			url: '{{ url("admin/purchase_order/project/delete_delivery_tracking") }}',
			type: 'POST',
			dataType: 'JSON',
			data: {
				id : id
			},
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			beforeSend: function() {
				 loadingOpen('#data_delivery_tracking');
			},
			success: function(response) {
				if(response.status == '200'){
					$(element).closest('tr').remove();
				}
				loadingClose('#data_delivery_tracking');
			},
			error: function() {
				swalInit.fire('Server Error!', 'Please contact developer', 'error');
			}
		});
	}
	
	$('#sample_unit').on('change', function() {
		if($(this).val() == '1'){
			$('#sample_size').empty().append('<option value="1">20x20</option><option value="2">Full Size</option>');
		}else if($(this).val() == '2'){
			$('#sample_size').empty().append('<option value="2">Full Size</option>');
		}else{
			$('#sample_size').empty();
		}
	});
	
	$('#dropshipper').on('change', function() {
		if($(this).val() == '1'){
			$('#data-dropshipper').hide();
		}else{
			$('#data-dropshipper').show();
		}
	});
	
	function replaceAll(str, find, replace) {
	  return str.replace(new RegExp(find, 'g'), replace);
	}
	
	function editSales(idsales){
		$('#temp_so_id').val(idsales);
		$('#modesales').html('Edit <i class="icon-loop3"></i>');
		$('#modesales').removeClass('btn-info');
		$('#modesales').addClass('btn-warning');
		
		$.ajax({
			url: '{{ url("admin/purchase_order/project/get_sales_info") }}',
			type: 'GET',
			dataType: 'JSON',
			 data: {
				idprojectsale : idsales
			 },
			 beforeSend: function() {
				loadingOpen('#step-7');
			 },
			 success: function(response) {
				loadingClose('#step-7');
				if(response){
					
					$('#sales_address').val(response.sales_address);
					$('#sales_note').val(response.sales_note);
					$('html, body').animate({
						scrollTop: $('#step-7').offset().top
					}, 'slow');
					$('#sales_id').empty();
					$('#sales_id').append(`
						<option value="` + response.sales_id + `">` + response.sales_name + `</option>
					`);
				}
			 },
			 error: function() {
				loadingClose('#step-7');
				swalInit.fire('Server Error!', 'Please contact developer', 'error');
			 }
		});
	}
	
	function emailTrackingShipment()
	{
		var idshipment = $('#tempshipmentid').val();
		
		if(idshipment){
			$.ajax({
				url: '{{ url("admin/purchase_order/project/email_tracking_shipment") }}',
				type: 'POST',
				dataType: 'JSON',
				 data: {
					idshipment : idshipment
				},
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				 beforeSend: function() {
					loadingOpen('#modal_tracking_shipment');
				 },
				 success: function(response) {
					loadingClose('#modal_tracking_shipment');
					swalInit.fire('Success!', 'Email has been successfully sent.', 'success');
				 },
				 error: function() {
					loadingClose('#modal_tracking_shipment');
					swalInit.fire('Server Error!', 'Please contact developer', 'error');
				 }
			});
		}
	}
	
	function resetSales(){
		$('#temp_so_id').val('');
		$('#modesales').html('Add <i class="icon-loop3"></i>');
		$('#modesales').removeClass('btn-warning');
		$('#modesales').addClass('btn-info');
		$('#sales_address').val('');
		$('#sales_note').val('');
		$('#sales_id').empty();
		return false;
	}
</script>