<?php
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
 

 
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 
Route::group([
 
    'middleware' => 'api',
    'prefix' => 'auth'
 
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->name('me');
    
});

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('/customer_create', [CustomerController::class, 'creat'])->name('cuatumer_creat');

    Route::post('/customer_list', [CustomerController::class, 'list'])->name('cuatumer_list');
    Route::post('/customer_update', [CustomerController::class, 'update'])->name('cuatumer_update');

    Route::post('/customer_delete', [CustomerController::class, 'delete'])->name('cuatumer_delete');
});



