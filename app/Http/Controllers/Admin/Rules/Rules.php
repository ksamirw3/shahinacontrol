<?php

namespace App\Http\Controllers\Admin\Rules;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rules
 *
 * @author jooaziz
 */
use Amit\Support\Str;
use App\Models\Rule as Model;
use App\Http\Validations\Admin\RulesValidator as check;
use App\Models\PermissionsRules;
use App\Models\Permission;

class Rules extends \App\Http\Controllers\Admin\Base {

    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
        parent::__construct();
    }

    public function getIndex() {
        return parent::view(['rows' => $this->model->where('editabel', 1)->paginate()]);
    }

    public function getCreate() {
        $permissions = \App\Models\Permission::all()->groupBy('model');
        return parent::view(['row' => $this->model, 'permissions' => $permissions]);
    }

    public function postCreate(check $request) {
  
        if (empty($request->except('_token', 'name'))) {
            flash()->error(__('admin.please select at least one permission'));
            return back()->withInput();
        }
        PermissionsRules::insert(initData::createPermissions(Model::quickSave(initData::create($request)), $request));
        flash()->success(__('admin.' . Str::singular($this->module) . ' has been added Successfully'));
        return parent::redirectToIndex();
    }

    public function getEdit($id) {
        return parent::view([
                    'row' => $this->model->findOrFail($id),
                    'permissions' => Permission::all()->groupBy('model'),
                    'myPermissions' => PermissionsRules::whereActive(1)->whereRuleId($id)->lists('permission_id')->toArray(),
        ]);
    }

    public function postEdit(check $request) {
        initData::updatePermissions(Model::quickUpdate(initData::edit($request)), $request);
        flash()->success(__('admin.' . Str::singular($this->module) . ' has been edited Successfully'));
        return parent::redirectToIndex();
    }

    public function getDelete($id) {
        $st = $this->model->destroy($id);
        if ($st) {
            flash()->success(__('admin.' . Str::singular($this->module) . ' has been deleted Successfully'));
        } else {
            flash()->error(__('admin.' . Str::singular($this->module) . ' is linked to permission and admin'));
        }
        return parent::redirectToIndex();
    }

}
