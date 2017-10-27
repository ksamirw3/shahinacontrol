<?php

namespace Amit\Files;

use Elibyy\TCPDF\Facades\TCPDF as PDF;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FileReader
 *
 * @author jooaziz
 */
abstract class FileReader {

    protected $file;
    protected $content;
    protected $fileList;

    abstract public function getContent();

    public function __construct(\Illuminate\Http\UploadedFile $file) {
        $this->file = $file;
    }

    public function getFiles() {
        return $this->file;
    }

    protected function utf8Encouding($text) {
        return iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
    }

    protected function nr2br($text) {
        return nl2br($text);
    }

    protected function uploadFiles() {
        $u = new \Amit\Uploader\Upload($this->file);
        return $this->fileList = $u->start()->fileList();
    }

    public function getMimeType() {
        return strtolower($this->file->getMimeType());
    }

}
