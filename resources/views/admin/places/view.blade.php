@extends('layouts.dashboard')

@section('content')
    <div class="text-center">
        <h3><i class="fa fa-user-secret"></i> {{ __('admin.View') }}</h3>
        <a href="{{$scope}}/{{$module}}/index" class="btn btn-danger"><i
                    class="fa fa-backward"></i> {{__('admin.Go back')}}</a><br><br>

        <a href="{{$scope}}/{{$module}}/edit/{{$row->id}}" class="btn btn-primary">
            <i class="fa fa-edit"></i> {{__('admin.Edit')}}
        </a><br><br>
        <div class="table-responsive">
            <table cellpadding="0" cellspacing="0" border="0"
                   class="table table-striped table-bordered display resize data_table">
                <?php // dd(@$row); ?>
                {{-- */$input='name_en';/* --}}
                <tr>
                    <td width="25%" class="align-left">{{__('admin.'.$input)}}</td>
                    <td width="75%" class="">{!!@$row->$input!!}</td>
                </tr>

                {{-- */$input='name_ar';/* --}}
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

