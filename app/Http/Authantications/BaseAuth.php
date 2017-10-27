<?php

namespace App\Http\Authantications;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Amit\Msic\Route as AR;

class BaseAuth {

    /**
     * $identity   = var name in the session for this role
     * it muse be defiend in inherted classes
     * @var string $identity
     */
    protected static $identity;
    protected static $permissions = 'permissions';

    /**
     * $scope = represent to prefix name in domail URL
     *      ex : (provider,admin,publisher)
     * and also represent to folder thant content views for this domain
     * @var string $scope
     */
    public static $scope;

    /**
     *
     * update this user data in seesion
     *
     * @param type $row
     * @return object
     */
    public static function update_user($row) {
//        dd($row->rule->permissionsGroups);
        Session::put(static::appKey() . static::$identity, $row);
       // self::setPermissions($row->rule->permissionsGroups);
        return $row;
    }

    /**
     *  retrive user data from seesion if existe or return null if not
     * @return type
     */
    public static function user() {

        if (Session::has(static::appKey() . static::$identity)) {
            return Session::get(static::appKey() . static::$identity);
        }
        return null;
    }

    /**
     * retrive id for this user if user data founded or null if not founded
     * @return type
     */
    public static function id() {
        if (Session::has(static::appKey() . static::$identity)) {
            return @Session::get(static::appKey() . static::$identity)->id;
        }
        return null;
    }

    /**
     * check if current user is guest or not
     * @return boolean
     */
    public static function guest() {
        if (!Session::has(static::appKey() . static::$identity))
            return true;
        else
            return false;
    }

    /**
     *  reove current data for current user from session
     * @return boolean
     */
    public static function logout() {
        Session::forget(static::appKey() . static::$identity);
        Session::forget(static::appKey() . static::$permissions);
        return true;
    }

    /**
     * retrive app key fron .env file
     * @return type
     */
    private static function appKey() {
        return env('APP_KEY');
    }

    /**
     * check user authantication
     *      if he allawed method will return true
     *      if not it authomaticly redirect to login page for this scope
     * @return type
     */
    public static function authanticationRequired() {
        if (static::guest()) {
            if (request()->ajax()) {
                return response('Unauthorized.', 401)->send();
            } else {
                return redirect(static::scope() . '/auth/login')->send();
            }
        }

        if (!self::isAllawed())
            return redirect('/permission-denied')->send();


        return TRUE;
    }

    public static function isAllawed() {
        return true;
//        dd(\Amit\Msic\Route::getActionName(), \Amit\Msic\Route::getController());
        dd(self::getPermissions());
    }

    /**
     * this method check if user is authanticated and stop him to access to
     * login page or register
     * @param type $except
     * @return boolean
     */
    public static function authanticationNotRequired($except = []) {
        if (in_array(AR::getActionName(), $except))
            return true;
        if (static::user()) {
            return redirect(static::scope() . '/')->send();
        }
    }

    /**
     * retrive scop name
     * @return type
     */
    public static function scope() {
        return AR::getPrefix();
    }

    public static function can($action, $model) {
        return true;
        if (@self::user()->rule->super_admin == 1)
            return true;
        $permissions = self::getPermissions();
        foreach ($permissions as $per)
            if ($per->permissions->action == $action && $per->permissions->model == $model && $per->active == 1)
                return true;
        return false;
    }

    public static function cant($action, $model) {
        return !(self::can($action, $model));
    }

    public static function setPermissions($data) {
        Session::put(static::appKey() . static::$permissions, $data);
    }

    public static function getPermissions() {
        if (Session::has(static::appKey() . static::$permissions))
            return Session::get(static::appKey() . static::$permissions);

        return [];
    }

}
