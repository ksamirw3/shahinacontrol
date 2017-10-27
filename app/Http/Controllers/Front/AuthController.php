<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Front\Base;
use Config;
use App\Models\User;
use Session;
use Mail;
use Auth;
use App\Models\CouchbaseBasement;

class AuthController extends Base {

    public $model;
    public $module;
    public $rules;

    public function __construct(\App\Models\Couch\User $object) {
        parent::__construct();
        $this->module = 'auth';
        $this->model = $object;
    }

    public function getActivate($token) {
        $row = $this->model->getByConfirmToken($token);
        $key = array_keys($row);
        if (!@count($row) == 1) {
            flash()->error(__('admin.Your are trying to access invalid page'));
            return redirect('/');
        }
        if ($this->model->update($row[$key[0]]->id, ['activated' => 1])) {
            return view($this->viewPerfix("activate"),
                ['module' => $this->module]);
        }
    }
}