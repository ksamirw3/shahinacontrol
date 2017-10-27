@extends($scope.'.layouts.master')
@section('title')
<div class="container-fluid mt">
    <div class="row">
        <div class="col-md-12">
            <div class="content-panel">
                <h3 class="custome-title"><i class="ti-pencil-alt"></i> {{ __('admin.Update Account ') }}</h3>
                @stop
                @section('content')
                {!! Form::model($row, ['url' => $scope.'/'.$module.'/edit-account', 'method' => 'post','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data'] ) !!}
                {!! Form::hidden('id',$row->id)!!}
                @include($scope.'.'.$module.'.form')
                {!! Form::submit(__('admin.Save') ,['class' => 'btn btn-primary']) !!} {!! Form::close() !!}
            </div></div></div></div>
@stop
<?php ?>