   <!-- SIDEBAR -->
   <div class="app-sidebar sidebar-shadow">
    @php
        $themeColor = Auth::user()->preference->system_color ?? '#4CAF50';

        $hex = str_replace('#', '', $themeColor);
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));

        $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b);
        $textColor = $luminance > 186 ? '#000000' : '#FFFFFF'; 
        @endphp

        <style>
        .vertical-nav-menu li a.mm-active  {
            background-color: {{ $themeColor }};
            color: {{ $textColor }};
            border-color: {{ $themeColor }};
        }
          .vertical-nav-menu ul>li>a.mm-active {
            background-color: {{ $themeColor }};
            color: {{ $textColor }};
            border-color: {{ $themeColor }};
        }
        
</style>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu metismenu">
                <li class="app-sidebar__heading">Menu</li>
                

                <li>
                    <a href="{{ route('Dashboard') }}" class="{{ Request::is('Dashboard') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon fa fa-laptop"></i> Dashboard
                    </a>
                </li>
                
              <li>
                    <a href="{{ route('settings/category') }}" class="{{ Request::is('settings/category') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon fa fa-layer-group"></i> Category
                    </a>
                </li>
                <li>
                    <a href="{{ route('product/index') }}" class="{{ Request::is('product/index') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon fa fa-list"></i> Food Management
                    </a>
                </li>
                 
                
                  <li>
                    <a href="{{ route('orders/orders') }}" class="{{ Request::is('orders/orders') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon fa fa-clipboard-list"></i> Orders
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="metismenu-icon fa fa-folder-open"></i> Reports
                        <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                    </a>
                    <ul>
                           <li class="{{ Request::is('reports/salesreport') ? 'mm-active' : '' }}">
                            <a href="{{ route('reports/salesreport') }}"  class="{{ Request::is('reports/salesreport') ? 'mm-active' : '' }}">
                                <i class="metismenu-icon"></i> <i class="fa fa-users"> Sales Report</i> 
                            </a>
                        </li>
                           <li class="{{ Request::is('reports/paymenthistory') ? 'mm-active' : '' }}">
                            <a href="{{ route('reports/paymenthistory') }}"  class="{{ Request::is('reports/paymenthistory') ? 'mm-active' : '' }}">
                                 <i class="metismenu-icon"></i> <i class="fa fa-users"> Payment History</i> 
                            </a>
                        </li>
                        
                    </ul>
                </li>
             
                <li>
                    <a href="{{ route('users/index') }}"  class="{{ Request::is('users/index') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon fa fa-users"></i>Registered Users
                    </a>
                </li>
                <li>
                    <a href="{{ route('settings/system-configuration') }}"  class="{{ Request::is('settings/system-configuration') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon fa fa-cogs"></i> System Appearance
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile') }}"  class="{{ Request::is('profile') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon fa fa-user"></i> Profile
                    </a>
                </li>
                  <li>
                    <a href="{{ route('cashier') }}" class="{{ Request::is('cashier') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon fa fa-cash-register"></i> Cashier
                    </a>
                </li>
                <li>
                    <a href="{{ route('kitchen') }}" class="{{ Request::is('kitchen') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon fa fa-utensils"></i> Kitchen
                    </a>
                </li>

            </ul>
            
        </div>
    </div>
    
</div>
