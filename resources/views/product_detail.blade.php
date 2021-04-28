<section id="page-title">
   <div class="container clearfix">
      <h1 class="text-center">{{ $product->code() }}</h1>
   </div>
</section>
<section id="content">
   <div class="content-wrap">
      <div class="container clearfix">
         <div class="single-product">
            <div class="product">
               <div class="row gutter-40">
                  <div class="col-md-6">
                     <div class="product-image">
                        <div class="fslider" data-pagi="false" data-arrows="false" data-thumbs="true">
                           <div class="flexslider">
                              <div class="slider-wrap" data-lightbox="gallery">
                                 <div class="slide" data-thumb="{{ Storage::exists($product->type->image) ? asset(Storage::url($product->type->image)) : asset('website/empty.jpg') }}">
                                    <a href="{{ Storage::exists($product->type->image) ? asset(Storage::url($product->type->image)) : asset('website/empty.jpg') }}" title="{{ $product->code() }}" data-lightbox="gallery-item"><img src="{{ Storage::exists($product->type->image) ? asset(Storage::url($product->type->image)) : asset('website/empty.jpg') }}" alt="{{ $product->code() }}" class="img-fluid"></a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="sale-flash badge {{ $product->availability()->color }} p-2">{{ $product->availability()->status }}</div>
                     </div>
                  </div>
                  <div class="col-md-6 product-desc">
                     <div class="d-flex align-items-center justify-content-between">
                        <div class="product-price">
                           Rp <ins>{{ number_format($product->price(), 0, ',', '.') }}</ins>
                        </div>
                        <div class="d-flex align-items-center justify-content-end">
                           Availability&nbsp;&nbsp;<strong>{{ $product->availability()->stock }}</strong>
                        </div>
                     </div>
                     <div class="line"></div>
                     <form method="POST" action="{{ url('product/add_to_cart') }}" class="cart mb-0 d-flex justify-content-between align-items-center" method="POST">
                        @csrf
                        <div class="quantity clearfix">
                           <input type="hidden" name="product_id" value="{{ base64_encode($product->id) }}">
                           <input type="button" value="-" class="minus">
                           <input type="number" step="1" min="1" name="qty" id="qty" onchange="checkStock()" value="1" title="Quantity" class="qty">
                           <input type="button" value="+" class="plus">
                        </div>
                        <a href="javascript:void(0);" id="notif_indent" data-toggle="modal" data-target="#detail_stock" class="text-primary font-italic">More Detail</a>
                        <button type="submit" class="button button-green m-0">Add to cart</button>
                     </form>
                     <div class="line"></div>
                     <form method="POST" action="{{ url('product/add_to_wishlist') }}" class="cart mb-0 d-flex justify-content-between align-items-center">
                        @csrf
                        <div class="quantity clearfix">
                           <input type="hidden" name="product_id" value="{{ base64_encode($product->id) }}">
                           <input type="text" value="Add To Wishlist" class="form-control-plaintext" disabled>
                        </div>
                        @if(count($product->wishlist) > 0)
                           @if(count($product->wishlist->where('customer_id', session('fo_id'))) > 0)
                              <a href="javascript:void(0);" class="button button-red m-0 cursor-none"><i class="icon-heart21"></i></a>
                           @endif
                        @else
                           <button type="submit" class="button button-teal m-0"><i class="icon-heart21"></i></button>
                        @endif
                     </form>
                     <div class="line"></div>
                     <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                           @if($product->availability()->status == 'Ready')
                              <div class="style-msg successmsg w-100 text-center">
                                 <div class="sb-msg">
                                    <i class="icon-ok-circle"></i>
                                    <strong>Ready Stock!</strong> Buy now
                                 </div>
                              </div>
                           @elseif($product->availability()->status == 'Limited')
                              <div class="style-msg alertmsg w-100 text-center">
                                 <div class="sb-msg">
                                    <i class="icon-warning-sign"></i>
                                    <strong>Stock Limited!</strong> Buy now before it runs out
                                 </div>
                              </div>
                           @elseif($product->availability()->status == 'Indent')
                              <div class="style-msg infomsg w-100 text-center">
                                 <div class="sb-msg">
                                    <i class="icon-ban-circle"></i>
                                    <strong>Stock Indent!</strong> You can enter the favorites first
                                 </div>
                              </div>
                           @else
                              <div class="style-msg errormsg w-100 text-center">
                                 <div class="sb-msg">
                                    <i class="icon-remove-sign"></i>
                                    <strong>Stock Empty!</strong> Sorry our stock is empty
                                 </div>
                              </div>
                           @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                           <span class="text-muted">Category:</span>
                           <span class="text-dark font-weight-semibold">{{ $product->type->category->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                           <span class="text-muted">Color:</span>
                           <span class="text-dark font-weight-semibold">{{ $product->type->color->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                           <span class="text-muted">Pattern:</span>
                           <span class="text-dark font-weight-semibold">{{ $product->type->pattern->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                           <span class="text-muted">Brand:</span>
                           <span class="text-dark font-weight-semibold">{{ $product->brand->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                           <span class="text-muted">Grade:</span>
                           <span class="text-dark font-weight-semibold">{{ $product->grade->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                           <span class="text-muted">Country:</span>
                           <span class="text-dark font-weight-semibold">{{ $product->country->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-center align-items-center px-0">
                           <div class="addthis_inline_share_toolbox_ykjh"></div>
                        </li>
                     </ul>
                  </div>
                  <div class="w-100"></div>
                  <div class="col-12 mt-5">
                     <div class="tabs clearfix mb-0" id="tab-1">
                        <ul class="tab-nav clearfix">
                           <li>
                              <a href="#tabs-1">
                                 <i class="icon-align-justify2"></i> Description
                              </a>
                           </li>
                           <li>
                              <a href="#tabs-2">
                                 <i class="icon-settings"></i> Specification
                              </a>
                           </li>
                        </ul>
                        <div class="tab-container">
                           <div class="tab-content clearfix" id="tabs-1">
                              <p>{!! $product->description !!}</p>
                           </div>
                           <div class="tab-content clearfix" id="tabs-2">
                              <table class="table table-striped table-bordered">
                                 <tbody>
                                    <tr>
                                       <td>Surface</td>
                                       <td>{{ $product->type->surface->name }}</td>
                                    </tr>
                                    <tr>
                                       <td>Color</td>
                                       <td>{{ $product->type->color->name }}</td>
                                    </tr>
                                    <tr>
                                       <td>Pattern</td>
                                       <td>{{ $product->type->pattern->name }}</td>
                                    </tr>
                                    <tr>
                                       <td>Loading Limit</td>
                                       <td>{{ $product->type->specification->name }}</td>
                                    </tr>
                                    <tr>
                                       <td>Material</td>
                                       <td>{{ $product->type->material() }}</td>
                                    </tr>
                                    <tr>
                                       <td>Length</td>
                                       <td>{{ $product->type->length }} Cm</td>
                                    </tr>
                                    <tr>
                                       <td>Width</td>
                                       <td>{{ $product->type->width }} Cm</td>
                                    </tr>
                                    <tr>
                                       <td>Height</td>
                                       <td>{{ $product->type->height }} Cm</td>
                                    </tr>
                                    <tr>
                                       <td>Weight</td>
                                       <td>{{ $product->type->weight }} Kg</td>
                                    </tr>
                                    <tr>
                                       <td>Grade</td>
                                       <td>{{ $product->grade->name }}</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="line"></div>
         <div class="w-100">
            <h4>Related Product</h4>
            <div class="owl-carousel product-carousel carousel-widget" data-margin="30" data-pagi="false" data-autoplay="5000" data-items-xs="1" data-items-md="2" data-items-lg="3" data-items-xl="4">
               @foreach($related_product as $rp)
                  <div class="oc-item">
                     <div class="product border">
                        <div class="product-image">
                          <a href="{{ url('product/detail/' . base64_encode($rp->id)) }}">
                              <img src="{{ Storage::exists($rp->type->image) ? asset(Storage::url($rp->type->image)) : asset('website/empty.jpg') }}" alt="{{ $rp->code() }}" class="img-fluid">
                           </a>
                           <div class="sale-flash badge {{ $rp->availability()->color }} p-2">{{ $rp->availability()->status }}</div>
                        </div>
                        <div class="product-desc p-3 text-center">
                           <div class="product-title">
                              <h4 class="mb-0 font-weight-normal limit-text-list-product">
                                 <a href="{{ url('product/detail/' . base64_encode($rp->id)) }}" style="font-weight:500;">{{ $rp->code() }}</a>
                              </h4>
                           </div>
                           <div class="product-price text-info font-weight-bold">
                              <span>{{ $rp->type->length }}x{{ $rp->type->width }}</span>
                           </div>
                           <div class="product-price font-weight-bold">
                              <ins style="font-size:15px;" class="text-danger">Rp {{ number_format($rp->price(), 0, ',', '.') }}</ins>
                           </div>
                           <div class="product-rating font-weight-bold" style="color:orange;">
                              {{ $rp->brand->name }}
                           </div>
                        </div>
                     </div>
                  </div>
               @endforeach
            </div>
         </div>
      </div>
   </div>
</section>

<div class="modal fade" id="detail_stock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">DETAIL STOCK</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="table-responsive">
               <table class="table table-bordered table-hover table-striped">
                  <thead class="alert-info">
                     <tr class="text-center">
                        <th>Shading</th>
                        <th>Initial Stock</th>
                        <th>Last Stock</th>
                     </tr>
                  </thead>
                  <tbody id="data_shading"></tbody>
                  <tfoot>
                     <tr>
                        <th colspan="2" class="text-right">Total Request</th>
                        <th id="total_request_stock">0</th>
                     </tr>
                     <tr>
                        <th colspan="2" class="text-right">Total Stock</th>
                        <th id="total_stock">0</th>
                     </tr>
                     <tr>
                        <th colspan="2" class="text-right">Total Ready</th>
                        <th id="total_ready_stock">0</th>
                     </tr>
                     <tr>
                        <th colspan="2" class="text-right">Total Indent</th>
                        <th id="total_indent_stock">0</th>
                     </tr>
                  </tfoot>
               </table>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<script>
   $(function() {
      checkStock();
   });

   function checkStock() {
      $.ajax({
         url: '{{ url("product/check_stock") }}',
         type: 'POST',
         dataType: 'JSON',
         data: {
            product_id: '{{ base64_encode($product->id) }}',
            qty: $('#qty').val()
         },
         beforeSend: function() {
            $('#data_shading').html('');
            $('#total_stock').html(0);
            $('#total_ready_stock').html(0);
            $('#total_indent_stock').html(0);
            $('#total_request_stock').html(0);
         },
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function(response) {
            $('#total_stock').html(response.total_stock);
            $('#total_ready_stock').html(response.total_ready);
            $('#total_indent_stock').html(response.total_indent);
            $('#total_request_stock').html(response.total_request);
            
            if(response.data_shading.length > 0) {
               $.each(response.data_shading, function(i, val) {
                  $('#data_shading').append(`
                     <tr class="text-center">
                        <td>` + val.shading + `</td>
                        <td>` + val.initial_stock + `</td>
                        <td>` + val.last_stock + `</td>
                     </tr>
                  `);
               });
            } else {
               $('#data_shading').html('<tr><td colspan="3" class="text-center">Data empty</td></tr>');
            }
         }
      });
   }
</script>