@extends($scope.'.layouts.master')


@section('title')
<div class="container-fluid mt">
    <div class="row">
        <div class="col-md-12">
            <div class="content-panel">
                <h3><i class="fa fa-user-secret"></i> {{ __('admin.View') }}</h3>
                <a href="admin/admins/index" class="btn btn-danger"><i class="fa fa-backward"></i> {{__('admin.Go back')}}</a><br><br>
                @stop

                @section('content')
                @if(ACL::can('v-'.$module))
                <a href="admin/admins/edit/{{$row->id}}" class="btn btn-primary">
                    <i class="fa fa-edit"></i> {{__('admin.Edit')}}
                </a><br><br>
                @endif
                <div class="table-responsive">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display resize data_table">
                        <?php // dd(@$row); ?>
                        <tr>
                            <td class="capitalize" width="25%" >{{__('admin.username')}}</td>
                            <td width="75%" >{{@$row->username}}</td>
                        </tr>
                        <tr>
                            <td class="capitalize" width="25%" >{{__('admin.email')}}</td>
                            <td width="75%" >{{@$row->email}}</td>
                        </tr>
                        <tr>
                            <td class="capitalize" width="25%" >{{__('admin.phone')}}</td>
                            <td width="75%" >{{@$row->phone}}</td>
                        </tr>
                        <tr>
                            <td class="capitalize" width="25%" >{{__('admin.role')}}</td>
                            <td width="75%" >{{@$row->rule->name }}</td>
                        </tr>

                        <tr>
                            <td  class="capitalize" width="25%" >{{__('admin.Created at')}}</td>
                            <td  width="75%" >{{@$row->created_at}}</td>
                        </tr>
                    </table>
                </div>
            </div></div></div></div>
@stop

