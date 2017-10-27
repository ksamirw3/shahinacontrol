<?php

namespace App\Http\Helper\Shared;

use App\Models\Transaction;
use Illuminate\Support\Collection;
use App\Models\Setting;

/**
 * Created by PhpStorm.
 * User: jooAziz
 * Date: 1/30/2017
 * Time: 12:43 PM
 */
class TransactionHelper {

    private static $driver = null;
    private static $count = 0;

    public static function driverInstance($id) {
        if (!self::$driver) {
            self::$driver = \App\Models\Driver::findOrFail($id);
            self::$count++;
        }
        return self::$driver;
    }

    public static function TransactionToCalculation($id, $from = null, $to = null) {
        $rt = (object) [];
        $driver = self::driverInstance($id);
        $rt->totalAmount = floatval(self::totalAmount($driver, $from, $to));
        $rt->netProfit = floatval($rt->totalAmount - ($rt->totalAmount / Setting::getCommission()));
        $rt->paidAmount = floatval(self::paidAmount($driver, $from, $to));
        $rt->restAmount = floatval(($rt->netProfit - $rt->paidAmount));
        return $rt;
    }

    public static function getFullTransactionData($id, $from = null, $to = null) {
        $rt = self::TransactionToCalculation($id, $from, $to);
        $rt->commission = Setting::getCommission();
        $rt->transactions = self::getAllTransaction(self::driverInstance($id), $from, $to);
        $rt->driver = self::driverInstance($id);
        
        return $rt;
    }

    /**
     * @param $driver
     * @param String
     * @param string
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private static function getAllTransaction($driver, $from, $to) {
        $transactions = $driver->myTransactions([Transaction::$cash, Transaction::$paid]);
        if ($from)
            $transactions = $transactions->whereDate('date', '>=', $from);
        if ($to)
            $transactions = $transactions->whereDate('date', '<=', $to);
        return $transactions->get();
    }

    private static function totalAmount($driver, $from, $to) {
        $transactions = $driver->myTransactions([Transaction::$cash, Transaction::$visa]);
        if ($from)
            $transactions = $transactions->whereDate('date', '>=', $from);
        if ($to)
            $transactions = $transactions->whereDate('date', '<=', $to);

        return (is_null($transactions->sum('amount'))) ? 0 : $transactions->sum('amount');
    }

    private static function paidAmount($driver, $from, $to) {
        $transactions = $driver->myTransactions([Transaction::$cash, Transaction::$paid]);
        if ($from)
            $transactions = $transactions->whereDate('date', '>=', $from);
        if ($to)
            $transactions = $transactions->whereDate('date', '<=', $to);
        return (is_null($transactions->sum('amount'))) ? 0 : $transactions->sum('amount');
    }

}
