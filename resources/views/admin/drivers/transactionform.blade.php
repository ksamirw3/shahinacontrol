{{-- */$input='amount';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.'.$input)."",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number($input,@$row->$input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>