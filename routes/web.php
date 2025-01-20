<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ChatController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Backend\StudioController;
use App\Http\Controllers\Front\HomePageController;
use App\Http\Controllers\Common\DashboardController;
use App\Http\Controllers\Backend\TopGalleryController;
use App\Http\Controllers\Backend\PrivacyTermController;
use App\Http\Controllers\Backend\AuthenticationController;
use App\Http\Controllers\Backend\BookCategoryController;
use App\Http\Controllers\Backend\BookController;
use App\Http\Controllers\Backend\WriterController;
use App\Http\Controllers\Front\UserController as FrontUserController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/admin', [AuthController::class, 'adminLogin'])->name('admin_login');


Route::get('/admin/login', [UserController::class, 'adminLogin'])->name('admin.login');
Route::post('/admin/login/post', [UserController::class, 'adminLoginPost'])->name('admin-login-post');


Route::get('searchbook', [HomePageController::class,'searchbook'])->name('searchbook');


Route::get('/', [HomePageController::class,'home'])->name('home');
Route::get('book-category', [HomePageController::class,'bookCategory'])->name('book_category');

Route::get('new-all-book', [HomePageController::class,'newAllBook'])->name('all_book');
Route::get('book-writer', [HomePageController::class,'bookWriter'])->name('book_writer');
Route::get('book/details/{slug}', [HomePageController::class,'bookDetails'])->name('book_details');
Route::get('book/download/{slug}', [HomePageController::class,'bookDownload'])->name('book_download');
Route::get('book/gift-coin/{slug}', [HomePageController::class,'bookGiftCoin'])->name('book_gift_coin');
Route::get('category-wise-book/{id}', [HomePageController::class,'categoryWiseBook'])->name('category_wise_book');
Route::get('writer-wise-book/{id}', [HomePageController::class,'writerWiseBook'])->name('writer_wise_book');
Route::get('get-book', [HomePageController::class,'getBook'])->name('get_book');
Route::get('writer-get-book', [HomePageController::class,'writerWiseGetBook'])->name('writer_get_book');
Route::get('book-page/{bookSlug}/{slug}', [HomePageController::class,'booPageView'])->name('page_view');
Route::get('book-pdf-download/{slug}', [HomePageController::class,'bookPdfDownload'])->name('book_pdf_download');


Route::get('customer-login', [FrontUserController::class,'customerLogin'])->name('customer_login');
Route::post('customer-registration', [FrontUserController::class,'customerRegister'])->name('customer_registration');
Route::post('customer-login-post', [FrontUserController::class,'customerLoginPost'])->name('customer_login_post');


Route::group(['middleware' => 'customer'], function(){
    Route::get('customer/dashboard', [FrontUserController::class, 'userDashboard'])->name('customer_dashboard');
    Route::get('/admin/profile', [FrontUserController::class, 'profilePage'])->name('user_profile');
    Route::get('/logout', [FrontUserController::class, 'logout'])->name('customer_logout');
    Route::get('/like/{book_id}', [HomePageController::class,'likeAdd'])->name('like_add');
    Route::get('/comment/{book_id}', [HomePageController::class,'commentAdd'])->name('comment_add');
    Route::get('/book/page', [HomePageController::class,'bookPage'])->name('book_page');
    Route::get('/customer/profile', [FrontUserController::class,'customerProfile'])->name('customer_profile');
    Route::post('/customer/profile/update', [FrontUserController::class,'customerProfileUpdate'])->name('customer_profile_update');
    Route::post('/password-update', [FrontUserController::class, 'updatePassword'])->name('password_update');
    Route::post('/book-store', [FrontUserController::class, 'bookStore'])->name('book_store');
    Route::get('/book-store-list/{id}', [FrontUserController::class, 'ownBookList'])->name('own_book_list');
});

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', [DashboardController::class, 'profilePage'])->name('user_frofile');

    Route::post('user-details', [DashboardController::class, 'updateUserDetails'])->name('update_user_details');
    Route::post('update-password', [DashboardController::class, 'updatePassword'])->name('update_password');
    Route::post('profile-medias/temp', [DashboardController::class, 'uploadProfileMedia'])->name('upload_profile_media_temporary');
    Route::post('profile-medias/remove', [DashboardController::class, 'removeProfileMedia'])->name('remove_profile_media_temporary');
    Route::post('profile-medias/upload', [DashboardController::class, 'profileMediaUpload'])->name('profile_media_upload');

    Route::get('settings', [SettingController::class, 'settingPage'])->name('settings');
    Route::post('logo-medias/temp', [SettingController::class, 'uploadLogoMedia'])->name('upload_logo_media_temporary');
    Route::post('logo-medias/remove', [SettingController::class, 'removeLogoMedia'])->name('remove_logo_media_temporary');
    Route::post('logo-medias/upload', [SettingController::class, 'store'])->name('logo_media_upload');
    Route::post('footer-tops/upload', [SettingController::class, 'footerTopsUpload'])->name('footer_tops_upload');
    /**
     * User Management Routes
     */
    Route::group(['prefix' => ''], function () {
        Route::resource('users', UserController::class);

        Route::resource('book-category', BookCategoryController::class);
        Route::resource('writers', WriterController::class);
        Route::resource('book', BookController::class);
        // sa

        Route::get('ad/setting', [SettingController::class, 'adSetting'])->name('ad_setting');
        Route::post('ad/setting/store', [SettingController::class, 'adSettingCreateOrUpdate'])->name('ad_setting.store');
        Route::post('home/page/ad/setting/store', [SettingController::class, 'homePageAdSettingCreateOrUpdate'])->name('home_page_ad_setting.store');
        Route::post('category/page/ad/setting/store', [SettingController::class, 'categoryPageAdSettingCreateOrUpdate'])->name('category_page_ad_setting.store');
        Route::post('writer/page/ad/setting/store', [SettingController::class, 'writerPageAdSettingCreateOrUpdate'])->name('writer_page_ad_setting.store');
        Route::post('single/page/ad/setting/store', [SettingController::class, 'singlePageAdSettingCreateOrUpdate'])->name('single_page_ad_setting.store');
    });


    Route::post('/logout', [UserController::class, 'adminLogout'])->name('admin-logout');
});

