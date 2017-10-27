<?php

namespace JooAziz\Misc;

class Responce {

    public static function custom(array $result, $code = 200) {
       header('Content-type: application/json');
        http_response_code($code);
        echo json_encode($result);
        die;
    }

    public static function make($data, $result, $message = null, $error = null) {
        return ['result' => $result, 'message' => $message, 'data' => $data, 'error' => $error];
    }

}
