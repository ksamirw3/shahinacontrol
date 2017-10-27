<?php

namespace Amit\Files;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImgReader
 *
 * @author jooaziz
 */
class ImgReader extends FileReader {

    public function getContent() {
        $this->content = 'uploads/' . $this->uploadFiles($this->file);

        PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);
        PDF::Image($this->content, '', '', '', '', '', '', '', false, 300, '', false, false, 0, false, false, true);
        return $this->content;
    }

}
