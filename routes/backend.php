<?php

use App\Http\Controllers\Web\backend\LocationController;
use App\Http\Controllers\Web\backend\PremissionController;
use App\Http\Controllers\Web\backend\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\backend\UserController;
use App\Http\Controllers\Web\backend\SettingController;
use App\Http\Controllers\Web\backend\admin\FAQController;
use App\Http\Controllers\Web\backend\CategoryController;
use App\Http\Controllers\Web\backend\Frontend\CmsController;
use App\Http\Controllers\Web\backend\ProductController;
use App\Http\Controllers\Web\backend\promocode\PromocodeController;
use App\Http\Controllers\Web\backend\settings\DynamicPagesController;
use App\Http\Controllers\Web\backend\settings\MailSettingsController;
use App\Http\Controllers\Web\backend\settings\ProfileSettingController;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;

Route::middleware(['auth'])->group(function () {
    Route::controller(SettingController::class)->group(function () {
        Route::get('/general/setting', 'create')->name('general.setting');
        Route::post('/system/update', 'update')->name('system.update');
        Route::get('/admin/setting', 'adminSetting')->name('admin.setting');
        Route::post('/admin/setting/update', 'adminSettingUpdate')->name('admin.settingupdate');

        
    });

    // Route::match(['get', 'post'], '/cms/{section}/{page}', [CmsController::class, 'createOrUpdate'])->name('cms.createOrUpdate');
    Route::get('/backend/layout/cms/{page}/{section}/{id?}', [CmsController::class, 'getCmsForm'])->name('cms.get');
    Route::post('/backend/layout/cms/{page}/{section}/{id?}', [CmsController::class, 'createOrUpdateForm'])->name('cms.createOrUpdateForm');
    // Delete CMS record
Route::delete('/cms/{id}', [CmsController::class, 'destroy'])->name('cms.delete');
Route::get('/cms/status/{id}', [CmsController::class, 'status'])->name('cms.status');
   // Route::get('/homeblocks/edit/{id}', [CmsController::class, 'edit'])->name('cms.allBlocksEdit');

    //Route::get('/backend/layout/cms/{page}/{section}/{id}', [CmsController::class, 'allBlocksEdit'])->name('cms.allBlocksEdit');


    //profile Settings Controller
    Route::controller(ProfileSettingController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile');
        Route::post('/profile/update', 'updateProfile')->name('profile.update');
        Route::post('/profile/update/password', 'updatePassword')->name('profile.update.password');
        Route::post('/profile/update/profile-picture', 'updateProfilePicture')->name('profile.update.profile.picture');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/users/list', 'index')->name('user.list');
        Route::get('/view/users/{id}', 'show')->name('show.user');
        Route::get('/status/users/{id}', 'status')->name('user.status');
    });

    Route::prefix('permissions')->controller(PremissionController::class)->group(function () {
        Route::get('/list', 'index')->name('admin.permissions.list');
        Route::get('/view/users/{id}', 'show')->name('show.user');
    });

    Route::prefix('role')->controller(RoleController::class)->group(function () {
        Route::get('/list', 'index')->name('admin.role.list');
        Route::get('/create', 'create')->name('admin.role.create');
        Route::post('/store', 'store')->name('admin.role.store');
        Route::get('/edit/{id}', 'edit')->name('admin.role.edit');
        Route::post('/update/{id}', 'update')->name('admin.role.update');
        Route::delete('/destroy/{id}', 'destroy')->name('admin.role.destroy');

    });

    // Category Route
    Route::prefix('category')->controller(CategoryController::class)->as('admin.category.')->group(function () {
        Route::get('/list', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{category}', 'edit')->name('edit');
        Route::post('/update/{category}', 'update')->name('update');
        Route::delete('/destroy/{category}', 'destroy')->name('destroy');
        Route::get('/status/{id}', 'status')->name('status');
        Route::post('bulk-delete', 'bulkDelete')->name('bulk-delete');
    });
    //promocode
    Route::prefix('promocode')->controller(PromocodeController::class)->as('admin.promocode.')->group(function () {
        Route::get('/list', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{promocode}', 'edit')->name('edit');
        Route::post('/update/{promocode}', 'update')->name('update');
        Route::delete('/destroy/{promocode}', 'destroy')->name('destroy');
        Route::get('/status/{id}', 'status')->name('status');
        Route::post('bulk-delete', 'bulkDelete')->name('bulk-delete');
    });

    //product Route
    Route::prefix('product')->controller(ProductController::class)->as('admin.product.')->group(function () {
        Route::get('/list', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{product}', 'edit')->name('edit');
        Route::put('/update/{product}', 'update')->name('update');
        Route::delete('/destroy/{product}', 'destroy')->name('destroy');
        Route::get('/status/{id}', 'status')->name('status');
        Route::post('bulk-delete', 'bulkDelete')->name('bulk-delete');
    });
    
    // Cms
// routes/web.php


    //Dynamic Pages Route

    Route::resource('dynamicPages', DynamicPagesController::class);
    Route::post('dynamicPages/status/{id}', [DynamicPagesController::class, 'changeStatus'])->name('dynamicPages.status');

    //FAQ Route
    Route::resource('faq', FAQController::class);
    Route::post('faq/status/{id}', [FAQController::class, 'changeStatus'])->name('faq.status');

 //mail settings
 Route::controller(MailSettingsController::class)->group(function () {
    Route::get('/mail/settings', 'index')->name('mail.settings');
    Route::post('/mail/update', 'mailSettingUpdate')->name('mail.update');

    Route::get('/stripe/settings', 'stripeSettings')->name('stripe.settings');
    Route::get('/stripe/update', 'stripeSettingUpdate')->name('stripe.update');
});


});
