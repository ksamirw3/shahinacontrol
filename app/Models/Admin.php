<?php

namespace App\Models;

class Admin extends BaseModel {

    public function notAdmin() {

    }

    public function rule() {
        return $this->belongsTo(Rule::class, 'rule_id');
    }

    public function branches() {
        return $this->hasMany(Branche::class, 'manager_id');
    }

    public static function trainingManager() {
        return self::whereHas('rule', function ($table) {
                    $table->where('name', 'training manager')->where('active', 1);
                })->lists('username', 'id');
    }

}
