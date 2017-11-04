<?php

namespace App\Http\Controllers\Api\Client\Orders;

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
use App\Http\Controllers\Api\Client\Orders\Validator as Checker;
use Carbon\Carbon;
use JooAziz\Response\Response;

class Orders extends \App\Http\Controllers\Api\Base {

    public function anyOpen(Checker $d) {
        $res = Model::getOrdersForClient(request()->user_id, Model::$open);
       // dd($res);
        return Response::make()->setData(['ordersList' => $res])->setResult(TRUE)->send();
    }

    public function anyRejected(Checker $d) {
        $res = Model::getOrdersForClient(request()->user_id, Model::$rejected);
        return Response::make()->setData(['ordersList' => $res])->setResult(TRUE)->send();
    }

    public function anyExecuted(Checker $d) {
        $res = Model::getOrdersForClient(request()->user_id, Model::$executed);
        return Response::make()->setData(['ordersList' => $res])->setResult(TRUE)->send();
    }

    public function anyCreateOrder() {
        $req = request()->all();

        if(!isset($req['car_type'])){
            $req['car_type'] = 'small';
        }
        
        $data['car_type'] = @$req['car_type'];
        $data['recommended_place_id'] = @$req['recommended_place'];
        $data['amount'] = $req['amount'];
       // $data['category_id'] = $req['category_id'];
        $data['description'] = $req['description'];
        $data['to_latitude'] = $req['to_latitude'];
        $data['to_longitude'] = $req['to_longitude'];
        $data['to_address'] = $req['to_address'];
        $data['from_latitude'] = $req['from_latitude'];
        $data['from_longitude'] = $req['from_longitude'];
        $data['from_address'] = $req['from_address'];
        $data['trip_type'] = $req['trip_type'];
        $data['image'] = $req['image'];
        $data['client_id'] = (strpos($req['client_id'], "dr"))? substr($req['client_id'],2) : $req['client_id'];
//      $data['custom_category'] = $req['custom_category'];
        $data['receiver_phone'] = $req['receiver_phone'];
        $data['receiver_name'] = $req['receiver_name'];
        $data['status'] = Model::$open;
        $data['start_time'] = Carbon::now();
        
        \Log::info('data: '. json_encode($data));

//        if (request()->hasFile('image')) {
//            $data['image'] = uploadImages(request()->file(image));
//        }

        $row = Model::quickSave($data);

        if (!$row) {
            // return response()->json(['result' => false, "data" => null, 'message' => __('admin.order not saved')]);
            return Response::make()->setMessage(__('admin.order not saved'))->send();
        } else {
            // return response()->json(['result' => false, "data" => null, 'message' => __('admin.order saved successfully')]);
            //print_r($row);
            return Response::make()->setResult(true)->setData(['id' => $row->id])->setMessage(__('admin.order saved successfully'))->send();
        }
    }

}
