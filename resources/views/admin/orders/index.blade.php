@extends('layouts.dashboard')

@section('content')
<div style="padding: 7px" class="text-center">
    <div>
        <h3 class="custome-title">{{ __('admin.'.$module.' '.'List') }}</h3>

        <br>

        <a href="{{url('/admin/orders')}}?status=1" class="btn btn-primary">{{ __('admin.Opened') }}</a>
        <a href="{{url('/admin/orders')}}?status=2" class="btn btn-info">{{ __('admin.Closed') }}</a>
        <a href="{{url('/admin/orders')}}?status=0" class="btn btn-danger">{{ __('admin.Rejected') }}</a>

        <br><br>

        <code>{{ __('admin.Search for order by client name or driver name or date') }}</code>

        <br><br>


        <form class="form-inline" method="get">
            <div class="form-group">
                <input name="username" type="text" class="form-control" id="exampleInputEmail1"
                       placeholder="{{ __('admin.Driver Name') }}">
            </div>


            <code>or</code>

            <div class="form-group">
                <input name="date" type="date" class="form-control" id="exampleInputEmail1" placeholder="{{ __('admin.Date') }}">
            </div>
            <div class="form-group">
            {!! Form::select("sort",['asc'=>'newest',"desc"=>"oldest"],Request::get('sort'),['class'=>'form-control','placeholder'=>'sorting'])!!}
            </div>

            <button type="submit" class="btn btn-default">{{ __('admin.Search') }}</button>
        </form>

        <hr/>

    </div>
    <table class="table table-striped table-advance table-hover">
        <thead>
            <tr>
                <th>{{__('admin.Client Name')}}</th>
                <th>{{__('admin.Driver Name')}}</th>
                <th>{{ __('admin.Description')}}</th>
                <th>{{ __('admin.Amount')}}</th>
                <th>{{__('admin.Receiver Info')}}</th>
                <th>{{__('admin.From Address')}}</th>
                <th>{{__('admin.To Address')}}</th>
                <th>{{__('admin.Order Date')}}</th>
                <th>{{__('admin.Action')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $row)
            <tr class="text-left">
                <td class="center">{{@$row->client->username}}</td>
                <td class="center">{{@$row->driver->username}}</td>
                <td class="center">{{Amit\Support\Str::words(@$row->description,6)}}</td>
                <td class="center">{{@$row->amount}}</td>
                <td class="text-left">
                    name  : {{@$row->receiver_name}} <br/>
                    phone : {{@$row->receiver_phone}}
                </td>
                <td class="center">{{Amit\Support\Str::words(@$row->from_address,6)}}</td>
                <td class="center">{{Amit\Support\Str::words(@$row->to_address,6)}}</td>
                <td class="center">{{@$row->created_at}}</td>
                <td class="center">
                    <a class="btn btn-primary btn-xs" href="admin/{{$module}}/view/{{$row->id}}"
                       title="{{__('admin.view')}}">
                        <i class="fa fa-eye"></i>
                    </a>
                    <a class="btn btn-theme04 btn-xs has-confirmation-message"
                       href="admin/{{$module}}/delete/{{ $row->id}}" title="{{__('admin.Delete')}}"
                       data-title="{{__('admin.Are you sure you want to delete this')}}{{Amit\Support\Str::singular($module)}}{{'?'}}"
                       title="{{ __(" admin.Delete")}}">
                        <i class="fa fa-trash-o"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="text-center">
    {!!  $rows->links() !!}
</div>
@stop
