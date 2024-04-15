<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    // Retrieve all todo tasks for a user.
    Route::get('/todos', [TodoController::class, 'index']);

    // Retrieve a specific todo task
    Route::get('/todos/{id}', [TodoController::class, 'show']);

    // Create a new todo task
    Route::post('/todos', [TodoController::class, 'store']);

    // Update a todo task
    Route::put('/todos/{id}', [TodoController::class, 'update']);

    // Delete a todo task
    Route::delete('/todos/{id}', [TodoController::class, 'destroy']);
});
