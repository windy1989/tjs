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
					<span class="font-weight-semibold">Progress Sales Project</span>
				</h4>
			</div>
         <div class="header-elements">
				<div class="d-flex justify-content-center">
					<a href="{{ url('admin/sales/project') }}" class="btn bg-secondary btn-labeled btn-labeled-left">
						<b><i class="icon-arrow-left7"></i></b> Back To List
					</a>
				</div>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<a href="javascript:void(0);" class="breadcrumb-item">Data</a>
					<a href="{{ url('admin/sales/project') }}" class="breadcrumb-item">Project</a>
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
                                 <th>Unit</th>
                                 <th>Target Price</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($project->projectProduct as $pp)
                                 <tr class="text-center">
                                    <td class="align-middle">
                                       <a href="{{ $pp->product->type->image() }}" data-lightbox="{{ $pp->product->name() }}" data-title="{{ $pp->product->name() }}"><img src="{{ $pp->product->type->image() }}" style="max-width:70px;" class="img-fluid img-thumbnail mb-2"></a>
                                       <div>{{ $pp->product->name() }}</div>
                                       <div>{{ $pp->product->type->length }}x{{ $pp->product->type->width }}</div>
                                    </td>
                                    <td class="align-middle">{{ $pp->qty }}</td>   
                                    <td class="align-middle">{{ $pp->unit() }}</td> 
                                    <td class="align-middle">Rp {{ number_format($pp->target_price, 2, ',', '.') }}</td>   
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
                                       <th>Unit</th>
                                       <th>Target Price</th>
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
                                          <td class="align-middle">
                                             <a href="{{ $pp->product->type->image() }}" data-lightbox="{{ $pp->product->name() }}" data-title="{{ $pp->product->name() }}"><img src="{{ $pp->product->type->image() }}" style="max-width:70px;" class="img-fluid img-thumbnail mb-2"></a>
                                             <div>{{ $pp->product->name() }}</div>
                                             <div>{{ $pp->product->type->length }}x{{ $pp->product->type->width }}</div>
                                          </td>
                                          <td class="align-middle">{{ $pp->qty }}</td>   
                                          <td class="align-middle">Rp {{ number_format($pp->price, 2, ',', '.') }}</td>   
                                          <td class="align-middle">Rp {{ number_format($pp->target_price, 2, ',', '.') }}</td>   
                                          <td class="align-middle">
                                             @if($pp->recommended_price < 1)
                                                <input type="number" name="product_recommended_price[]" class="form-control" value="{{ $pp->bottom }}" placeholder="0" required>
                                             @else
                                                Rp {{ number_format($pp->recommended_price, 2, ',', '.') }}
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
                                          <td class="align-middle">
                                             <a href="{{ $ps->product->type->image() }}" data-lightbox="{{ $ps->product->name() }}" data-title="{{ $ps->product->name() }}"><img src="{{ $ps->product->type->image() }}" style="max-width:70px;" class="img-fluid img-thumbnail mb-2"></a>
                                             <div>{{ $ps->product->name() }}</div>
                                             <div>{{ $ps->product->type->length }}x{{ $ps->product->type->width }}</div>
                                          </td>
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
                                    <input type="number" name="sample_qty" id="sample_qty" class="form-control" placeholder="0">
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
                                       <th>Project Price</th>
                                       <th>Discount(%)</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($project->projectProduct as $pp)
                                       <tr class="text-center">
                                          <input type="hidden" name="project_product_id[]" value="{{ $pp->id }}">
                                          <td class="align-middle">
                                             <a href="{{ $ps->product->type->image() }}" data-lightbox="{{ $ps->product->name() }}" data-title="{{ $ps->product->name() }}"><img src="{{ $ps->product->type->image() }}" style="max-width:70px;" class="img-fluid img-thumbnail mb-2"></a>
                                             <div>{{ $ps->product->name() }}</div>
                                             <div>{{ $ps->product->type->length }}x{{ $ps->product->type->width }}</div>
                                          </td>
                                          <td class="align-middle">{{ $pp->qty }}</td>    
                                          <td class="align-middle">Rp {{ number_format($pp->target_price, 2, ',', '.') }}</td>   
                                          <td class="align-middle">
                                             Rp {{ number_format($pp->recommended_price, 2, ',', '.') }}
                                          </td>   
                                          <td class="align-middle">
                                             @if($project->progress >= 35)
                                                {{ $pp->discount }}%
                                             @else
                                                <input type="number" name="product_discount[]" class="form-control" value="0" placeholder="0" required>
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
            @if($project->progress >= 35)
               <div class="card" id="step-7">
                  <form action="{{ url()->full() }}" method="POST">
                     @csrf
                     <div class="card-body">
                        <h5 class="card-title" id="scrollspy">SO Project</h5>
                        <div class="form-group"><hr></div>
                        <div class="text-center">
                           <span class="font-weight-semibold">Click the link below to view the sales order</span>
                           <div class="form-group">
                              <a href="{{ url('admin/sales/project/print/sales_order/' . base64_encode($project->id)) }}" class="text-primary font-italic">Here</a>
                           </div>
                        </div>
                        @if($project->progress < 40)
                           <div class="form-group"><hr></div>
                           <div class="form-group">
                              <div class="text-right">
                                 <button type="submit" name="submit" value="step-7" class="btn bg-purple"><i class="icon-floppy-disk"></i> Next Step</button>
                              </div>
                           </div>
                        @endif
                     </div>
                  </form>
               </div>
            @endif
            @if($project->progress >= 40)
               <div class="card" id="step-8">
                  <form action="{{ url()->full() }}" method="POST">
                     @csrf
                     <div class="card-body">
                        <h5 class="card-title" id="scrollspy">PO Project</h5>
                        <div class="form-group"><hr></div>
                        <div class="text-center">
                           <span class="font-weight-semibold">Click the link below to view the purchase order</span>
                           <div class="form-group">
                              <a href="{{ url('admin/sales/project/print/purchase_order/' . base64_encode($project->id)) }}" class="text-primary font-italic">Here</a>
                           </div>
                        </div>
                        @if($project->progress < 43)
                           <div class="form-group"><hr></div>
                           <div class="form-group">
                              <div class="text-right">
                                 <button type="submit" name="submit" value="step-8" class="btn bg-purple"><i class="icon-floppy-disk"></i> Next Step</button>
                              </div>
                           </div>
                        @endif
                     </div>
                  </form>
               </div>
            @endif
            @if($project->progress >= 43)
               <div class="card" id="step-9">
                  <form action="{{ url()->full() }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="card-body">
                        <h5 class="card-title" id="scrollspy">Proforma Invoice</h5>
                        <div class="form-group"><hr></div>
                        @php $proforma_invoice = $project->projectPayment()->where('status', 1)->first(); @endphp
                        @if($proforma_invoice)
                           <div class="row justify-content-center">
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="font-weight-semibold">Date :</label>
										      <div class="form-control-plaintext">{{ $proforma_invoice->date }}</div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="font-weight-semibold">Bank :</label>
										      <div class="form-control-plaintext">{{ $proforma_invoice->bank() }}</div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="font-weight-semibold">Nominal :</label>
										      <div class="form-control-plaintext">
                                       {{ number_format($proforma_invoice->nominal, 2, ',', '.') }}
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group"><hr class="mt-0"></div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <div class="text-center">
                                       <a href="{{ asset(Storage::url($proforma_invoice->image)) }}" data-lightbox="Image" data-title="Proforma Invoice">
                                          <img src="{{ asset(Storage::url($proforma_invoice->image)) }}" class="img-fluid img-thumbnail w-100" style="max-width:200px;">
                                       </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        @else
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
                           <div class="row justify-content-center">
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
                                       <option value="1" {{ old('bank') == 1 ? 'selected' : '' }}>BCA</option>
                                       <option value="2" {{ old('bank') == 2 ? 'selected' : '' }}>Mandiri</option>
                                       <option value="3" {{ old('bank') == 3 ? 'selected' : '' }}>OCBC</option>
                                       <option value="4" {{ old('bank') == 4 ? 'selected' : '' }}>BRI</option>
                                       <option value="5" {{ old('bank') == 5 ? 'selected' : '' }}>Danamon</option>
                                       <option value="6" {{ old('bank') == 6 ? 'selected' : '' }}>Bukopin</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label>Nominal :<sup class="text-danger">*</sup></label>
                                    <input type="number" name="nominal" id="nominal" class="form-control" placeholder="0" value="{{ old('nominal') }}">
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group"><hr class="mt-0"></div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <div class="input-group">
                                       <div class="custom-file">
                                          <input type="file" id="image" name="image" class="form-control h-auto" accept="image/x-png,image/jpg,image/jpeg" onchange="previewImage(this, '#preview_image')">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <div class="text-center">
                                       <a href="{{ asset('website/empty.jpg') }}" id="preview_image" data-lightbox="Image" data-title="Preview Image">
                                          <img src="{{ asset('website/empty.jpg') }}" class="img-fluid img-thumbnail w-100" style="max-width:200px;">
                                       </a>
                                       <p class="text-danger font-italic mt-3">
                                          The only files supported are <b>jpeg, jpg, png</b>
                                       </p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        @endif
                        @if($project->progress < 45)
                           <div class="form-group"><hr></div>
                           <div class="form-group">
                              <div class="text-right">
                                 <button type="submit" name="submit" value="step-9" class="btn bg-purple"><i class="icon-floppy-disk"></i> Save</button>
                              </div>
                           </div>
                        @endif
                     </div>
                  </form>
               </div>
            @endif
            @if($project->progress >= 45)
               <div class="card" id="step-10">
                  <form action="{{ url()->full() }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="card-body">
                        <h5 class="card-title" id="scrollspy">Production</h5>
                        <div class="form-group"><hr></div>
                        @if($project->projectProduction)
                           <div class="row justify-content-center">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <div class="font-weight-semibold text-center">Start Date :</div>
										      <div class="form-control-plaintext text-center">{{ $project->projectProduction->start_date }}</div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <div class="font-weight-semibold text-center">Finish Date :</div>
										      <div class="form-control-plaintext text-center">{{ $project->projectProduction->finish_date }}</div>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <div class="font-weight-semibold text-center">Note :</div>
										      <div class="form-control-plaintext text-center">
                                       {{ $project->projectProduction->note }}
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group"><hr class="mt-0"></div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <div class="text-center">
                                       <a href="{{ asset(Storage::url($project->projectProduction->image)) }}" data-lightbox="Image" data-title="Production">
                                          <img src="{{ asset(Storage::url($project->projectProduction->image)) }}" class="img-fluid img-thumbnail w-100" style="max-width:200px;">
                                       </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        @else
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
                           <div class="row justify-content-center">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Start Date :<sup class="text-danger">*</sup></label>
                                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date') }}">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Finish Date :<sup class="text-danger">*</sup></label>
                                    <input type="date" name="finish_date" id="finish_date" class="form-control" value="{{ old('finish_date') }}">
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Note :<sup class="text-danger">*</sup></label>
                                    <textarea name="note" id="note" class="form-control" placeholder="Enter note">{{ old('note') }}</textarea>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group"><hr class="mt-0"></div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <div class="input-group">
                                       <div class="custom-file">
                                          <input type="file" id="image" name="image" class="form-control h-auto" accept="image/x-png,image/jpg,image/jpeg" onchange="previewImage(this, '#preview_image')">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <div class="text-center">
                                       <a href="{{ asset('website/empty.jpg') }}" id="preview_image" data-lightbox="Image" data-title="Preview Image">
                                          <img src="{{ asset('website/empty.jpg') }}" class="img-fluid img-thumbnail w-100" style="max-width:200px;">
                                       </a>
                                       <p class="text-danger font-italic mt-3">
                                          The only files supported are <b>jpeg, jpg, png</b>
                                       </p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        @endif
                        @if($project->progress < 50)
                           <div class="form-group"><hr></div>
                           <div class="form-group">
                              <div class="text-right">
                                 <button type="submit" name="submit" value="step-10" class="btn bg-purple"><i class="icon-floppy-disk"></i> Save</button>
                              </div>
                           </div>
                        @endif
                     </div>
                  </form>
               </div>
            @endif
            @if($project->progress >= 50)
               <div class="card" id="step-11">
                  <form action="{{ url()->full() }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="card-body">
                        <h5 class="card-title" id="scrollspy">Pay Full Purchase</h5>
                        <div class="form-group"><hr></div>
                        @php $pay_full_purchase = $project->projectPayment()->where('status', 2)->first(); @endphp
                        @if($pay_full_purchase)
                           <div class="row justify-content-center">
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="font-weight-semibold">Date :</label>
										      <div class="form-control-plaintext">{{ $pay_full_purchase->date }}</div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="font-weight-semibold">Bank :</label>
										      <div class="form-control-plaintext">{{ $pay_full_purchase->bank() }}</div>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label class="font-weight-semibold">Nominal :</label>
										      <div class="form-control-plaintext">
                                       {{ number_format($pay_full_purchase->nominal, 2, ',', '.') }}
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group"><hr class="mt-0"></div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <div class="text-center">
                                       <a href="{{ asset(Storage::url($pay_full_purchase->image)) }}" data-lightbox="Image" data-title="Proforma Invoice">
                                          <img src="{{ asset(Storage::url($pay_full_purchase->image)) }}" class="img-fluid img-thumbnail w-100" style="max-width:200px;">
                                       </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        @else
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
                           <div class="row justify-content-center">
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
                                       <option value="1" {{ old('bank') == 1 ? 'selected' : '' }}>BCA</option>
                                       <option value="2" {{ old('bank') == 2 ? 'selected' : '' }}>Mandiri</option>
                                       <option value="3" {{ old('bank') == 3 ? 'selected' : '' }}>OCBC</option>
                                       <option value="4" {{ old('bank') == 4 ? 'selected' : '' }}>BRI</option>
                                       <option value="5" {{ old('bank') == 5 ? 'selected' : '' }}>Danamon</option>
                                       <option value="6" {{ old('bank') == 6 ? 'selected' : '' }}>Bukopin</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-4">
                                 <div class="form-group">
                                    <label>Nominal :<sup class="text-danger">*</sup></label>
                                    <input type="number" name="nominal" id="nominal" class="form-control" placeholder="0" value="{{ old('nominal') }}">
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group"><hr class="mt-0"></div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <div class="input-group">
                                       <div class="custom-file">
                                          <input type="file" id="image" name="image" class="form-control h-auto" accept="image/x-png,image/jpg,image/jpeg" onchange="previewImage(this, '#preview_image')">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <div class="text-center">
                                       <a href="{{ asset('website/empty.jpg') }}" id="preview_image" data-lightbox="Image" data-title="Preview Image">
                                          <img src="{{ asset('website/empty.jpg') }}" class="img-fluid img-thumbnail w-100" style="max-width:200px;">
                                       </a>
                                       <p class="text-danger font-italic mt-3">
                                          The only files supported are <b>jpeg, jpg, png</b>
                                       </p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        @endif
                        @if($project->progress < 55)
                           <div class="form-group"><hr></div>
                           <div class="form-group">
                              <div class="text-right">
                                 <button type="submit" name="submit" value="step-11" class="btn bg-purple"><i class="icon-floppy-disk"></i> Save</button>
                              </div>
                           </div>
                        @endif
                     </div>
                  </form>
               </div>
            @endif
            @if($project->progress >= 55)
               <div class="card" id="step-12">
                  <form action="{{ url()->full() }}" method="POST">
                     @csrf
                     <div class="card-body">
                        <h5 class="card-title" id="scrollspy">Shipment</h5>
                        <div class="form-group"><hr></div>
                        @if($project->projectShipment)
                           <table cellpadding="10" cellspacing="0" width="100%">
                              <tbody>
                                 <tr>
                                    <th width="20%" class="align-middle">Loading Date</th>
                                    <td class="align-middle">: {{ $project->projectShipment->loading_date }}</td>
                                 </tr>
                                 <tr>
                                    <th width="20%" class="align-middle">Departure Date</th>
                                    <td class="align-middle">: {{ $project->projectShipment->departure_date }}</td>
                                 </tr>
                                 <tr>
                                    <th width="20%" class="align-middle">From Port</th>
                                    <td class="align-middle">: {{ $project->projectShipment->from_port }}</td>
                                 </tr>
                                 <tr>
                                    <th width="20%" class="align-middle">To Port</th>
                                    <td class="align-middle">: {{ $project->projectShipment->to_port }}</td>
                                 </tr>
                                 <tr>
                                    <th width="20%" class="align-middle">ETA</th>
                                    <td class="align-middle">: {{ $project->projectShipment->eta }}</td>
                                 </tr>
                                 <tr>
                                    <th width="20%" class="align-middle">Note</th>
                                    <td class="align-middle">: {{ $project->projectShipment->note ? $project->projectShipment->note : '-' }}</td>
                                 </tr>
                              </tbody>
                           </table>
                        @else
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
                           <div class="row justify-content-center">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Loading Date :<sup class="text-danger">*</sup></label>
                                    <input type="date" name="loading_date" id="loading_date" class="form-control" value="{{ old('loading_date') }}">
                                 </div>
                              </div>
                              <div class="col-md-6">
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
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Note :</label>
                                    <textarea name="note" id="note" class="form-control" placeholder="Enter note">{{ old('note') }}</textarea>
                                 </div>
                              </div>
                           </div>
                        @endif
                        @if($project->progress < 60)
                           <div class="form-group"><hr></div>
                           <div class="form-group">
                              <div class="text-right">
                                 <button type="submit" name="submit" value="step-12" class="btn bg-purple"><i class="icon-floppy-disk"></i> Save</button>
                              </div>
                           </div>
                        @endif
                     </div>
                  </form>
               </div>
            @endif
            @if($project->progress >= 60)
               <div class="card" id="step-13">
                  <form action="{{ url()->full() }}" method="POST">
                     @csrf
                     <div class="card-body">
                        <h5 class="card-title" id="scrollspy">Delivery To Project</h5>
                        <div class="form-group"><hr></div>
                        @if($project->projectDelivery)
                           <table cellpadding="10" cellspacing="0" width="100%">
                              <tbody>
                                 <tr>
                                    <th width="20%" class="align-middle">Receiver Name</th>
                                    <td class="align-middle">: {{ $project->projectDelivery->receiver_name }}</td>
                                 </tr>
                                 <tr>
                                    <th width="20%" class="align-middle">Delivery Date</th>
                                    <td class="align-middle">: {{ $project->projectDelivery->delivery_date }}</td>
                                 </tr>
                                 <tr>
                                    <th width="20%" class="align-middle">Email</th>
                                    <td class="align-middle">: {{ $project->projectDelivery->email }}</td>
                                 </tr>
                                 <tr>
                                    <th width="20%" class="align-middle">Phone</th>
                                    <td class="align-middle">: {{ $project->projectDelivery->phone }}</td>
                                 </tr>
                                 <tr>
                                    <th width="20%" class="align-middle">City</th>
                                    <td class="align-middle">: {{ $project->projectDelivery->city->name }}</td>
                                 </tr>
                                 <tr>
                                    <th width="20%" class="align-middle">Address</th>
                                    <td class="align-middle">: {{ $project->projectDelivery->address }}</td>
                                 </tr>
                                 <tr>
                                    <th width="20%" class="align-middle">Type Of Transport</th>
                                    <td class="align-middle">: {{ $project->projectDelivery->delivery->transport->fleet }}</td>
                                 </tr>
                                 <tr>
                                    <th width="20%" class="align-middle">Delivery Cost</th>
                                    <td class="align-middle">: {{ number_format($project->projectDelivery->price, 2, ',', '.') }}</td>
                                 </tr>
                              </tbody>
                           </table>
                        @else
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
                           <div class="row justify-content-center">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Receiver Name :<span class="text-danger">*</span></label>
                                    <input type="text" name="receiver_name" id="receiver_name" class="form-control" value="{{ old('receiver_name') }}" placeholder="Enter receiver name" onkeyup="checkSubmitButton()" required>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Delivery Date :<span class="text-danger">*</span></label>
                                    <input type="date" name="delivery_date" id="delivery_date" class="form-control" value="{{ old('delivery_date') }}" onchange="checkSubmitButton()" required>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Email :<span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $project->email) }}" placeholder="Enter email" onkeyup="checkSubmitButton()" required>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Phone :<span class="text-danger">*</span></label>
                                    <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $project->phone) }}" placeholder="Enter phone" onkeyup="checkSubmitButton()" required>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>City :<span class="text-danger">*</span></label>
                                    <select name="city_id" id="city_id" class="select2" style="width:100%;" onchange="getDelivery()" required>
                                       <option value="">-- Choose --</option>
                                       @foreach($city as $c)
                                          <option value="{{ $c->id }}">{{ $c->name }}</option>
                                       @endforeach
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Transport :<span class="text-danger">*</span></label>
                                    <select name="delivery_id" id="delivery_id" class="form-control">
                                       <option value="">-- Choose --</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Address :<span class="text-danger">*</span></label>
                                    <textarea name="address" id="address" class="form-control" placeholder="Enter address" onkeyup="checkSubmitButton()" required>{{ old('address') }}</textarea>
                                 </div>
                              </div>
                           </div>
                        @endif
                        @if($project->progress < 70)
                           <div class="form-group"><hr></div>
                           <div class="form-group">
                              <div class="text-right">
                                 <button type="submit" name="submit" value="step-13" class="btn bg-purple submit_delivery" disabled><i class="icon-floppy-disk"></i> Save</button>
                              </div>
                           </div>
                        @endif
                     </div>
                  </form>
               </div>
            @endif
            @if($project->progress >= 70)
               <div class="card" id="step-14">
                  <form action="{{ url()->full() }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="card-body">
                        <h5 class="card-title" id="scrollspy">Process Payment</h5>
                        <div class="form-group"><hr></div>
                        @if($project->projectPay)
                           <div class="row justify-content-center">
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="font-weight-semibold">Date :</label>
										      <div class="form-control-plaintext">{{ $project->projectPay->date }}</div>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="font-weight-semibold">Nominal :</label>
										      <div class="form-control-plaintext">
                                       {{ number_format($project->projectPay->nominal, 2, ',', '.') }}
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="font-weight-semibold">Payment :</label>
                                    <div class="form-control-plaintext">{{ $project->projectPay->payment() }}</div>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <div class="form-group">
                                    <label class="font-weight-semibold">Payment Method :</label>
                                    <div class="form-control-plaintext">{{ $project->projectPay->paymentMethod() }}</div>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group"><hr class="mt-0"></div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <div class="text-center">
                                       <a href="{{ asset(Storage::url($project->projectPay->image)) }}" data-lightbox="Image" data-title="Proforma Invoice">
                                          <img src="{{ asset(Storage::url($project->projectPay->image)) }}" class="img-fluid img-thumbnail w-100" style="max-width:200px;">
                                       </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        @else
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
                           <div class="row justify-content-center">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Date :<sup class="text-danger">*</sup></label>
                                    <input type="date" name="date" id="date" class="form-control" value="{{ old('date') }}">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Nominal :<sup class="text-danger">*</sup></label>
                                    <input type="number" name="nominal" id="nominal" class="form-control" placeholder="0" value="{{ old('nominal') }}">
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Payment :<sup class="text-danger">*</sup></label>
                                    <select name="payment" id="payment" class="custom-select">
                                       <option value="">-- Choose --</option>
                                       <option value="1" {{ old('payment') == 1 ? 'selected' : '' }}>Cash</option>
                                       <option value="2" {{ old('payment') == 2 ? 'selected' : '' }}>Credit</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Payment Method :<sup class="text-danger">*</sup></label>
                                    <select name="payment_method" id="payment_method" class="custom-select">
                                       <option value="">-- Choose --</option>
                                       <option value="1" {{ old('payment_method') == 1 ? 'selected' : '' }}>DP</option>
                                       <option value="2" {{ old('payment_method') == 2 ? 'selected' : '' }}>Non DP</option>
                                    </select>
                                 </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group"><hr class="mt-0"></div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <div class="input-group">
                                       <div class="custom-file">
                                          <input type="file" id="image" name="image" class="form-control h-auto" accept="image/x-png,image/jpg,image/jpeg" onchange="previewImage(this, '#preview_image')">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group">
                                    <div class="text-center">
                                       <a href="{{ asset('website/empty.jpg') }}" id="preview_image" data-lightbox="Image" data-title="Preview Image">
                                          <img src="{{ asset('website/empty.jpg') }}" class="img-fluid img-thumbnail w-100" style="max-width:200px;">
                                       </a>
                                       <p class="text-danger font-italic mt-3">
                                          The only files supported are <b>jpeg, jpg, png</b>
                                       </p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        @endif
                        @if($project->progress < 90)
                           <div class="form-group"><hr></div>
                           <div class="form-group">
                              <div class="text-right">
                                 <button type="submit" name="submit" value="step-14" class="btn bg-purple"><i class="icon-floppy-disk"></i> Save</button>
                              </div>
                           </div>
                        @endif
                     </div>
                  </form>
               </div>
            @endif
            @if($project->progress >= 90)
               <div class="card" id="step-14">
                  <form action="{{ url()->full() }}" method="POST">
                     @csrf
                     <div class="card-body">
                        <h5 class="card-title" id="scrollspy">Done</h5>
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
                        <div class="text-center">
                           @if($project->progress >= 100)
                              <div class="text-center">
                                 <i class="icon-checkmark-circle text-success font-weight-bold" style="font-size:50px;"></i>
                                 <div class="font-weight-bold mt-2">
                                    <h5 class="text-uppercase font-weight-bold">Progress Complete</h5>
                                 </div>
                                 <p class="text-muted">Project progress has been completed up to 100%</p>
                              </div>
                           @else
                              <h6 class="font-italic text-danger font-weight-bold">*) Please press the button below if you want to complete the project</h6>
                           @endif
                        </div>
                        @if($project->progress < 100)
                           <div class="form-group"><hr></div>
                           <div class="form-group">
                              <div class="text-right">
                                 <button type="submit" name="submit" value="step-15" class="btn bg-purple"><i class="icon-floppy-disk"></i> Save & Finish</button>
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
                              <i class="icon-check text-success"></i>
                              Project Information
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-2" class="nav-link">
                              @if($project->progress >= 15)
                                 <i class="icon-check text-success"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
                              Spec Project + Target Price
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
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-4" class="nav-link {{ $project->progress >= 20 ? '' : 'disabled' }}">
                              @if($project->progress >= 25)
                                 <i class="icon-check text-success"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
                              Pre Quotation
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
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-7" class="nav-link {{ $project->progress >= 35 ? '' : 'disabled' }}">
                              @if($project->progress >= 40)
                                 <i class="icon-check text-success"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
                              SO Project
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-8" class="nav-link {{ $project->progress >= 40 ? '' : 'disabled' }}">
                              @if($project->progress >= 43)
                                 <i class="icon-check text-success"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
                              PO Project
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-9" class="nav-link {{ $project->progress >= 43 ? '' : 'disabled' }}">
                              @if($project->progress >= 45)
                                 <i class="icon-check text-success"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
                              Proforma Invoice
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-10" class="nav-link {{ $project->progress >= 45 ? '' : 'disabled' }}">
                              @if($project->progress >= 50)
                                 <i class="icon-check text-success"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
                              Production
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-11" class="nav-link {{ $project->progress >= 50 ? '' : 'disabled' }}">
                              @if($project->progress >= 55)
                                 <i class="icon-check text-success"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
                              Pay Full Purchase
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-12" class="nav-link {{ $project->progress >= 55 ? '' : 'disabled' }}">
                              @if($project->progress >= 60)
                                 <i class="icon-check text-success"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
                              Shipment
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-13" class="nav-link {{ $project->progress >= 60 ? '' : 'disabled' }}">
                              @if($project->progress >= 70)
                                 <i class="icon-check text-success"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
                              Delivery To Project
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-14" class="nav-link {{ $project->progress >= 70 ? '' : 'disabled' }}">
                              @if($project->progress >= 90)
                                 <i class="icon-check text-success"></i>
                              @else
                                 <i class="icon-spinner10"></i>
                              @endif
                              Process Payment
                           </a>
                        </li>
                        <li class="nav-item">
                           <a href="#step-15" class="nav-link {{ $project->progress >= 90 ? '' : 'disabled' }}">
                              @if($project->progress >= 100)
                                 <i class="icon-check text-success"></i>
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

   function checkSubmitButton() {
		var receiver_name = $('#receiver_name').val();
		var email         = $('#email').val();
		var phone         = $('#phone').val();
		var city_id       = $('#city_id').val();
		var address       = $('#address').val();
		var delivery_id   = $('#delivery_id').val();
		var delivery_date = $('#delivery_date').val();

		if(receiver_name && email && phone && city_id && address && delivery_id && delivery_date) {
			$('.submit_delivery').attr('disabled', false);
		} else {
			$('.submit_delivery').attr('disabled', true);
		}
	}

   function getDelivery() {
		$.ajax({
			url: '{{ url("admin/sales/project/get_delivery") }}',
			type: 'GET',
         dataType: 'JSON',
         data: {
            city_id: $('#city_id').val(),
				id: '{{ $project->id }}'
         },
         beforeSend: function() {
            loadingOpen('#step-13');
				$('#delivery_id').html('<option value="">-- Choose --</option>');
         },
         success: function(response) {
            loadingClose('#step-13');
				if($('#city_id').val()) {
					if(response.length > 0) {
						$.each(response, function(i, val) {
							$('#delivery_id').append(`
								<option value="` + val.id + `">(` + val.transport_name + `) &nbsp;&nbsp; ` + val.price + `</option>
							`);
						});
					}
				}
         },
         error: function() {
            loadingClose('#step-13');
				swalInit.fire('Server Error!', 'Please contact developer', 'error');
         }
		});
	}
   
   function addProduct() {
      var id = $('#product_id');

      if(id.val()) {
         $.ajax({
            url: '{{ url("admin/sales/project/get_product") }}',
            type: 'GET',
            dataType: 'JSON',
            data: {
               id: id.val()
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
                     <td class="align-middle">` + response.product + `</td>   
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
                        <div class="input-group">
                           <input type="number" name="product_target_price[]" class="form-control" placeholder="0" required>
                        </div>
                     </td>  
                     <td class="align-middle">
                        <button type="button" id="delete_data_product" class="btn bg-danger btn-sm"><i class="icon-trash"></i></button>   
                     </td>
                  </tr>
               `);
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
         swalInit.fire('Ooppsss!', 'Please entry all field', 'info');
      }
   }

   function addSample() {
      var sample_product_id = $('#sample_product_id');
      var sample_date       = $('#sample_date');
      var sample_qty        = $('#sample_qty');
      var sample_size       = $('#sample_size');

      if(sample_product_id.val() && sample_date.val() && sample_qty.val() && sample_size.val()) {
         $.ajax({
            url: '{{ url("admin/sales/project/get_product") }}',
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
               $('#data_sample').append(`
                  <tr class="text-center">
                     <input type="hidden" name="sample_product_id[]" value="` + sample_product_id.val() + `">
                     <input type="hidden" name="sample_date[]" value="` + sample_date.val() + `">
                     <input type="hidden" name="sample_qty[]" value="` + sample_qty.val() + `">
                     <input type="hidden" name="sample_size[]" value="` + sample_size.val() + `">

                     <td class="align-middle">` + response.product + `</td>  
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
               swalInit.fire('Server Error!', 'Please contact developer', 'error');
            }
         });
      } else {
         swalInit.fire('Ooppsss!', 'Please entry all field', 'info');
      }
   }
</script>