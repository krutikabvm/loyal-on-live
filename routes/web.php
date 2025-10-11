<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', function () {
    return view("business.login");
});

Route::get('cache_clear', function () {
    \Artisan::call('cache:clear');
    \Artisan::call('config:cache');
    \Artisan::call('optimize:clear');
    dd("All Compile data and Cache is cleared");
});

// route::get("reset-password","Web\BusinessController@forget");

Route::get('forget/reset_password', 'ForgetController@reset_form')->name('password.reset');
Route::post('forget/reset_password', "ForgetController@reset_post")->name("reset.form.submit");

Route::get('email/verify/{id}', 'ForgetController@verify')->name('verification.verify');

Route::prefix('business')->group(function () {

    Route::get("login", "Web\BusinessController@index")->name("login");

    Route::post("login", "Web\BusinessController@login")->name("business.login");
    Route::get("active", "Web\BusinessController@active")->name("business.active");
    Route::post("active", "Web\BusinessController@activate_account")->name("business.activate_account");

    Route::get("register", "Web\BusinessController@register")->name("business.register.page");
    Route::post("register", "Web\BusinessController@register_business")->name("business.register");
    route::get("forget", "Web\BusinessController@forget_page")->name("forget.page");
    route::post("forget", "Web\BusinessController@forget_page_post")->name("business.forget_post");

//auth routes
    Route::middleware(['auth'])->group(function () {

        Route::get("step/1", "Web\BusinessController@step1")->name("step1.page");

        route::post("plans", "Web\BusinessController@plans_save")
            ->name('business.plans');
        route::post("yourbusiness", "Web\BusinessController@YourBusiness_save")->name("business.detail");

        route::post("imgscheme", "Web\BusinessController@imgs_scheme")->name("business.scheme.imgs");

        route::post("yourbusiness2", "Web\BusinessController@YourBusiness2_save")->name("business.detail2");
        route::post("more_business", "Web\BusinessController@new_locations_save")->name("business.new_locations");

        route::post("loyalityscheme", "Web\BusinessController@LoyalityScheme_save")->name("business.loyalty");

        route::post("send_tags", "Web\BusinessController@send_tags")->name("send.tags");

        route::get("plan", "Web\BusinessController@get_choose_plan")->name("selected_plan");

        route::get("paid", "Web\BusinessController@paid")->name("payment");

        route::post("contactinfo", "Web\BusinessController@contactInfo_save")->name("business.contactinfo");

        route::get("finished", "Web\BusinessController@finished")->name("finished");

        route::get("finish", "Web\BusinessController@end")->name("end");

        route::get("home", "Web\BusinessDashboardController@index")->name("business.home");

        route::get("location", "Web\BusinessDashboardController@locations")->name("business.location");

        route::get("profile", "Web\BusinessDashboardController@profile")->name("business.profile");
        route::get("account", "Web\BusinessDashboardController@account")->name("business.account");

        route::get("billing", "Web\BusinessDashboardController@billing")->name("business.billing");

        route::get("your-plan", "Web\BusinessDashboardController@plan")->name("business.plan");

        route::post("update_data", "Web\BusinessDashboardController@update_data")->name("update_data");
        route::post("addNewScheme", "Web\BusinessDashboardController@addNewScheme")->name("addNewScheme");

        route::post("update_password", "Web\BusinessDashboardController@update_pwd")->name("update_pwd");

        route::post("update_profile", "Web\BusinessDashboardController@update_profile")->name("update_profile");

        route::post("upload-images", "Web\BusinessDashboardController@uploadImages")->name("upload-images");

        route::post("update_plan", "Web\BusinessDashboardController@update_plan")->name("update_plan");

        route::post("add_location", "Web\BusinessDashboardController@add_location")->name("add_location");

        route::post("delete_loyality", "Web\BusinessDashboardController@delete_loyality")->name("delete_loyality");
        route::get("remove_image/{id}", "Web\BusinessDashboardController@remove_image")->name("remove_image");
        route::post("delete_location", "Web\BusinessDashboardController@delete_location")->name("delete_location");
        route::get("cancel_account", "Web\BusinessDashboardController@cancel_account")->name("cancel_account");
        route::get("reactivate_account", "Web\BusinessDashboardController@reactivate_account")->name("reactivate_account");

    });

// end auth routes

// extra

// route::get("contactinfo","Web\BusinessController@contactInfo")->name("business.contactinfo.page");

// route::get("plans","Web\BusinessController@plans")
    // ->name('business.plans.page');

// route::get("yourbusiness","Web\BusinessController@YourBusiness")->name("business.detail.page");

// route::post("img","Web\BusinessController@imgs")->name("business.imgs");

// route::get("submit","Web\BusinessController@submit")->name("business.submit");
    // route::get("complete","Web\BusinessController@complete")->name("business.c1.page");

// route::get("complete1","Web\BusinessController@Complete1")->name("business.c2.page");
    // route::get("complete3","Web\BusinessController@Complete3")->name("business.c3.page");

// route::get("ls1","Web\BusinessController@ls1");

// route::get("loyalityscheme","Web\BusinessController@LoyalityScheme")->name("business.loyalty.page");

// route::get("yourbusiness2","Web\BusinessController@YourBusiness2")->name("business.detail2.page");

});
// Admin routes
Route::prefix('admin')->group(function () {
    Route::middleware('adminweb')->group(function () {
        Route::get("business", "Admin\AdminDashboardController@business")->name("admin.business");
        Route::get("business_details/{id}", "Admin\AdminDashboardController@business_details")->name("admin.business_details");

        Route::get('business/deal',"Admin\AdminDashboardController@limited_time_perk")->name("admin.business.deal");
        Route::post('/update-loyalty-dashboard', "Admin\AdminDashboardController@updateLoyaltyDashboard");
        
        Route::get("logout", "Admin\AdminDashboardController@logout")->name("admin.logout");
        Route::post("upload-image", "Admin\AdminDashboardController@uploadImages")->name("upload-image");
        Route::get("business-billing", "Admin\AdminDashboardController@billing")->name("business-billing");
        Route::post("update_data", "Admin\AdminDashboardController@update_data")->name("admin.update_data");
        Route::post("update_status", "Admin\AdminDashboardController@update_status")->name("admin.update_status");
        Route::get("cancel_account/{id}", "Admin\AdminDashboardController@cancel_account")->name("admin.cancel_account");
        Route::get("reactivate_account/{id}", "Admin\AdminDashboardController@reactivate_account")->name("admin.reactivate_account");
        Route::get("loyality_card_insights/{id}", "Admin\AdminDashboardController@loyality_card_insights")->name("admin.loyality_card_insights");

        Route::get("limited_time_perk","Admin\AdminDashboardController@create_limited_time_perk")->name('admin.create_limited_time_perk');

        Route::post('limited-time-perk-store', "Admin\AdminDashboardController@store_limited_time_perk")->name('limited_time_perk.store');
        Route::post("limited-perk/{id}/update","Admin\AdminDashboardController@update_limited_perk")->name('limited_perk.update');

        Route::get("perk-portal","Admin\AdminDashboardController@perk_portal")->name('admin.perks-portal');
        Route::post('/perks/end', "Admin\AdminDashboardController@end")->name('perks.end');

        Route::get('fetch-perk-data/{id}', "Admin\AdminDashboardController@fetchData")->name('admin.fetch.perks_data');


        Route::get("ongoing_perk","Admin\AdminDashboardController@create_ongoing_perk")->name('admin.create_ongoing_perk');
        Route::get("ongoing-perk/{id}/edit","Admin\AdminDashboardController@edit_ongoing_perk")->name('admin.edit_ongoing_perk');
        Route::post("ongoing-perk/{id}/update","Admin\AdminDashboardController@update_ongoing_perk")->name('ongoing_perk.update');

        Route::post('ongoing_perk-store', "Admin\AdminDashboardController@store_ongoing_perk")->name('ongoing_perk.store');

        Route::get("customers", "Admin\AdminDashboardController@customers")->name("admin.customers");
        Route::get("customer_details/{id}", "Admin\AdminDashboardController@customer_details")->name("admin.customer_details");
        Route::get("push_notification", "Admin\AdminDashboardController@push_notification")->name("admin.push_notification");
        Route::get("account", "Admin\AdminDashboardController@account")->name("admin.account");
        Route::get("plan", "Admin\AdminDashboardController@plan")->name("admin.plan");
        Route::post("uploadCusImg", "Admin\AdminDashboardController@uploadCusImg")->name("admin.uploadCusImg");
        Route::get("business_search", "Admin\AdminDashboardController@business_search")->name("admin.business_search");
        Route::post("customer_search", "Admin\AdminDashboardController@customer_search")->name("admin.customer_search");
        Route::get("cancel_customer_account/{id}", "Admin\AdminDashboardController@cancel_customer_account")->name("admin.cancel_customer_account");
        Route::get("reactivate_customer_account/{id}", "Admin\AdminDashboardController@reactivate_customer_account")->name("admin.reactivate_customer_account");
        Route::post("update_profile", "Admin\AdminDashboardController@update_profile")->name("admin.update_profile");
        Route::post("UpdateScheme", "Admin\AdminDashboardController@UpdateScheme")->name("admin.UpdateScheme");
        Route::get("active_account/{id}", "Admin\AdminDashboardController@active_account")->name("admin.active_account");
        Route::post("plan", "Admin\AdminDashboardController@save_plan")->name("admin.save_plan");
        Route::post("send_push", "Admin\AdminDashboardController@send_push")->name("admin.send_push");

        Route::post("update_settings", "Admin\AdminDashboardController@update_settings")->name("admin.update_settings");
        Route::post("update_settings", "Admin\AdminDashboardController@update_settings")->name("admin.update_settings");
        Route::post("update_business_data", "Admin\AdminDashboardController@update_business_data")->name("admin.update_business_data");

        route::get("ads_banner", "Admin\AdBannerController@index")->name("ads.index");
        route::get("ads_banner/create", "Admin\AdBannerController@create")->name("ads.create");
        route::post("ads_banner/store", "Admin\AdBannerController@store")->name("ads_banner.store");
        Route::get('ads_banner/edit/{id}', "Admin\AdBannerController@edit")->name('ads_banner.edit');
        Route::put('ads_banner/{id}',  "Admin\AdBannerController@update")->name('ads_banner.update');
        Route::get('ads_banner/delete/{id}',  "Admin\AdBannerController@destroy")->name('ads_banner.delete');

    });
});


Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
