@extends($scope.'.layouts.master')

@section('title')
<div class="container-fluid mt">
    <div class="row">
        <div class="col-md-12">
            <div class="content-panel">
                <h3 class="custome-title">{{ __('admin.Edit '.str_singular($module)) }}</h3>
                <a href="{{$scope}}/{{$module}}/index" class="btn btn-theme04"><i class="fa fa-backward"></i> {{__('admin.Go back')}}</a><br><br>
                @stop

                @section('content')
                {!! Form::model(@$row, [ 'method' => 'post','class'=>'form-horizontal style-form','enctype'=>'multipart/form-data'] ) !!}
                {!! Form::hidden('id',@$row->id)!!}

                {{-- */$input='password';/* --}}
                <div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
                    {!! Form::rawLabel($input,__('admin.New Password')."<em class='red'>*</em>",['class' => 'col-md-2 control-label']) !!}
                    <div class="col-md-6">
                        {!! Form::text($input,@$row->$input,['class'=>'form-control']) !!}
                        @foreach($errors->get($input) as $message)
                        <span class = 'help-inline text-danger'>{{ $message }}</span>
                        @endforeach
                    </div>
                </div>



                {!! Form::submit(__('admin.Save') ,['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div></div></div></div>
@stop
