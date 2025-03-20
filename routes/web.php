<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/user/verification', [UserController::class, 'verificationView'])->middleware(['auth', 'verified'])->name('verification');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::get('/api/users', [UserController::class, 'getAllUsers']);
Route::post('/api/admin/save-coupon', [UserController::class, 'storeCoupon'])->name('save-coupon');
Route::get('/api/admin/delete-coupon/${couponIdToDelete}', [UserController::class, 'deleteCoupon'])->name('delete-coupon');
Route::post('/admin/users/{id}', [UserController::class, 'adminUpdateuser'])->name('admin.updateuser');
Route::delete('/admin/users/{id}', [UserController::class, 'adminDeleteUser'])->name('admin.deleteuser');
Route::post('/admin/profile-update/{id}', [UserController::class, 'adminProfileUpdate'])->name('admin-profile-update');


Route::get('/user/profile', [UserController::class, 'userProfile'])->name('user.profile');
Route::get('/admin/profile', [UserController::class, 'adminProfile'])->name('admin.profile');

Route::post('/user/verify-pin', [UserController::class, 'verifyPin'])->name('user.verify-pin');


Route::delete('/api/users/{id}', [UserController::class, 'deleteUser']);
Route::get('/api/logged-in-user', [UserController::class, 'getLoggedInUser']);
Route::post('/update-profile-image', [UserController::class, 'updateProfileImage']);
Route::post('/update-user-details', [UserController::class, 'updateUserDetails']);
Route::post('/update-user', [UserController::class, 'updateUser'])->name('user.update');
Route::get('/user/details/{id}', [UserController::class, 'userDetails'])->name('user.details');


Route::get('/all/documents', [DocumentController::class, 'index']);
Route::get('/all/attorny/documents', [DocumentController::class, 'attornyDocuments']);
Route::post('/documents', [DocumentController::class, 'store']);
Route::delete('/documents/{id}', [DocumentController::class, 'destroy']);

Route::get('/recipients/list', [RecipientController::class, 'willlist'])->name('recipients.list');
Route::get('/recipients/att/list', [RecipientController::class, 'list'])->name('recipients..att.list');
Route::post('/recipients/store', [RecipientController::class, 'store'])->name('recipients.store');
Route::get('/recipients/edit', [RecipientController::class, 'show'])->name('recipients.edit');
Route::put('/recipients/update', [RecipientController::class, 'update'])->name('recipients.update');
Route::get('/recipients/delete/{id}', [RecipientController::class, 'delete'])->name('recipients.delete');

Route::get('/checkout', [PaymentController::class, 'index'])->name('checkout');
Route::get('/payment/checkout', [PaymentController::class, 'paymentPage'])->name('paymentPage');
Route::post('/payment/create-intent', [PaymentController::class, 'createPaymentIntent'])->name('paymentIntent');
Route::get('payment/success', [PaymentController::class, 'handlePaymentSuccess'])->name('payment.success');
Route::get('/cancel-subscription', [PaymentController::class, 'cancelSubscription'])->name('cancel.subscription');
Route::get('/api/validate-coupon/{code}', [PaymentController::class, 'validateCoupon']);

Route::post('/send-email', [ContactController::class, 'sendEmail']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
