<div id="sidebar" class="nav-collapse ">
    <!--logo start-->
    <div id="logo-container">
        <a href="account/dashboard" class="logo"><img alt="logo" class="img-responsive" src="assets/admin/img/logo-white@2x.png"></a>
    </div>
    <!-- sidebar menu start-->
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">
        <div class="user-account">
            <h5 class="centered">{{__("account.Welcome")}} {{@App\Libs\PublisherAuth::user()->name}}</h5>
        </div>
        <li>
            <a href="account/dashboard" class="{{(Request::path()=='account/dashboard')?" active ":" "}}">
                <i class="fa fa-dashboard"></i>
                <span>{{__('account.Dashboard')}}</span>
            </a>
        </li>
        <li>
            <a href="account/items/index" class="{{(Request::is('account/items/*'))?" active ":" "}}">
                <i class="fa fa-book" aria-hidden="true"></i>
                <span>{{__('account.Items')}}</span>
            </a>
        </li>
    </ul>
    <!-- sidebar menu end-->
</div>
