<section id="slider" class="slider-element h-auto">
   <div class="slider-inner">
      <div class="owl-carousel carousel-widget" data-margin="0" data-items="1" data-pagi="true" data-loop="true" data-animate-in="fadeIn" data-speed="450" data-animate-out="fadeOut" data-autoplay="5000">
         @foreach($banner as $key => $b)
            <img src="{{ $b->image() }}" alt="Slider {{ $key + 1 }}" class="img-fluid">
         @endforeach
      </div>
   </div>
</section>
<section id="content">
   <div class="content-wrap">
      <div class="container clearfix">
         <div class="heading-block center mb-0">
            <h3 class="text-uppercase">Shop By Brand</h3>
            <span>Find {{ $brand->count() }} brand from various products for your needs</span>
         </div>
         <div id="oc-clients" class="owl-carousel image-carousel carousel-widget" data-margin="20" data-nav="false" data-pagi="true" data-items-xs="2" data-items-sm="3" data-items-md="4" data-items-lg="5" data-items-xl="5">
            @foreach($brand as $b)
               <div class="oc-item">
                  <a href="{{ url('product?brand=' . $b->code) }}">
                     <img src="{{ $b->image() }}" class="img-fluid" alt="{{ $b->name }}">
                  </a>
               </div>
            @endforeach
         </div>
         <div class="clearfix"></div>
         <div class="topmargin-lg row align-items-stretch gutter-30">
            <div class="col-md-12"><hr style="border: 1px solid #51b4ba; height:2px; background:#51b4ba;"></div>
            <div class="col-md-7">
               <div class="row gutter-30">
                  <div class="col-md-4">
                     <a href="{{ url('product?brand=SM') }}" class="grid-inner d-block text-center">
                        <img src="{{ asset('website/home-top-smartmarble.jpg') }}" class="banner-grid img-fluid">
                     </a>
                  </div>
                  <div class="col-md-4">
                     <a href="{{ url('product?brand=KH') }}" class="grid-inner d-block text-center">
                        <img src="{{ asset('website/home-top-treeme.jpg') }}" style="background-position: center top;" class="banner-grid img-fluid">
                     </a>
                  </div>
                  <div class="col-md-4">
                     <a href="{{ url('product?brand=BV') }}" class="grid-inner d-block text-center">
                        <img src="{{ asset('website/home-top-bravat.jpg') }}" style="background-position: center top;" class="banner-grid img-fluid">
                     </a>
                  </div>
               </div>
            </div>
            <div class="col-md-5">
               <div class="text-right">
                  <h3 class="font-weight-bold mb-0">We Have The Strong Portfolio</h3>
                  <h3 class="font-weight-bold">From The Greatest Brand</h3>
                  <a href="{{ url('information/product_catalog') }}" class="button button-aqua">View Catalog</a>
               </div>
            </div>
            <div class="col-md-12"><hr style="border: 1px solid #51b4ba; height:2px; background:#51b4ba;"></div>
         </div>
         <div class="clearfix"></div>
         <div class="topmargin-lg fancy-title title-border title-center">
            <h3 class="text-uppercase">Best Offer</h3>
         </div>
         <div id="shop" class="shop row grid-container gutter-30">
            @foreach($product_cheapest as $p)
               <div class="product col-lg-3 col-6">
                  <div class="grid-inner border">
                     <div class="product-image">
                        <a href="{{ url('product/detail/' . base64_encode($p->id)) }}">
                           <img src="{{ $p->type->image() }}" alt="{{ $p->code() }}" class="img-fluid product-thumbnail">
                        </a>
                        <div class="sale-flash badge {{ $p->availability()->color }} p-2">{{ $p->availability()->status }}</div>
                     </div>
                     <div class="product-desc p-3">
                        <div class="product-price font-weight-bold">
                           <ins class="text-dark">
                              <h1 style="font-size:17px;" class="mb-0 font-weight-bold">Rp {{ number_format($p->price(), 0, ',', '.') }}</h1>
                           </ins>
                        </div>
                        <div class="product-title">
                           <h4 class="mb-0 font-weight-normal limit-text-list-product">
                              <a href="{{ url('product/detail/' . base64_encode($p->id)) }}" class="font-wight-semibold text-danger" style="font-size:13.5px;">{{ $p->code() }}</a>
                           </h4>
                        </div>
                        <div class="product-price font-weight-semibold">
                           <span>
                              <span class="text-warning">{{ $p->brand->name }}</span> | <span class="text-info">{{ $p->type->length }}x{{ $p->type->width }}</span>
                           </span>
                        </div>
                     </div>
                  </div>
               </div>
            @endforeach
            <div class="col-12">
               <div class="text-center mt-4">
                  <a href="{{ url('product?sort=low_to_high') }}" class="button button-3d button-rounded button-yellow bg-yellow button-large">More Product</a>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
         <div class="topmargin-lg fancy-title title-border title-center">
            <h3 class="text-uppercase">New Arrival</h3>
         </div>
         <div id="shop" class="shop row grid-container gutter-30">
            @foreach($product_new as $p)
               <div class="product col-lg-3 col-6">
                  <div class="grid-inner border">
                     <div class="product-image">
                        <a href="{{ url('product/detail/' . base64_encode($p->id)) }}">
                           <img src="{{ $p->type->image() }}" alt="{{ $p->code() }}" class="img-fluid product-thumbnail">
                        </a>
                        <div class="sale-flash badge {{ $p->availability()->color }} p-2">{{ $p->availability()->status }}</div>
                     </div>
                     <div class="product-desc p-3">
                        <div class="product-price font-weight-bold">
                           <ins class="text-dark">
                              <h1 style="font-size:17px;" class="mb-0 font-weight-bold">Rp {{ number_format($p->price(), 0, ',', '.') }}</h1>
                           </ins>
                        </div>
                        <div class="product-title">
                           <h4 class="mb-0 font-weight-normal limit-text-list-product">
                              <a href="{{ url('product/detail/' . base64_encode($p->id)) }}" class="font-wight-semibold text-danger" style="font-size:13.5px;">{{ $p->code() }}</a>
                           </h4>
                        </div>
                        <div class="product-price font-weight-semibold">
                           <span>
                              <span class="text-warning">{{ $p->brand->name }}</span> | <span class="text-info">{{ $p->type->length }}x{{ $p->type->width }}</span>
                           </span>
                        </div>
                     </div>
                  </div>
               </div>
            @endforeach
            <div class="col-12">
               <div class="text-center mt-4">
                  <a href="{{ url('product?sort=newest') }}" class="button button-3d button-rounded button-yellow bg-yellow button-large">More Product</a>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
         <div class="topmargin-lg fancy-title title-border title-center">
            <h3 class="text-uppercase">Product Limited</h3>
         </div>
         <div id="shop" class="shop row grid-container gutter-30">
            @foreach($product_limited as $p)
               <div class="product col-lg-3 col-6">
                  <div class="grid-inner border">
                     <div class="product-image">
                        <a href="{{ url('product/detail/' . base64_encode($p->id)) }}">
                           <img src="{{ $p->type->image() }}" alt="{{ $p->code() }}" class="img-fluid product-thumbnail">
                        </a>
                        <div class="sale-flash badge {{ $p->availability()->color }} p-2">{{ $p->availability()->status }}</div>
                     </div>
                     <div class="product-desc p-3">
                        <div class="product-price font-weight-bold">
                           <ins class="text-dark">
                              <h1 style="font-size:17px;" class="mb-0 font-weight-bold">Rp {{ number_format($p->price(), 0, ',', '.') }}</h1>
                           </ins>
                        </div>
                        <div class="product-title">
                           <h4 class="mb-0 font-weight-normal limit-text-list-product">
                              <a href="{{ url('product/detail/' . base64_encode($p->id)) }}" class="font-wight-semibold text-danger" style="font-size:13.5px;">{{ $p->code() }}</a>
                           </h4>
                        </div>
                        <div class="product-price font-weight-semibold">
                           <span>
                              <span class="text-warning">{{ $p->brand->name }}</span> | <span class="text-info">{{ $p->type->length }}x{{ $p->type->width }}</span>
                           </span>
                        </div>
                     </div>
                  </div>
               </div>
            @endforeach
            <div class="col-12">
               <div class="text-center mt-4">
                  <a href="{{ url('product?stock=limited') }}" class="button button-3d button-rounded button-yellow bg-yellow button-large">More Product</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="section mt-0 mb-0">
      <div class="container">
         <center>
            <img src="{{ asset('website/banner-bottom.jpg') }}" class="img-fluid img-thumbnail">
         </center>
      </div>
   </div>
</section>