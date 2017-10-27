<?php

namespace App\Http\Controllers\Admin\Drivers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Groupes
 *
 * @author jooaziz
 */
use Amit\Support\Str;
use App\Models\Driver as Model;
use App\Http\Validations\Admin\DreiversValidatio as check;
use App\Http\Mails\Admin\Driver as MailSender;
use App\Models\Order as DriverOrders;
use App\Models\Review;
use App\Models\Transaction;
use Carbon\Carbon;
use App\Http\Helper\Shared\TransactionHelper;

class Drivers extends \App\Http\Controllers\Admin\Base {

    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
        parent::__construct();
    }

    public function getIndex() {
        $driversClass = new Model;

        if (request()->email)
            $driversClass = $driversClass->where('email', 'like', request()->email . '%');

        if (request()->username)
            $driversClass = $driversClass->where('username', 'like', request()->username . '%');

        if (request()->plate_no)
            $driversClass = $driversClass->where('plate_no', 'like', request()->plate_no . '%');

        if (request()->order && request()->order_type)
            $driversClass = $driversClass->orderBy(request()->order, request()->order_type);

        return parent::view(['rows' => $driversClass->paginate()->appends(request()->all())]);
    }

    public function getActive($id, $st) {
        Model::whereId($id)->update(['active' => ($st == 1) ? 1 : 0]);
        return back();
    }

    public function getChangePassword() {
        return parent::view();
    }

    public function postChangePassword(check $request, $id) {
        $row = Model::findOrFail($id);
        $row->password = \Hash::make($request->password);
        $row->save();
        //  MailSender::newPass($row);
        return parent::redirectToIndex();
    }

    public function getArchive($id, $st) {
        Model::whereId($id)->update(['archived' => ($st == 1) ? $st : 0]);
        return back();
    }

    public function getView($id) {
        $row = $this->model->findOrFail($id);
//        dd($row);
        return parent::view(compact('row'));
    }

    public function getCreate() {

        return parent::view([ 'row' => $this->model]);
    }

    public function postCreate(check $request) {


        $row = Model::quickSave(initData::create($request));


        flash()->success(__('admin.' . Str::singular($this->module) . ' has been added Successfully'));
        return parent::redirectToIndex();
    }

    public function getEdit($id) {
        $row = $this->model->findOrFail($id);


        return parent::view(compact('row'));
    }

    public function postEdit(check $request) {
        $data = initData::create($request); 
        Model::quickUpdate($data);
        flash()->success(__('admin.' . Str::singular($this->module) . ' has been edited Successfully'));
        return parent::redirectToIndex();
    }

    public function getDelete($id) {


        Model::destroy($id);

        flash()->success(__('admin.' . Str::singular($this->module) . ' has been deleted Successfully'));
        return parent::redirectToIndex();
    }

    public function getOrder($id) {
        $rows = DriverOrders::whereDriverId($id)->paginate();
        return parent::view(compact('rows'));
    }

    public function getReviews($id) {
        $rows = Review::whereDriverId($id)->paginate();
        return parent::view(compact('rows'));
    }

    public function getTransactions($id) {
        $rows = Transaction::whereClientId($id)->paginate();
        return parent::view(compact('rows'));
    }

    public function getMakeTransaction($id) {
        return parent::view();
    }

    public function postMakeTransaction($id, check $request) {
        $data = new Transaction;

        $data->driver_id = $id;
        $data->client_id = 0;
        $data->order_id = 0;
        $data->amount = request()->amount;
        $data->payment_method = 2;
        $data->date = Carbon::now();
        $data->description = "paid from adminstration";

        $data->save();

        return parent::redirectToIndex();
    }

    public function getInvoices($id) {
        $data = TransactionHelper::getFullTransactionData($id, request()->from_date, request()->to_date);

//        dd($data);
        $driver = $data->driver;




        $transactions = $data->transactions;
        $totalAmount = $data->totalAmount;
        $paidAmount = $data->paidAmount;
        $percentage = $data->netProfit;
        $restAmount = $data->restAmount;
//        $transactions = $driver->myTransactions([Transaction::$cash, Transaction::$paid])->get();
//        $totalAmount = $driver->myTransactions([Transaction::$cash, Transaction::$visa])->sum('amount');
//        $paidAmount = abs($driver->myTransactions([Transaction::$cash, Transaction::$paid])->sum('amount'));
//        $percentage = $totalAmount - ($totalAmount / 10);
//        $restAmount = ($percentage - $paidAmount);
        return parent::view(compact('driver', 'transactions', 'totalAmount', 'paidAmount', 'restAmount', 'percentage'));
    }

}
