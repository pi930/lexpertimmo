<?php 
use Illuminate\Http\Request;
use App\Http\Controllers\Api\RegisterController;

Route::post('/register', [RegisterController::class, 'store']);

Route::post('/ping', function (Request $request) {
    return response()->json([
        'message' => 'pong',
        'data' => $request->all()
    ]);
});