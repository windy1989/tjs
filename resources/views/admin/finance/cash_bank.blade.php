<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i> 
					<span class="font-weight-semibold">Cash & Bank</span>
				</h4>
			</div>
			<div class="header-elements">
				<div class="d-flex justify-content-center">
					<button type="button" class="btn bg-success btn-labeled mr-2 btn-labeled-left" onclick="filter()">
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
					<a href="javascript:void(0);" class="breadcrumb-item">Finance</a>
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
               
               <div class="col-md-9">
                  <div class="form-group">
                     <label>Date :</label>
                     <div class="input-group-prepend">
                        <input type="date" name="filter_start_date" id="filter_start_date" class="form-control">
                        <span class="input-group-text">to</span>
                        <input type="date" name="filter_finish_date" id="filter_finish_date" class="form-control">
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group text-right">
               <div class="form-check form-check-inline">
                  <label class="form-check-label">
                     <input type="radio" name="filter_type" class="form-check-input" value="" checked>
                     All
                  </label>
               </div>
               <div class="form-check form-check-inline">
                  <label class="form-check-label">
                     <input type="radio" name="filter_type" value="1" class="form-check-input">
                     Cash / Bank In
                  </label>
               </div>
               <div class="form-check form-check-inline">
                  <label class="form-check-label">
                     <input type="radio" name="filter_type" value="2" class="form-check-input">
                     Cash / Bank Out
                  </label>
               </div>
               <div class="form-check form-check-inline">
                  <label class="form-check-label">
                     <input type="radio" name="filter_type" value="3" class="form-check-input">
                     Journal
                  </label>
               </div>
            </div>
            <div class="form-group text-right">
               <button type="button" onclick="filter('reset')" class="btn bg-danger"><i class="icon-sync"></i> Reset</button>
               <button type="button" onclick="filter()" class="btn bg-purple"><i class="icon-filter4"></i> Search</button>
            </div>
         </div>
      </div>
		<div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title">List Data</h5>
			</div>
			<div class="card-body">
            <div class="table-responsive">
               <table id="datatable_serverside" class="table table-bordered table-striped w-100">
                  <thead class="bg-dark">
                     <tr class="text-center">
                        <th>#</th>
                        <th>No</th>
                        <th>User</th>
                        <th>Code</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Action</th>
                     </tr>
                  </thead>
               </table>
            </div>
			</div>
		</div>
	</div>

<div class="modal fade" id="modal_form" data-backdrop="static" role="dialog">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header bg-light">
            <h5 class="modal-title" id="exampleModalLabel">Form</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form id="form_data">
               <div class="alert alert-danger" id="validation_alert" style="display:none;">
                  <ul id="validation_content"></ul>
               </div>
				<h5 class="card-title"><b>Main Information</b></h5>
               <div class="row">
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Code :<sup class="text-danger">*</sup></label>
                        <input type="text" name="code" id="code" class="form-control" placeholder="Enter code">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Date :<sup class="text-danger">*</sup></label>
                        <input type="date" name="date" id="date" class="form-control">
                     </div>
                  </div>
				  <div class="col-md-4">
					<div class="form-group">
					  <label>Description :<sup class="text-danger">*</sup></label>
					  <textarea name="description" id="description" class="form-control" placeholder="Enter description" rows="1"></textarea>
					</div>
				  </div>
               </div>
				
               <div class="form-group"><hr></div>
			   <h5 class="card-title"><b>Project Link (Optional)</b></h5>
			   <div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Project :</label>
							<select name="project_id" id="project_id" class="select2" onchange="resetProject()">
							   <option value="">-- None --</option>
							   @foreach($project as $p)
								  <option value="{{ $p->id }}">[{{ $p->code }}] {{ $p->customer->name }}</option>
							   @endforeach
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Type :</label>
							<select name="reference" id="reference" class="form-control" onchange="getProjectInfo(this)">
							   <option value="">-- None --</option>
							   <option value="1">Sales</option>
							   <option value="2">Purchase</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Code :</label>
							<select name="project_detail" id="project_detail" class="select2">
							   <option value="">-- None --</option>
							</select>
						</div>
					</div>
			   </div>
			   <div class="form-group"><hr></div>
			   <h5 class="card-title"><b>Details Coa</b></h5>
			   <div class="form-group text-center mt-4">
                  <div class="form-check form-check-inline">
                     <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="mode" value="1" checked>
                        Debet
                     </label>
                  </div>
                  <div class="form-check form-check-inline">
                     <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="mode" value="2">
                        Credit
                     </label>
                  </div>
			   </div>
               <div class="row">
                  <div class="col-md-6 mx-auto">
                     <div class="form-group">
                        <label>Coa :<sup class="text-danger">*</sup></label>
                        <select name="coa_id" id="coa_id" class="select2">
                           <option value="">-- Choose --</option>
                           @foreach($coa as $c)
                              <option value="{{ $c->id }}">[{{ $c->code }}] {{ $c->name }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6 mx-auto">
                     <div class="form-group">
                        <label>Nominal :<sup class="text-danger">*</sup></label>
                        <input type="text" name="nominal_detail" id="nominal_detail" class="form-control" placeholder="0" onkeyup="formatRupiah(this)">
                     </div>
                  </div>
                  <div class="col-md-6 mx-auto">
                     <div class="form-group">
                        <label>Note :<sup class="text-danger">*</sup></label>
                        <input type="text" name="note_detail" id="note_detail" class="form-control" placeholder="Enter note">
                     </div>
                  </div>
                  <div class="col-md-12">
                     <div class="form-group">
                        <button type="button" class="btn bg-success col-12" onclick="addContent()"><i class="icon-plus22"></i></button>
                     </div>
                  </div>
               </div>
			   <div class="row">
					<div class="form-group col-md-6">
						<table class="table table-bordered">
						 <thead class="table-secondary">
							<tr class="text-center">
							   <th>Debit</th>
							   <th>Nominal</th>
							   <th>Note</th>
							   <th>#</th>
							</tr>
						 </thead>
						 <tbody id="data_content_debit"></tbody>
						</table>
					</div>
					<div class="form-group col-md-6">
						<table class="table table-bordered">
						 <thead class="table-secondary">
							<tr class="text-center">
							   <th>Credit</th>
							   <th>Nominal</th>
							   <th>Note</th>
							   <th>#</th>
							</tr>
						 </thead>
						 <tbody id="data_content_credit"></tbody>
					  </table>
					</div>
				</div>
               <div class="form-group"><hr></div>
               <div class="form-group text-center mt-4">
                  <div class="form-check form-check-inline">
                     <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="type" value="1" checked>
                        Cash / Bank In
                     </label>
                  </div>
                  <div class="form-check form-check-inline">
                     <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="type" value="2">
                        Cash / Bank Out
                     </label>
                  </div>
                  <div class="form-check form-check-inline">
                     <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="type" value="3">
                        Journal
                     </label>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer bg-light">
            <button type="button" class="btn bg-secondary" data-dismiss="modal"><i class="icon-switch2"></i> Close</button>
            <button type="button" class="btn bg-danger" id="btn_cancel" onclick="cancel()" style="display:none;"><i class="icon-cross3"></i> Cancel</button>
            <button type="button" class="btn bg-warning" id="btn_update" onclick="update()" style="display:none;"><i class="icon-pencil7"></i> Save</button>
            <button type="button" class="btn bg-primary" id="btn_create" onclick="create()"><i class="icon-plus3"></i> Save</button>
         </div>
      </div>
   </div>
</div>

<script>
   $(function() {
      filter();

      $('#code').autocomplete({
         appendTo: '#modal_form',
         autoFocus: true,
         source: function(request, response) {
            $.get('{{ url("admin/finance/cash_bank/suggest_code") }}', { 
               search: request.term
            }, function(data) {
               response(data);
            });
         }
      });

      $('#datatable_serverside tbody').on('click', 'td.details-control', function() {
         var tr    = $(this).closest('tr');
         var badge = tr.find('span.badge');
         var icon  = tr.find('i');
         var row   = table.row(tr);

         if(row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
            badge.first().removeClass('badge-danger');
            badge.first().addClass('badge-success');
            icon.first().removeClass('icon-minus3');
            icon.first().addClass('icon-plus3');
         } else {
            row.child(rowDetail(row.data())).show();
            tr.addClass('shown');
            badge.first().removeClass('badge-success');
            badge.first().addClass('badge-danger');
            icon.first().removeClass('icon-plus3');
            icon.first().addClass('icon-minus3');
         }
      });
      
      $('#data_content_debit').on('click', '#delete_data_content_debit', function() {
         $(this).closest('tr').remove();
      });
	  $('#data_content_credit').on('click', '#delete_data_content_credit', function() {
         $(this).closest('tr').remove();
      });
   });

   function rowDetail(data) {
      var content = '';
      $.ajax({
         url: '{{ url("admin/finance/cash_bank/row_detail") }}',
         type: 'GET',
         async: false,
         data: {
            id: $(data[0]).data('id')
         },
         success: function(response) {
            content += response;
         },
         error: function() {
            swalInit.fire({
               title: 'Server Error',
               text: 'Please contact developer',
               type: 'error'
            });
         }
      });

      return content;
   }

   function addContent() {
      let coa_id   = $('#coa_id option:selected');
      let nominal_detail = $('#nominal_detail');
      let note_detail    = $('#note_detail');
	  var mode = $('input[name="mode"]:checked').val();

      if(coa_id.val() && nominal_detail.val() && note_detail.val()) {
		 if(mode == '1'){
			$('#data_content_debit').append(`
				<tr class="text-center">
				   <input type="hidden" name="coa_detail[]" value="` + coa_id.val() + `">
				   <input type="hidden" name="type_detail[]" value="` + mode + `">
				   <input type="hidden" name="note_detail[]" value="` + note_detail.val() + `">

				   <td class="align-middle">` + coa_id.text() + `</td>   
				   <td class="align-middle">
					  <div class="form-group">
						 <input type="text" name="nominal_detail[]" class="form-control" placeholder="0" value="` + nominal_detail.val() + `" onkeyup="formatRupiah(this)">
					  </div>
				   </td>   
				   <td class="align-middle">` + note_detail.val() + `</td>   
				   <td class="align-middle">
					  <button type="button" id="delete_data_content_debit" class="btn bg-danger btn-sm"><i class="icon-trash"></i></button>   
				   </td>
				</tr>
			`);
		 }else{
			$('#data_content_credit').append(`
				<tr class="text-center">
				   <input type="hidden" name="coa_detail[]" value="` + coa_id.val() + `">
				   <input type="hidden" name="type_detail[]" value="` + mode + `">
				   <input type="hidden" name="note_detail[]" value="` + note_detail.val() + `">

				   <td class="align-middle">` + coa_id.text() + `</td>   
				   <td class="align-middle">
					  <div class="form-group">
						 <input type="text" name="nominal_detail[]" class="form-control" placeholder="0" value="` + nominal_detail.val() + `" onkeyup="formatRupiah(this)">
					  </div>
				   </td>   
				   <td class="align-middle">` + note_detail.val() + `</td>   
				   <td class="align-middle">
					  <button type="button" id="delete_data_content_credit" class="btn bg-danger btn-sm"><i class="icon-trash"></i></button>   
				   </td>
				</tr>
			`);
		 }

         //$('#coa_id').val(null).change();
         //nominal_detail.val(null);
         //note_detail.val(null);
      } else {
         swalInit.fire('Ooppsss!', 'Please entry all field', 'info');
      }
   }

   function cancel() {
      reset();
      $('#modal_form').modal('hide');
      $('#btn_create').show();
      $('#btn_update').hide();
      $('#btn_cancel').hide();
   }

   function toShow() {
      $('#data_content_credit').html('');
	  $('#data_content_debit').html('');
      $('#modal_form').modal('show');
      $('#validation_alert').hide();
      $('#validation_content').html('');
      $('#btn_create').hide();
      $('#btn_update').show();
      $('#btn_cancel').show();
   }

   function resetFilter() {
      $('#filter_user_id').val(null).trigger('change');
      $('#filter_start_date').val(null);
      $('#filter_finish_date').val(null);
      $('#filter_start_nominal').val(null);
      $('#filter_finish_nominal').val(null);
      $('input[name="filter_type"][value=""]').prop('checked', true);
   }

   function filter(param = null) {
      if(param == 'reset') {
         resetFilter();
      }

      window.table = loadDataTable();
   }

   function reset() {
      $('#form_data').trigger('reset');
      $('#data_content_debit').html('');
	  $('#data_content_credit').html('');
	  $('#project_id').val('').change();
	  $('#project_detail').empty().append(`<option value="">-- None --</option>`);
	  $('#project_detail').val('').change();
      $('input[name="type"][value="1"]').prop('checked', true);
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
         order: [[1, 'asc']],
         ajax: {
            url: '{{ url("admin/finance/cash_bank/datatable") }}',
            type: 'GET',
            data: {
               user_id: $('#filter_user_id').val(),
               start_date: $('#filter_start_date').val(),
               finish_date: $('#filter_finish_date').val(),
               start_nominal: $('#filter_start_nominal').val(),
               finish_nominal: $('#filter_finish_nominal').val(),
               type: $('input[name="filter_type"]:checked').val()
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
            { name: 'detail', orderable: false, searchable: false, className: 'text-center align-middle details-control' },
            { name: 'id', searchable: false, className: 'text-center align-middle' },
            { name: 'user_id', className: 'text-center align-middle' },
            { name: 'code', className: 'text-center align-middle nowrap' },
            { name: 'total', searchable: false, orderable: false, className: 'text-center align-middle nowrap' },
            { name: 'date', searchable: false, className: 'text-center align-middle' },
            { name: 'description', className: 'text-center align-middle' },
            { name: 'action', searchable: false, orderable: false, className: 'text-center nowrap align-middle' }
         ]
      }); 
   }

   function create() {
      $.ajax({
         url: '{{ url("admin/finance/cash_bank/create") }}',
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
         url: '{{ url("admin/finance/cash_bank/show") }}',
         type: 'GET',
         dataType: 'JSON',
         data: {
            id: id
         },
         beforeSend: function() {
            loadingOpen('.modal-content');
         },
         success: function(response) {
            loadingClose('.modal-content');
			$('#project_id').val(response.project_id).change();
			$('#reference').val(response.reference);
			if(response.reference_id){
				$('#project_detail').empty();
				$('#project_detail').append(`
					<option value="` + response.reference_id + `" selected>` + response.reference_code + ` Total IDR ` + response.reference_total + `</option>
				`);
			}
            $('#code').val(response.code);
            $('#date').val(response.date);
            $('#description').val(response.description);
            $('input[name="type"][value="' + response.type + '"]').prop('checked', true);
			
			$('#data_content_debit').empty();
			$('#data_content_credit').empty();
			
            $.each(response.cash_bank_detail, function(i, val) {
				if(val.type == '1'){
					$('#data_content_debit').append(`
						<tr class="text-center">
						   <input type="hidden" name="coa_detail[]" value="` + val.coa_id + `">
						   <input type="hidden" name="type_detail[]" value="` + val.type + `">
						   <input type="hidden" name="note_detail[]" value="` + val.note + `">

						   <td class="align-middle">` + val.coa_info + `</td>   
						   <td class="align-middle">
							  <div class="form-group">
								 <input type="text" name="nominal_detail[]" class="form-control" placeholder="0" value="` + val.nominal + `" onkeyup="formatRupiah(this)">
							  </div>
						   </td>   
						   <td class="align-middle">` + val.note + `</td>   
						   <td class="align-middle">
							  <button type="button" id="delete_data_content_debit" class="btn bg-danger btn-sm"><i class="icon-trash"></i></button>   
						   </td>
						</tr>
					`);
				 }else if(val.type == '2'){
					$('#data_content_credit').append(`
						<tr class="text-center">
						   <input type="hidden" name="coa_detail[]" value="` + val.coa_id + `">
						   <input type="hidden" name="type_detail[]" value="` + val.type + `">
						   <input type="hidden" name="note_detail[]" value="` + val.note + `">

						   <td class="align-middle">` + val.coa_info + `</td>   
						   <td class="align-middle">
							  <div class="form-group">
								 <input type="text" name="nominal_detail[]" class="form-control" placeholder="0" value="` + val.nominal + `" onkeyup="formatRupiah(this)">
							  </div>
						   </td>   
						   <td class="align-middle">` + val.note + `</td>   
						   <td class="align-middle">
							  <button type="button" id="delete_data_content_credit" class="btn bg-danger btn-sm"><i class="icon-trash"></i></button>   
						   </td>
						</tr>
					`);
				 }
            });

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
         url: '{{ url("admin/finance/cash_bank/update") }}' + '/' + id,
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
	
	function resetProject(){
		$('#reference').val('');
		$('#project_detail').val('');
		$('#reference').focus();
	}
	
	function getProjectInfo(ini) 
	{
		var project_id = $('#project_id').val();
		
		if(ini.value !== '' && project_id !== ''){
			$.ajax({
				 url: '{{ url("admin/finance/cash_bank/project") }}',
				 type: 'GET',
				 dataType: 'JSON',
				 data: {
					id: project_id, reference: ini.value
				 },
				 beforeSend: function() {
					loadingOpen('.modal-content');
				 },
				 success: function(response) {
					loadingClose('.modal-content');
					
					if(response.length > 0){
						$('#project_detail').empty();
						$('#project_detail').append(`<option value="">-- None --</option>`);
						$.each(response, function(i, val) {
							$('#project_detail').append(`
								<option value="` + val.id + `">` + val.code + ` Total IDR ` + val.total + `</option>
							`);
						});
					}
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
			
			
			$('#project_detail').focus();
		}
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
                  url: '{{ url("admin/finance/cash_bank/destroy") }}',
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