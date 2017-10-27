<?php

namespace App\Http\Controllers\Admin\Transactions;

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
use App\Models\Transaction as Model;


class Transactions extends \App\Http\Controllers\Admin\Base {

    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
        parent::__construct();
    }

    public function getIndex() 
    {
        $transactionClass = new Model;

        if(request()->driver_name)
        {
            $transactionClass = $transactionClass->whereHas('driver',function($driver){
                return  $driver->where('username','like','%'.request()->driver_name.'%');
            });
        }

        if(request()->client_name)
        {
            $transactionClass = $transactionClass->whereHas('client',function($client){
                return  $client->where('username','like','%'.request()->client_name.'%');
            });
        }

        if(request()->from_date && request()->to_date)
        {
            $transactionClass = $transactionClass->whereBetween('date', array(request()->from_date, request()->to_date));
            // dd($transactionClass->toSql());
        }

        return parent::view(['rows' => $transactionClass->paginate()]);
    }
}
