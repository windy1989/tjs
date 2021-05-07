<style>
   html {
      scroll-behavior: smooth;
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
		<div class="d-flex align-items-start flex-column flex-md-row">
         <div class="order-2 order-md-1">
            <div class="card" id="step-1">
               <div class="card-body">
                  <h5 class="card-title" id="scrollspy">Project Information</h5>
                  <div class="form-group"><hr></div>
                  <div class="form-group">
                     <label>Project Name :<sup class="text-danger">*</sup></label>
                     <textarea name="name" id="name" class="form-control" placeholder="Enter project name"></textarea>
                  </div>
                  <div class="row">
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>Contructor Name :<sup class="text-danger">*</sup></label>
                           <input type="text" name="contructor_name" id="contructor_name" class="form-control" placeholder="Enter contructor name">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>Phone :<sup class="text-danger">*</sup></label>
                           <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>Email :<sup class="text-danger">*</sup></label>
                           <input type="text" name="email" id="email" class="form-control" placeholder="Enter email">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>Country :<sup class="text-danger">*</sup></label>
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
                           <label>City :<sup class="text-danger">*</sup></label>
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
                           <label>Timeline :<sup class="text-danger">*</sup></label>
                           <input type="date" name="timeline" id="timeline" class="form-control">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>Project Manager :<sup class="text-danger">*</sup></label>
                           <input type="text" name="project_manager" id="project_manager" class="form-control" placeholder="Enter project manager">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>Consultant Name :<sup class="text-danger">*</sup></label>
                           <input type="text" name="consultant_name" id="consultant_name" class="form-control" placeholder="Enter consultant name">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>Owner :<sup class="text-danger">*</sup></label>
                           <input type="text" name="owner" id="owner" class="form-control" placeholder="Enter owner">
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>Payment Method :<sup class="text-danger">*</sup></label>
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
                           <label>Supply Method :<sup class="text-danger">*</sup></label>
                           <select name="supply_method" id="supply_method" class="form-control">
                              <option value="">-- Choose --</option>
                              <option value="1">Full</option>
                              <option value="2">Partial</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="form-group">
                           <label>PPN :<sup class="text-danger">*</sup></label>
                           <select name="ppn" id="ppn" class="form-control">
                              <option value="">-- Choose --</option>
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card" id="step-2">
               <div class="card-body">
                  <h5 class="card-title" id="scrollspy">Spec Project + Target Price</h5>
                  <div class="form-group"><hr></div>
                  <div class="row">
                     <div class="col-md-10">
                        <div class="form-group">
                           <select name="product_id" id="product_id"></select>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <button type="button" onclick="addProduct()" class="btn bg-success col-12"><i class="icon-plus2"></i> Add</button>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                           <thead class="table-secondary">
                              <tr class="text-center">
                                 <th>Product</th>
                                 <th>Qty</th>
                                 <th>Target Price</th>
                                 <th>Size</th>
                                 <th>Delete</th>
                              </tr>
                           </thead>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card" id="step-3">
               <div class="card-body">
                  <h5 class="card-title" id="scrollspy">Consultant Meeting</h5>
                  <div class="form-group"><hr></div>
                  <div class="row">
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Date :<sup class="text-danger">*</sup></label>
                           <input type="date" name="consul_date" id="consul_date" class="form-control">
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label>Person :<sup class="text-danger">*</sup></label>
                           <input type="text" name="consul_person" id="consul_person" class="form-control" placeholder="Enter name person">
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group">
                           <label>Result :<sup class="text-danger">*</sup></label>
                           <textarea name="consul_result" id="consul_result" class="form-control" placeholder="Enter result"></textarea>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="form-group">
                           <button type="button" onclick="addConsul()" class="btn bg-success col-12"><i class="icon-plus2"></i> Add</button>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                           <thead class="table-secondary">
                              <tr class="text-center">
                                 <th>Date</th>
                                 <th>Person</th>
                                 <th>Result</th>
                                 <th>Delete</th>
                              </tr>
                           </thead>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="sidebar-sticky w-100 w-md-auto order-1 order-md-2">
            <div class="sidebar sidebar-light sidebar-component sidebar-component-right sidebar-expand-md">
               <div class="sidebar-content">
                  <div class="card">
                     <div class="card-header bg-transparent header-elements-inline">
                        <span class="text-uppercase font-size-sm font-weight-semibold">Progress</span>
                     </div>
                     <ul class="nav nav-sidebar nav-scrollspy">
                        <li class="nav-item">
                           <a href="#step-1" class="nav-link">
                              <i class="icon-check"></i>
                              Project Information
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-2" class="nav-link">
                              <i class="icon-spinner10"></i>
                              Spec Project + Target Price
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-3" class="nav-link">
                              <i class="icon-spinner10"></i>
                              Consultant Meeting
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-4" class="nav-link">
                              <i class="icon-spinner10"></i>
                              Pre Quotation
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-5" class="nav-link">
                              <i class="icon-spinner10"></i>
                              Form Sample
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-6" class="nav-link">
                              <i class="icon-spinner10"></i>
                              Negotiation
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-7" class="nav-link">
                              <i class="icon-spinner10"></i>
                              PO Project
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-8" class="nav-link">
                              <i class="icon-spinner10"></i>
                              Data Vendor & PO
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-9" class="nav-link">
                              <i class="icon-spinner10"></i>
                              Performance Invoice
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-10" class="nav-link">
                              <i class="icon-spinner10"></i>
                              Production
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-11" class="nav-link">
                              <i class="icon-spinner10"></i>
                              Pay Full Purchase
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-12" class="nav-link">
                              <i class="icon-spinner10"></i>
                              Shipment
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-13" class="nav-link">
                              <i class="icon-spinner10"></i>
                              Delivery To Project
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-14" class="nav-link">
                              <i class="icon-spinner10"></i>
                              Proses Payment
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-15" class="nav-link">
                              <i class="icon-spinner10"></i>
                              Done
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

<script>
   $(function() {
      select2ServerSide('#product_id', '{{ url("admin/select2/product") }}');
      $('.sidebar-sticky .sidebar').stick_in_parent({
         offset_top: 20,
         parent: '.content',
         inner_scrolling: true
      });

      $('.sidebar-mobile-component-toggle').on('click', function() {
         $('.sidebar-sticky .sidebar').trigger("sticky_kit:detach");
      });
   });
</script>