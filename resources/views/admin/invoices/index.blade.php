@extends('layouts.dashboard')

@section('content')

          <section class="wrapper">
             <div class="col-lg-12 mt">
             
                <div class="row content-panel">
                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="invoice-body">
                            <div class="pull-left"> 
                                <h1>{{ __('admin.DASHIO') }}</h1>
                                <address>
                                <strong>{{ __('admin.Admin Theme, Inc.') }}</strong><br>
                                {{ __('admin.795 Asome Ave, Suite 850') }}<br>
                                {{ __('admin.New York, 94447') }}<br>
                                <abbr title="Phone">P:</abbr> {{ __('admin.(123) 456-7890') }}
                                </address>
                            </div><!-- /pull-left -->
                            
                            <div class="pull-right">
                                <h2>{{ __('admin.invoice') }}</h2>
                            </div><! --/pull-right -->
                            
                            <div class="clearfix"></div>
                            <br>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-md-9">
                                    <h4>{{ __('admin.Paul Smith') }}</h4>
                                    <address>
                                    <strong>{{ __('admin.Enterprise Corp.') }}</strong><br>
                                    {{ __('admin.234 Great Ave, Suite 600') }}<br>
                                    {{ __('admin.San Francisco, CA 94107') }}<br>
                                    <abbr title="Phone">P:</abbr> {{ __('admin.(123) 456-7890') }}
                                    </address>
                                </div><! --/col-md-9 -->
                                <div class="col-md-3"><br>
                                    <div>
                                        <div class="pull-left"> {{ __('admin.INVOICE NO') }} : </div>
                                        <div class="pull-right">{{ __('admin.000283') }}  </div>
                                        <div class="clearfix"></div>
                                    </div>
                                <div><!-- /col-md-3 -->
                                <div class="pull-left"> {{ __('admin.INVOICE DATE') }} : </div>
                                <div class="pull-right"> {{ __('admin.15/03/14') }} </div>
                                <div class="clearfix"></div>
                            </div><! --/row -->
                            <br>
                            <div class="well well-small green">
                                <div class="pull-left"> {{ __('admin.Total Due') }} : </div>
                                <div class="pull-right"> {{ __('admin.8,000 USD') }} </div>
                                <div class="clearfix"></div>
                            </div>
                        </div><!-- /invoice-body -->
                    </div><! --/col-lg-10 -->
                    <table class="table">
                        <thead>
                        <tr>
                        <th style="width:60px" class="text-center">{{ __('admin.QTY') }}</th>
                        <th class="text-left">{{ __('admin.DESCRIPTION') }}</th>
                        <th style="width:140px" class="text-right">{{ __('admin.UNIT PRICE') }}</th>
                        <th style="width:90px" class="text-right">{{ __('admin.TOTAL') }}</th>
                        </tr>
                        </thead>
                            <tbody>
                                <tr>
                                <td class="text-center">1</td>
                                <td>{{ __('admin.Flat Pack Heritage') }}</td>
                                <td class="text-right">{{ __('admin.$429.00') }}</td>
                                <td class="text-right">{{ __('admin.$429.00') }}</td>
                                </tr>
                                <tr>
                                <td class="text-center">2</td>
                                <td>{{ __('admin.') }}Carry On Suitcase</td>
                                <td class="text-right">{{ __('admin.$300.00') }}</td>
                                <td class="text-right">{{ __('admin.$600.00') }}</td>
                                </tr>
                                <tr>
                                <td colspan="2" rowspan="4" ><h4>{{ __('admin.Terms and Conditions') }}</h4>
                                    <p>{{ __('admin.Thank you for your business. We do expect payment within 21 days, so please process this invoice within that time. There will be a 1.5% interest charge per month on late invoices.') }}</p>
                                <td class="text-right"><strong>{{ __('admin.Subtotal') }}</strong></td>
                                <td class="text-right">{{ __('admin.$1029.00') }}</td>
                                </tr>
                                <tr>
                                <td class="text-right no-border"><strong>{{ __('admin.Shipping') }}</strong></td>
                                <td class="text-right">{{ __('admin.$0.00') }}</td>
                                </tr>
                                <tr>
                                <td class="text-right no-border"><strong>{{ __('admin.VAT Included in Total') }}</strong></td>
                                <td class="text-right">{{ __('admin.$0.00') }}</td>
                                </tr>
                                <tr>
                                <td class="text-right no-border"><div class="well well-small green"><strong>{{ __('admin.Total') }}</strong></div></td>
                                <td class="text-right"><strong>{{ __('admin.$1029.00') }}</strong></td>
                                </tr>
                            </tbody>
                    </table>
                    <br>
                    <br>
        </div><!--/col-lg-12 mt -->
                
            
  </section><!-- /MAIN CONTENT -->

@stop

