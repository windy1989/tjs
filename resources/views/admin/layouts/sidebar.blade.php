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
            <div class="sidebar-user">
                <div class="card-body">
                    <div class="media">
                        <div class="mr-3">
                            <a href="#">
                                <img src="{{ asset('website/user.png') }}" width="38" height="38" class="rounded-circle" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="media-title font-weight-semibold">Smart Marble</div>
                            <div class="font-size-xs opacity-50">
                                <i class="icon-pin font-size-sm"></i> &nbsp;Super Admin
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-sidebar-mobile">
                <ul class="nav nav-sidebar" data-nav-type="accordion">
                    <li class="nav-item-header">
                        <div class="text-uppercase font-size-xs line-height-xs">Menu Navigation</div> 
                        <i class="icon-menu" title="Main"></i>
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
                                <a href="{{ url('admin/master_data/currency') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'currency' ? 'active' : '' }}">Currency</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/master_data/supplier') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'supplier' ? 'active' : '' }}">Supplier</a>
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
                                <a href="{{ url('admin/master_data/specification') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'specification' ? 'active' : '' }}">Specification</a>
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
                                <a href="{{ url('admin/cogs/agent') }}" class="nav-link {{ Request::segment(2) == 'cogs' && Request::segment(3) == 'agent' ? 'active' : '' }}">Agent</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/cogs/freight') }}" class="nav-link {{ Request::segment(2) == 'cogs' && Request::segment(3) == 'freight' ? 'active' : '' }}">Freight</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/cogs/import') }}" class="nav-link {{ Request::segment(2) == 'cogs' && Request::segment(3) == 'import' ? 'active' : '' }}">Import</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/cogs/structure') }}" class="nav-link {{ Request::segment(2) == 'cogs' && Request::segment(3) == 'structure' ? 'active' : '' }}">Structure</a>
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
                                <a href="{{ url('admin/price/hpp') }}" class="nav-link {{ Request::segment(2) == 'price' && Request::segment(3) == 'hpp' ? 'active' : '' }}">Hpp</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/price/pricing_policy') }}" class="nav-link {{ Request::segment(2) == 'price' && Request::segment(3) == 'pricing_policy' ? 'active' : '' }}">Pricing Policy</a>
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
                    <li class="nav-item">
                        <a href="{{ url('admin/purchase') }}" class="nav-link {{ Request::segment(2) == 'purchase' ? 'active' : '' }}">
                            <i class="icon-basket"></i>
                            <span>Purchase</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('admin/customer') }}" class="nav-link {{ Request::segment(2) == 'customer' ? 'active' : '' }}">
                            <i class="icon-user-tie"></i>
                            <span>Customer</span>
                        </a>
                    </li>
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'sale' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-percent"></i> 
                            <span>Sale</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Sale">
                            <li class="nav-item">
                                <a href="{{ url('admin/sale/quotation') }}" class="nav-link {{ Request::segment(2) == 'sale' && Request::segment(3) == 'quotation' ? 'active' : '' }}">Quotation</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/sale/sales_order') }}" class="nav-link {{ Request::segment(2) == 'sale' && Request::segment(3) == 'sales_order' ? 'active' : '' }}">Sales Order</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/sale/invoice') }}" class="nav-link {{ Request::segment(2) == 'sale' && Request::segment(3) == 'invoice' ? 'active' : '' }}">Invoice</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/sale/delivery_order') }}" class="nav-link {{ Request::segment(2) == 'sale' && Request::segment(3) == 'delivery_order' ? 'active' : '' }}">Delivery Order</a>
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
                                <a href="{{ url('admin/accounting/payment_invoice') }}" class="nav-link {{ Request::segment(2) == 'accounting' && Request::segment(3) == 'payment_invoice' ? 'active' : '' }}">Payment Invoice</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/accounting/payment_delivery') }}" class="nav-link {{ Request::segment(2) == 'accounting' && Request::segment(3) == 'payment_delivery' ? 'active' : '' }}">Payment Delivery</a>
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
                                <a href="{{ url('admin/report/stock') }}" class="nav-link {{ Request::segment(2) == 'report' && Request::segment(3) == 'stock' ? 'active' : '' }}">Stock</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/report/sales') }}" class="nav-link {{ Request::segment(2) == 'report' && Request::segment(3) == 'sales' ? 'active' : '' }}">Sales</a>
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
                                <a href="{{ url('admin/setting/menu') }}" class="nav-link {{ Request::segment(2) == 'setting' && Request::segment(3) == 'menu' ? 'active' : '' }}">Menu</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/setting/role') }}" class="nav-link {{ Request::segment(2) == 'setting' && Request::segment(3) == 'role' ? 'active' : '' }}">Role</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/setting/user') }}" class="nav-link {{ Request::segment(2) == 'setting' && Request::segment(3) == 'user' ? 'active' : '' }}">User</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>