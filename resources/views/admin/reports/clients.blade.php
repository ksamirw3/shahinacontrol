@extends('layouts.dashboard')

@section('content')

<div class="text-center" style="min-height: 850px">
    <h3 class="custome-title">{{ __('admin.'.$module.' '.'List') }}</h3>

    <br>
    
    <code>{{ __('admin.Filter by all rows and search by from date to date') }}</code>

    <br><br>

    <div class="row reports" style="padding: 7px">
        <div class="col-s-12 col-md-3 col-lg-3"></div>

        <div class="col-s-12 col-md-2 col-lg-2">
            <form>
                <dl class="dropdown">
                    <dt>
                        <a>
                            <span class="hida">{{ __('admin.Select') }}</span>
                            <p class="multiSel"></p>
                        </a>
                    </dt>

                    <dd>
                        <div class="mutliSelect">
                            <ul>
                                @foreach($columns as $col)
                                <li>
                                    <input name="cols[]" type="checkbox" value="{{ $col }}"/>{{ $col }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </dd>
                    <button type="submit" class="btn btn-default">{{ __('admin.Filter') }}</button>
                </dl>
            </form>
        </div>

        <div class="col-s-12 col-md-4 col-lg-4">
            <form class="form-inline" method="get">
                <div class="form-group col-sm-12 col-md-12 col-lg-6">
                    <input name="from_date" type="date" class="form-control" id=""
                    placeholder="From Date">
                </div>

                <!-- <code>to</code> -->

                <div class="form-group col-sm-12 col-md-12 col-lg-6">
                    <input name="to_date" type="date" class="form-control" id=""
                    placeholder="To Date">
                </div>

                <div class="col-sm-12">
                    <button type="submit" class="btn btn-default btn-search">{{ __('admin.Search') }}</button>
                </div>
            </form>
        </div>
    </div>

    <hr/>

    <div class="table-responsive table_horz col-lg-12">
        <?php $fileds = (request()->cols)?request()->cols:$columns; ?>

        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered display resize">
            <thead>
                <tr>
                    @foreach($fileds as $col)
                    <th width="5%">{{ __('admin.'.$col) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($drivers as $driver)
                <tr>
                    @foreach($fileds as $col)
                    <td class="center"><?= $driver->{$col}?></td>
                    @endforeach
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    <div class="links">
        {!! $drivers->links() !!}
    </div>

</div>
@stop

@section('js')
<script>
    $(".dropdown dt a").on('click', function () {
        $(".dropdown dd ul").slideToggle('fast');
    });

    $(".dropdown dd ul li a").on('click', function () {
        $(".dropdown dd ul").hide();
    });

    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function (e) {
        var $clicked = $(e.target);
        if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
    });

    $('.mutliSelect input[type="checkbox"]').on('click', function () {

        var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
        title = $(this).val() + ",";

        if ($(this).is(':checked')) {
            var html = '<span title="' + title + '">' + title + '</span>';
            $('.multiSel').append(html);
            $(".hida").hide();
        } else {
            $('span[title="' + title + '"]').remove();
            var ret = $(".hida");
            $('.dropdown dt a').append(ret);

        }
    });
</script>
@stop

@section('css')
<style>

    .table_horz
    {
        overflow: scroll;
        // max-width: 1024px;
        max-height: 550px;

    }

    .reports .dropdown {
        /*position: absolute;*/
        /*top: 50%;*/
    }

    a {
        color: #fff;
    }

    .reports .dropdown dd,
    .reports .dropdown dt {
        margin: 0px;
        padding: 0px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .reports .dropdown ul {
        margin: -1px 0 0 0;
    }

    .reports .dropdown dd {
        position: relative;
    }

    .reports .dropdown a,
    .reports .dropdown a:visited {
        color: #fff;
        text-decoration: none;
        outline: none;
        font-size: 12px;
    }

    .reports .dropdown dt a {
        /*background-color: #555;*/
        color: #555;
        font-size: 14px;
        display: block;
        padding: 0px 0px 0px 20px;
        min-height: 25px;
        /*line-height: 24px;*/
        overflow: hidden;
        border: 0;
        /*width: 272px;*/
    }

    .reports .dropdown dt a span,
    .reports .multiSel span {
        cursor: pointer;
        display: inline-block;
        padding: 2px 20px 2px 0;
    }

    .reports .dropdown dd ul {
        background-color: #2f323a;
        border: 0;
        color: #aeb2b7;
        display: none;
        left: 0px;
        padding: 2px 15px 2px 5px;
        position: absolute;
        top: 2px;
        width: 188px;
        list-style: none;
        height: 100px;
        overflow: auto;
    }

    .reports .dropdown span.value {
        display: none;
    }

    .reports .dropdown ul li
    {
        text-align: left;
        padding-bottom: 8px;
        padding-top: 8px
        -webkit-transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }

    .reports .dropdown ul li:hover
    {
        background-color: #4ECDC4;
        color: #fff;
    }

    .reports .dropdown input[type="checkbox"]
    {
        margin-right: 5px;
    }

    .reports .dropdown dd ul li a {
        padding: 5px;
        display: block;
    }

    .reports .dropdown dd ul li a:hover {
        background-color: #fff;
    }

    .reports button {
        background-color: #6BBE92;
        width: 100%;
        border: 0;
        padding: 10px 0;
        margin: 5px 0;
        text-align: center;
        color: #fff;
        font-weight: bold;
    }

    .reports .btn-search
    {
        width: 93%;
    }

    .reports .form-inline .form-control
    {
        height: 37px;
    }

    .reports button
    {
        border: 1px solid #ddd;
        color: #000;
        background-color: transparent;
        padding: 7px;
    }

    .links
    {
        float: left;
        margin-bottom: 10px;
    }

</style>
@stop

