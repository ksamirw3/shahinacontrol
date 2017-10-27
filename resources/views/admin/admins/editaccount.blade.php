@extends('layouts.dashboard')

@section('content')

<div class="container">
	<h3 class="custome-title"><i class="ti-pencil-alt"></i> {{ __('admin.Update Account') }}</h3>

	{!! Form::model($row, ['url' => $scope.'/'.$module.'/edit-account', 'method' => 'post','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data'] ) !!}
	{!! Form::hidden('id',$row->id)!!}
	@include($scope.'.'.$module.'.form')
	{!! Form::submit(__('admin.Save') ,['class' => 'btn btn-info']) !!} {!! Form::close() !!}
</div>

@stop

