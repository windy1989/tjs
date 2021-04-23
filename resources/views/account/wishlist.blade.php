<section id="page-title">
   <div class="container">
      <h1>Wishlist</h1>
   </div>
</section>
<section id="content">
   <div class="content-wrap">
      <div class="container">
         @php $total_wishlist = 0; @endphp
         @if($wishlist->count() > 0)
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
                              <img width="64" height="64" src="{{ Storage::exists($w->product->type->image) ? asset(Storage::url($w->product->type->image)) : asset('website/empty.jpg') }}">
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
                           <a href="{{ url('product/move_wishlist_to_cart/' . base64_encode($w->id)) }}" class="remove text-success" title="Move this item">Move Now Your Cart</span></a>
                        </td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
            {{ $wishlist->withQueryString()->onEachSide(1)->links('pagination') }}
         @else
            <div class="alert alert-warning">
               <div class="text-center">Wishlist is empty.</div>
            </div>
         @endif
      </div>
   </div>
</section>