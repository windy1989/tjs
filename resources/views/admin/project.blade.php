<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Project</span>
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
					<span class="breadcrumb-item active">Project</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
		<div class="card">
			<div class="card-body">
            <div class="table-responsive">
               <table id="datatable_serverside" class="table table-bordered table-striped w-100">
                  <thead class="bg-dark">
                     <tr class="text-center">
                        <th>No</th>
                        <th>User</th>
                        <th>Name</th>
                        <th>Progress</th>
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
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Color</h5>
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
                  <label>Code :<span class="text-danger">*</span></label>
                  <input type="text" name="code" id="code" class="form-control" placeholder="Enter code">
               </div>
               <div class="form-group">
                  <label>Name :<span class="text-danger">*</span></label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Enter name">
               </div>
               <div class="form-group text-center mt-4">
                  <div class="form-check form-check-inline">
                     <label class="form-check-label">
                        <input type="radio" class="form-check-input-styled-danger" name="status" value="2" data-fouc>
                        Not Active
                     </label>
                  </div>
                  <div class="form-check form-check-inline">
                     <label class="form-check-label">
                        <input type="radio" class="form-check-input-styled-success" name="status" value="1" checked data-fouc>
                        Active
                     </label>
                  </div>
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
            url: '{{ url("admin/project/datatable") }}',
            type: 'POST',
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
               status: $('#filter_status').val()
            },
            beforeSend: function() {
               loadingOpen('#datatable_serverside');
            },
            complete: function() {
               loadingClose('#datatable_serverside');
            },
            error: function() {
               loadingClose('#datatable_serverside');
               swalInit({
                  title: 'Server Error',
                  text: 'Please contact developer',
                  type: 'error'
               });
            }
         },
         columns: [
            { name: 'id', searchable: false, className: 'text-center align-middle' },
            { name: 'user_id', className: 'text-center align-middle' },
            { name: 'name', className: 'text-center align-middle' },
            { name: 'progress', searchable: false, className: 'text-center align-middle' },
            { name: 'action', searchable: false, orderable: false, className: 'text-center nowrap align-middle' }
         ]
      }); 
   }

   function create() {
      $.ajax({
         url: '{{ url("admin/master_data/color/create") }}',
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
            swalInit({
               title: 'Server Error',
               text: 'Please contact developer',
               type: 'error'
            });
         }
      });
   }
</script>