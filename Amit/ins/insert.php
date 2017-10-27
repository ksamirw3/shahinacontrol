<?php

namespace Amit\ins;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of insert
 *
 * @author jooAziz
 */
class insert {

    public static function mails() {
        set_time_limit(60 * 10);
        $f = json_decode(\File::get('inbox_mails.json'))->RECORDS;
        $time = date('Y-m-d H:i:s');
                        
                       
        $result = [];
        foreach ($f as $res) {
            $ord['id'] = $res->mail_id;
            $ord['client_id'] = $res->sender_id;
            $ord['driver_id'] = $res->reciever_id;
            $ord['status'] = $res->status;
            $ord['from_longitude'] = $res->from_longitude;
            $ord['id'] = $res->mail_id;
            $ord['from_latitude'] = $res->from_latitude;
            $ord['from_address'] = $res->from_address;
            $ord['to_longitude'] = $res->to_longitude;
            $ord['to_latitude'] = $res->to_latitude;
            $ord['to_address'] = $res->to_address;
            $ord['receiver_name'] = $res->recipient_user;
            $ord['receiver_phone'] = $res->recipient_tel;
            $ord['amount'] = $res->price_move;
            $ord['start_time'] = $res->date.' '.$res->time;
            $ord['end_time'] = '';
            $ord['driver_latitude'] ='';
            $ord['client_latitude'] ='';
            $ord['description'] = $res->msg;
            $ord['updated_at'] = $time;
            $ord['created_at'] = $time;
            $result[]= $ord;
        }
       $new =  array_chunk($result, 500);
       foreach ($new as $sp){
        \App\Models\Order::insert($sp);
           
       }
       dd($new);
    }

    public static function driver() {
        set_time_limit(60 * 10);
        $time = date('Y-m-d H:i:s');
        $pass = \Hash::make(123456789);
        $f = json_decode(\File::get('drivers.json'))->RECORDS;
//        dd($f);
        $result = [];
        $usersName = [];


        foreach ($f as $lop1) {
            $result[] = (array) $lop1;
        }
        \App\Models\Driver::insert($result);
    }

    public static function insert() {
        set_time_limit(60 * 10);
        $f = json_decode(\File::get('members.json'))->RECORDS;
//        dd($f);
        $n = [];
        $time = date('Y-m-d H:i:s');
        $pass = \Hash::make(123456789);
        foreach ($f as $r) {
//            dd($r);
            $user['id'] = $r->member_id;
            $user['username'] = $r->user_name;
            $user['email'] = $r->email;
            $user['password'] = $pass;
            $user['f_name'] = trim($r->f_name . ' ' . $r->l_name);
            $user['phone'] = $r->mobile;
            $user['latitude'] = $r->latitude;
            $user['longitude'] = $r->longitude;
            $user['image'] = $r->member_image;
            if (!($r->access_key)) {
                $user['token'] = $r->access_key;
                $user['token_type'] = 'google';
            }
            if (!($r->ios_token)) {
                $user['token'] = $r->access_key;
                $user['token_type'] = 'ios';
            }
            $user['token'] = '';
            $user['token_type'] = '';
            $user['active_token'] = null;
            $user['is_connect'] = 0;
            $user['active'] = 1;
            $user['is_busy'] = 0;
            $user['created_at'] = $time;
            $user['updated_at'] = $time;
            $n[] = $user;
        }
        \App\Models\User::insert($n);
//dd($n);
    }

}
