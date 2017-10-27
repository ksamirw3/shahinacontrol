<?php

namespace Amit\Files;

use Elibyy\TCPDF\Facades\TCPDF as PDF;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PDFWriter
 *
 * @author jooaziz
 */
class PDFWriter {

    private $outputName;
    private $file;
    private $root = '/uploads/';
    private $fileName;
    private $rtl = true;
    private $langParms = [
        'a_meta_charset' => 'UTF-8',
//        'a_meta_dir' => 'rtl',
        'a_meta_language' => 'ar',
        'w_page' => 'page'
    ];

    public function __construct(FileReader $file, $name = null) {
        $this->fileName = ($name == NULL) ? time() . '.pdf' : $name . '.pdf';
        $this->outputName = $this->root . $this->fileName;
        $this->file = $file;
    }

    public function setRootPath($path) {
        $this->root = $path;
        $this->outputName = $this->root . $this->fileName;
    }

    public function setRtl($rtl = true) {
        $this->rtl = $rtl;
        return $this;
    }

    public function arabicText() {
        PDF::setLanguageArray($this->langParms);
        PDF::setRTL($this->rtl);
        PDF::SetFont('dejavusans', '', 11);
        return $this;
    }

    public function genrate() {

        PDF::AddPage();
        $this->file->getContent();

        return $this;
    }

    public function save() {
        PDF::Output(base_path() . $this->outputName, 'F');
        return $this->fileName;
    }

    public function openInBrawser() {
        return PDF::Output($this->outputName);
    }

}
