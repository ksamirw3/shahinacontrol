<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Amit\Settings;

/**
 * Description of Upload
 *
 * @author jooaziz
 */
class Upload {

    public static function getPath() {
        return env('UPLOAD_BASE');
    }

    public static function defaultUploadStorage() {
        return env('DEFAULT_UPLOAD_STORAGE');
    }

}
