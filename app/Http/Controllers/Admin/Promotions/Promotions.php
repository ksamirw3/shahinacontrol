<?php

namespace App\Http\Controllers\Admin\Promotions;

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
use App\Models\Promotion as Model;
use App\Http\Validations\Admin\PromotionValidation as check;
use App\Http\Mails\Admin\Driver as MailSender;

class Promotions extends \App\Http\Controllers\Admin\Base {

    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
        parent::__construct();
    }

    public function getIndex() {

        return parent::view(['rows' => Model::all()]);
    }

    public function getCreate() {
        return parent::view([ 'row' => $this->model]);
    }

    public function postCreate(check $request) {
        Model::quickSave(initData::create($request));
        flash()->success(__('admin.' . Str::singular($this->module) . ' has been added Successfully'));
        return parent::redirectToIndex();
    }

    public function getEdit($id) {
        $row = $this->model->findOrFail($id);
        return parent::view(compact('row'));
    }

    public function postEdit(check $request) {
        $data = initData::edit($request);
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
