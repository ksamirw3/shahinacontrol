@extends('layouts.login')
@section('content')
<!--logo start-->
<!--logo end-->
<form class="form-login boxShadow" method="post" enctype="multipart/form-data" id="form">
    <div class="logo-login text-center">
    </div>
    <h2 class="form-login-heading">{{__("admin.Forgot password")}}</h2>
    <div class="login-wrap">
        @include('components.flash_messages')
        {!! csrf_field() !!}
        {!! Form::email('email',old('email'),['class'=>'form-control','placeholder'=>__("admin.email")]) !!} @foreach($errors->get('email') as $message)
        <span class='help-inline text-danger'>{{ $message }}</span> @endforeach
        <br>
        {!! Form::submit(__('admin.send') ,['class' => 'btn btn-theme btn-block','name'=>'send','onclick'=>"this.form.submit();this.disabled=true;"]) !!}
        <hr>
        <a   href="admin/auth/login" class="btn btn-block">{{__('admin.Go back')}} <i class="fa fa-chevron-left fa-1x" style="margin-top:3px;"></i></a>
    </div>
</form>
@stop
