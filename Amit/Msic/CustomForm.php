<?php

namespace Amit\Msic;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use Form;
use Render;

class CustomForm {

    public static $showLable = true;
    public static $showError = true;
    public static $lable = null;
    public static $insertBefore = null;
    public static $insertAfter = null;
    public static $inputClass = [];

    public static function input($input, $row, $errors) {

    }

    public static function email($input, $row, $errors) {
        return self::genrator('email', $row, $input, $errors);
    }

    public static function select($input, $row, $errors, $data) {
        return self::genrator('select', $row, $input, $errors, $data);
    }

    public static function checkBox($input, $row, $errors, $data) {
        return self::genrator('checkbox', $row, $input, $errors, $data);
    }

    public static function radioButton($input, $row, $errors) {

    }

    public static function number($input, $row, $errors) {
        return self::genrator('number', $row, $input, $errors);
    }

    public static function website($input, $row, $errors) {
        return self::genrator('website', $row, $input, $errors);
    }

    public static function image($input, $row, $errors) {
        self::$insertAfter = Render::image(@$row->$input, 'uploads/');
        return self::genrator('image', $row, $input, $errors);
    }

    public static function text($input, $row, $errors) {
        return self::genrator('text', $row, $input, $errors);
    }

    public static function date($input, $row, $errors) {
        return self::genrator('date', $row, $input, $errors);
    }

    public static function textArea($input, $row, $errors) {
        return self::genrator('textArea', $row, $input, $errors);
    }

    public static function password($input, $row, $errors) {
        return self::genrator('password', $row, $input, $errors);
    }

    private static function genrator($type, $row, $input, $errors, $data = []) {

        $errorClass = '';
        if (self::$showError) {
            $errorClass = $errors->has($input) ? 'has-error' : '';
        }

        $html = '<div class="form-group ' . $errorClass . '">';
        $html .= self::makeLable($input);
        $html .= '<div class = "col-lg-12">';
        $html .= self::$insertBefore;
        $html .= self::makeInput($type, $row, $input, $data);
        $html .= self::$insertAfter;
        $html.=self::makeErrorDiv($errors, $input);
        $html.= '</div></div>';
        self::resetDefault();
        return $html;
    }

    private static function resetDefault() {
        self::$showLable = true;
        self::$showError = true;
        self::$lable = null;
        self::$insertBefore = null;
        self::$insertAfter = null;
        self::$inputClass = [];
    }

    private static function makeLable($input) {
        if (self::$showLable) {
            if (is_null(self::$lable)) {
                return Form::rawLabel($input,
                        __('admin.' . ucfirst($input) . "<em class='red'>*</em>"),
                        ['class' => 'col-md-2 control-label']);
            }
            else {
                return self::$lable;
            }
        }
    }

    private static function makeInput($type, $row, $input, $data) {
        switch ($type) {
            case 'checkbox':
                $i = Form::checkbox($input, $data, @$row->$input);
                break;
            case 'text':
                $i = Form::text($input, @$row->$input, self::makeInputArrt());
                break;
            case 'email':
                $i = Form::email($input, @$row->$input, self::makeInputArrt());
                break;
            case 'image':
                $i = Form::file($input, self::makeInputArrt());
                break;
            case 'number':
                $i = Form::number($input, @$row->$input, self::makeInputArrt());
                break;
            case 'select':
                $i = Form::select($input, $data, @$row->$input,
                        self::makeInputArrt());
                break;
            case 'date':
                $i = Form::date($input, @$row->$input, self::makeInputArrt());
                break;
            case 'textArea':
                $i = Form::textArea($input, @$row->$input, self::makeInputArrt());
                break;
            case 'website':
                $i = Form::input('url', $input, @$row->$input,
                        self::makeInputArrt());
                break;
            case 'password':
                $i = Form::password($input, self::makeInputArrt());
                break;
        }
        return $i;
    }

    private static function makeInputArrt() {
        return array_merge(['class' => 'form-control '], self::$inputClass);
    }

    private static function makeErrorDiv($errors, $input) {
        if (!self::$showError) return null;
        $h = '';
        foreach ($errors->get($input) as $message):
            $h .='<span class = "help-inline text-danger">' . $message . '</span>';
        endforeach;
        return $h;
    }
}