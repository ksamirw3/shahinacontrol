

{{-- */$input='name_ar';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.name ar')."<em class='red'>*</em>",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text($input,@$row->$input,['class'=>'form-control', 'required' => 'true']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>



{{-- */$input='name_en';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.name en')."<em class='red'>*</em>",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text($input,@$row->$input,['class'=>'form-control', 'required' => 'true']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>

