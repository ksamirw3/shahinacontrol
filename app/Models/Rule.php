<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;

/**
 * Description of Groupe
 *
 * @author jooaziz
 */
class Rule extends BaseModel {

    public function permissionsGroups() {
        return $this->hasMany(PermissionsRules::class);
    }

    public function admin() {
        return $this->hasMany(Admin::class, 'rule_id');
    }

    protected static function boot() {
        parent::boot();
        static::deleting(function ($model) {
           
            if (count($model->admin) > 0)
                return FALSE;
            $model->permissionsGroups()->delete();
        });
    }

}
