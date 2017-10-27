<?php

namespace App\Http\Controllers\Api\Shared\Category;

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
use App\Models\Category as Model;
use App\Http\Controllers\Api\Shared\Category\Validator as Checker;
use JooAziz\Response\Response;

class Category extends \App\Http\Controllers\Api\Base {

    public function anyAddNew() {
        $categorId = 1;//(int) request()->category_id;
        $cus_category = 1;//request()->custome_category;
        if ($categorId == 0) {
            $row = Model::create(["name_ar" => $cus_category, "name_en" => $cus_category, "by_admin" => 0]);
            return Response::make()->setData($row)->send();
        } else {
            return Response::make()->setData(Model::find(request()->category_id))->send();
        }
    }

    public function anyAll() {
        $row = new Model;
        if (request()->lang)
            $row = $row->select('id', 'name_' . request()->lang . ' as name');
        else
            $row = $row->select('id', 'name_ar', 'name_en');

        if ($row) {
            
        }

        $list = $row->whereNotNull('name_ar')
                ->whereNotNull('name_en')
                ->whereByAdmin(1)
                ->get();
        
        return Response::make()->setData(["list" => $list])->setResult(true)->send();
    }

}
