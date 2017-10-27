@extends($scope.'.layouts.login')
@section('content')

<form id="login-panel" class="form-login boxShadow" method="post" enctype="multipart/form-data" id="form">
    <div class="logo-login text-center">
        <img src="assets/global/images/logo.png" style="width: 250px;padding-top: 20px">

    </div>
    <h2 class="form-login-heading">{{__("admin.Login")}}</h2>
    <div class="login-wrap">
        @include($scope.'.partials.flash_messages') {!! csrf_field() !!}
        <!--{!! Form::label('email',__("admin.email"), ['class' => 'control-label'])  !!}-->
        {!! Form::email('email',old('email'),['class'=>'form-control','placeholder'=>__("admin.email")]) !!} @foreach($errors->get('email') as $message)
        <span class='help-inline text-danger'>{{ $message }}</span> @endforeach
        <br>
        <!--{!! Form::label('password',__("admin.password"), ['class' => 'control-label'])  !!}-->
        {!! Form::password('password',['class'=>'form-control','placeholder'=>__("admin.password")]) !!} @foreach($errors->get('password') as $message)
        <span class='help-inline text-danger'>{{ $message }}</span> @endforeach
        <br> {!! Form::submit(__('admin.login') ,['class' => 'btn btn-theme btn-block','name'=>'login']) !!}
        <hr>
        <a href="admin/auth/forgot-password" class="btn btn-block">{{__('admin.Forgot password')}}</a>
    </div>
</form>
@stop
