<section id="page-title" class="page-title-mini">
   <div class="container clearfix">
      <h1>Wishlist</h1>
      <ol class="breadcrumb">
         <li class="breadcrumb-item">
            <a href="{{ url('/') }}">Home</a>
         </li>
         <li class="breadcrumb-item">
            <a href="javascript:void(0);">Account</a>
         </li>
         <li class="breadcrumb-item active" aria-current="page">
            Wishlist
         </li>
      </ol>
   </div>
</section>
<section id="content">
   <div class="content-wrap">
      <div class="container">
         @if($wishlist->count() > 0)
            <div id="shop" class="shop row grid-container gutter-30">
               @foreach($wishlist as $w)
                  <div class="product col-lg-3 col-6 mb-4">
                     <div class="grid-inner border">
                        <div class="bg-light">
                           <div class="p-2 font-weight-bold text-center" style="font-size:13px;">
                              {{ $w->product->type->category->name }}
                           </div>
                        </div>
                        <div class="product-image">
                           <a href="{{ url('product/detail/' . base64_encode($w->product->id)) }}">
                              <img src="{{ $w->product->type->image() }}" alt="{{ $w->product->code() }}" class="img-fluid product-thumbnail">
                           </a>
                           <div class="sale-flash badge {{ $w->product->availability()->color }} p-2">{{ $w->product->availability()->status }}</div>
                        </div>
                        <div class="product-desc p-3">
                           <div class="product-price font-weight-bold">
                              <ins class="text-dark">
                                 <h1 style="font-size:17px;" class="mb-0 font-weight-bold">Rp {{ number_format($w->product->price(), 0, ',', '.') }}</h1>
                              </ins>
                           </div>
                           <div class="product-title">
                              <h4 class="mb-0 font-weight-normal limit-text-list-product">
                                 <a href="{{ url('product/detail/' . base64_encode($w->product->id)) }}" class="font-wight-semibold text-danger" style="font-size:13.5px;">{{ $w->product->code() }}</a>
                              </h4>
                           </div>
                           <div class="product-price font-weight-semibold mt-3">
                              <span>
                                 <div class="row no-gutters">
                                    <div class="col-md-5 mb-2">
                                       <a href="{{ url('product/wishlist_destroy/' . base64_encode($w->id)) }}" class="btn btn-danger btn-sm col-12" style="border-radius:0;">Remove</a>
                                    </div>
                                    <div class="col-md-7">
                                       <a href="{{ url('product/wishlist_to_cart/' . base64_encode($w->id)) }}" class="btn btn-dark btn-sm col-12" style="border-radius:0;">Move To Cart</a>
                                    </div>
                                 </div>
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
               @endforeach
            </div>
         @else
            <div class="alert alert-warning">
               <div class="text-center">You don't have a product on the wishlist</div>
            </div>
         @endif
         {{ $wishlist->withQueryString()->onEachSide(1)->links('pagination') }}
         {{-- @if($wishlist->count() > 0)
            <div class="table-responsive">
               <table class="table cart mb-5">
                  <thead>
                     <tr>
                        <th class="cart-product-remove">#</th>
                        <th class="cart-product-thumbnail">Image</th>
                        <th class="cart-product-name">Product</th>
                        <th class="cart-product-price">Unit Price</th>
                        <th class="cart-product-quantity">Stock</th>
                        <th class="cart-product-quantity">Move</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($wishlist as $w)
                        <tr class="cart_item">
                           <td class="cart-product-remove">
                              <a href="{{ url('product/wishlist_destroy/' . base64_encode($w->id)) }}" class="remove" title="Remove this item"><i class="icon-trash2"></i></a>
                           </td>
                           <td class="cart-product-thumbnail">
                              <a href="{{ url('product/detail/' . base64_encode($w->id)) }}">
                                 <img width="64" height="64" src="{{ $w->product->type->image() }}" class="img-fluid">
                              </a>
                           </td>
                           <td class="cart-product-name">
                              <a href="{{ url('product/detail/' . base64_encode($w->id)) }}">{{ $w->product->code() }}</a>
                           </td>
                           <td class="cart-product-price">
                              <span class="amount">Rp {{ number_format($w->product->price(), 0, ',', '.') }}</span>
                           </td>
                           <td class="cart-product-quantity">
                              <span class="amount">{{ $w->product->productShading->sum('qty') }}</span>
                           </td>
                           <td class="cart-product-subtotal">
                              <a href="{{ url('product/wishlist_to_cart/' . base64_encode($w->id)) }}" class="remove text-success" title="Move this item">Move Now Your Cart</span></a>
                           </td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
            {{ $wishlist->withQueryString()->onEachSide(1)->links('pagination') }}
         @endif --}}
      </div>
   </div>
</section>