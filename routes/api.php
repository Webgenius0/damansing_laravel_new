<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CMS\CmsController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\UserAuthController;
use App\Http\Controllers\API\cart\CartController;
use App\Http\Controllers\API\food\FoodController;
use App\Http\Controllers\API\CMS\DynamicPageController;
use App\Http\Controllers\API\Order\OrderHistoryController;
use App\Http\Controllers\API\Order\OrderPaymentController;
use App\Http\Controllers\API\promocode\PromoCodeController;
use App\Http\Controllers\API\Order\GetSampleProductController;
use App\Http\Controllers\API\delivaryaddress\DeliveryAddressController;

// acccept all request new

Route::controller(UserAuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('resend-otp', 'resendOtp');
    Route::post('forget-password', 'forgetPassword');
    Route::post('verify-otp-password', 'varifyOtpWithOutAuth');
    Route::post('reset-password', 'resetPassword');
    Route::post('google/login', 'googleLogin');
});

Route::group(['middleware' => ['jwt.verify']], function () {

      Route::post('logout', [UserAuthController::class, 'logout']);
      Route::get('me', [UserAuthController::class, 'me']);
      Route::post('refresh', [UserAuthController::class, 'refresh']);
      Route::delete('/delete/user', [UserController::class, 'deleteUser']);
      Route::post('change-password', [UserController::class, 'changePassword']);
      Route::post('user-update', [UserController::class, 'updateUserInfo']);
      Route::get('/my-notifications', [UserController::class, 'getMyNotifications']);
      // Route::get('send-notification', function () {
      //     $user = User::where('id', Auth::id())->first();
      //     $user->notify(new UserNotifications('Jb', "Test Notification"));

      //     $device_tokens = FirebaseTokens::where(function ($query) {
      //         $query->where('user_id', Auth::id())
      //             ->orWhereNull('user_id');
      //     })
      //         ->where('is_active', '1')
      //         ->get();

      //     $data = [
      //         'message' => $user->name . ' has sent you a notification',
      //     ];

      //     foreach ($device_tokens as $device_token) {
      //         Helper::sendNotifyMobile($device_token->token, $data);
      //     }

      //     return ['success' => true, 'message' => 'Notification sent successfully'];
      // });



      // Route::post("firebase/token/add", [FirebaseTokenController::class, "store"]);
      // Route::post("firebase/token/get", [FirebaseTokenController::class, "getToken"]);
      // Route::post("firebase/token/detele", [FirebaseTokenController::class, "deleteToken"]);

      Route::controller(UserController::class)->group(function () {
        Route::post('updateUser', 'updateUserInfo');
        Route::post(('/change-avatar'), 'updateAvatar');
      });
      Route::controller(DeliveryAddressController::class)->group(function () {
        Route::post('add-delivery-address', 'UpdateOrCreate');
      });

      Route::post('/cart/store/{id}', [CartController::class, 'addToCart']);
      Route::post('/cart/update/{id}', [CartController::class, 'updateCartQuantity']);
      Route::delete('/cart/delete/{id}', [CartController::class, 'deleteFromCart']);
      Route::get('/cart/details', [CartController::class, 'showCart']);

      // Apply promocode 

      Route::post('/apply-promocode', [PromoCodeController::class, 'applyPromoCode']);


      Route::get('/order/summary', [OrderPaymentController::class, 'OrderSummury']);

      Route::post('/place/order', [OrderPaymentController::class, 'placeOrder']);

      Route::get('/order/history', [OrderHistoryController::class, 'orderHistory']);


      Route::get('/order/sample/product/{id}',[GetSampleProductController::class,'sampleProduct']);
});

Route::controller(CmsController::class)->group(function () {

   // Route::get('/homepage', 'gethomePage')->name('homeCms');
   Route::get('/home-banner','homepageBanner')->name('homeBanner');
    Route::get('/home-welcome','homeWelcome')->name('homeWelcome');
    Route::get('/welcome-array','welcomeArray')->name('welcomeArray');
    Route::get('/home-Nutritious-Delicious','getNutratasusFood')->name('homeNutritiousDelicious ');
    Route::get('/home-pets-health','petsHealth')->name('homePetsHealth');
    Route::get('/home-serveAsMeals','serveAsMeals')->name('homeServeAsMeals');
    Route::get('/home-healthyDogs','healthyDogs')->name('homeHealthyDogs');
    Route::get('/home-testiMonial','getTestimonial')->name('homeTestimonial');
    Route::get('/home-contact','homeContactUs')->name('homeContact');
    //faq
    Route::get('/faq', 'getFaqWithCms')->name('faq');

    //From The Vet Start
    Route::get('/fromTheVetBanner', 'getFromTheVetBanner')->name('fromTheVetBanner');
    Route::get('/notOnPetNutrition', 'getNotOnPetNutration')->name('notOnPetNutrition');

    // Recipies and Nutrition
    Route::get('/nutrationBanner', 'getNutrationBanner')->name('recipesBanner');
    Route::get('/freshIngredients', 'getFreshIngredients')->name('perfectNutration');
    Route::get('/perfectNutration', 'getPerfectNutration')->name('cardIndex');
    Route::get('/perfectNutrationList', 'getPerfectNutrationList')->name('createNew');


    Route::get('/recipesAndNutrition', 'getNutritionAndRecipes')->name('nutritionAndRecipes');
    Route::get('/howItWorks', 'getHowItWorks')->name('howItWorks');
    Route::get('/fromTheVet', 'getFromTheVet')->name('fromTheVet');
    Route::get('/aboutUs', 'getAboutUs')->name('aboutUs');

});


Route::controller(FoodController::class)->group(function () {

    Route::get('view-details/{slug}', 'viewDetails')->name('viewDetails');
    Route::get('/show-all-food', 'showAllFood')->name('showAllFood');

});

Route::get('/dynamicPages',[DynamicPageController::class,'dynamicPages'])->name('dynamicPages.index');

Route::post('send-message', [ContactController::class, 'sendMessage']);




