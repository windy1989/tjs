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
                  <div class="col-lg-6 col-md-12">
                     <div class="product-image">
                        <div class="fslider" data-pagi="false" data-arrows="false" data-thumbs="true">
                           <div class="flexslider">
                              <div class="slider-wrap" data-lightbox="gallery">
                                 <div class="slide" data-thumb="{{ $product->type->image() }}">
                                    <a href="{{ $product->type->image() }}" title="{{ $product->code() }}" data-lightbox="gallery-item"><img src="{{ $product->type->image() }}" alt="{{ $product->code() }}" class="img-fluid img-thumbnail"></a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="sale-flash badge {{ $product->availability()->color }} p-2">{{ $product->availability()->status }}</div>
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-12 product-desc">
                     <div class="d-flex align-items-center justify-content-between">
                        <div class="product-price">
                           Rp <ins>{{ number_format($product->price(), 0, ',', '.') }}</ins>
                        </div>
                        <div class="d-flex align-items-center justify-content-end">
                           Availability&nbsp;&nbsp;<strong>{{ $product->availability()->stock }} Carton</strong>
                        </div>
                     </div>
                     <div class="line"></div>
                     <form method="POST" action="{{ url('product/add_to_cart') }}" class="cart mb-0" method="POST">
                        @csrf
                        <div class="row justify-content-center">
                           <div class="col-lg-6 col-md-6 col-6 mb-1">
                              <div class="quantity">
                                 <input type="hidden" name="product_id" value="{{ base64_encode($product->id) }}">
                                 <input type="button" value="-" class="minus">
                                 <input type="number" step="1" min="1" name="qty" id="qty" onchange="checkStock()" value="1" title="Quantity" class="qty">
                                 <input type="button" value="+" class="plus">
                              </div>
                              <div class="mb-2 mt-2">
                                 <a href="javascript:void(0);" id="notif_indent" data-toggle="modal" data-target="#detail_stock" class="text-primary font-italic">See Detail</a>
                              </div>
                           </div>
                           <div class="col-lg-6 col-md-6 col-6 text-right">
                              <button type="submit" class="button button-green m-0">Add to cart</button>
                           </div>
                        </div>
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
                           <span class="text-muted">Size:</span>
                           <span class="text-dark font-weight-semibold">
                              {{ $product->type->length }}x{{ $product->type->width }} Cm
                           </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-center align-items-center px-0">
                           <div class="addthis_inline_share_toolbox_ykjh"></div>
                        </li>
                     </ul>
                  </div>
                  <div class="w-100"></div>
                  <div class="col-12 mt-5">
                     <div class="tabs clearfix mb-0" id="tab-1">
                        <ul class="tab-nav justify-content-center clearfix">
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
                                       <td>Loading Limit</td>
                                       <td>{{ $product->type->loadingLimit->name }}</td>
                                    </tr>
                                    <tr>
                                       <td>Weight</td>
                                       <td>{{ $product->type->weight }} Kg</td>
                                    </tr>
                                    <tr>
                                       <td>Thickness</td>
                                       <td>{{ $product->type->thickness }} mm</td>
                                    </tr>
                                    <tr>
                                       <td>Grade</td>
                                       <td>{{ $product->grade->name }}</td>
                                    </tr>
                                    <tr>
                                       <td>Country</td>
                                       <td>{{ $product->country->name }}</td>
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
         @if($related_product->count() > 0)
            <div class="line"></div>
            <div class="w-100">
               <h4>Related Product</h4>
               <div class="owl-carousel product-carousel carousel-widget" data-margin="30" data-pagi="false" data-autoplay="5000" data-items-xs="1" data-items-md="2" data-items-lg="4" data-items-xl="4">
                  @foreach($related_product as $rp)
                     <div class="oc-item">
                        <div class="product border">
                           <div class="product-image">
                              <a href="{{ url('product/detail/' . base64_encode($rp->id)) }}">
                                 <img src="{{ $rp->type->image() }}" alt="{{ $rp->code() }}" class="img-fluid">
                              </a>
                              <div class="sale-flash badge {{ $rp->availability()->color }} p-2">{{ $rp->availability()->status }}</div>
                           </div>
                           <div class="product-desc p-3">
                              <div class="product-price font-weight-bold">
                                 <ins class="text-dark">
                                    <h1 style="font-size:17px;" class="mb-0 font-weight-bold">Rp {{ number_format($rp->price(), 0, ',', '.') }}</h1>
                                 </ins>
                              </div>
                              <div class="product-title">
                                 <h4 class="mb-0 font-weight-normal limit-text-list-product">
                                    <a href="{{ url('product/detail/' . base64_encode($rp->id)) }}" class="font-wight-semibold text-danger" style="font-size:13.5px;">{{ $rp->code() }}</a>
                                 </h4>
                              </div>
                              <div class="product-price font-weight-semibold">
                                 <span>
                                    <span class="text-warning">{{ $rp->brand->name }}</span> | <span class="text-info">{{ $rp->type->length }}x{{ $rp->type->width }}</span>
                                 </span>
                              </div>
                           </div>
                        </div>
                     </div>
                  @endforeach
               </div>
            </div>
         @endif
      </div>
   </div>
</section>

<div class="modal fade" id="detail_stock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
               DETAIL STOCK
               <div class="mt-2 text-danger font-italic" style="font-size:11px;">
                  *) Shading is the depiction of depth perception in a 3D model or an image using various levels of darkness.
               </div>
            </h5>
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
                        <th>Available</th>
                        <th>Balance</th>
                     </tr>
                  </thead>
                  <tbody id="data_shading"></tbody>
                  <tfoot>
                     <tr>
                        <th colspan="2" class="text-right">Request Stock</th>
                        <th id="total_request_stock">0</th>
                     </tr>
                     <tr>
                        <th colspan="2" class="text-right">Available Stock</th>
                        <th id="total_stock">0</th>
                     </tr>
                     <tr>
                        <th colspan="2" class="text-right">Ready Stock</th>
                        <th id="total_ready_stock">0</th>
                     </tr>
                     <tr>
                        <th colspan="2" class="text-right">Indent Stock</th>
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

      var session_flash = "{{ session('success') }}";
      if(session_flash) {
         Swal.fire('Success!', session_flash, 'success');
      }
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