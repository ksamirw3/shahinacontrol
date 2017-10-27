<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use League\Flysystem\Filesystem;
use Form;
use \Amit\Msic\Lang as AL;

class Controller extends BaseController {

    use AuthorizesRequests,
        AuthorizesResources,
        DispatchesJobs,
        ValidatesRequests;

    protected $scope;
    protected $module;
    protected $model;

    public function __construct() {
        /**
         * init for amit lib
         */
        \Amit\Bootstrap::init();
        $this->makeRawLabel();
        $this->setModuleName();
        $this->scope = \Amit\Msic\Route::getPrefix();
    }

    private function setModuleName() {
        $this->module = self::makeUrlParts()->controller;
    }

    protected function viewPerfix($view) {
        $route = self::makeUrlParts();
        return $route->prefix . '.' . $route->controller . '.' . $view;
    }

    protected function response($data, $status = 'ok', $code = 200, $errors = null) {
        return response()->json(['status' => $status, 'code' => $code, 'errors' => $errors,
                    'result' => $data]);
    }

    public function makeRawLabel() {

        Form::macro('rawLabel', function($name, $value = null, $options = array()) {
            $label = Form::label($name, '%s', $options);
            return sprintf($label, $value);
        });
    }

    protected static function view($data = []) {

        $route = self::makeUrlParts();

        $data['module'] = $route->controller;
        $data['scope'] = ($route->prefix=="")?"Front":$route->prefix;
//        dd( $data['scope'] );
//dd($route->prefix . '.' . $route->controller . '.' . $route->action);
        return view($data['scope']. '.' . $route->controller . '.' . $route->action, $data);
    }

    private static function makeUrlParts() {
        /*
         * get prefix
         */
        $prefix = str_replace('/', '', \Request::route()->getPrefix());
        $actionParts = explode('@', strtolower(\Request::route()->getAction()['controller']));


        $controllerParts = explode('\\', $actionParts[0]);
        $controller = end($controllerParts);

        /*
         * get action name
         */

        $action = \Amit\Support\Str::replaceFirst('get', '', $actionParts[1]); // remove get prefix
        $action = \Amit\Support\Str::replaceFirst('post', '', $action); // remove post prefix
        $action = \Amit\Support\Str::replaceFirst('any', '', $action); // remove any prefix


        return (object) compact('prefix', 'controller', 'action');
    }

    public static function redirectToIndex() {
        $route = self::makeUrlParts();
        return redirect($route->prefix . '/' . $route->controller)->send();
    }

}
