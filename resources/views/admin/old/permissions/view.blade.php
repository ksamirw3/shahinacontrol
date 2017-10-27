@extends($scope.'.layouts.master')

@section('title')
<div class="container-fluid mt">
    <div class="row">
        <div class="col-md-12">
            <div class="content-panel">
                <h3><i class="fa fa-user-secret"></i> {{ __('admin.View') }}</h3>
                <a href="{{$scope}}/{{$module}}/index" class="btn btn-danger"><i class="fa fa-backward"></i> {{__('admin.Go back')}}</a><br><br>
                @stop

                @section('content')
                <a href="{{$scope}}/{{$module}}/edit/{{$row->id}}" class="btn btn-primary">
                    <i class="fa fa-edit"></i> {{__('admin.Edit')}}
                </a><br><br>
                <div class="table-responsive">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display resize data_table">
                        <?php // dd(@$row); ?>
                        {{--*/$input = 'title_en'/*--}}
                        <tr>
                            <td width="25%" class="align-left">{{__('admin.'.$input)}}</td>
                            <td width="75%" class="">{!!@$row->$input!!}</td>
                        </tr>
                        {{--*/$input = 'title_ar'/*--}}
                        <tr>
                            <td width="25%" class="align-left">{{__('admin.'.$input)}}</td>
                            <td width="75%" class="">{!!@$row->$input!!}</td>
                        </tr>
                        {{--*/$input = 'description_en'/*--}}
                        <tr>
                            <td width="25%" class="align-left">{{__('admin.'.$input)}}</td>
                            <td width="75%" class="">{!!@$row->$input!!}</td>
                        </tr>
                        {{--*/$input = 'description_ar'/*--}}
                        <tr>
                            <td width="25%" class="align-left">{{__('admin.'.$input)}}</td>
                            <td width="75%" class="">{!!@$row->$input!!}</td>
                        </tr>
                        {{--*/$input = 'date'/*--}}
                        <tr>
                            <td width="25%" class="align-left">{{__('admin.'.$input)}}</td>
                            <td width="75%" class="">{!!@$row->$input!!}</td>
                        </tr>
                        {{--*/$input = 'cover'/*--}}
                        <tr>
                            <td width="25%" class="align-left">{{__('admin.'.$input)}}</td>
                            <td width="75%" class="">{!!Amit\Msic\RenderMedia::image(@$row->$input)!!}</td>
                        </tr>
                        {{--*/$input = 'images'/*--}}
                        <tr>
                            <td width="25%" class="align-left">{{__('admin.'.$input)}}</td>
                            <td width="75%" class="">{!!Amit\Msic\RenderMedia::image(@$row->$input)!!}</td>
                        </tr>

                        <tr>
                            <td width="25%" class="align-left">{{__('admin.Created at')}}</td>
                            <td  width="75%" class="">{{@$row->created_at}}</td>
                        </tr>
                    </table>
                </div>
            </div></div></div></div>
@stop

