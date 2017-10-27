<?php

namespace App\Http\Controllers\Admin\Reports;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Groupes
 *
 * @author jooaziz
 */
use Amit\Support\Str;
use App\Http\Validations\Admin\DreiversValidatio as check;
use App\Http\Mails\Admin\Driver as MailSender;
use App\Models\Order as DriverOrders;
use App\Models\Review;
use App\Models\Driver;
use App\Models\User;
use App\Models\Transaction;

class Reports extends \App\Http\Controllers\Admin\Base {

    protected $model;

    public function getDrivers() {
        return parent::view(self::makeReport(Driver::class));
    }

    public function getClients() {
        return parent::view(self::makeReport(User::class));
    }

    public function getTransactions() {


        return parent::view(self::makeReport(Transaction::class));
    }

    public function getOrders() {
        return parent::view(self::makeReport(DriverOrders::class));
    }

    private static function makeReport( $model) {
        $rows = new $model;
        $columns = (new $model)->getTableColumns(['password', 'id']);

        if (request()->from_date)
            $rows = $rows->whereDate('created_at', '>=', request()->from_date);

        if (request()->to_date)
            $rows = $rows->whereDate('created_at', '<=', request()->to_date);

        $drivers = $rows->paginate(100);
        return compact("columns", "drivers");
    }

}
