@extends('layouts.dashboard')

@section('content')
<?php // dd($row);?>
<div class="text-center">
    <h3><i class="fa fa-user-secret"></i> {{ __('admin.Trip Details') }}</h3>
    <a onclick="window.history.back()" class="btn btn-danger"><i
            class="fa fa-backward"></i> {{__('admin.Go back')}}
    </a><br><br>
    <br><br>
    <div class="table-responsive">
        <table cellpadding="0" cellspacing="0" border="0"
               class="table table-striped table-bordered display resize data_table">


            {{-- */$input='driver';/* --}}
            <tr>
                <td width="25%" class="align-left">{{__('admin.'.$input)}}</td>
                <td width="75%" class="">{!!@$row->driver->full_name!!}</td>
            </tr>
            {{-- */$input='client';/* --}}
            <tr>
                <td width="25%" class="align-left">{{__('admin.'.$input)}}</td>
                <td width="75%" class="">{!!@$row->client->email!!}</td>
            </tr>
            {{-- */$input='amount';/* --}}
            <tr>
                <td width="25%" class="align-left">{{__('admin.'.$input)}}</td>
                <td width="75%" class="">{!!@@$row->{$input}!!}</td>
            </tr>
            {{-- */$input='description';/* --}}
            <tr>
                <td width="25%" class="align-left">{{__('admin.'.$input)}}</td>
                <td width="75%" class="">{!!@@$row->{$input}!!}</td>
            </tr>
            {{-- */$input='receiver_phone';/* --}}
            <tr>
                <td width="25%" class="align-left">{{__('admin.'.$input)}}</td>
                <td width="75%" class="">{!!@$row->{$input}!!}</td>
            </tr>
            {{-- */$input='receiver_name';/* --}}
            <tr>
                <td width="25%" class="align-left">{{__('admin.'.$input)}}</td>
                <td width="75%" class="">{!!@$row->{$input}!!}</td>
            </tr>
            {{-- */$input='from_address';/* --}}
            <tr>
                <td width="25%" class="align-left">{{__('admin.'.$input)}}</td>
                <td width="75%" class="">{!!@$row->{$input}!!}</td>
            </tr>
            {{-- */$input='to_address';/* --}}
            <tr>
                <td width="25%" class="align-left">{{__('admin.'.$input)}}</td>
                <td width="75%" class="">{!!@$row->{$input}!!}</td>
            </tr>
            {{-- */$input='trip_type';/* --}}
            <tr>
                <td width="25%" class="align-left">{{__('admin.'.$input)}}</td>
                <td width="75%" class="">{!!@$row->{$input}!!}</td>
            </tr>

            <tr>
                <td width="25%" class="align-left">{{__('admin.Created at')}}</td>
                <td width="75%" class="">{{@$row->created_at}}</td>
            </tr>
        </table>
    </div>


</div>
@stop

