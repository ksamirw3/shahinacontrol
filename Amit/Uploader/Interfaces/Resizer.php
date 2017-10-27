<?php

namespace Amit\Uploader\Interfaces;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author jooaziz
 */
interface Resizer {

    static function resiz($files, $sizes, $deleteOrginal = false);
}
