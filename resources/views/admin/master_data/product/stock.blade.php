<div class="content-wrapper">
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4>
					<i class="icon-arrow-left52 mr-2"></i>
					<span class="font-weight-semibold">Stock</span>
				</h4>
			</div>
			<div class="header-elements">
				<div class="d-flex justify-content-center">
					<button class="btn bg-indigo-400 btn-labeled mr-2 btn-labeled-left" onclick="exportData()">
						<b><i class="icon-file-excel"></i></b> Export Data
					</button>
					<button class="btn bg-pink-400 btn-labeled mr-2 btn-labeled-left" onclick="printData()">
						<b><i class="icon-printer2"></i></b> Print Data
					</button>
				</div>
			</div>
		</div>
		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="{{ url('admin/dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
					<a href="javascript:void(0);" class="breadcrumb-item">Master Data</a>
					<a href="javascript:void(0);" class="breadcrumb-item">Product</a>
					<span class="breadcrumb-item active">Stock</span>
				</div>
			</div>
		</div>
	</div>
	<div class="content">
        <div class="card">
            <div class="card-body">
                <form action="">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group mb-0">
                                <input type="text" name="search" id="search" class="form-control" placeholder="Search type item" value="{{ $search }}">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-0">
                                <button type="submit" class="btn bg-success col-12"><i class="icon-search4"></i> Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
		<div class="card">
			<div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped w-100">
                        <thead class="bg-dark">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Tipe</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Warehouse</th>
                                <th>Shading</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($items->count() > 0)
                                @foreach($items as $key => $i)
                                    <tr class="text-center">
                                        <td class="align-middle">{{ $key + 1 }}</td>
                                        <td class="align-middle">{{ $i->tipe_item }}</td>
                                        <td class="align-middle">{{ $i->kode_item }}</td>
                                        <td class="align-middle">{{ $i->nama }}</td>
                                        <td class="align-middle">{{ $i->kode_gudang }}</td>
                                        <td class="align-middle">{{ $i->shading }}</td>
                                        <td class="align-middle">{{ (int)$i->stok }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="text-center">
                                    <td class="align-middle" colspan="7">
                                        <div class="font-italic">Data not found</div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $items->withQueryString()->onEachSide(1)->links('admin.pagination') }}
                </div>
			</div>
		</div>
	</div>
<script>
	function exportData(){
		var search = $('#search').val();
		
		window.location = "{{ url('admin/master_data/product/stock/export') }}?search=" + search;
   }
   
   function printData(){
		var search = $('#search').val(), page = {{ Request::get('page') ? Request::get('page') : '1' }};
		
		window.open("{{ url('admin/master_data/product/stock/print') }}?search=" + search + "&page=" + page, "_blank");
   }
</script>