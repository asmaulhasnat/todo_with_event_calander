<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\UserController;


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

Route::redirect('/', '/login',301);

Route::get('/register/{key}', 'Auth\RegisterController@showRegistrationForm')->name('register');

/*
  * ----------------------------------------------------------------------------
  */

/**
 * End user section start
 */


Route::middleware(['auth'])->group(function () {
    //appointment section 
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('todo/create', 'AppointmentController@create')->name('todo.create');
    Route::post('todo', 'AppointmentController@store')->name('todo.store');
    Route::get('todo/{id}', 'AppointmentController@edit')->name('todo.edit');
    Route::post('todo/{id}', 'AppointmentController@update')->name('todo.update');
    Route::get('todo/{id}/cancel', 'AppointmentController@cancel')->name('todo.cancel');
    Route::post('todo/{id}/cancel', 'AppointmentController@cancel')->name('todo.cancel');
    Route::get('fullcalender', [FullCalenderController::class, 'index'])->name('todo.event');;
    Route::post('fullcalenderAjax', [FullCalenderController::class, 'ajax']);
    // manage user short code from user panel
});

Route::middleware([ 'auth'])->group(function () {
    //all authenticate user can access
    Route::post('user/panel', [UserController::class, 'connectAsUser'])->name('user.panel');
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('profile', [UserController::class, 'profileUpdate'])->name('user.profile');

    Route::get('change-password', [UserController::class, 'changePasswordForm'])->name('user.password');
    Route::post('change-password', [UserController::class, 'passwordUpdate'])->name('user.password');
});







/*
* All Authenticate user acccess panel end
*/



Auth::routes();
