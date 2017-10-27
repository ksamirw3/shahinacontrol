@extends('layouts.dashboard')

@section('content')
<div class="text-center">
    <h3><i class="fa fa-user-secret"></i> {{ __('admin.View') }}</h3>
    <a href="{{$scope}}/{{$module}}/index" class="btn btn-danger"><i
        class="fa fa-backward"></i> {{__('admin.Go back')}}</a><br><br>
        <br><br>
        <div class="table-responsive">
            <table cellpadding="0" cellspacing="0" border="0"
            class="table table-striped table-bordered display resize data_table">
            <?php // dd(@$row); ?>
            {{-- */$input='username';/* --}}
            <tr>
                <td width="25%" class="align-left">{{__('admin.'.$input)}}</td>
                <td width="75%" class="">{!!@$row->$input!!}</td>
            </tr>

            {{-- */$input='f_name';/* --}}
            <tr>
                <td width="25%" class="align-left">{{__('admin.'.$input)}}</td>
                <td width="75%" class="">{!!@$row->{$input}!!}</td>
            </tr>

            {{-- */$input='email';/* --}}
            <tr>
                <td width="25%" class="align-left">{{__('admin.'.$input)}}</td>
                <td width="75%" class="">{!!@$row->{$input}!!}</td>
            </tr>

            {{-- */$input='presonal_image';/* --}}
            <tr>

                <td width="25%" class="align-left">{{__('admin.'.$input)}}</td>
                <td width="75%" class="">{!! \Amit\Msic\RenderMedia::image(@$row->{$input}, 'uploads/')!!}</td>
            </tr>
            {{-- */$input='phone';/* --}}
            <tr>
                <td width="25%" class="align-left">{{__('admin.'.$input)}}</td>
                <td width="75%" class="">{!!@$row->{$input}!!}</td>
            </tr>

            {{-- */$input='active';/* --}}
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

