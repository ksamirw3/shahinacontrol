<?php

namespace Amit\CB\Interfaces;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author jooaziz
 */
interface IViewResultModifire {

    function lists($filed = 'name', $id = null, $singleArray = FALSE);

    function get();

    function getIds();

//
    function getKeys();

//
    function getDocs();

//
    function getValues();

//
    function first();

    function orderBy($order = 'created_at');
}
