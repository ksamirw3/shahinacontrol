<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (!function_exists('uploadImages')) {

    /**
     *
     * @param \Illuminate\Http\UploadedFile|array $files
     * @param array $sizes ['resize,200x200','crop,200x200']
     * @param bool $deleteOrginal default false
     * @param bool|String class name
     * @return array String [file name]
     */
    function uploadImages($files, $sizes = [], $deleteOrginal = false, $storage = 'Local') {
        return \Amit\Uploader\Upload::upload($files, $sizes, $deleteOrginal, $storage);
    }

}
if (!function_exists('uploadFiles')) {

    /**
     *
     * @param \Illuminate\Http\UploadedFile|array $files
     * @return array of filename
     */
    function uploadFiles($files) {
        return \Amit\Uploader\Upload::upload($files);
    }

}