<section id="page-title" class="page-title-mini">
   <div class="container clearfix">
      <h1>History Order Detail</h1>
      <ol class="breadcrumb font-size-12">
         <li class="breadcrumb-item">
            <a href="{{ url('/') }}">Home</a>
         </li>
         <li class="breadcrumb-item">
            <a href="javascript:void(0);">Account</a>
         </li>
         <li class="breadcrumb-item">
            <a href="{{ url('account/history_order') }}">History Order</a>
         </li>
         <li class="breadcrumb-item active" aria-current="page">
            Detail
         </li>
      </ol>
   </div>
</section>
<section id="content">
   <div class="content-wrap">
      <div class="container">
         <div class="card">
            <div class="card-body">
               <div class="card-title">
                  <a href="{{ url('account/history_order') }}" class="text-dark text-uppercase font-size-13">
                     <i class="icon-chevron-left"></i>
                     &nbsp;Back
                  </a>
                  <span class="float-right text-uppercase font-size-13">
                     No. # {{ $order->number }}
                  </span>
               </div>
               @if($order->status == 1)
                  <div class="mb-5">
                     <div class="row justify-content-center">
                        <div class="col-md-6 text-center">
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
                        <tr class="text-center font-size-13">
                           <th class="cart-product-thumbnail text-center">Image</th>
                           <th class="cart-product-name">Product</th>
                           <th class="cart-product-price">Unit Price</th>
                           <th class="cart-product-quantity">Qty</th>
                           <th class="cart-product-subtotal">Total</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($order->orderDetail as $od)
                           <tr class="cart_item text-center font-size-12">
                              <td class="cart-product-quantity">
                                 <a href="{{ url('product/detail/' . base64_encode($od->id)) }}">
                                    <img width="64" height="64" src="{{ $od->product->type->image() }}" class="img-fluid img-thumbnail">
                                 </a>
                              </td>
                              <td class="cart-product-name">
                                 <a href="{{ url('product/detail/' . base64_encode($od->id)) }}" class="font-size-12">{{ $od->product->code() }}</a>
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
                           <h5 class="text-uppercase">Billing Address</h5>
                           <table class="table cart">
                              <tbody>
                                 <tr class="cart_item">
                                    <td class="cart-product-name">
                                       <strong class="font-size-12">Name</strong>
                                    </td>
                                    <td class="cart-product-name">
                                       <span class="amount color lead">
                                          <strong class="font-size-12 text-dark">{{ $order->customer->name }}</strong>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr class="cart_item">
                                    <td class="cart-product-name">
                                       <strong class="font-size-12">Email</strong>
                                    </td>
                                    <td class="cart-product-name">
                                       <span class="amount color lead">
                                          <strong class="font-size-12 text-dark">{{ $order->customer->email }}</strong>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr class="cart_item">
                                    <td class="cart-product-name">
                                       <strong class="font-size-12">Phone</strong>
                                    </td>
                                    <td class="cart-product-name">
                                       <span class="amount color lead">
                                          <strong class="font-size-12 text-dark">{{ $order->customer->phone }}</strong>
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
                           <h5 class="text-uppercase">Shipping Address</h5>
                           <table class="table cart">
                              <tbody>
                                 <tr class="cart_item">
                                    <td class="cart-product-name">
                                       <strong class="font-size-12">Name</strong>
                                    </td>
                                    <td class="cart-product-name">
                                       <span class="amount color lead">
                                          <strong class="font-size-12 text-dark">
                                             {{ $order->orderShipping ? $order->orderShipping->receiver_name : 'Delivery not set' }}
                                          </strong>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr class="cart_item">
                                    <td class="cart-product-name">
                                       <strong class="font-size-12">Email</strong>
                                    </td>
                                    <td class="cart-product-name">
                                       <span class="amount color lead">
                                          <strong class="font-size-12 text-dark">
                                             {{ $order->orderShipping ? $order->orderShipping->email : 'Delivery not set' }}   
                                          </strong>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr class="cart_item">
                                    <td class="cart-product-name">
                                       <strong class="font-size-12">Phone</strong>
                                    </td>
                                    <td class="cart-product-name">
                                       <span class="amount color lead">
                                          <strong class="font-size-12 text-dark">
                                             {{ $order->orderShipping ? $order->orderShipping->phone : 'Delivery not set' }}   
                                          </strong>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr class="cart_item">
                                    <td class="cart-product-name">
                                       <strong class="font-size-12">City</strong>
                                    </td>
                                    <td class="cart-product-name">
                                       <span class="amount color lead">
                                          <strong class="font-size-12 text-dark">
                                             {{ $order->orderShipping ? $order->orderShipping->city->name : 'Delivery not set' }}   
                                          </strong>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr class="cart_item">
                                    <td class="cart-product-name">
                                       <strong class="font-size-12">Address</strong>
                                    </td>
                                    <td class="cart-product-name">
                                       <span class="amount color lead">
                                          <strong class="font-size-12 text-dark">
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
                           <h5 class="text-uppercase">Payment Information</h5>
                           @if($order->orderPayment)
                              <table class="table cart">
                                 <tbody>
                                    <tr class="cart_item">
                                       <td class="cart-product-name">
                                          <strong class="font-size-12">Paid At</strong>
                                       </td>
                                       <td class="cart-product-name">
                                          <span class="amount color lead">
                                             <strong id="grandtotal" class="font-size-12 text-dark">
                                                {{ date('d F Y, H:i', strtotime($order->orderPayment->created_at)) }}
                                             </strong>
                                          </span>
                                       </td>
                                    </tr>
                                    <tr class="cart_item">
                                       <td class="cart-product-name">
                                          <strong class="font-size-12">Method</strong>
                                       </td>
                                       <td class="cart-product-name">
                                          <span class="amount color lead">
                                             <strong id="grandtotal" class="font-size-12 text-dark">
                                                {{ $order->orderPayment->method }}
                                             </strong>
                                          </span>
                                       </td>
                                    </tr>
                                    <tr class="cart_item">
                                       <td class="cart-product-name">
                                          <strong class="font-size-12">Channel</strong>
                                       </td>
                                       <td class="cart-product-name">
                                          <span class="amount color lead">
                                             <strong id="grandtotal" class="font-size-12 text-dark">
                                                {{ $order->orderPayment->channel }}
                                             </strong>
                                          </span>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           @else
                              <div class="style-msg2" style="background-color: #EEE;">
                                 <div class="sb-msg font-size-12">
                                    <i class="icon-warning-sign"></i>
                                    <strong>Ooppsss!</strong> 
                                    There is no payment on your order
                                 </div>
                              </div>
                           @endif
                        </div>
                     </div>
                  </div>
                  @if($order->voucher)
                     <div class="col-lg-12 mb-5">
                        <div class="border p-4">
                           <div class="table-responsive">
                              <h5 class="text-uppercase">Voucher Information</h5>
                              <table class="table cart">
                                 <tbody>
                                    <tr class="cart_item">
                                       <td class="cart-product-name">
                                          <strong class="font-size-12">Voucher</strong>
                                       </td>
                                       <td class="cart-product-name">
                                          <span class="amount color lead">
                                             <strong id="grandtotal" class="font-size-12 text-dark">
                                                {{ $order->voucher->name }}
                                             </strong>
                                          </span>
                                       </td>
                                    </tr>
                                    <tr class="cart_item">
                                       <td class="cart-product-name">
                                          <strong class="font-size-12">Code</strong>
                                       </td>
                                       <td class="cart-product-name">
                                          <span class="amount color lead">
                                             <strong id="grandtotal" class="font-size-12 text-dark">
                                                {{ $order->voucher->code }}
                                             </strong>
                                          </span>
                                       </td>
                                    </tr>
                                    <tr class="cart_item">
                                       <td class="cart-product-name">
                                          <strong class="font-size-12">Type</strong>
                                       </td>
                                       <td class="cart-product-name">
                                          <span class="amount color lead">
                                             <strong id="grandtotal" class="font-size-12 text-dark">
                                                {{ $order->voucher->type() }}
                                             </strong>
                                          </span>
                                       </td>
                                    </tr>
                                    <tr class="cart_item">
                                       <td class="cart-product-name">
                                          <strong class="font-size-12">Discount</strong>
                                       </td>
                                       <td class="cart-product-name">
                                          <span class="amount color lead">
                                             <strong id="grandtotal" class="font-size-12 text-dark">
                                                {{ $order->voucher->percentage }}%
                                             </strong>
                                          </span>
                                       </td>
                                    </tr>
                                    <tr class="cart_item">
                                       <td class="cart-product-name">
                                          <strong class="font-size-12">Minimum Order</strong>
                                       </td>
                                       <td class="cart-product-name">
                                          <span class="amount color lead">
                                             <strong id="grandtotal" class="font-size-12 text-dark">
                                                Rp {{ number_format($order->voucher->minimum, 0, ',', '.') }}
                                             </strong>
                                          </span>
                                       </td>
                                    </tr>
                                    <tr class="cart_item">
                                       <td class="cart-product-name">
                                          <strong class="font-size-12">Maximum Discount</strong>
                                       </td>
                                       <td class="cart-product-name">
                                          <span class="amount color lead">
                                             <strong id="grandtotal" class="font-size-12 text-dark">
                                                Rp {{ number_format($order->voucher->maximum, 0, ',', '.') }}
                                             </strong>
                                          </span>
                                       </td>
                                    </tr>
                                    @if($order->voucher->points > 0)
                                       <tr class="cart_item">
                                          <td class="cart-product-name">
                                             <strong class="font-size-12">Cashback</strong>
                                          </td>
                                          <td class="cart-product-name">
                                             <span class="amount color lead">
                                                <strong id="grandtotal" class="font-size-12 text-dark">
                                                   {{ number_format($order->voucher->points, 0, ',', '.') }} Points
                                                </strong>
                                             </span>
                                          </td>
                                       </tr>
                                    @endif
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  @endif
                  <div class="col-lg-12">
                     <div class="border p-4">
                        <div class="table-responsive">
                           <h5 class="text-uppercase">Summary</h5>
                           <table class="table cart">
                              <tbody>
                                 @if(Storage::exists($order->qr_code))
                                    <tr class="cart_item">
                                       <td rowspan="7">
                                          <center>
                                             <img src="{{ asset(Storage::url($order->qr_code)) }}" class="img-fluid">
                                          </center>
                                       </td>
                                    </tr>
                                 @endif
                                 <tr class="cart_item">
                                    <td class="cart-product-name">
                                       <strong class="font-size-12">Subtotal</strong>
                                    </td>
                                    <td class="cart-product-name">
                                       <span class="amount color lead">
                                          <strong id="grandtotal" class="font-size-12 text-dark">
                                             Rp {{ number_format($order->subtotal, 0, ',', '.') }}
                                          </strong>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr class="cart_item">
                                    <td class="cart-product-name">
                                       <strong class="font-size-12">Discount</strong>
                                    </td>
                                    <td class="cart-product-name">
                                       <span class="amount color lead">
                                          <strong id="grandtotal" class="font-size-12 text-dark">
                                             - Rp {{ number_format($order->discount, 0, ',', '.') }}
                                          </strong>
                                       </span>
                                    </td>
                                 </tr>
                                 @if($order->points)
                                    <tr class="cart_item">
                                       <td class="cart-product-name">
                                          <strong class="font-size-12">Redeem Points</strong>
                                       </td>
                                       <td class="cart-product-name">
                                          <span class="amount color lead">
                                             <strong id="grandtotal" class="font-size-12 text-dark">
                                                - {{ number_format($order->points, 0, ',', '.') }}
                                             </strong>
                                          </span>
                                       </td>
                                    </tr>
                                 @endif
                                 <tr class="cart_item">
                                    <td class="cart-product-name">
                                       <strong class="font-size-12">Delivery Cost</strong>
                                    </td>
                                    <td class="cart-product-name">
                                       <span class="amount color lead">
                                          <strong id="grandtotal" class="font-size-12 text-dark">
                                             Rp {{ number_format($order->shipping, 0, ',', '.') }}
                                          </strong>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr class="cart_item">
                                    <td class="cart-product-name">
                                       <strong class="font-size-14">Total</strong>
                                    </td>
                                    <td class="cart-product-name">
                                       <span class="amount color lead">
                                          <strong id="grandtotal" class="font-size-14 text-dark font-weight-bold">
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
								<div class="msgtitle text-center font-weight-bold text-uppercase font-size-12">Type Of Transport</div>
								<div class="sb-msg text-center font-weight-semibold font-size-12">
									{{ $order->orderShipping ? $order->orderShipping->delivery->transport->fleet : 'Delivery not set' }}
								</div>
							</div>
                  </div>
                  <div class="col-lg-4 col-md-12">
                     <div class="style-msg2 errormsg">
								<div class="msgtitle text-center font-weight-bold text-uppercase font-size-12">Payment Method</div>
								<div class="sb-msg text-center font-weight-semibold font-size-12">
									{{ $order->type() }}
								</div>
							</div>
                  </div>
                  <div class="col-lg-4 col-md-12">
                     <div class="style-msg2 alertmsg">
								<div class="msgtitle text-center font-weight-bold text-uppercase font-size-12">Status</div>
								<div class="sb-msg text-center font-weight-semibold font-size-12">
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
                     <a href="{{ $order->xendit()->url }}" class="button bg-teal button-3d font-size-12">Pay Now</a>
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