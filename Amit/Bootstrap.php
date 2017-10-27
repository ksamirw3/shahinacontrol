<?php

namespace Amit;
use Amit\Msic\Lang;
use Amit\Validation\Validator;

/**
 *  Bootstrap class
 *
 * init for whoal amit lib
 */
class Bootstrap {

    /**
     *
     */
    public static function init() {
        /*
         * init for lang class
         */
        Lang::init();
        /**
         * init for validation class
         */
        Validator::init();
    }

}
