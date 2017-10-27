@extends('layouts.dashboard')

@section('content')

    <div class="text-center">
        <h3 class="custome-title">{{ __('admin.'.$module.' '.'List') }}</h3>


        <div class="col-lg-12">

            <a class="btn btn-primary" href="admin/{{$module}}/create"><span
                        class="ti-plus"></span> {{__('admin.Create')}}</a>

        </div>

        <br><br>

        <code>{{ __('admin.Search for driver by email or user name or plate number') }}</code>

        <br><br>

        <div class="row">
            <form class="form-inline" method="get">
                <div class="form-group">
                    <input value="{{request()->email}}" name="email" type="text" class="form-control"
                           id="exampleInputEmail1" placeholder="{{ __('admin.Email') }}">
                </div>

                <code>or</code>

                <div class="form-group">
                    <input value="{{request()->username}}" name="username" type="text" class="form-control"
                           id="exampleInputEmail1"
                           placeholder="{{ __('admin.User Name') }}">

                </div>

                <code>or</code>

                <div class="form-group">
                    <input value="{{request()->plate_no}}" name="plate_no" type="text" class="form-control"
                           id="exampleInputEmail1"
                           placeholder="{{ __('admin.Plate Number') }}">
                </div>

                <button type="submit" class="btn btn-default">{{ __('admin.Search') }}</button>
            </form>
        </div>
        <hr/>
        <div class="table-responsive">
            <style>
                thead th a {
                    color: #999999
                }

            </style>

            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display resize">
                <thead>
                <tr>
                    <th width="1%" class="text-center">{{__('admin.presonal image')}}</th>
                    <th width="5%" class="text-center">
                        {{__('admin.plate no')}}
                    </th>
                    <th width="5%" class="text-center">
                        {{__('admin.Car Size')}}
                    </th>
                    <th width="5%" class="text-center">
                        <a href="{{\Amit\Utilites\Request\QueryString::orderByQueryBilder('username', 'asc')}}">
                            <i class="glyphicon glyphicon-arrow-up"></i>
                        </a>
                        {{__('admin.username')}}
                        <a href="{{\Amit\Utilites\Request\QueryString::orderByQueryBilder('username', 'desc')}}">
                            <i class="glyphicon glyphicon-arrow-down"></i>
                        </a>
                    </th>
                    <th width="5%" class="text-center">
                        <a href="{{\Amit\Utilites\Request\QueryString::orderByQueryBilder('email', 'asc')}}">
                            <i class="glyphicon glyphicon-arrow-up"></i>
                        </a>
                        {{__('admin.email')}}

                        <a href="{{\Amit\Utilites\Request\QueryString::orderByQueryBilder('email', 'desc')}}">
                            <i class="glyphicon glyphicon-arrow-down"></i>
                        </a>
                    </th>
                    <th width="5%" class="text-center">
                        <a href="{{\Amit\Utilites\Request\QueryString::orderByQueryBilder('rate', 'asc')}}">
                            <i class="glyphicon glyphicon-arrow-up"></i>
                        </a>
                        {{__('admin.Rate')}}

                        <a href="{{\Amit\Utilites\Request\QueryString::orderByQueryBilder('rate', 'desc')}}">
                            <i class="glyphicon glyphicon-arrow-down"></i>
                        </a>
                    </th>
                    <th width="5%" class="text-center">
                        <a href="{{\Amit\Utilites\Request\QueryString::orderByQueryBilder('created_at', 'asc')}}">
                            <i class="glyphicon glyphicon-arrow-up"></i>
                        </a>
                        {{__('admin.created at')}}
                        <a href="{{\Amit\Utilites\Request\QueryString::orderByQueryBilder('created_at', 'desc')}}">
                            <i class="glyphicon glyphicon-arrow-down"></i>
                        </a>
                    </th>
                    <th width="1%" class="text-center">
                        <a>{{__('admin.active')}}</a>
                    </th>
                    <th width="10%" class="text-center">
                        <a>{{__('admin.action')}}</a>
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($rows as $row)
                    <tr>
                        <td class="center">{!! \Amit\Msic\RenderMedia::image(@$row->presonal_image, 'uploads/', ['style'=>'width:60%']) !!}</td>
                        <td class="center">{{@$row->plate_no}}</td>
                        <td class="center">{{@$row->car_size}}</td>
                        <td class="center">{{@$row->username}}</td>
                        <td class="center">{{@$row->email}}</td>
                        <td class="center">{{@$row->rate}}</td>
                        <td class="center">{{@$row->created_at}}</td>

                        <td class="center">
                            <a href="{{$scope}}/{{$module}}/active/{{$row->id}}/{{(@$row->active==1)?'0':'1'}}"
                               class="btn btn-{{(@$row->active==1)?'danger':'success'}} btn-den btn-block">{{(@$row->active==1)? __('admin.Deactive') : __('admin.Active') }}</a>
                        </td>

                        <td class="center">
                            @if($auth::can('view',$module))

                                <a class="btn btn-primary btn-xs" href="admin/{{$module}}/view/{{$row->id}}"
                                   title="{{__('admin.view')}}" title="{{__("admin.view")}}">
                                    <i class="fa fa-eye"> {{__("admin.View")}}</i>
                                </a>
                            @endif

                            @if($auth::can('review',$module))
                                <a class="btn btn-primary btn-xs" href="admin/{{$module}}/reviews/{{$row->id}}"
                                   title="{{__('admin.reviews')}}" title="{{__("admin.view")}}">
                                    <i class="fa fa-eye">{{__("admin.Reviews")}} </i>
                                </a>
                            @endif


                            @if($auth::can('edit',$module))
                                <a class="btn btn-primary btn-xs" href="admin/{{$module}}/edit/{{$row->id}}"
                                   title="{{__('admin.edit')}}" title="{{__("admin.edit")}}">
                                    <i class="fa fa-edit"> {{__('admin.Edit')}}</i>
                                </a>
                            @endif

                            @if($auth::can('edit',$module))
                                <a class="btn btn-primary btn-xs" href="admin/{{$module}}/change-password/{{$row->id}}"
                                   title="{{__('admin.edit')}}" title="{{__("admin.edit")}}">
                                    <i class="fa fa-save">{{__('admin.Change Password')}}</i>
                                </a>
                            @endif

                            @if($auth::can('order',$module))
                                <a class="btn btn-primary btn-xs" href="admin/{{$module}}/order/{{$row->id}}"
                                   title="{{__('admin.order')}}" title="{{__("admin.order")}}">
                                    <i class="fa fa-eye"> {{__('admin.Order')}}</i>
                                </a>
                            @endif

                            @if($auth::can('transaction',$module))
                                <a class="btn btn-primary btn-xs" href="admin/{{$module}}/transactions/{{$row->id}}"
                                   title="{{__('admin.transactions')}}" title="{{__("admin.view")}}">
                                    <i class="fa fa-eye">{{__('admin.Transactions')}}</i>
                                </a>
                            @endif

                            @if($auth::can('make_transaction',$module))
                                <a class="btn btn-primary btn-xs" href="admin/{{$module}}/make-transaction/{{$row->id}}"
                                   title="{{__('admin.transactions')}}" title="{{__("admin.view")}}">
                                    <i class="fa fa-eye">{{__('admin.Make Transaction')}}</i>
                                </a>
                            @endif

                            @if($auth::can('invoices',$module))
                                <a class="btn btn-primary btn-xs" href="admin/{{$module}}/invoices/{{$row->id}}"
                                   title="{{__('admin.transactions')}}" title="{{__("admin.view")}}">
                                    <i class="fa fa-eye">{{__('admin.Invoices')}}</i>
                                </a>
                            @endif

                            @if($auth::can('delete',$module))
                                <a class="btn btn-theme04 btn-xs has-confirmation-message"
                                   href="admin/{{$module}}/delete/{{$row->id}}"
                                   data-title="{{__('admin.Are you sure you want to delete this '.Amit\Support\Str::singular($module).'?')}}"
                                   data-confirm="{{__('admin.  ')}}" title="{{__("admin.Delete")}}">
                                    <i class="fa fa-trash-o"> {{__('admin.Delete')}}</i>
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
@stop

