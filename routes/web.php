<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['namespace'=>'Auth'], function(){
    Route::group(['prefix'=>'front'], function(){
        Route::get('/login', 'LoginClientController@getLogin');
        Route::post('/login', 'LoginClientController@postLogin');

        // Route::get('{driver}/callback', 'LoginClientController@handleProviderCallback');
        // Route::get('redirect/{driver}', 'LoginClientController@redirectToProvider');
        // ->name('login.provider')
        // ->where('driver', implode('|', config('auth.socialite.drivers')));
    });
});



Route::group(['namespace'=>'front'], function(){
    Route::group(['prefix'=>'/'], function(){
        Route::get('/', 'HomeController@getViewHome');
        Route::get('/shop-acc-dot-kich.html', 'HomeController@getViewShopCF');

        //index
        Route::get('/huong-dan-mua-acc.html', 'HomeController@getViewSuggest');
        Route::get('/shop-acc-lmht.html', 'HomeController@getViewHome');
        Route::get('/shop-lien-quan.html', 'HomeController@getViewShopLQ');
        Route::get('/shop-acc-lol-han-quoc.html', 'HomeController@getViewShopLMHTKorea');
        Route::get('/shop-acc-free-fire.html', 'HomeController@getViewShopFreefine');
        Route::get('/shop-acc-pubg-pc.html', 'HomeController@getViewShopPubgPC');
        Route::get('/shop-acc-pubg-mobile.html', 'HomeController@getViewShopPubgMobile');
        Route::get('/shop-acc-fifa-online.html', 'HomeController@getViewShopFo4');

        Route::get('/giao-dich-gan-day.html', 'RecentTransactionController@getViewIndex');
        Route::get('/nap-the.html', 'ChargeCardController@getViewIndex');
        Route::get('/lich-su-giao-dich', 'HistoryBoughtController@getViewIndex');
        //detail
        Route::get('/mua-acc-{id}.html', 'AccountDetailController@getViewDetailLMHT');
        Route::get('/shop-lien-quan-{id}.html', 'AccountDetailController@getViewDetailLQ');
        Route::get('/shop-acc-freefire-{id}.html', 'AccountDetailController@getViewDetailFF');
        Route::get('/acc-lol-han-quoc-{id}.html', 'AccountDetailController@getViewDetailLMHTKR');
        // Route::get('/shop-acc-dot-kich-{id}.html', 'AccountDetailController@getViewDetailCF');
        Route::get('/acc-pubg-mobile-{id}.html', 'AccountDetailController@getViewDetailPubgMobile');
        Route::get('/acc-pubg-pc-{id}.html', 'AccountDetailController@getViewDetailPubgPC');
        Route::get('/acc-fifa-online-{id}.html', 'AccountDetailController@getViewDetailFifa');
        Route::get('/dieu-khoan.html', 'PageController@getViewIndex');

        
        Route::group(['prefix'=>'account'], function(){
            Route::post('/cardv1', 'ChargeCardController@postCardMember');
            Route::post('/fetch_data', 'HomeController@fetchDataAccount');
            Route::post('/buy', 'HomeController@buyAccount');
            Route::post('/load_account_list', 'HomeController@loadAccountList');
            Route::post('/load_account_list2', 'HomeController@loadAccountList2');

            Route::post('/buy_acc_random', 'HomeController@buyAccountRandom');
            
        });
        // Route::get('/', 'RegisterController@getRegister');
        // Route::post('/', 'RegisterController@postRegister');
    });
});
Route::group(['namespace' => 'front'],function(){
    Route::group(['prefix'=>'front'], function(){
        Route::get('/logout', 'HomeController@logoutUser');
        Route::post('/register', 'RegisterController@postRegister');
    });
});

Route::group(['namespace'=>'admin'], function(){
    Route::group(['prefix'=>'login','middleware'=>'CheckLoggedIn'], function(){
        Route::get('/', 'LoginController@getLogin');
        Route::post('/', 'LoginController@postLogin');
    });

    Route::get('logout', 'HomeController@getLogout');
    Route::group(['prefix'=>'admin', 'middleware'=>'CheckLoggedOut'], function(){
        Route::get('home', 'NotificationController@index');
        Route::post('home', 'NotificationController@update');
        Route::group(['prefix'=> 'account'], function(){
            Route::get('/', 'AccountRandomController@getAccount');

            //ajax pagination
            Route::post('/fetch_data', 'AccountRandomController@fetchDataAccount');

            Route::post('update/{id}', 'AccountRandomController@postUpdateAccount');
            Route::post('delete/{id}', 'AccountRandomController@postDeleteAccount');

            Route::get('add', 'AccountRandomController@getAddAccount');
            Route::post('add', 'AccountRandomController@postAddAccount');
            Route::post('fetch/{id}', 'AccountRandomController@postFetchAccount');

            Route::post('type_add', 'AccountRandomController@postAddTypeAccount');
            Route::get('history', 'TopCardController@getViewHistoryBuy');
        });
        
        Route::group(['prefix'=> 'card'], function(){
            Route::get('/history', 'TopCardController@getIndexView');
            Route::get('/static', 'TopCardController@getViewHistoryCard');
            Route::post('/duyet_the', 'TopCardController@handleEventActionSuccess');
            Route::post('/duyet_the_thatbai', 'TopCardController@handleEventActionFailed');
        });

        Route::group(['prefix'=> 'accounts'], function(){
            Route::get('/', 'AccountController@getAccount');

            //ajax pagination
            Route::post('/fetch_data', 'AccountController@fetchDataAccount');

            Route::get('update/{id}', 'AccountController@getUpdateAccount');
            Route::post('update/{id}', 'AccountController@postUpdateAccount');
            Route::post('delete/{id}', 'AccountController@postDeleteAccount');

            Route::get('add', 'AccountController@getAddAccount');
            Route::post('add', 'AccountController@postAddAccount');
            Route::post('fetch/{id}', 'AccountController@postFetchAccount');

            Route::post('type_add', 'AccountController@postAddTypeAccount');
        });

        Route::group(['prefix' => 'members'], function() {
            Route::get('/', 'MemberController@getPageMember');
            //ajax pagination
            Route::post('/fetch_data', 'MemberController@fetchDataMembers');
            Route::post('/update_money', 'MemberController@updateMoneyUser');
            Route::post('/plus_money', 'MemberController@plusMoneyUser');
            Route::post('/search', 'MemberController@searchNameMembers');
        });
    });
});


