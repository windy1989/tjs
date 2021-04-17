<section id="content">
   <div class="content-wrap">
      <div class="container clearfix">
         <div class="row gutter-40 col-mb-80">
            <div class="postcontent col-lg-9 order-lg-last">
               @if($product->count() > 0)
                  <div id="shop" class="shop row grid-container gutter-20" data-layout="fitRows">
                     <div class="col-lg-12 mb-0">
                        <div class="bg-light p-2">
                           <form class="form-inline mb-0">
                              <div class="form-group mr-2">
                                 <a href="#" class="button button-small button-rounded button-reveal button-dark">Default</a>
                              </div>
                              <div class="form-group mr-3">
                                 <a href="#" class="button button-small button-rounded button-reveal button-white button-light">Newest</a>
                              </div>
                              <div class="form-group mr-3">
                                 <select name="price" id="price" class="form-control">
                                    <option value="">Availability</option>
                                    <option value="ready">Ready</option>
                                    <option value="limited">Limited</option>
                                    <option value="indent">Indent</option>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <select name="price" id="price" class="form-control">
                                    <option value="">Price</option>
                                    <option value="low_to_high">Low To High</option>
                                    <option value="high_to_low">Low To High</option>
                                 </select>
                              </div>
                           </form>
                        </div>
                     </div>
                     @foreach($product as $p)
                        <div class="product col-md-4 mb-4 col-sm-6 col-12">
                           <div class="grid-inner border">
                              <div class="product-image">
                                 <a href="{{ url('product/detail/' . base64_encode($p->id)) }}">
                                    <img src="{{ Storage::exists($p->type->image) ? asset(Storage::url($p->type->image)) : asset('website/empty.jpg') }}" style="max-height:253px;" alt="{{ $p->code() }}">
                                 </a>
                                 <div class="sale-flash badge {{ $p->availability()->color }} p-2">{{ $p->availability()->status }}</div>
                              </div>
                              <div class="product-desc p-3 text-center">
                                 <div class="product-title">
                                    <h4 class="mb-0 font-weight-normal" style="font-size:15px; max-height:20px; overflow:hidden;">
                                       <a href="{{ url('product/detail/' . base64_encode($p->id)) }}">{{ $p->code() }}</a>
                                    </h4>
                                 </div>
                                 <div class="product-price">
                                    <ins style="font-size:15px;">Rp {{ number_format($p->price(), 0, ',', '.') }}</ins>
                                 </div>
                                 <div class="product-rating text-muted">
                                    {{ $p->brand->name }}
                                 </div>
                              </div>
                           </div>
                        </div>
                     @endforeach
                  </div>
                  {{ $product->withQueryString()->onEachSide(2)->links('pagination') }}
               @else
                  <center>
                     <h2 class="text-uppercase">Data Not Found</h2>
                     <img src="{{ asset('website/data-empty.png') }}" style="max-width:80%;" class="img-fluid">
                     <p class="mt-2 text-muted">
                        Looks like the product you're looking for doesn't exist or maybe you forgot to clear the search bar!
                     </p>
                  </center>
               @endif
            </div>
            <div class="sidebar col-lg-3">
               <div class="sidebar-widgets-wrap">
                  <form method="GET" action="{{ url('product') }}">
                     <div class="mb-5 clearfix">
                        <h4 class="mb-3 text-uppercase" style="font-size:18px;">Category</h4>
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
                                                <label class="form-check-label font-weight-normal" for="{{ $s2->slug }}">{{ $s2->name }}</label>
                                             </div>
                                          </li>
                                       @endforeach
                                    @else
                                       <li>
                                          <div class="form-check">
                                             <input type="checkbox" class="form-check-input" name="category[]" id="{{ $s1->slug }}" value="{{ $s1->slug }}" onchange="clickFilter(this)" {{ in_array($s1->slug, $filter['category']) ? 'checked' : '' }}>
                                             <label class="form-check-label font-weight-normal" for="{{ $s1->slug }}">{{ $s1->name }}</label>
                                          </div>
                                       </li>
                                    @endif
                                 @endforeach
                              @else
                                 <li>
                                    <div class="form-check">
                                       <input type="checkbox" class="form-check-input" name="category[]" id="{{ $c->slug }}" value="{{ $c->slug }}" onchange="clickFilter(this)" {{ in_array($c->slug, $filter['category']) ? 'checked' : '' }}>
                                       <label class="form-check-label font-weight-normal" for="{{ $c->slug }}">{{ $c->name }}</label>
                                    </div>
                                 </li>
                              @endif
                           @endforeach
                        </ul>
                     </div>
                     <div class="mb-5 clearfix">
                        <h4 class="mb-3 text-uppercase" style="font-size:18px;">Brand</h4>
                        <ul class="sidebar-filter-product">
                           @foreach($brand as $b)
                              <li>
                                 <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="brand[]" id="{{ $b->code }}" value="{{ $b->code }}" onchange="clickFilter(this)" {{ in_array($b->code, $filter['brand']) ? 'checked' : '' }}>
                                    <label class="form-check-label font-weight-normal" for="{{ $b->code }}">{{ $b->name }}</label>
                                 </div>
                              </li>
                           @endforeach
                        </ul>
                     </div>
                     <div class="mb-5 clearfix">
                        <h4 class="mb-3 text-uppercase" style="font-size:18px;">Color</h4>
                        <ul class="sidebar-filter-product">
                           @foreach($color as $c)
                              <li>
                                 <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="color[]" id="{{ $c->code }}" value="{{ $c->code }}" onchange="clickFilter(this)" {{ in_array($c->code, $filter['color']) ? 'checked' : '' }}>
                                    <label class="form-check-label font-weight-normal" for="{{ $c->code }}">{{ $c->name }}</label>
                                 </div>
                              </li>
                           @endforeach
                        </ul>
                     </div>
                     <div class="clearfix">
                        <h4 class="mb-3 text-uppercase" style="font-size:18px;">Pattern</h4>
                        <ul class="sidebar-filter-product">
                           @foreach($pattern as $p)
                              <li>
                                 <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="pattern[]" id="{{ $p->code }}" value="{{ $p->code }}" onchange="clickFilter(this)" {{ in_array($p->code, $filter['pattern']) ? 'checked' : '' }}>
                                    <label class="form-check-label font-weight-normal" for="{{ $p->code }}">{{ $p->name }}</label>
                                 </div>
                              </li>
                           @endforeach
                        </ul>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<script>
   function clickFilter(event) {
      loadingOpen('body');
      $(event).parents('form').submit();
   }
</script>