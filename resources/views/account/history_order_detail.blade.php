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
                  <a href="{{ url('account/history_order') }}" class="text-dark text-uppercase">
                     <i class="icon-chevron-left"></i>
                     &nbsp;Back
                  </a>
                  <span class="float-right text-uppercase">
                     No. {{ $order->number }}
                  </span>
               </div>
               @if($order->status == 1)
                  <div class="mb-5">
                     <div class="row justify-content-center">
                        <div class="col-md-6">
                           <div id="simple_timer"></div>
                        </div>
                     </div>
                  </div>
               @else
                  <div class="mt-5 mb-5"></div>
               @endif
               <div class="table-responsive">
                  <table class="table cart table-bordered">
                     <thead>
                        <tr>
                           <th class="cart-product-thumbnail text-center">Image</th>
                           <th class="cart-product-name">Product</th>
                           <th class="cart-product-price">Unit Price</th>
                           <th class="cart-product-quantity">Qty</th>
                           <th class="cart-product-subtotal">Total</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($order->orderDetail as $od)
                           <tr class="cart_item">
                              <td class="cart-product-quantity">
                                 <a href="{{ url('product/detail/' . base64_encode($od->id)) }}">
                                    <img width="64" height="64" src="{{ $od->product->type->image() }}" class="img-fluid img-thumbnail">
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
                              <td class="cart-product-subtotal">
                                 <span class="amount">
                                    Rp {{ number_format($od->total, 0, ',', '.') }}
                                 </span>
                              </td>
                           </tr>
                        @endforeach
                     </tbody>
                  </table>
               </div>
               <div class="row">
                  <div class="col-md-12 mt-4 mb-3">
                     <div class="border p-4">
                        <div class="table-responsive">
                           <h4 class="text-uppercase">Billing Address</h4>
                           <table class="table cart">
                              <tbody>
                                 <tr class="cart_item">
                                    <td class="cart-product-name">
                                       <strong style="font-size:13px;" class="text-uppercase">Name</strong>
                                    </td>
                                    <td class="cart-product-name">
                                       <span class="amount color lead">
                                          <strong style="font-size:14px;">{{ $order->customer->name }}</strong>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr class="cart_item">
                                    <td class="cart-product-name">
                                       <strong style="font-size:13px;" class="text-uppercase">Email</strong>
                                    </td>
                                    <td class="cart-product-name">
                                       <span class="amount color lead">
                                          <strong style="font-size:14px;">{{ $order->customer->email }}</strong>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr class="cart_item">
                                    <td class="cart-product-name">
                                       <strong style="font-size:13px;" class="text-uppercase">Phone</strong>
                                    </td>
                                    <td class="cart-product-name">
                                       <span class="amount color lead">
                                          <strong style="font-size:14px;">{{ $order->customer->phone }}</strong>
                                       </span>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12 mt-4 mb-3">
                     <div class="border p-4">
                        <div class="table-responsive">
                           <h4 class="text-uppercase">Shipping Address</h4>
                           <table class="table cart">
                              <tbody>
                                 <tr class="cart_item">
                                    <td class="cart-product-name">
                                       <strong style="font-size:13px;" class="text-uppercase">Name</strong>
                                    </td>
                                    <td class="cart-product-name">
                                       <span class="amount color lead">
                                          <strong style="font-size:14px;">
                                             {{ $order->orderShipping ? $order->orderShipping->receiver_name : 'Delivery not set' }}
                                          </strong>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr class="cart_item">
                                    <td class="cart-product-name">
                                       <strong style="font-size:13px;" class="text-uppercase">Email</strong>
                                    </td>
                                    <td class="cart-product-name">
                                       <span class="amount color lead">
                                          <strong style="font-size:14px;">
                                             {{ $order->orderShipping ? $order->orderShipping->email : 'Delivery not set' }}   
                                          </strong>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr class="cart_item">
                                    <td class="cart-product-name">
                                       <strong style="font-size:13px;" class="text-uppercase">Phone</strong>
                                    </td>
                                    <td class="cart-product-name">
                                       <span class="amount color lead">
                                          <strong style="font-size:14px;">
                                             {{ $order->orderShipping ? $order->orderShipping->phone : 'Delivery not set' }}   
                                          </strong>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr class="cart_item">
                                    <td class="cart-product-name">
                                       <strong style="font-size:13px;" class="text-uppercase">City</strong>
                                    </td>
                                    <td class="cart-product-name">
                                       <span class="amount color lead">
                                          <strong style="font-size:14px;">
                                             {{ $order->orderShipping ? $order->orderShipping->city->name : 'Delivery not set' }}   
                                          </strong>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr class="cart_item">
                                    <td class="cart-product-name">
                                       <strong style="font-size:13px;" class="text-uppercase">Address</strong>
                                    </td>
                                    <td class="cart-product-name">
                                       <span class="amount color lead">
                                          <strong style="font-size:14px;">
                                             {{ $order->orderShipping ? $order->orderShipping->address : 'Delivery not set' }}   
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
               <div class="fancy-title title-border title-center mt-4 mb-4">
						<h1 style="color:rgba(0, 0, 0, .3);" class="text-uppercase">{{ $order->status() }}</h1>
					</div>
               <div class="row justify-content-end">
                  <div class="col-lg-12 mb-5">
                     <div class="border p-4">
                        <div class="table-responsive">
                           <h4 class="text-uppercase">Payment Information</h4>
                           @if($order->orderPayment)
                              <table class="table cart">
                                 <tbody>
                                    <tr class="cart_item">
                                       <td class="cart-product-name">
                                          <strong style="font-size:13px;" class="text-uppercase">Paid At</strong>
                                       </td>
                                       <td class="cart-product-name">
                                          <span class="amount color lead">
                                             <strong id="grandtotal" style="font-size:14px;">
                                                {{ date('d F Y, H:i', strtotime($order->orderPayment->created_at)) }}
                                             </strong>
                                          </span>
                                       </td>
                                    </tr>
                                    <tr class="cart_item">
                                       <td class="cart-product-name">
                                          <strong style="font-size:13px;" class="text-uppercase">Method</strong>
                                       </td>
                                       <td class="cart-product-name">
                                          <span class="amount color lead">
                                             <strong id="grandtotal" style="font-size:14px;">
                                                {{ $order->orderPayment->method }}
                                             </strong>
                                          </span>
                                       </td>
                                    </tr>
                                    <tr class="cart_item">
                                       <td class="cart-product-name">
                                          <strong style="font-size:13px;" class="text-uppercase">Channel</strong>
                                       </td>
                                       <td class="cart-product-name">
                                          <span class="amount color lead">
                                             <strong id="grandtotal" style="font-size:14px;">
                                                {{ $order->orderPayment->channel }}
                                             </strong>
                                          </span>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           @else
                              <div class="style-msg2" style="background-color: #EEE;">
                                 <div class="sb-msg">
                                    <i class="icon-warning-sign"></i>
                                    <strong>Ooppsss!</strong> 
                                    There is no payment on your order
                                 </div>
                              </div>
                           @endif
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12">
                     <div class="border p-4">
                        <div class="table-responsive">
                           <h4 class="text-uppercase">Summary</h4>
                           <table class="table cart">
                              <tbody>
                                 @if(Storage::exists($order->qr_code))
                                    <tr class="cart_item">
                                       <td rowspan="6">
                                          <center>
                                             <img src="{{ asset(Storage::url($order->qr_code)) }}" class="img-fluid">
                                          </center>
                                       </td>
                                    </tr>
                                 @endif
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
                                       <strong style="font-size:13px;" class="text-uppercase">Delivery Cost</strong>
                                    </td>
                                    <td class="cart-product-name">
                                       <span class="amount color lead">
                                          <strong id="grandtotal" style="font-size:14px;">
                                             Rp {{ number_format($order->shipping, 0, ',', '.') }}
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
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="form-group"><hr></div>
               <div class="row">
                  <div class="col-lg-4 col-md-12">
                     <div class="style-msg2 successmsg">
								<div class="msgtitle text-center font-weight-bold text-uppercase">Type Of Transport</div>
								<div class="sb-msg text-center font-weight-semibold">
									{{ $order->orderShipping ? $order->orderShipping->delivery->transport->fleet : 'Delivery not set' }}
								</div>
							</div>
                  </div>
                  <div class="col-lg-4 col-md-12">
                     <div class="style-msg2 errormsg">
								<div class="msgtitle text-center font-weight-bold text-uppercase">Payment Method</div>
								<div class="sb-msg text-center font-weight-semibold">
									{{ $order->type() }}
								</div>
							</div>
                  </div>
                  <div class="col-lg-4 col-md-12">
                     <div class="style-msg2 alertmsg">
								<div class="msgtitle text-center font-weight-bold text-uppercase">Status</div>
								<div class="sb-msg text-center font-weight-semibold">
									@if($order->status == 1)
                              Waiting for payment
                           @elseif($order->status == 2)
                              Order has been paid
                           @elseif($order->status == 3)                           
                              Order has been delivery
                           @elseif($order->status == 4)                           
                              Order has been completed
                           @elseif($order->status == 5)
                              Order canceled
                           @endif
								</div>
							</div>
                  </div>
               </div>
               @if($order->status == 1 && $order->type == 2)
                  <div class="form-group"><hr></div>
                  <div class="text-right mt-4">
                     <a href="{{ $order->xendit()->url }}" class="button button-green button-3d">Pay Now</a>
                  </div>
               @endif
            </div>
         </div>
      </div>
   </div>
</section>

<script>
   $(function() {
      $('#simple_timer').syotimer({
         year: '{{ date("Y", strtotime("+1 day", strtotime($order->created_at))) }}',
         month: '{{ date("m", strtotime("+1 day", strtotime($order->created_at))) }}',
         day: '{{ date("d", strtotime("+1 day", strtotime($order->created_at))) }}',
         hour: '{{ date("H", strtotime("+1 day", strtotime($order->created_at))) }}',
         minute: '{{ date("i", strtotime("+1 day", strtotime($order->created_at))) }}',
         headTitle: '<h3 class="mb-2 mt-0">Deadline For Your Order</h3>',
         dayVisible: false,
         periodUnit: 'd',
         periodic: true,
         periodInterval: 10,
         timeZone: 'local'
      });
   });
</script>