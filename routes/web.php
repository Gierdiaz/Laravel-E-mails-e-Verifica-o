<?php

use App\Http\Controllers\ProfileController;
use App\Mail\ExampleMail;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/email', function(){
    $user = User::where('name', '=', 'gierdiaz')->first();
    Mail::to('gierdiaz@hotmail.com')
        ->send(new ExampleMail($user));

    return 'success';
});

Route::get('/email-markdown', function(){
    Mail::to('gierdiaz@hotmail.com')
        ->send(new WelcomeMail);
    return 'ok';
});
