@if ($page_name != 'coming_soon' && $page_name != 'error404' && $page_name != 'error500' && $page_name != 'error503' && $page_name != 'faq' && $page_name != 'helpdesk' && $page_name != 'maintenence' && $page_name != 'privacy' && $page_name != 'auth_boxed' && $page_name != 'auth_default')

    <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">
            
        <nav id="sidebar">
            <div class="shadow-bottom"></div>

            <ul class="list-unstyled menu-categories" id="accordionExample">
                <li class="menu {{ ($page_name === 'Dashboard') ? 'active' : '' }}">
                    <a href="#dashboard" data-active="{{ ($page_name != 'Dashboard') ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ ($category_name === 'dashboard') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <div class="">
                            {!!Route::is('home') ? '<i class="fa fa-cloud"></i>': '<i class="fa fa-tachometer"></i>'!!}
                            <span>Manage System</span> 
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled {{ ($page_name != 'Dashboard') ? 'show' : '' }}" id="dashboard" data-parent="#accordionExample">
                        <li class="{{ ($page_name == 'View Systems') ? 'active' : '' }}">
                            <a href="{{route('api-system')}}"> View Systems </a>
                        </li>

                        <li class="{{ ($page_name == 'New System') ? 'active' : '' }}">
                            <a href="{{route('new-system')}}"> New System </a>
                        </li>
                        
                        {{--<li class="{{ ($page_name == 'Templates') ? 'active' : '' }}">--}}
                            {{--<a href="{{route('template')}}"> Templates </a>--}}
                        {{--</li>--}}

                        <li class="{{ ($page_name == 'History') ? 'active' : '' }}">
                            <a href="{{route('api-history')}}"> History </a>
                        </li>
                        <li class="{{ ($page_name == 'General-Config') ? 'active' : '' }}">
                            <a href="{{url('general-config')}}"> General-Config </a>
                        </li>
                    </ul>
                </li>
            </ul>
            
        </nav>

    </div>
    <!--  END SIDEBAR  -->

@endif