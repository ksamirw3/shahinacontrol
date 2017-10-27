
{{-- */$input='name';/* --}}
<div class="form-group col-md-12 {{ $errors->has($input) ? 'has-error' : '' }}">
    {!! Form::rawLabel($input,__('admin.'.$input)."<em class='red'>*</em>",['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text($input,@$row->$input,['class'=>'form-control']) !!}
        @foreach($errors->get($input) as $message)
        <span class = 'help-inline text-danger'>{{ $message }}</span>
        @endforeach
    </div>
</div>
<hr/>
<?php // dd($permissions); ?>
<div class="text-right">
    <button id="check" type="button" class="btn btn-success">check all</button>
    <button id="uncheck" type="button" class="btn btn-success">uncheck all</button>
</div>
<?php

function ref($k) {
    switch ($k) {
        case 'coursesinstructors':
            return ' course instructors';
            break;
        case 'studentsgroups':
            return ' Students groups';
            break;
        default :
            return $k;
            break;
    }
}
?>
<div class="text-left" id="input-cont">
    <section>
        @foreach($permissions as $key=> $permission)
        <h1  class="title capitalize">{{ref($key)}}</h1>
        @foreach($permission as $row)
        <label class="newLable">
            {{-- */$st=(@in_array($row->id,@$myPermissions))?true:false;/* --}}
            {!! Form::checkbox($row->id,null,$st,['class'=>'']) !!}  - {{$row->label}}
        </label>
        @endforeach
        @endforeach
    </section>
</div>
<br/>
@section('js')
<script>
    $('#check').click(function () {
        $('#input-cont').find('[type=checkbox]').each(function () {
            $(this).prop('checked', true)
        })
    })
    $('#uncheck').click(function () {
        $('#input-cont').find('[type=checkbox]').each(function () {
            $(this).prop('checked', false)
        })
    })
</script>
@stop