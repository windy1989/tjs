<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Update Voucher</span>
				</h4>
			</div>
			<div class="header-elements">
				<div class="d-flex justify-content-center">
					<a href="{{ url('admin/manage/voucher') }}" class="btn bg-secondary btn-labeled btn-labeled-left">
						<b><i class="icon-arrow-left7"></i></b> Back To List
					</a>
				</div>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<a href="javascript:void(0);" class="breadcrumb-item">Manage</a>
					<a href="{{ url('admin/manage/voucher') }}" class="breadcrumb-item">Voucher</a>
					<span class="breadcrumb-item active">Update</span>
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
            <p class="text-danger">
               *) if the type of cashback voucher is <b class="font-italic">Maximum Discount / Point</b> then the customer points that can be obtained are in accordance with the maximum and predetermined percentage, otherwise there will be a discount on shipping costs or the total customer order.
            </p>
            <div class="form-group"><hr></div>
            <form action="" method="POST" id="form_data">
               @csrf
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Name :<span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" value="{{ old('name', $voucher->name) }}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Code :<span class="text-danger">*</span></label>
                        <input type="text" name="code" id="code" class="form-control text-uppercase" placeholder="Enter code" value="{{ old('code', $voucher->code) }}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Minimum Order :<span class="text-danger">*</span></label>
                        <input type="number" name="minimum" id="minimum" class="form-control" placeholder="0" value="{{ old('minimum', $voucher->minimum) }}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Maximum Discount / Point :<span class="text-danger">*</span></label>
                        <input type="number" name="maximum" id="maximum" class="form-control" placeholder="0" value="{{ old('maximum', $voucher->maximum) }}">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Quota :<span class="text-danger">*</span></label>
                        <input type="number" name="quota" id="quota" class="form-control" placeholder="0" value="{{ old('quota', $voucher->quota) }}">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Percentage(%) :<span class="text-danger">*</span></label>
                        <input type="number" name="percentage" id="percentage" max="100" class="form-control" placeholder="0" value="{{ old('percentage', $voucher->percentage) }}">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Type :<span class="text-danger">*</span></label>
                        <select name="type" id="type" class="custom-select">
                           <option value="">-- Choose --</option>
                           <option value="1" {{ old('type', $voucher->type) == 1 ? 'selected' : '' }}>Discount</option>
                           <option value="2" {{ old('type', $voucher->type) == 2 ? 'selected' : '' }}>Cashback</option>
                           <option value="3" {{ old('type', $voucher->type) == 3 ? 'selected' : '' }}>Shipping</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Start Voucher :<span class="text-danger">*</span></label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $voucher->start_date) }}">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Expired Voucher :<span class="text-danger">*</span></label>
                        <input type="date" name="finish_date" id="finish_date" class="form-control" value="{{ old('finish_date', $voucher->finish_date) }}">
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label>Terms & Conditions :<span class="text-danger">*</span></label>
                  <textarea name="terms" id="terms" class="terms">{!! old('terms', $voucher->terms) !!}</textarea>
               </div>
               <div class="form-group"><hr></div>
               <div class="form-group text-right">
                  <button type="reset" id="btn_reset" class="btn bg-danger btn-labeled btn-labeled-left">
                     <b><i class="icon-sync"></i></b> Reset Form
                  </button>
                  <button type="submit" id="btn_submit" class="btn bg-warning btn-labeled btn-labeled-left">
                     <b><i class="icon-pencil7"></i></b> Save
                  </button>
               </div>
            </form>
			</div>
		</div>
	</div>

<script>
   $(function() {
      ckEditor('terms');

      $('#btn_submit').click(function() {
         $('#btn_reset').attr('disabled', true);
         $('#btn_submit').attr('disabled', true);
         $('#btn_submit').html('<b><i class="icon-spinner4 spinner"></i></b> Processed ...');
         $('#form_data').submit();
      });
   });
</script>