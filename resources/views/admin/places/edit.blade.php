@extends('layouts.dashboard')

@section('content')
    <div class="text-center">
        <h3 class="custome-title">{{ __('admin.Edit '.str_singular($module)) }}</h3>
        <a href="{{$scope}}/{{$module}}/index" class="btn btn-theme04"><i
                    class="fa fa-backward"></i> {{__('admin.Go back')}}</a><br><br>

            {!! Form::model($row, ['url' => $scope.'/'.$module.'/edit/'.@$row->id, 'method' => 'post','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data'] ) !!}
            {!! Form::hidden('id',@$row->id)!!}
            @include($scope.'.'.$module.'.form')
            {!! Form::submit(__('admin.Save') ,['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}


    </div>
@stop
