<?php

/*
 * 200 :success
 * 401: unauthorized
 * 404: page not found
 * 403: validation error
 * 400: bad request
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Base;
use Illuminate\Http\Request;
use Config;
use Redirect;
use Session;
use Validator;
use App\Models\Basement\CouchbaseBasement;
use Misc;
use App\Libs\Adminauth;

class Users extends Base {

    public $user;
    public $user_id;
    public $module;
    public $rules;

    public function __construct(\App\Models\User $user) {
        parent::__construct();
        $this->module = 'users';
        $this->user = $user;
    }

//*** name, email, gender, birthdate, telephone, country, city, main_image ***//
    public function postProfile(Request $request) {
        /*
         * check user access token
         */
        $user = array_values($this->user->getByToken($request->input('token')));
        if (!@$user[0]) return response()->json(['message' => __('Api.Unauthorized user.')], 401);
        $user = @$user[0];

        $validator = Validator::make($request->all(), [

                    'email' => 'required|email',
                    'name' => 'required',
                    'gender' => 'required',
//                'birthdate' => 'required',
                    'phone' => 'digits_between:4,12',
        ]);

        if ($validator->fails()) return response()->json(['message' => $validator->errors(), 'code' => '2100'], 403);


        /*
         * check unique email
         */
        $userByEmail = array_values($this->user->getByEmail(strtolower(trim($request->input('email')))));
        if (@$userByEmail and @ $userByEmail[0]->id != $user->id) {
            return response()->json(['message' => __('Api.There is user with this email already exist'),
                        'code' => '2102'], 403);
        }
        /*
         * check unique phone
         */
        if ($request->input('phone')) {
            $userByPhone = array_values($this->user->getByPhoneNumber($request->input('phone')));
            if ($userByPhone and @ $userByPhone[0]->user_id != $user->id) {
                return response()->json(['message' => __('Api.There is user with this phone already exist'),
                            'code' => '2109'], 403);
            }
        }
        /*
         * the same email used
         */

        if ($request->input("email")) {
            $this->user->update($user->id, ['email' => $request->input('email')]);
        }
        $postedData = $request->only(['name', 'gender', 'birthdate', 'phone',
            'country', 'city']);

        if (!empty($request->input('country')) && !in_array($request->input('country'), $user->selected_country)) {

//        }
//        if (!empty($user->country) && ((!empty($user->selected_country) && !in_array($request->input('country'),
//                $user->selected_country) || empty($user->selected_country)))) {
            $user->selected_country[] = $request->input('country');

            $postedData["selected_country"] = $user->selected_country;
            $postedData["sync_gateway"] = $user->sync_gateway;
            $postedData["sync_gateway"]->all_channels[] = $request->input('country');
            $postedData["id"] = $user->id;

//            $couch = new \App\Models\CouchModel();

            /*
             * create user_cart-(multi)
             */
//            $couch->setType('user_cart');
//            $couch->create(['user_id' => $user->id, 'country' => $request->input('country'),
//                'owner' => str_replace("user::", "", $user->id)],
//                'user_cart::' . $request->input('country') . '::' . $user->id);
            /*
             * create user events(perCountry)
             */

            (new \App\Models\UserEvent())->create(
                    ['user_id' => $user->id, 'country' => $request->input('country'),
                'username' => $user->username,
                'owner' => str_replace("user::", "", $user->id)], 'user_event::' . $request->input('country') . '::' . $user->id)->save();
        }
        $imageSizes = $imageSizes = config('constants.image_sizes');
        $file_name = \App\Libs\Misc::uploadAndResizeCouch('main_image', 'user', $user->id, $imageSizes);

        if ($this->user->quickUpdate($postedData)) {
            return response()->json(['message' => __("api.Profile has been changed")], 200);
        }
    }

    public function postProfileValidate(Request $request) {
//*** name, email, email2, gender, birthdate, telephone, country, city, main_image ***//

        /*
         * check user access token
         */
        $user = array_values($this->user->getByToken($request->input('token')));
        if (!@$user[0]) {
            $message = __('Api.Unauthorized user.');
            return response()->json(['message' => $message], 401);
        }
        /*
         * access token is valid
         */
        $user = @$user[0];
        $this->user_id = $user->id;

        $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors(), 'code' => '2100'], 403);
        }
        /*
         * check unique email
         */
        $userByEmail = array_values($this->user->getByEmail($request->input('email')));
        if (@$userByEmail and @ $userByEmail[0]->id != $user->id) {
            return response()->json(['message' => __('Api.There is user with this email already exist'),
                        'code' => '2102'], 403);
        }
        /*
         * check unique telephone
         */
        if ($request->input('telephone')) {
            $userByTelephone = array_values($this->user->getByPhoneNumber($request->input('telephone')));
            if (@$userByTelephone and @ $userByTelephone[0]->user_id != $user->id) {
                return response()->json(['message' => __('Api.There is user with this telephone already exist'),
                            'code' => '2109'], 403);
            }
        }
        return response()->json(['message' => __("api.Profile has been validated")], 200);
    }

    public function postLogout(Request $request) {
        $user = array_values($this->user->getByToken($request->input('token')));
        if (!@$user[0]) {
            $message = __('Api.Unauthorized user.');
            return response()->json(['message' => $message], 401);
        }
        return response()->json(['message' => __("api.User has been logged out and his token has been changed")], 200);
    }

    public function postPayment(Request $request) {

        $validator = Validator::make($request->all(), [
                    'token' => 'required',
//                    'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors(), 'code' => '2100'], 403);
        }
        /*
         * create base model
         */
        $couch = new \App\Models\CouchModel();
        /*
         * get user info
         */
        $users = array_values($this->user->getByToken($request->input('token')));
        /*
         * check if user not exist
         */
        if (!@$users[0]) return response()->json(['message' => __("Api.Unauthorized user.")], 401);
        /*
         * init user var
         */
        $user = @$users[0];

        $country = (!empty($request->get("country"))) ? $request->get("country") : "AE";
        $orderAndPaymentData = $this->user->getUserOrderData($user->id, $country);
        if (empty($orderAndPaymentData)) return response()->json(['message' => __("Api.emptyCart"), 'code' => '2110'], 403);

        $res = $this->user->setUserOrder($orderAndPaymentData);
        return ($res) ? response()->json(['message' => __("api.Payment success")], 200) : response()->json(['message' => __("api.Payment Failed")], 400);
    }

    public function getMyLibraryScript() {
//        $couch = new CouchbaseBasement("user_library");
//
//        $userWithLibraryDoc = json_decode(json_encode($couch->get("user_library",
//                    "by_userid",
//                    array(
//                    "key" => json_encode("user_library"),
//            ))), true);
//        $userWithLibraryArrID = array_column($userWithLibraryDoc, "id");
//
//        foreach ($userWithLibraryArrID as $key => $value) {
//            $userWithLibraryArr[] = str_replace("user_library::", "", $value);
//        }
//        $allRegisterUser = json_decode(json_encode($couch->get("user",
//                    "by_email", array())), true);
//        $allRegisterUserArr = array_column($allRegisterUser, "id");
//
//        $arr = array_diff($allRegisterUserArr, $userWithLibraryArr);
//        $couch->setType('user_library');
//        $data = $couch->findByKey($arr);
//        foreach ($data as $key => $value) {
//
//            $couch->create('user_library::' . $value->id,
//                ['user_id' => $value->id, 'username' => $value->username,
//                'owner' => str_replace("user::", "", $value->id)],
//                'user_library::' . $value->id);
//        }
    }

}
