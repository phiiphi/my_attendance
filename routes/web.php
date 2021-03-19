<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Auth\ChangePasswordController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


Route::redirect('/', 'admin/home');


// Change Password Routes...
require __DIR__.'/auth.php';

Route::get('change_password', [ChangePasswordController::class, 'showChangePasswordForm'])->name('auth.change_password');
Route::patch('change_password', [ChangePasswordController::class, 'changePassword'])->name('auth.change_password');

Route::group([['middleware' => ['auth']], 'prefix' => 'admin', 'as' => 'admin.','namespace => admin' ], function () {
    Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
    Route::resource('permissions', PermissionsController::class);
    Route::delete('permissions_mass_destroy', 'PermissionsController@massDestroy')->name('permissions.mass_destroy');
    Route::resource('roles', RolesController::class);
    Route::delete('roles_mass_destroy', 'RolesController@massDestroy')->name('roles.mass_destroy');
    Route::resource('users', UsersController::class);
    Route::delete('users_mass_destroy', 'UsersController@massDestroy')->name('users.mass_destroy');
    Route::resource('student', StudentController::class);
    Route::delete('student_mass_destroy', 'StudentController@massDestroy')->name('student.mass_destroy');
    Route::post('export_csv', 'App\Http\Controllers\Admin\StudentController@exportStudentCsv')->name('student.exportStudentCsv');
});




