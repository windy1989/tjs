<section id="page-title">
   <div class="container">
      <h1>History Order</h1>
   </div>
</section>
<section id="content">
   <div class="content-wrap">
      <div class="container-fluid clearfix" style="width:85% !important;">
         <div class="row clearfix">
            <div class="col-lg-3 col-md-12">
               <div class="list-group">
                  <a href="{{ url('account/history_order') }}" class="list-group-item list-group-item-action d-flex justify-content-between {{ $status == null ? 'active' : '' }}">
                     <div>All</div>
                     <span class="badge badge-light">{{ App\Models\Order::where('customer_id', session('fo_id'))->count() }}</span>
                  </a>
                  <a href="{{ url('account/history_order?status=1') }}" class="list-group-item list-group-item-action d-flex justify-content-between {{ $status == 1 ? 'active' : '' }}">
                     <div>Unpaid</div>
                     <span class="badge badge-light">{{ App\Models\Order::where('customer_id', session('fo_id'))->where('status', 1)->count() }}</span>
                  </a>
                  <a href="{{ url('account/history_order?status=2') }}" class="list-group-item list-group-item-action d-flex justify-content-between {{ $status == 2 ? 'active' : '' }}">
                     <div>Paid</div>
                     <span class="badge badge-light">{{ App\Models\Order::where('customer_id', session('fo_id'))->where('status', 2)->count() }}</span>
                  </a>
                  <a href="{{ url('account/history_order?status=3') }}" class="list-group-item list-group-item-action d-flex justify-content-between {{ $status == 3 ? 'active' : '' }}">
                     <div>On Delivery</div>
                     <span class="badge badge-light">{{ App\Models\Order::where('customer_id', session('fo_id'))->where('status', 3)->count() }}</span>
                  </a>
                  <a href="{{ url('account/history_order?status=4') }}" class="list-group-item list-group-item-action d-flex justify-content-between {{ $status == 4 ? 'active' : '' }}">
                     <div>Done</div>
                     <span class="badge badge-light">{{ App\Models\Order::where('customer_id', session('fo_id'))->where('status', 4)->count() }}</span>
                  </a>
                  <a href="{{ url('account/history_order?status=5') }}" class="list-group-item list-group-item-action d-flex justify-content-between {{ $status == 5 ? 'active' : '' }}">
                     <div>Cancel</div>
                     <span class="badge badge-light">{{ App\Models\Order::where('customer_id', session('fo_id'))->where('status', 5)->count() }}</span>
                  </a>
               </div>
            </div>
            <div class="w-100 line d-block d-lg-none"></div>
            <div class="col-lg-9 col-md-12">
               <div class="clear"></div>
               <form action="{{ url('account/history_order') }}" method="GET" class="mb-0">
                  <input type="hidden" name="status" value="{{ $status }}">
                  @csrf
                  <div class="row">
                     <div class="col-lg-2 col-md-12">
                        <div class="form-group">
                           <select name="type" id="type" class="custom-select">
                              <option value="">All</option>
                              <option value="1" {{ $type == 1 ? 'selected' : '' }}>Cash</option>
                              <option value="2" {{ $type == 2 ? 'selected' : '' }}>Cashless</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-lg-8 col-md-12">
                        <div class="form-group">
                           <input type="text" name="search" id="search" class="form-control" placeholder="Search number" value="{{ $search }}">
                        </div>
                     </div>
                     <div class="col-lg-2 col-md-12">
                        <div class="form-group">
                           <button type="submit" class="btn btn-success col-12">
                              <i class="icon-search"></i> Search
                           </button>
                        </div>
                     </div>
                  </div>
               </form>
               <div class="mt-3">
                  @if($order->count() > 0)
                     @foreach($order as $o)
                        <div class="card bg-light">
                           <div class="card-body">
                              <div class="card-title">
                                 <span style="font-size:17px; font-weight:500;">NO. {{ $o->number }}</span>
                                 <div class="float-right d-none d-sm-block">
                                    {{ date('d M Y', strtotime($o->created_at)) }}
                                 </div>
                              </div>
                           </div>
                        </div>
                        <table class="table cart mb-4 bg-light table-bordered">
                           <tbody>
                              @foreach($o->orderDetail as $od)
                                 <tr class="cart_item">
                                    <td class="cart-product-name text-center">
                                       <div class="row">
                                          <div class="col-lg-3 col-md-12">
                                             <div class="form-group">
                                                <center>
                                                   <a href="{{ url('product/detail/' . base64_encode($od->id)) }}">
                                                      <img width="64" height="64" src="{{ $od->product->type->image() }}" class="img-fluid img-thumbnail">
                                                   </a>
                                                </center>
                                             </div>
                                          </div>
                                          <div class="col-lg-3 col-md-12">
                                             <div class="form-group">
                                                {{ $od->product->code() }}
                                                <div style="font-size:14px;">
                                                   <div class="text-muted">
                                                      {{ $od->product->type->weight }} Kg, {{ $od->product->type->color->name }}
                                                   </div>
                                                   x{{ $od->qty }}
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-lg-3 col-md-12">
                                             <div class="form-group">
                                                Item Price
                                                <div>Rp {{ number_format($od->price_list, 0, ',', '.') }}</div>
                                             </div>
                                          </div>
                                          <div class="col-lg-3 col-md-12">
                                             <div class="form-group">
                                                Subtotal
                                                <div>Rp {{ number_format($od->total, 0, ',', '.') }}</div>
                                             </div>
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
                              @endforeach
                              <tr class="cart_item">
                                 <td class="mb-0">
                                    <h5 class="float-left font-weight-medium">
                                       <div>Subtotal : <span class="text-muted">Rp {{  number_format($o->orderDetail->sum('total'), 0, ',', '.') }}</span></div>
                                       <div>Shipping : <span class="text-muted">Rp {{  number_format($o->shipping, 0, ',', '.') }}</span></div>
                                       <div>Total : <span class="text-muted">Rp {{  number_format($o->grandtotal, 0, ',', '.') }}</span></div>
                                       <div><sub class="text-dark text-left font-weight-bold font-italic">{{ $o->type() }}</sub></div>
                                    </h5>
                                    <div class="text-right">
                                       @if($o->status == 3) 
                                          <button type="button" class="button button-red" onclick="confirmationDelivery({{ $o->id }})">Arrived</button>
                                       @endif
                                       <a href="{{ url('account/history_order/detail/' . base64_encode($o->id)) }}" class="button button-blue">Detail Order</a>
                                    </div>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     @endforeach
                     {{ $order->withQueryString()->onEachSide(1)->links('pagination') }}
                  @else
                     <div class="alert alert-warning">
                        <div class="text-center">Data not found.</div>
                     </div>
                  @endif
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<script>
   function confirmationDelivery(id) {
      Swal.fire({
         title: 'Are you sure?',
         text: 'Order confirmation has arrived',
         icon: 'info',
         allowOutsideClick: false,
         showCancelButton: true,
         confirmButtonText: 'Ya, has arrived',
         cancelButtonText: 'Not arrived',
         reverseButtons: true
      }).then((result) => {
         if(result.isConfirmed) {
            $.ajax({
               url: '{{ url("account/history_order/confirmation_delivery") }}',
               type: 'POST',
               dataType: 'JSON',
               data: {
                  id: id
               },
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
               success: function(response) {
                  if(response.status == 200) {
                     let timerInterval
                     Swal.fire({
                        title: response.message,
                        html: 'I will close in <b></b> milliseconds.',
                        timer: 1000,
                        allowOutsideClick: false,
                        timerProgressBar: true,
                        didOpen: () => {
                           Swal.showLoading();
                           timerInterval = setInterval(() => {
                              const content = Swal.getHtmlContainer();
                              if(content) {
                                 const b = content.querySelector('b');
                                 if(b) {
                                    b.textContent = Swal.getTimerLeft();
                                 }
                              }
                           }, 100)
                        },
                        willClose: () => {
                           clearInterval(timerInterval);
                        }
                     }).then((result) => {
                        if(result.dismiss === Swal.DismissReason.timer) {
                           window.location.href = '{{ url("account/history_order?status=4") }}';
                        }
                     });
                  } else {
                     Swal.fire({
                        title: 'Oooppsss!',
                        text: 'Please try some more time',
                        icon: 'info'
                     });
                  }
               },
               error: function() {
                  Swal.fire({
                     title: 'Server Error',
                     text: 'Please try some more time',
                     icon: 'error'
                  });
               }
            });
         }
      })
   }
</script>