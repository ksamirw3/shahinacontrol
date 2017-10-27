<?php

namespace Amit\Uploader\Interfaces;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author jooaziz
 */
interface IUpload {

    /**
     *  main method that get files and  sizes
     *
     * it return  array of files name
     * @param type $files
     * @param type $sizes
     */
    static function upload($files, $sizes = []);

    /**
     * check if file is array or convert it to array
     * @param type $files
     */
    static function prepairFilesArray($files);

    /**
     * get array file and loop in it
     * @param type $files
     */
    static function processUpload($files);

    /**
     * upload method
     * @param type $file
     */
    static function uploadOneFile($file);
}
