<?php

if (!function_exists('dual')) {

    /**
     *
     * @param object $object object that $filed is one of attrs;
     * @param string $field field name without language name
     * @return mixed
     */
    function dual($object, $field) {
        $language = (Session::get('language'))? : env('DEFAULT_LANGUAGE');
        $field_name = $field . "_" . $language;
        return $object->$field_name;
    }

}
if (!function_exists('field')) {

    /**
     *
     * @param mixed $field filed that would to return it with language;
     * @return string field name
     */
    function field($field) {
        $language = (Session::get('language'))? : env('DEFAULT_LANGUAGE');
        $field_name = $field . "_" . $language;
        return $field_name;
    }

}
if (!function_exists('__')) {

    /**
     *
     * @param type $id
     * @return type
     */
    function __($id = null) {
        if (is_null($id))
            return;

        $resultAfterTrans = trans($id);

        if ($resultAfterTrans == $id) {
            list($fileToInsert, $value) = explode('.', $id);
            return $value;
            $enVal = addKeyToEnFile($value, 'en', $fileToInsert);
            addKeyToEnFile($value, 'ar', $fileToInsert, $enVal);
        }
        return $resultAfterTrans;
    }

}

if (!function_exists('addKeyToEnFile')) {

    function addKeyToEnFile($value, $langDir, $fileToInsert, array $olderArray = []) {
        $newArra = [];

        $filePath = resource_path() . '/lang/' . $langDir . '/' . trim($fileToInsert) . '.php';
        $dataArray = include $filePath;
        if (is_array($dataArray)) {
            $newArra = $dataArray;
        }
//            dd($dataArray);
        $newArra[($value)] = ($value);

        File::put($filePath, arrayToFile(array_merge( $olderArray,array_unique($newArra))));
        return $newArra;
    }

}


if (!function_exists('arrayToFile')) {

    /**
     *
     * @param type $id
     * @return type
     */
    function arrayToFile(array $array = null) {
        $array = array_unique($array);
        $back = "<?php\n\nreturn [\n";
        foreach ($array as $key => $val) {
            $back.= "    '" . ($key) . "' => '" . ($val) . "',\n";
        }

        return $back . "];";
    }

}





if (!function_exists('ATS')) {

    /**
     *
     * @param array $arr array of key and value to convert to string
     * @return string
     */
    function ATS($arr) {
        $str = '<?php return [ ';
        foreach ($arr as $k => $v) {
            $str.='"' . $k . '"=>"' . $v . '",';
        }
        return $str . '];';
    }

}
if (!function_exists('SD')) {

    /**
     *
     * @param string $dir director path that would to be scand resusevly
     *
     * @return array of files pathes
     */
    function SD($dir) {
        return Amit\Files\Scaner::scanDirRecursive($dir);
    }

}
if (!function_exists('setActivityLog')) {

    function setActivityLog($action, $action_in, $description, $key) {
        $couch = new App\Models\Basement\CouchbaseBasement("log");
        $result = $couch->create("log::", array(
            "admin_id" => App\Libs\Adminauth::id(),
            "action" => $action,
            "action_in" => $action_in,
            "description" => $description,
            "key" => $key
        ));
        return (empty($result->error)) ? TRUE : FALSE;
        return true;
    }

}
if (!function_exists('deletModel')) {

    function deletModel($url, $val, $options = []) {
        $text = (@$options['text']) ? $options['text'] : '<i class="fa fa-trash-o"></i>';
        $conf = (@$options['confirm']) ? $options['confirm'] : __('admin.are you sure?');
        $ht = Form::open(['url' => $url, 'style' => 'display:inline;']);
        $ht.=Form::hidden('id', $val);
        $ht.='<button data-confirm="' . $conf . '" data-title="' . __("admin.Delete") . '" type="submit" class="btn btn-danger btn-xs cs_delete_btn has-confirmation-message">' . $text . '</button>';
        $ht.=Form::close();
        return $ht;
    }

}
if (!function_exists('commonTableActions')) {

    function commonTableActions($baseUrl, $id, $deletMessage = 'are you sure you want to delete this services') {
        $html = '<a class="btn btn-primary btn-xs" href="' . $baseUrl . '/edit/' . $id . '"  title="' . __(" admin.edit ") . '"><i class="fa fa-edit"></i></a>';
        $html .= deletModel($baseUrl . '/delete/', $id, ['confirm' => __('admin.' . $deletMessage)]);
        $html.= '<a class="btn btn-primary btn-xs" href="' . $baseUrl . '/view/' . $id . '" title="' . __(" admin.View ") . '"><i class="fa fa-eye"></i></a>';
        return $html;
    }

}
if (!function_exists('reDate')) {

    function reDate($timpstamp, $formate = "d-m-Y") {
        if (!$timpstamp)
            return null;
        return date($formate, $timpstamp);
    }

}
if (!function_exists('genderViewr')) {

    function genderViewr($g) {
        if (strtolower($g) == 'm') {
            return 'male';
        } elseif (strtolower($g) == 'f') {
            return 'female';
        } else {
            return 'other';
        }
    }

}
if (!function_exists('sendMail')) {

    function sendMail($view, $email, $subject = "", $arr = [], $name = "") {
        Mail::queue($view, $arr, function ($mail) use ($email, $name, $subject, $arr) {
            $mail->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));
            $mail->to($email, $name)->subject($subject);
        });
    }

}
if (!function_exists('gender')) {

    function gender($key = null) {
        $rt = ['o' => 'other', 'm' => 'male', 'f' => 'female'];
        if ($key)
            return $rt[$key];
        return $rt;
    }

}
if (!function_exists('age')) {

    function age($key = null) {
        $rt = config('constants.age');
        if ($key)
            return $rt[$key];
        return $rt;
    }

}

if (!function_exists('allCountry')) {

    function allCountry($key = null) {
        $rt = [ 'em' => 'Emirates'];
        if (!is_null($key))
            return $rt[$key];
        return $rt;
    }

}
if (!function_exists('Currency')) {

    function Currency() {
        return '$';
    }

}
if (!function_exists('daysName')) {
    $rt = [];

    function daysName($days) {
        foreach ($days as $d) {
            $rt[] = config('constants.weekend')[$d];
        }
        return (object) ['array' => $rt, 'string' => implode(' - ', $rt)];
    }

}
    