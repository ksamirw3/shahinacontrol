<?php

namespace App\Http\Controllers\Api\Driver\Transactions;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Transactions
 *
 * @author Mahmoud Ali
 */
use App\Http\Helper\Shared\TransactionHelper;
use App\Models\Transaction as Model;
use App\Http\Controllers\Api\Driver\Transactions\Validator as Checker;
use JooAziz\Response\Response;

class Transactions extends \App\Http\Controllers\Api\Base
{

    public function anyProfit(Checker $d)
    {
        return Response::make()
            ->setData(TransactionHelper::TransactionToCalculation(request()->driver_id, request()->from_date, request()->to_date))
            ->setResult(TRUE)
            ->send();
    }

    public function anyInvoice()
    {

        $validator = \Illuminate\Support\Facades\Validator::make(request()->toArray(), [
            "order_id" => ['required', "numeric", "exists:orders,id"],
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => 400,
                "msg" => "data not founded",
                "errors" => $validator->errors()->all()
            ]);
        }
        $resultData = ["totalFee" => "0", "type" => "cash", "promotion" => "0", "ourProfit" => "0", "yourProfit" => "0"];


        $orderObject = \App\Models\Order::find(request()->order_id);

        $resultData['totalFee'] = (string)$orderObject->amount;

        $clientPromotionValue = \App\Models\Wallet::whereClientId($orderObject->client_id)->sum('amount');
        if ($clientPromotionValue > 0) {
            \App\Models\Wallet::quickSave([
                    'code' => "",
                    'description' => "Discount for trip id : " . request()->order_id,
                    'client_id' => $orderObject->client_id,
                    'amount' => (min($orderObject->amount, $clientPromotionValue)) * (-1)
                ]
            );
        }

        $resultData['promotion'] = (string)$clientPromotionValue;

        $profits = new Amount($orderObject->amount);

        $resultData['ourProfit'] = (string)$profits->getAdminProfit();
        $yourProfit = $profits->getDriverProfit() - $clientPromotionValue;
        $resultData['yourProfit'] = (string)(($yourProfit >= 0) ? $yourProfit : '0');

//dd($amount);
        return Response::make()->setResult(true)->setData($resultData)->send();
    }

}
