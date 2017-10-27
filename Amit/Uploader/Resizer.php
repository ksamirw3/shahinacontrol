<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Amit\Uploader;

/**
 * Description of Resizer
 *
 * @author jooaziz
 */
class Resizer implements Interfaces\Resizer {

    public static function resiz($files, $sizes, $deleteOrginal = false) {

        $uploadPath = \Amit\Settings\Upload::getPath();
        foreach ($sizes as $value) {
            $value = explode(',', strtolower($value));
            $type = $value[0];
            $dimensions = explode('x', $value[1]);
            if (!\File::exists($uploadPath . $value[1])) {
                mkdir($uploadPath . $value[1]);
            }
            foreach ($files as $file) {
                $thumbPath = $uploadPath . $value[1] . '/' . $file;
                $image = new \Eventviva\ImageResize($uploadPath . $file);
                $image->quality_jpg = 90;
                if ($type == 'resize') $type = 'resize';
                $image->$type($dimensions[0], $dimensions[1]);
                $image->save($thumbPath);
            }
        }
        if ($deleteOrginal) static::deleteOriginal($files);
    }

    public static function deleteOriginal($files) {
        $uploadPath = \Amit\Settings\Upload::getPath();
//        dd($files);
        foreach ($files as $file) {
            $filePath = $uploadPath . $file;
            if (\File::exists($filePath)) \File::delete($filePath);
        }
    }

}
