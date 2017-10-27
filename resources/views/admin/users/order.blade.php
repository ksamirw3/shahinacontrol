@extends($scope.'.layouts.master')


@section('title')
<div class="container-fluid mt">
    <div class="row">
        <div class="col-md-12">
            <div class="content-panel">
                <h3><i class="fa fa-user-secret"></i> {{ __('admin.Orders To') }} {{@$rows[0]->driver->username}}</h3>
                <a href="admin/admins/index" class="btn btn-danger"><i class="fa fa-backward"></i> {{__('admin.Go back')}}</a><br><br>
                @stop

                @section('content')

                <div class="table-responsive">

                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display resize">
                        <thead>
                            <tr>
                                <th>{{__('admin.ID')}}</th>
                                <th>{{__('admin.Client Name')}}</th>
                                <th>{{__('admin.Amount')}}</th>
                                <th>{{__('admin.Description')}}</th>
                                <th>{{__('admin.Reciever Phone')}}</th>
                                <th>{{__('admin.Reciever Name')}}</th>
                                <th>{{__('admin.From Address')}}</th>
                                <th>{{__('admin.To Address')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $row)
                            <tr>
                                <td class="center">{{@$row->id}}</td>
                                <td class="center">{{@$row->client->username}}</td>
                                <td class="center">{{@$row->amount}}</td>
                                <td class="center">{{@$row->description}}</td>
                                <td class="center">{{@$row->receiver_phone}}</td>
                                <td class="center">{{@$row->receiver_name}}</td>
                                <td class="center">{{@$row->from_address}}</td>
                                <td class="center">{{@$row->to_address}}</td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
<div>
{{$rows->links()}}
</div>
            </div>
        </div>
    </div>
</div>
@stop