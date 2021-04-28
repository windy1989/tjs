<section id="page-title">
   <div class="container">
      <h1>History Order Detail</h1>
   </div>
</section>
<section id="content">
   <div class="content-wrap">
      <div class="container">
         <div class="card">
            <div class="card-body">
               <div class="card-title">
                  <a href="{{ url()->previous() }}" class="text-dark text-uppercase">
                     <i class="icon-chevron-left"></i>
                     &nbsp;Back
                  </a>
                  <span class="float-right text-uppercase">
                     No. {{ $order->number }}
                  </span>
               </div>
               <div class="mb-5">
                  <div class="row justify-content-center">
                     <div class="col-md-6">
                        <div id="simple_timer"></div>
                     </div>
                  </div>
               </div>
               <table class="table cart table-bordered">
                  <thead>
                     <tr>
                        <th class="cart-product-thumbnail">Image</th>
                        <th class="cart-product-name">Product</th>
                        <th class="cart-product-price">Unit Price</th>
                        <th class="cart-product-quantity">Qty</th>
                        <th class="cart-product-quantity">Ready Stock</th>
                        <th class="cart-product-quantity">Indent Stock</th>
                        <th class="cart-product-subtotal">Total</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($order->orderDetail as $od)
                        <tr class="cart_item">
                           <td class="cart-product-thumbnail">
                              <a href="{{ url('product/detail/' . base64_encode($od->id)) }}">
                                 <img width="64" height="64" src="{{ Storage::exists($od->product->type->image) ? asset(Storage::url($od->product->type->image)) : asset('website/empty.jpg') }}" class="img-fluid">
                              </a>
                           </td>
                           <td class="cart-product-name">
                              <a href="{{ url('product/detail/' . base64_encode($od->id)) }}">{{ $od->product->code() }}</a>
                           </td>
                           <td class="cart-product-quantity">
                              <span class="amount">Rp {{ number_format($od->price_list, 0, ',', '.') }}</span>
                           </td>
                           <td class="cart-product-quantity">
                              <div class="quantity">
                                 <span class="amount">x{{ $od->qty }}</span>
                              </div>
                           </td>
                           <td class="cart-product-quantity">
                              <span class="amount">
                                 <span class="d-inline">Ready</span> 
                                 <strong class="badge badge-success">{{ $od->ready }}</strong>
                              </span>
                           </td>
                           <td class="cart-product-quantity">
                              <span class="amount">
                                 <span class="d-inline">Indent</span> 
                                 <strong class="badge badge-info">{{ $od->indent }}</strong>
                              </span>
                           </td>
                           <td class="cart-product-subtotal">
                              <span class="amount">
                                 Rp {{ number_format($od->total, 0, ',', '.') }}
                              </span>
                           </td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
               <div class="fancy-title title-border title-center mt-4 mb-4">
						<h1 style="color:rgba(0, 0, 0, .3);" class="text-uppercase">{{ $order->status() }}</h1>
					</div>
               <div class="row justify-content-end">
                  <div class="col-lg-12">
                     <div class="card">
                        <div class="card-body">
                           <div class="table-responsive">
                              <h4 class="text-uppercase">Summary</h4>
                              <table class="table cart">
                                 <tbody>
                                    <tr class="cart_item">
                                       <td rowspan="6">
                                          <center>
                                             <img src="{{ asset(Storage::url($order->qr_code)) }}" class="img-fluid">
                                          </center>
                                       </td>
                                    </tr>
                                    <tr class="cart_item">
                                       <td class="cart-product-name">
                                          <strong style="font-size:13px;" class="text-uppercase">Subtotal</strong>
                                       </td>
                                       <td class="cart-product-name">
                                          <span class="amount color lead">
                                             <strong id="grandtotal" style="font-size:14px;">
                                                Rp {{ number_format($order->subtotal, 0, ',', '.') }}
                                             </strong>
                                          </span>
                                       </td>
                                    </tr>
                                    <tr class="cart_item">
                                       <td class="cart-product-name">
                                          <strong style="font-size:13px;" class="text-uppercase">Handling</strong>
                                       </td>
                                       <td class="cart-product-name">
                                          <span class="amount color lead">
                                             <strong id="grandtotal" style="font-size:14px;">
                                                Rp 0
                                             </strong>
                                          </span>
                                       </td>
                                    </tr>
                                    <tr class="cart_item">
                                       <td class="cart-product-name">
                                          <strong style="font-size:13px;" class="text-uppercase">Discount</strong>
                                       </td>
                                       <td class="cart-product-name">
                                          <span class="amount color lead">
                                             <strong id="grandtotal" style="font-size:14px;">
                                                Rp {{ number_format($order->discount, 0, ',', '.') }}
                                             </strong>
                                          </span>
                                       </td>
                                    </tr>
                                    <tr class="cart_item">
                                       <td class="cart-product-name">
                                          <strong style="font-size:13px;" class="text-uppercase">Total</strong>
                                       </td>
                                       <td class="cart-product-name">
                                          <span class="amount color lead">
                                             <strong id="grandtotal" style="font-size:20px;">
                                                Rp {{ number_format($order->grandtotal, 0, ',', '.') }}
                                             </strong>
                                          </span>
                                       </td>
                                    </tr>
                                    <tr class="cart_item">
                                       <td class="cart-product-name">
                                          <strong style="font-size:13px;" class="text-uppercase">Payment Method</strong>
                                       </td>
                                       <td class="cart-product-name">
                                          <span class="amount color lead">
                                             <strong id="grandtotal" style="font-size:14px;">
                                                Cash
                                             </strong>
                                          </span>
                                       </td>
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
      </div>
   </div>
</section>

<script>
   $(function() {
      $('#simple_timer').syotimer({
         year: '{{ date("Y", strtotime($countdown_time)) }}',
         month: '{{ date("m", strtotime($countdown_time)) }}',
         day: '{{ date("d", strtotime($countdown_time)) }}',
         hour: '{{ date("H", strtotime($countdown_time)) }}',
         minute: '{{ date("i", strtotime($countdown_time)) }}',
         headTitle: '<h3 class="mb-2 mt-0">{{ $countdown_title }}</h3>',
         dayVisible: false,
         periodUnit: 'd',
         periodic: true,
         periodInterval: 10,
         timeZone: 'local',
         afterDeadline: function(timerBlock) {
            timerBlock.bodyBlock.html('<p style="font-size: 1.2em;">{{ $countdown_status }}</p>');
         }
      });
   });
</script>