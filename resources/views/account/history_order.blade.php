<section id="page-title">
   <div class="container">
      <h1>History Order</h1>
   </div>
</section>
<section id="content">
   <div class="content-wrap">
      <div class="container">
         <div class="card mb-5">
            <div class="card-body">
               <nav class="navbar navbar-expand-lg navbar-light">
                  <button class="navbar-toggler btn btn-white focus-custom col-12" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span> 
                     @if($status == 1)
                        UNPAID
                     @elseif($status == 2)
                        PAID
                     @elseif($status == 3)
                        PACKED
                     @elseif($status == 4)
                        DELIVERY
                     @elseif($status == 5)
                        FINISH
                     @elseif($status == 6)
                        CANCEL
                     @else
                        ALL
                     @endif
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                     <div class="navbar-nav p-2 mx-auto">
                        <a class="nav-item nav-link a-link-order {{ $status == null ? 'active-link-custom' : '' }}" href="{{ url('account/history_order') }}">All</a>
                        <a class="nav-item nav-link a-link-order {{ $status == 1 ? 'active-link-custom' : '' }}" href="{{ url('account/history_order?status=1') }}">Unpaid</a>
                        <a class="nav-item nav-link a-link-order {{ $status == 2 ? 'active-link-custom' : '' }}" href="{{ url('account/history_order?status=2') }}">Paid</a>
                        <a class="nav-item nav-link a-link-order {{ $status == 3 ? 'active-link-custom' : '' }}" href="{{ url('account/history_order?status=3') }}">Packed</a>
                        <a class="nav-item nav-link a-link-order {{ $status == 4 ? 'active-link-custom' : '' }}" href="{{ url('account/history_order?status=4') }}">Delivery</a>
                        <a class="nav-item nav-link a-link-order {{ $status == 5 ? 'active-link-custom' : '' }}" href="{{ url('account/history_order?status=5') }}">Finish</a>
                        <a class="nav-item nav-link a-link-order {{ $status == 6 ? 'active-link-custom' : '' }}" href="{{ url('account/history_order?status=6') }}">Cancel</a>
                     </div>
                  </div>
               </nav>
               <div class="form-group"><hr></div>
               <form action="" method="GET" class="mb-0">
                  @csrf
                  <div class="row">
                     <div class="col-md-2">
                        <div class="form-group">
                           <select name="type" id="type" class="custom-select">
                              <option value="">All</option>
                              <option value="1" {{ $type == 1 ? 'selected' : '' }}>Cash</option>
                              <option value="2" {{ $type == 2 ? 'selected' : '' }}>Cashless</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-8">
                        <div class="form-group">
                           <input type="text" name="search" id="search" class="form-control" placeholder="Search number" value="{{ $search }}">
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="form-group">
                           <button type="submit" class="btn btn-success col-12">
                              <i class="icon-search"></i> Search
                           </button>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
         @if($order->count() > 0)
            @foreach($order as $o)
               <div class="card bg-light">
                  <div class="card-body">
                     <div class="card-title">
                        <span style="font-size:17px; font-weight:500;">
                           No. {{ $o->number }}&nbsp;&nbsp;
                           @if($o->type == 1) 
                              <sub class="badge badge-primary">{{ $o->type() }}</sub>
                           @else
                              <sub class="badge badge-succes">{{ $o->type() }}</sub>
                           @endif
                        </span>
                        <div class="float-right d-none d-sm-block">
                           {{ date('d M Y', strtotime($o->created_at)) }}
                        </div>
                     </div>
                  </div>
               </div>
               <table class="table cart mb-5 bg-light table-bordered">
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
                     <tr class="cart_item mb-0">
                        <td class="text-right">
                           <h4 class="float-left mt-3">Total Rp {{  number_format($o->orderDetail->sum('total'), 0, ',', '.') }}</h4>
                           <a href="{{ url('account/history_order/detail/' . base64_encode($o->id)) }}" class="button button-aqua">Detail Order</a>
                        </td>
                     </tr>
                  </tbody>
               </table>
            @endforeach
            {{ $order->withQueryString()->onEachSide(1)->links('pagination') }}
         @else
            <div class="alert alert-warning">
               <div class="text-center">Nothing.</div>
            </div>
         @endif
      </div>
   </div>
</section>