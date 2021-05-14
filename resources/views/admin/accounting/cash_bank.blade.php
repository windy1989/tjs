<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Accounting Cash & Bank</span>
				</h4>
			</div>
			<div class="header-elements">
				<div class="d-flex justify-content-center">
					<button type="button" class="btn bg-success btn-labeled mr-2 btn-labeled-left" onclick="loadDataTable()">
						<b><i class="icon-sync"></i></b> Refresh Data
					</button>
					<button type="button" class="btn bg-primary btn-labeled btn-labeled-left" onclick="reset()" data-toggle="modal" data-target="#modal_form">
						<b><i class="icon-plus3"></i></b> Add Data
					</button>
				</div>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<a href="javascript:void(0);" class="breadcrumb-item">Accounting</a>
					<span class="breadcrumb-item active">Cash & Bank</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
      <div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title">Filter</h5>
			</div>
         <div class="card-body">
            <div class="row">
               <div class="col-md-9">
                  <div class="form-group">
                     <label>COA :<span class="text-danger">*</span></label>
                     <select name="filter_coa" id="filter_coa" class="select2">
                        <option value="">-- Choose --</option>
                        @foreach($parent as $p)
                           @php $sub_1 = App\Models\Coa::where('parent_id', $p->id)->where('status', 1)->oldest('code')->get(); @endphp
                           @if($sub_1->count() > 0)
                              @foreach($sub_1 as $s1)
                                 @php $sub_2 = App\Models\Coa::where('parent_id', $s1->id)->where('status', 1)->oldest('code')->get(); @endphp
                                 @if($sub_2->count() > 0)
                                    @foreach($sub_2 as $s2)
                                       @php $sub_3 = App\Models\Coa::where('parent_id', $s2->id)->where('status', 1)->oldest('code')->get(); @endphp
                                       @if($sub_3->count() > 0)
                                          @foreach($sub_3 as $s3)
                                             <option value="{{ $s3->id }}">{{ $s3->name }}</option>
                                          @endforeach
                                       @else
                                          <option value="{{ $s2->id }}">{{ $s2->name }}</option>
                                       @endif
                                    @endforeach
                                 @else
                                    <option value="{{ $s1->id }}">{{ $s1->name }}</option>
                                 @endif
                              @endforeach
                           @else
                              <option value="{{ $p->id }}">{{ $p->name }}</option>
                           @endif
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="form-group">
                     <label>User :</label>
                     <select name="filter_user_id" id="filter_user_id" class="select2">
                        <option value="">All</option>
                        @foreach($user as $u)
                           <option value="{{ $u->id }}">{{ $u->name }}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Date :</label>
                     <div class="input-group-prepend">
                        <input type="date" name="filter_start_date" id="filter_start_date" class="form-control">
                        <span class="input-group-text">to</span>
                        <input type="date" name="filter_finish_date" id="filter_finish_date" class="form-control">
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label>Nominal :</label>
                     <div class="input-group-prepend">
                        <input type="number" name="filter_start_date" id="filter_start_nominal" class="form-control" placeholder="0">
                        <span class="input-group-text">-</span>
                        <input type="number" name="filter_finish_date" id="filter_finish_nominal" class="form-control" placeholder="0">
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group text-right">
               <div class="form-check form-check-inline">
                  <label class="form-check-label">
                     <input type="radio" class="form-check-input-styled-success" name="filter_type" checked data-fouc>
                     All
                  </label>
               </div>
               <div class="form-check form-check-inline">
                  <label class="form-check-label">
                     <input type="radio" class="form-check-input-styled-success" name="filter_type" value="1" data-fouc>
                     Cash
                  </label>
               </div>
               <div class="form-check form-check-inline">
                  <label class="form-check-label">
                     <input type="radio" class="form-check-input-styled-success" name="filter_type" value="2" data-fouc>
                     Bank
                  </label>
               </div>
            </div>
            <div class="form-group text-right">
               <button type="button" onclick="resetFilter()" class="btn bg-danger"><i class="icon-sync"></i> Reset</button>
               <button type="button" onclick="loadDataTable()" class="btn bg-purple"><i class="icon-filter4"></i> Search</button>
            </div>
         </div>
      </div>
		<div class="card">
			<div class="card-header header-elements-inline mb-3">
				<h5 class="card-title">List Data Cash & Bank</h5>
			</div>
			<div class="card-body">
            <div class="table-responsive">
               <table id="datatable_serverside" class="table table-bordered table-striped w-100">
                  <thead class="bg-dark">
                     <tr class="text-center">
                        <th>No</th>
                        <th>User</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Nominal</th>
                        <th>Date</th>
                        <th>Description</th>
                     </tr>
                  </thead>
               </table>
            </div>
			</div>
		</div>
	</div>

<div class="modal fade" id="modal_form" data-backdrop="static" role="dialog">
   <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header bg-light">
            <h5 class="modal-title" id="exampleModalLabel">Form Cash & Bank</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form id="form_data">
               <div class="alert alert-danger" id="validation_alert" style="display:none;">
                  <ul id="validation_content"></ul>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Debit :<span class="text-danger">*</span></label>
                        <select name="debit" id="debit" class="select2">
                           <option value="">-- Choose --</option>
                           @foreach($parent as $p)
                              @php $sub_1 = App\Models\Coa::where('parent_id', $p->id)->where('status', 1)->oldest('code')->get(); @endphp
                              @if($sub_1->count() > 0)
                                 @foreach($sub_1 as $s1)
                                    @php $sub_2 = App\Models\Coa::where('parent_id', $s1->id)->where('status', 1)->oldest('code')->get(); @endphp
                                    @if($sub_2->count() > 0)
                                       @foreach($sub_2 as $s2)
                                          @php $sub_3 = App\Models\Coa::where('parent_id', $s2->id)->where('status', 1)->oldest('code')->get(); @endphp
                                          @if($sub_3->count() > 0)
                                             @foreach($sub_3 as $s3)
                                                <option value="{{ $s3->id }}">{{ $s3->name }}</option>
                                             @endforeach
                                          @else
                                             <option value="{{ $s2->id }}">{{ $s2->name }}</option>
                                          @endif
                                       @endforeach
                                    @else
                                       <option value="{{ $s1->id }}">{{ $s1->name }}</option>
                                    @endif
                                 @endforeach
                              @else
                                 <option value="{{ $p->id }}">{{ $p->name }}</option>
                              @endif
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Credit :<span class="text-danger">*</span></label>
                        <select name="credit" id="credit" class="select2">
                           <option value="">-- Choose --</option>
                           @foreach($parent as $p)
                              @php $sub_1 = App\Models\Coa::where('parent_id', $p->id)->where('status', 1)->oldest('code')->get(); @endphp
                              @if($sub_1->count() > 0)
                                 @foreach($sub_1 as $s1)
                                    @php $sub_2 = App\Models\Coa::where('parent_id', $s1->id)->where('status', 1)->oldest('code')->get(); @endphp
                                    @if($sub_2->count() > 0)
                                       @foreach($sub_2 as $s2)
                                          @php $sub_3 = App\Models\Coa::where('parent_id', $s2->id)->where('status', 1)->oldest('code')->get(); @endphp
                                          @if($sub_3->count() > 0)
                                             @foreach($sub_3 as $s3)
                                                <option value="{{ $s3->id }}">{{ $s3->name }}</option>
                                             @endforeach
                                          @else
                                             <option value="{{ $s2->id }}">{{ $s2->name }}</option>
                                          @endif
                                       @endforeach
                                    @else
                                       <option value="{{ $s1->id }}">{{ $s1->name }}</option>
                                    @endif
                                 @endforeach
                              @else
                                 <option value="{{ $p->id }}">{{ $p->name }}</option>
                              @endif
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Date :<sup class="text-danger">*</sup></label>
                        <input type="date" name="date" id="date" class="form-control">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Nominal :<sup class="text-danger">*</sup></label>
                        <input type="number" name="nominal" id="nominal" class="form-control" placeholder="0">
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label>Description :<sup class="text-danger">*</sup></label>
                  <textarea name="description" id="description" style="resize:none;" class="form-control" placeholder="Enter description"></textarea>
               </div>
               <div class="form-group text-center mt-4">
                  <div class="form-check form-check-inline">
                     <label class="form-check-label">
                        <input type="radio" class="form-check-input-styled-info" name="type" value="1" checked data-fouc>
                        Cash
                     </label>
                  </div>
                  <div class="form-check form-check-inline">
                     <label class="form-check-label">
                        <input type="radio" class="form-check-input-styled-info" name="type" value="2" data-fouc>
                        Bank
                     </label>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="icon-switch2"></i> Close</button>
            <button type="button" class="btn bg-primary" id="btn_create" onclick="create()"><i class="icon-plus3"></i> Add</button>
         </div>
      </div>
   </div>
</div>

<script>
   $(function() {
      loadDataTable();
   });

   function resetFilter() {
      $('#filter_coa').val(null).trigger('change');
      $('#filter_user_id').val(null).trigger('change');
      $('#filter_start_date').val(null);
      $('#filter_finish_date').val(null);
      $('#filter_start_nominal').val(null);
      $('#filter_finish_nominal').val(null);
      $('input[name="status"][value=""]').prop('checked', true);
      loadDataTable();
   }

  function reset() {
      $('#form_data').trigger('reset');
      $('#debit').val(null).change();
      $('#credit').val(null).change();
      $('input[name="type"][value="1"]').attr('checked', true);
      $('#validation_alert').hide();
      $('#validation_content').html('');
   }

  function success() {
      reset();
      $('#modal_form').modal('hide');
      $('#datatable_serverside').DataTable().ajax.reload(null, false);
   }

   function loadDataTable() {
      $('#datatable_serverside').DataTable({
         serverSide: true,
         deferRender: true,
         destroy: true,
         iDisplayInLength: 10,
         order: [[0, 'asc']],
         ajax: {
            url: '{{ url("admin/accounting/cash_bank/datatable") }}',
            type: 'POST',
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
               coa: $('#filter_coa').val(),
               user_id: $('#filter_user_id').val(),
               start_date: $('#filter_start_date').val(),
               finish_date: $('#filter_finish_date').val(),
               start_nominal: $('#filter_start_nominal').val(),
               finish_nominal: $('#filter_finish_nominal').val(),
               type: $('#filter_type').val()
            },
            beforeSend: function() {
               loadingOpen('#datatable_serverside');
            },
            complete: function() {
               loadingClose('#datatable_serverside');
            },
            error: function() {
               loadingClose('#datatable_serverside');
               swalInit.fire({
                  title: 'Server Error',
                  text: 'Please contact developer',
                  type: 'error'
               });
            }
         },
         columns: [
            { name: 'id', searchable: false, className: 'text-center align-middle' },
            { name: 'user_id', className: 'text-center align-middle' },
            { name: 'debit', className: 'text-center align-middle' },
            { name: 'credit', className: 'text-center align-middle' },
            { name: 'nominal', searchable: false, className: 'text-center align-middle' },
            { name: 'date', searchable: false, className: 'text-center align-middle' },
            { name: 'description', className: 'text-center align-middle' }
         ]
      }); 
   }

   function create() {
      $.ajax({
         url: '{{ url("admin/accounting/cash_bank/create") }}',
         type: 'POST',
         dataType: 'JSON',
         data: $('#form_data').serialize(),
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         beforeSend: function() {
            $('#validation_alert').hide();
            $('#validation_content').html('');
            loadingOpen('.modal-content');
         },
         success: function(response) {
            loadingClose('.modal-content');
            if(response.status == 200) {
               success();
               notif('success', 'bg-success', response.message);
            } else if(response.status == 422) {
               $('#validation_alert').show();
               $('.modal-body').scrollTop(0);
               notif('warning', 'bg-warning', 'Validation');
               
               $.each(response.error, function(i, val) {
                  $.each(val, function(i, val) {
                     $('#validation_content').append(`
                        <li>` + val + `</li>
                     `);
                  });
               });
            } else {
               notif('error', 'bg-danger', response.message);
            }
         },
         error: function() {
            $('.modal-body').scrollTop(0);
            loadingClose('.modal-content');
            swalInit.fire({
               title: 'Server Error',
               text: 'Please contact developer',
               type: 'error'
            });
         }
      });
   }
</script>