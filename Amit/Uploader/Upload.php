<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Upload
 *
 * @author PHP_Developer
 */

namespace Amit\Uploader;

class Upload {

    public static function upload($files, $sizes = [], $deletOrginal = false, $storage = false) {
        $class = self::getDeafultClass($storage);
        return $class::upload($files, $sizes, $deletOrginal);
    }

    private static function getDeafultClass($storage) {
        $defaltName = ($storage)? : \Amit\Support\Str::ClassCase(\Amit\Settings\Upload::defaultUploadStorage());
        $class = '\Amit\Uploader\Storages\\' . $defaltName;
        if (!class_exists($class)) abort(404, "AMIT : class '$class' not found");
        return $class;
    }

}
