<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {return view('welcome');});

Route::get('/',[TestController::class, 'index']);
Route::get('/make_back_image', [PageController::class, 'makeBackImage']);
Route::post('/make_back', [PageController::class, 'makeBackImage']);
Route::get('/make_qr_code', [PageController::class, 'makeQr']);
Route::post('/make_qr', [PageController::class, 'makeQr']);
Route::get('/white_to_clear', [PageController::class, 'whiteToClear']);
Route::post('/white_to', [PageController::class, 'whiteTo']);
Route::get('/black_to_change', [PageController::class, 'blackToChange']);
Route::post('/black_to', [PageController::class, 'blackTo']);
Route::get('/make_print_image', [PageController::class, 'makePrintImage']);
Route::post('/make_print', [PageController::class, 'makePrint']);


Route::get('/color_check', function () {return view('contents.color_check');});

Route::get('/cookie_test', [TestController::class,'cookieTest']);
Route::get('/delete_cookie', [TestController::class,'deleteCookie']);
Route::get('/sub_content', [TestController::class,'subContent']);
Route::get('/pager_test', [TestController::class,'pagerTest']);

Route::get('/seo_sample', function () {return view('contents.seo_sample');});


//Stripeノーログイン
Route::get('/stripe_no_user', [StripeController::class, 'stripeNoUser']);
Route::post('/stripe_pay_no_user', [StripeController::class, 'stripePayNoUser']);
Route::get('/no_user_thanks', [StripeController::class, 'noUserThanks'])->name('no_user_thanks');

//メールテスト
Route::get('/mail_test', [MailController::class, 'mailTest']);
Route::post('/mail_send', [MailController::class, 'mailSend']);




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
//Stripe決済
Route::get('/stripe_test', [StripeController::class, 'stripeTest']);
Route::post('/stripe_pay', [StripeController::class, 'stripePay']);
Route::get('/thanks', [StripeController::class, 'thanks'])->name('thanks');
Route::get('/stripe_sub', [StripeController::class, 'stripeSub']);
Route::post('/stripe_sub_pay', [StripeController::class, 'stripeSubPay']);
Route::get('/stripe_cancel', [StripeController::class, 'stripeCancel']);
});

require __DIR__.'/auth.php';
