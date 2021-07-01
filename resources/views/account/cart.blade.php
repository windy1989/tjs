<section id="page-title">
   <div class="container">
      <h1>
         @php $str = explode(' ', session('fo_name')); @endphp
         {{ $str[0] }} Cart
      </h1>
   </div>
</section>
<section id="content">
   <div class="content-wrap">
      <div class="container">
         @if($cart->count() > 0)
            <div class="table-responsive">
               <table class="table cart mb-5">
                  <thead>
                     <tr>
                        <th class="cart-product-remove">#</th>
                        <th class="cart-product-thumbnail">Image</th>
                        <th class="cart-product-name">Product</th>
                        <th class="cart-product-price">Unit Price</th>
                        <th class="cart-product-quantity">Qty</th>
                        <th class="cart-product-subtotal">Total</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($cart as $c)
                        <tr class="cart_item">
                           <td class="cart-product-remove">
                              <a href="{{ url('product/cart_destroy/' . base64_encode($c->id)) }}" class="remove" title="Remove this item"><i class="icon-trash2"></i></a>
                           </td>
                           <td class="cart-product-thumbnail">
                              <a href="{{ url('product/detail/' . base64_encode($c->id)) }}">
                                 <img width="64" height="64" src="{{ $c->product->type->image() }}" class="img-fluid">
                              </a>
                           </td>
                           <td class="cart-product-name">
                              <a href="{{ url('product/detail/' . base64_encode($c->id)) }}">{{ $c->product->code() }}</a>
                           </td>
                           <td class="cart-product-quantity">
                              <span class="amount">Rp {{ number_format($c->product->price(), 0, ',', '.') }}</span>
                           </td>
                           <td class="cart-product-quantity nowrap">
                              <div class="quantity">
                                 <input type="button" value="-" class="minus">
                                 <input type="number" step="1" min="1" name="qty" id="qty_{{ $c->id }}" onchange="cartQty({{ $c->id }}, '{{ base64_encode($c->product->id) }}')" value="{{ $c->qty }}" max="{{ $c->product->availability()->stock }}" title="Quantity" class="qty">
                                 <input type="button" value="+" class="plus">
                              </div>
                           </td>
                           <td class="cart-product-subtotal">
                              <span class="amount" id="total_price_{{ $c->id }}">
                                 Rp {{ number_format($c->product->price() * $c->qty, 0, ',', '.') }}
                              </span>
                           </td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
            {{ $cart->withQueryString()->onEachSide(1)->links('pagination') }}
            <div class="row mt-5 col-mb-30 justify-content-end">
               <div class="col-lg-6">
                  <div class="table-responsive">
                     <table class="table cart cart-totals">
                        <tbody>
                           <tr class="cart_item">
                              <td class="cart-product-name">
                                 <strong style="font-size:20px;" class="text-uppercase">Total</strong>
                              </td>
                              <td class="cart-product-name">
                                 <span class="amount color lead">
                                    <strong id="grandtotal">Rp {{ number_format($total_cart, 0, ',', '.') }}</strong>
                                 </span>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
            <div class="form-group"><hr></div>
            <div class="text-right">
               <button type="button" onclick="choosePaymentMethod()" class="button button-3d mt-2 mt-sm-0 mr-0 text-right">Checkout Now</button>
            </div>
         @else
            <div class="alert alert-warning">
               <div class="text-center">Cart is empty.</div>
            </div>
         @endif
      </div>
   </div>
</section>

<script>
   function choosePaymentMethod() {
      Swal.fire({
         title: 'Payment Method',
         text: 'Please select the payment method according to your wishes',
         icon: 'info',
         allowOutsideClick: false,
         showCancelButton: true,
         showDenyButton: true,
         confirmButtonText: 'Online',
         denyButtonText: 'Pay at Cashier',
         cancelButtonText: 'Cancel',
         reverseButtons: true
      }).then((result) => {
         if(result.isConfirmed) {
            window.location.href = '{{ url("checkout/cashless") }}';
         } else if(result.isDenied) {
            window.location.href = '{{ url("checkout/cash") }}';
         }
      });
   }

   function cartQty(id, product_id) {
      $.ajax({
         url: '{{ url("product/cart_qty") }}',
         type: 'POST',
         dataType: 'JSON',
         data: {
            id: id,
            product_id: product_id,
            qty: $('#qty_' + id).val()
         },
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         success: function(response) {
            $('#total_price_' + id).html(response.total_price);
            $('#grandtotal').html(response.grandtotal);
         }
      });
   }
</script>