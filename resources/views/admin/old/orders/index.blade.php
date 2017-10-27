@extends($scope.'.layouts.master')

@section('title')
<div class="container-fluid mt">
    <div class="row">
        <div class="col-md-12">
            <div class="content-panel">
                <h3 class="custome-title">{{ __('admin.'.$module.' '.'List') }}</h3>
                @stop
                @section('content')

                <br>

                <a href="{{url('/admin/orders')}}?status=1" class="btn btn-primary">Opened</a>
                <a href="{{url('/admin/orders')}}?status=2" class="btn btn-info">Closed</a>
                <a href="{{url('/admin/orders')}}?status=0" class="btn btn-danger">Rejected</a>

                <br><br>

                <code>Search for order by client name or driver name or date</code>

                <br><br>

                <div class="row">
                    <form class="form-inline" method="get">
                        <div class="form-group">
                            <input name="username" type="text" class="form-control" id="exampleInputEmail1" placeholder="Driver Name">
                        </div>

                        <!-- <code>or</code>

                        <div class="form-group">
                            <input name="driver_name" type="text" class="form-control" id="exampleInputEmail1" placeholder="Driver Name">
                        </div> -->

                        <code>or</code>

                        <div class="form-group">
                            <input name="date" type="text" class="form-control" id="exampleInputEmail1" placeholder="Date">
                        </div>

                        <button type="submit" class="btn btn-default">Search</button>
                    </form>
                </div>

                <div class="table-responsive">

                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display resize">
                        <thead>
                            <tr>
                                <th width="1%">{{__('admin.Client Name')}}</th>
                                <th width="5%">{{__('admin.Driver Name')}}</th>
                                <th width="5%">{{__('admin.Description')}}</th>
                                <th width="5%">{{__('admin.Amount')}}</th>
                                <th width="5%">{{__('admin.Receiver Phone')}}</th>
                                <th width="5%">{{__('admin.Receiver Name')}}</th>
                                <th width="5%">{{__('admin.From Address')}}</th>
                                <th width="5%">{{__('admin.To Address')}}</th>
                                <th width="5%">{{__('admin.Action')}}</th>

                            </tr>
                        </thead>
                        <tbody>
                        <?php //dd($rows)?>
                            @foreach ($rows as $row)
                            <tr>
                                <td class="center">{{@$row->client->username}}</td>
                                <td class="center">{{@$row->driver->username}}</td>
                                <td class="center">{{@$row->description}}</td>
                                <td class="center">{{@$row->amount}}</td>
                                <td class="center">{{@$row->receiver_phone}}</td>
                                <td class="center">{{@$row->receiver_name}}</td>
                                <td class="center">{{@$row->from_address}}</td>
                                <td class="center">{{@$row->to_address}}</td>

                                <td class="center">
                                    <a class="btn btn-primary btn-xs" href="admin/{{$module}}/view/{{$row->id}}" title="{{__('admin.view')}}" title="{{__(" admin.view ")}}">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a class="btn btn-theme04 btn-xs has-confirmation-message" href="admin/{{$module}}/delete/{{$row->id}}" title="{{__('admin.Delete')}}" data-title="{{__('admin.Are you sure you want to delete this '.Amit\Support\Str::singular($module).'?')}}" data-confirm="{{__('admin.  ')}}" title="{{__(" admin.Delete ")}}">
                                        <i class="fa fa-trash-o"></i>
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
       </div>
   </div>
</div>
@stop

