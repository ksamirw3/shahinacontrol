
@if(!Request::is('admin/admins/edit-account'))
{{-- */$input='rule_id';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.rule')."<em class='red'>*</em>",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select($input,$rules,null,['class'=>'form-control','placeholder'=>'please select group']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
@endif
{{-- */$input='username';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.'.$input)."<em class='red'>*</em>",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text($input,null,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>

{{-- */$input='email';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.'.$input)."<em class='red'>*</em>",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::email($input,null,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>

{{-- */$input='phone';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.'.$input),['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number($input,null,['class'=>'form-control','min'=>'0']) !!} @foreach($errors->get($input) as $message)
        <span class='help-inline text-danger'>{{ $message }}</span> @endforeach
    </div>
</div>

{{-- */$input='password';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.'.$input)."<em class='red'>*</em>",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::password($input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
{{-- */$input='password_confirmation';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.Confirm password')."<em class='red'>*</em>",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::password($input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
