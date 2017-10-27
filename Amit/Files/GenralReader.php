<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Amit\Files;

/**
 * Description of GenralReader
 *
 * @author jooaziz
 */
class GenralReader {

    public static function read(\Illuminate\Http\UploadedFile $file) {
        $mime = $file->getMimeType();
//        dd($mime);
        switch ($mime) {
            case "image/jpeg":
            case "image/png":
                return new ImgReader($file);
            case "text/plain":
                return new TextReader($file);
            case "application/msword":
                return (new DocReader($file))->isOldDoc();
            case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
                return new DocReader($file);
            default :
                abort(401, 'extionsion not subbort');
        }
    }

}
