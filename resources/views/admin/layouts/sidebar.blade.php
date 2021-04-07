<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav sidebar sidebar-dark accordion" style="background: #212529;" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('admin/dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15 d-lg-none">SM</div>
                <div class="sidebar-brand-text mx-3">
                    <img src="{{ asset('website/logo-white.png') }}" style="max-width: 150px;" alt="Logo">
                </div>
            </a>
            <hr class="sidebar-divider my-2">
            <li class="nav-item {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('admin/dashboard') }}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item {{ Request::segment(2) == 'master_data' ? 'active' : '' }}">
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#master_data" aria-expanded="true" aria-controls="master_data">
                    <i class="fas fa-fw fa-archive"></i>
                    <span>Master Data</span>
                </a>
                <div id="master_data" class="collapse {{ Request::segment(2) == 'master_data' ? 'show' : '' }}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'company' ? 'active' : '' }}" href="{{ url('admin/master_data/company') }}">Company</a>
                        <a class="collapse-item {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'division' ? 'active' : '' }}" href="{{ url('admin/master_data/division') }}">Division</a>
                        <a class="collapse-item {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'country' ? 'active' : '' }}" href="{{ url('admin/master_data/country') }}">Country</a>
                        <a class="collapse-item {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'currency' ? 'active' : '' }}" href="{{ url('admin/master_data/currency') }}">Currency</a>
                        <a class="collapse-item {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'supplier' ? 'active' : '' }}" href="{{ url('admin/master_data/supplier') }}">Supplier</a>
                        <a class="collapse-item {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'brand' ? 'active' : '' }}" href="{{ url('admin/master_data/brand') }}">Brand</a>
                        <a class="collapse-item {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'category' ? 'active' : '' }}" href="{{ url('admin/master_data/category') }}">Category</a>
                        <a class="collapse-item {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'surface' ? 'active' : '' }}" href="{{ url('admin/master_data/surface') }}">Surface</a>
                        <a class="collapse-item {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'color' ? 'active' : '' }}" href="{{ url('admin/master_data/color') }}">Color</a>
                        <a class="collapse-item {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'pattern' ? 'active' : '' }}" href="{{ url('admin/master_data/pattern') }}">Pattern</a>
                        <a class="collapse-item {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'grade' ? 'active' : '' }}" href="{{ url('admin/master_data/grade') }}">Grade</a>
                        <a class="collapse-item {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'hs_code' ? 'active' : '' }}" href="{{ url('admin/master_data/hs_code') }}">HS Code</a>
                        <a class="collapse-item {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'unit' ? 'active' : '' }}" href="{{ url('admin/master_data/unit') }}">Unit</a>
                        <a class="collapse-item {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'specification' ? 'active' : '' }}" href="{{ url('admin/master_data/specification') }}">Specification</a>
                    </div>
                </div>
            </li>
            <li class="nav-item {{ Request::segment(2) == 'cogs' ? 'active' : '' }}">
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#cogs"
                    aria-expanded="true" aria-controls="cogs">
                    <i class="fas fa-fw fa-tags"></i>
                    <span>Cogs</span>
                </a>
                <div id="cogs" class="collapse {{ Request::segment(2) == 'cogs' ? 'show' : '' }}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::segment(2) == 'cogs' && Request::segment(3) == 'agent' ? 'active' : '' }}" href="{{ url('admin/cogs/agent') }}">Agent</a>
                        <a class="collapse-item {{ Request::segment(2) == 'cogs' && Request::segment(3) == 'freight' ? 'active' : '' }}" href="{{ url('admin/cogs/freight') }}">Freight</a>
                        <a class="collapse-item {{ Request::segment(2) == 'cogs' && Request::segment(3) == 'import' ? 'active' : '' }}" href="{{ url('admin/cogs/import') }}">Import</a>
                        <a class="collapse-item {{ Request::segment(2) == 'cogs' && Request::segment(3) == 'structure' ? 'active' : '' }}" href="{{ url('admin/cogs/structure') }}">Structure</a>
                    </div>
                </div>
            </li>
            <li class="nav-item {{ Request::segment(2) == 'price' ? 'active' : '' }}">
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#price"
                    aria-expanded="true" aria-controls="price">
                    <i class="fas fa-fw fa-hand-holding-usd"></i>
                    <span>Price</span>
                </a>
                <div id="price" class="collapse {{ Request::segment(2) == 'price' ? 'show' : '' }}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::segment(2) == 'price' && Request::segment(3) == 'cogs' ? 'active' : '' }}" href="{{ url('admin/price/cogs') }}">Cogs</a>
                        <a class="collapse-item {{ Request::segment(2) == 'price' && Request::segment(3) == 'hpp' ? 'active' : '' }}" href="{{ url('admin/price/hpp') }}">Hpp</a>
                        <a class="collapse-item {{ Request::segment(2) == 'price' && Request::segment(3) == 'pricing_policy' ? 'active' : '' }}" href="{{ url('admin/price/pricing_policy') }}">Pricing Policy</a>
                    </div>
                </div>
            </li>
            <li class="nav-item {{ Request::segment(2) == 'product' ? 'show' : '' }}">
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#product"
                    aria-expanded="true" aria-controls="product">
                    <i class="fas fa-fw fa-box-open"></i>
                    <span>Product</span>
                </a>
                <div id="product" class="collapse {{ Request::segment(2) == 'product' ? 'show' : '' }}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::segment(2) == 'product' && Request::segment(3) == 'type' ? 'active' : '' }}" href="{{ url('admin/product/type') }}">Type</a>
                        <a class="collapse-item {{ Request::segment(2) == 'product' && Request::segment(3) == 'code' ? 'active' : '' }}" href="{{ url('admin/product/code') }}">Code</a>
                    </div>
                </div>
            </li>
            <li class="nav-item {{ Request::segment(2) == 'purchase' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('admin/purchase') }}">
                    <i class="fas fa-fw fa-luggage-cart"></i>
                    <span>Purchase</span>
                </a>
            </li>
            <li class="nav-item {{ Request::segment(2) == 'customer' ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('admin/customer') }}">
                    <i class="fas fa-fw fa-user-tie"></i>
                    <span>Customer</span>
                </a>
            </li>
            <li class="nav-item {{ Request::segment(2) == 'sale' ? 'active' : '' }}">
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#sale"
                    aria-expanded="true" aria-controls="sale">
                    <i class="fas fa-fw fa-balance-scale"></i>
                    <span>Sale</span>
                </a>
                <div id="sale" class="collapse {{ Request::segment(2) == 'sale' ? 'show' : '' }}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::segment(2) == 'sale' && Request::segment(3) == 'quotation' ? 'active' : '' }}" href="{{ url('admin/sale/quotation') }}">Quotation</a>
                        <a class="collapse-item {{ Request::segment(2) == 'sale' && Request::segment(3) == 'sales_order' ? 'active' : '' }}" href="{{ url('admin/sale/sales_order') }}">Sales Order</a>
                        <a class="collapse-item {{ Request::segment(2) == 'sale' && Request::segment(3) == 'invoice' ? 'active' : '' }}" href="{{ url('admin/sale/invoice') }}">Invoice</a>
                        <a class="collapse-item {{ Request::segment(2) == 'sale' && Request::segment(3) == 'delivery_order' ? 'active' : '' }}" href="{{ url('admin/sale/delivery_order') }}">Delivery Order</a>
                    </div>
                </div>
            </li>
            <li class="nav-item {{ Request::segment(2) == 'accounting' ? 'active' : '' }}">
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#accounting"
                    aria-expanded="true" aria-controls="accounting">
                    <i class="fas fa-fw fa-book-open"></i>
                    <span>Accounting</span>
                </a>
                <div id="accounting" class="collapse {{ Request::segment(2) == 'accounting' ? 'show' : '' }}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::segment(2) == 'accounting' && Request::segment(3) == 'coa' ? 'active' : '' }}" href="{{ url('admin/accounting/coa') }}">COA</a>
                        <a class="collapse-item {{ Request::segment(2) == 'accounting' && Request::segment(3) == 'cash_bank' ? 'active' : '' }}" href="{{ url('admin/accounting/cash_bank') }}">Cash & Bank</a>
                        <a class="collapse-item {{ Request::segment(2) == 'accounting' && Request::segment(3) == 'payment_invoice' ? 'active' : '' }}" href="{{ url('admin/accounting/payment_invoice') }}">Payment Invoice</a>
                        <a class="collapse-item {{ Request::segment(2) == 'accounting' && Request::segment(3) == 'payment_delivery' ? 'active' : '' }}" href="{{ url('admin/accounting/payment_delivery') }}">Payment Delivery</a>
                        <a class="collapse-item {{ Request::segment(2) == 'accounting' && Request::segment(3) == 'budgeting' ? 'active' : '' }}" href="{{ url('admin/accounting/budgeting') }}">Budgeting</a>
                    </div>
                </div>
            </li>
            <li class="nav-item {{ Request::segment(2) == 'report' ? 'active' : '' }}">
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#report"
                    aria-expanded="true" aria-controls="report">
                    <i class="fas fa-fw fa-chart-bar"></i>
                    <span>Report</span>
                </a>
                <div id="report" class="collapse {{ Request::segment(2) == 'report' ? 'show' : '' }}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::segment(2) == 'report' && Request::segment(3) == 'stock' ? 'active' : '' }}" href="{{ url('admin/report/stock') }}">Stock</a>
                        <a class="collapse-item {{ Request::segment(2) == 'report' && Request::segment(3) == 'sales' ? 'active' : '' }}" href="{{ url('admin/report/sales') }}">Sales</a>
                    </div>
                </div>
            </li>
            <li class="nav-item {{ Request::segment(2) == 'setting' ? 'active' : '' }}">
                <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#setting"
                    aria-expanded="true" aria-controls="setting">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Pengaturan</span>
                </a>
                <div id="setting" class="collapse {{ Request::segment(2) == 'setting' ? 'show' : '' }}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ Request::segment(2) == 'setting' && Request::segment(3) == 'menu' ? 'active' : '' }}" href="{{ url('admin/setting/menu') }}">Menu</a>
                        <a class="collapse-item {{ Request::segment(2) == 'setting' && Request::segment(3) == 'role' ? 'active' : '' }}" href="{{ url('admin/setting/role') }}">Role</a>
                        <a class="collapse-item {{ Request::segment(2) == 'setting' && Request::segment(3) == 'user' ? 'active' : '' }}" href="{{ url('admin/setting/user') }}">User</a>
                    </div>
                </div>
            </li>
        </ul>