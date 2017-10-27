<?php

namespace App\Libs\PushNotification\Google;

class Gcm {

    public static function send($deviceTokens = [], $data, $badge = 0) {
        // Set POST variables
        $url = 'https://android.googleapis.com/gcm/send';
        $fields = [
            'registration_ids' => (is_array($deviceTokens)) ? $deviceTokens : [ $deviceTokens],
            'data' => $data
        ];
        $headers = [
            'Authorization: key=AIzaSyCcWYo-DR8vGm-uxehACptj8B7J0Uy6IOA',
            'Content-Type: application/json'
        ];
        // Open connection
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        // Execute post
        $result = curl_exec($ch);
        if ($result === false) {
            throw new \Exception(curl_error($ch));
        }
        return $result;
    }
}