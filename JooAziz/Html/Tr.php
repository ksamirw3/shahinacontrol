<?php

namespace JooAziz\Html;

class Tr extends Element
{
    public static function text($text){
        return (new static)->setTages('<tr>','</tr>');
    }
}