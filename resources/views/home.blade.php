<section id="slider" class="slider-element h-auto">
   <div class="slider-inner">
      <div class="owl-carousel carousel-widget" data-margin="0" data-items="1" data-pagi="false" data-loop="true" data-animate-in="rollIn" data-speed="450" data-animate-out="rollOut" data-autoplay="5000">
         @foreach($banner as $key => $b)
            <img src="{{ $b->image() }}" alt="Slider {{ $key + 1 }}" class="img-fluid">
         @endforeach
      </div>
   </div>
</section>
<section id="content">
   <div class="content-wrap">
      <div class="container clearfix">
         <div class="row align-items-stretch gutter-20 min-vh-60">
            <div class="col-md-4 min-vh-50">
               <a href="{{ url('product?brand=SM') }}" class="grid-inner d-block text-center">
                  <img src="{{ asset('website/home-top-smartmarble.jpg') }}" style="max-height:584px;" class="img-fluid">
               </a>
            </div>
            <div class="col-md-4 min-vh-50">
               <a href="{{ url('product?brand=KH') }}" class="grid-inner d-block text-center">
                  <img src="{{ asset('website/home-top-kohler.jpg') }}" style="max-height:584px; background-position: center top;" class="img-fluid">
               </a>
            </div>
            <div class="col-md-4 min-vh-50">
               <a href="{{ url('product?brand=BV') }}" class="grid-inner d-block text-center">
                  <img src="{{ asset('website/home-top-bravat.jpg') }}" style="max-height:584px; background-position: center top;" class="img-fluid">
               </a>
            </div>
         </div>
         <div class="clearfix"></div>
         <div class="topmargin-lg fancy-title title-border title-center">
            <h3 class="text-uppercase">Best Offer</h3>
         </div>
         <div id="shop" class="shop row grid-container gutter-30" data-layout="fitRows">
            @foreach($product_cheapest as $p)
               <div class="product col-lg-3 col-md-4 col-sm-6 col-12">
                  <div class="grid-inner border">
                     <div class="product-image">
                        <a href="{{ url('product/detail/' . base64_encode($p->id)) }}">
                           <img src="{{ $p->type->image() }}" alt="{{ $p->code() }}" class="img-fluid">
                        </a>
                        <div class="sale-flash badge {{ $p->availability()->color }} p-2">{{ $p->availability()->status }}</div>
                     </div>
                     <div class="product-desc p-3 text-center">
                        <div class="product-title">
                           <h4 class="mb-0 font-weight-normal limit-text-list-product">
                              <a href="{{ url('product/detail/' . base64_encode($p->id)) }}" style="font-weight:500;">{{ $p->code() }}</a>
                           </h4>
                        </div>
                        <div class="product-price text-info font-weight-bold">
                           <span>{{ $p->type->length }}x{{ $p->type->width }}</span>
                        </div>
                        <div class="product-price font-weight-bold">
                           <ins style="font-size:15px;" class="text-danger">Rp {{ number_format($p->price(), 0, ',', '.') }}</ins>
                        </div>
                        <div class="product-rating font-weight-bold" style="color:orange;">
                           {{ $p->brand->name }}
                        </div>
                     </div>
                  </div>
               </div>
            @endforeach
         </div>
         <div class="clearfix"></div>
         <div class="topmargin-lg fancy-title title-border title-center">
            <h3 class="text-uppercase">Product New</h3>
         </div>
         <div id="shop" class="shop row grid-container gutter-30" data-layout="fitRows">
            @foreach($product_new as $p)
               <div class="product col-lg-3 col-md-4 col-sm-6 col-12">
                  <div class="grid-inner border">
                     <div class="product-image">
                        <a href="{{ url('product/detail/' . base64_encode($p->id)) }}">
                           <img src="{{ $p->type->image() }}" alt="{{ $p->code() }}" class="img-fluid">
                        </a>
                        <div class="sale-flash badge {{ $p->availability()->color }} p-2">{{ $p->availability()->status }}</div>
                     </div>
                     <div class="product-desc p-3 text-center">
                        <div class="product-title">
                           <h4 class="mb-0 font-weight-normal limit-text-list-product">
                              <a href="{{ url('product/detail/' . base64_encode($p->id)) }}" style="font-weight:500;">{{ $p->code() }}</a>
                           </h4>
                        </div>
                        <div class="product-price text-info font-weight-bold">
                           <span>{{ $p->type->length }}x{{ $p->type->width }}</span>
                        </div>
                        <div class="product-price font-weight-bold">
                           <ins style="font-size:15px;" class="text-danger">Rp {{ number_format($p->price(), 0, ',', '.') }}</ins>
                        </div>
                        <div class="product-rating font-weight-bold" style="color:orange;">
                           {{ $p->brand->name }}
                        </div>
                     </div>
                  </div>
               </div>
            @endforeach
         </div>
         <div class="clearfix"></div>
         <div class="topmargin-lg fancy-title title-border title-center">
            <h3 class="text-uppercase">Product Limited</h3>
         </div>
         <div id="shop" class="shop row grid-container gutter-30" data-layout="fitRows">
            @foreach($product_limited as $p)
               <div class="product col-lg-3 col-md-4 col-sm-6 col-12">
                  <div class="grid-inner border">
                     <div class="product-image">
                        <a href="{{ url('product/detail/' . base64_encode($p->id)) }}">
                           <img src="{{ $p->type->image() }}" alt="{{ $p->code() }}" class="img-fluid">
                        </a>
                        <div class="sale-flash badge {{ $p->availability()->color }} p-2">{{ $p->availability()->status }}</div>
                     </div>
                     <div class="product-desc p-3 text-center">
                        <div class="product-title">
                           <h4 class="mb-0 font-weight-normal limit-text-list-product">
                              <a href="{{ url('product/detail/' . base64_encode($p->id)) }}" style="font-weight:500;">{{ $p->code() }}</a>
                           </h4>
                        </div>
                        <div class="product-price text-info font-weight-bold">
                           <span>{{ $p->type->length }}x{{ $p->type->width }}</span>
                        </div>
                        <div class="product-price font-weight-bold">
                           <ins style="font-size:15px;" class="text-danger">Rp {{ number_format($p->price(), 0, ',', '.') }}</ins>
                        </div>
                        <div class="product-rating font-weight-bold" style="color:orange;">
                           {{ $p->brand->name }}
                        </div>
                     </div>
                  </div>
               </div>
            @endforeach
         </div>
      </div>
   </div>
   <div class="section mt-0 mb-0">
      <div class="container">
         <div class="row">
            <div class="col-sm-6 col-lg-6 mb-5">
               <div class="feature-box fbox-plain fbox-dark fbox-sm">
                  <div class="fbox-content text-center">
                     <h1 class="mb-0"><i class="icon-thumbs-up2"></i></h1>
                     <h3>100% Original</h3>
                     <p class="mt-0">We guarantee you the sale of Original Brands.</p>
                  </div>
               </div>
            </div>
            <div class="col-sm-6 col-lg-6 mb-5">
               <div class="feature-box fbox-plain fbox-dark fbox-sm">
                  <div class="fbox-content text-center">
                     <h1 class="mb-0"><i class="icon-credit-cards"></i></h1>
                     <h3>Payment Options</h3>
                     <p class="mt-0">We accept Visa, MasterCard, Bank Transfer and eWallet.</p>
                  </div>
               </div>
            </div>
            <div class="col-sm-6 col-lg-6 mb-5">
               <div class="feature-box fbox-plain fbox-dark fbox-sm">
                  <div class="fbox-content text-center">
                     <h1 class="mb-0"><i class="icon-line2-home"></i></h1>
                     <h3>Warranty</h3>
                     <p class="mt-0">3 years for Sanitary ware & 2 years for tiles.</p>
                  </div>
               </div>
            </div>
            <div class="col-sm-6 col-lg-6 mb-5">
               <div class="feature-box fbox-plain fbox-dark fbox-sm">
                  <div class="fbox-content text-center">
                     <h1 class="mb-0"><i class="icon-user-tie"></i></h1>
                     <h3>Pre & Post Sales Services</h3>
                     <p class="mt-0">Design Consultancy, Installation, Supervision, Maintenance.</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>