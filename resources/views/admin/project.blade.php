<style>
   .tabable .nav-tabs {
      overflow-x: auto; 
      overflow-y: hidden; 
      flex-wrap: nowrap;
   }

   .tabable .nav-tabs .nav-link {
      white-space: nowrap;
      background: #e0f2f1 !important;
      color: #26a69a !important;
      font-weight: 500;
   }

   .tabable .nav-tabs .nav-link.active {
      background: #26a69a !important;
      color: white !important;
   }

   .tabable .nav-tabs::-webkit-scrollbar {
      height: 8px !important;
      background: #263238;
   }

   .tabable .nav-tabs::-webkit-scrollbar-track {
      background: #e83c28;
      border: 3px solid #e83c28;
   }

   .tabable .nav-tabs::-webkit-scrollbar-thumb {
      background-color: #eab023;
      border: 3px solid #eab023;
      height: 5px !important;
   }
</style>

<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Project</span>
				</h4>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<span class="breadcrumb-item active">Project</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="card">
			<div class="card-body">
            <form id="form_data">
               <div class="tabable">
                  <ul class="nav nav-tabs nav-tabs-solid nav-tabs-responsive">
                     <li class="nav-item">
                        <a href="#vertical-left-step-1" class="nav-link text-center active" data-toggle="tab">
                           <div>Project Information</div> 
                           <div>(10%)</div>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="#vertical-left-step-2" class="nav-link text-center" data-toggle="tab">
                           <div>Spec Project + Target Price</div> 
                           <div>(5%)</div>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="#vertical-left-step-3" class="nav-link text-center" data-toggle="tab">
                           <div>Consultant Meeting</div> 
                           <div>(5%)</div>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="#vertical-left-step-4" class="nav-link text-center" data-toggle="tab">
                           <div>Pre Quotation</div> 
                           <div>(5%)</div>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="#vertical-left-step-5" class="nav-link text-center" data-toggle="tab">
                           <div>Form Sample</div> 
                           <div>(5%)</div>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="#vertical-left-step-6" class="nav-link text-center" data-toggle="tab">
                           <div>Negotiation</div> 
                           <div>(5%)</div>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="#vertical-left-step-7" class="nav-link text-center" data-toggle="tab">
                           <div>PO Project</div> 
                           <div>(5%)</div>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="#vertical-left-step-8" class="nav-link text-center" data-toggle="tab">
                           <div>Input Data Vendor + Purchasing Order</div> 
                           <div>(3%)</div>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="#vertical-left-step-9" class="nav-link text-center" data-toggle="tab">
                           <div>PI</div> 
                           <div>(2%)</div>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="#vertical-left-step-10" class="nav-link text-center" data-toggle="tab">
                           <div>Production</div> 
                           <div>(5%)</div>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="#vertical-left-step-11" class="nav-link text-center" data-toggle="tab">
                           <div>Pay Full Purchase</div> 
                           <div>(5%)</div>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="#vertical-left-step-12" class="nav-link text-center" data-toggle="tab">
                           <div>Shipment</div> 
                           <div>(5%)</div>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="#vertical-left-step-13" class="nav-link text-center" data-toggle="tab">
                           <div>Delivery To Project</div> 
                           <div>(10%)</div>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="#vertical-left-step-14" class="nav-link text-center" data-toggle="tab">
                           <div>Proses Payment</div> 
                           <div>(10%)</div>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="#vertical-left-step-15" class="nav-link text-center" data-toggle="tab">
                           <div>Done</div> 
                           <div>(10%)</div>
                        </a>
                     </li>
                  </ul>
                  <div class="tab-content">
                     <div class="tab-pane fade show active" id="vertical-left-step-1">
                        <div class="form-group">
                           <label>Project Name :<sup class="text-danger">*</sup></label>
                           <textarea name="name" id="name" class="form-control" placeholder="Enter project name"></textarea>
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Contructor Name :</label>
                                 <input type="text" name="contructor_name" id="contructor_name" class="form-control" placeholder="Enter contructor name">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Phone :</label>
                                 <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Email :</label>
                                 <input type="text" name="email" id="email" class="form-control" placeholder="Enter email">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Country :</label>
                                 <select name="country_id" id="country_id" class="select2">
                                    <option value="">-- Choose --</option>
                                    @foreach($country as $c)
                                       <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>City :</label>
                                 <select name="city_id" id="city_id" class="select2">
                                    <option value="">-- Choose --</option>
                                    @foreach($city as $c)
                                       <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Timeline :</label>
                                 <input type="date" name="timeline" id="timeline" class="form-control">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Project Manager :</label>
                                 <input type="text" name="project_manager" id="project_manager" class="form-control" placeholder="Enter project manager">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Consultant Name :</label>
                                 <input type="text" name="consultant_name" id="consultant_name" class="form-control" placeholder="Enter consultant name">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Owner :</label>
                                 <input type="text" name="owner" id="owner" class="form-control" placeholder="Enter owner">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Payment Method :</label>
                                 <select name="payment_method" id="payment_method" class="form-control">
                                    <option value="">-- Choose --</option>
                                    <option value="1">Giro</option>
                                    <option value="2">SKBDN</option>
                                    <option value="3">DP</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Supply Method :</label>
                                 <select name="supply_method" id="supply_method" class="form-control">
                                    <option value="">-- Choose --</option>
                                    <option value="1">Full</option>
                                    <option value="2">Partial</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>PPN :</label>
                                 <select name="ppn" id="ppn" class="form-control">
                                    <option value="">-- Choose --</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="form-group"><hr></div>
                        <div class="form-group">
                           <div class="text-right">
                              <button type="button" onclick="submitProject()" name="step_1" value="step_1" class="btn bg-primary">Submit</button>
                           </div>
                        </div>
                     </div>
                     <div class="tab-pane fade" id="vertical-left-step-2">
                        Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
                     </div>
                  </div>
               </div>
            </form>
			</div>
		</div>
	</div>