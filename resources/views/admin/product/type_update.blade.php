<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Update Product Type</span>
				</h4>
			</div>
			<div class="header-elements">
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
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<a href="javascript:void(0);" class="breadcrumb-item">Product</a>
					<a href="{{ url('admin/product/type') }}" class="breadcrumb-item">Type</a>
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
            <form action="" method="POST" id="form_data" enctype="multipart/form-data">
               @csrf
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
                           <select name="category_id" id="category_id" class="select2" onchange="selectionField()">
                              <option value="">-- Choose --</option>
                              @foreach($category as $c)
                                 @php $sub_1 = App\Models\Category::where('parent_id', $c->id)->where('status', 1)->oldest('name')->get(); @endphp
                                 @if($sub_1->count() > 0)
                                    @foreach($sub_1 as $s1)
                                       @php $sub_2 = App\Models\Category::where('parent_id', $s1->id)->where('status', 1)->oldest('name')->get(); @endphp
                                       @if($sub_2->count() > 0)
                                          @foreach($sub_2 as $s2)
                                             <option value="{{ $s2->id }}" {{ $type->category_id == $s2->id ? 'selected' : '' }}>{{ $c->name }} &rarr; {{ $s1->name }} &rarr; {{ $s2->name }}</option>
                                          @endforeach
                                       @else
                                          <option value="{{ $s1->id }}" {{ $type->category_id == $s1->id ? 'selected' : '' }}>{{ $c->name }} &rarr; {{ $s1->name }}</option>
                                       @endif
                                    @endforeach
                                 @else
                                    <option value="{{ $c->id }}" {{ $type->category_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                 @endif
                              @endforeach
                           </select>
                        </div>
                        <div class="row">
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Code :<span class="text-danger">*</span></label>
                                 <input type="text" name="code" id="code" class="form-control" value="{{ $type->code }}" placeholder="Enter code">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Faces :</label>
                                 <input type="text" name="faces" id="faces" class="form-control" value="{{ $type->faces }}" placeholder="Enter faces">
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Division :<span class="text-danger">*</span></label>
                                 <select name="division_id" id="division_id" class="select2">
                                    <option value="">-- Choose --</option>
                                    @foreach($division as $d)
                                       <option value="{{ $d->id }}" {{ $type->division_id == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Surface :</label>
                                 <select name="surface_id" id="surface_id" class="select2">
                                    <option value="">-- Choose --</option>
                                    @foreach($surface as $s)
                                       <option value="{{ $s->id }}" {{ $type->surface_id == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
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
                                       <option value="{{ $c->id }}" {{ $type->color_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
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
                                       <option value="{{ $p->id }}" {{ $type->pattern_id == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
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
                                    <option value="1" {{ $type->material == 1 ? 'selected' : '' }}>High</option>
                                    <option value="2" {{ $type->material == 2 ? 'selected' : '' }}>Medium</option>
                                    <option value="3" {{ $type->material == 3 ? 'selected' : '' }}>Low</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Loading Limit :<span class="text-danger">*</span></label>
                                 <select name="specification_id" id="specification_id" class="select2">
                                    <option value="">-- Choose --</option>
                                    @foreach($specification as $s)
                                       <option value="{{ $s->id }}" {{ $type->specification_id == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Length :</label>
                                 <div class="input-group">
                                    <input type="number" name="length" id="length" class="form-control" value="{{ $type->length }}" placeholder="Enter length">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text">Cm</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Width :</label>
                                 <div class="input-group">
                                    <input type="number" name="width" id="width" class="form-control" value="{{ $type->width }}" placeholder="Enter width">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text">Cm</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Height :</label>
                                 <div class="input-group">
                                    <input type="number" name="height" id="height" class="form-control" value="{{ $type->height }}" placeholder="Enter height">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text">Cm</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Weight :<span class="text-danger">*</span></label>
                                 <div class="input-group">
                                    <input type="number" name="weight" id="weight" class="form-control" value="{{ $type->weight }}" placeholder="Enter weight">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text">Kg</span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <div class="form-group">
                                 <label>Thickness :</label>
                                 <div class="input-group">
                                    <input type="number" name="thickness" id="thickness" class="form-control" value="{{ $type->thickness }}" placeholder="Enter thickness">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text">mm</span>
                                    </div>
                                 </div>
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
                                 <select name="buy_unit_id" id="buy_unit_id" class="select2">
                                    <option value="">-- Choose --</option>
                                    @foreach($unit as $u)
                                       <option value="{{ $u->id }}" {{ $type->buy_unit_id == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
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
                                       <option value="{{ $u->id }}" {{ $type->stock_unit_id == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
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
                                       <option value="{{ $u->id }}" {{ $type->selling_unit_id == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-3">
                              <div class="form-group">
                                 <label>Need To Stock :<span class="text-danger">*</span></label>
                                 <select name="stockable" id="stockable" class="custom-select">
                                    <option value="">-- Choose --</option>
                                    <option value="1" {{ $type->stockable == true ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ $type->stockable == false ? 'selected' : '' }}>No</option>
                                 </select>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Small Stock :<span class="text-danger">*</span></label>
                                 <input type="number" name="small_stock" id="small_stock" class="form-control" value="{{ $type->small_stock }}" placeholder="Enter small stock">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Min Stock :<span class="text-danger">*</span></label>
                                 <input type="number" name="min_stock" id="min_stock" class="form-control" value="{{ $type->min_stock }}" placeholder="Enter min stock">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Max Stock :<span class="text-danger">*</span></label>
                                 <input type="number" name="max_stock" id="max_stock" class="form-control" value="{{ $type->max_stock }}" placeholder="Enter max stock">
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label>Conversion :<span class="text-danger">*</span></label>
                                 <input type="number" name="conversion" id="conversion" class="form-control" value="{{ $type->conversion }}" placeholder="Enter conversion">
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
                              @if(Storage::exists($type->image))
                                 <a href="{{ asset(Storage::url($type->image)) }}" id="preview_image" data-lightbox="{{ $type->code }}" data-title="{{ $type->code }}">
                                    <img src="{{ asset(Storage::url($type->image)) }}" class="img-fluid img-thumbnail w-100" style="max-width:200px;">
                                 </a>
                              @else
                                 <a href="{{ asset('website/empty.jpg') }}" id="preview_image" data-lightbox="{{ $type->code }}" data-title="{{ $type->code }}">
                                    <img src="{{ asset('website/empty.jpg') }}" class="img-fluid img-thumbnail w-100" style="max-width:200px;">
                                 </a>
                              @endif
                              <p class="text-danger font-italic mt-3">
                                 Maximum file size is <b>100KB</b> & the only files supported are <b>jpeg, jpg, png</b>
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
                        <input type="radio" class="form-check-input-styled-danger" name="status" value="2" {{ $type->status == 2 ? 'checked' : '' }} data-fouc>
                        Not Active
                     </label>
                  </div>
                  <div class="form-check form-check-inline">
                     <label class="form-check-label">
                        <input type="radio" class="form-check-input-styled-success" name="status" value="1" {{ $type->status != 2 ? 'checked' : '' }} data-fouc>
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

<script>
   $(function() {
      $('#btn_submit').click(function() {
         $('#btn_reset').attr('disabled', true);
         $('#btn_submit').attr('disabled', true);
         $('#btn_submit').html('<b><i class="icon-spinner4 spinner"></i></b> Processed ...');
         $('#form_data').submit();
      });

      selectionField();
   });

   function selectionField() {
      var category = $('#category_id option:selected').text();
      if(category.toLowerCase().indexOf('sanitary') >= 0) {
         $('#thickness').val(null);
         $('#thickness').attr('disabled', true);
         $('#height').attr('disabled', false);
      } else if(category.toLowerCase().indexOf('tile') >= 0) {
         $('#height').val(null);
         $('#height').attr('disabled', true);
         $('#thickness').attr('disabled', false);
      }
   }
</script>