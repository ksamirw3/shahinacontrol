<?php

namespace App\Http\Controllers\Admin\Categories;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Amit\Support\Str;
use App\Models\Category as Model;
use App\Http\Validations\Admin\CategoryValidation as check;

class Categories extends \App\Http\Controllers\Admin\Base {

    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
        parent::__construct();
    }

    public function getIndex() {
        $userClass = new Model;

        if (request()->name_en)
            $userClass = $userClass->where('name_en', 'like', request()->name_en . '%');

        if (request()->name_ar)
            $userClass = $userClass->where('name_ar', 'like', '%' . request()->name_ar . '%');

        return parent::view(['rows' => $userClass->whereByAdmin(1)->paginate()]);
    }

    public function getView($id) {
        $row = $this->model->findOrFail($id);
        return parent::view(compact('row'));
    }

    public function getCreate() {

        return parent::view([ 'row' => $this->model]);
    }

    public function postCreate(check $request) {

        $row = $request->all();
        Model::create($row);

        flash()->success(__('admin.' . Str::singular($this->module) . ' has been added Successfully'));
        return parent::redirectToIndex();
    }

    public function getEdit($id) {
        $row = $this->model->findOrFail($id);
        return parent::view(compact('row'));
    }

    public function postEdit(check $request) {
        $data = $request->all();
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
