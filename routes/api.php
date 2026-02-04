<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\OrderApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Cafe Noir API endpoints for products and orders.
| Products endpoint is public, Orders endpoint requires authentication.
|
| To authenticate, use Laravel Sanctum tokens:
| POST /api/tokens/create - Create a new token (requires authentication)
|
*/

// Public API endpoints
Route::prefix('v1')->group(function () {
    // Products - Public access
    Route::get('/products', [ProductApiController::class, 'index']);
    Route::get('/products/{slug}', [ProductApiController::class, 'show']);
});

// Protected API endpoints (requires Sanctum token)
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    // Orders - Admin only
    Route::get('/orders', [OrderApiController::class, 'index']);
    Route::get('/orders/{order}', [OrderApiController::class, 'show']);
});

// Token creation endpoint
Route::middleware('auth:sanctum')->post('/tokens/create', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'token_name' => 'required|string|max:255',
    ]);

    $token = $request->user()->createToken($request->token_name);

    return response()->json([
        'success' => true,
        'token' => $token->plainTextToken,
    ]);
});
