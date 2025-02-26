<?php

use App\Models\PrintJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// routes/api.php
Route::post('/print-test', function (Request $request) {
    $job = PrintJob::create([
        'type' => 'test',
        'parameters' => $request->all()
    ]);

    return response()->json($job);
});

Route::get('/print-jobs', function () {
    return PrintJob::where('status', 'pending')->get();
});

Route::delete('/print-jobs/{id}', function ($id) {
    PrintJob::destroy($id);
    return response()->json(['success' => true]);
});
