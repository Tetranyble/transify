<?php

use App\Models\AccountType;
use App\Models\TransactionType;
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
    return view('welcome');
});
//Route::get('{any}', function () {
//    return view('app');
//})->where('any', '.*');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('transactions', \App\Http\Controllers\TransactionController::class);
Route::get('/test', function(){
    AccountType::create([
        'name' => 'saving',
        'allowed_balance' => 299990,
        'description' => 'savings account'
    ]);
    TransactionType::create([
        'name' => 'transfer',
        'description' => 'savings account'
    ]);
    TransactionType::create([
        'name' => 'deposit',
        'description' => 'savings account'
    ]);
    TransactionType::create([
        'name' => 'withdrawal',
        'description' => 'savings account'
    ]);

    return "<p> Seeding done</p>";
});
