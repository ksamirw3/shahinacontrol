<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Authantications\AdminAuth as AA;
use App\Models\Driver;
use App\Models\Review;
use JooAziz\Response\Response;
use App\Models\User as Client;
use App\Models\Order;

/**
 * Description of Dashboard
 *
 * @author PHP_Developer
 */
class Dashboard extends \App\Http\Controllers\Admin\Base
{

    public function getIndex()
    {
        $total_drivers = $this->totalDrivers();
        $total_clients = $this->totalClients();
        $total_rejcted = $this->rejectedTrips();
        $total_excuted = $this->excutedTrips();
        $online_drivers = $this->openConnection();
        $trip_type = $this->tripType();
        $last_comments = $this->lastComments();

        return parent::view(compact('total_drivers', 'total_clients', 'total_rejcted', 'total_excuted', 'online_drivers', 'trip_type', 'last_comments'));
    }

    public function liveTracking()
    {
        return parent::view();
    }

    public function anyTotalOrders()
    {
        $count = Order::lists('status');
        $arr = ['open' => 0, 'rejected' => 0, 'executed' => 0];
        foreach ($count as $item) {
            $st = ($item == Order::$open) ? 'open' : ($item == Order::$executed) ? 'executed' : 'rejected';
            $arr[$st] += 1;
        }
        return Response::make()->setData(['count' => $arr])->send();
    }

    public function totalClients()
    {
        return Client::count();
    }

    public function anyTotalClients()
    {
        return Response::make()->setData(['count' => $this->totalClients()])->send();

    }

    public function totalDrivers()
    {
        return Driver::count();
    }

    public function anyTotalDrivers()
    {
        return Response::make()->setData(['count' => $this->totalDrivers()])->send();

    }

    public function lastComments()
    {
        $rt = [];
        $data = Review::with('client')->limit(5)->get()->toArray();
        foreach($data as $k => $v)
        {
            $rt[] = ['name' => $v['client']['username'], 'image' => $v['client']['image'], 'comment' => $v['comment']];
        }

        return $rt;
    }

    public function anyLastComments()
    {
        return Response::make()->setData(['data' => $this->lastComments()])->send();
    }

    public function rejectedTrips()
    {
        return Order::where('status', '=', Order::$rejected)->count();
    }

    public function anyRejectedTrips()
    {
        $rejected = $this->rejectedTrips();
        return Response::make()->setData($rejected)->setResult(TRUE)->send();
    }

    public function excutedTrips()
    {
        return Order::where('status', '=', Order::$executed)->count();
    }

    public function anyExecutedTrips()
    {
        $executed = $this->excutedTrips();
        return Response::make()->setData($executed)->setResult(TRUE)->send();
    }

    public function anyOnlineDrivers()
    {
        $online = Driver::where('is_connect', '=', '1')->count();
        return Response::make()->setData($online)->setResult(TRUE)->send();
    }

    public function tripType()
    {
        $trip = Order::all()->groupBy('trip_type')->toArray();
        $result = array('dliver' =>  (int) count(@$trip[Order::$bring]), 'bring' => (int) count(@$trip[Order::$deliver]));
        // dd($trip);
        return $result;
    }

    public function anyTripType()
    {
        return Response::make()->setData($this->tripType())->setResult(TRUE)->send();
    }

    public function openConnection()
    {
        $users = Driver::all()->groupBy('is_connect')->toArray();
        $online_users = Driver::where('is_connect', '=', '1')->count();
        $all_users = Driver::all()->count();
        $offline_usrers = $all_users - $online_users;
        $online_perc = @round($online_users/$all_users*100);
        $result = array('online' => $online_users, 'all_users' => $all_users, 'offline_usrers' => $offline_usrers, 'online_perc' => $online_perc);
        return $result;
    }

    public function anyOpenConnection()
    {
        return Response::make()->setData($this->openConnection())->setResult(TRUE)->send();
    }
}
