<?php

namespace App\Http\Controllers\Admin\Permissions;

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
use App\Models\Permission as Model;
use App\Http\Validations\Admin\PermissionsValidator as check;
use App\Models\Rule as UG;

class Permissions extends \App\Http\Controllers\Admin\Base {

    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
        parent::__construct();
    }

    public function getIndex() {
        return parent::view(['rows' => $this->model->paginate()]);
    }

    public function getCreate() {
        $actionsList = initData::getActions();
        $models = initData::getModels();
        $row = $this->model;
        $rules = UG::where('super_admin', 0)->lists('name', 'id');
        return parent::view(compact('actionsList', 'models', 'row', 'rules'));
    }

    public function postCreate(check $request) {
        $data = initData::create($request);
        Model::quickSave($data);
        flash()->success(__('admin.' . Str::singular($this->module) . ' has been added Successfully'));
        return parent::redirectToIndex();
    }

    public function getEdit($id) {

        $actionsList = initData::getActions();
        $models = initData::getModels();
        $row = $this->model->findOrFail($id);
        $rules = UG::where('super_admin', 0)->lists('name', 'id');
        return parent::view(compact('actionsList', 'models', 'row', 'rules'));
    }

    public function postEdit(check $request) {
        Model::quickUpdate($request->except('_token'));
        flash()->success(__('admin.' . Str::singular($this->module) . ' has been edited Successfully'));
        return parent::redirectToIndex();
    }

    public function getDelete($id) {
        $this->model->destroy($id);
        flash()->success(__('admin.' . Str::singular($this->module) . ' has been deleted Successfully'));
        return parent::redirectToIndex();
    }

}
