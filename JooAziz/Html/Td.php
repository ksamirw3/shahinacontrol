<?php

namespace JooAziz\Html;

class Td extends Element
{
    public static function text($text){
        return (new static)->setTages('<td>','</td>')->setText($text);
    }
}