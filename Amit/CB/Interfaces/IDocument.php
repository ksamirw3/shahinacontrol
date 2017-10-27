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
interface IDocument {

    /**
     * pass array of attrs to this model
     * @param array $attrs
     */
    function create(array $attrs);

    /**
     * this only way to put Document in DB
     */
    function save();

    /**
     *  this static method is just alias to
     *      (new Document)->create();
     *  note :
     *          it will save attrs passes if it found
     *          or it will get data from Request Class
     *          in addiatianl
     *              - it will hash password if it found it
     *              - it will upload file if it found it
     *              - it will delete _confirmation if it found it
     *
     * @param array $attrs
     */
    static function quickSave(array $attrs);

    /**
     * update an modell in DB
     */
    function update();

    /**
     *  this static method is just alias to
     *      (new Document)->update();
     *  note :
     *          it will save attrs passes if it found
     *          or it will get data from Request Class
     *          in addiatianl
     *              - it will hash password if it found it
     *              - it will upload file if it found it
     *              - it will delete _confirmation if it found it
     *
     * @param array $attrs
     */
    static function quickUpdate(array $attrs = []);

    /*
     *  it will add attr [deleted_at=>time()] to model attrs
     *  and use save method to save it to data base
     */

    function delete();

    /**
     *  it will add attr [deleted_at=>time()] to model attrs
     *  and use save method to save it to data base
     *  pass id to delete it
     *
     * @param type $id
     */
    static function quickDelete($id);

    /**
     *  it will remove document fro m databse
     *
     */
    function destroy();

    /**
     *  it will remove document fro m databse
     *
     * @param type $id
     */
    static function quickDestroy($id);

    /**
     * find an document based on it`s id
     * @param type $id
     */
    function find($id);

    /**
     * find an document based on it`s id
     * but it will return abort(404) if it faild to found document
     *
     * @param type $id
     */
    function findOrFail($id);

    static function quickFindOrFail($id);

    public static function inView($view);

    public static function all($rows = null);
}
