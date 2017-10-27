<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Amit\Msic;

/**
 * Description of PopupModal
 *
 * @author jooaziz
 */
class PopupModal {

    public static function genrate($innerHtml) {
        $name = 'mod' . str_random(12);
        return '<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#' . $name . '">'
                . 'Open Modal'
                . '</button>'
                . '<div id="' . $name . '" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" style="width: 70%">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">

' . $innerHtml . '
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>';
    }

}
