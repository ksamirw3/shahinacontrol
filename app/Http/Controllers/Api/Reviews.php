<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Base;
use Mail;

/**
 * Description of Comments
 *
 * @author PHP_Developer
 */
class Reviews extends Base {

    public $model;
    public $module;
    public $rules;

    public function __construct(\App\Models\Couch\Review $model) {
        parent::__construct();
        $this->module = 'reviews';
        $this->model = $model;
    }

    private function checkExistDocument($item_id) {
        $doc = $this->model->find($item_id);
        if (is_null($doc)) {
            $item = $this->model->findByItemID($item_id);
            $this->model->create(
                    ['service_id' => $item_id, 'reviews' => []]
                    , $item_id);
            \App\Models\Elquent\Review::create(['service_id' => $item_id, 'provider_id' => $item->provider_id,
                'category_id' => $item->category_id]);
            $doc = $this->model->find($item_id);
        }

        return $doc;
    }

    private function sendReview($item_id, $user_id, $request) {
        /*
         * get service data
         */
        $service = new \App\Models\Couch\Service();
        $service_data = (array) $service->find($item_id);
        /*
         * get user Data
         */
        $user = new \App\Models\Couch\User();
        $user_data = (object) $user->find($user_id);
        /*
         * get provider data
         */
        $provider = new \App\Models\Couch\Provider();
        $provider_data = (object) $provider->find($service_data["provider_id"]);

        $postedData = $request->all();
        $postedData["email"] = $user_data->email;
        $postedData["username"] = $user_data->username;
        $postedData["item_title"] = $service_data["title_en"];

        Mail::queue('emails.services.comment', ['row' => $postedData], function ($mail) use ( $provider_data, $user_data) {
            $mail->from(env('MAIL_FROM_EMAIL'), env('MAIL_FROM_NAME'));
            $mail->to($provider_data->email, $provider_data->name)
                    ->replyTo($user_data->email, $user_data->username)
                    ->subject(__("account.You have a new comment", ['attr' => env('SITE_NAME')]));
        });
    }

    public function postIndex(\Illuminate\Http\Request $request) {
        /*
         * check user token
         */
        $user = $this->getUserIdByToken();
        $user_id = $user->id;
        if (is_null($user_id)) {
            $message = __('Api.Unauthorized user.');
            return response()->json(['message' => $message], 401);
        }
        /*
         * vslidate other data
         */
        $validation = \Validator::make($request->all(), [
                    'service_id' => 'required',
                    'review' => 'required',
                    'rate' => 'required',
                    'title' => 'required',
        ]);
        if ($validation->fails()) {
            return response()->json(['message' => $validation->errors(), 'code' => '2100'], 403);
        }
        $provider_id = @(new \App\Models\Couch\Service)->find(request()->get('service_id'))->provider_id;
        if (is_null($provider_id)) return response()->json(['message' => 'missing provider id', 'code' => '2100'], 403);
//        dd($request->all(), $provider);
        $foundUser = FALSE;
        $newRate = true;
        $oldRate = 0;
        $item_id = request()->get('service_id');
        $doc = (array) $this->checkExistDocument($item_id);



        if (count(@$doc['reviews']) > 0) {

            $key = array_search($user_id, array_column(json_decode(json_encode($doc["reviews"]), true), "user_id"));
            if ($key === FALSE) {
                $doc['reviews'][] = [
                    'review' => request()->get('review'),
                    'rate' => request()->get('rate'),
                    'title' => request()->get('title'),
                    'user_id' => $user_id,
                    'username' => $user->username,
                    'date' => time()
                ];
            } else {
                $oldRate = $doc['reviews'][$key]->rate;
                $doc['reviews'][$key] = [
                    'review' => request()->get('review'),
                    'rate' => request()->get('rate'),
                    'title' => request()->get('title'),
                    'user_id' => $user_id,
                    'username' => $user->username,
                    'date' => time()
                ];
                $foundUser = true;
                $newRate = false;
            }
        } else {
            $doc['reviews'][] = [
                'review' => request()->get('review'),
                'rate' => request()->get('rate'),
                'title' => request()->get('title'),
                'user_id' => $user_id,
                'username' => $user->username,
                'date' => time()
            ];
        }
        /*
         * update provider rate by job
         */
//        $job = new \App\Jobs\Rates($item_id, request()->get('rate'), $oldRate);
//        $this->dispatch($job);

        /*
         * update provider rate by function
         */
        $this->updateItemRate($item_id, request()->get('rate'), $oldRate, $newRate);
        $this->updateProviderRate($item_id);


        if ($this->model->update($item_id, (array) $doc)) {
            $code = 200;
            $message = ['message' => __('Api.thanks for your review.'), 'code' => 200];
        } else {
            $code = 403;
            $message = ['message' => __('Api.unknown error.'), 'code' => 5000];
        }

        $this->sendReview($item_id, $user_id, $request);
        /*
         * add to comments sql table
         */
        $comment = \App\Models\Elquent\Comment::firstOrNew([
                    'service_id' => $item_id,
                    'user_id' => $user_id
        ]);
        $comment->provider_id = $provider_id;
        $comment->review = $request->get('review');
        $comment->title = $request->get('title');
        $comment->save();
        return response()->json($message, $code);
    }

    public function getUserIdByToken() {
        $user = new \App\Models\Couch\User();
        $user = array_values($user->getByToken(request()->get('token')));
        if (!@$user[0]) return null;
        return @$user[0];
    }

    /**
     *
     * update service item review
     *
     *
     * @param type $itemId
     * @param type $rate
     * @param type $oldRate
     * @param type $newRate
     * @return type
     */
    public function updateItemRate($itemId, $rate, $oldRate, $newRate) {
        $data = (array) $this->model->findByItemID($itemId);
        if (empty($data["num_of_rate"])) {
            $data["num_of_rate"] = 0;
        }
        if (empty($data["total_rate"])) {
            $data["total_rate"] = 0;
        }
        if ($newRate) {
            $data["num_of_rate"] = (int) $data["num_of_rate"] + 1;
            $data["total_rate"] = (float) $data["total_rate"] + $rate;
        } else {
            $data["total_rate"] = (float) $data["total_rate"] + $rate - $oldRate;
        }

        $data['rate'] = (float) $data["total_rate"] / $data["num_of_rate"];
        if (!empty(\App\Models\Elquent\Review::where('service_id', $itemId)->get()->toArray())) {
            \App\Models\Elquent\Review::where('service_id', $itemId)->update([
                "rate" => $data["rate"],
                "total_rate" => $data["total_rate"],
                "num_of_rate" => $data["num_of_rate"],
            ]);
        } else {
            \App\Models\Elquent\Review::create([
                "service_id" => $data['id'],
                "provider_id" => $data["provider_id"],
                "category_id" => $data["category_id"],
                "rate" => $data["rate"],
                "total_rate" => $data["total_rate"],
                "num_of_rate" => $data["num_of_rate"],
            ]);
        }

        $this->model->updateItemDoc($itemId, $data);
        return TRUE;
    }

    /**
     *
     * update provider rating depend on his services
     *
     * @param type $service_id
     * @return boolean
     */
    public function updateProviderRate($service_id) {
        $provider = new \App\Models\Couch\Provider();

        $data = \DB::table("reviews")->select('provider_id', \DB::raw('SUM(rate) /COUNT(rate) as rate'))->where('service_id', $service_id)->groupBy('provider_id')->get();

        foreach ($data as $value) {
            $provider->update($value->provider_id, ["provider_rate" => $value->rate]);
        }
        return true;
    }

}
