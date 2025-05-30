<?php
use App\Http\Controllers\RentalConfirmMailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BensLocaveisController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LimitDateMiddleware;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/Contact', function () {
    return view('contact');
});
Route::get('/About', function () {
    return view('about');
});
Route::get('/Help', function () {
    return view('help');
});
Route::get('/Privacy', function () {
    return view('privacy');
});
Route::get('/Terms', function () {
    return view('terms');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});
    Route::post('/enviar-email', [RentalConfirmMailController::class, 'sendReservationEmail'])
    ->middleware('auth')
    ->name('send.email');

Route::get('/disponiveis', [BensLocaveisController::class, 'all_avalible'])->name('disponiveis');

require __DIR__.'/auth.php';
