@extends('layouts.dashboard')

@section('content')

<div class="text-center">
    <h3 class="custome-title">{{ __('admin.'.$module.' '.'List') }}</h3>


    <br><br>

    <code>{{ __('admin.Search for user by email or user name or phone number') }}</code>

    <br><br>

    <div class="row">
        <form class="form-inline" method="get">
            <div class="form-group">
                <input name="email" type="text" class="form-control" id="exampleInputEmail1" placeholder="{{ __('admin.Email') }}">
            </div>

            <code>{{ __('admin.or') }}</code>

            <div class="form-group">
                <input name="username" type="text" class="form-control" id="exampleInputEmail1"
                placeholder="{{ __('admin.User Name') }}">
            </div>

            <code>{{ __('admin.or') }}</code>

            <div class="form-group">
                <input name="phone" type="text" class="form-control" id="exampleInputEmail1" placeholder="{{ __('admin.Phone') }}">
            </div>

            <button type="submit" class="btn btn-default">{{ __('admin.Search') }}</button>
        </form>
    </div>

    <br><br>

    <div class="table-responsive">

        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display resize">
            <thead>
                <tr>
                    <th width="1%">{{__('admin.presonal image')}}</th>
                    <th width="5%">{{__('admin.username')}}</th>
                    <th width="5%">{{__('admin.email')}}</th>
                    <th width="5%">{{__('admin.phone')}}</th>
                    <th width="5%">{{__('admin.created at')}}</th>
                    <th width="5%">{{__('admin.action')}}</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                <tr>
                    <td class="center">{!! \Amit\Msic\RenderMedia::image(@$row->presonal_image, 'uploads/', ['style'=>'width:60%']) !!}</td>
                    <td class="center">{{@$row->username}}</td>
                    <td class="center">{{@$row->email}}</td>
                    <td class="center">{{@$row->phone}}</td>
                    <td class="center">{{@$row->created_at}}</td>

                    <td class="center">
                        <a class="btn btn-primary btn-xs" href="admin/{{$module}}/view/{{$row->id}}"
                           title="{{__('admin.view')}}" title="{{__(" admin.view ")}}">
                           <i class="fa fa-eye"> {{ __('admin.View') }}</i>
                       </a>

                       <a class="btn btn-primary btn-xs" href="admin/{{$module}}/reviews/{{$row->id}}"
                           title="{{__('admin.reviews')}}" title="{{__(" admin.view ")}}">
                           <i class="fa fa-eye"> {{ __('admin.Reviews') }}</i>
                       </a>

                       <a class="btn btn-primary btn-xs" href="admin/{{$module}}/transactions/{{$row->id}}"
                           title="{{__('admin.transactions')}}" title="{{__(" admin.view ")}}">
                           <i class="fa fa-eye"> {{ __('admin.Transactions') }}</i>
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


@stop

