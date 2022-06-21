<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    UserController,
    ProjectController,
    RoleController
};
use Illuminate\Support\Facades\Auth;

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
    Auth::logout();
    return view("auth.login");
});

Route::group(["middleware" => ["auth", "check_access_module:001"]], function() {
    Route::get("/dashboard", DashboardController::class);

    // User Managament
    Route::get("/dashboard/users", [UserController::class, "index"])->middleware("check_access_module:002U");
    Route::get("/dashboard/users/create", [UserController::class, "create"])->middleware("check_access_module:002UA");
    Route::get("/dashboard/users/{user}", [UserController::class, "show"])->middleware("check_access_module:002UD|002UDS");
    Route::get("/dashboard/users/{user}/edit", [UserController::class, "edit"])->middleware("check_access_module:002UE|002UES");
    
    Route::post("/dashboard/users", [UserController::class, "store"])->middleware("check_access_module:002UA");
    Route::put("/dashboard/users/{user}", [UserController::class, "update"])->middleware("check_access_module:002UE|00UES");

    // Role Management
    Route::group(["middleware" => "auth_super_admin"], function() {
        Route::get("/dashboard/roles", [RoleController::class, "index"]);
        Route::get("/dashboard/roles/{role}", [RoleController::class, "show"]);

        Route::post("/dashboard/roles", [RoleController::class, "store"]);
        Route::put("/dashboard/roles/{role}/module/assign", [RoleController::class, "assign_module"]);
    });

    // Project Management
    Route::get("/dashboard/projects", [ProjectController::class, "index"])->middleware("check_access_module:003PJ");
    Route::get("/dashboard/projects/create", [ProjectController::class, "create"])->middleware("check_access_module:003PJA");
    Route::get("/dashboard/projects/{project}", [ProjectController::class, "show"])->middleware("check_access_module:003PJD|003PJD");
    Route::get("/dashboard/projects/{project}/edit", [ProjectController::class, "edit"])->middleware("check_access_module:003PJD|003PJE");

    Route::post("/dashboard/projects", [ProjectController::class, "store"])->middleware("check_access_module:003PJA");
    Route::put("/dashboard/projects/{project}", [ProjectController::class, "update"])->middleware("check_access_module:003PJE");
});