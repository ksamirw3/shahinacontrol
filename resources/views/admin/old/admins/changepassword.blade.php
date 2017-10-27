@extends($scope.'.layouts.master')

@section('title')
<div class="container-fluid mt">
    <div class="row">
        <div class="col-md-12">
            <div class="content-panel">
                <h3 class="custome-title"><i class="ti-key"></i>{{ __('admin.Change password') }}</h3>
                @stop

                @section('content')
                {!! Form::model($row, ['method' => 'post','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data'] ) !!}
                {{-- */$input='old_password';/* --}}
                <div class="form-group {{ $errors->has($input) ? 'has-error' : '' }}">
                    {!! Form::rawLabel($input,__('admin.Current Password')."<em class='red'>*</em>",['class' => 'col-md-2 control-label']) !!}
                    <div class="col-md-6">
                        {!! Form::password($input,['class'=>'form-control','required'=>'required']) !!}
                        @if(@$errors->get($input)[0])
                        <span class = 'help-inline text-danger'>{{ $errors->get($input)[0] }}</span>
                        @endif
                    </div>
                </div>
                {{-- */$input='password';/* --}}
                <div class="form-group {{ $errors->has($input) ? 'has-error' : '' }}">
                    {!! Form::rawLabel($input,__('admin.'.$input)."<em class='red'>*</em>",['class' => 'col-md-2 control-label']) !!}
                    <div class="col-md-6">
                        {!! Form::password($input,['class'=>'form-control','required'=>'required']) !!}
                        @if(@$errors->get($input)[0])
                        <span class = 'help-inline text-danger'>{{ $errors->get($input)[0] }}</span>
                        @endif
                    </div>
                </div>
                {{-- */$input='password_confirmation';/* --}}
                <div class="form-group {{ $errors->has($input) ? 'has-error' : '' }}">
                    {!! Form::rawLabel($input,__('admin.'.$input)."<em class='red'>*</em>",['class' => 'col-md-2 control-label']) !!}
                    <div class="col-md-6">
                        {!! Form::password($input,['class'=>'form-control','required'=>'required']) !!}
                        @if(@$errors->get($input)[0])
                        <span class = 'help-inline text-danger'>{{ $errors->get($input)[0] }}</span>
                        @endif
                    </div>
                </div>
                {!! Form::submit(__('admin.Save') ,['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div></div></div></div>
@stop
