<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">HRD Job Desc</span>
				</h4>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<a href="javascript:void(0);" class="breadcrumb-item">HRD</a>
					<span class="breadcrumb-item active">Job Desc</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
      <ul class="nav nav-pills nav-pills-bordered nav-justified">
         <li class="nav-item">
            <a href="#job_desc_surabaya" class="nav-link active" data-toggle="tab">Surabaya</a>
         </li>
         <li class="nav-item">
            <a href="#job_desc_jakarta" class="nav-link" data-toggle="tab">Jakarta</a>
         </li>
      </ul>
      <div class="tab-content">
         <div class="tab-pane fade show active" id="job_desc_surabaya">
            <div class="card-group-control card-group-control-right">
               @foreach($job_desc_sby as $jds)
                  <div class="card mb-2">
                     <div class="card-header">
                        <h6 class="card-title">
                           <a class="text-default collapsed" data-toggle="collapse" href="#job-{{ $jds->id }}">
                              {{ $jds->position() }}
                           </a>
                        </h6>
                     </div>
                     <div id="job-{{ $jds->id }}" class="collapse">
                        <div class="card-body">
                           {!! $jds->job !!}
                        </div>
                     </div>
                  </div>
               @endforeach
            </div>
         </div>
         <div class="tab-pane fade" id="job_desc_jakarta">
            @foreach($job_desc_jkt as $jdj)
               <div class="card mb-2">
                  <div class="card-header">
                     <h6 class="card-title">
                        <a class="text-default collapsed" data-toggle="collapse" href="#job-{{ $jdj->id }}">
                           {{ $jdj->position() }}
                        </a>
                     </h6>
                  </div>
                  <div id="job-{{ $jdj->id }}" class="collapse">
                     <div class="card-body">
                        {!! $jdj->job !!}
                     </div>
                  </div>
               </div>
            @endforeach
         </div>
      </div>
	</div>