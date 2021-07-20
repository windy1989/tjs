<section id="page-title" class="page-title-mini">
   <div class="container clearfix">
      <h1>Product</h1>
      <ol class="breadcrumb font-size-12">
         <li class="breadcrumb-item">
            <a href="{{ url('/') }}">Home</a>
         </li>
         <li class="breadcrumb-item active" aria-current="page">
            Product
         </li>
      </ol>
   </div>
</section>
<section id="content">
   <div class="content-wrap p-0 mt-4">
      <div class="container clearfix">
         <form method="GET" class="mt-0" action="{{ url('product') }}">
            <div class="row gutter-50 justify-content-center col-mb-80">
               <div class="postcontent col-lg-9 order-lg-last">
                  <div class="row mb-3">
                     <div class="col-md-4 d-none d-xl-block">
                        <div class="form-group row no-gutters">
                           <label class="col-3 col-form-label font-size-13" style="text-transform: capitalize;">Show</label>
                           <div class="col-9">
                              <select name="show" id="show" class="custom-select no-outline font-size-13" style="border-radius:0;" onchange="clickFilter(this)">
                                 <option value="">12</option>
                                 <option value="24" {{ $filter['other']['show'] == 24 ? 'selected' : '' }}>24</option>
                                 <option value="48" {{ $filter['other']['show'] == 48 ? 'selected' : '' }}>48</option>
                                 <option value="60" {{ $filter['other']['show'] == 60 ? 'selected' : '' }}>60</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 d-none d-xl-block">
                        <div class="form-group row no-gutters">
                           <label class="col-3 col-form-label font-size-13" style="text-transform: capitalize;">Stock</label>
                           <div class="col-9">
                              <select name="stock" id="stock" class="custom-select no-outline font-size-13" style="border-radius:0;" onchange="clickFilter(this)">
                                 <option value="">All</option>
                                 <option value="ready" {{ $filter['other']['stock'] == 'ready' ? 'selected' : '' }}>Ready</option>
                                 <option value="limited" {{ $filter['other']['stock'] == 'limited' ? 'selected' : '' }}>Limited</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 d-none d-xl-block">
                        <div class="form-group row no-gutters">
                           <label class="col-3 col-form-label font-size-13" style="text-transform: capitalize;">Sort</label>
                           <div class="col-9">
                              <select name="sort" id="sort" class="custom-select no-outline font-size-13" style="border-radius:0;" onchange="clickFilter(this)">
                                 <option value="">Normal</option>
                                 <option value="latest" {{ $filter['other']['sort'] == 'latest' ? 'selected' : '' }}>Latest</option>
                                 <option value="low_to_high" {{ $filter['other']['sort'] == 'low_to_high' ? 'selected' : '' }}>Low To High</option>
                                 <option value="high_to_low" {{ $filter['other']['sort'] == 'high_to_low' ? 'selected' : '' }}>High To Low</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="col-12 d-xl-none">
                        <button type="button" id="side-panel-filter-trigger" class="button button-small bg-teal col-12 font-size-14 mb-2"><i class="icon-list"></i> Filter</button>
                     </div>
                     <div class="col-12 text-center">
                        @if($filter['other']['search'])
                           <div>Search For : <strong>{{ $filter['other']['search'] }}</strong></div>
                        @endif
                        <div class="badge bg-danger text-white font-weight-normal p-1">{{ $product->total() }} records found</div>
                     </div>
                  </div>
                  <div class="form-group"><hr></div>
                  @if($product->count() > 0)
                     <div id="shop" class="shop row grid-container gutter-30">
                        @foreach($product as $p)
                           <div class="product col-lg-3 col-md-4 col-6 mb-4">
                              <div class="grid-inner border">
                                 <div class="bg-light">
                                    <div class="p-2 font-weight-bold text-center" style="font-size:13px;">
                                       {{ $p->type->category->name }}
                                    </div>
                                 </div>
                                 <div class="product-image">
                                    <a href="{{ url('product/detail/' . base64_encode($p->id)) }}">
                                       <img src="{{ $p->type->image() }}" alt="{{ $p->code() }}" class="img-fluid product-thumbnail">
                                    </a>
                                    <div class="sale-flash badge {{ $p->availability()->color }} p-2">{{ $p->availability()->status }}</div>
                                 </div>
                                 <div class="product-desc p-3">
                                    <div class="product-price font-weight-bold">
                                       <ins class="text-dark">
                                          <h1 style="font-size:17px;" class="mb-0 font-weight-bold">Rp {{ number_format($p->price(), 0, ',', '.') }}</h1>
                                       </ins>
                                    </div>
                                    <div class="product-title">
                                       <h4 class="mb-0 font-weight-normal limit-text-list-product">
                                          <a href="{{ url('product/detail/' . base64_encode($p->id)) }}" class="font-wight-semibold text-danger" style="font-size:13.5px;">{{ $p->code() }}</a>
                                       </h4>
                                    </div>
                                    <div class="product-price font-weight-semibold">
                                       <span>
                                          <span class="text-warning">{{ $p->brand->name }}</span> | <span class="text-info">{{ $p->type->length }}x{{ $p->type->width }}</span>
                                       </span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        @endforeach
                     </div>
                  @else
                     <center class="mt-5">
                        <img src="{{ asset('website/data-empty.png') }}" style="max-width:80%;" class="img-fluid" alt="Empty">
                     </center>
                  @endif
                  {{ $product->withQueryString()->onEachSide(1)->links('pagination') }}
               </div>
               <div class="sidebar col-lg-3 d-none d-xl-block">
                  <div class="sidebar-widgets-wrap">
                     <div class="clearfix">
                        <input type="text" class="form-control no-outline font-size-12" name="search" id="search" value="{{ $filter['other']['search'] ? $filter['other']['search'] : '' }}" placeholder="Find ...">
                        <button type="submit" onclick="clickFilter(this)" class="button button-small button-3d bg-teal col-12 mt-2 font-size-11 m-0">Search</button>
                        <a href="{{ url('product') }}" class="button button-small button-3d button-red text-center col-12 mt-2 font-size-11 m-0">Reset</a>
                     </div>
                     <div class="form-group"><hr></div>
                     <div class="mb-5 clearfix">
                        <h4 class="mb-3 text-uppercase" style="font-size:15px;">Category</h4>
                        <ul class="sidebar-filter-product">
                           @foreach($category as $c)
                              @php
                                 $sub_1 = App\Models\Category::where('parent_id', $c->id)
                                    ->where('status', 1)
                                    ->oldest('name')
                                    ->get();
                              @endphp
                              @if($sub_1->count() > 0)
                                 @foreach($sub_1 as $s1)
                                    @php
                                       $sub_2 = App\Models\Category::where('parent_id', $s1->id)
                                          ->where('status', 1)
                                          ->oldest('name')
                                          ->get();
                                    @endphp
                                    @if($sub_2->count() > 0)
                                       @foreach($sub_2 as $s2)
                                          <li>
                                             <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="category[]" id="{{ $s2->slug }}" value="{{ $s2->slug }}" onchange="clickFilter(this)" {{ in_array($s2->slug, $filter['category']) ? 'checked' : '' }}>
                                                <label class="form-check-label font-weight-normal font-size-11" for="{{ $s2->slug }}">{{ $s2->name }}</label>
                                             </div>
                                          </li>
                                       @endforeach
                                    @else
                                       <li>
                                          <div class="form-check">
                                             <input type="checkbox" class="form-check-input" name="category[]" id="{{ $s1->slug }}" value="{{ $s1->slug }}" onchange="clickFilter(this)" {{ in_array($s1->slug, $filter['category']) ? 'checked' : '' }}>
                                             <label class="form-check-label font-weight-normal font-size-11" for="{{ $s1->slug }}">{{ $s1->name }}</label>
                                          </div>
                                       </li>
                                    @endif
                                 @endforeach
                              @else
                                 <li>
                                    <div class="form-check">
                                       <input type="checkbox" class="form-check-input" name="category[]" id="{{ $c->slug }}" value="{{ $c->slug }}" onchange="clickFilter(this)" {{ in_array($c->slug, $filter['category']) ? 'checked' : '' }}>
                                       <label class="form-check-label font-weight-normal font-size-11" for="{{ $c->slug }}">{{ $c->name }}</label>
                                    </div>
                                 </li>
                              @endif
                           @endforeach
                        </ul>
                     </div>
                     <div class="mb-5 clearfix">
                        <h4 class="mb-3 text-uppercase" style="font-size:15px;">Brand</h4>
                        <ul class="sidebar-filter-product">
                           @foreach($brand as $b)
                              <li>
                                 <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="brand[]" id="{{ $b->code }}" value="{{ $b->code }}" onchange="clickFilter(this)" {{ in_array($b->code, $filter['brand']) ? 'checked' : '' }}>
                                    <label class="form-check-label font-weight-normal font-size-11" for="{{ $b->code }}">{{ $b->name }}</label>
                                 </div>
                              </li>
                           @endforeach
                        </ul>
                     </div>
                     <div class="mb-5 clearfix">
                        <h4 class="mb-3 text-uppercase" style="font-size:15px;">Size</h4>
                        <ul class="sidebar-filter-product">
                           @foreach($size as $s)
                              <li>
                                 <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="size[]" id="{{ $s->length }}x{{ $s->width }}" value="{{ $s->length }}x{{ $s->width }}" onchange="clickFilter(this)" {{ in_array($s->length . 'x' . $s->width, $filter['size']) ? 'checked' : '' }}>
                                    <label class="form-check-label font-weight-normal font-size-11" for="{{ $s->length }}x{{ $s->width }}">{{ $s->length }}x{{ $s->width }}</label>
                                 </div>
                              </li>
                           @endforeach
                        </ul>
                     </div>
                     <div class="mb-5 clearfix">
                        <h4 class="mb-3 text-uppercase" style="font-size:15px;">Color</h4>
                        <ul class="sidebar-filter-product">
                           @foreach($color as $c)
                              <li>
                                 <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="color[]" id="{{ $c->code }}" value="{{ $c->code }}" onchange="clickFilter(this)" {{ in_array($c->code, $filter['color']) ? 'checked' : '' }}>
                                    <label class="form-check-label font-weight-normal font-size-11" for="{{ $c->code }}">{{ $c->name }}</label>
                                 </div>
                              </li>
                           @endforeach
                        </ul>
                     </div>
                     <div class="clearfix">
                        <h4 class="mb-3 text-uppercase" style="font-size:15px;">Pattern</h4>
                        <ul class="sidebar-filter-product">
                           @foreach($pattern as $p)
                              <li>
                                 <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="pattern[]" id="{{ $p->code }}" value="{{ $p->code }}" onchange="clickFilter(this)" {{ in_array($p->code, $filter['pattern']) ? 'checked' : '' }}>
                                    <label class="form-check-label font-weight-normal font-size-11" for="{{ $p->code }}">{{ $p->name }}</label>
                                 </div>
                              </li>
                           @endforeach
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</section>

<div id="side-panel" class="dark side-panel-filter d-xl-none d-xl-block">
   <div class="side-panel-wrap">
      <div class="widget clearfix">
         <h4 class="mb-4">Filter</h4>
         <div class="sidebar">
            <div class="sidebar-widgets-wrap">
               <form method="GET" class="mt-0" action="{{ url('product') }}">
                  <div class="clearfix">
                     <input type="text" class="form-control no-outline font-size-12" name="search" id="search" value="{{ $filter['other']['search'] ? $filter['other']['search'] : '' }}" placeholder="Search ...">
                  </div>
                  <div class="form-group"><hr></div>
                  <div class="mb-5 clearfix">
                     <h4 class="mb-3 text-uppercase" style="font-size:15px;">Category</h4>
                     <ul class="sidebar-filter-product">
                        @foreach($category as $c)
                           @php
                              $sub_1 = App\Models\Category::where('parent_id', $c->id)
                                 ->where('status', 1)
                                 ->oldest('name')
                                 ->get();
                           @endphp
                           @if($sub_1->count() > 0)
                              @foreach($sub_1 as $s1)
                                 @php
                                    $sub_2 = App\Models\Category::where('parent_id', $s1->id)
                                       ->where('status', 1)
                                       ->oldest('name')
                                       ->get();
                                 @endphp
                                 @if($sub_2->count() > 0)
                                    @foreach($sub_2 as $s2)
                                       <li>
                                          <div class="form-check">
                                             <input type="checkbox" class="form-check-input" name="category[]" id="panel-{{ $s2->slug }}" value="{{ $s2->slug }}" {{ in_array($s2->slug, $filter['category']) ? 'checked' : '' }}>
                                             <label class="form-check-label font-weight-normal font-size-11" style="font-size:10px !important; color:white !important;" for="panel-{{ $s2->slug }}">{{ $s2->name }}</label>
                                          </div>
                                       </li>
                                    @endforeach
                                 @else
                                    <li>
                                       <div class="form-check">
                                          <input type="checkbox" class="form-check-input" name="category[]" id="panel-{{ $s1->slug }}" value="{{ $s1->slug }}" {{ in_array($s1->slug, $filter['category']) ? 'checked' : '' }}>
                                          <label class="form-check-label font-weight-normal text-white font-size-11" style="font-size:10px !important; color:white !important;" for="panel-{{ $s1->slug }}">{{ $s1->name }}</label>
                                       </div>
                                    </li>
                                 @endif
                              @endforeach
                           @else
                              <li>
                                 <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="category[]" id="panel-{{ $c->slug }}" value="{{ $c->slug }}" {{ in_array($c->slug, $filter['category']) ? 'checked' : '' }}>
                                    <label class="form-check-label font-weight-normal text-white font-size-11" style="font-size:10px !important; color:white !important;" for="panel-{{ $c->slug }}">{{ $c->name }}</label>
                                 </div>
                              </li>
                           @endif
                        @endforeach
                     </ul>
                  </div>
                  <div class="mb-5 clearfix">
                     <h4 class="mb-3 text-uppercase" style="font-size:15px;">Brand</h4>
                     <ul class="sidebar-filter-product">
                        @foreach($brand as $b)
                           <li>
                              <div class="form-check">
                                 <input type="checkbox" class="form-check-input" name="brand[]" id="panel-{{ $b->code }}" value="{{ $b->code }}" {{ in_array($b->code, $filter['brand']) ? 'checked' : '' }}>
                                 <label class="form-check-label font-weight-normal text-white font-size-11" style="font-size:10px !important; color:white !important;" for="panel-{{ $b->code }}">{{ $b->name }}</label>
                              </div>
                           </li>
                        @endforeach
                     </ul>
                  </div>
                  <div class="mb-5 clearfix">
                     <h4 class="mb-3 text-uppercase" style="font-size:15px;">Size</h4>
                     <ul class="sidebar-filter-product">
                        @foreach($size as $s)
                           <li>
                              <div class="form-check">
                                 <input type="checkbox" class="form-check-input" name="size[]" id="panel-{{ $s->length }}x{{ $s->width }}" value="{{ $s->length }}x{{ $s->width }}" {{ in_array($s->length . 'x' . $s->width, $filter['size']) ? 'checked' : '' }}>
                                 <label class="form-check-label font-weight-normal text-white font-size-11" style="font-size:10px !important; color:white !important;" for="panel-{{ $s->length }}x{{ $s->width }}">{{ $s->length }}x{{ $s->width }}</label>
                              </div>
                           </li>
                        @endforeach
                     </ul>
                  </div>
                  <div class="mb-5 clearfix">
                     <h4 class="mb-3 text-uppercase" style="font-size:15px;">Color</h4>
                     <ul class="sidebar-filter-product">
                        @foreach($color as $c)
                           <li>
                              <div class="form-check">
                                 <input type="checkbox" class="form-check-input" name="color[]" id="panel-{{ $c->code }}" value="{{ $c->code }}" {{ in_array($c->code, $filter['color']) ? 'checked' : '' }}>
                                 <label class="form-check-label font-weight-normal text-white font-size-11" style="font-size:10px !important; color:white !important;" for="panel-{{ $c->code }}">{{ $c->name }}</label>
                              </div>
                           </li>
                        @endforeach
                     </ul>
                  </div>
                  <div class="mb-5 clearfix">
                     <h4 class="mb-3 text-uppercase" style="font-size:15px;">Pattern</h4>
                     <ul class="sidebar-filter-product">
                        @foreach($pattern as $p)
                           <li>
                              <div class="form-check">
                                 <input type="checkbox" class="form-check-input" name="pattern[]" id="panel-{{ $p->code }}" value="{{ $p->code }}" {{ in_array($p->code, $filter['pattern']) ? 'checked' : '' }}>
                                 <label class="form-check-label font-weight-normal text-white font-size-11" style="font-size:10px !important; color:white !important;" for="panel-{{ $p->code }}">{{ $p->name }}</label>
                              </div>
                           </li>
                        @endforeach
                     </ul>
                  </div>
                  <div class="clearfix">
                     <button type="submit" class="button button-3d button-mini bg-teal col-12 font-size-11">Filter</button>
                     <a href="{{ url('product') }}" class="button button-3d button-mini button-red text-center col-12 font-size-11">Reset</a>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<script>
   $(function() {
      $('.side-panel-filter').slideReveal({
         trigger: $('#side-panel-filter-trigger'),
         push: false,
         overlay: true,
         width: '300px',
         position: 'left'
      });
   });

   function clickFilter(event) {
      loadingOpen('body');
      $(event).parents('form').submit();
   }
</script>