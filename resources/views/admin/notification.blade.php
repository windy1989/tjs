<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Notification</span>
				</h4>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<span class="breadcrumb-item active">Notification</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
      @if($notification->count() > 0)
         @foreach($notification as $n)
            <div class="card">
               <div class="card-header header-elements-inline">
                  <h5 class="card-title">
                     <a href="{{ $n->link }}" class="text-dark font-weight-semibold">{{ $n->title }}</a>
                  </h5>
                  <div class="header-elements text-dark">
                     {{ date('d F Y, H:i', strtotime($n->created_at)) }}
                  </div>
               </div>
               <div class="card-body text-muted">
                  {{ $n->description }}
               </div>
            </div>
         @endforeach
      @else
         <div class="alert alert-info text-center">Empty</div>
      @endif
      <div class="form-group"><hr></div>
      <div class="form-group">
         {{ $notification->withQueryString()->onEachSide(1)->links('admin.pagination') }}
      </div>
	</div>