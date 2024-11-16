<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//this route for macking call api to third party
Route::post('fack', function (Request $request) {
    return response()->json($request->all(), 200);
});
