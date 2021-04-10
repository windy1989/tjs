<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Create New Product Type</span>
				</h4>
			</div>
			<div class="header-elements d-none">
				<div class="d-flex justify-content-center">
					<a href="{{ url('admin/product/type') }}" class="btn bg-secondary btn-labeled btn-labeled-left">
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
					<a href="{{ url('admin/product/type') }}" class="breadcrumb-item">Type</a>
					<span class="breadcrumb-item active">Add Data</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="card">
			<div class="card-body">
            <form action="" method="POST" id="form_data" enctype="multipart/form-data">
               <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                  <li class="nav-item">
                     <a href="#highlighted-justified-tab1" class="nav-link active" data-toggle="tab">Data</a>
                  </li>
                  <li class="nav-item">
                     <a href="#highlighted-justified-tab2" class="nav-link" data-toggle="tab">Specification</a>
                  </li>
                  <li class="nav-item">
                     <a href="#highlighted-justified-tab3" class="nav-link" data-toggle="tab">Stock</a>
                  </li>
                  <li class="nav-item">
                     <a href="#highlighted-justified-tab4" class="nav-link" data-toggle="tab">Image</a>
                  </li>
               </ul>
               <div class="tab-content">
                  <div class="tab-pane fade show active" id="highlighted-justified-tab1">
                     <p class="mt-4">
                        <div class="form-group">
                           <label>Category :<span class="text-danger">*</span></label>
                           <select name="category_id" id="category_id" class="select2">
                              <option value="">-- Choose --</option>
                              @foreach($category as $c)
                                 @php $sub_1 = App\Models\Category::where('parent_id', $c->id)->where('status', 1)->oldest('name')->get(); @endphp
                                 @if($sub_1->count() > 0)
                                    @foreach($sub_1 as $s1)
                                       @php $sub_2 = App\Models\Category::where('parent_id', $s1->id)->where('status', 1)->oldest('name')->get(); @endphp
                                       @if($sub_2->count() > 0)
                                          @foreach($sub_2 as $s2)
                                             <option value="{{ $s2->id }}">{{ $c->name }} &rarr; {{ $s1->name }} &rarr; {{ $s2->name }}</option>
                                          @endforeach
                                       @else
                                          <option value="{{ $s1->id }}">{{ $c->name }} &rarr; {{ $s1->name }}</option>
                                       @endif
                                    @endforeach
                                 @else
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                 @endif
                              @endforeach
                           </select>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Code :<span class="text-danger">*</span></label>
                                 <input type="text" name="code" id="code" class="form-control" placeholder="Enter code">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Faces :<small class="font-italic font-weight-bold text-danger">*Tile Product</small></label>
                                 <input type="text" name="faces" id="faces" class="form-control" placeholder="Enter faces">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Company :<span class="text-danger">*</span></label>
                                 <select name="company_id" id="company_id" class="select2">
                                    <option value="">-- Choose --</option>
                                    @foreach($company as $c)
                                       <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Division :<span class="text-danger">*</span></label>
                                 <select name="division_id" id="division_id" class="select2">
                                    <option value="">-- Choose --</option>
                                    @foreach($division as $d)
                                       <option value="{{ $d->id }}">{{ $d->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Quality :<span class="text-danger">*</span></label>
                                 <select name="quality" id="quality" class="custom-select">
                                    <option value="">-- Choose --</option>
                                    <option value="1">Import</option>
                                    <option value="2">Local</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Surface :<small class="font-italic font-weight-bold text-danger">*Tile Product</small></label>
                                 <select name="surface_id" id="surface_id" class="select2">
                                    <option value="">-- Choose --</option>
                                    @foreach($surface as $s)
                                       <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Color :<span class="text-danger">*</span></label>
                                 <select name="color_id" id="color_id" class="select2">
                                    <option value="">-- Choose --</option>
                                    @foreach($color as $c)
                                       <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Pattern :<span class="text-danger">*</span></label>
                                 <select name="pattern_id" id="pattern_id" class="select2">
                                    <option value="">-- Choose --</option>
                                    @foreach($pattern as $p)
                                       <option value="{{ $p->id }}">{{ $p->name }}</option>
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
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Material :<span class="text-danger">*</span></label>
                                 <select name="material" id="material" class="custom-select">
                                    <option value="">-- Choose --</option>
                                    <option value="1">High</option>
                                    <option value="2">Medium</option>
                                    <option value="3">Low</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Specification :<span class="text-danger">*</span></label>
                                 <select name="specification_id" id="specification_id" class="select2">
                                    <option value="">-- Choose --</option>
                                    @foreach($specification as $s)
                                       <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Length :<small class="font-italic font-weight-bold text-danger">*Tile Product</small></label>
                                 <input type="number" name="length" id="length" class="form-control" placeholder="Enter length">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Width :<small class="font-italic font-weight-bold text-danger">*Tile Product</small></label>
                                 <input type="number" name="width" id="width" class="form-control" placeholder="Enter width">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Height :<span class="text-danger">*</span></label>
                                 <input type="number" name="height" id="height" class="form-control" placeholder="Enter height">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Weight :<span class="text-danger">*</span></label>
                                 <input type="number" name="weight" id="weight" class="form-control" placeholder="Enter weight">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Thickness :<span class="text-danger">*</span></label>
                                 <input type="number" name="thickness" id="thickness" class="form-control" placeholder="Enter thickness">
                              </div>
                           </div>
                        </div>
                     </p>
                  </div>
                  <div class="tab-pane fade" id="highlighted-justified-tab3">
                     <p class="mt-4">
                        <div class="row">
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label>Buying Unit :<span class="text-danger">*</span></label>
                                 <select name="buying_unit_id" id="buying_unit_id" class="select2">
                                    <option value="">-- Choose --</option>
                                    @foreach($unit as $u)
                                       <option value="{{ $u->id }}">{{ $u->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label>Stock Unit :<span class="text-danger">*</span></label>
                                 <select name="stock_unit_id" id="stock_unit_id" class="select2">
                                    <option value="">-- Choose --</option>
                                    @foreach($unit as $u)
                                       <option value="{{ $u->id }}">{{ $u->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label>Selling Unit :<span class="text-danger">*</span></label>
                                 <select name="selling_unit_id" id="selling_unit_id" class="select2">
                                    <option value="">-- Choose --</option>
                                    @foreach($unit as $u)
                                       <option value="{{ $u->id }}">{{ $u->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label>Need To Stock :<span class="text-danger">*</span></label>
                                 <select name="stockable" id="stockable" class="custom-select">
                                    <option value="">-- Choose --</option>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Small Stock :<span class="text-danger">*</span></label>
                                 <input type="number" name="small_stock" id="small_stock" class="form-control" placeholder="Enter small stock">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Min Stock :<span class="text-danger">*</span></label>
                                 <input type="number" name="min_stock" id="min_stock" class="form-control" placeholder="Enter min stock">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Max Stock :<span class="text-danger">*</span></label>
                                 <input type="number" name="max_stock" id="max_stock" class="form-control" placeholder="Enter max stock">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Conversion :<span class="text-danger">*</span></label>
                                 <input type="number" name="conversion" id="conversion" class="form-control" placeholder="Enter conversion">
                              </div>
                           </div>
                        </div>
                     </p>
                  </div>
                  <div class="tab-pane fade" id="highlighted-justified-tab4">
                     <p class="mt-4">
                        <div class="form-group">
                           <div class="input-group">
                           <div class="custom-file">
                              <input type="file" id="image" name="image" class="form-control" accept="image/x-png,image/jpg,image/jpeg" onchange="previewImage(this, '#preview_image')">
                           </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="text-center">
                              <a href="{{ asset('website/empty.jpg') }}" id="preview_image" data-lightbox="Image" data-title="Preview Image">
                                 <img src="{{ asset('website/empty.jpg') }}" class="img-fluid img-thumbnail w-100" style="max-width:500px;">
                              </a>
                              <p class="text-danger font-italic mt-3">
                                 Maximum file size is <b>500KB</b> & the only files supported are <b>jpeg, jpg, png</b>
                              </p>
                           </div>
                        </div>
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
                        <input type="radio" class="form-check-input-styled-success" name="status" value="1" checked data-fouc>
                        Active
                     </label>
                  </div>
               </div>
               <div class="form-group"><hr></div>
               <div class="form-group text-right">
                  <button type="reset" class="btn bg-danger btn-labeled btn-labeled-left">
                     <b><i class="icon-sync"></i></b> Reset Form
                  </button>
                  <button type="submit" class="btn bg-primary btn-labeled btn-labeled-left">
                     <b><i class="icon-plus3"></i></b> Submit
                  </button>
               </div>
            </form>
			</div>
		</div>
	</div>