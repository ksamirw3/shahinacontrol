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

                <br><br>

                <code>Search for driver by email or user name or plate number</code>

                <br><br>

                <div class="row">
                    <form class="form-inline" method="get">
                        <div class="form-group">
                            <input name="email" type="text" class="form-control" id="exampleInputEmail1" placeholder="Email">
                        </div>

                        <code>or</code>

                        <div class="form-group">
                            <input name="username" type="text" class="form-control" id="exampleInputEmail1" placeholder="User Name">
                        </div>

                        <code>or</code>

                        <div class="form-group">
                            <input name="plate_no" type="text" class="form-control" id="exampleInputEmail1" placeholder="Plate Number">
                        </div>

                        <button type="submit" class="btn btn-default">Search</button>
                    </form>
                </div>

                <div class="table-responsive">

                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display resize">
                        <thead>
                            <tr>
                                <th width="1%">{{__('admin.presonal_image')}}</th>
                                <th width="5%">{{__('admin.username')}}</th>
                                <th width="5%">{{__('admin.email')}}</th>
                                <th width="5%">{{__('admin.plate_no')}}</th>
                                <th width="1%">{{__('admin.active')}}</th>
                                <th width="5%">{{__('admin.action')}}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $row)
                            <tr>
                                <td class="center">{!! \Amit\Msic\RenderMedia::image(@$row->presonal_image, 'uploads/', ['style'=>'width:60%']) !!}</td>
                                <td class="center">{{@$row->username}}</td>
                                <td class="center">{{@$row->email}}</td>
                                <td class="center">{{@$row->plate_no}}</td>

                                <td class="center">
                                    <a href="{{$scope}}/{{$module}}/active/{{$row->id}}/{{(@$row->active==1)?'0':'1'}}" class="btn btn-{{(@$row->active==1)?'danger':'success'}} btn-den btn-block">{{(@$row->active==1)?'Deactive':'Active'}}</a>
                                </td>

                                <td class="center">
                                    @if($auth::can('view',$module))
                                    <a class="btn btn-primary btn-xs" href="admin/{{$module}}/view/{{$row->id}}" title="{{__('admin.view')}}" title="{{__(" admin.view ")}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @endif

                                    @if($auth::can('review',$module))
                                    <a class="btn btn-primary btn-xs" href="admin/{{$module}}/reviews/{{$row->id}}" title="{{__('admin.reviews')}}" title="{{__(" admin.view ")}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @endif

                                    @if($auth::can('edit',$module))
                                    <a class="btn btn-primary btn-xs" href="admin/{{$module}}/edit/{{$row->id}}" title="{{__('admin.edit')}}" title="{{__(" admin.edit ")}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    @endif

                                    @if($auth::can('edit',$module))
                                    <a class="btn btn-primary btn-xs" href="admin/{{$module}}/change-password/{{$row->id}}" title="{{__('admin.edit')}}" title="{{__(" admin.edit ")}}">
                                        <i class="fa fa-save"></i>
                                    </a>
                                    @endif

                                    @if($auth::can('order',$module))
                                    <a class="btn btn-primary btn-xs" href="admin/{{$module}}/order/{{$row->id}}" title="{{__('admin.order')}}" title="{{__(" admin.order ")}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @endif

                                    @if($auth::can('delete',$module))
                                    <a class="btn btn-theme04 btn-xs has-confirmation-message" href="admin/{{$module}}/delete/{{$row->id}}" title="{{__('admin.Delete')}}" data-title="{{__('admin.Are you sure you want to delete this '.Amit\Support\Str::singular($module).'?')}}" data-confirm="{{__('admin.  ')}}" title="{{__(" admin.Delete ")}}">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                    @endif

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
     </div>
 </div>
</div>
@stop

