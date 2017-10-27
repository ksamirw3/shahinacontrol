<?php

namespace App\Http\Controllers\Api\Client\Reviews;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reviews
 *
 * @author JooAziz
 */
use App\Models\Driver;
use App\Models\Review as Model;
use App\Http\Controllers\Api\Client\Reviews\Validator as Checker;
use Carbon\Carbon;
use JooAziz\Response\Response;

class Reviews extends \App\Http\Controllers\Api\Base {

    public function anyCreateReview(Checker $d) {
        $req = request()->all();

        $data['user_id'] = $req['user_id'];
        $data['order_id'] = $req['order_id'];
        $data['driver_id'] = $req['driver_id'];
        $data['comment'] = @$req['comment'];
        $data['rate'] = $req['rate'];


        $row = Model::quickSave($data);

        $driverObj = Model::whereDriverId($req['driver_id']);

        $totalRate = (int) $driverObj->sum('rate');
        $count = $driverObj->count();

        $dri = Driver::find($req['driver_id']);
        if (!$dri)
            return Response::make()->setMessage(__('admin.driver not found'))->send();

        $dri->rate = (int) round($totalRate / $count);
        $dri->save();

        if (!$row) {
            return Response::make()->setMessage(__('admin.order not saved'))->send();
        } else {
            return Response::make()->setResult(TRUE)->setData($row)->setMessage(__('admin.order saved successfully'))->send();
        }
    }

}
