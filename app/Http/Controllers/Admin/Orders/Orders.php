<?php

namespace App\Http\Controllers\Admin\Orders;

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
use App\Models\Order as Model;
use App\Http\Validations\Admin\DreiversValidatio as check;

class Orders extends \App\Http\Controllers\Admin\Base {

    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
        parent::__construct();
    }

    public function getIndex() {
        $userClass = new Model;

        if (request()->username) {
            $userClass = $userClass->whereHas('driver', function($driver) {
                return $driver->where('username', 'like', '%' . request()->username . '%');
            });
        }

        if (request()->date)
            $userClass = $userClass->where('start_time', 'like', request()->date . '%');


        if (request()->status || request()->status === "0") {
            $userClass = $userClass->where('status', '=', request()->status);
        }

        if (request()->sort) {
            $userClass = $userClass->orderBy('created_at', request()->sort);
        }


        return parent::view(['rows' => $userClass->paginate()->appends(request()->except('page'))]);
    }

    public function getView($id) {
        $row = $this->model->findOrFail($id);
        return parent::view(compact('row'));
    }

    public function getEdit($id) {
        $row = $this->model->findOrFail($id);


        return parent::view(compact('row'));
    }

    public function postEdit(check $request) {
        $data = initData::create($request);
        Model::quickUpdate($data);
        flash()->success(__('admin.' . Str::singular($this->module) . ' has been edited Successfully'));
        return parent::redirectToIndex();
    }

    public function getDelete($id) {


        Model::destroy($id);

        flash()->success(__('admin.' . Str::singular($this->module) . ' has been deleted Successfully'));
        return parent::redirectToIndex();
    }

}

// Model::$open;
