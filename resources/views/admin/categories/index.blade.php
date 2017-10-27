@extends('layouts.dashboard')

@section('content')


<div class="text-center">
    <h3 class="custome-title">{{ __('admin.'.$module.' '.'List') }}</h3>


    <br><br>

    <code>{{ __('admin.Search for category by name in arabic or english') }}</code>

    <br><br>

    <div class="row">
        <form class="form-inline" method="get">
            <div class="form-group">
                <input name="name_en" value="{{ request()->name_en }}" type="text" class="form-control" id="exampleInputEmail1" placeholder="{{ __('admin.Name EN') }}">
            </div>

            <code>or</code>

            <div class="form-group">
                <input name="name_ar" value="{{ request()->name_ar }}" type="text" class="form-control" id="exampleInputEmail1" placeholder="{{ __('admin.Name AR') }}">
            </div>

            <button type="submit" class="btn btn-default">{{ __('admin.Search') }}</button>
        </form>
    </div>

    <br><br>

    <div class="table-responsive">

        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display resize">
            <thead>
                <tr>
                    <th width="30%">{{__('admin.Name EN')}}</th>
                    <th width="30%">{{__('admin.Name AR')}}</th>
                    <th width="20%">{{__('admin.Actions')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                <tr>
                    <td class="center">{{@$row->name_en}}</td>
                    <td class="center">{{@$row->name_ar}}</td>

                    <td class="center">
                        <a class="btn btn-primary btn-xs" href="admin/{{$module}}/view/{{$row->id}}"
                            title="{{__('admin.view')}}" title="{{__(" admin.view ")}}">
                            <i class="fa fa-eye"> {{ __('admin.View') }}</i>
                        </a>

                        <a class="btn btn-primary btn-xs" href="admin/{{$module}}/edit/{{$row->id}}"
                            title="{{__('admin.edit')}}" title="{{__(" admin.view ")}}">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"> {{ __('admin.Edit') }}</i>
                        </a>

                        <a class="btn btn-theme04 btn-xs has-confirmation-message"
                        href="admin/{{$module}}/delete/{{$row->id}}" title="{{__('admin.Delete')}}"
                        data-title="{{__('admin.Are you sure you want to delete this '.Amit\Support\Str::singular($module).'?')}}"
                        data-confirm="{{__('admin.if you you click "yes" you can not revert back ')}}" title="{{__(" admin.Delete")}}">
                        <i class="fa fa-trash-o"> {{ __('admin.Delete') }}</i>
                    </a>

                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>
<div>
    {!! $rows->links()!!}
</div>

</div>


@stop

