@extends('layouts.dashboard')


@section('content')
    <div class="text-center">
        <h3><i class="fa fa-user-secret"></i> {{ __('admin.Transactions To') }} {{@$rows[0]->driver->username}}</h3>
        <a href="admin/{{$module}}/index" class="btn btn-danger"><i class="fa fa-backward"></i> {{__('admin.Go back')}}
        </a><br><br>


        <div class="table-responsive">

            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display resize">
                <thead>
                <tr>
                    <th>{{__('admin.ID')}}</th>
                    <th>{{__('admin.Client Name')}}</th>
                    <th>{{__('admin.Order ID')}}</th>
                    <th>{{__('admin.Amount')}}</th>
                    <th>{{__('admin.Payment Method')}}</th>
                    <th>{{__('admin.Date')}}</th>
                    <th>{{__('admin.Description')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($rows as $row)
                    <tr>
                        <td class="center">{{@$row->id}}</td>
                        <td class="center">{{@$row->client->username}}</td>
                        <td class="center">{{@$row->order->id}}</td>
                        <td class="center">{{@$row->amount}}</td>
                        <td class="center">{{@$row->payment_method}}</td>
                        <td class="center">{{@$row->date}}</td>
                        <td class="center">{{@$row->description}}</td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
        <div>
            {{$rows->links()}}
        </div>

    </div>

@stop