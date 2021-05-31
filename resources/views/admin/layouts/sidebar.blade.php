<div class="page-content">
    <div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">
        <div class="sidebar-mobile-toggler text-center">
            <a href="#" class="sidebar-mobile-main-toggle">
                <i class="icon-arrow-left8"></i>
            </a>
            Navigation
            <a href="#" class="sidebar-mobile-expand">
                <i class="icon-screen-full"></i>
                <i class="icon-screen-normal"></i>
            </a>
        </div>
        <div class="sidebar-content">
            <div class="card card-sidebar-mobile">
                <ul class="nav nav-sidebar" data-nav-type="accordion">
                    <li class="nav-item-header text-white font-weight-bold">
                        <div class="text-uppercase mb-0 font-weight-bold text-center">
                            <span style="font-size:35px;" id="header-clock-realtime">{{ date('H:i:s') }}</span>
                            <h5>{{ date('D, d M Y') }}</h5>
                        </div> 
                    </li>
                    <li class="nav-item-header">
                        <div class="text-uppercase font-size-xs line-height-xs">Main Navigation</div> 
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/dashboard') }}" class="nav-link {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
                            <i class="icon-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'master_data' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-archive"></i> 
                            <span>Master Data</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Master Data">
                            <li class="nav-item">
                                <a href="{{ url('admin/master_data/company') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'company' ? 'active' : '' }}">Company</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/master_data/division') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'division' ? 'active' : '' }}">Division</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/master_data/country') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'country' ? 'active' : '' }}">Country</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/master_data/city') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'city' ? 'active' : '' }}">City</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/master_data/currency') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'currency' ? 'active' : '' }}">Currency</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/master_data/supplier') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'supplier' ? 'active' : '' }}">Supplier</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/master_data/banner') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'banner' ? 'active' : '' }}">Banner</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/master_data/brand') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'brand' ? 'active' : '' }}">Brand</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/master_data/category') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'category' ? 'active' : '' }}">Category</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/master_data/surface') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'surface' ? 'active' : '' }}">Surface</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/master_data/color') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'color' ? 'active' : '' }}">Color</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/master_data/pattern') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'pattern' ? 'active' : '' }}">Pattern</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/master_data/grade') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'grade' ? 'active' : '' }}">Grade</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/master_data/hs_code') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'hs_code' ? 'active' : '' }}">HS Code</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/master_data/unit') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'unit' ? 'active' : '' }}">Unit</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/master_data/loading_limit') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'loading_limit' ? 'active' : '' }}">Loading Limit</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/master_data/warehouse') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'warehouse' ? 'active' : '' }}">Warehouse</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'product' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-box"></i> 
                            <span>Product</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Product">
                            <li class="nav-item">
                                <a href="{{ url('admin/product/type') }}" class="nav-link {{ Request::segment(2) == 'product' && Request::segment(3) == 'type' ? 'active' : '' }}">Type</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/product/code') }}" class="nav-link {{ Request::segment(2) == 'product' && Request::segment(3) == 'code' ? 'active' : '' }}">Code</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'cogs' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-price-tags"></i> 
                            <span>Cogs</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Cogs">
                            <li class="nav-item">
                                <a href="{{ url('admin/cogs/rate') }}" class="nav-link {{ Request::segment(2) == 'cogs' && Request::segment(3) == 'rate' ? 'active' : '' }}">Rate</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/cogs/price') }}" class="nav-link {{ Request::segment(2) == 'cogs' && Request::segment(3) == 'price' ? 'active' : '' }}">Price</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/cogs/agent') }}" class="nav-link {{ Request::segment(2) == 'cogs' && Request::segment(3) == 'agent' ? 'active' : '' }}">Agent</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/cogs/freight') }}" class="nav-link {{ Request::segment(2) == 'cogs' && Request::segment(3) == 'freight' ? 'active' : '' }}">Freight</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/cogs/import') }}" class="nav-link {{ Request::segment(2) == 'cogs' && Request::segment(3) == 'import' ? 'active' : '' }}">Import</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/cogs/emkl') }}" class="nav-link {{ Request::segment(2) == 'cogs' && Request::segment(3) == 'emkl' ? 'active' : '' }}">Emkl</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/cogs/emkl_rate') }}" class="nav-link {{ Request::segment(2) == 'cogs' && Request::segment(3) == 'emkl_rate' ? 'active' : '' }}">Emkl Rate</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/cogs/marketing_structure') }}" class="nav-link {{ Request::segment(2) == 'cogs' && Request::segment(3) == 'marketing_structure' ? 'active' : '' }}">Marketing Structure</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'price' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-coin-dollar"></i> 
                            <span>Price</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Price">
                            <li class="nav-item">
                                <a href="{{ url('admin/price/cogs') }}" class="nav-link {{ Request::segment(2) == 'price' && Request::segment(3) == 'cogs' ? 'active' : '' }}">Cogs</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/price/pricing_policy') }}" class="nav-link {{ Request::segment(2) == 'price' && Request::segment(3) == 'pricing_policy' ? 'active' : '' }}">Pricing Policy</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/customer') }}" class="nav-link {{ Request::segment(2) == 'customer' ? 'active' : '' }}">
                            <i class="icon-user-tie"></i>
                            <span>Customer</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/order') }}" class="nav-link {{ Request::segment(2) == 'order' ? 'active' : '' }}">
                            <i class="icon-basket"></i>
                            <span>Order</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/project') }}" class="nav-link {{ Request::segment(2) == 'project' ? 'active' : '' }}">
                            <i class="icon-briefcase"></i>
                            <span>Project</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'purchase' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-percent"></i> 
                            <span>Purchase</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Accounting">
                            <li class="nav-item">
                                <a href="{{ url('admin/purchase/request') }}" class="nav-link {{ Request::segment(2) == 'purchase' && Request::segment(3) == 'request' ? 'active' : '' }}">Request</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/purchase/order') }}" class="nav-link {{ Request::segment(2) == 'purchase' && Request::segment(3) == 'order' ? 'active' : '' }}">Order</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/purchase/payment') }}" class="nav-link {{ Request::segment(2) == 'purchase' && Request::segment(3) == 'payment' ? 'active' : '' }}">Payment</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'sales' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-person"></i> 
                            <span>Sales</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Accounting">
                            <li class="nav-item">
                                <a href="{{ url('admin/sales/request') }}" class="nav-link {{ Request::segment(2) == 'sales' && Request::segment(3) == 'request' ? 'active' : '' }}">Request</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/sales/order') }}" class="nav-link {{ Request::segment(2) == 'sales' && Request::segment(3) == 'order' ? 'active' : '' }}">Order</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/sales/payment') }}" class="nav-link {{ Request::segment(2) == 'sales' && Request::segment(3) == 'payment' ? 'active' : '' }}">Payment</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'hrd' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-stack-text"></i> 
                            <span>HRD</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Accounting">
                            <li class="nav-item">
                                <a href="{{ url('admin/hrd/job_desc') }}" class="nav-link {{ Request::segment(2) == 'hrd' && Request::segment(3) == 'job_desc' ? 'active' : '' }}">Job Desc</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'accounting' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-book2"></i> 
                            <span>Accounting</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Accounting">
                            <li class="nav-item">
                                <a href="{{ url('admin/accounting/coa') }}" class="nav-link {{ Request::segment(2) == 'accounting' && Request::segment(3) == 'coa' ? 'active' : '' }}">COA</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/accounting/cash_bank') }}" class="nav-link {{ Request::segment(2) == 'accounting' && Request::segment(3) == 'cash_bank' ? 'active' : '' }}">Cash & Bank</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/accounting/budgeting') }}" class="nav-link {{ Request::segment(2) == 'accounting' && Request::segment(3) == 'budgeting' ? 'active' : '' }}">Budgeting</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'report' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-clipboard3"></i> 
                            <span>Report</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Report">
                            <li class="nav-item">
                                <a href="{{ url('admin/report/balance_sheet') }}" class="nav-link {{ Request::segment(2) == 'report' && Request::segment(3) == 'balance_sheet' ? 'active' : '' }}">Balance Sheet</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/report/profit_loss') }}" class="nav-link {{ Request::segment(2) == 'report' && Request::segment(3) == 'profit_loss' ? 'active' : '' }}">Profit & Loss</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/report/ledger') }}" class="nav-link {{ Request::segment(2) == 'report' && Request::segment(3) == 'ledger' ? 'active' : '' }}">Ledger</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/report/sale') }}" class="nav-link {{ Request::segment(2) == 'report' && Request::segment(3) == 'sale' ? 'active' : '' }}">Sale</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/report/purchase') }}" class="nav-link {{ Request::segment(2) == 'report' && Request::segment(3) == 'purchase' ? 'active' : '' }}">Purchase</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/report/debt') }}" class="nav-link {{ Request::segment(2) == 'report' && Request::segment(3) == 'debt' ? 'active' : '' }}">Debt</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/report/receivable') }}" class="nav-link {{ Request::segment(2) == 'report' && Request::segment(3) == 'receivable' ? 'active' : '' }}">Receivable</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/report/cash_flow') }}" class="nav-link {{ Request::segment(2) == 'report' && Request::segment(3) == 'cash_flow' ? 'active' : '' }}">Cash Flow</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/report/close_book') }}" class="nav-link {{ Request::segment(2) == 'report' && Request::segment(3) == 'close_book' ? 'active' : '' }}">Close Book</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'setting' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-cog4"></i> 
                            <span>Setting</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Setting">
                            <li class="nav-item">
                                <a href="{{ url('admin/setting/user') }}" class="nav-link {{ Request::segment(2) == 'setting' && Request::segment(3) == 'user' ? 'active' : '' }}">User</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>