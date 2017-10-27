<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

/**
 * Description of BaseModel
 *
 * @author jooaziz
 */
class BaseModel extends \Illuminate\Database\Eloquent\Model
{

    protected $guarded = [];

    public static function quickSave($data)
    {
        return (new static)->create($data);
    }

    public static function quickUpdate($data)
    {
        $row = (new static)->findOrFail($data['id']);
        $row->update($data);
        return $row;
    }

    public static function quickDelete($id)
    {
        (new static)->destroy($id);
    }

    public function getTableColumns($exeptions = [])
    {

        $arr = $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());

        foreach ($exeptions as $col) {
            if (($key = array_search($col, $arr)) !== false) {
                unset($arr[$key]);
            }

        }
        return $arr;
    }

}
