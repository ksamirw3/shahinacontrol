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
                                <th width="5%">{{__('admin.Username')}}</th>
                                <th width="5%">{{__('admin.Email')}}</th>
                                <th width="5%">{{__('admin.Rule')}}</th>
                                <th width="5%">{{__('admin.Active')}}</th>
                                <!--<th width="5%" class="sorted">{{__('admin.Created at')}}</th>-->
                                <th width="5%">{{__('admin.Actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $row)
                            <tr>
                                <?php
                                ?>
                                <td class="center">{{@$row->username }}</td>
                                <td class="center">{{@$row->email }}</td>
                                <td class="center">{{@$row->rule->name }}</td>
                                <td class="center">
                                    <form action="{{$scope}}/{{$module}}/active/{{$row->id}}" method="post">
                                        {{csrf_field()}}
                                        @if(@$row->active)
                                        <input  onchange="this.form.submit()" name="active" value="0" type="checkbox" checked="" />
                                        @else
                                        <input  onchange="this.form.submit()" name="active" value="1" type="checkbox" />
                                        @endif
                                    </form>
                                </td>
                                <!--<td class="center">{{@$row->created_at}}</td>-->
                                <td class="center">
                                    @if($auth::can('edit',$module))
                                    <a class="btn btn-primary btn-xs" href="{{$scope}}/{{$module}}/edit/{{$row->id}}" title="{{__('admin.edit')}}" title="{{__(" admin.edit ")}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endif
                                    @if($auth::can('view',$module))
                                    <a class="btn btn-primary btn-xs" href="{{$scope}}/{{$module}}/view/{{$row->id}}" title="{{__('admin.view')}}" title="{{__(" admin.view ")}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
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

