<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

/**
 * Description of Groupe
 *
 * @author jooaziz
 */
class Order extends BaseModel {

    public static $cashOnDliver = 0;
    public static $open = 1;
    public static $rejected = 0;
    public static $executed = 2;
    public static $deliver = "deliver";
    public static $bring = "bring";

    public static function getOrdersForClient($clientId, $status) {
        // dd( $status);
        $data = self::whereClientId($clientId)
                ->whereStatus($status)
                ->rightJoin('drivers as driver', 'orders.driver_id', '=', 'driver.id')
                ->select(
                        'driver.rate as driver_rate', 'orders.trip_type as trip_type', 'orders.amount as order_cost', \DB::raw('CAST(orders.id  as CHAR(50)) as order_id'), 'start_time as order_time', 'from_address as order_start_location', 'to_address as order_end_location', 'driver.full_name as driver_name', 'driver.presonal_image as driver_img_url'
                )
                ->orderBy('orders.id', 'desc')
                ->get();

        return $data;
    }

    public static function getOrdersForDriver($driverid, $status) {
        return self::whereDriverId($driverid)
                        ->whereStatus($status)
                        ->leftJoin('users as client', 'orders.client_id', '=', 'client.id')
                        ->select(
                                'orders.trip_type as trip_type', \DB::raw('CAST(orders.id  as CHAR(50)) as order_id'), 'orders.amount as order_cost', 'start_time as order_time', 'from_address as order_start_location', 'to_address as order_end_location', 'client.f_name as client_name', 'client.image as client_img_url'
                        )
                        ->orderBy('orders.id', 'desc')
                        ->get();
    }

    public function car_type() {
        
    }

    public function client() {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function driver() {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

}
