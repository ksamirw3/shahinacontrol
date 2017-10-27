<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

use Carbon\Carbon;

/**
 * Description of Promotion
 *
 * @author JooAziz
 */
class Promotion extends BaseModel {

    public function isExpired() {
        return Carbon::parse($this->expire_date)->lte(Carbon::now());
    }

}
