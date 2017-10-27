<?php

namespace Amit\Uploader\Storages;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Local
 *
 * @author jooaziz
 */
class Local implements \Amit\Uploader\Interfaces\IUpload {

    protected static $fileList;
    public static $deleteOrginal;

    public static function upload($files, $sizes = array(), $deleteOrginal = false) {
        static::$fileList = [];
        $files = static::prepairFilesArray($files);
        static::processUpload($files);
        \Amit\Uploader\Resizer::resiz(static::$fileList, $sizes, $deleteOrginal);
        return static::$fileList;
    }

    public static function prepairFilesArray($files) {
        if (is_null($files)) return [];
        if (is_array($files)) return $files;
        return [$files];
    }

    public static function processUpload($files) {
        foreach ($files as $file) static::$fileList[] = static::uploadOneFile($file);
    }

    public static function uploadOneFile($file) {
        $filename = \Amit\Support\UUID::uniqeFileName() . '.' . strtolower($file->getClientOriginalExtension());
        $file->move(
            '/home/shahinaglobal/control.shahina-global.com/storage/app/public/images'
            //\Amit\Settings\Upload::getPath()
        
        , $filename);
        return $filename;
    }

}
