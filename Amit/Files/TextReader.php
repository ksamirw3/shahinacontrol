<?php

namespace Amit\Files;

use Elibyy\TCPDF\Facades\TCPDF as PDF;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TextReader
 *
 * @author jooaziz
 */
class TextReader extends FileReader {

    public function getContent() {
        $this->content = $this->utf8Encouding(file_get_contents('uploads/' . $this->uploadFiles($this->file)));
        PDF::Write(0, $this->content);
        return $this->content;
    }

}
