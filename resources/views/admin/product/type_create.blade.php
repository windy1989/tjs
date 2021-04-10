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
            <form action="" method="POST" enctype="multipart/form-data">
               <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                  <li class="nav-item">
                     <a href="#highlighted-justified-tab1" class="nav-link active" data-toggle="tab">Meta Data</a>
                  </li>
                  <li class="nav-item">
                     <a href="#highlighted-justified-tab2" class="nav-link" data-toggle="tab">Specification</a>
                  </li>
                  <li class="nav-item">
                     <a href="#highlighted-justified-tab3" class="nav-link" data-toggle="tab">Stock</a>
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
                                 @php $sub_1 = App\Models\Category::where('parent_id', $c->id)->where('status', 1)->get();
                                       
                                    if($sub_1->count() > 0) {
                                       foreach($sub_1 as $s1) {
                                          $sub_2 = App\Models\Category::where('parent_id', $c->id)->where('status', 1)->get();

                                          if($sub_2->count() > 0) {

                                          } else {

                                          }
                                       }
                                    }
                                 @endphp
                                 @if($sub_1->count() > 0)
                                    @foreach($sub_1 as $s1)
                                       @php $sub_2 = App\Models\Category::where('parent_id', $c->id)->where('status', 1)->get(); @endphp
                                       @if($sub_2->count() > 0)
                                          @foreach($sub_2 as $s2)
                                             <option value="{{ $s2->id }}">{{ $c->name }} &rarr; {{ $s1->name }}</option>
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
                     </p>
                  </div>
                  <div class="tab-pane fade" id="highlighted-justified-tab2">
                     Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid laeggin.
                  </div>
                  <div class="tab-pane fade" id="highlighted-justified-tab3">
                     DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg whatever.
                  </div>
               </div>
            </form>
			</div>
		</div>
	</div>