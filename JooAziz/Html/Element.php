<?php
namespace JooAziz\Html;

use JooAziz\Html\Interfaces\IElement;

class Element implements IElement
{
    protected $startTage;
    protected $endTage;
    protected $text;

    protected function setTages($start, $end = '/>')
    {
        $this->startTage = $start;
        $this->endTage = $end;
        return $this;
    }

    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    public function getFullTag()
    {
        return $this->startTage . $this->text . $this->endTage;
    }
}