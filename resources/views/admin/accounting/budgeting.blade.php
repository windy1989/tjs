<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Accounting Budgeting</span>
				</h4>
			</div>
			<div class="header-elements">
				<div class="d-flex justify-content-center">
					<button type="button" class="btn bg-success btn-labeled mr-2 btn-labeled-left" onclick="loadDataTable()">
						<b><i class="icon-sync"></i></b> Refresh Data
					</button>
					<button type="button" class="btn bg-primary btn-labeled btn-labeled-left" onclick="cancel()" data-toggle="modal" data-target="#modal_form">
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
					<span class="breadcrumb-item active">Budgeting</span>
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
            <div class="form-group">
               <label>Date :</label>
               <div class="input-group-prepend">
                  <input type="month" name="filter_start_date" id="filter_start_date" class="form-control">
                  <span class="input-group-text">to</span>
                  <input type="month" name="filter_finish_date" id="filter_finish_date" class="form-control">
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
				<h5 class="card-title">List Data Budgeting</h5>
			</div>
			<div class="card-body">
            <div class="table-responsive">
               <table id="datatable_serverside" class="table table-bordered table-striped w-100 display nowrap">
                  <thead class="bg-dark">
                     <tr class="text-center">
                        <th>No</th>
                        <th>COA</th>
                        <th>Date</th>
                        <th>Nominal</th>
                        <th>Action</th>
                     </tr>
                  </thead>
               </table>
            </div>
			</div>
		</div>
	</div>

<div class="modal fade" id="modal_form" data-backdrop="static" role="dialog">
   <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header bg-light">
            <h5 class="modal-title" id="exampleModalLabel">Form Budgeting</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form id="form_data">
               <div class="alert alert-danger" id="validation_alert" style="display:none;">
                  <ul id="validation_content"></ul>
               </div>
               <div class="form-group">
                  <label>COA :<span class="text-danger">*</span></label>
                  <select name="coa_id" id="coa_id" class="select2">
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
               <div class="form-group">
                  <label>Month :<span class="text-danger">*</span></label>
                  <input type="month" name="month" id="month" class="form-control">
               </div>
               <div class="form-group">
                  <label>Nominal :<span class="text-danger">*</span></label>
                  <input type="number" name="nominal" id="nominal" class="form-control" placeholder="0">
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="icon-switch2"></i> Close</button>
            <button type="button" class="btn bg-danger" id="btn_cancel" onclick="cancel()" style="display:none;"><i class="icon-cross3"></i> Cancel</button>
            <button type="button" class="btn bg-warning" id="btn_update" onclick="update()" style="display:none;"><i class="icon-pencil7"></i> Save</button>
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
      $('#filter_start_date').val(null);
      $('#filter_finish_date').val(null);
      loadDataTable();
   }

   function cancel() {
      reset();
      $('#modal_form').modal('hide');
      $('#btn_create').show();
      $('#btn_update').hide();
      $('#btn_cancel').hide();
   }

   function toShow() {
      $('#modal_form').modal('show');
      $('#validation_alert').hide();
      $('#validation_content').html('');
      $('#btn_create').hide();
      $('#btn_update').show();
      $('#btn_cancel').show();
   }

   function reset() {
      $('#form_data').trigger('reset');
      $('#coa_id').val(null).change();
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
         order: [[1, 'asc']],
         ajax: {
            url: '{{ url("admin/accounting/budgeting/datatable") }}',
            type: 'POST',
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
               coa: $('#filter_coa').val(),
               start_date: $('#filter_start_date').val(),
               finish_date: $('#filter_finish_date').val()
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
            { name: 'coa_id', className: 'text-center align-middle' },
            { name: 'month', searchable: false, className: 'text-center align-middle' },
            { name: 'nominal', searchable: false, className: 'text-center align-middle' },
            { name: 'action', searchable: false, orderable: false, className: 'text-center nowrap align-middle' }
         ]
      }); 
   }

   function create() {
      $.ajax({
         url: '{{ url("admin/accounting/budgeting/create") }}',
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

   function show(id) {
      toShow();
      $.ajax({
         url: '{{ url("admin/accounting/budgeting/show") }}',
         type: 'POST',
         dataType: 'JSON',
         data: {
            id: id
         },
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         beforeSend: function() {
            loadingOpen('.modal-content');
         },
         success: function(response) {
            loadingClose('.modal-content');
            $('#coa_id').val(response.coa_id).change();
            $('#month').val(response.month);
            $('#nominal').val(response.nominal);
            $('#btn_update').attr('onclick', 'update(' + id + ')');
         },
         error: function() {
            cancel();
            loadingClose('.modal-content');
            swalInit.fire({
               title: 'Server Error',
               text: 'Please contact developer',
               type: 'error'
            });
         }
      });
   }

   function update(id) {
      $.ajax({
         url: '{{ url("admin/accounting/budgeting/update") }}' + '/' + id,
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

   function destroy(id) {
      var notyConfirm = new Noty({
         theme: 'limitless',
         text: '<h6 class="font-weight-bold mb-3">Are sure you want to delete?</h6><label>Deleted data can no longer be recovered.</label>',
         timeout: false,
         modal: true,
         layout: 'center',
         closeWith: 'button',
         type: 'confirm',
         buttons: [
            Noty.button('<i class="icon-cross3"></i>', 'btn bg-danger', function() {
               notyConfirm.close();
            }),
            Noty.button('<i class="icon-trash"></i>', 'btn bg-success ml-1', function() {
               $.ajax({
                  url: '{{ url("admin/accounting/budgeting/destroy") }}',
                  type: 'POST',
                  dataType: 'JSON',
                  data: {
                     id: id
                  },
                  headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(response) {
                     if(response.status == 200) {
                        $('#datatable_serverside').DataTable().ajax.reload(null, false);
                        notif('success', 'bg-success', response.message);
                        notyConfirm.close();
                     } else {
                        notif('error', 'bg-danger', response.message);
                     }
                  },
                  error: function() {
                     swalInit.fire({
                        title: 'Server Error',
                        text: 'Please contact developer',
                        type: 'error'
                     });
                  }
               });
            })
         ]
      }).show();
   }
</script>