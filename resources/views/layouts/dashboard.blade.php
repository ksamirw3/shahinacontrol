@extends('layouts.base')

@section('scopeCss')
    @yield('css')
    <style>
        .cropped_preview {
            max-width: 200px;
        }
    </style>
    @stop


    @section('scopeContent')

    @include('components.dashboard_header')
    @include('components.asaid')
            <!-- **********************************************************************************************************************************************************
        MAIN CONTENT
        *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> {{@$pageTitel}}</h3>

            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <div class="col-lg-12">
                            @include('components.flash_messages')
                        </div>
                        @yield('content')
                    </div><!-- /content-panel -->
                </div><!-- /col-md-12 -->
            </div><!-- /row -->

        </section>
        <! --/wrapper -->
    </section><!-- /MAIN CONTENT -->
    @include('components.dashboard_footer')

@stop



@section('scopeJs')



    @yield('js')
@stop


