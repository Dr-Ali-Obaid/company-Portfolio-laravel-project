<?php

use App\Http\Controllers\Admin\AdminProjectController;
use App\Http\Controllers\Admin\AdminSubscriberController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;

// مسارات صفحات المشاهدة العادية
Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe');
Route::get('/lang/{locale}', [LanguageController::class, 'switch'])
    ->name('lang.switch');
route::get('/verify-subscription/{token}', [SubscriberController::class, 'verify'])->name('subscribe.verify');
route::get('/unsubscribe/{token}', [SubscriberController::class, 'unsubscribe'])->name('unsubscribe');

// مسارات خاصة بالمستخدم مسجل الدخول لكن ليس لدينا إلا واحد فقط وهو في نفس الوقت مدير 

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// مسارات خاصة بالمدير
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::resource('projects', AdminProjectController::class);
Route::resource('subscribers', AdminSubscriberController::class);
Route::resource('newsletters', NewsletterController::class); 
});

require __DIR__ . '/auth.php';
