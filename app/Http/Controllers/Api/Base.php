<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Api;

/**
 * Description of Base
 *
 * @author PHP_Developer
 */
use JooAziz\Misc\Errors;
use JooAziz\Response\Response;

class Base extends \App\Http\Controllers\Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->scope = 'api';

//        if (request()->app_key != '3e990ab542678f436a24304c5d5367d6' && !request()->is('api')) {
//            return Response::make()
//                ->setMessage('missing or invalid app key')
//                ->setError(Errors::invalidValidation)
//                ->send();
//        }
    }

}
