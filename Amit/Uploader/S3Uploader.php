<?php

namespace Amit\Uploader;

use Validator;
use File;
use \Eventviva\ImageResize;

class S3Uploader {

    private $files;
    private $filesName;
    private $pathes = [];
    private $uploadPath;
    private $tempPath;
    private $uploadedFilesPaths;
    private $uploderType;

    public function __construct($files, $type) {
        $this->tempPath = 'uploads/';
        $this->uploadPath = env('AWS_IMAGE_BASE_URL') . 'uploads/';
        $this->files = $files;
        $this->uploderType = $type;
    }

    public function updetUploadPath($newPath) {
        $this->tempPath = $newPath;
    }

    public function prossess() {
        if (is_array($this->files)) {
            $this->uploadedFilesPaths = $this->uploadMulti();
            return $this->uploadedFilesPaths;
        } else {
            $uploadedFilesPaths = $this->upload($this->files);
            $this->uploadedFilesPaths[] = $uploadedFilesPaths;
            return $uploadedFilesPaths;
//            return $this->upload($this->files);
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
        } else {
            return false;
        }
    }

    private function upload($file) {
        $rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
        $validator = Validator::make(array('file' => $file), $rules);
        if ($validator->passes()) {
            $destinationPath = $this->tempPath;
            $this->filesName[] = $filename = rand(111111, 99999999999999) . time() . '.' . strtolower($file->getClientOriginalExtension());
            $this->pathes[] = $destinationPath . $filename;
            $file->move($destinationPath, $filename);
            return $filename;
        }
        return false;
    }

    public function finish() {
        $destinationPath = $this->uploadPath;
        $sourcePath = $this->tempPath;
        foreach ($this->uploadedFilesPaths as $path) {
            $s3 = \Storage::disk('s3');
            if ($s3->put($sourcePath . $path, file_get_contents($sourcePath . $path), 'public')) {
                unlink($sourcePath . $path);
            }
        }
        return TRUE;
    }

    public function resize($imageSizes = [], $paths = null) {
        if (!is_null($this->uploderType)) {
            $finalPaths = [];
            if (is_null($paths)) {
//            $this->pathes = $this->pathes;
            } else if (!is_array($paths)) {
                $this->pathes[] = $paths;
            } else {
                $this->pathes = $paths;
            }
            $uploadPath = $this->tempPath;
            foreach ($imageSizes as $value) {
                $value = explode(',', $value);
                $type = $value[0];
                $dimensions = explode('x', $value[1]);
                if (!File::exists($uploadPath . $value[1])) {
                    mkdir($uploadPath . $value[1]);
                }

                foreach ($this->filesName as $path) {
                    $thumbPath = $uploadPath . $value[1] . '/' . $path;
                    $finalPaths[] = $value[1] . '/' . $path;
                    $image = new ImageResize($uploadPath . $path);
                    $image->quality_jpg = 90;
                    if ($type == 'resize') $type = 'resize';
                    $image->$type($dimensions[0], $dimensions[1]);
                    $image->save($thumbPath);
                }
            }

            $defaultArray = $this->uploadedFilesPaths;
            if (count($finalPaths) != 0) {
                $this->uploadedFilesPaths = array_merge($defaultArray, $finalPaths);
            }
        }
    }

}
