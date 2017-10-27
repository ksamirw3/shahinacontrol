@extends('layouts.dashboard')

@section('content')

<section class="wrapper">

    <div class="col-lg-12 mt">

        <div class="row content-panel">
            <div class="col-lg-10 col-lg-offset-1">
                <div class="invoice-body">
                    <div class="pull-left"> 
                        <h1>{{ $driver->username }}</h1>
                    </div><!-- /pull-left -->
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-9">
                            <address>
                                {{ __('admin.Email') }}: {{ $driver->email }}<br>
                                {{ __('admin.Plate Number') }}: {{ $driver->plate_no }}<br>
                                {{ __('admin.Phone') }}: {{ $driver->phone }}
                            </address>
                        </div><! --/col-md-9 -->
                    </div><! --/col-lg-10 -->

                    <br><br>
                    <div class="row text-center">
                        <form class="form-inline" method="get">
                            <code>filter result by date</code>
                            <br/>
                            <div class="form-group">
                                <input value="{{request()->from_date}}" name="from_date" type="date" class="form-control" id="exampleInputEmail1" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input value="{{request()->to_date}}" name="to_date" type="date" class="form-control" id="exampleInputEmail1" placeholder="Email">
                            </div>


                            <button type="submit" class="btn btn-default">{{ __('admin.Search') }}</button>
                        </form>
                    </div>
                    <br><br>
                    <?php // dd($transactions)?>
                    @if(!empty($transactions->toArray()))
                    <table class="table">
                        <thead>
                            <tr>

                                <th style="width:1%" class="text-right">{{ __('admin.Trip type') }}</th>
                                <th style="width:2%" class="text-left">{{ __('admin.Order') }}</th>

                                <th style="width:3%" class="text-center">{{ __('admin.Client Name') }}</th>
                                <th style="width:10%" class="text-right">{{ __('admin.Description') }}</th>
                                <th style="width:5%" class="text-right">{{ __('admin.Date') }}</th>
                                <th style="width:2%" class="text-right">{{ __('admin.Amount') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $row)
                    
                            <tr>
                                <td class="text-right"><span class="label label-{{ (@$row->order->trip_type=='bring')?'success':'danger' }}">{{ @$row->order->trip_type}}</span></td>
                              <?php // dd( $row->order);?>
                                @if(@$row->order->id)
                                <td><a class="label label-info"  href="admin/orders/view/{{ @$row->order->id }}">order details</a></td>

                                <td class="text-center"><a href="admin/users/view/{{@$row->client->id }}">{{ @$row->client->username }}</a></td>
                                <td class="text-right">{{ @$row->description }}</td>
                                <td class="text-right">{{ @$row->date }}</td>
                                <td class="text-right">{{ @$row->amount }}</td>
                                @endif
                            </tr>
                            @endforeach

                            <tr><td></td><td></td><td></td><td></td><td></td></tr>
                            <tr>
                                <td colspan="2" rowspan="4" >
                                    <h4>{{ __('admin.Terms and Conditions') }}</h4>
                                    <p>{{ __('admin.Thank you for your business. We do expect payment within 21 days, so please process this invoice within that time. There will be a 1.5% interest charge per month on late invoices.') }}</p>
                                <td class="text-right no-border"><strong>Income</strong></td>


                                </td>
                                <td class="text-right">{{ @$totalAmount }}</td>

                            </tr>

                            <tr>
                                <td class="text-right no-border"><strong>{{ __('admin.Profit') }}</strong></td>
                                <td class="text-right"><strong>{{ @$percentage }}</strong></td>
                            </tr>   
                            <tr>
                                <td class="text-right"><strong>{{ __('admin.Paid Amount') }}</strong></td>
                                <td class="text-right">{{ @$paidAmount }}</td>
                            </tr>

                            <tr>

                                <td class="text-right no-border"><div class="well well-small green"><strong>{{ __('admin.Rest Amount') }}</strong></div></td>
                                <td class="text-right">{{ @$restAmount }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @else
                    <h1 class="text-center">{{__('admin.Sorry there is no transactions yet ')}} ...</h1>
                    @endif
                    <br>
                    <br>
                </div><!--/col-lg-12 mt -->


                </section><!-- /MAIN CONTENT -->

                @stop

