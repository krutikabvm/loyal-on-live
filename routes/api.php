<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('customer/login', 'AuthController@login');

Route::post("social/login", 'Api\AuthController@sociallogin');
Route::post('register', 'Api\AuthController@register');
Route::post("login", "Api\AuthController@login");
Route::post('forget', 'Api\AuthController@forget');

route::get("check/email", "Api\AuthController@check_verify");
Route::post("user_status", "Api\AuthController@user_status");

Route::prefix('business')->group(function () {
    Route::post("register/step-1", "Api\BusinessController@register");
    Route::middleware('business')->group(function () {
        Route::post("register/step-2", "Api\BusinessController@regsiterStep_2");
        Route::post("register/step-3", "Api\BusinessController@regsiterStep_3");
        Route::post("register/step-4", "Api\BusinessController@regsiterStep_4");
        Route::post("register/step-5", "Api\BusinessController@regsiterStep_5");
        Route::post("details", "Api\BusinessController@details");
    });

    // Route::get("logout","Api\AuthController@logout");

});

Route::prefix('admin')->group(function () {
    //login

    // Route::get("logout","Api\AuthController@logout");

    Route::middleware('admin')->group(function () {
        Route::get("business", "Api\Admin\BusinessController@index");
        Route::get("business/{id}", "Api\Admin\BusinessController@Business_detail");
        Route::post("business/{id}", "Api\Admin\BusinessController@update");
        Route::get("business/delete/{id}", "Api\Admin\BusinessController@Business_delete");

        Route::get("business_pending", "Api\Admin\BusinessController@Business_pending");
        Route::get("business_approve/{id}", "Api\Admin\BusinessController@Business_approved");

        Route::get("all_loyalty_offers/approved", "Api\Admin\BusinessController@get_loyalty_schemes_approved");
        Route::get("all_loyalty_offers/pending", "Api\Admin\BusinessController@get_loyalty_schemes_pending");

        Route::get("business/{id}/loyalty_offers/approved", "Api\Admin\BusinessController@single_loyalty_schemes_approved");

        Route::get("business/{id}/loyalty_offers/pending", "Api\Admin\BusinessController@single_loyalty_schemes_pending");

        Route::get("business/loyalty_offer/{offer}", "Api\Admin\BusinessController@offer_detail");

        Route::post("business/loyalty_offer/status/{offer}", "Api\Admin\BusinessController@offer_status");
        Route::post("business/loyalty_offer/status/nfc_update/{offer}", "Api\Admin\BusinessController@nfc_update");

        Route::get('customers', "Api\Admin\CustomerController@index");
        Route::get('customer/{id}', "Api\Admin\CustomerController@Customer_detail");
        Route::get('customer/delete/{id}', "Api\Admin\CustomerController@Customer_delete");
        Route::post('customer/{id}', "Api\Admin\CustomerController@update");

    });

});

Route::prefix('customer')->group(function () {

    Route::middleware('customer:auth')->group(function () {
        Route::get("logout", "Api\AuthController@logout");
        route::get("profile", "Api\CustomerController@profile");
        route::post("update", "Api\CustomerController@update");
        route::post("offers", "Api\CustomerController@loyalty_offers");

        route::post("offers/search", "Api\CustomerController@loyalty_offers_search");

        route::post("customer_scheme_purchase", "Api\CustomerController@customer_scheme_purchase");
        route::post("offers/{id}", "Api\CustomerController@loyalty_offers_single");
        route::get("collect/offers", "Api\CustomerLoyaltyController@index");//wallet

        route::get('collect/offers/{id}', 'Api\CustomerLoyaltyController@single_offer');
        route::post('collect/offers/stamp', 'Api\CustomerLoyaltyController@increment_stamp');
        route::post("collect_reward", 'Api\CustomerLoyaltyController@collect_reward');

        route::get("categories", "Api\SupportController@categories");
        route::post("support", "Api\SupportController@support");

        route::get("delete", "Api\AuthController@delete_user");

        Route::post("set_notification", "Api\SupportController@set_notification");
        Route::post('app_purchase_plan', "Api\CustomerController@app_purchase_plan");
        Route::post('app_purchase_plan_cancel', "Api\CustomerController@app_purchase_plan_cancel");
    });

});
