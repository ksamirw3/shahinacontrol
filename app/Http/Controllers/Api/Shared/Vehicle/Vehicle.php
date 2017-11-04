<?php

namespace App\Http\Controllers\Api\Shared\Vehicle;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Category
 *
 * @author Mahmoud Ali
 */
use App\Models\Vehicle as Model;
use JooAziz\Response\Response;

class Vehicle extends \App\Http\Controllers\Api\Base {


    public function anyAll() {
        $row = new Model;

        $list = $row->all();
//        
        return Response::make()->setData(["list" => $list])->setResult(true)->send();
    }

}
