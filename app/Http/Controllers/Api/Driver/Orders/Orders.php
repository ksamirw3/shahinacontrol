<?php

namespace App\Http\Controllers\Api\Driver\Orders;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Orders
 *
 * @author JooAziz
 */
use App\Models\Order as Model;
use App\Http\Controllers\Api\Driver\Orders\Validator as Checker;
use App\Models\Order;
use Carbon\Carbon;
use JooAziz\Response\Response;

class Orders extends \App\Http\Controllers\Api\Base {

    public function anyFirstOrderDate() {
        if (!request()->driver_id)
            return Response::make()->setMessage('driver id not valid')->send();
        $order = Order::whereDriverId(request()->driver_id)->first();
        if (!$order)
            return Response::make()->setMessage('no orders yet')->send();
        return Response::make()->setResult(true)->setData(['date' => @$order->created_at->toDateTimeString()])->send();
    }

    public function anyOpen(Checker $d) {
        $res = Model::getOrdersForDriver(request()->driver_id, Model::$open);
        return Response::make()->setData(['ordersList' => $res])->setResult(TRUE)->send();
    }

    public function anyRejected(Checker $d) {
        $res = Model::getOrdersForDriver(request()->driver_id, Model::$rejected);
        return Response::make()->setData(['ordersList' => $res])->setResult(TRUE)->send();
    }

    public function anyExecuted(Checker $d) {
        $res = Model::getOrdersForDriver(request()->driver_id, Model::$executed);
        return Response::make()->setData(['ordersList' => $res])->setResult(TRUE)->send();
    }

    public function anyUpdate() {
        $validator = \Illuminate\Support\Facades\Validator::make(request()->toArray(), [
            "order_id" => ['required', "numeric", "exists:orders,id"],
            "val" => ['required'],
            "key" => ['required', 'in:driver_id,from_address,receiver_name,from_latitude,from_longitude,to_longitude,status,receiver_phone,start_time,end_time,to_address,amount,description,to_latitude'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => 400,
                "msg" => "data not founded",
                "errors" => $validator->errors()->all()
            ]);
        }

        $order = Model::find(request()->order_id);
        $order->{request()->key} = request()->val;
        if ($order->save()) {
            $result = true;
            $msg = request()->key . " updated Successfully";
            $error = "";
        } else {
            $result = false;
            $msg = request()->key . " updated Successfully";
            $error = "";
        }
        return Response::make()->setResult($result)->setMessage($msg)->setError($error)->send();
    }

}
