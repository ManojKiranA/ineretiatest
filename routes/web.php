<?php

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

use App\Http\Controllers\PostController;
use App\Mail\ViewTestEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('posts','PostController'); 
});

Route::get('testEmail', function () {

    $toAddress = [
        [
            'email' => 'test@gmail.com', 
            'name' => 'Test',
        ],
    ];

    $bccAddress = [
        [
            'email' => 'bcconsendone@gmail.com', 
            'name' => 'Bcc On Send One',
        ],
        [
            'email' => 'bcconsendtwo@gmail.com', 
            'name' => 'Bcc On Send Two',
        ],
    ];

    Mail::to($toAddress)
        ->bcc($bccAddress)
        ->send(new ViewTestEmail);
    
});
