<div class="row no-gutters" style="border-bottom:2px solid #51b4ba;">
   <div class="bg-white col-6">
      <div class="jumbotron jumbotron-fluid bg-white">
         <div class="container">
            <div class="row banner">
               <div class="col-xl-6 col-md-8">
                  <div class="text-right font-weight-bold" style="font-size:25px; vertical-align:center; color:#000 !important;">
                     <div class="heading-banner">Everyone,</div>
                     <div class="heading-banner">Everytime & Everywhere</div>
                     <div class="heading-banner">Personalize Your Home</div>
                     <a href="{{ url('product') }}" class="button button-mini button-3d button-circle bg-teal">Shop Now</a>
                     <div>
                        <div class="circle-element bg-teal mt-0"></div>
                        <div class="circle-element bg-danger mt-0"></div>
                        <div class="circle-element bg-warning mt-0"></div>
                     </div>
                     <p style="font-size:12px;" class="mt-3 font-weight-semibold">
                        Dapatkan cashback senilai Rp.500.000,- serta merchandise dari <br>Smart Marble & Bath
                     </p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-6">
      <a href="javascript:void(0);" class="cursor-none">
         <img src="{{ asset('website/banner-1.png') }}" class="img-fluid w-100" alt="Slider">
      </a>
   </div>
</div>
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
                  <h3 class="font-weight-bold mb-0">
                     <span class="font-weight-normal text-dark">We Have The</span> Strong Portfolio
                  </h3>
                  <h3 class="font-weight-bold">
                     <span class="font-weight-normal text-dark">From The</span> Greatest Brand
                  </h3>
                  <a href="{{ url('information/product_catalog') }}" class="button button-mini button-3d button-circle button-large bg-teal">View Catalog</a>
                  <div class="mt-3">
                     <div class="circle-element bg-teal"></div>
                     <div class="circle-element bg-danger"></div>
                     <div class="circle-element bg-warning"></div>
                  </div>
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
               <div class="product col-lg-2 col-md-4 col-6">
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
                  <a href="{{ url('product?sort=low_to_high') }}" class="button button-3d button-circle button-yellow bg-yellow button-large">More Product</a>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
         <div class="topmargin-lg fancy-title title-border title-center">
            <h3 class="text-uppercase">New Arrival</h3>
         </div>
         <div id="shop" class="shop row grid-container gutter-30">
            @foreach($product_new as $p)
               <div class="product col-lg-2 col-md-4 col-6">
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
                  <a href="{{ url('product?sort=newest') }}" class="button button-3d button-circle button-yellow bg-yellow button-large">Discover More</a>
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
         <div class="topmargin-lg fancy-title title-border title-center">
            <h3 class="text-uppercase">Product Limited</h3>
         </div>
         <div id="shop" class="shop row grid-container gutter-30">
            @foreach($product_limited as $p)
               <div class="product col-lg-2 col-md-4 col-6">
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
                  <a href="{{ url('product?stock=limited') }}" class="button button-3d button-circle button-yellow bg-yellow button-large">Explore More</a>
               </div>
            </div>
         </div>
      </div>
      <div class="section bg-white mt-0 mb-0">
         <div class="form-group"><hr style="margin-bottom:80px;"></div>
         <div class="container mb-0">
            <center>
               <img src="{{ asset('website/banner-bottom.jpg') }}" class="img-fluid">
            </center>
         </div>
      </div>
      <div class="section dark bg-light footer-stick mt-0" style="background-color: #444; padding: 35px 0;">
         <div class="container">
            <div class="row col-mb-30 justify-content-center text-center">
               <div class="col-lg-4 col-md-4 col-12">
                  <div class="text-center">
                  </div>
                  <i class="i-large text-center icon-thumbs-up2 text-dark mb-0" style="font-size:30px;"></i>
                  <div class="clear"></div>
                  <div class="counter counter-small text-dark mb-2" style="font-family:'Lato', sans-serif; font-size: 18px;">
                     100% Original
                  </div>
                  <h5 style="font-size: 9px;" class="text-dark">We guarantee you the sale of Original Brands</h5>
               </div>
               <div class="col-lg-4 col-md-4 col-12">
                  <div class="text-center">
                  </div>
                  <i class="i-large text-center icon-line2-home text-dark mb-0" style="font-size:30px;"></i>
                  <div class="clear"></div>
                  <div class="counter counter-small text-dark mb-2" style="font-family:'Lato', sans-serif; font-size: 18px;">
                     Warranty
                  </div>
                  <h5 style="font-size: 9px;" class="text-dark">3 years for Sanitary ware & 2 years for tiles</h5>
               </div>
               <div class="col-lg-4 col-md-4 col-12">
                  <div class="text-center">
                  </div>
                  <i class="i-large text-center icon-user-tie text-dark mb-0" style="font-size:30px;"></i>
                  <div class="clear"></div>
                  <div class="counter counter-small text-dark mb-2" style="font-family:'Lato', sans-serif; font-size: 18px;">
                     Pre & Post Sales Services
                  </div>
                  <h5 style="font-size: 9px;" class="text-dark">Design Consultancy, Installation, Supervision, Maintenance</h5>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>