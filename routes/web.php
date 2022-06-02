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

    // User Managament
    Route::get("/dashboard/users", [UserController::class, "index"])->middleware("check_access_module:002U");
    Route::get("/dashboard/users/create", [UserController::class, "create"])->middleware("check_access_module:002UA");
    Route::get("/dashboard/users/{user}", [UserController::class, "show"])->middleware("check_access_module:002UD|002UDS");
    Route::get("/dashboard/users/{user}/edit", [UserController::class, "show"])->middleware("check_access_module:002UE|002UES");
    
    Route::post("/dashboard/users", [UserController::class, "store"])->middleware("check_access_module:002UA");
    Route::put("/dashboard/users/{user}", [UserController::class, "update"])->middleware("check_access_module:002UE|00UES");
});