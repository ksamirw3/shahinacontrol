<?php

namespace Amit\Uploader;

use Validator;
use File;
use \Eventviva\ImageResize;

class ImageUploader {

    private $files;
    private $filesName;
    private $pathes = [];
    private $uploadPath;

    public function __construct($files) {
        $this->uploadPath = 'uploads/';
        $this->files = $files;
    }

    public function updetUploadPath($newPath) {
        $this->uploadPath = $newPath;
    }

    public function prossess() {
        if (is_array($this->files)) {
            return $this->uploadMulti();
        }
        else {
            return $this->upload($this->files);
        }
    }

    public function uploadMulti() {
        $arrs = [];
        $file_count = count($this->files);
        $uploadcount = 0;
        foreach ($this->files as $file) {
            if ($st = $this->upload($file)) {
                $arrs[] = $st;
                $uploadcount++;
            }
        }
        if ($uploadcount == $file_count) {
            return $arrs;
        }
        else {
            return false;
        }
    }

    private function upload($file) {
        $rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
        $validator = Validator::make(array('file' => $file), $rules);
        if ($validator->passes()) {
            $destinationPath = $this->uploadPath;
            $this->filesName[] = $filename = rand(111111, 99999999999999) . time() . '.' . strtolower($file->getClientOriginalExtension());
            $this->pathes[] = $destinationPath . $filename;
            $file->move($destinationPath, $filename);
            return $filename;
        }
        return false;
    }

    public function resize($imageSizes = [], $paths = null) {
        if (is_null($paths)) {
//            $this->pathes = $this->pathes;
        }
        else if (!is_array($paths)) {
            $this->pathes[] = $paths;
        }
        else {
            $this->pathes = $paths;
        }
        $uploadPath = $this->uploadPath;
        foreach ($imageSizes as $value) {
            $value = explode(',', $value);
            $type = $value[0];
            $dimensions = explode('x', $value[1]);
            if (!File::exists($uploadPath . $value[1])) {
                mkdir($uploadPath . $value[1]);
            }
            foreach ($this->filesName as $path) {
                $thumbPath = $uploadPath . $value[1] . '/' . $path;
//                dd($this->uploadPath . $path);
                $image = new ImageResize($this->uploadPath . $path);
                $image->quality_jpg = 90;
                if ($type == 'resize') $type = 'resize';
                $image->$type($dimensions[0], $dimensions[1]);
                $image->save($thumbPath);
            }
        }
    }
}