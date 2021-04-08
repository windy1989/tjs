   <div class="container-fluid">
      <h1 class="h3 mb-4 text-gray-800">Master Supplier</h1>
      <div class="card shadow">
         <div class="card-header">
            <div class="row">
               <div class="col-md-6">
                  <h6 class="m-0 font-weight-bold mt-2">List Master Supplier</h6>
               </div>
               <div class="col-md-6 text-right">
                  <button type="button" class="btn btn-success btn-icon-split btn-sm" onclick="loadDataTable()">
                     <span class="icon text-white">
                        <i class="fas fa-sync"></i>
                     </span>
                     <span class="text">Refresh Data</span>
                  </button>
                  <button type="button" class="btn btn-primary btn-icon-split btn-sm" onclick="cancel()" data-toggle="modal" data-target="#modal_form">
                     <span class="icon text-white">
                        <i class="fas fa-plus"></i>
                     </span>
                     <span class="text">Add Data</span>
                  </button>
               </div>
            </div>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <table id="datatable_serverside" class="table table-hover table-striped table-bordered display nowrap" width="100%">
                  <thead>
                     <tr class="text-center">
                        <th>No</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Country</th>
                        <th>Limit Credit</th>
                        <th>Status</th>
                        <th>Action</th>
                     </tr>
                  </thead>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modal_form" data-backdrop="static" role="dialog">
   <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Currency</h5>
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
                  <label>Code :</label>
                  <input type="text" name="code" id="code" class="form-control" placeholder="Auto Generate" readonly>
               </div>
               <div class="form-group">
                  <label>Name :<span class="text-danger">*</span></label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Enter name">
               </div>
               <div class="form-group">
                  <label>Country :<span class="text-danger">*</span></label>
                  <select name="country_id" id="country_id" class="select2">
                     <option value="">-- Choose --</option>
                     @foreach($country as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option> 
                     @endforeach
                  </select>
               </div>
               <div class="form-group">
                  <label>Currency :<span class="text-danger">*</span></label>
                  <select name="currency_id" id="currency_id" class="select2" multiple>
                     @foreach($currency as $c)
                        <option value="{{ $c->id }}">{{ $c->code }}</option> 
                     @endforeach
                  </select>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Email :<span class="text-danger">*</span></label>
                        <input type="text" name="email" id="email" class="form-control" placeholder="Enter email">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Phone :<span class="text-danger">*</span></label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter phone">
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <label>Address :<span class="text-danger">*</span></label>
                  <textarea name="address" id="address" class="form-control" placeholder="Enter address" style="resize:none;"></textarea>
               </div>
               <div class="form-group">
                  <label>PIC :<span class="text-danger">*</span></label>
                  <input type="text" name="pic" id="pic" class="form-control" placeholder="Enter PIC">
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Term Of Payment :<span class="text-danger">*</span></label>
                        <input type="number" name="term_of_payment" id="term_of_payment" class="form-control" placeholder="Enter term of payment">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Limit Credit :</label>
                        <input type="text" name="limit_credit" id="limit_credit" class="form-control number" placeholder="Enter limit credit">
                     </div>
                  </div>
               </div>
               <div class="form-group text-center mb-0">
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="status" id="status_not_active" value="2">
                     <label class="form-check-label" for="status_not_active">Not Active</label>
                  </div>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" type="radio" name="status" id="status_active" value="1" checked>
                     <label class="form-check-label" for="status_active">Active</label>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-power-off"></i> Close</button>
            <button type="button" class="btn btn-danger" id="btn_cancel" onclick="cancel()" style="display:none;"><i class="fas fa-times"></i> Cancel</button>
            <button type="button" class="btn btn-warning" id="btn_update" onclick="update()" style="display:none;"><i class="fas fa-save"></i> Save</button>
            <button type="button" class="btn btn-primary" id="btn_create" onclick="create()"><i class="fas fa-plus"></i> Add</button>
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
      return $('#datatable_serverside').DataTable({
         serverSide: true,
         deferRender: true,
         destroy: true,
         iDisplayInLength: 10,
         order: [[0, 'asc']],
         scrollX: true,
         ajax: {
            url: '{{ url("admin/master_data/supplier/datatable") }}',
            type: 'POST',
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
               loadingOpen('#datatable_serverside');
            },
            complete: function() {
               loadingClose('#datatable_serverside');
            },
            error: function() {
               loadingClose('#datatable_serverside');
               Swal.fire('Server Error', 'Please contact developer', 'error');
            }
         },
         columns: [
            { name: 'id', searchable: false, className: 'text-center align-middle' },
            { name: 'code', className: 'text-center align-middle' },
            { name: 'name', className: 'text-center align-middle' },
            { name: 'country_id', className: 'text-center align-middle' },
            { name: 'limit_credit', searchable: false, className: 'text-center align-middle' },
            { name: 'status', searchable: false, className: 'text-center align-middle' },
            { name: 'action', searchable: false, orderable: false, className: 'text-center align-middle' }
         ]
      }); 
   }

   function create() {
      $.ajax({
         url: '{{ url("admin/master_data/supplier/create") }}',
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
               Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: response.message,
                  showConfirmButton: false,
                  timer: 1000
               });
            } else if(response.status == 422) {
               $('#validation_alert').show();
               $('.modal-body').scrollTop(0);
               
               $.each(response.error, function(i, val) {
                  $.each(val, function(i, val) {
                     $('#validation_content').append(`
                        <li>` + val + `</li>
                     `);
                  });
               });
            } else {
               Swal.fire('Server Error', response.message, 'error');
            }
         },
         error: function() {
            $('.modal-body').scrollTop(0);
            loadingClose('.modal-content');
            Swal.fire('Server Error', 'Please contact developer', 'error');
         }
      });
   }

   function show(id) {
      toShow();
      $.ajax({
         url: '{{ url("admin/master_data/supplier/show") }}',
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
            $('#code').val(response.code);
            $('#name').val(response.name);
            $('input[name="status"][value="' + response.status + '"]').prop('checked', true);
            $('#btn_update').attr('onclick', 'update(' + id + ')');
         },
         error: function() {
            cancel();
            loadingClose('.modal-content');
            Swal.fire('Server Error', 'Please contact developer', 'error');
         }
      });
   }

   function update(id) {
      $.ajax({
         url: '{{ url("admin/master_data/supplier/update") }}' + '/' + id,
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
               Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: response.message,
                  showConfirmButton: false,
                  timer: 1000
               });
            } else if(response.status == 422) {
               $('#validation_alert').show();
               $('.modal-body').scrollTop(0);
               
               $.each(response.error, function(i, val) {
                  $.each(val, function(i, val) {
                     $('#validation_content').append(`
                        <li>` + val + `</li>
                     `);
                  });
               });
            } else {
               Swal.fire('Server Error', response.message, 'error');
            }
         },
         error: function() {
            $('.modal-body').scrollTop(0);
            loadingClose('.modal-content');
            Swal.fire('Server Error', 'Please contact developer', 'error');
         }
      });
   }

   function destroy(id) {
      Swal.fire({
         title: 'Are sure you want to delete?',
         text: 'Deleted data can no longer be recovered.',
         icon: 'warning',
         showCancelButton: true,
         confirmButtonText: 'Yes, delete!',
         cancelButtonText: 'Cancel!',
         reverseButtons: true,
         padding: '2em'
      }).then(function(result) {
         if(result.value) {
            $.ajax({
               url: '{{ url("admin/master_data/supplier/destroy") }}',
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
                     Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 1000
                     });
                  } else {
                     Swal.fire('Error!', response.message, 'error');
                  }
               },
               error: function() {
                  Swal.fire('Server Error', 'Please contact developer', 'error');
               }
            });
         }
      });
   }
</script>