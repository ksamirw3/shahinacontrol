<aside class="main-asaid">
    <div id="cs-sidebar"  class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion" >

            {{-- */$dir='drivers';/* --}}
            <li class="mt">
                <a class="{{((Request::is('admin/'.$dir)||Request::is('admin/'.$dir.'/*'))&& !Request::is('admin/'.$dir.'/edit-account') )?'active':''}}" href="admin/{{$dir}}">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span style="text-transform: capitalize">{{__('admin.'.$dir)}}</span>
                </a>
            </li>
            {{-- */$dir='promotions';/* --}}
            <li class="mt">
                <a class="{{((Request::is('admin/'.$dir)||Request::is('admin/'.$dir.'/*'))&& !Request::is('admin/'.$dir.'/edit-account') )?'active':''}}" href="admin/{{$dir}}">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span style="text-transform: capitalize">{{__('admin.'.$dir)}}</span>
                </a>
            </li>


            {{-- */$dir='users';/* --}}
            <li class="mt">
                <a class="{{((Request::is('admin/'.$dir)||Request::is('admin/'.$dir.'/*'))&& !Request::is('admin/'.$dir.'/edit-account') )?'active':''}}" href="admin/{{$dir}}">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span style="text-transform: capitalize">{{__('admin.'.$dir)}}</span>
                </a>
            </li>

            {{-- */$dir='orders';/* --}}
            <li class="mt">
                <a class="{{((Request::is('admin/'.$dir)||Request::is('admin/'.$dir.'/*'))&& !Request::is('admin/'.$dir.'/edit-account') )?'active':''}}" href="admin/{{$dir}}">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span style="text-transform: capitalize">{{__('admin.'.$dir)}}</span>
                </a>
            </li>

            {{-- */$dir='transactions';/* --}}
            <li class="mt">
                <a class="{{((Request::is('admin/'.$dir)||Request::is('admin/'.$dir.'/*'))&& !Request::is('admin/'.$dir.'/edit-account') )?'active':''}}" href="admin/{{$dir}}">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span style="text-transform: capitalize">{{__('admin.'.$dir)}}</span>
                </a>
            </li>

            {{-- */$dir='reports';/* --}}
            <li class="mt">
            <a href=""><i class="fa fa-check-square"></i> <span>Reports</span></a>
                <ul class="children">
                    <li>
                        <a class="{{((Request::is('admin/'.$dir)||Request::is('admin/'.$dir.'/*'))&& !Request::is('admin/'.$dir.'/edit-account') )?'active':''}}" href="admin/{{$dir}}">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <span style="text-transform: capitalize">{{__('admin.'.'Driver Reports')}}</span>
                        </a>
                    </li>
                </ul>
            </li>



        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
