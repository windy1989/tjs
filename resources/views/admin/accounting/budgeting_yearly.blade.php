<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i>
					<span class="font-weight-semibold">Create New Budgeting</span>
				</h4>
			</div>
			<div class="header-elements">
				<div class="d-flex justify-content-center">
					<a href="{{ url('admin/accounting/budgeting') }}" class="btn bg-secondary btn-labeled btn-labeled-left">
						<b><i class="icon-arrow-left7"></i></b> Back To List
					</a>
				</div>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<a href="javascript:void(0);" class="breadcrumb-item">Accounting</a>
					<a href="{{ url('admin/accounting/budgeting') }}" class="breadcrumb-item">Budgeting</a>
					<span class="breadcrumb-item active">Create Yearly</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
      @if($errors->any())
         <div class="alert bg-warning text-white alert-styled-left alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            <ul>
               @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
      @elseif(session('success'))
         <div class="alert bg-success text-white alert-styled-left alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            <span class="font-weight-semibold">Success!</span> {{ session('success') }}
         </div>
      @elseif(session('failed'))
         <div class="alert bg-danger text-white alert-styled-left alert-dismissible">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            <span class="font-weight-semibold">Failed!</span> {{ session('failed') }}
         </div>
      @endif
		<div class="card">
			<div class="card-body">
            <form action="" method="POST" id="form_data">
               @csrf
               <div class="row justify-content-center">
                  <div class="col-md-4">
                     <div class="form-group mb-0">
                        <select name="coa_id" id="coa_id" class="select2">
                           <option value="">-- Choose Coa --</option>
                           @foreach($coa as $key => $c)
                              <option value="{{ $c->id }}" {{ old('coa_id') == $c->id ? 'selected' : '' }}>[{{ $c->code }}] {{ $c->name }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group mb-0">
                        <input type="number" name="year" id="year" class="form-control" placeholder="Enter year" value="{{ old('year') }}">
                     </div>
                  </div>
               </div>
               <div class="form-group"><hr></div>
               @for($i = 1; $i <= 12; $i++)
                  <div class="row justify-content-center">
                     <div class="col-md-8">
                        <div class="form-group row">
                           <label class="col-form-label col-lg-2">{{ date('F', strtotime(date('Y') . '-' . $i)) }}</label>
                           <div class="col-lg-10">
                              <input type="hidden" name="month[]" id="month" value="{{ $i }}">
                              @php $nominal = old('nominal') ? old('nominal')[$i - 1] : null; @endphp
                              <input type="number" name="nominal[]" id="nominal" class="form-control" placeholder="Enter nominal" value="{{ $nominal }}">
                           </div>
                        </div>
                     </div>
                  </div>
               @endfor
               <div class="form-group"><hr></div>
               <div class="form-group text-right">
                  <button type="reset" id="btn_reset" class="btn bg-danger btn-labeled btn-labeled-left">
                     <b><i class="icon-sync"></i></b> Reset Form
                  </button>
                  <button type="submit" id="btn_submit" class="btn bg-primary btn-labeled btn-labeled-left">
                     <b><i class="icon-plus3"></i></b> Create
                  </button>
               </div>
            </form>
			</div>
		</div>
	</div>

<script>
   $(function() {
      $('#btn_submit').click(function() {
         $('#btn_reset').attr('disabled', true);
         $('#btn_submit').attr('disabled', true);
         $('#btn_submit').html('<b><i class="icon-spinner4 spinner"></i></b> Processed ...');
         $('#form_data').submit();
      });
   });
</script>
