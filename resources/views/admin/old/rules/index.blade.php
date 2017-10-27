@extends($scope.'.layouts.master')

@section('title')
<div class="container-fluid mt">
    <div class="row">
        <div class="col-md-12">
            <div class="content-panel">
                <h3 class="custome-title">{{ __('admin.'.$module.' '.'List') }}</h3>
                @stop
                @section('content')

                <div class="col-lg-12">
                    @if($auth::can('create',$module))
                    <a class="btn btn-primary" href="admin/{{$module}}/create"><span class="ti-plus"></span> {{__('admin.Create')}}</a>
                    @endif
                </div>

                <div class="table-responsive">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display resize data_table">
                        <thead>
                            <tr>
                                <th width="5%">{{__('admin.name')}}</th>


                                <th width="5%">{{__('admin.Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $row)
                            <tr><?php ?>
                                <td class="center">{{$row->name}}</td>
                                <td class="center">
                                    @if($row->deleteabel!=0)
                                    @if($auth::can('edit',$module))
                                    <a class="btn btn-primary btn-xs" href="admin/{{$module}}/edit/{{$row->id}}" title="{{__('admin.edit')}}" title="{{__(" admin.edit ")}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endif
                                    @if($auth::can('delete',$module))
                                    <a class="btn btn-theme04 btn-xs has-confirmation-message" href="admin/{{$module}}/delete/{{$row->id}}" title="{{__('admin.Delete')}}" data-title="{{__('admin.Confirmation message')}}" data-confirm="{{__('admin.Are you sure you want to delete this '.Amit\Support\Str::singular($module).'?')}}" title="{{__(" admin.Delete ")}}">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                    @endif
                                    @endif
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    {!!$rows->links()!!}
                </div>

            </div>
        </div>
    </div>
</div>
@stop

