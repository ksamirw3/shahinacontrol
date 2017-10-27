@extends('admin/layouts/master')

@section('title')
<h4><i class="fa fa-angle-right"></i>{{ __('admin.dashboard') }}</h4>
@stop

@section('content')

@if(ACL::can('view-categories'))
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb">
    <div class="darkblue-panel pn">
        <a href="admin/categories/index">
            <div class="darkblue-header">
                <h4>{{__('admin.categories')}}</h4>
            </div>
            <h1 class="mt"><i class="fa fa-wpforms fa-2x"></i></h1>
        </a>
        <footer>
            <div class="centered">
                <h5>{{@$categories_count}} {{__('admin.category')}}</h5>
            </div>
        </footer>
    </div>
</div>
@endif
@if(ACL::can('view-publications'))
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb">
    <div class="darkblue-panel pn">
        <a href="admin/publications/index">
            <div class="darkblue-header">
                <h4>{{__('admin.publications')}}</h4>
            </div>
            <h1 class="mt"><i class="fa fa-archive fa-2x"></i></h1>
        </a>
        <footer>
            <div class="centered">
                <h5>{{@$publications_count}} {{__('admin.publications')}}</h5>
            </div>
        </footer>
    </div>
</div>
@endif

@if(ACL::can('view-releases'))
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb">
    <div class="darkblue-panel pn">
        <a href="admin/releases/index">
            <div class="darkblue-header">
                <h4>{{__('admin.Releases')}}</h4>
            </div>
            <h1 class="mt"><i class="fa fa-book fa-2x"></i></h1>
        </a>
        <footer>
            <div class="centered">
                <h5>{{@$releases_count}} {{__('admin.release')}}</h5>
            </div>
        </footer>
    </div>
</div>
@endif

@if(ACL::can('view-contacts'))
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb">
    <div class="darkblue-panel pn">
        <a href="admin/contacts/index">
            <div class="darkblue-header">
                <h4>{{__('admin.Magazine Subscriptions')}}</h4>
            </div>
            <h1 class="mt"><i class="fa fa-envelope fa-2x"></i></h1>
        </a>
        <footer>
            <div class="centered">
                <h5>{{@$contacts_count}} {{__('admin.message')}}</h5>
            </div>
        </footer>
    </div>
</div>
@endif

@if(ACL::can('view-contacts'))
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb">
    <div class="darkblue-panel pn">
        <a href="admin/fairs/index">
            <div class="darkblue-header">
                <h4>{{__('admin.News')}}</h4>
            </div>
            <h1 class="mt"><i class="fa fa-newspaper-o fa-2x"></i></h1>
        </a>
        <footer>
            <div class="centered">
                <h5>{{@$news_count}} {{__('admin.News')}}</h5>
            </div>
        </footer>
    </div>
</div>
@endif

@if(ACL::can('view-contacts'))
<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb">
    <div class="darkblue-panel pn">
        <a href="admin/services/index">
            <div class="darkblue-header">
                <h4>{{__('admin.Services')}}</h4>
            </div>
            <h1 class="mt"><i class="fa fa-puzzle-piece fa-2x"></i></h1>
        </a>
        <footer>
            <div class="centered">
                <h5>{{@$services_count}} {{__('admin.Services')}}</h5>
            </div>
        </footer>
    </div>
</div>
@endif

@stop
