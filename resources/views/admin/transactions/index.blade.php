@extends('layouts.dashboard')

@section('content')
<div class="text-center">
    <h3 class="custome-title">{{ __('admin.'.$module.' '.'List') }}</h3>


    <br><br>

    <code>{{ __('admin.Search for transaction by from date to date or driver name or client name') }}</code>

    <br><br>

    <div class="row">
        <form class="form-inline" method="get">
            <div class="form-group">
                <input name="from_date" type="date" class="form-control" id="exampleInputEmail1" placeholder="{{ __('admin.From Date') }}">
            </div>

            <code>to</code>

            <div class="form-group">
                <input name="to_date" type="date" class="form-control" id="exampleInputEmail1" placeholder="{{ __('admin.To Date') }}">
            </div>

            <code>or</code>

            <div class="form-group">
                <input name="driver_name" type="text" class="form-control" id="exampleInputEmail1" placeholder="{{ __('admin.Driver Name') }}">
            </div>

            <code>or</code>

            <div class="form-group">
                <input name="client_name" type="text" class="form-control" id="exampleInputEmail1" placeholder="{{ __('admin.Client Name') }}">
            </div>

            <button type="submit" class="btn btn-default">{{ __('admin.Search') }}</button>
        </form>

    </div>

    <br><br>

    <div class="table-responsive">

        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display resize">
            <thead>
                <tr>
                    <th width="1%">{{__('admin.Client Name')}}</th>
                    <th width="5%">{{__('admin.Driver Name')}}</th>
                    <th width="5%">{{__('admin.Order ID')}}</th>
                    <th width="5%">{{__('admin.Description')}}</th>
                    <th width="5%">{{__('admin.Amount')}}</th>
                    <th width="5%">{{__('admin.Date')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                <tr>
                    <td class="center">{{@$row->client->username}}</td>
                    <td class="center">{{@$row->driver->username}}</td>
                    <td class="center">{{@$row->order->id}}</td>
                    <td class="center">{{@$row->description}}</td>
                    <td class="center">{{@$row->amount}}</td>
                    <td class="center">{{@$row->date}}</td>
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

