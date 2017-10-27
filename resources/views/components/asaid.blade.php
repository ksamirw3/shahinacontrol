<!-- **********************************************************************************************************************************************************
     MAIN SIDEBAR MENU
     *********************************************************************************************************************************************************** -->

     <!--sidebar start-->
     <aside>
        <div id="sidebar" class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">

                <p class="centered">
                    <a href="{{ url('admin/dashboard') }}">
                        <img src="assets/img/ui-sam.jpg" class="img-circle" width="80">
                    </a>
                </p>

                <h5 style="text-transform: uppercase;" class="centered">{{@$auth::user()->username}} 
                    <a style="color: #FCB322;" href="admin/admins/edit-account"><i class="fa fa-cogs"></i></a></h5>

                    {{-- */$active=(request()->is('admin/dashboard'))?'active':'';/* --}}
                    <li class="mt">
                        <a class="{{$active}}" href="admin/dashboard">
                            <i class="fa fa-dashboard"></i>
                            <span>{{__('admin.Dashboard')}}</span>
                        </a>
                    </li>
                   <?php // __()?>
                    {{-- */$active=(request()->is('admin/live-tracking'))?'active':'';/* --}}
                    <li class="mt">
                        <a class="{{$active}}" href="admin/live-tracking">
                            <i class="fa fa-map-marker"></i>
                            <span>{{__('admin.Live Tracking')}}</span>
                        </a>
                    </li>
                 
                    {{---------------------------------------------------------}}
                    {{-- */$input='drivers';/* --}}
                    {{-- */$active=(request()->is('admin/'.$input)||request()->is('admin/'.$input.'/*'))?'active':'';/* --}}
                    <li class="sub-menu ">
                        <a class="{{$active}}" href="javascript:;">
                            <i class="fa fa-truck" aria-hidden="true"></i>
                            <span style="text-transform: capitalize">{{__('admin.'.$input)}}</span>
                        </a>
                        <ul class="sub">
                            <li><a href="admin/{{$input}}/index"><i class="fa fa-angle-right"></i>  {{__('admin.All Drivers')}}</a></li>
                            <li><a href="admin/{{$input}}/create"><i class="fa fa-angle-right"></i>  {{__('admin.Add Driver')}}</a></li>
                        </ul>
                    </li>
                    {{---------------------------------------------------------}}
                    {{-- */$input='users';/* --}}
                    {{-- */$active=(request()->is('admin/'.$input)||request()->is('admin/'.$input.'/*'))?'active':'';/* --}}
                    <li class="sub-menu ">
                        <a class="{{$active}}" href="javascript:;">
                            <i class="fa fa-users"></i>
                            <span style="text-transform: capitalize"> {{__('admin.'.$input)}}</span>
                        </a>
                        <ul class="sub">
                            <li><a href="admin/{{$input}}/index"><i class="fa fa-angle-right"></i>  {{__('admin.All Users')}}</a></li>
                        </ul>
                    </li>
                    {{---------------------------------------------------------}}
                    {{-- */$input='categories';/* --}}
                    {{-- */$active=(request()->is('admin/'.$input)||request()->is('admin/'.$input.'/*'))?'active':'';/* --}}
                    <li class="sub-menu ">
                        <a class="{{$active}}" href="javascript:;">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                            <span style="text-transform: capitalize"> {{__('admin.'.$input)}}</span>
                        </a>
                        <ul class="sub">
                            <li><a href="admin/{{$input}}/index"><i class="fa fa-angle-right"></i>  {{__('admin.All Categories')}}</a></li>
                            <li><a href="admin/{{$input}}/create"><i class="fa fa-angle-right"></i>  {{__('admin.Create Category')}}</a></li>
                        </ul>
                    </li>
                    {{---------------------------------------------------------}}
                    {{-- */$input='places';/* --}}
                    {{-- */$active=(request()->is('admin/'.$input)||request()->is('admin/'.$input.'/*'))?'active':'';/* --}}
                    <li class="sub-menu ">
                        <a class="{{$active}}" href="javascript:;">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span style="text-transform: capitalize"> {{__('admin.'.$input)}}</span>
                        </a>
                        <ul class="sub">
                            <li><a href="admin/{{$input}}/index"><i class="fa fa-angle-right"></i>  {{__('admin.All Places')}}</a></li>
                            <li><a href="admin/{{$input}}/create"><i class="fa fa-angle-right"></i>  {{__('admin.Create Place')}}</a></li>
                        </ul>
                    </li>
                    {{---------------------------------------------------------}}
                    {{-- */$input='promotions';/* --}}
                    {{-- */$active=(request()->is('admin/'.$input)||request()->is('admin/'.$input.'/*'))?'active':'';/* --}}
                    <li class="sub-menu ">
                        <a class="{{$active}}" href="javascript:;">
                            <i class="fa fa-money" aria-hidden="true"></i>
                            <span style="text-transform: capitalize"> {{__('admin.'.$input)}}</span>
                        </a>
                        <ul class="sub">
                            <li><a href="admin/{{$input}}/index"><i class="fa fa-angle-right"></i>  {{__('admin.All Promotions')}}</a></li>
                            <li><a href="admin/{{$input}}/create"><i class="fa fa-angle-right"></i>  {{__('admin.Add Promotion')}}</a></li>
                        </ul>
                    </li>
                    {{---------------------------------------------------------}}
                    {{-- */$input='orders';/* --}}
                    {{-- */$active=(request()->is('admin/'.$input)||request()->is('admin/'.$input.'/*'))?'active':'';/* --}}
                    <li class="sub-menu ">
                        <a class="{{$active}}" href="javascript:;">
                            <i class="fa fa-shopping-cart"></i>
                            <span style="text-transform: capitalize"> {{__('admin.'.$input)}}</span>
                        </a>
                        <ul class="sub">
                            <li><a href="admin/{{$input}}/index"><i class="fa fa-angle-right"></i>  {{__('admin.All Orders')}}</a></li>
                        </ul>
                    </li>
                    {{---------------------------------------------------------}}
                    {{-- */$input='transactions';/* --}}
                    {{-- */$active=(request()->is('admin/'.$input)||request()->is('admin/'.$input.'/*'))?'active':'';/* --}}
                    <li class="sub-menu ">
                        <a class="{{$active}}" href="javascript:;">
                            <i class="fa fa-thumbs-up"></i>
                            <span style="text-transform: capitalize"> {{__('admin.'.$input)}}</span>
                        </a>
                        <ul class="sub">
                            <li><a href="admin/{{$input}}/index"><i class="fa fa-angle-right"></i>  {{__('admin.All Transactions')}}</a></li>
                        </ul>
                    </li>
                    {{---------------------------------------------------------}}
                    {{-- */$input='reports';/* --}}
                    {{-- */$active=(request()->is('admin/'.$input)||request()->is('admin/'.$input.'/*'))?'active':'';/* --}}
                    <li class="sub-menu ">
                        <a class="{{$active}}" href="javascript:;">
                            <i class="fa fa-paste"></i>
                            <span style="text-transform: capitalize"> {{__('admin.'.$input)}}</span>
                        </a>
                        <ul class="sub">
                            <li><a href="admin/{{$input}}/drivers"><i class="fa fa-angle-right"></i>  {{__('admin.Drivers Report')}}</a></li>
                            <li><a href="admin/{{$input}}/clients"><i class="fa fa-angle-right"></i>  {{__('admin.Clients Report')}}</a></li>
                            <li><a href="admin/{{$input}}/transactions"><i class="fa fa-angle-right"></i>  {{__('admin.Transactions Report')}}</a></li>
                            <li><a href="admin/{{$input}}/orders"><i class="fa fa-angle-right"></i>  {{__('admin.Orders Report')}}</a></li>
                        </ul>
                    </li>
                    {{---------------------------------------------------------}}
                    {{---------------------------------------------------------}}
                    {{-- */$input='settings';/* --}}
                    {{-- */$active=(request()->is('admin/'.$input)||request()->is('admin/'.$input.'/*'))?'active':'';/* --}}
                    <li class="sub-menu ">
                        <a class="{{$active}}" href="javascript:;">
                            <i class="fa fa-cogs"></i>
                            <span style="text-transform: capitalize"> {{__('admin.'.$input)}}</span>
                        </a>
                        <ul class="sub">
                            <li><a href="admin/{{$input}}/index"><i class="fa fa-angle-right"></i>  {{__('admin.Edit')}}</a></li>
                        </ul>
                    </li>


                </ul>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
