<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Amit\Notification\Elements;

class Modale extends Element {

    protected $body;

    public function render(Button $triger, $body) {
        $this->setBody($body);
        $this->setDataTarget($triger->getTarget());
        return $this->genrateHtml();
    }

    public function setBody($body) {
        $this->body = $body;
    }

    public function getBody() {
        return $this->body;
    }

    public function closebutton() {
        '<button type = "button" class = "btn btn-primary" data-dismiss = "modal">&times;</button>';
    }

    public function title() {
        '<h4 class = "modal-title"> {{__("admin.Send Push Notification")}}</h4></button>';
    }

    private function genrateHtml() {
        $rt = '';
        $rt .= '<div id = "' . $this->getTarget() . '" class = "modal fade" role = "dialog">';
        $rt .= '<div class = "modal-dialog">';
        $rt .= '<div class = "modal-content">';
        $rt .= '<form>';
        $rt .= '<div class = "modal-header">';
        $rt .= $this->CloseButton();
        $rt .= $this->title();
        $rt .= '</div>';
        $rt .= '<div class = "modal-body">';
        $rt .= $this->getBody();
        $rt .= '</div>';
        $rt .= '<div class = "modal-footer">';
        $rt .= send();
        $rt .= '</div>';
        $rt .= '</form>';
        $rt .= '</div>';
        $rt .= '</div>';
        $rt .= '</div>';
        return $rt;
    }

}
