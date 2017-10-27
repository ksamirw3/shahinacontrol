<header class="header black-bg">
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
    </div>
    <!--logo start-->
    <a style="" href="admin" class="logo pull-left"><img  src="assets/global/images/logo.png"></a>
    <!--logo end-->
    <div class="top-menu pull-right">
        <!--        <ul class="nav pull-right top-menu">
                    <li><a id="logOutBtn" class="logout" href="admin/auth/logout">{{__('admin.Logout')}}</a></li>
                    <li><a class="logout" href="admin/admins/change-password">{{__('admin.change passwrod')}}</a></li>
                </ul>-->

        <ul class="nav pull-right top-menu" style="margin-top: 15px;margin-left: 30px;">
            <li class="dropdown">

                <a href="javascript:void(0)" class="dropdown-toggle btn-theme04" data-toggle="dropdown">{{__("admin.Welcome")}} {{@\App\Http\Authantications\AdminAuth::user()->username}} <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{$scope}}/admins/edit-account">{{__('admin.Edit account')}}</a></li>
                    <li><a href="{{$scope}}/admins/change-password">{{__('admin.Change password')}}</a></li>
                    <li><a class="logout has-confirmation-message" href="{{$scope}}/auth/logout" data-title="{{__('admin.Confirmation message')}}" data-confirm="{{__('admin.Are you sure you want to logout?')}} ">{{__('admin.Logout')}}</a></li>
                </ul>
            </li>
            <li></li>
        </ul>
    </div>
</header>
