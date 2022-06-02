<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    UserController,
    ProjectController
};

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
    return view("auth.login");
});

Route::group(["middleware" => "auth"], function() {
    Route::get("/dashboard", DashboardController::class);

    Route::group(["middlware" => "auth_super_admin"], function() {
        
        // User Managament
        Route::resource("/dashboard/users", UserController::class)->only(["index", "create", "store"]);
        Route::resource("/dashboard/projects", ProjectController::class)->except(["destroy"]);
    });

    // User Managament
    Route::resource("/dashboard/users", UserController::class)->only(["show", "edit", "update"]);
});