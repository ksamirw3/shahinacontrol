<?php

namespace JooAziz\Html;


class Tabel extends Element
{

    public function addTage($tag)
    {
        $this->text .= $tag;
        return $this;
    }



    public function addTd($text)
    {
        $this->text .= Td::text($text);
        return $this;
    }


}