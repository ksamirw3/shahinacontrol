@extends($scope.'.layouts.master')



@section('title')
<div class="container-fluid mt">
    <div class="row">
        <div class="col-md-12">
            <div class="content-panel">
                <h3>{{ __('admin.Create '.str_singular($module)) }}</h3>
                <a href="{{$scope}}/{{$module}}/index" class="btn btn-theme04"><i class="fa fa-backward"></i> {{__('admin.Go back')}}</a><br><br>
                @stop

                @section('content')
                {!! Form::model($row,['url' => $scope.'/'.$module.'/create', 'method' => 'post','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data'] ) !!}
                @include($scope.'.'.$module.'.form')
                {!! Form::submit(__('admin.Save') ,['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div></div></div></div>
@stop
