<?php

namespace Amit\Files;

use Elibyy\TCPDF\Facades\TCPDF as PDF;
use \PhpOffice\PhpWord\IOFactory as IOF;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DocReader
 *
 * @author jooaziz
 */
class DocReader extends FileReader {

    private $docType = null;

    public function __construct(\Illuminate\Http\UploadedFile $file) {
        parent::__construct($file);
    }

    public function isOldDoc() {
        $this->docType = 'MsDoc';
        return $this;
    }

    public function getContent() {

        $this->content = $this->utf8Encouding($this->read('uploads/' . $this->uploadFiles()));
        dd($this->content);
        PDF::Write(0, $this->content);
        return $this->content;
    }

    private function read($file) {
        $sections = (is_null($this->docType)) ? IOF::load($file)->getSections() : IOF::load($file, $this->docType)->getSections();
        $res = '';
        foreach ($sections as $section) {
            foreach ($section->getElements() as $element) {
                $res .= $element->getTextRun();
                dd($element, $res);
            }
        }
        return $res;
    }

}
