<?php

namespace Amit\Msic;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use File;

/**
 *  class render media use too reander html media in views
 */
class RenderMedia {

    /**
     * use to render image html in view
     *
     *
     *
     * @param string $name  just file name with  extintion
     * @param string $path path where file located based on root dir
     * @param array $options html options pass as array
     * @return string | null
     */
    public static function image($name, $path = 'uploads/',
        $options = ['class' => 'cropped_preview']) {
        /*
         * return null  if file name is null or is not string
         */
        if (!$name) return null;
        /*
         * check if file exists
         */
        if (gettype($name) == "string" && (File::exists($path . $name) || \Storage::disk(env('UPLOAD_STORAGE'))->exists($path . $name))) {
            /*
             * retur html img tag with possible options base on what passed in @param $options
             */
            return '<img ' . self::optionsBuilder($options) . ' src="' . env('IMAGE_BASE_URL') . $name . '" >';
        }
        elseif (gettype($name) == "array") {
            $imageDisplay = "";
            foreach ($name as $key => $image) {
                if (!empty($options["noOfDispalying"]) && $key == $options["noOfDispalying"]) {
                    break;
                }
                if (File::exists($path . $image) || \Storage::disk(env('UPLOAD_STORAGE'))->exists($path . $image)) {
                    $imageDisplay.='<img ' . self::optionsBuilder($options) . ' src="' . env('IMAGE_BASE_URL') . $image . '" >';
                }
            }
            if ($imageDisplay != "") {
                return $imageDisplay;
            }
        }
        return null;
    }

    public static function ml_image() {

    }

    public static function pdf() {

    }

    public static function youtube() {

    }

    public static function viemeo() {

    }

    /**
     *
     * this is privet method
     * this method help in option biluder
     *
     * @param array $arr
     * @return string
     */
    private static function optionsBuilder(array $arr) {

        /*
         * return empty string if $arr is empty
         */
        if (empty($arr)) return '';
        /*
         * loop in $arr and assign
         */
        foreach ((array) $arr as $key => $value) {
            /*
             * create string phrase from array
             */
            $element = self::attributeElement($key, $value);
            /*
             * check if pharse is not null assigne it to html array
             */
            if (!is_null($element)) {
                $html[] = $element;
            }
        }
        /*
         * impolde html var to string and return it
         */
        return count($html) > 0 ? ' ' . implode(' ', $html) : '';
    }

    private static function attributeElement($key, $value) {
        if (is_numeric($key)) {
            $key = $value;
        }

        if (!is_null($value)) {
            return $key . '="' . e($value) . '"';
        }
    }
}
/*

   public static function viewValue($value, $type) {
        $suffix = "";
        if (@$value) {
            if ($type == "image") {
                if (File::exists("uploads/small/" . $value)) {
                    $suffix.='<img class="cropped_preview" src="uploads/small/' . $value . '" width="70">';
                }
            }
            elseif ($type == "more_images") {
                if (File::exists("uploads/small/" . $value)) {
                    $suffix.='<li class="col-lg-2 col-md-3 col-sm-4 col-xs-6">';
                    $suffix.='<div class="thumbnail">';
                    $suffix.='<img class="cropped_preview" src="uploads/100x100/' . $value . '"><br>';
                    $suffix.='<p><a class="btn btn-danger" href="admin/images/delete/' . $value . '" data-confirm="Are you sure you want to delete this image?" data-title="Confirmation message">
                                              <i class="fa fa-trash-o"></i> Delete</a></p>';
                    $suffix.='</div>';
                    $suffix.='</li>';
                }
            }
            elseif ($type == "file") {
                if (File::exists("uploads/" . $value)) {
                    //$suffix.='<img class="cropped_preview" src="'.URL::base()."/uploads/50x50/".$value.'">';
                    $suffix.=$value . ' <a href="uploads/' . $value . '" target="__blank" class="btn btn-success">' . __("admin.download") . '</a>';
                }
            }
            elseif ($type = "youtube") {
                $value = Misc::youtube_id($value);
                $suffix = '<iframe width="150" height="113" src="http://www.youtube.com/embed/' . $value . '?rel=0;showinfo=0;controls=0" frameborder="0" allowfullscreen></iframe>';
            }
            elseif ($type = "vimeo") {
                $value = Misc::vimeo_id($value);
                $suffix = '<iframe src="http://player.vimeo.com/video/' . $value . '?byline=0&portrait=0" width="150" height="113" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
            }
        }
        return $suffix;
    }
 *
 *
 *
 */