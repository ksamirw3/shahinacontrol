<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Api\Driver\Transactions;

/**
 * Description of Amount
 *
 * @author jooAziz
 */
class Amount {

    private $adminProfit = 0;
    private $driverProfit = 0;

    public function __construct($amount) {
        if ($amount) {
            $commition = \App\Models\Setting::getCommission();
            $this->adminProfit = $amount / $commition;
            $this->driverProfit = $amount - $this->adminProfit;
        }
    }

    public function getDriverProfit() {
        return $this->driverProfit;
    }

    public function getAdminProfit() {
        return $this->adminProfit;
    }

}
