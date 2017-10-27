@extends('layouts.dashboard')

@section('content')

<div class="text-center">
    <h3 class="custome-title">{{ __('admin.'.$module) }}</h3>

    <br><br>

    <div class="row center">
        <div class="col-sm-10">
            <form class="form-group" method="POST" action="{{ url('admin/settings/create') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                @foreach($forms as $form)
                <div class="form-group col-sm-8">
                    <label for="exampleInputEmail1">{{ __('admin.'.$form->label) }}</label>
                    <input name="{{ $form->name }}" type="{{ $form->type }}" class="form-control" id="" value="{{ $form->value }}" 
                    placeholder="{{ $form->place_holder }}" />
                </div>
                @endforeach

                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-6">
                      <button type="submit" class="btn btn-default">{{ __('admin.Save') }}</button>
                  </div>
              </div>

          </form>

      </div>
  </div>
</div>

@stop

