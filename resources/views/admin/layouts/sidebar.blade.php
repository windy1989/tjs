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
                            <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'product' ? 'nav-item-expanded nav-item-open' : '' }}">
                                <a href="#" class="nav-link">Product</a>
                                <ul class="nav nav-group-sub">
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/product/company') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'product' && Request::segment(4) == 'company' ? 'active' : '' }}">Company</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/product/division') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'product' && Request::segment(4) == 'division' ? 'active' : '' }}">Division</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/product/country') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'product' && Request::segment(4) == 'country' ? 'active' : '' }}">Country</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/product/city') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'product' && Request::segment(4) == 'city' ? 'active' : '' }}">City</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/product/currency') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'product' && Request::segment(4) == 'currency' ? 'active' : '' }}">Currency</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/product/supplier') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'product' && Request::segment(4) == 'supplier' ? 'active' : '' }}">Supplier</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/product/brand') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'product' && Request::segment(4) == 'brand' ? 'active' : '' }}">Brand</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/product/category') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'product' && Request::segment(4) == 'category' ? 'active' : '' }}">Category</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/product/grade') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'product' && Request::segment(4) == 'grade' ? 'active' : '' }}">Grade</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/product/hs_code') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'product' && Request::segment(4) == 'hs_code' ? 'active' : '' }}">HS Code</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/product/unit') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'product' && Request::segment(4) == 'unit' ? 'active' : '' }}">Unit</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/product/loading_limit') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'product' && Request::segment(4) == 'loading_limit' ? 'active' : '' }}">Loading Limit</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/product/surface') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'product' && Request::segment(4) == 'surface' ? 'active' : '' }}">Surface</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/product/color') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'product' && Request::segment(4) == 'color' ? 'active' : '' }}">Color</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/product/pattern') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'product' && Request::segment(4) == 'pattern' ? 'active' : '' }}">Pattern</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/product/warehouse') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'product' && Request::segment(4) == 'warehouse' ? 'active' : '' }}">Warehouse</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/product/product_type') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'product' && Request::segment(4) == 'product_type' ? 'active' : '' }}">Product Type</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/product/product_code') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'product' && Request::segment(4) == 'product_code' ? 'active' : '' }}">Product Code</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'cogs_master' ? 'nav-item-expanded nav-item-open' : '' }}">
                                <a href="#" class="nav-link">COGS Master</a>
                                <ul class="nav nav-group-sub">
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/cogs_master/buy_exchange_rate') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'cogs_master' && Request::segment(4) == 'buy_exchange_rate' ? 'active' : '' }}">Buy Exchange Rate</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/cogs_master/purchase_price') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'cogs_master' && Request::segment(4) == 'purchase_price' ? 'active' : '' }}">Purchase Price</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/cogs_master/qc_fee') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'cogs_master' && Request::segment(4) == 'qc_fee' ? 'active' : '' }}">QC Fee</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/cogs_master/freight') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'cogs_master' && Request::segment(4) == 'freight' ? 'active' : '' }}">Freight</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/cogs_master/import_system') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'cogs_master' && Request::segment(4) == 'import_system' ? 'active' : '' }}">Import System</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/cogs_master/import_estimation_rate') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'cogs_master' && Request::segment(4) == 'import_estimation_rate' ? 'active' : '' }}">Import Estimation Rate</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/cogs_master/import_custom_rate') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'cogs_master' && Request::segment(4) == 'import_custom_rate' ? 'active' : '' }}">Import Custom Rate</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/cogs_master/marketing_cost') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'cogs_master' && Request::segment(4) == 'marketing_cost' ? 'active' : '' }}">Marketing Cost</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/cogs_master/cogs_sales') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'cogs_master' && Request::segment(4) == 'cogs_sales' ? 'active' : '' }}">COGS Sales</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/cogs_master/pricing_sales') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'cogs_master' && Request::segment(4) == 'pricing_sales' ? 'active' : '' }}">Pricing Sales</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'delivery' ? 'nav-item-expanded nav-item-open' : '' }}">
                                <a href="#" class="nav-link">Delivery</a>
                                <ul class="nav nav-group-sub">
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/delivery/delivery_company') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'delivery' && Request::segment(4) == 'delivery_company' ? 'active' : '' }}">Delivery Company</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/delivery/mode_of_transport') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'delivery' && Request::segment(4) == 'mode_of_transport' ? 'active' : '' }}">Mode Of Transport</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/delivery/delivery_cost') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'delivery' && Request::segment(4) == 'delivery_cost' ? 'active' : '' }}">Delivery Cost</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'finance_accounting' ? 'nav-item-expanded nav-item-open' : '' }}">
                                <a href="#" class="nav-link">Finance & Accounting</a>
                                <ul class="nav nav-group-sub">
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/finance_accounting/coa') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'finance_accounting' && Request::segment(4) == 'coa' ? 'active' : '' }}">COA</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/finance_accounting/list_of_bank') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'finance_accounting' && Request::segment(4) == 'list_of_bank' ? 'active' : '' }}">List Of Bank</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'digital' ? 'nav-item-expanded nav-item-open' : '' }}">
                                <a href="#" class="nav-link">Digital</a>
                                <ul class="nav nav-group-sub">
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/digital/banner') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'digital' && Request::segment(4) == 'banner' ? 'active' : '' }}">Banner</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/digital/career') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'digital' && Request::segment(4) == 'career' ? 'active' : '' }}">Career</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/digital/news_category') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'digital' && Request::segment(4) == 'news_category' ? 'active' : '' }}">News Category</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/digital/news') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'digital' && Request::segment(4) == 'news' ? 'active' : '' }}">News</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'voucher' ? 'nav-item-expanded nav-item-open' : '' }}">
                                <a href="#" class="nav-link">Voucher</a>
                                <ul class="nav nav-group-sub">
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/voucher/brand') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'voucher' && Request::segment(4) == 'brand' ? 'active' : '' }}">Brand</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/voucher/category') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'voucher' && Request::segment(4) == 'category' ? 'active' : '' }}">Category</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/master_data/voucher/global') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'voucher' && Request::segment(4) == 'global' ? 'active' : '' }}">Global</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/master_data/customer') }}" class="nav-link {{ Request::segment(2) == 'master_data' && Request::segment(3) == 'customer' ? 'active' : '' }}">Customer</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'data' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-cart5"></i> 
                            <span>Data</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Data">
                            <li class="nav-item">
                                <a href="{{ url('admin/data/project') }}" class="nav-link {{ Request::segment(2) == 'data' && Request::segment(3) == 'project' ? 'active' : '' }}">Project</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/data/retail') }}" class="nav-link {{ Request::segment(2) == 'data' && Request::segment(3) == 'retail' ? 'active' : '' }}">Retail</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'invoice' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-file-text"></i> 
                            <span>Invoice</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Invoice">
                            <li class="nav-item">
                                <a href="{{ url('admin/invoice/project') }}" class="nav-link {{ Request::segment(2) == 'invoice' && Request::segment(3) == 'project' ? 'active' : '' }}">Project</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/invoice/retail') }}" class="nav-link {{ Request::segment(2) == 'invoice' && Request::segment(3) == 'retail' ? 'active' : '' }}">Retail</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'purchase_order' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-coins"></i> 
                            <span>Purchase Order</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Purchase Order">
                            <li class="nav-item">
                                <a href="{{ url('admin/purchase_order/project') }}" class="nav-link {{ Request::segment(2) == 'purchase_order' && Request::segment(3) == 'project' ? 'active' : '' }}">Project</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/purchase_order/retail') }}" class="nav-link {{ Request::segment(2) == 'purchase_order' && Request::segment(3) == 'retail' ? 'active' : '' }}">Retail</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'delivery_order' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-truck"></i> 
                            <span>Delivery Order</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Delivery Order">
                            <li class="nav-item">
                                <a href="{{ url('admin/delivery_order/project') }}" class="nav-link {{ Request::segment(2) == 'delivery_order' && Request::segment(3) == 'project' ? 'active' : '' }}">Project</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/delivery_order/retail') }}" class="nav-link {{ Request::segment(2) == 'delivery_order' && Request::segment(3) == 'retail' ? 'active' : '' }}">Retail</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'finance' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-book3"></i> 
                            <span>Finance</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Finance">
                            <li class="nav-item">
                                <a href="{{ url('admin/finance/cash_bank') }}" class="nav-link {{ Request::segment(2) == 'finance' && Request::segment(3) == 'project' ? 'active' : '' }}">Cash & Bank</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'accounting' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-books"></i> 
                            <span>Accounting</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Accounting">
                            <li class="nav-item">
                                <a href="{{ url('admin/accounting/budgeting') }}" class="nav-link {{ Request::segment(2) == 'accounting' && Request::segment(3) == 'project' ? 'active' : '' }}">Budgeting</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'report' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-file-text3"></i> 
                            <span>Report</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Report">
                            <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'report' && Request::segment(3) == 'purchase_order' ? 'nav-item-expanded nav-item-open' : '' }}">
                                <a href="#" class="nav-link">Purchase Order</a>
                                <ul class="nav nav-group-sub">
                                    <li class="nav-item">
                                        <a href="{{ url('admin/report/purchase_order/project') }}" class="nav-link {{ Request::segment(2) == 'report' && Request::segment(3) == 'purchase_order' && Request::segment(4) == 'project' ? 'active' : '' }}">Project</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/report/purchase_order/retail') }}" class="nav-link {{ Request::segment(2) == 'report' && Request::segment(3) == 'purchase_order' && Request::segment(4) == 'retail' ? 'active' : '' }}">Retail</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'report' && Request::segment(3) == 'delivery_order' ? 'nav-item-expanded nav-item-open' : '' }}">
                                <a href="#" class="nav-link">Delivery Order</a>
                                <ul class="nav nav-group-sub">
                                    <li class="nav-item">
                                        <a href="{{ url('admin/report/delivery_order/project') }}" class="nav-link {{ Request::segment(2) == 'report' && Request::segment(3) == 'delivery_order' && Request::segment(4) == 'project' ? 'active' : '' }}">Project</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/report/delivery_order/retail') }}" class="nav-link {{ Request::segment(2) == 'report' && Request::segment(3) == 'delivery_order' && Request::segment(4) == 'retail' ? 'active' : '' }}">Retail</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'report' && Request::segment(3) == 'finance' ? 'nav-item-expanded nav-item-open' : '' }}">
                                <a href="#" class="nav-link">Finance</a>
                                <ul class="nav nav-group-sub">
                                    <li class="nav-item">
                                        <a href="{{ url('admin/report/finance/accounts_receivable') }}" class="nav-link {{ Request::segment(2) == 'report' && Request::segment(3) == 'finance' && Request::segment(4) == 'accounts_receivable' ? 'active' : '' }}">Accounts Receivable</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/report/finance/debt') }}" class="nav-link {{ Request::segment(2) == 'report' && Request::segment(3) == 'finance' && Request::segment(4) == 'debt' ? 'active' : '' }}">Debt</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'report' && Request::segment(3) == 'accounting' ? 'nav-item-expanded nav-item-open' : '' }}">
                                <a href="#" class="nav-link">Accounting</a>
                                <ul class="nav nav-group-sub">
                                    <li class="nav-item">
                                        <a href="{{ url('admin/report/accounting/balance_sheet') }}" class="nav-link {{ Request::segment(2) == 'report' && Request::segment(3) == 'accounting' && Request::segment(4) == 'balance_sheet' ? 'active' : '' }}">Balance Sheet</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/report/accounting/profit_loss') }}" class="nav-link {{ Request::segment(2) == 'report' && Request::segment(3) == 'accounting' && Request::segment(4) == 'profit_loss' ? 'active' : '' }}">Profit & Loss</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ url('admin/report/accounting/ledger') }}" class="nav-link {{ Request::segment(2) == 'report' && Request::segment(3) == 'accounting' && Request::segment(4) == 'ledger' ? 'active' : '' }}">Ledger</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'hrd' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-folder-open2"></i> 
                            <span>HRD</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="HRD">
                            <li class="nav-item">
                                <a href="{{ url('admin/hrd/employee') }}" class="nav-link {{ Request::segment(2) == 'hrd' && Request::segment(3) == 'employee' ? 'active' : '' }}">Employee</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/hrd/attendance') }}" class="nav-link {{ Request::segment(2) == 'hrd' && Request::segment(3) == 'attendance' ? 'active' : '' }}">Attendance</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/hrd/salary') }}" class="nav-link {{ Request::segment(2) == 'hrd' && Request::segment(3) == 'salary' ? 'active' : '' }}">Salary</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/hrd/commission') }}" class="nav-link {{ Request::segment(2) == 'hrd' && Request::segment(3) == 'commission' ? 'active' : '' }}">Commission</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/hrd/job_desc') }}" class="nav-link {{ Request::segment(2) == 'hrd' && Request::segment(3) == 'job_desc' ? 'active' : '' }}">Job Desc</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'settings' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-gear"></i> 
                            <span>Settings</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Settings">
                            <li class="nav-item">
                                <a href="{{ url('admin/settings/user') }}" class="nav-link {{ Request::segment(2) == 'settings' && Request::segment(3) == 'user' ? 'active' : '' }}">User</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/settings/2fa') }}" class="nav-link {{ Request::segment(2) == 'settings' && Request::segment(3) == '2fa' ? 'active' : '' }}">2FA</a>
                            </li>
                        </ul>
                    </li>
                    {{-- <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'news' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-newspaper"></i> 
                            <span>News</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="News">
                            <li class="nav-item">
                                <a href="{{ url('admin/news/category') }}" class="nav-link {{ Request::segment(2) == 'news' && Request::segment(3) == 'category' ? 'active' : '' }}">Category</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/news/news') }}" class="nav-link {{ Request::segment(2) == 'news' && Request::segment(3) == 'news' ? 'active' : '' }}">News</a>
                            </li>
                        </ul>
                    </li> --}}
                    {{-- <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'product' ? 'nav-item-expanded nav-item-open' : '' }}">
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
                    </li> --}}
                    {{-- <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'cogs' ? 'nav-item-expanded nav-item-open' : '' }}">
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
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'manage' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-database"></i> 
                            <span>Manage</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Manage">
                            <li class="nav-item">
                                <a href="{{ url('admin/manage/career') }}" class="nav-link {{ Request::segment(2) == 'manage' && Request::segment(3) == 'career' ? 'active' : '' }}">Career</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/manage/customer') }}" class="nav-link {{ Request::segment(2) == 'manage' && Request::segment(3) == 'customer' ? 'active' : '' }}">Customer</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/manage/order') }}" class="nav-link {{ Request::segment(2) == 'manage' && Request::segment(3) == 'order' ? 'active' : '' }}">Order</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/manage/invoice') }}" class="nav-link {{ Request::segment(2) == 'manage' && Request::segment(3) == 'invoice' ? 'active' : '' }}">Invoice</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/manage/purchase_order') }}" class="nav-link {{ Request::segment(2) == 'manage' && Request::segment(3) == 'purchase_order' ? 'active' : '' }}">Purchase Order</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/manage/delivery_order') }}" class="nav-link {{ Request::segment(2) == 'manage' && Request::segment(3) == 'delivery_order' ? 'active' : '' }}">Delivery Order</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'project' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-briefcase"></i> 
                            <span>Project</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Project">
                            <li class="nav-item">
                                <a href="{{ url('admin/project/data') }}" class="nav-link {{ Request::segment(2) == 'project' && Request::segment(3) == 'data' ? 'active' : '' }}">Data</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'hrd' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-stack-text"></i> 
                            <span>HRD</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="HRD">
                            <li class="nav-item">
                                <a href="{{ url('admin/hrd/job_desc') }}" class="nav-link {{ Request::segment(2) == 'hrd' && Request::segment(3) == 'job_desc' ? 'active' : '' }}">Job Desc</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item nav-item-submenu {{ Request::segment(2) == 'voucher' ? 'nav-item-expanded nav-item-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="icon-ticket"></i> 
                            <span>Voucher</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Voucher">
                            <li class="nav-item">
                                <a href="{{ url('admin/voucher/brand') }}" class="nav-link {{ Request::segment(2) == 'voucher' && Request::segment(3) == 'brand' ? 'active' : '' }}">Brand</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/voucher/category') }}" class="nav-link {{ Request::segment(2) == 'voucher' && Request::segment(3) == 'category' ? 'active' : '' }}">Category</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/voucher/global') }}" class="nav-link {{ Request::segment(2) == 'voucher' && Request::segment(3) == 'global' ? 'active' : '' }}">Global</a>
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
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>