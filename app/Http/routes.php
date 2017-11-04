<?php

Route::group(['prefix' => 'api', 'namespace' => 'Api'], function () {

    Route::get('/', 'Home\Home@index');
    Route::get('/guide', 'Home\Home@guide');

    Route::group(['prefix' => 'client', 'namespace' => 'Client'], function () {

        Route::controller('/orders', 'Orders\Orders');
        Route::controller('/users', 'Users\Users');
        Route::controller('/wallet', 'Wallets\Wallets');
        Route::controller('/reviews', 'Reviews\Reviews');
        Route::controller('/transactions', 'Transactions\Transactions');
    });

    Route::group(['prefix' => 'shared', 'namespace' => 'Shared'], function () {

        Route::controller('/category', 'Category\Category');
        Route::controller('/places', 'Places\Places');
        Route::controller('/contact', 'Contact\Contact');
        Route::controller('/vehicle', 'Vehicle\Vehicle');
    });

    Route::group(['prefix' => 'driver', 'namespace' => 'Driver'], function () {
        Route::controller('/users', 'Users\Users');
        Route::controller('/orders', 'Orders\Orders');
        Route::controller('/transactions', 'Transactions\Transactions');

        Route::get('/', function () {
            \Log::info('driver>>>>>>>>>>>>>>>>>>>>');
            
            return response()->json([
                    'version' => 'Driver api 2.0.0',
            ]
        );
        });
      
    });
});


Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::controller('/auth', 'Auth\Auth');
    Route::controller('/rules', 'Rules\Rules');
    Route::controller('/users', 'Users\Users');
    Route::controller('/admins', 'Admin\Admins');
    Route::controller('/orders', 'Orders\Orders');
    Route::controller('/places', 'Places\Places');
    Route::get('/', 'Dashboard\Dashboard@getIndex');
    Route::controller('/reports', 'Reports\Reports');
    Route::controller('/drivers', 'Drivers\Drivers');
    Route::controller('/settings', 'Settings\Settings');
    Route::controller('/invoices', 'Invoices\Invoices');
    Route::controller('/dashboard', 'Dashboard\Dashboard');
    Route::controller('/promotions', 'Promotions\Promotions');
    Route::controller('/categories', 'Categories\Categories');
    Route::controller('/permissions', 'Permissions\Permissions');
    Route::controller('/transactions', 'Transactions\Transactions');
    Route::get('/live-tracking', 'Dashboard\Dashboard@liveTracking');
});


Route::group(['prefix' => '/', 'namespace' => 'Front'], function () {

    Route::get('/active', 'Users\Users@getActive');
    Route::get('/', 'Home@getIndex');
    Route::get('/trans', function () {
        $list = include resource_path() . '/lang/ar/admin.php';

        echo "<form method='post'>";
        echo csrf_field();
        foreach ($list as $key => $item):;
            echo '<label>' . $key . '</label><br/>';
            echo '<input style="color:red;font-sizw=20px;" value="' . $item . '" name="' . $key . '"/><br/>';
        endforeach;

        echo"<input type='submit'>";
        echo"</form>";
    });
    Route::post('/trans', function () {
        $inputs = [];
        $arr = request()->except('_token');
        foreach ($arr as $key => $val) {
            $inputs[str_replace("_", " ", $key)] = $val;
        }


        File::put(resource_path() . '/lang/ar/admin.php', arrayToFile($inputs));
        return back();
    });
});


Route::get('/hash', function () {
    if (!request()->q)
        dd('missing q');
    return \Hash::make(request()->q);
});

