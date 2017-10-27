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
 * @author Mahmoud Ali
 */
class Setting extends BaseModel {

    public static function getCommission() {
        return 10;
    }

}
