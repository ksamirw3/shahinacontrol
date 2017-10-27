<!-- **********************************************************************************************************************************************************
    TOP BAR CONTENT & NOTIFICATIONS
    *********************************************************************************************************************************************************** -->
<!--header start-->
<header class="header black-bg">
    @if(Amit\Msic\Lang::isArabic())
        <div class="sidebar-toggle-box pull-right">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
    @else
        <div class="sidebar-toggle-box pull-left">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        @endif

                <!--logo start-->
        <a href="admin/dashboard" class="logo"><b>shahina <span style="color: #FCB322;">global</span></b></a>
        <!--logo end-->
        <div class="top-menu">
            @if(Amit\Msic\Lang::isArabic())
                <ul class="nav pull-left top-menu">
                    <li><a class="logout"
                           href="{{request()->url()}}?language={{(Amit\Msic\Lang::isArabic()?"en":"ar")}}">
                            {{(Amit\Msic\Lang::isArabic()?"ENGLISH":"عربى")}}
                        </a>
                    </li>
                    <li><a class="logout" href="admin/auth/logout">{{ __('admin.Logout') }}</a></li>
                </ul>
            @else
                <ul class="nav pull-right top-menu">
                    <li><a class="logout"
                           href="{{request()->url()}}?language={{(Amit\Msic\Lang::isArabic()?"en":"ar")}}">
                            {{(Amit\Msic\Lang::isArabic()?"ENGLISH":"عربى")}}
                        </a>
                    </li>
                    <li><a class="logout" href="admin/auth/logout">{{ __('admin.Logout') }}</a></li>
                </ul>
            @endif

        </div>
</header>
<!--header end-->
