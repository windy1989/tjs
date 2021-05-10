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
					<span class="font-weight-semibold">Project Manage</span>
				</h4>
			</div>
         <div class="header-elements">
				<div class="d-flex justify-content-center">
					<a href="{{ url('admin/project') }}" class="btn bg-secondary btn-labeled btn-labeled-left">
						<b><i class="icon-arrow-left7"></i></b> Back To List
					</a>
				</div>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<a href="{{ url('admin/project') }}" class="breadcrumb-item">Project</a>
					<span class="breadcrumb-item active">Manage</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="d-block d-flex align-items-start flex-column flex-md-row">
         <div class="order-2 order-md-1 w-100">
            <form action="{{ url()->full() }}" method="POST">
               @csrf
               <div class="card" id="step-1">
                  <div class="card-body">
                     <h5 class="card-title" id="scrollspy">Project Information</h5>
                     <div class="form-group"><hr></div>
                     <table cellpadding="10" cellspacing="0" width="100%">
                        <tbody>
                           <tr>
                              <th width="20%" class="align-middle">Project Name</th>
                              <td class="align-middle">: {{ $project->name }}</td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">Phone</th>
                              <td class="align-middle">: {{ $project->phone }}</td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">Email</th>
                              <td class="align-middle">: {{ $project->email }}</td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">Constructor Name</th>
                              <td class="align-middle">: {{ $project->constructor }}</td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">Country</th>
                              <td class="align-middle">: {{ $project->country->name }}</td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">City</th>
                              <td class="align-middle">: {{ $project->city->name }}</td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">Timeline</th>
                              <td class="align-middle">: {{ date('d F Y', strtotime($project->timeline)) }}</td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">Project Manager</th>
                              <td class="align-middle">: {{ $project->manager }}</td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">Consultant Name</th>
                              <td class="align-middle">: {{ $project->consultant }}</td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">Owner</th>
                              <td class="align-middle">: {!! $project->owner !!}</td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">Payment Method</th>
                              <td class="align-middle">: {!! $project->paymentMethod() !!}</td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">Supply Method</th>
                              <td class="align-middle">: {!! $project->supplyMethod() !!}</td>
                           </tr>
                           <tr>
                              <th width="20%" class="align-middle">PPN</th>
                              <td class="align-middle">: {!! $project->ppn() !!}</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </form>
            <div class="card" id="step-2">
               <form action="{{ url()->full() }}" method="POST">
                  @csrf
                  <div class="card-body">
                     <h5 class="card-title" id="scrollspy">Spec Project + Target Price</h5>
                     <div class="form-group"><hr></div>
                     @if(isset($_GET['step-2']))
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
                     @if($project->projectProduct->count() > 0)
                        <table class="table table-bordered table-striped">
                           <thead class="table-secondary">
                              <tr class="text-center">
                                 <th>Product</th>
                                 <th>Qty</th>
                                 <th>Target Price</th>
                                 <th>Unit</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($project->projectProduct as $pp)
                                 <tr class="text-center">
                                    <td class="align-middle">{{ $pp->product->code() }}</td>   
                                    <td class="align-middle">{{ $pp->qty }}</td>   
                                    <td class="align-middle">{{ number_format($pp->target_price, 0, ',', '.') }}</td>   
                                    <td class="align-middle">{{ $pp->unit() }}</td> 
                                 </tr>
                              @endforeach
                           </tbody>
                        </table>
                     @else
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
                                 <tbody id="data_product"></tbody>
                              </table>
                           </div>
                        </div>
                        <div class="form-group"><hr></div>
                        <div class="form-group">
                           <div class="text-right">
                              <button type="submit" name="submit" value="step-2" class="btn bg-purple"><i class="icon-floppy-disk"></i> Save</button>
                           </div>
                        </div>
                     @endif
                  </div>
               </form>
            </div>
            @if($project->progress >= 15)
               <div class="card" id="step-3">
                  <form action="{{ url()->full() }}" method="POST">
                     @csrf
                     <div class="card-body">
                        <h5 class="card-title" id="scrollspy">Consultant Meeting</h5>
                        <div class="form-group"><hr></div>
                        @if(isset($_GET['step-3']))
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
                        @if($project->projectConsultantMeeting->count() > 0)
                           <div class="table-responsive">
                              <table class="table table-bordered table-striped">
                                 <thead class="table-secondary">
                                    <tr class="text-center">
                                       <th>Date</th>
                                       <th>Person</th>
                                       <th>Result</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($project->projectConsultantMeeting as $pcm)
                                       <tr class="text-center">
                                          <td class="align-middle">{{ $pcm->date }}</td>   
                                          <td class="align-middle">{{ $pcm->person }}</td>   
                                          <td class="align-middle">{{ $pcm->result }}</td>
                                       </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        @else
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Date :<sup class="text-danger">*</sup></label>
                                    <input type="date" name="consultant_date" id="consultant_date" class="form-control">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Person :<sup class="text-danger">*</sup></label>
                                    <input type="text" name="consultant_person" id="consultant_person" class="form-control" placeholder="Enter name person">
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Result :<sup class="text-danger">*</sup></label>
                                    <textarea name="consul_result" id="consultant_result" class="form-control" placeholder="Enter result"></textarea>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group text-center">
                                    <button type="button" onclick="addConsultant()" class="btn bg-success col-3"><i class="icon-plus2"></i> Add</button>
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
                                    <tbody id="data_consultant"></tbody>
                                 </table>
                              </div>
                           </div>
                           <div class="form-group"><hr></div>
                           <div class="form-group">
                              <div class="text-right">
                                 <button type="submit" name="submit" value="step-3" class="btn bg-purple"><i class="icon-floppy-disk"></i> Save</button>
                              </div>
                           </div>
                        @endif
                     </div>
                  </form>
               </div>
            @endif
            @if($project->progress >= 20)
               <div class="card" id="step-4">
                  <form action="{{ url()->full() }}" method="POST">
                     @csrf
                     <div class="card-body">
                        <h5 class="card-title" id="scrollspy">Pre Quotation</h5>
                        <div class="form-group"><hr></div>
                        @if(isset($_GET['step-4']))
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
                        <div class="form-group">
                           <div class="table-responsive">
                              <table class="table table-bordered table-striped">
                                 <thead class="table-secondary">
                                    <tr class="text-center">
                                       <th>Product</th>
                                       <th>Qty</th>
                                       <th>Price</th>
                                       <th>Target Price</th>
                                       <th>Recommended Price</th>
                                       <th>Unit</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($project->projectProduct as $pp)
                                       <tr class="text-center">
                                          <input type="hidden" name="project_product_id[]" value="{{ $pp->id }}">
                                          <td class="align-middle">{{ $pp->product->code() }}</td>   
                                          <td class="align-middle">{{ $pp->qty }}</td>   
                                          <td class="align-middle">{{ number_format($pp->price, 0, ',', '.') }}</td>   
                                          <td class="align-middle">{{ number_format($pp->target_price, 0, ',', '.') }}</td>   
                                          <td class="align-middle">
                                             @if($pp->recommended_price < 1)
                                                <input type="number" name="product_recommended_price[]" class="form-control" value="{{ $pp->bottom }}" placeholder="Price" required>
                                             @else
                                                {{ number_format($pp->recommended_price, 0, ',', '.') }}
                                             @endif   
                                          </td>   
                                          <td class="align-middle">{{ $pp->unit() }}</td> 
                                       </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        @if($project->progress < 25)
                           <div class="form-group"><hr></div>
                           <div class="form-group">
                              <div class="text-right">
                                 <button type="submit" name="submit" value="step-4" class="btn bg-purple"><i class="icon-floppy-disk"></i> Save</button>
                              </div>
                           </div>
                        @endif
                     </div>
                  </form>
               </div>
            @endif
            @if($project->progress >= 25)
               <div class="card" id="step-5">
                  <form action="{{ url()->full() }}" method="POST">
                     @csrf
                     <div class="card-body">
                        <h5 class="card-title" id="scrollspy">Form Sample</h5>
                        <div class="form-group"><hr></div>
                        @if(isset($_GET['step-5']))
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
                        @if($project->projectSample->count() > 0)
                           <div class="table-responsive">
                              <table class="table table-bordered table-striped">
                                 <thead class="table-secondary">
                                    <tr class="text-center">
                                       <th>Product</th>
                                       <th>Date</th>
                                       <th>Qty</th>
                                       <th>Size</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($project->projectSample as $ps)
                                       <tr class="text-center">
                                          <td class="align-middle">{{ $ps->product->code() }}</td>   
                                          <td class="align-middle">{{ $ps->date }}</td>   
                                          <td class="align-middle">{{ $ps->qty }}</td>   
                                          <td class="align-middle">{{ $ps->size }}</td>
                                       </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        @else
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Product :<sup class="text-danger">*</sup></label>
                                    <select name="sample_product_id" id="sample_product_id"></select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Date :<sup class="text-danger">*</sup></label>
                                    <input type="date" name="sample_date" id="sample_date" class="form-control">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Qty :<sup class="text-danger">*</sup></label>
                                    <input type="number" name="sample_qty" id="sample_qty" class="form-control" placeholder="Enter qty">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Size :<sup class="text-danger">*</sup></label>
                                    <input type="text" name="sample_size" id="sample_size" class="form-control" placeholder="Enter size">
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group text-center">
                                    <button type="button" onclick="addSample()" class="btn bg-success col-3"><i class="icon-plus2"></i> Add</button>
                                 </div>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="table-responsive">
                                 <table class="table table-bordered table-striped">
                                    <thead class="table-secondary">
                                       <tr class="text-center">
                                          <th>Product</th>
                                          <th>Date</th>
                                          <th>Qty</th>
                                          <th>Size</th>
                                          <th>Delete</th>
                                       </tr>
                                    </thead>
                                    <tbody id="data_sample"></tbody>
                                 </table>
                              </div>
                           </div>
                           <div class="form-group"><hr></div>
                           <div class="form-group">
                              <div class="text-right">
                                 <button type="submit" name="submit" value="step-5" class="btn bg-purple"><i class="icon-floppy-disk"></i> Save</button>
                              </div>
                           </div>
                        @endif
                     </div>
                  </form>
               </div>
            @endif
            @if($project->progress >= 30)
               <div class="card" id="step-6">
                  <form action="{{ url()->full() }}" method="POST">
                     @csrf
                     <div class="card-body">
                        <h5 class="card-title" id="scrollspy">Negotiation</h5>
                        <div class="form-group"><hr></div>
                        @if(isset($_GET['step-6']))
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
                        <div class="form-group">
                           <div class="table-responsive">
                              <table class="table table-bordered table-striped">
                                 <thead class="table-secondary">
                                    <tr class="text-center">
                                       <th>Product</th>
                                       <th>Qty</th>
                                       <th>Target Price</th>
                                       <th>Recommended Price</th>
                                       <th>Discount(%)</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($project->projectProduct as $pp)
                                       <tr class="text-center">
                                          <input type="hidden" name="project_product_id[]" value="{{ $pp->id }}">
                                          <td class="align-middle">{{ $pp->product->code() }}</td>   
                                          <td class="align-middle">{{ $pp->qty }}</td>    
                                          <td class="align-middle">{{ number_format($pp->target_price, 0, ',', '.') }}</td>   
                                          <td class="align-middle">
                                             {{ number_format($pp->recommended_price, 0, ',', '.') }}
                                          </td>   
                                          <td class="align-middle">
                                             @if($project->progress >= 35)
                                                {{ $pp->discount }}%
                                             @else
                                                <input type="number" name="product_discount[]" class="form-control" value="0" placeholder="Discount" required>
                                             @endif      
                                          </td> 
                                       </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        @if($project->progress < 35)
                           <div class="form-group"><hr></div>
                           <div class="form-group">
                              <div class="text-right">
                                 <button type="submit" name="submit" value="step-6" class="btn bg-purple"><i class="icon-floppy-disk"></i> Save</button>
                              </div>
                           </div>
                        @endif
                     </div>
                  </form>
               </div>
            @endif
         </div>
         <div class="sidebar-sticky order-1 order-md-2">
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
                              @if($project->progress >= 15)
                                 <i class="icon-check"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
                              Spec Project + Target Price
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-3" class="nav-link {{ $project->progress >= 15 ? '' : 'disabled' }}">
                              @if($project->progress >= 20)
                                 <i class="icon-check"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
                              Consultant Meeting
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-4" class="nav-link {{ $project->progress >= 20 ? '' : 'disabled' }}">
                              @if($project->progress >= 25)
                                 <i class="icon-check"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
                              Pre Quotation
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-5" class="nav-link {{ $project->progress >= 25 ? '' : 'disabled' }}">
                              @if($project->progress >= 30)
                                 <i class="icon-check"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
                              Form Sample
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-6" class="nav-link {{ $project->progress >= 30 ? '' : 'disabled' }}">
                              @if($project->progress >= 35)
                                 <i class="icon-check"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
                              Negotiation
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-7" class="nav-link {{ $project->progress >= 35 ? '' : 'disabled' }}">
                              @if($project->progress >= 40)
                                 <i class="icon-check"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
                              PO Project
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-8" class="nav-link {{ $project->progress >= 40 ? '' : 'disabled' }}">
                              @if($project->progress >= 43)
                                 <i class="icon-check"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
                              Data Vendor & PO
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-9" class="nav-link {{ $project->progress >= 43 ? '' : 'disabled' }}">
                              @if($project->progress >= 45)
                                 <i class="icon-check"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
                              Performance Invoice
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-10" class="nav-link {{ $project->progress >= 45 ? '' : 'disabled' }}">
                              @if($project->progress >= 50)
                                 <i class="icon-check"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
                              Production
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-11" class="nav-link {{ $project->progress >= 50 ? '' : 'disabled' }}">
                              @if($project->progress >= 55)
                                 <i class="icon-check"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
                              Pay Full Purchase
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-12" class="nav-link {{ $project->progress >= 55 ? '' : 'disabled' }}">
                              @if($project->progress >= 60)
                                 <i class="icon-check"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
                              Shipment
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-13" class="nav-link {{ $project->progress >= 60 ? '' : 'disabled' }}">
                              @if($project->progress >= 70)
                                 <i class="icon-check"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
                              Delivery To Project
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-14" class="nav-link {{ $project->progress >= 70 ? '' : 'disabled' }}">
                              @if($project->progress >= 90)
                                 <i class="icon-check"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
                              Proses Payment
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-15" class="nav-link {{ $project->progress >= 90 ? '' : 'disabled' }}">
                              @if($project->progress >= 100)
                                 <i class="icon-check"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
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
      $('.sidebar-main-toggle').click();
      select2ServerSide('#product_id', '{{ url("admin/select2/product") }}');
      select2ServerSide('#sample_product_id', '{{ url("admin/select2/product") }}');
      
      $('.sidebar-sticky .sidebar').stick_in_parent({
         offset_top: 20,
         parent: '.content',
         inner_scrolling: true
      });

      $('.sidebar-mobile-component-toggle').on('click', function() {
         $('.sidebar-sticky .sidebar').trigger('sticky_kit:detach');
      });

      $('#data_product').on('click', '#delete_data_product', function() {
         $(this).closest('tr').remove();
      });

      $('#data_consultant').on('click', '#delete_data_consultant', function() {
         $(this).closest('tr').remove();
      });

      $('#data_sample').on('click', '#delete_data_sample', function() {
         $(this).closest('tr').remove();
      });
   });
   
   function addProduct() {
      var id = $('#product_id');

      if(id.val()) {
         $.ajax({
            url: '{{ url("admin/project/get_product") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
               id: id.val()
            },
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
               loadingOpen('#step-2');
            },
            success: function(response) {
               loadingClose('#step-2');
               id.val(null).trigger('change');
               $('#data_product').append(`
                  <tr class="text-center">
                     <input type="hidden" name="product_id[]" value="` + response.id + `">
                     <input type="hidden" name="product_price[]" value="` + response.price + `">
                     <td class="align-middle">` + response.code + `</td>   
                     <td class="align-middle">
                        <input type="number" name="product_qty[]" class="form-control" min="1" placeholder="Qty" required>
                     </td>  
                     <td class="align-middle">
                        <div class="input-group">
                           <input type="number" name="product_target_price[]" class="form-control" placeholder="Price" required>
                        </div>
                     </td>  
                     <td class="align-middle">
                        <select name="product_unit[]" class="form-control" required>
                           <option value="1">Pcs</option>   
                           <option value="2">Box</option>   
                           <option value="3">Meter</option>   
                        </select>
                     </td>   
                     <td class="align-middle">
                        <button type="button" id="delete_data_product" class="btn bg-danger btn-sm"><i class="icon-trash"></i></button>   
                     </td>
                  </tr>
               `);
            },
            error: function() {
               loadingClose('#step-2');
               swal('Server Error!', 'Please contact developer', 'error');
            }
         });
      } else {
         swal('Ooppsss!', 'Please select a product', 'info');
      }
   }

   function addConsultant() {
      var consultant_date   = $('#consultant_date');
      var consultant_person = $('#consultant_person');
      var consultant_result = $('#consultant_result');

      if(consultant_date.val() && consultant_person.val() && consultant_result.val()) {
         $('#data_consultant').append(`
            <tr class="text-center">
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
         swal('Ooppsss!', 'Please entry all field', 'info');
      }
   }

   function addSample() {
      var sample_product_id = $('#sample_product_id');
      var sample_date       = $('#sample_date');
      var sample_qty        = $('#sample_qty');
      var sample_size       = $('#sample_size');

      if(sample_product_id.val() && sample_date.val() && sample_qty.val() && sample_size.val()) {
         $.ajax({
            url: '{{ url("admin/project/get_product") }}',
            type: 'POST',
            dataType: 'JSON',
            data: {
               id: sample_product_id.val()
            },
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
               loadingOpen('#step-5');
            },
            success: function(response) {
               loadingClose('#step-5');
               $('#data_sample').append(`
                  <tr class="text-center">
                     <input type="hidden" name="sample_product_id[]" value="` + sample_product_id.val() + `">
                     <input type="hidden" name="sample_date[]" value="` + sample_date.val() + `">
                     <input type="hidden" name="sample_qty[]" value="` + sample_qty.val() + `">
                     <input type="hidden" name="sample_size[]" value="` + sample_size.val() + `">

                     <td class="align-middle">` + response.code + `</td>  
                     <td class="align-middle">` + sample_date.val() + `</td>  
                     <td class="align-middle">` + sample_qty.val() + `</td>  
                     <td class="align-middle">` + sample_size.val() + `</td>  
                     <td class="align-middle">
                        <button type="button" id="delete_data_sample" class="btn bg-danger btn-sm"><i class="icon-trash"></i></button>   
                     </td>
                  </tr>
               `);

               sample_product_id.val(null).trigger('change');
               sample_date.val(null);
               sample_qty.val(null);
               sample_size.val(null);
            },
            error: function() {
               loadingClose('#step-5');
               swal('Server Error!', 'Please contact developer', 'error');
            }
         });
      } else {
         swal('Ooppsss!', 'Please entry all field', 'info');
      }
   }
</script>