<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ArkController;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::get('/dashboard', function () {
    return view('index');
    // $value = session()->all();
    // echo "<pre>";
    // print_r($value);
    // echo "</pre>";
})->name('index');

Route::get('/change_password', function () {
    return view('changePass');
})->name('change');

Route::get('/forgot_password', function () {
    return view('forgotPass');
})->name('forgot');

Route::post('/change_password', [ArkController::class, 'changePass'])->name('changePass');

Route::post('/forgot_password', [ArkController::class, 'forgotPass'])->name('forgotPass');

?>
