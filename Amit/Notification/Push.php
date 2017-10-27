<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Amit\Notification;

/**
 * Description of Push
 *
 * @author jooaziz
 */
class Push {

    private static $token = 'AIzaSyCfbCWSe2jir7iY7aNKWeOX8C_hMzUlxMM';

    /**
     * 
     * @param type $newToken string
     * 
     * @return null
     */
    public static function changeToken($newToken) {
        self::$token = $newToken;
    }

    /**
     * 
     * @return string
     */
    public static function getToken() {
        return self::$token;
    }

    /**
     * 
     * @param string|array $target
     * @param array $data
     * @return string
     */
    public static function FCM($target, $data) {
        $fields = [];
        $fields['data'] = $data;
        (is_array($target)) ? $fields['registration_ids'] = $target : $fields['to'] = $target;
        $headers = ['Content-Type:application/json', 'Authorization:key=' . self::$token];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }

}
