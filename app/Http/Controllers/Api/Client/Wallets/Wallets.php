<?php

namespace App\Http\Controllers\Api\Client\Wallets;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use App\Models\User as Model;
use JooAziz\Response\Response;
use App\Http\Controllers\Api\Base;
use App\Http\Controllers\Api\Client\Wallets\Validator as Checker;
use Carbon\Carbon;
use App\Models\Wallet;

class Wallets extends Base {

    public function anyAddCredit(Checker $c) {

        self::checkIfCodeUsedBefor(request()->user_id, request()->promotion);

        $promotionObj = self::getPromotionObj(request()->promotion);

        // if true add to walte
        if (!$promotionObj->isExpired()) {

            self::insertInWalletTabel($promotionObj, request()->user_id);

            return Response::make()->setResult(TRUE)->setError('')->setMessage('promotion is added successfully')->send();
        } else {
            return Response::make()->setResult(false)->setError('WRONG_PROMOTION')->setMessage('promotion code is expired')->send();
        }
    }

    public static function insertInWalletTabel(\App\Models\Promotion $promotionObj, $userId) {
        Wallet::quickSave([ 'code' => $promotionObj->code, 'description' => "promtion code added", 'client_id' => $userId, 'amount' => $promotionObj->amount]
        );
    }

    /**
     * 
     * @param type $promotionCode
     * @return \App\Models\Promotion;
     */
    private static function getPromotionObj($promotionCode) {
        $promotionObj = \App\Models\Promotion::whereCode($promotionCode)->first();
        if (!$promotionObj)
            return Response::make()->setResult(false)->setError('PROMOTION_CODE_NOT_VALID')->setMessage('promotion code not valid')->send();
        return $promotionObj;
    }

    /**
     * 
     * @param string $userId
     * @param string $promotionCode
     * @return type
     */
    private static function checkIfCodeUsedBefor($userId, $promotionCode) {
        $samePromotionToClientCount = Wallet::whereClientId($userId)->whereCode($promotionCode)->count();
        if ($samePromotionToClientCount > 0)
            return Response::make()->setResult(false)->setError('PROMOTION_CODE_USED_BEFOR')->setMessage('promotion code used befor')->send();
        return null;
    }

}
