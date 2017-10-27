<?php

namespace App\Http\Controllers\Api\Client\Transactions;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transactions
 *
 * @author Mahmoud Ali
 */
use App\Models\Order;
use JooAziz\Response\Response;
use App\Http\Controllers\Api\Base;
use App\Models\Transaction as Model;
use App\Http\Controllers\Api\Client\Transactions\Validator as Checker;

class Transactions extends Base {

    public function anySetPaymentForTrip() {
        if (!request()->order_id)
            return Response::make()->setMessage('invalid order id')->send();
        $order = Order::find(request()->order_id);
//        dd($order);
        if (!$order)
            return Response::make()->setMessage('no order found')->send();
        $row = new Model;
        $row->amount = $order->amount;
        $row->driver_id = $order->driver_id;
        $row->client_id = $order->client_id;
        $row->order_id = request()->order_id;
        $row->payment_method = Order::$cashOnDliver;
        $row->date = date("Y-m-d H:i:s");
        $row->description = " payment for trip id " . request()->order_id;
        $row->save();
    }

    public function anyCreate() {
        $row = new Model;
        $row->amount = request()->amount;
        $row->driver_id = request()->driver_id;
        $row->client_id = request()->client_id;
        $row->order_id = request()->order_id;
        $row->payment_method = request()->payment_method;
        $row->date = date("Y-m-d H:i:s");
        $row->description = " payment for trip id " . request()->order_id;
        $row->save();

        return Response::make()->setMessage(__('admin.transaction created successfully'))->send();
    }

}
