<section id="page-title" class="page-title-mini">
   <div class="container clearfix">
      <h1>Career</h1>
      <ol class="breadcrumb font-size-12">
         <li class="breadcrumb-item">
            <a href="{{ url('/') }}">Home</a>
         </li>
         <li class="breadcrumb-item active" aria-current="page">
            Career
         </li>
      </ol>
   </div>
</section>
<section id="content">
   <div class="content-wrap">
      <div class="container clearfix">
         <div id="posts" class="row grid-container gutter-30">
            @if($career->count() > 0)
               @foreach($career as $c)
                  <div class="entry col-12">
                     <div class="grid-inner">
                        <div class="entry-title">
                           <h2>
                              <a href="javascript:void(0);">{{ $c->title }}</a>
                           </h2>
                        </div>
                        <div class="entry-meta">
                           <ul>
                              <li>
                                 <i class="icon-calendar3"></i> Deadline : {{ date('d F Y', strtotime($c->deadline)) }}
                              </li>
                              <li>
                                 <a href="javascript:void(0);">{!! $c->status() !!}</a>
                              </li>
                           </ul>
                        </div>
                        <div class="entry-content">
                           <h5>Description</h5>
                           {!! $c->description !!}
                           <div class="form-group"><hr></div>
                           <h5>Requirements</h5>
                           {!! $c->requirements !!}
                        </div>
                     </div>
                  </div>
               @endforeach
            @else
               <div class="entry col-12">
                  <div class="text-center">
                     <div class="alert alert-warning">Career not found</div>
                  </div>
               </div>
            @endif
         </div>
      </div>
   </div>
</section>