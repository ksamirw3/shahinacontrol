
{{-- */$input='username';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.'.$input)."<em class='red'>*</em>",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text($input,@$row->$input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
@if(request()->is($scope.'/'.$module.'/create'))
{{-- */$input='password';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.'.$input)."<em class='red'>*</em>",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text($input,@$row->$input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
@endif
{{-- */$input='full_name';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.full name')."<em class='red'>*</em>",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text($input,@$row->$input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
{{-- */$input='date_r';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.registration date')."",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date($input,@$row->$input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
{{-- */$input='presonal_image';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.personal image')."",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::file($input,['class'=>'form-control']) !!}
        {!!        \Amit\Msic\RenderMedia::image(@$row->{$input}, 'uploads/')!!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
{{-- */$input='email';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.'.$input)."<em class='red'>*</em>",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::email($input,@$row->$input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
{{-- */$input='uploads_ids';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.upload id')."",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text($input,@$row->$input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
{{-- */$input='note';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.'.$input)."",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::textArea($input,@$row->$input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>

{{-- */$input='phone';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.'.$input)."<em class='red'>*</em>",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number($input,@$row->$input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>

{{-- */$input='car_size';/* --}}
{{-- */$cars=['small'=>'small','medium'=>'medium','large'=>'large'];/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.car size')."<em class='red'>*</em>",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select($input,$cars,@$row->$input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
            <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach

    </div>
</div>

{{-- */$input='year_model';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.year model')."",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number($input,@$row->$input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
{{-- */$input='nationality';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.'.$input)."",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text($input,@$row->$input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
{{-- */$input='national_id';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.national id')."",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number($input,@$row->$input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
{{-- */$input='date_expiration';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.date expiration')."",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::date($input,@$row->$input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
{{-- */$input='insurance_number';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.insurance number')."",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text($input,@$row->$input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
{{-- */$input='car_authorization';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.car authorization')."",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text($input,@$row->$input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
{{-- */$input='bank_name';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.bank name')."",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text($input,@$row->$input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
{{-- */$input='bank_IBAN';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.bank IBAN')."",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text($input,@$row->$input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
{{-- */$input='plate_no';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.plate no')."",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text($input,@$row->$input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
{{-- */$input='finger_print';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.finger print')."",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::file($input,['class'=>'form-control']) !!}
        {!!        \Amit\Msic\RenderMedia::image(@$row->{$input}, 'uploads/')!!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
{{-- */$input='driver_signature';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.driver signature')."",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text($input,@$row->$input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>





{{-- */$input='car_type';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.car size')."<em class='red'>*</em>",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select($input,$vehicles,@$row->$input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
            <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach

    </div>
</div>
